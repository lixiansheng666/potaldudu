<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $toggle_id
*/

/*
$output = $toggle_id = $el_class = '';
extract(shortcode_atts(array(
	'toggle_id'	=> '',
    'el_class'  => '',
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'az-accordion panel-group'.$el_class, $this->settings['base'], $atts );
$class = setClass(array($css_class));

// Toggle Effect
$tog_id = null;
if ( !empty($toggle_id) ){
	$tog_id = ' id="'.$toggle_id.'"';
}

$output .= '
<div'.$tog_id.$class.' role="tablist" aria-multiselectable="true">';

$output .= wpb_js_remove_wpautop($content);

$output .= '
</div>'.$this->endBlockComment('.panel-group');

echo $output;