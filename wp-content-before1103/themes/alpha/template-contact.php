<?php
/**
 * Template Name: Contact
 */
get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article>

			<?php if ( get_post_meta( $post->ID, 'header_enable', true )  == 'yes' ) : ?>
				
				<header id="page-header" class="uninit" style="background-color: <?php echo get_post_meta( $post->ID, 'header_bgcolor', true ) . ( get_post_meta( $post->ID, 'header_bgimg', true ) != '' ? '; background-image: url(' . get_post_meta( $post->ID, 'header_bgimg', true ) . ')' : '' ); ?>;" data-height="<?php echo esc_attr( get_post_meta( $post->ID, 'header_height', true ) ); ?>" data-background="<?php echo esc_url( get_post_meta( $post->ID, 'header_bgstyle', true ) ); ?>">
					<div>
						<div class="page-header-type">
							<h1><?php echo get_post_meta( $post->ID, 'header_title', true ); ?></h1>
							<h2 class="subtitle"><?php echo get_post_meta( $post->ID, 'header_subtitle', true ); ?></h2>
						</div>
					</div>
				</header>

			<?php endif; ?>

			<?php if ( get_post_meta( $post->ID, 'alpha_show_map', true ) == 'w-custom-header-map' ) : ?>

				<div id="map-header">
					<div id="map-contact" class="insert-map" data-map-lat="<?php echo esc_attr( get_post_meta( $post->ID, 'alpha_map_lat', true ) ); ?>" data-map-long="<?php echo esc_attr( get_post_meta( $post->ID, 'alpha_map_long', true ) ); ?>" data-marker-img="<?php echo esc_url( get_post_meta( $post->ID, 'alpha_map_img', true ) ); ?>" data-zoom="<?php echo esc_attr( get_post_meta( $post->ID, 'alpha_map_zoom', true ) ); ?>" data-greyscale="d-<?php echo esc_attr( get_post_meta( $post->ID, 'alpha_map_style', true ) ); ?>" data-marker="d-<?php echo esc_attr( get_post_meta( $post->ID, 'alpha_map_marker', true ) ); ?>"></div>
				</div>

			<?php endif; ?>

			<section id="page-content">

			<?php

				the_content();

				wp_link_pages( array(
					'before' => '<p class="wp-link-pages"><span>' . esc_html__( 'Pages:', 'alpha' ) . '</span>'
					)
				);

				if( comments_open() && ot_get_option( 'rb_allow_page_comments', 'false' ) == 'true' ) {
					comments_template( '', true );
				}

			?>

			</section>

		</article>

	<?php endwhile;     

get_footer(); ?>