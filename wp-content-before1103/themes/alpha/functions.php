<?php

/*---------------------------------
	Setup OptionTree
------------------------------------*/

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
require_once( get_template_directory() . '/option-tree/ot-loader.php' );

function filter_ot_upload_text(){
	return esc_html__( 'Insert', 'alpha' );
}
function filter_ot_header_list(){
	echo '<li id="option-tree-version"><span>' . esc_html__( 'Alpha Options', 'alpha' ) . '</span></li>';
}
function filter_ot_header_version_text(){
	return '1.0.2';
}

add_filter( 'ot_header_list', 'filter_ot_header_list' );
add_filter( 'ot_upload_text', 'filter_ot_upload_text' );
add_filter( 'ot_header_version_text', 'filter_ot_header_version_text');

/*---------------------------------
	Include other files
------------------------------------*/

include( get_template_directory() . '/includes/krown-svg.php' );
include( get_template_directory() . '/includes/extend-vc/init.php' );
include( get_template_directory() . '/includes/theme-options.php' );
include( get_template_directory() . '/includes/customizer-options.php' );
include( get_template_directory() . '/includes/custom-styles.php' );
include( get_template_directory() . '/includes/metaboxes.php' );
include( get_template_directory() . '/includes/plugins.php' );
include( get_template_directory() . '/includes/mpt/init.php' );

if ( ! function_exists( 'aq_resize' ) ) {
	include( get_template_directory() . '/includes/aq_resizer.php' );
}

$js_debug = "false";

/*---------------------------------
	Retina info (by js cookie)
------------------------------------*/

if ( ! function_exists( 'alpha_retina' ) ) {

	function alpha_retina() {

		if ( isset( $_COOKIE['dpi'] ) ) {
			$retina = $_COOKIE['dpi'];
		} else { 
			$retina = false;
		}

		return $retina;

	}

}

if ( class_exists( 'MultiPostThumbnails' ) ) {

	new MultiPostThumbnails( array(
		'label' => esc_html__( 'Mobile Featured Image (3:4)', 'alpha' ),
		'id' => 'mobile-thumbnail',
		'post_type' => 'portfolio'
	) );

}

/*---------------------------------
	A custom pagination function
------------------------------------*/

if ( ! function_exists( 'alpha_pagination' ) ) {

	function alpha_pagination( $query = null, $paginated = false, $range = 2, $echo = true ) {  

		if ( $query == null ) {
			global $wp_query;
			$query = $wp_query;
		}

		$page = $query->query_vars['paged'];
		$pages = $query->max_num_pages;

		if ( $page == 0 ) {
			$page = 1;
		}

		$html = '';

		if( $pages > 1 ) {

			$html .= '<nav class="pagination">';

			if ( ! $paginated ) {

				if ( $page + 1 <= $pages ) {
					$html .= '<a class="prev" href="' . esc_url( get_pagenum_link( $page + 1 ) ) . '">' . '<i class="krown-icon-arrow_left"></i>' . esc_html__( 'Older Post' ,'alpha' ) . '</a>';
				}

				if ( $page - 1 >= 1 ) {
					$html .= '<a class="next" href="' . esc_url( get_pagenum_link( $page - 1 ) ) . '">' . esc_html__( 'Newer Post' ,'alpha' ) . '<i class="krown-icon-arrow_right"></i></a>';
				}

			} else {

				for ( $i = 1; $i <= $pages; $i++ ) {

					if ( $i == 1 || $i == $pages || $i == $page || ( $i >= $page - $range && $i <= $page + $range ) ) {
						$html .= '<a href="' . esc_url( get_pagenum_link( $i ) ) . '"' . ( $page == $i ? ' class="active"' : '' ) . '>' . $i . '</a>';
					} else if ( ( $i != 1 && $i == $page - $range - 1 ) || ( $i != $page && $i == $page + $range + 1 ) ) {
						$html .= '<a class="none">...</a>';
					}

				}

			}
				
			$html .= '</nav>';

		}

		if ( $echo ) {
			echo $html;
		} else {
			return $html;
		}
		 
	}

}

