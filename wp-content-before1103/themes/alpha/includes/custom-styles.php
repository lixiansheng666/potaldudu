<?php 
/**
 * This file contains the output of the WordPress Theme Customizer (frontend)
 */

if( ! function_exists( 'alpha_custom_css' ) ) {

	function alpha_custom_css() {

		// Get Options

		$f_head = is_serialized( get_option('alpha_type_heading' ) ) ? unserialize( get_option('alpha_type_heading' ) ) : array( 'default' => true, 'font-family' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );
		$f_body = is_serialized( get_option( 'alpha_type_body' ) ) ? unserialize( get_option( 'alpha_type_body' ) ) : array( 'default' => true, 'font-family' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );
		$f_quote = is_serialized( get_option( 'alpha_type_quotes' ) ) ? unserialize( get_option( 'alpha_type_quotes' ) ) : array( 'default' => true, 'font-family' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );
		
		$colors = get_option( 'alpha_colors' );
		if ( ! isset( $colors['main1'] ) || $colors['main1'] == '' ) {
			$colors['main1'] = '#b99d61';
		}

		$protocol = is_ssl() ? 'https' : 'http';

		// Enequeue Google Fonts

		// - actual font load

		if ( ! isset( $f_head['default'] ) ) {
			wp_enqueue_style( 'krown-font-head', esc_url( "$protocol://fonts.googleapis.com/css?family=" . $f_head['css-name'] . ":400,700" ) );
		}

		if ( $f_body != $f_head && ! isset( $f_body['default'] ) ) {
			wp_enqueue_style( 'krown-font-body', esc_url( "$protocol://fonts.googleapis.com/css?family=" . $f_body['css-name'] . ":300,400,400italic,500,600,700,700italic" ) );
		}

		if ( $f_body != $f_quote && $f_head != $f_quote && ! isset( $f_quote['default'] ) ) {
			wp_enqueue_style( 'krown-font-quote', esc_url( "$protocol://fonts.googleapis.com/css?family=" . $f_quote['css-name'] . ":400,400italic" ) );
		}


		// Create Custom CSS

		$custom_css = '

			/* CUSTOM FONTS */

			h1, h2, h3, h4, h5, h6, span.medium, span.large, #main-menu.style-full .top-menu li a, .post-nav > a .subtitle, .post-nav > a .title, .post-header .title h1, .post-header .title h2, post-header > span.subtitle, .infinite-text, .main-post .post-header span, .page-header-type h1, .krown-button, input[type="submit"], .post-header > span.subtitle {
			  font-family: ' . $f_head['font-family'] . ';
			}

			body, input, textarea, button {
			  font-family: ' . $f_body['font-family'] . ';
			}

			.page-header .subtitle, .post-header > span.author, .page-header-type h2.subtitle, .krown-portfolio span {
				font-family: ' . $f_quote['font-family'] . ';
			}

			/* CUSTOM COLORS */

			a, #main-menu.style-full .top-menu li a:hover, #main-menu.style-full .top-menu li.selected > a {
				color: ' . $colors['main1'] . ';
			}
			.pre-slide .page-header .title:after, .page-header-type h1:after, .krown-section-title h3:after, .krown-section-title h4:after, .post-content h3:after, .post-content h4:after, .line-link:after, .fancybox-nav span:hover, .fancybox-close:hover, input[type="submit"]:hover, #footer input[type="submit"]:hover {
				background-color: ' . $colors['main1'] . ';
			}

			/* CUSTOM CSS */

		';

		$custom_css .= ot_get_option( 'alpha_custom_css_code', '' );

		// Embed Custom CSS

		wp_add_inline_style( 'alpha-style', $custom_css );

	}

}

add_action( 'wp_enqueue_scripts', 'alpha_custom_css', 101 );


// Because of the way the admin bar works, it really breaks the layout of the theme into pieces (it adds bad margin at the top, thus making everything smaller). So we need a bulletproof solution to make sure that the admin bar will not interfer with the user editing (we keep it, but we minimalize it)

if ( ! function_exists( 'lobo_custom_admin_bar_soft' ) ) {

	function lobo_custom_admin_bar_soft() {

		echo '<style type="text/css">

			html, * html body {
				margin-top: 0 !important;
			}

			#wpadminbar {
				background: rgba(0, 0, 0, .4) !important;
				opacity: .7 !important;
				-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=70)" !important;
				filter: alpha(opacity=70) !important;
			}

		</style>';

	}

}

add_action( 'wp_head', 'lobo_custom_admin_bar_soft', 99 );



?>