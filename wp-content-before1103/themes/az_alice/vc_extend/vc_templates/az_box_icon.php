<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $box_icon_module
* @var $box_icon_title
* @var $image
* @var $svg_img_size
* @var $box_wrap_link
* @var $box_wrap_link_url
* @var $box_icon_target
* @var $icon_mode
* @var $icon_size
* @var $icon_color
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
$output = $box_icon_module = $box_icon_title = $image = $svg_img_size = $box_wrap_link = $box_wrap_link_url = $box_icon_target = $icon_mode = $icon_size = $icon_color = $icon_type = 
$icon_alice = $icon_alice_social = $icon_az_linecons = $icon_az_steadyicons = $icon_az_vicons = $icon_az_fontawesome = $el_class = 
$animation_loading = $animation_loading_effects = $animation_delay = $responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = '';
extract(shortcode_atts(array(
	'box_icon_module' 			=> 'box-default',
	'box_wrap_link'				=> false,
	'box_wrap_link_url'			=> '',
	'box_icon_target'			=> '',
	'box_icon_title'			=> '',
	'image'						=> $image,
	'svg_img_size'				=> '75x75',
	'icon_mode'					=> 'no-icon',
	'icon_size'					=> '',
	'icon_color'				=> '',
	'icon_type'					=> 'alice',
	'icon_alice'				=> 'font-icon-phone',
	'icon_alice_social'			=> '',
	'icon_az_linecons'			=> '',
	'icon_az_steadyicons'		=> '',
	'icon_az_vicons'			=> '',
	'icon_az_fontawesome'		=> '',
    'el_class' 					=> '',
    'animation_loading' 		=> '',
	'animation_loading_effects' => '',
	'animation_delay' 			=> '',
    'responsive_lg'				=> '',
    'responsive_md' 			=> '',
    'responsive_sm' 			=> '',
    'responsive_xs' 			=> ''
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

// Explode Featured Image Size
$img_size = array_map('trim', preg_split("/[x|X|*]/", $svg_img_size));

// Grab Image
$img_id = preg_replace('/[^\d]/', '', $image);
$image_string = wp_get_attachment_image_src( $img_id, 'full');
$image_string = $image_string[0];

// Alt Text Image
$alt = get_post_meta($image, '_wp_attachment_image_alt', true);
if ( !empty($alt) ){
	$alt = get_post_meta($image, '_wp_attachment_image_alt', true);
} else {
	$alt = '00';
}

// Target
if ( $box_icon_target == 'same' || $box_icon_target == '_self' ) { $box_icon_target = ''; }
if ( $box_icon_target != '' ) { $box_icon_target = ' target="'.$box_icon_target.'"'; }

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

// Icon Mode
$icon_custom_value = '';
if ( $box_icon_module == 'box-icon' && $icon_mode == 'yes-icon' ) {

	// Icon Color and Size
	if (!empty($icon_color) && !empty($icon_size)) { $icon_custom_value = ' style="color:'.$icon_color.'; font-size:'.$icon_size.'px;"'; }
	else if (!empty($icon_size)) { $icon_custom_value = ' style="font-size:'.$icon_size.'px;"'; }

	$iconClass = isset( ${"icon_" . $icon_type} ) ? esc_attr( ${"icon_" . $icon_type} ) : 'font-icon-phone';
	$icon_output = '<i class="'.$iconClass.'"'.$icon_custom_value.'></i>';
} else {
	$icon_output = '';
}

if ( $box_icon_module == 'box-image' ) {
	$image_output = '<img src="'.$image_string.'" alt="'.esc_attr($alt).'" />';
} else {
	$image_output = '';
}

if ( $box_icon_module == 'box-svg' ) {
	$image_svg_output = '<img src="'.$image_string.'" alt="'.esc_attr($alt).'" width="'.$img_size[0].'" height="'.$img_size[1].'" />';
} else {
	$image_svg_output = '';
}

// Output Media/Icon Div
if ( $box_icon_module == 'box-icon' || $box_icon_module == 'box-image' || $box_icon_module == 'box-svg' ) {
	$box_media_output = '
	<div class="az-box-icon-media">'.$icon_output.$image_output.$image_svg_output.'</div>';
} else {
	$box_media_output = '';
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'az-box-icon az-box-equals'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $animation_loading_class, $animation_effect_class, $box_icon_module, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

if ($box_wrap_link==true) {
	
	$output .= '
	<div'.$class.''.$animation_delay_class.'>
		<a class="box-wrapper-link" href="'.esc_url($box_wrap_link_url).'" title="'.esc_attr($box_icon_title).'"'.$box_icon_target.'>
			<h3 class="box-title">'.esc_attr($box_icon_title).'</h3>
			'.$box_media_output.'
			<div class="box-text">'.wpb_js_remove_wpautop($content, true).'</div>
		</a>
	</div>';

} else {
	
	$output .= '
	<div'.$class.''.$animation_delay_class.'>
		<h3 class="box-title">'.esc_attr($box_icon_title).'</h3>
		'.$box_media_output.'
		<div class="box-text">'.wpb_js_remove_wpautop($content, true).'</div>
	</div>';

}

echo $output.$this->endBlockComment('az_box_icon');
?>