/*---------------------------------
	A custom pagination function
------------------------------------*/


if ( ! function_exists( 'alpha_infinite_pagination' ) ) {

	function alpha_infinite_pagination( $query = null ) {  

		if ( $query == null ) {
			global $wp_query;
			$query = $wp_query;
		}

		$page = $query->query_vars['paged'];
		$pages = $query->max_num_pages;

		if ( $page == 0 ) {
			$page = 1;
		}

		return esc_url( get_pagenum_link( $page + 1 ) );

	}

}


/*---------------------------------
	Make some adjustments on theme setup
------------------------------------*/

if ( ! function_exists( 'alpha_setup' ) ) {

	function alpha_setup() {

		// Make theme available for translation

		load_theme_textdomain( 'alpha', get_template_directory() . '/lang' );

		$locale = get_locale();
		$locale_file = get_template_directory() . "/lang/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
	
		// Define content width (stupid feature, this theme has no width)

		if( ! isset( $content_width ) ) {
			$content_width = 940;
		}
		
		// Add RSS feed links to head

		add_theme_support( 'automatic-feed-links' );

		// Enable excerpts for pages

		add_post_type_support( 'page', 'excerpt' );

		// Enable shortcodes inside text widgets

		add_filter('widget_text', 'do_shortcode');
			
		// Add primary navigation 

		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Navigation', 'alpha' ),
		) );

		// WP 4.1 title tag

		add_theme_support( 'title-tag' );

		// Social meta

		if ( ot_get_option( 'alpha_meta_enable' ) == 'enabled' ) {
			add_filter( 'wp_head', 'alpha_social_meta' );
		}
		
	}

}

add_action( 'after_setup_theme', 'alpha_setup' );

/*---------------------------------
	Insert analytics code into the footer
------------------------------------*/

if ( ! function_exists( 'alpha_analytics' ) ) {

	function alpha_analytics() {
		echo ot_get_option( 'alpha_tracking' );
	}

}

add_filter( 'wp_footer', 'alpha_analytics' );

/*---------------------------------
	Insert social metadata into the header
------------------------------------*/

if ( ! function_exists( 'alpha_social_meta' ) ) {

	function alpha_social_meta() {

		global $post;

		if ( is_single() || is_singular( 'portfolio') ) {

			echo '<!-- social meta start -->';

	        echo '<meta id="meta-ogtitle" property="og:title" content="' . esc_attr( get_the_title() ) . '"/>';
	        echo '<meta id="meta-ogtype" property="og:type" content="article"/>';
	        echo '<meta id="meta-ogurl" property="og:url" content="' . esc_url( get_permalink() ) . '"/>';
	        echo '<meta id="meta-ogsitename" property="og:site_name" content="' . esc_attr( get_bloginfo( 'name' ) ) . '"/>';
			echo '<meta id="meta-description" property="og:description" content="' . wp_strip_all_tags( alpha_excerpt( 'alpha_excerptlength_post' ) ) . '" />';
			echo '<meta id="meta-twittercard" name="twitter:card" value="summary">';

			if ( is_single() && has_post_thumbnail( $post->ID ) ) {

				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_image_src( $thumb, 'large' );
				$img_url = $img_url[0];

				echo '<meta id="meta-itempropimage" itemprop="image" content="' . esc_url( $img_url ) . '"> ';
				echo '<meta id="meta-twitterimg" name="twitter:image:src" content="' . esc_url( $img_url ) . '">';
				echo '<meta id="meta-ogimage" property="og:image" content="' . esc_url( $img_url ) . '" />';

			} 

			echo '<!-- social meta end -->';

		}

	}

}

/*---------------------------------
	Create a wp_nav_menu fallback, to show a home link
------------------------------------*/

