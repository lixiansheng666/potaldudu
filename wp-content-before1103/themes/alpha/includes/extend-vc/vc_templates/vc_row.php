<?php
$output = $el_class = $backgroud = $full_width = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'background'        => '#f9f9f9',
    'background_img'	=> '',
    'full_width'        => ''
), $atts));

$el_class = $this->getExtraClass($el_class);
if ( $background_img != '' ) {
	$img = wp_get_attachment_image_src( $background_img, 'full' );
	$background_img_obj = 'background-image:url(' . $img[0] . ');background-size:cover;background-position:center center;';
} else {
	$background_img_obj = '';
}

$output .= '<div class="krown-column-row clearfix ' . $el_class . ( $full_width == 'yes' ? ' full-width' : '' ) . '" style="background-color:' . $background . ';' . $background_img_obj . '"><div class="wrapper">';
if ( $this->settings('base')==='vc_row_inner' ) 
	$output .= '<div class="inner-row clearfix">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>'.$this->endBlockComment('row');
if ( $this->settings('base')==='vc_row_inner' ) 
	$output .= '</div>';
$output .= '</div>';

echo $output;