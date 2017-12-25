<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $map_module_h
* @var $map_height
* @var $map_latidude
* @var $map_longitude
* @var $map_zoom
* @var $marker_image
*/

/*
$output = $map_module_h = $map_height = $map_latidude = $map_longitude = $map_zoom = $marker_image = $el_class = '';
extract( shortcode_atts( array(
	'map_module_h' 	=> '',
	'map_height' 	=> '',
	'map_latidude' 	=> '',
	'map_longitude' => '',
	'map_zoom' 		=> '',
	'marker_image' 	=> $marker_image,
	'el_class' 		=> ''
), $atts ) );
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Enqueue the Google Maps API
wp_register_script('googleMaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', NULL, NULL, TRUE);
wp_enqueue_script('googleMaps');

$el_class = $this->getExtraClass( $el_class );

// Grab Image
$img_id = preg_replace('/[^\d]/', '', $marker_image);
$image_string = wp_get_attachment_image_src( $img_id, 'full');
$image_string = $image_string[0];

// Get Uniq Id
$uniq_self = uniqid();

// Map Full Screen
$map_f = null;
if ($map_module_h=="full_screen_map") {
	$map_f = ' full-area';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'az-map'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $map_f));

// Marker Icon
if(!empty($marker_image)){
	$map_pin_output = ' data-map-pin="'.$image_string.'"';
} else {
	$map_pin_output = '';
}

$output .= '<div class="map-module">
				<div id="cd-zoom-in"><i class="font-icon-plus-3"></i></div>
				<div id="cd-zoom-out"><i class="font-icon-minus-3"></i></div>';

$map_output = null;
if ($map_module_h=="full_screen_map") {
	$map_output = '<div id="map-'.$uniq_self.'" '.$class.' data-map-lat="'.esc_attr($map_latidude).'" data-map-lon="'.esc_attr($map_longitude).'" data-map-zoom="'.esc_attr($map_zoom).'"'.$map_pin_output.'></div>';
}

if ($map_module_h=="normal_height_map") {
	$map_output = '<div id="map-'.$uniq_self.'" '.$class.' data-map-lat="'.esc_attr($map_latidude).'" data-map-lon="'.esc_attr($map_longitude).'" data-map-zoom="'.esc_attr($map_zoom).'"'.$map_pin_output.' style="height: '.esc_attr($map_height).'px;"></div>';
}

$output .= $map_output;
$output .= '</div>'.$this->endBlockComment('az_google_maps');

echo $output;

?>