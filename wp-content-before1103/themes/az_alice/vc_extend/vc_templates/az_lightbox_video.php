<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $image_video
* @var $image_mode
* @var $video_link
* @var $caption_video_title
* @var $video_gallery_name
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
$output = $image_video = $image_mode = $video_link = $caption_video_title = $video_gallery_name = $thumbnail_img_size = 
$animation_loading = $animation_loading_effects = $animation_delay = $hover_fx_style = $el_class = 
$responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = '';
extract( shortcode_atts( array(
	'image_video' 				=> $image_video,
	'thumbnail_img_size' 		=> '',
	'image_mode' 				=> 'normal-image',
	'video_link' 				=> '',
	'caption_video_title' 		=> '',
	'video_gallery_name' 		=> '',
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

// Grab Image
$img_id = preg_replace('/[^\d]/', '', $image_video);
$image_string = wp_get_attachment_image_src( $img_id, 'full');

// Create Thumbnail Image Size if present
$img_size = $thumbnail_img_size;
if ( !empty($img_size) ){
	$img_size = array_map('trim', preg_split("/[x|X|*]/", $thumbnail_img_size));
	$image_string = aq_resize( $image_string[0], $img_size[0], $img_size[1], true, false, true );
}

// Grab Gallery Name
$fancy_video_gallery_name = (!empty($video_gallery_name) ? ' data-fancybox-group="'.esc_attr($video_gallery_name).'"' : '');

// Grab Caption Title
$caption_title_name = (!empty($caption_video_title) ? ' data-fancybox-title="'.esc_attr($caption_video_title).'"' : '');

// Alt Text Image
$alt = get_post_meta($image_video, '_wp_attachment_image_alt', true);
if ( !empty($alt) ){
	$alt = get_post_meta($image_video, '_wp_attachment_image_alt', true);
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

// Image Mode
if ($image_mode == "normal-image") {
	$image_css_mode = 'not-full-responsive';
} else {
	$image_css_mode = 'yes-full-responsive';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'lightbox lightbox-video'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $image_css_mode, $hover_fx_style, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs, $animation_loading_class, $animation_effect_class));

$output .= '
<div'.$class.''.$animation_delay_class.'>
	<a class="fancybox-media" href="'.esc_url($video_link).'"'.$caption_title_name.$fancy_video_gallery_name.'>
		<span class="lightbox-overlay"><i class="icon-play"></i></span>
		<img class="'.$image_mode.'" src="'.$image_string[0].'" width="'.$image_string[1].'" height="'.$image_string[2].'" alt="'.esc_attr($alt).'" />
	</a>
</div>'.$this->endBlockComment('az_lightbox_video');

echo $output;

?>