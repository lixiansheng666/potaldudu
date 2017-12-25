<?php
$output = $title = $interval = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'nav_bullets' => 'none',
    'nav_arrows' => 'none',
    'el_class' => '',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$el_class = $this->getExtraClass($el_class);

if ( 'vc_tour' == $this->shortcode) {

	$output = '<div class="flexslider krown-tour nav-bullets-' . $nav_bullets . ( $el_class != '' ? ' ' . $el_class : '' ) . '" data-nav-bullets="' . $nav_bullets . '" data-nav-arrows="' . $nav_arrows . '"  data-autoplay="' . $interval*1000 . '">
			<div class="slides">' . do_shortcode( $content ) . '</div>
		</div>';

} else {

	$element = 'krown-tabs';

	// Extract tab titles

	preg_match_all( '/\[vc_tab[\s]*title="([^\"]+)"[\s]*tab_id="([^\"]+)"[\s]*icon="([^\"]+)"\]/i', $content, $matches, PREG_SET_ORDER );

	if ( empty( $matches ) || sizeof( $matches ) == 0 ) {
		esc_html_e( "This shortcode isn't properly configured. Please review it.", 'alpha' );
		return;
	}

	$tabs_nav = '<ul class="titles clearfix' . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>';
	$tabs_width = 100 / sizeof($matches);
	foreach ( $matches as $tab ) {
	    if(isset($tab[0])) {
	        $tabs_nav .= '<li><h5 href="#tab-' . $tab[2] .'" class="' . $tab[3] . '">' . $tab[1] . '</h5></li>';
	    }
	}
	$tabs_nav .= '</ul>'."\n";

	$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.' clearfix ' .$el_class), $this->settings['base']);

	$output .= "\n\t".'<div class="'.$css_class.'">';
	$output .= "\n\t\t\t".$tabs_nav;
	$output .= "\n\t\t\t".'<div class="contents">'.wpb_js_remove_wpautop($content).'</div>';
	$output .= "\n\t".'</div> '.$this->endBlockComment($element);

}

echo $output;