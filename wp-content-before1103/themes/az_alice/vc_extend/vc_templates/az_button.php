<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $button_text
* @var $button_alignment
* @var $button_link_url
* @var $button_link_target
* @var $button_colors_mode
* @var $button_master_color
* @var $button_master_color_hover
* @var $button_master_color_text
* @var $button_master_color_hover_text
* @var $inverted_enabled
* @var $icon_mode
* @var $icon_type
* @var $icon_alice
* @var $icon_alice_social
* @var $icon_az_linecons
* @var $icon_az_steadyicons
* @var $icon_az_vicons
* @var $icon_az_fontawesome
* @var $animation_loading
* @var $animation_loading_effects
* @var $animation_delay
* @var $responsive_lg
* @var $responsive_md
* @var $responsive_sm
* @var $responsive_xs
*/

/*
$output = $button_text = $button_alignment = $button_link_url = $button_link_target = $button_colors_mode = $button_master_color = 
$button_master_color_hover = $button_master_color_text = $button_master_color_hover_text = $inverted_enabled = $icon_mode = $icon_type =
$icon_alice = $icon_alice_social = $icon_az_linecons = $icon_az_steadyicons = $icon_az_vicons = $icon_az_fontawesome = $el_class = $animation_loading = $animation_loading_effects = $animation_delay = 
$responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = '';
extract( shortcode_atts( array(
	'button_text' 						=> '',
	'button_alignment' 					=> 'noalign',
	'button_link_url'					=> '',
	'button_link_target' 				=> '',
	'button_colors_mode' 				=> 'default-btn-color',
	'button_master_color' 				=> '',
	'button_master_color_hover' 		=> '',
	'button_master_color_text' 			=> '',
	'button_master_color_hover_text' 	=> '',
	'inverted_enabled'					=> false,
	'icon_mode'							=> 'no-icon',
	'icon_type'							=> 'alice',
	'icon_alice'						=> 'font-icon-phone',
	'icon_alice_social'					=> '',
	'icon_az_linecons'					=> '',
	'icon_az_steadyicons'				=> '',
	'icon_az_vicons'					=> '',
	'icon_az_fontawesome'				=> '',
	'el_class' 	 						=> '',
	'animation_loading' 				=> '',
	'animation_loading_effects' 		=> '',
	'animation_delay' 					=> '',
	'responsive_lg'						=> '',
    'responsive_md' 					=> '',
    'responsive_sm' 					=> '',
    'responsive_xs' 					=> ''
), $atts ) );
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

if ( $icon_mode == 'yes-icon' ) {
	$iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'font-icon-phone';
	$icon_output = '<i class="'.$iconClass.'"></i>';
} else {
	$icon_output = '';
}

if ( !empty($button_text) ) {
	$button_output = '<span>'.esc_attr($button_text).'</span>';
} else {
	$button_output = '';
}

// Target Output
if ( $button_link_target == 'same' || $button_link_target == '_self' ) { $button_link_target = ''; }
if ( $button_link_target != '' ) { $button_link_target = ' target="'.$button_link_target.'"'; }

// Colors Mode
$data_color = $style_color = $inverted_to = '';
if ($inverted_enabled==true) {
	$inverted_to = 'inverted-mode';

	if ( $button_colors_mode == 'custom-btn-color' ) {
		$data_color = ' data-bg-btn="'.$button_master_color.'" data-tx-btn="'.$button_master_color_text.'" data-hv-btn="'.$button_master_color_hover.'" data-hv-tx-btn="'.$button_master_color_hover_text.'"';
		$style_color = ' style="background: transparent; border-color: '.$button_master_color.'; color: '.$button_master_color_text.';"';
	} 

} else {
	$inverted_to = '';

	if ( $button_colors_mode == 'custom-btn-color' ) {
		$data_color = ' data-bg-btn="'.$button_master_color.'" data-tx-btn="'.$button_master_color_text.'" data-hv-btn="'.$button_master_color_hover.'" data-hv-tx-btn="'.$button_master_color_hover_text.'"';
		$style_color = ' style="background: '.$button_master_color.'; color: '.$button_master_color_text.';"';	
	}

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


$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'az-button'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $button_colors_mode, $inverted_to, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

if($button_alignment=="noalign") {

	$output .= '
	<a '.$class.$style_color.$data_color.$animation_delay_class.' href="'.esc_url($button_link_url).'"'.$button_link_target.'>'.$icon_output.$button_output.'</a>';

} else {

	$output .= '
	<div class="position-btn '.$button_alignment.'"'.$animation_delay_class.'>
		<a '.$class.$style_color.$data_color.' href="'.esc_url($button_link_url).'"'.$button_link_target.'>'.$icon_output.$button_output.'</a>
	</div>';

}

echo $output.$this->endBlockComment('az_button');

?>