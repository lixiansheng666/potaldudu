<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $divider_number_text
* @var $divider_color
* @var $divider_text_color
* @var $margin_top_value
* @var $margin_bottom_value
* @var $animation_loading
* @var $animation_loading_effects
* @var $animation_delay
* @var $responsive_lg
* @var $responsive_md
* @var $responsive_sm
* @var $responsive_xs
*/

/*
$output = $divider_number_text = $divider_color = $divider_text_color = $margin_top_value = $margin_bottom_value = $el_class = 
$animation_loading = $animation_loading_effects = $animation_delay = $responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = '';
extract(shortcode_atts(array(
	'divider_number_text' 		=> '01',
	'divider_color'		  		=> '',
	'divider_text_color'  		=> '',
	'margin_top_value'	 	 	=> '',
	'margin_bottom_value' 		=> '',
    'el_class' 			  		=> '',
    'animation_loading' 		=> '',
	'animation_loading_effects' => '',
	'animation_delay' 			=> '',
    'responsive_lg'		  		=> '',
    'responsive_md' 	  		=> '',
    'responsive_sm' 	  		=> '',
    'responsive_xs' 	  		=> ''
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

if ( !empty($divider_color) ){
	$divider_color = 'border-color: '.$divider_color.'; ';
}

if ( !empty($divider_text_color) ){
	$divider_text_color = 'color: '.$divider_text_color.'; ';	
}

if ( !empty($margin_top_value) ){
	$margin_top_value = 'margin-top: '.$margin_top_value.'px; ';
} else {
	$margin_top_value = '';
}

if ( !empty($margin_bottom_value) ){
	$margin_bottom_value = 'margin-bottom: '.$margin_bottom_value.'px;';
} else {
	$margin_bottom_value = '';
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

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'az-divider'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '
	<div'.$class.''.$animation_delay_class.' style="'.$divider_color.$divider_text_color.$margin_top_value.$margin_bottom_value.'"><span>'.$divider_number_text.'</span></div>'.$this->endBlockComment('az_divider')."\n";

echo $output;
?>