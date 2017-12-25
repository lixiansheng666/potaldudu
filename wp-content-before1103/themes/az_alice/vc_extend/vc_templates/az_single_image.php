<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $image
* @var $image_mode
* @var $image_link_mode
* @var $image_link_url
* @var $image_link_target
* @var $thumbnail_img_size
* @var $animation_loading
* @var $animation_loading_effects
* @var $animation_delay
* @var $responsive_lg
* @var $responsive_md
* @var $responsive_sm
* @var $responsive_xs
*/

/*
$output = $image = $image_mode = $image_link_mode = $image_link_url = $image_link_target = $thumbnail_img_size =
$animation_loading = $animation_loading_effects = $animation_delay = $el_class = 
$responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = '';
extract( shortcode_atts( array(
	'image' 					=> $image,
	'thumbnail_img_size' 		=> '',
	'image_mode' 				=> 'normal-image',
	'image_link_mode' 			=> 'no-link',
	'image_link_url' 			=> '',
	'image_link_target'			=> '_self',
	'animation_loading' 		=> '',
	'animation_loading_effects' => '',
	'animation_delay' 			=> '',
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

// Target
if ( $image_link_target == 'same' || $image_link_target == '_self' ) { $image_link_target = ''; }
if ( $image_link_target != '' ) { $image_link_target = ' target="'.$image_link_target.'"'; }

// Grab Image & Different Image Popup
$img_id = preg_replace('/[^\d]/', '', $image);
$image_string = wp_get_attachment_image_src( $img_id, 'full');

// Create Thumbnail Image Size if present
$img_size = $thumbnail_img_size;
if ( !empty($img_size) ){
	$img_size = array_map('trim', preg_split("/[x|X|*]/", $thumbnail_img_size));
	$image_string = aq_resize( $image_string[0], $img_size[0], $img_size[1], true, false, true );
}

// Alt Text Image
$alt = get_post_meta($image, '_wp_attachment_image_alt', true);
if ( !empty($alt) ){
	$alt = get_post_meta($image, '_wp_attachment_image_alt', true);
} else {
	$alt = '00';
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

$img_output = '';
if ( $image_link_mode== "with-link" ){
	$img_output = '
	<a href="'.esc_url($image_link_url).'"'.$image_link_target.'>
		<img class="'.$image_mode.' aligncenter" src="'.$image_string[0].'" width="'.$image_string[1].'" height="'.$image_string[2].'" alt="'.esc_attr($alt).'" />
	</a>';
} else {
	$img_output = '
	<img class="'.$image_mode.' aligncenter" src="'.$image_string[0].'" width="'.$image_string[1].'" height="'.$image_string[2].'" alt="'.esc_attr($alt).'" />';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'az-single-image'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '
<div'.$class.''.$animation_delay_class.'>';
$output .= $img_output;
$output .= '
</div>'.$this->endBlockComment('az_single_image');

echo $output;

?>