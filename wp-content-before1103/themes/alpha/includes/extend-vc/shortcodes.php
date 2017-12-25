<?php

// This file contains some new shortcodes for the Visual Composer plugin - custom shortcodes made by me

// Gallery

function alpha_gallery_function( $attr ) {

    global $post;

    $post = get_post();

    static $instance = 0;
    $instance++;

    if ( ! empty( $attr['ids'] ) ) {
        if ( empty( $attr['orderby'] ) ) {
            $attr['orderby'] = 'post__in';
        }
        $attr['include'] = $attr['ids'];
    }

    $html = apply_filters( 'post_gallery', '', $attr );
    if ( $html != '' ) {
        return $html;
    }

    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] ) {
            unset( $attr['orderby'] );
        }
    }

    extract( shortcode_atts( array(
        'order'          => 'ASC',
        'orderby'        => 'menu_order ID',
        'id'             => $post->ID,
        'include'        => '',
        'exclude'        => '',
        'type'           => 'thumbs',
        'columns'        => '3',
        'width'          => 'null',
        'lightbox'       => 'false',
        'grid'           => 'false'
    ), $attr ) );

    $id = intval( $id );
    if ( 'RAND' == $order ) {
        $orderby = 'none';
    }

    if ( ! empty( $include ) ) {

        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();

        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }

    } else if ( ! empty( $exclude ) ) {
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty( $attachments ) ) {
        return '';
    }

    if ( is_feed() ) {
        $html = "\n";
        foreach ( $attachments as $att_id => $attachment ) {
            $html .= wp_get_attachment_link($att_id, $size, true) . "\n";
        }
        return $html;
    }

    $slides = '';

    $thumbs_col = 100 / $columns;
    $thumbs_width = floor(1926 / $columns);

    $i = 0;

    foreach ( $attachments as $id => $attachment ) {

        $link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_image_src( $id, 'full', false, false ) : wp_get_attachment_image_src( $id, 'full', true, false );

        $caption = get_post( $id )->post_excerpt;
        $title = get_post( $id )->post_title;

        $extra_class = '';
        if ( $i % $columns == 0 ) {
            $extra_class = ' first';
        }
        if ( ++$i % $columns == 0 ) {
            $extra_class = ' last';
        } 

        if ( $type == 'slider' ) {

            $slides .= '<li>';

            if ( $lightbox == 'true') {
                $slides .= '<a href="' . esc_url( $link[0] ) . '" class="fancybox fancybox-thumb">';
            }

            if ( $grid == 'true' ) {
                $link[0] = aq_resize( $link[0], '680', null );
            }

            $img_small = aq_resize( $link[0], 840 );
            $img_medium = aq_resize( $link[0], 1280 );
            $img_large = aq_resize( $link[0], 1920 );

            $slides .= '<img src="' . esc_url( $img_large ) . '" srcset="' . esc_url( $img_small ) . ' 840w, ' . esc_url( $img_medium ) . ' 1280w, ' . esc_url( $img_large ) . ' 1920w" alt="' . esc_attr( $caption ) . '" />';

            if ( $lightbox == 'true') {
                $slides .= '</a>';
            }

            if ( isset( $caption ) && $caption != '' ) {
                $slides .= '<p class="flex-caption">'. $caption . '</p>';
            }

            $slides .= '</li>';


        } else {

        	$alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
            $slides .= '<a class="fancybox fancybox-thumb' . $extra_class . '" data-fancybox-group="gallery-' . $instance . '" data-fancybox-title="' . $caption . '" href="' . esc_url( $link[0] ) . '" style="width:' . $thumbs_col . '%"><img src="' . aq_resize( $link[0], $thumbs_width, $thumbs_width, true ) . '" alt="' . esc_attr( $alt ) . '" /></a>';

        }

    }

    if ( $type == 'slider' ) {

        $html = '<div class="flexslider mini"><ul class="slides">' . $slides . '</ul></div>';

    } else {

        $html = '<div class="krown-thumbnail-gallery clearfix">' . $slides . '</div>';

    }

    return $html;

}

remove_shortcode( 'gallery', 'gallery_shortcode' );
add_shortcode( 'gallery', 'alpha_gallery_function' );

// Contact Form


