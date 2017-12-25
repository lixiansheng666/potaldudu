<?php
/**
 * The Template for displaying all portfolio projects.
 */
get_header(); ?>

	<?php if ( have_posts() ) the_post(); ?>

	<?php

		$style = get_post_meta( $post->ID, 'alpha_folio_featured_style', true );	
		$style_p = get_post_meta( $post->ID, 'alpha_folio_mobile_featured_style', true ) == 'auto' ? $style : get_post_meta( $post->ID, 'alpha_folio_mobile_featured_style', true );
		$project_folio = get_post_meta( $post->ID, 'alpha_folio_page_select', true );

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

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/CreativeWork">

		<header class="page-header">
			<div class="page-header-type">
				<h2 class="title" itemprop="name"><?php the_title(); ?></h2>
				<h6 class="subtitle"><?php alpha_categories( $post->ID, 'portfolio_category' ); ?></h6>
				<div class="excerpt" itemprop="description"><?php the_excerpt(); ?></div>
			</div>
		</header> 

		<div class="maskee">

			<div class="slide taken" data-background-l="<?php echo esc_attr( $style ); ?>" data-background-p="<?php echo esc_attr( $style_p ); ?>">
				
				<div class="media" data-bg-small="<?php echo esc_url( $img_small ); ?>" data-bg-medium="<?php echo esc_url( $img_medium ); ?>" data-bg-large="<?php echo esc_url( $img_large ); ?>" data-bg-full="<?php echo esc_url( $img ); ?>" data-bg-small-p="<?php echo esc_url( $img_small_p ); ?>" data-bg-medium-p="<?php echo esc_url( $img_medium_p ); ?>" data-bg-large-p="<?php echo esc_url( $img_large_p ); ?>" data-bg-full-p="<?php echo esc_url( $img_p ); ?>">
					<img src="<?php echo esc_url( $img_small ); ?>" alt="<?php the_title(); ?>" itemprop="image" srcset="data:image/gif;base64,R0lGODlhAQABAJH/AP///wAAAMDAwAAAACH5BAEAAAIALAAAAAABAAEAAAICVAEAOw==" />
				</div>

			</div>

		</div>

		<section id="page-content" itemprop="text">
			<?php the_content(); ?>
		</section>

		<nav class="post-nav clearfix">

		<?php

			$cur_post_id = $post->ID;
			
			$args = array(
				'post_type' => 'portfolio',
				'meta_key' => 'alpha_folio_page_select',
				'meta_value' => $project_folio
			);

			$all_posts = new WP_Query( $args ); 

			$portfolio_array = array();
			
			while ( $all_posts->have_posts() ) : $all_posts->the_post();

				array_push($portfolio_array, $post->ID);

			endwhile;

			wp_reset_postdata();

			$cur_index = array_search( $post->ID, $portfolio_array );

			if ( $cur_index > 0 ) {

				$post_id = $portfolio_array[$cur_index-1];

				$thumb = get_post_thumbnail_id( $post_id );
				$thumb_url = wp_get_attachment_image_src( $thumb, 'full' ); 
				$thumb_inline = ' data-bg="' . $thumb_url[0] . '"';

				echo '<a class="btn-prev" data-lazyload="empty" data-id="' . $post_id . '" data-style="' . esc_attr( get_post_meta( $post_id, 'alpha_folio_featured_style', true ) ) . '" href="' . esc_url( get_permalink( $post_id ) ) . '"><i class="fa fa-chevron-left"></i><span class="subtitle">' . esc_html__( 'Previous Project', 'alpha' ) . '</span>' . '<span class="title">' . get_the_title( $post_id ) . '</span></a><span class="after prev lazybg"' . $thumb_inline . '></span>';

			}

			alpha_share_buttons( $cur_post_id );

			if ( $cur_index + 1 < sizeof( $portfolio_array ) ) {

				$post_id = $portfolio_array[$cur_index+1];

				$thumb = get_post_thumbnail_id( $post_id );
				$thumb_url = wp_get_attachment_image_src( $thumb, 'full' ); 
				$thumb_inline = ' data-bg="' . $thumb_url[0] . '"';

				echo '<a class="btn-next" data-lazyload="empty" data-id="' . $post_id . '" data-style="' . esc_attr( get_post_meta( $post_id, 'alpha_folio_featured_style', true ) ) . '" href="' . esc_url( get_permalink( $post_id ) ) . '"><i class="fa fa-chevron-right"></i><span class="subtitle">' . esc_html__( 'Next Project', 'alpha' ) . '</span>' . '<span class="title">' . get_the_title( $post_id ) . '</span></a><span class="after next lazybg"' . $thumb_inline . '></span>';

			}

		?>

		</nav>

	</article>
	
	<a class="mouse-scroll remove maskee-helper" href="#"><span class="mouse"><span class="mouse-movement"></span></span></a>
	<a class="touch-scroll remove maskee-helper" href="#"><?php echo alpha_svg('swipe-up'); ?></a>

<?php get_footer(); ?>