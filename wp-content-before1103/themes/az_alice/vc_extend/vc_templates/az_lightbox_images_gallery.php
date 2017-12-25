<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $image
* @var $image_different_popup
* @var $images_gallery
* @var $image_mode
* @var $images_gallery_name
* @var $thumbnail_img_size
* @var $hover_fx_style
* @var $animation_loading
* @var $animation_loading_effects
* @var $animation_delay
* @var $responsive_lg
* @var $responsive_md
* @var $responsive_sm
* @var $responsive_xs
*/

/*
$output = $image = $image_different_popup = $images_gallery = $image_mode = $images_gallery_name = $thumbnail_img_size =
$animation_loading = $animation_loading_effects = $animation_delay = $hover_fx_style = $el_class = 
$responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = '';
extract( shortcode_atts( array(
	'image' 					=> $image,
	'image_different_popup' 	=> $image_different_popup,
	'images_gallery' 			=> '',
	'thumbnail_img_size' 		=> '',
	'image_mode' 				=> 'normal-image',
	'images_gallery_name' 		=> '',
	'animation_loading' 		=> '',
	'animation_loading_effects' => '',
	'animation_delay' 			=> '',
	'hover_fx_style' 			=> 'normal-hover-fx',
	'el_class' 					=> '',
	'responsive_lg'				=> '',
    'responsive_md' 			=> '',
    'responsive_sm' 			=> '',
    'responsive_xs' 			=> ''
), $atts ) );
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

// Grab Image & Different Image Popup
$img_id = preg_replace('/[^\d]/', '', $image);
$image_string = wp_get_attachment_image_src( $img_id, 'full');

$img_popup_id = preg_replace('/[^\d]/', '', $image_different_popup);
$image_popup_string = wp_get_attachment_image_src( $img_popup_id, 'full');
$image_popup_string = $image_popup_string[0];

// Array Images Gallery
$images = explode(',', $images_gallery);

// FancyBox Full Image Output
$output_image_result = (!empty($image_popup_string)) ? $image_popup_string : $image_string[0];

// Create Thumbnail Image Size if present
$img_size = $thumbnail_img_size;
if ( !empty($img_size) ){
	$img_size = array_map('trim', preg_split("/[x|X|*]/", $thumbnail_img_size));
	$image_string = aq_resize( $image_string[0], $img_size[0], $img_size[1], true, false, true );
}

// Grab Gallery Name
$fancy_image_gallery_name = (!empty($images_gallery_name) ? ' data-fancybox-group="'.esc_attr($images_gallery_name).'"' : '');

// Alt/Caption Text Image
$alt = get_post_meta($image, '_wp_attachment_image_alt', true);
$caption_attachment = get_post( $image );
$caption_output = $caption_attachment->post_excerpt;

$alt_img = $caption_title_name = null;
if(!empty($caption_output)){
	if(!empty($alt)){
		$alt_img = esc_attr($alt);
	} else {
		$alt_img = '00';
	}
	$caption_title_name = ' data-fancybox-title="'.esc_attr($caption_output).'"';
} else {
	$alt_img = '00';
	$caption_title_name = '';
}

// Animation Setup
$animation_loading_class = null;
if ($animation_loading == "yes") {
	$animation_loading_class = 'start-animated-content';
}

$animation_effect_class = null;
if ($animation_loading == "yes") {
	$animation_effect_class = $animation_loading_effects;
} else {
	$animation_effect_class = '';
}

$animation_delay_class = null;
if ($animation_loading == "yes" && !empty($animation_delay)) {
    $animation_delay_class = ' data-delay="'.esc_attr($animation_delay).'"';
}

// Image Mode
if ($image_mode == "normal-image") {
	$image_css_mode = 'not-full-responsive';
} else {
	$image_css_mode = 'yes-full-responsive';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'lightbox lightbox-gallery'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $image_css_mode, $hover_fx_style, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs, $animation_loading_class, $animation_effect_class));

$output .= '
<div'.$class.''.$animation_delay_class.'>
	<a class="fancybox-thumb" href="'.$output_image_result.'"'.$caption_title_name.$fancy_image_gallery_name.'>
		<span class="lightbox-overlay"><i class="icon-plus"></i></span>
		<img class="'.$image_mode.'" src="'.$image_string[0].'" width="'.$image_string[1].'" height="'.$image_string[2].'" alt="'.$alt_img.'" />
	</a>';
// Output Images Gallery Array
if(!empty($images_gallery)){
	foreach($images as $image):
		$src = wp_get_attachment_image_src( $image, 'full' );
		$caption_attachment = get_post( $image );
		$caption_output = $caption_attachment->post_excerpt;
		
		$caption_title_name = null;
		if(!empty($caption_output)){
			$caption_title_name = ' data-fancybox-title="'.esc_attr($caption_output).'"';
		} else {
			$caption_title_name = '';
		}
		$output .= '
		<a class="fancybox-thumb hidden" href="'.$src[0].'"'.$caption_title_name.$fancy_image_gallery_name.'></a>';
	endforeach;
}
$output .= '
</div>'.$this->endBlockComment('az_lightbox_images_gallery');

echo $output;

?>