function alpha_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'alpha_page_menu_args' );

/*---------------------------------
	Register widget areas
------------------------------------*/

function alpha_widgets_init() {

	register_sidebar( array(
		'name' => esc_html__('Minimal footer widget area', 'alpha'),
		'id' => 'alpha_footer_widget',
		'description' => esc_html__('The minimal footer\'s widget area', 'alpha'),
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => esc_html__('Secondary footer widget area', 'alpha'),
		'id' => 'alpha_footer_widget_sec_1',
		'description' => esc_html__('The secondary footer\'s widget area', 'alpha'),
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );

}  

add_action( 'widgets_init', 'alpha_widgets_init' );

/*---------------------------------
	Remove "Recent Comments Widget" Styling
------------------------------------*/

function alpha_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'alpha_remove_recent_comments_style' );

/*---------------------------------
	Function that replaces the default the_excerpt function
------------------------------------*/

if ( ! function_exists( 'alpha_excerptlength_post' ) ) {

	// Length (words no)
	 
	function alpha_excerptlength_post() {
	    return 15;
	}

}

if ( ! function_exists( 'alpha_excerptlength_post_big' ) ) {

	// Length (words no)
	 
	function alpha_excerptlength_post_big() {
	    return 50;
	}

}

if ( ! function_exists( 'alpha_excerptmore' ) ) {

	// More text

	function alpha_excerptmore() {
	    return ' ...';
	}

}

function complete_excerpt( ) {

}

if ( ! function_exists( 'alpha_excerpt' ) ) {

	// The actual function
	
	function alpha_excerpt( $length_callback = '', $more_callback = 'alpha_excerptmore' ) {

	    global $post;
		
	    if ( function_exists( $length_callback ) ) {
			add_filter( 'excerpt_length', $length_callback );
	    }
		
	    if ( function_exists( $more_callback ) ){
			add_filter( 'excerpt_more', $more_callback );
	    }
		
	    $output = get_the_excerpt();

	    if ( empty( $output ) ) {

	    	// If the excerpt is empty (on pages created 100% with shortcodes), we should take the content, strip shortcodes, remove all HTML tags, then return the correct number of words

	    	$output = strip_tags( preg_replace( "~(?:\[/?)[^\]]+/?\]~s", '', $post->post_content ) );
	    	$output = explode( ' ', $output, $length_callback() );
	    	array_pop( $output );
	    	$output = implode( ' ', $output ) . $more_callback();

	    } else {

	    	// Continue with the regular excerpt method

		    $output = apply_filters( 'wptexturize', $output );
		    $output = apply_filters( 'convert_chars', $output );

	    }
		
	    return $output;
		
	}   

}

/*--------------------------------
	Function that returns all categories of a custom post
------------------------------------*/

function alpha_categories( $post_id, $taxonomy, $delimiter = ', ', $get = 'name', $echo = true, $link = false ){

	$tags = wp_get_post_terms( $post_id, $taxonomy );
	$list = '';
	foreach( $tags as $tag ){
		if ( $link ) {
			$list .= '<a href="' . get_category_link( $tag->term_id ) . '"> ' . $tag->$get . '</a>' . $delimiter;
		} else {
			$list .= $tag->$get . $delimiter;
		}
	}

	if ( $echo ) {
		echo substr( $list, 0, strlen($delimiter)*(-1) );
	} else { 
		return substr( $list, 0, strlen($delimiter)*(-1) );
	}

}

/*---------------------------------
	Redefine the search form structure
------------------------------------*/

if ( ! function_exists( 'alpha_search_form' ) ) {

	function alpha_search_form( $form ) {

	    $form = '
		<form role="search" method="get" id="searchform" class="hover-show" action="' . esc_url( home_url( '/' ) ) . '" >
			<input type="search" placeholder="' . esc_html__( 'Search in our site', 'alpha' ) . '" name="s" id="s" />
			<input id="submit_s" type="submit" />
	    </form>';
	    return $form;
		
	}

}