function icon_function( $atts, $content ) {

    extract( shortcode_atts( array( 
        'name' => 'none',
        'size' => 'lg',
        'color' => '#000',
        'stack' => 'inline',
        'margin' => '0'
    ), $atts ) );

    $output = '<i class="fa fa-' . $name . ' fa-' . $size . ' ' . $stack . '" style="color:' . $color . '; margin-bottom:' . $margin . 'px"></i>';
    return $output;

}

add_shortcode( 'icon', 'icon_function' );

function button_function( $atts, $content ) {
    
    extract( shortcode_atts( array( 
        'href' => '',
        'size' => 'normal',
        'style' => 'dark',
        'label' => 'Button',
        'target' => '',
        'el_class' => ''
    ), $atts ) );

    $output = '<a class="krown-button ' . $size . ' ' . $style . ' ' . $el_class . '" href="' . esc_url( $href ) . '"' . ( $target != '' ? ' target="' . $target . '"' : '' ) . '>' . esc_html( $label ) . '</a>';
    return $output;

}

add_shortcode( 'button', 'button_function' );

// Icon Text Block

// Portfolio Grid

function vc_portfolio_grid_function( $atts, $content ) {

    extract( shortcode_atts( array(
        'el_class'     => '',
        'no'           => '4',
        'cols'         => '2',
        'ratio'        => '16:9',
        'cat'          => '',
    ), $atts ) );

    global $post;

    // Fix categories

    if ( $cat == '' ) {

        $cat_temp = get_categories( array( 'taxonomy' => 'portfolio_category' ) );
        foreach ( $cat_temp as $t ) {
            $cat .= $t->slug . ',';
        }
        $cat = substr( $cat, 0, -1 );

    }

    // Start shortcode 

    $html = '<div class="krown-portfolio cols-' . $cols . '' . ( $el_class != '' ? ' ' . $el_class : '' ) . '">
        <ul class="krown-portfolio-grid clearfix">';

    $args = array(
        'posts_per_page' => $no,
        'portfolio_category'  => $cat,
        'post_type' => 'portfolio' 
    );

    $all_posts = new WP_Query( $args );

    while( $all_posts->have_posts() ) : $all_posts->the_post();

        $style = get_post_meta( $post->ID, 'alpha_folio_featured_style', true );

        $img = wp_get_attachment_url( get_post_thumbnail_id() );

        $img_small = aq_resize( $img, 840 );
        $img_medium = aq_resize( $img, 1280 );
        $img_large = aq_resize( $img, 1920 );

        $html .= '<li class="item">

            <a class="ratio-' . str_replace(':', '', $ratio ) .' clearfix" href="' . esc_url( get_permalink( $post->ID ) ) . '" data-bg-small="' . esc_url( $img_small ) . '" data-bg-medium="' . esc_url( $img_medium ) . '" data-bg-large="' . esc_url( $img_large ) . '">

                <div class="caption ' . $style . '">
                	<h3>' . get_the_title() . '</h3>
                	<span>' . alpha_categories( $post->ID, 'portfolio_category', ', ', 'name', false ) . '</span>
                </div>

            </a>

        </li>';

    endwhile;

    wp_reset_query();

    $html .= '</ul>';

    $html .= '</div>';

    return $html;

}

add_shortcode( 'vc_portfolio_grid', 'vc_portfolio_grid_function' );

// Social Icons

function vc_social_links_function( $atts, $content ) {

	extract( shortcode_atts( array(
        'el_class'  => '',
        'target' => '_self'
    ), $atts ) );

    $output = '<div class="krown-social clearfix' . ( $el_class != '' ? ' ' . $el_class : '' ) . '"><ul>';

    foreach ( $atts as $type => $href ) {

    	if ( $type != 'target' && $type != 'el_class' ) {

	    	if ( $type == 'email' ) {
	    		$icon = 'fa fa-fw fa-envelope-o';
	    	} else if ( $type == 'googleplus' ) {
	    		$icon = 'fa fa-fw fa-google-plus';
	    	} else if ( $type == 'vimeo' ) {
	    		$icon = 'fa fa-fw fa-vimeo-square';
	    	} else {
	    		$icon = 'fa fa-fw fa-' . $type;
	    	}

	    	$output .= '<li><a target="' . $target . '" href="' . esc_url( $href ) . '"><i class="' . $icon . '"></i></a></li>';

    	}

    }

    $output .= '</ul></div>';

	return $output;

}

add_shortcode( 'vc_social_links', 'vc_social_links_function' );


?>