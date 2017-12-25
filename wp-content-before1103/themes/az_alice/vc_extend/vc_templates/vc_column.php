<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $width
* @var $image
* @var $column_mode
* @var $bg_col_position
* @var $bg_col_repeat
* @var $bg_column_overlay
* @var $bg_column_overaly_color
* @var $custom_bg_color
* @var $equals_col_height
* @var $vertical_center_text
* @var $vertical_center_text_mobile
* @var $min_column_height
* @var $remove_col_padding
* @var $animation_loading
* @var $animation_loading_effects
* @var $animation_delay
*/

/*
$output = $column_mode = $bg_col_position = $bg_col_repeat = $bg_column_overlay = $bg_column_overaly_color = $custom_bg_color = 
$equals_col_height = $vertical_center_text = $vertical_center_text_mobile = $min_column_height = $remove_col_padding =
$animation_loading = $animation_loading_effects = $animation_delay = $el_class = $width = $image = '';
extract(shortcode_atts(array(
	'column_mode' 					=> '',
	'bg_col_position' 				=> '',
	'bg_col_repeat' 				=> '',
	'bg_column_overlay' 			=> '',
	'bg_column_overaly_color' 		=> '',
	'custom_bg_color' 				=> '',
	'equals_col_height' 			=> '',
	'vertical_center_text' 			=> '',
	'vertical_center_text_mobile' 	=> '',
	'min_column_height'				=> '350',
	'remove_col_padding'			=> '',
	'animation_loading' 			=> '',
	'animation_loading_effects' 	=> '',
	'animation_delay' 				=> '',
    'el_class' 						=> '',
    'width' 						=> '1/1',
    'image' 						=> $image
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);
$width = wpb_translateColumnWidthToSpan($width);

// BG Column Mode
$img_id = preg_replace('/[^\d]/', '', $image);
$image_string = wp_get_attachment_image_src( $img_id, 'full');
$image_string = $image_string[0];

// Mask
$col_mask_output = null;
if ($column_mode=="custom_col_image_bg") { 
    if ($bg_column_overlay == "yes_mask_overlay") {
        $col_mask_output = '
        <div class="column-overlay-mask" style="background-color: '.$bg_column_overaly_color.';"></div>
        ';
    }
}

// Bg Repeat
if ($bg_col_repeat=="stretch") { $bg_col_repeat = 'background-repeat: no-repeat; background-size: cover;'; } 
else { $bg_col_repeat = 'background-repeat: '.$bg_col_repeat.';'; }


/* Animation Scroll Module */
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

/* Output Columns */
$bg_class = null;
if ($column_mode=="custom_col_color") {
	$bg_class = 'colorize-column';
} else if ($column_mode=="custom_col_image_bg") {
	$bg_class = 'imagize-column';
} else {
	$bg_class = 'normal-column';
}

$equals_col_height_output = $vertical_text_output_start = $vertical_text_output_end = $vertical_mobile_output = $col_padding = null;
if ($equals_col_height==true) {
	$equals_col_height_output = 'equals-col-height';

	if ($remove_col_padding==true) {
		$col_padding = 'no-padding-columns';
	} else {
		$col_padding = '';
	}

	if ($vertical_center_text==true) {
		
		if ($vertical_center_text_mobile==true) {
			$vertical_mobile_output = 'mobile-on-text';
		} else {
			$vertical_mobile_output = 'mobile-off-text';
		}

		$vertical_text_output_start = '<div class="vertical-text '.$vertical_mobile_output.'">';
		$vertical_text_output_end = '</div>';
	} else {
		$vertical_text_output_start = '<div class="no-vertical-text">';
		$vertical_text_output_end = '</div>';
	}

	// Custom Bg Color
	if ($column_mode=="custom_col_color") { 
		$column_mode = ' data-minheight="'.esc_attr($min_column_height).'" style="background-color: '.$custom_bg_color.';"';
	}

	// Custom Image
	else if ($column_mode=="custom_col_image_bg") { 
		$column_mode = ' data-minheight="'.esc_attr($min_column_height).'" style="background-position: '.$bg_col_position.'; '.$bg_col_repeat.' background-image: url('.$image_string.');"'; 
	}

	else {
		if ($vertical_center_text==true) {
			$column_mode = ' data-minheight="'.esc_attr($min_column_height).'"';
		} else {
			$column_mode = '';
		}
	}
	
} else {

	if ($column_mode=="custom_col_color") { 
		$column_mode = ' style="background-color: '.$custom_bg_color.';"'; 
	}

	else if ($column_mode=="custom_col_image_bg") { 
		$column_mode = ' style="background-position: '.$bg_col_position.'; '.$bg_col_repeat.' background-image: url('.$image_string.');"'; 
	}

	else {
		$column_mode = '';
	}

}

$el_class .= '';

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $bg_class, $equals_col_height_output, $col_padding, $vertical_mobile_output, $animation_loading_class, $animation_effect_class));

$output .= '
<div'.$class.$column_mode.''.$animation_delay_class.'>'.$col_mask_output.'';
$output .= $vertical_text_output_start;
$output .= 
wpb_js_remove_wpautop($content);
$output .= $vertical_text_output_end;
$output .= '
</div>'.$this->endBlockComment($width);

echo $output;