add_filter( 'get_search_form', 'alpha_search_form' );


/*---------------------------------
	Custom header
------------------------------------*/

function alpha_header_color() {

	global $post;

	if ( isset( $post ) ) {

		if ( is_single() || is_singular( 'portfolio' ) ) {
			echo get_post_meta( $post->ID, 'alpha_folio_featured_style', true ) != '' ? get_post_meta( $post->ID, 'alpha_folio_featured_style', true ) : 'light';
		} else if ( is_page_template( 'template-portfolio.php' ) ) {
			if ( get_post_meta( $post->ID, 'pre_enable', true ) == 'yes' ) {
				echo get_post_meta( $post->ID, 'pre_bgstyle', true );
			} else {
				//echo get_post_meta( $post->ID, 'alpha_folio_featured_style', true );
			}
		} else {
			echo get_post_meta( $post->ID, 'header_bystyle', true ) != '' ? get_post_meta( $post->ID, 'header_bystyle', true ) : 'light';
		}

	}

}

function alpha_header_style() {

	global $post;

	if ( ( isset( $post ) && ( is_single() || is_singular( 'portfolio' ) || is_page_template( 'template-portfolio.php' ) || get_post_meta( $post->ID, 'header_enable', true ) == 'yes' ) ) || is_404() ) {
		if ( is_singular( 'portfolio' ) ) {
			return 'overlap before-load';
		} else {
			return 'overlap';
		}
	} else {
		return 'overtop';
	}

}


add_filter( 'body_class', 'alpha_class_names' );
function alpha_class_names( $classes ) {
	$classes[] = 'no-touch no-js ' . alpha_header_style();
	return $classes;
}

/*---------------------------------
	Color conversion functions
------------------------------------*/

function alpha_hex_to_rgba($hex, $a) {

   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }

   return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $a . ')';
   
}

/*---------------------------------
	Fix empty search issue
------------------------------------*/

function alpha_request_filter( $query_vars ) {

    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }

    return $query_vars;
}

add_filter('request', 'alpha_request_filter');

/*---------------------------------
	Sharing buttons
------------------------------------*/

if ( ! function_exists( 'alpha_share_buttons' ) ) {

	function alpha_share_buttons( $post_id ) {

		$html = '<aside class="share-buttons">';

		$url = urlencode( get_permalink( $post_id ) );
		$title = urlencode( get_the_title( $post_id ) );
		$media = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' );

		$html .= '<a target="_blank" href="' . esc_url( 'https://twitter.com/home?status=' . $title . '+' . $url ) . '"><i class="fa fa-twitter"></i></a>';

		$html .= '<a target="_blank" href="' . esc_url( 'https://www.facebook.com/share.php?u=' . $url . '&title=' . $title ) . '"><i class="fa fa-facebook"></i></a>';

		$html .= '<a target="_blank" href="' . esc_url( 'http://pinterest.com/pin/create/bookmarklet/?media=' . $media[0] . '&url=' . $url . '&is_video=false&description=' . $title ) . '"><i class="fa fa-pinterest-p"></i></a>';

		$html .= '<a target="_blank" href="' . esc_url( 'https://plus.google.com/share?url=' . $url ) . '"><i class="fa fa-google-plus"></i></a>';

		$html .= '</aside>';

		echo $html;

	}

}

/*---------------------------------
	Enqueue front scripts
------------------------------------*/

