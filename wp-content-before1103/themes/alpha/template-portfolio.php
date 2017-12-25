<?php
/**
 * Template Name: Portfolio
 */
get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 

		$cats = get_post_meta( $post->ID, 'folio_cats', true );
		$query_filter = '';

		if ( ! empty ( $cats ) ) {

			foreach ( $cats as $cat ) {

				$filter = get_term_by( 'id', $cat, 'portfolio_category' ); 
				if ( ! empty( $filter ) ) {
					$query_filter .= $filter->slug . ',';
				}

			}

		}

	?>

	<div class="maskee">

		<?php if ( get_post_meta( $post->ID, 'pre_enable', true ) == 'yes' ) : ?>

			<section class="pre-slide slide taken" data-background="<?php echo esc_attr( get_post_meta( $post->ID, 'pre_bgstyle', true ) ); ?>">

				<header class="page-header caption">
					<div class="page-header-type">
						<h2 class="title"><?php echo get_post_meta( $post->ID, 'pre_title', true ); ?></h2>
						<h6 class="subtitle"><?php echo get_post_meta( $post->ID, 'pre_subtitle', true ); ?></h6>
					</div>
				</header>

				<?php 

				$img = get_post_meta( $post->ID, 'pre_bgimg', true );

				if ( $img != '' ) {

					$img_small = aq_resize( $img, 960 );
					$img_medium = aq_resize( $img, 1380 );
					$img_large = aq_resize( $img, 1920 );

				}

				?>

				<div class="media" style="background-color: <?php echo esc_attr( get_post_meta( $post->ID, 'pre_bgcolor', true ) ); ?>" <?php if ( $img != '' ) : ?> data-bg-small="<?php echo esc_url( $img_small ); ?>" data-bg-medium="<?php echo esc_url( $img_medium ); ?>" data-bg-large="<?php echo esc_url( $img_large ); ?>" data-bg-full="<?php echo esc_url( $img ); ?>" data-bg-small-p="<?php echo esc_url( $img_small ); ?>" data-bg-medium-p="<?php echo esc_url( $img_medium ); ?>" data-bg-large-p="<?php echo esc_url( $img_large ); ?>" data-bg-full-p="<?php echo esc_url( $img ); ?>" <?php else : ?> data-bg-small="noback" <?php endif; ?>>
				</div>

			</section>

		<?php endif; 	

			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

			$args = array(
				'post_type' => 'portfolio',
				'portfolio_category' => $query_filter,
				'paged' => $paged
			);

			$all_posts = new WP_Query( $args ); 
			$i = get_post_meta( $post->ID, 'pre_enable', true ) == 'yes' ? 1 : 0;

			while ( $all_posts->have_posts() ) : $all_posts->the_post();

				$style = get_post_meta( $post->ID, 'alpha_folio_featured_style', true );
				$style_p = get_post_meta( $post->ID, 'alpha_folio_mobile_featured_style', true ) == 'auto' ? $style : get_post_meta( $post->ID, 'alpha_folio_mobile_featured_style', true );

				// 16:9 image

				$img = wp_get_attachment_url( get_post_thumbnail_id() );
				$img_small = aq_resize( $img, 960 );
				$img_medium = aq_resize( $img, 1380 );
				$img_large = aq_resize( $img, 1920 );

				// 3:4 image

				$img_p_id = get_post_meta( $post->ID, 'portfolio_mobile-thumbnail_thumbnail_id', true );

				if ( $img_p_id != '' ) {

					$img_p = wp_get_attachment_image_src( $img_p_id, 'full' );
					$img_p = $img_p[0];
					$img_small_p = aq_resize( $img_p, null, 960 );
					$img_medium_p = aq_resize( $img_p, null, 1140 );
					$img_large_p = aq_resize( $img_p, null, 1480 );

				} else {

					$img_small_p = $img_small;
					$img_medium_p = $img_medium;
					$img_large_p = $img_large;
					$img_p = $img;

				}

			?>

			<article id="post-<?php the_ID(); ?>" class="slide taken" data-background-l="<?php echo esc_attr( $style ); ?>" data-background-p="<?php echo esc_attr( $style_p ); ?>" itemscope itemtype="http://schema.org/CreativeWork">

				<header class="page-header caption">
					<div>
						<h2 class="title" itemprop="name"><?php the_title(); ?></h2>
						<h6 class="subtitle"><?php alpha_categories( $post->ID, 'portfolio_category' ); ?></h6>
						<div class="excerpt" itemprop="description"><?php the_excerpt(); ?></div>
						<a class="krown-button to-load dark" href="<?php the_permalink( $post->ID ); ?>" data-i="<?php echo $i++; ?>" data-title="<?php the_title(); ?>"><span><?php esc_html_e( 'View Project', 'alpha' ); ?><?php echo alpha_svg( 'arrow' ); ?></span></a>
					</div>
				</header> 

				<div class="media" data-bg-small="<?php echo esc_url( $img_small ); ?>" data-bg-medium="<?php echo esc_url( $img_medium ); ?>" data-bg-large="<?php echo esc_url( $img_large ); ?>" data-bg-full="<?php echo esc_url( $img ); ?>" data-bg-small-p="<?php echo esc_url( $img_small_p ); ?>" data-bg-medium-p="<?php echo esc_url( $img_medium_p ); ?>" data-bg-large-p="<?php echo esc_url( $img_large_p ); ?>" data-bg-full-p="<?php echo esc_url( $img_p ); ?>">
					<img src="<?php echo esc_url( $img_small ); ?>" alt="<?php the_title(); ?>" data-lazyload="innoway" itemprop="image" srcset="data:image/gif;base64,R0lGODlhAQABAJH/AP///wAAAMDAwAAAACH5BAEAAAIALAAAAAABAAEAAAICVAEAOw==" />
				</div>

			</article>

		<?php endwhile; ?>

	</div>

	<a class="mouse-scroll remove maskee-helper" href="#"><span class="mouse"><span class="mouse-movement"></span></span></a>
	<a class="touch-scroll remove maskee-helper" href="#"><?php echo alpha_svg( 'swipe-left' ); ?></a>

	<?php wp_reset_query(); ?>

	<?php endwhile;     

get_footer(); ?>