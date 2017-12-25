<?php
/**
 * The Template for displaying all single posts.
 */
if ( ! ( isset( $_GET['justcontent'] ) && $_GET['justcontent'] == 'yes' ) ) get_header();
?>

	<?php if ( have_posts() ) the_post(); ?>

	<article id="post-<?php the_ID(); ?>" data-background="<?php echo get_post_meta( $post->ID, 'alpha_folio_featured_style', true ); ?>" <?php post_class( 'post clearfix' ); ?> itemscope itemtype="http://schema.org/Article">

		<?php if ( has_post_thumbnail() ) {
			$thumb = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src( $thumb, 'full' ); 
		} ?>

		
		<header class="header-container" data-height="1.5">

			<div class="center-wrap">

				<div class="post-header">

					<span class="title"><a href="<?php the_permalink(); ?>"><h1 itemprop="name"><?php the_title(); ?></h1></a></span>
					<span class="date subtitle"><time datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished"><?php the_time( esc_html__( 'j/m/Y', 'alpha' ) ); ?></time></span>
					<span class="comments subtitle"><a href="<?php the_permalink(); ?>#comments" itemProp="commentCount"><?php comments_number( esc_html__( '0 Comments', 'alpha' ), esc_html__( '1 Comment', 'alpha' ), esc_html__( '% Comments', 'alpha' ) ); ?></a></span>
					<span class="author"><?php esc_html_e( 'Posted by ', 'alpha' ); ?> <span itemprop="author"><?php the_author(); ?></span></span>

				</div>

			</div>

			<?php if ( has_post_thumbnail() ) :

				$img = wp_get_attachment_url( get_post_thumbnail_id() );

				$img_small = aq_resize( $img, 840 );
				$img_medium = aq_resize( $img, 1280 );
				$img_large = aq_resize( $img, 1920 );

			?>

			<span class="featured-img reactive" data-bg-small="<?php echo esc_url( $img_medium ); ?>" data-bg-medium="<?php echo esc_url( $img_medium ); ?>" data-bg-large="<?php echo esc_url( $img_large ); ?>">
				<img src="<?php echo esc_url( $img_small ); ?>" alt="<?php the_title(); ?>" itemprop="image" srcset="data:image/gif;base64,R0lGODlhAQABAJH/AP///wAAAMDAwAAAACH5BAEAAAIALAAAAAABAAEAAAICVAEAOw==" data-lazyload="innoway" />
			</span>

		<?php else :
			echo '<span class="featured-img" style="background-color: #fff;"></span>';
		endif; ?>

		</header>

		<div class="post-content">

			<section class="post-text">

				<?php the_content();

				wp_link_pages( array(
					'before' => '<p class="wp-link-pages"><span>' . esc_html__( 'Pages:', 'alpha' ) . '</span>'
					)
				); 
				
				the_tags( '<p class="tags">' . esc_html__( 'Tagged with: ', 'alpha' ), ', ', '</p>' );

				?>

			</section>

			<?php if( comments_open() )
				comments_template( '', true ); ?>

			<nav class="post-nav clearfix">
			<?php

				$next_post = get_adjacent_post( false, '', false, 'category' );
				$prev_post = get_adjacent_post( false, '', true, 'category' );

				$html = '';

				if ( ! empty( $next_post ) ) {

					if ( has_post_thumbnail( $next_post->ID ) ) {
						$thumb = get_post_thumbnail_id( $next_post->ID );
						$thumb_url = wp_get_attachment_image_src( $thumb, 'full' ); 
						$thumb_inline = ' data-bg="' . $thumb_url[0] . '"';
					} else {
						$thumb_inline = ' data-bg=""';
					}

					$html .= '<a class="btn-prev" data-lazyload="empty" data-id="' . $next_post->ID . '" data-style="' . esc_attr( get_post_meta( $next_post->ID, 'alpha_folio_featured_style', true ) ) . '" href="' . esc_url( get_permalink( $next_post->ID ) ) . '"><i class="fa fa-chevron-left"></i><span class="subtitle">' . esc_html__( 'Previous Post', 'alpha' ) . '</span>' . '<span class="title">' . get_the_title( $next_post->ID ) . '</span></a><span class="after prev lazybg"' . $thumb_inline . '></span>';

				} 

				alpha_share_buttons( $post->ID );

				if ( ! empty( $prev_post ) ) {

					if ( has_post_thumbnail( $prev_post->ID ) ) {
						$thumb = get_post_thumbnail_id( $prev_post->ID );
						$thumb_url = wp_get_attachment_image_src( $thumb, 'full' ); 
						$thumb_inline = ' data-bg="' . $thumb_url[0] . '"';
					} else {
						$thumb_inline = ' data-bg=""';
					}

					$html .= '<a class="btn-next" data-lazyload="empty" data-id="' . $prev_post->ID . '" data-style="' . esc_attr( get_post_meta( $prev_post->ID, 'alpha_folio_featured_style', true ) ) . '" href="' . esc_url( get_permalink( $prev_post->ID ) ) . '"><i class="fa fa-chevron-right"></i><span class="subtitle">' . esc_html__( 'Next Post', 'alpha' ) . '</span>' . '<span class="title">' . get_the_title( $prev_post->ID ) . '</span></a><span class="after next lazybg"' . $thumb_inline . '></span>';

				}

				echo $html;


			?>
			</nav>

		</div>

	</article>
	
<?php if ( ! ( isset( $_GET['justcontent'] ) && $_GET['justcontent'] == 'yes' ) ) get_footer(); ?>