function alpha_enqueue_scripts() {

	global $post;
	global $js_debug;

	wp_deregister_style('wp-mediaelement');

	wp_enqueue_style( 'fontawesome', esc_url( get_template_directory_uri() . '/css/font-awesome.min.css' ) );

	if ( $js_debug === "true" ) {

		// Third party scripts

		wp_enqueue_script( 'jquery-easing', get_template_directory_uri() . '/js/libraries/jquery.easing.1.3.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'hammer', get_template_directory_uri() . '/js/libraries/hammer.min.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'fitvid', get_template_directory_uri() . '/js/libraries/fitvid.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/libraries/jquery.fancybox.pack.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/js/libraries/jquery.flexslider-min.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'jquery-history', get_template_directory_uri() . '/js/libraries/jquery.history.min.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'mousewheel', get_template_directory_uri() . '/js/libraries/jquery.mousewheel.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'tweenlite', get_template_directory_uri() . '/js/libraries/TweenLite.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'gs-CSSPlugin', get_template_directory_uri() . '/js/libraries/CSSPlugin.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'gs-ScrollToPlugin', get_template_directory_uri() . '/js/libraries/ScrollToPlugin.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'maskee', get_template_directory_uri() . '/js/libraries/jquery.maskee.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );

		// Theme scripts

		wp_enqueue_script( 'alpha-theme_scripts_a', get_template_directory_uri() . '/js/uncompressed/general.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'alpha-theme_scripts_b', get_template_directory_uri() . '/js/uncompressed/shortcodes.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'alpha-theme_scripts_c', get_template_directory_uri() . '/js/uncompressed/blog.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );
		wp_enqueue_script( 'alpha-theme_scripts_d', get_template_directory_uri() . '/js/uncompressed/portfolio.js?cache_control=' . rand(100, 10000), array('jquery'), NULL, true );

		wp_enqueue_style( 'alpha-style', get_stylesheet_uri() . '?cache_control=' . rand(100, 10000) );

		wp_localize_script(
			'alpha-theme_scripts_c', 
			'langObj',
			array(
				'post_comment'  => esc_html__( 'Post comment', 'alpha' ),
				'posted_comment'  => esc_html__( 'Your comment was posted and it is awaiting moderation.', 'alpha' ),
				'duplicate_comment'  => esc_html__( 'Duplicate content detected. It seems that you\'ve posted this before.', 'alpha' ),
				'posting_comment'  => esc_html__( 'Posting your comment, please wait...', 'alpha' ),
				'required_comment'  => esc_html__( 'Please complete all the required fields.', 'alpha' ),
			)
		);

	} else {

		// Compressed theme scripts

		wp_enqueue_script( 'alpha_theme_plugins', get_template_directory_uri() . '/js/compressed/plugins-min.js', array('jquery'), NULL, true );
		wp_enqueue_script( 'alpha_theme_scripts', get_template_directory_uri() . '/js/compressed/scripts-min.js', array('jquery'), NULL, true );

		wp_enqueue_style( 'alpha-style', get_stylesheet_uri() );

		wp_localize_script(
			'alpha_theme_scripts', 
			'langObj',
			array(
				'post_comment'  => esc_html__( 'Post comment', 'alpha' ),
				'posted_comment'  => esc_html__( 'Your comment was posted and it is awaiting moderation.', 'alpha' ),
				'duplicate_comment'  => esc_html__( 'Duplicate content detected. It seems that you\'ve posted this before.', 'alpha' ),
				'posting_comment'  => esc_html__( 'Posting your comment, please wait...', 'alpha' ),
				'required_comment'  => esc_html__( 'Please complete all the required fields.', 'alpha' ),
			)
		);

	}

	// Dependent

	wp_register_script( 'googlemaps', esc_url( 'https://maps.googleapis.com/maps/api/js?sensor=false' ), NULL, true );
	
	if ( isset( $post ) ) {

		if ( is_single() ) {
			wp_enqueue_script( 'comment-reply' );
		} else {
			wp_dequeue_script( 'comment-reply' );
		}

		if ( is_page_template( 'template-contact.php' ) ) {
			wp_enqueue_script( 'googlemaps' );
		}

	}

	// We need to pass some useful variables to the theme scripts through the following function

	$colors = get_option( 'alpha_colors' );

}

add_action( 'wp_enqueue_scripts', 'alpha_enqueue_scripts', 100 );

// The function below deregisters the scripts embedded through the Visual Composer plugin. This is needed because i have rewritten most of the shortcode from the plugin and the theme will load the proper scripts & styles anyway.

function alpha_handle_jscomp_scripts() {
	wp_dequeue_style( array( 'js_composer_front', 'font-awesome-css', 'flexslider', 'nivo-slider-css', 'nivo-slider-theme', 'prettyphoto', 'isotope-css' ) );
    wp_deregister_style( array( 'js_composer_front', 'font-awesome-css', 'flexslider', 'nivo-slider-css', 'nivo-slider-theme', 'prettyphoto', 'isotope-css' ) );
	wp_dequeue_script( array( 'wpb_composer_front_js', 'flexslider', 'isotope', 'tweet', 'jcarousellite', 'nivo-slider', 'waypoints', 'prettyphoto', 'jquery_ui_tabs', 'jquery_ui_tabs_rotate' ) );
    wp_deregister_script( array( 'wpb_composer_front_js', 'flexslider', 'isotope', 'tweet', 'jcarousellite', 'nivo-slider', 'waypoints', 'prettyphoto', 'jquery_ui_tabs', 'jquery_ui_tabs_rotate' ) );
}

add_action( 'wp_enqueue_scripts', 'alpha_handle_jscomp_scripts', 99 );

// Enqueue lazy load 

function alpha_lazy_load() {
	echo "<script type='text/javascript'>
		document.addEventListener('DOMContentLoaded', function(){
			var content = document.getElementById('content'),
				images = content.getElementsByTagName('img');
			for ( var i = 0; i < images.length; i++ ) {
				if ( images[i].getAttribute('data-lazyload') != 'innoway' ) {
					images[i].setAttribute('data-lazyload', 'please');
				}
				images[i].setAttribute('data-src', images[i].getAttribute('src'));
				images[i].setAttribute('src', '');
			}
		});
	</script>";
}
add_action( 'wp_head', 'alpha_lazy_load' );

/*---------------------------------
	Enqueue admin styles
------------------------------------*/

function alpha_admin_scripts() {
	wp_enqueue_style( 'alpha-admin', get_template_directory_uri() . '/css/admin-style.css' );
}

add_action( 'admin_enqueue_scripts', 'alpha_admin_scripts' );

/* ------------------------
-----   Filter Video Shortcode   -----
------------------------------*/

function alpha_video_shortcode($content) {
	$keyword = strpos( $content, 'poster' ) > 0 ? "poster" : "preload";
    return preg_replace( "(width=.+$keyword)", "width='100%' height='100%' style='width:100%;height:100%' $keyword", $content );
}
add_filter('wp_video_shortcode', 'alpha_video_shortcode');


/*---------------------------------
	Custom styling for TinyMCE
------------------------------------*/

// Add a series of predefined text types

if ( ! function_exists( 'alpha_mce_custom_styles' ) ) {

	function alpha_mce_custom_styles($settings) {

	    $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';

	    $style_formats = array(
	        array('title' => 'Large', 'inline' => 'span', 'classes' => 'large'),
	        array('title' => 'Medium', 'inline' => 'span', 'classes' => 'medium'),
	        array('title' => 'Cite', 'inline' => 'cite', 'classes' => '')
	    );

	    $settings['style_formats'] = json_encode( $style_formats );

	    return $settings;
	    
	}

}

add_filter('tiny_mce_before_init', 'alpha_mce_custom_styles');

// Customize TinyMCE editor font sizes

if ( ! function_exists( 'alpha_mce_text_sizes' ) ) {

	function alpha_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
		return $initArray;
	}

}

add_filter( 'tiny_mce_before_init', 'alpha_mce_text_sizes' );

// Add new buttons to the TinyMCE interface

if ( ! function_exists( 'alpha_mce_buttons' ) ) {

	function alpha_mce_buttons( $buttons ) {

		array_unshift( $buttons, 'fontsizeselect' );
    	array_unshift( $buttons, 'styleselect');
		return $buttons;
	}

}

add_filter( 'mce_buttons_2', 'alpha_mce_buttons' );

/*---------------------------------
    Update Notice
------------------------------------*/

add_action( 'admin_notices', 'alpha_update_notice' );

function alpha_update_notice() {

	if ( get_option( 'alpha_koncept_version' ) == null ) {
        update_option( 'alpha_koncept_version', '1.0.2' );
	} else if ( get_option( 'alpha_koncept_version' ) != '1.0.2' ) {

        echo '<div class="updated" style="position: relative;">
        	<h4>You have just updated to version 1.0.2 - <a style="text-decoration" href="' . esc_url( admin_url( 'themes.php?page=ot-theme-options&alpha_update_done_do=1#section_log' ) ) . '">' . esc_html__( 'Read the CHANGELOG', 'alpha' ) . '</a></h4>';

        printf('<em style="position: absolute; top: 18px; right: 20px;"><a href="%1$s">' . esc_html__( 'Dismiss', 'alpha' ) . '</a></em>', '?alpha_update_done_do=1');

        echo "<p></p></div>";

	}

}
add_action( 'admin_init', 'alpha_update_done_do' );

function alpha_update_done_do() {
	global $current_user;
    $user_id = $current_user->ID;
    if ( isset( $_GET['alpha_update_done_do'] ) && '1' == $_GET['alpha_update_done_do'] ) {
        update_option( 'alpha_koncept_version', '1.0.2' );
	}
}

/*---------------------------------
    Navigation Walker
------------------------------------*/

class Alpha_Nav_Walker extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth=0, $args=array() ) {
    	if ( $depth == 0 ) {
        	$output .= '<ul class="sub-menu">';
    	} else if ( $depth == 1 ) {
        	$output .= '<ul class="third-menu">';
    	}
    }

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){

        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }

    function start_el( &$output, $object, $depth=0, $args=array(), $current_object_id=0 ) {

        global $wp_query;
        global $rb_submenus;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $new_output = '';
        $depth_class = ( $args->has_children ? 'parent ' : '' );

        $class_names = $value = $selected_class = '';
        $classes = empty( $object->classes ) ? array() : ( array ) $object->classes;

        $current_indicators = array('current-menu-item', 'current-menu-parent', 'current_page_item', 'current_page_parent', 'current-menu-ancestor');

        foreach ( $classes as $el ) {
            if ( in_array( $el, $current_indicators ) ) {
                $selected_class = 'selected ';
            }
        }

        if ( is_singular('portfolio' ) ) {
        	$selected_class = '';
        }

        $class_names = ' class="' . $selected_class . $depth_class . 'menu-item' . ( ! empty( $classes[0] ) ? ' ' . $classes[0] : '' ) . '"';

        if ( ! get_post_meta( $object->object_id , '_members_only' , true ) || is_user_logged_in() ) {
            $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $class_names . '>';
        }

        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

        $object_output = $args->before;
        $object_output .= '<a' . $attributes . '>';
        $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;
        $object_output .= $depth == '0' && $args->has_children ? alpha_svg( 'arrow_down' ) : '';
        $object_output .= '</a>';
        $object_output .= $args->after;

        if ( !get_post_meta( $object->object_id, '_members_only' , true ) || is_user_logged_in() ) {

            $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );

        }

        $output .= $new_output;

    }

    function end_el(&$output, $object, $depth=0, $args=array()) {

        if ( !get_post_meta( $object->object_id, '_members_only' , true ) || is_user_logged_in() ) {
            $output .= "</li>\n";
        }

    }
    
    function end_lvl(&$output, $depth=0, $args=array()) {

        $output .= "</ul>\n";

    }

}

?>