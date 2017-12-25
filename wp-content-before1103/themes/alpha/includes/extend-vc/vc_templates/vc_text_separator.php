<?php
$output = $title = $subtitle = $align = $style = $height = $margin = $el_class = '';
extract(shortcode_atts(array(
    'title' => esc_html__("Title", 'alpha'),
    'subtitle' => "",
    'margin' => '30',
    'alignment' => 'left',
    'el_class' => '',
), $atts));
$el_class = $this->getExtraClass($el_class);

$output .= '<div class="krown-section-title clearfix ' . ' align-' . $alignment . ' ' . $el_class . '" style="margin-bottom:' . $margin . 'px;">';

$output .= '<h3>' . $title . '</h3>';

$output .= '</div>';

echo $output;