<?php

$output = $el_class = $image = $img_size = $img_link = $img_link_target = $img_link_large = $title = $alignment = $css_animation = '';

extract(shortcode_atts(array(
    'title' => '',
    'image' => $image,
    'img_size'  => 'full',
    'img_link_large' => false,
    'img_link_custom' => '',
    'img_link_target' => '_self',
    'alignment' => 'left',
    'el_class' => '',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$el_class = $this->getExtraClass($el_class);
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-single-image'.$el_class, $this->settings['base']);

$link_to = '';
if (!empty($img_link_custom)) {
    $link_to = $img_link_custom;
}

$img = wp_get_attachment_image_src( $image, 'full' );
$alt = get_post_meta($image, '_wp_attachment_image_alt', true);

if ( $img == NULL ) {
    echo 'null';
    $img_obj = '<img src="' . esc_url( 'http://placehold.it/400/300"' ) . '" /> <small>'.esc_html__('This is image placeholder, edit your page to replace it.', 'alpha').'</small>';
} else {

    $img_small = aq_resize( $img[0], 840 );
    $img_medium = aq_resize( $img[0], 1280 );
    $img_large = aq_resize( $img[0], 1920 );

    $img_obj = '<img' . ( empty( $link_to ) ? ' class="krown-single-image ' . $el_class . '"' : '' ) . ' src="' . $img_large . '" srcset="' . $img_small . ' 840w, ' . $img_medium . ' 1280w, ' . $img_large . ' 1920w" alt="' . $alt . '" />';

}

$image_string = !empty($link_to) ? '<a class="krown-single-image ' . $el_class . '" href="'.esc_url($link_to).'"'.($img_link_target!='_self' ? ' target="'.$img_link_target.'"' : '').'>'.$img_obj.'</a>' : $img_obj;

$output .= "\n\t\t\t".'<div class="krown-image-holder">'.$image_string.'</div>';

echo $output;