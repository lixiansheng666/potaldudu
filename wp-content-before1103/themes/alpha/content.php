<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
if ( has_post_thumbnail() ) {
	$img_class = ' with-featured-img';
} else {
	$img_class= '';
}
?>

<article id="post-<?php the_ID(); ?>" data-lazyload="empty" data-background="<?php echo esc_attr( get_post_meta( $post->ID, 'alpha_folio_featured_style', true ) ); ?>" data-title="<?php the_title(); ?>" <?php post_class( 'post clearfix' . $img_class ); ?> itemscope itemtype="http://schema.org/Article">

	<div class="header-container" data-height="1.5">

		<div class="center-wrap">

			<div class="post-header">

				<span class="title"><a href="<?php the_permalink(); ?>" data-id="post-<?php the_ID(); ?>" class="post-link"><h2 itemprop="name"><?php the_title(); ?></h2></a></span>
				<span class="date subtitle"><time datetime="<?php the_time( 'c' ); ?>" itemprop="datePublished"><a href="<?php the_permalink(); ?>"><?php the_time( esc_html__( 'j/m/Y', 'alpha' ) ); ?></a></time></span>
				<span class="comments subtitle"><span itemProp="commentCount"><?php comments_number( esc_html__( '0 Comments', 'alpha' ), esc_html__( '1 Comment', 'alpha' ), esc_html__( '% Comments', 'alpha' ) ); ?></span></span>
				<span class="author"><?php esc_html_e( 'Posted by ', 'alpha' ); ?> <span itemprop="author"><?php the_author(); ?></span></span>

			</div>

		</div>

		<?php if ( has_post_thumbnail() ) :

			$img = wp_get_attachment_url( get_post_thumbnail_id() );

			$img_small = aq_resize( $img, 840 );
			$img_medium = aq_resize( $img, 1280 );
			$img_large = aq_resize( $img, 1920 );

		?>

			<span class="featured-img" data-bg-small="<?php echo esc_url( $img_medium ); ?>" data-bg-medium="<?php echo esc_url( $img_medium ); ?>" data-bg-large="<?php echo esc_url( $img_large ); ?>">
				<img src="<?php echo esc_url( $img_small ); ?>" alt="<?php the_title(); ?>" itemprop="image" srcset="data:image/gif;base64,R0lGODlhAQABAJH/AP///wAAAMDAwAAAACH5BAEAAAIALAAAAAABAAEAAAICVAEAOw==" data-lazyload="innoway" />
			</span>

		<?php else :
			echo '<span class="featured-img" style="background-color: #fff;" data-bg="noback"></span>';
		endif; ?>
 
	</div>

</article>