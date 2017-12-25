<?php
/**
 * The template for displaying archives.
 */
get_header(); ?>

	<div id="posts-container" class="clearfix">

		<?php while ( have_posts() ) : the_post();

			get_template_part( 'content' );
				
		endwhile; ?>

		<div id="infinite-barrier" class="post clearfix" data-lazyload="no">
			<div class="header-container">
				<div class="center-wrap">
					<div class="post-header">
						<p class="infinite-text start"><?php esc_html_e( 'Loading more posts', 'alpha' ); ?><span>.</span><span>.</span><span>.</span></p>
						<p class="infinite-text end"><?php esc_html_e( 'All posts loaded', 'alpha' ); ?></p>
						<a class="infinite-link" href="<?php echo esc_url( next_posts( 0, false ) ); ?>"><?php esc_html_e( 'Show more posts', 'alpha' ); ?></a>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php get_footer(); ?>