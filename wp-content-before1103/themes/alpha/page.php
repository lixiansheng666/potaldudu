<?php
/**
 * The Template for displaying all pages.
 */
get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<article>

			<?php if ( get_post_meta( $post->ID, 'header_enable', true )  == 'yes' ) : ?>
				
				<header id="page-header" class="uninit" style="background-color: <?php echo get_post_meta( $post->ID, 'header_bgcolor', true ) . ( get_post_meta( $post->ID, 'header_bgimg', true ) != '' ? '; background-image: url(' . esc_url( get_post_meta( $post->ID, 'header_bgimg', true ) ) . ')' : '' ); ?>;" data-height="<?php echo esc_attr( get_post_meta( $post->ID, 'header_height', true ) ); ?>" data-background="<?php echo esc_attr( get_post_meta( $post->ID, 'header_bgstyle', true ) ); ?>">
					<div>
						<div class="page-header-type">
							<h1><?php echo get_post_meta( $post->ID, 'header_title', true ); ?></h1>
							<h2 class="subtitle"><?php echo get_post_meta( $post->ID, 'header_subtitle', true ); ?></h2>
						</div>
					</div>
				</header>

			<?php endif; ?>

			<section id="page-content">

				<div class="page-text clearfix <?php echo get_post_meta( $post->ID, 'alpha_using_vc', true ); ?>">

					<?php if ( get_post_meta( $post->ID, 'header_enable', true ) != 'yes' ) : ?>
						<h1><?php the_title(); ?></h1>
					<?php endif; ?>

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

				</div>

			</section>

		</article>

	<?php endwhile;     

get_footer(); ?>