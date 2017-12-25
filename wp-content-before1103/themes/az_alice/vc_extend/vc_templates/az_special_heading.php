<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $special_heading_title
* @var $special_heading_subtitle
* @var $special_heading_colors_mode
* @var $special_heading_wrap_link
* @var $special_heading_wrap_link_url
* @var $special_heading_link_target
* @var $animation_loading
* @var $animation_loading_effects
* @var $animation_delay
* @var $responsive_lg
* @var $responsive_md
* @var $responsive_sm
* @var $responsive_xs
* @var $responsive_typo_check
* @var $responsive_typo_default
* @var $responsive_typo_medium
* @var $responsive_typo_small
* @var $responsive_typo_very_small
* @var $responsive_typo_ultra_small
*/

/*
$output = $special_heading_title = $special_heading_subtitle = $special_heading_colors_mode = $special_heading_wrap_link = $special_heading_wrap_link_url = 
$special_heading_link_target = $el_class = $animation_loading = $animation_loading_effects = $animation_delay = 
$responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = $responsive_typo_check = 
$responsive_typo_default = $responsive_typo_medium = $responsive_typo_small = $responsive_typo_very_small = $responsive_typo_ultra_small = '';
extract( shortcode_atts( array(
	'special_heading_title' 		=> '',
	'special_heading_subtitle' 		=> '',
	'special_heading_colors_mode'	=> 'default-special-heading-color',
	'special_heading_master_color'	=> '',
	'special_heading_wrap_link'		=> false,
	'special_heading_wrap_link_url' => '',
	'special_heading_link_target'	=> '',
	'el_class' 	 					=> '',
	'animation_loading' 			=> '',
	'animation_loading_effects' 	=> '',
	'animation_delay' 				=> '',
	'responsive_lg'					=> '',
    'responsive_md' 				=> '',
    'responsive_sm' 				=> '',
    'responsive_xs' 				=> '',
    'responsive_typo_check'			=> false,
    'responsive_typo_default'		=> '17',
    'responsive_typo_medium'		=> '12',
    'responsive_typo_small'			=> '9',
    'responsive_typo_very_small'	=> '5',
    'responsive_typo_ultra_small'	=> '4'
), $atts ) );
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

// Allowed Tags
$allowed_tags = array(
    'br' => array()
);

// Colors Mode
$style_color = null;
if ( $special_heading_colors_mode == 'custom-special-heading-color' ) {
	$style_color = ' style="color: '.$special_heading_master_color.';"';	
}

// Heading Output
$subtitle_output = null;
if (!empty($special_heading_subtitle)) {
	$subtitle_output = '<h3 class="az-special-heading-subtitle"'.$style_color.'>'.wp_kses($special_heading_subtitle, $allowed_tags).'</h3>';
} else {
	$subtitle_output = '';
}

// Target
if ( $special_heading_link_target == 'same' || $special_heading_link_target == '_self' ) { $special_heading_link_target = ''; }
if ( $special_heading_link_target != '' ) { $special_heading_link_target = ' target="'.$special_heading_link_target.'"'; }

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

// Responsive Typo
$data_attributs_typo = $data_attributs_class = null;
if ($responsive_typo_check == "yes") {
	$data_attributs_class = 'custom-responsive-typo';
	$data_attributs_typo = ' data-df="'.esc_attr($responsive_typo_default).'" data-md="'.esc_attr($responsive_typo_medium).'" data-sml="'.esc_attr($responsive_typo_small).'" data-vsml="'.esc_attr($responsive_typo_very_small).'" data-usml="'.esc_attr($responsive_typo_ultra_small).'"';
}

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'az-special-heading'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $special_heading_colors_mode, $animation_loading_class, $animation_effect_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

if ($special_heading_wrap_link==true) {

	$output .= '
	<div'.$class.''.$animation_delay_class.'>
		<a class="az-special-heading-box-link" href="'.esc_url($special_heading_wrap_link_url).'"'.$special_heading_link_target.'>
			<h2 class="az-special-heading-title '.$data_attributs_class.'"'.$style_color.$data_attributs_typo.'>'.wp_kses($special_heading_title, $allowed_tags).'</h2>
			'.$subtitle_output.'
		</a>
	</div>';

} else {

	$output .= '
	<div'.$class.''.$animation_delay_class.'>
		<h2 class="az-special-heading-title '.$data_attributs_class.'"'.$style_color.$data_attributs_typo.'>'.wp_kses($special_heading_title, $allowed_tags).'</h2>
		'.$subtitle_output.'
	</div>';

}

echo $output.$this->endBlockComment('az_special_heading');

?>