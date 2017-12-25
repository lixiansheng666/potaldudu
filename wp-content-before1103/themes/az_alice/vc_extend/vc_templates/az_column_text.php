<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $animation_loading
* @var $animation_loading_effects
* @var $animation_delay
* @var $responsive_lg
* @var $responsive_md
* @var $responsive_sm
* @var $responsive_xs
*/

/*
$output = $el_class = $animation_loading = $animation_loading_effects = $animation_delay = $responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = '';
extract(shortcode_atts(array(
    'el_class'                  => '',
    'animation_loading'         => '',
    'animation_loading_effects' => '',
    'animation_delay'           => '',
    'responsive_lg'             => '',
    'responsive_md'             => '',
    'responsive_sm'             => '',
    'responsive_xs'             => ''
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

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

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'text-block'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$output .= '
<div'.$class.''.$animation_delay_class.'>
';
$output .= wpb_js_remove_wpautop($content, true);
$output .= '
</div> 
'.$this->endBlockComment('az_column_text');

echo $output;

?>