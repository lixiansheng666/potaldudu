<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $az_slider_nav_color
* @var $az_images_gallery
* @var $az_slider_animations
* @var $az_slider_module_h
* @var $az_slider_height
* @var $az_slider_overlay
* @var $az_slider_overaly_color
*/

/*
$output = $az_slider_nav_color = $az_images_gallery = $az_slider_animations = $az_slider_module_h = 
$az_slider_height = $az_slider_overlay = $az_slider_overaly_color = $el_class = '';
extract( shortcode_atts( array(
	'az_images_gallery' 		=> '',
	'az_slider_nav_color'		=> 'white-mode',
	'az_slider_animations'		=> 'fade',
	'az_slider_module_h'		=> 'normal_height_slider',
	'az_slider_height'			=> '',
	'az_slider_overlay'			=> '',
	'az_slider_overaly_color'	=> '',
	'el_class' 					=> ''
), $atts ) );
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

// Explde Gallery Images
$images = explode(',', $az_images_gallery);

// Get Uniq Id
$uniq_self = uniqid();

// Slider Full Screen
$slider_f = null;
if ($az_slider_module_h=="full_screen_slider") {
	$slider_f = ' full-area';
}

// Overlay
$az_slider_mask_output = null;
if ($az_slider_overlay == "yes_mask_overlay") {
    $az_slider_mask_output = '
    <div class="az-slider-overlay-mask" style="background-color: '.$az_slider_overaly_color.';"></div>
    ';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'az-slider-output flexslider'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $slider_f, $az_slider_nav_color));

$slider_output = null;
if ($az_slider_module_h=="full_screen_slider") {
	$slider_output = '
	<div id="az-slider-images-flexslider-'.$uniq_self.'"'.$class.' data-slide-type="'.$az_slider_animations.'" data-slide-easing="swing" data-slide-loop="false" data-slideshow="false">';
}

if ($az_slider_module_h=="normal_height_slider") {
	$slider_output = '
	<div id="az-slider-images-flexslider-'.$uniq_self.'"'.$class.' data-slide-type="'.$az_slider_animations.'" data-slide-easing="swing" data-slide-loop="false" data-slideshow="false" style="height: '.esc_attr($az_slider_height).'px;">';
}

$output .= $slider_output;
$output .= '
	'.$az_slider_mask_output.'
	<ul class="slides">';

if(!empty($az_images_gallery)){

	foreach($images as $image):
		$img_url = wp_get_attachment_image_src( $image, 'full' );

		$output .= '
		<li class="slide" style="background-image: url('.$img_url[0].');"></li>';

	endforeach;

}

$output .= '
	</ul>';

$output .= '
</div>'.$this->endBlockComment('az_slider_images');

echo $output;

?>