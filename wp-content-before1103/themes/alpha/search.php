<?php
/**
 * The template for displaying search results.
 */
get_header(); ?>

	<div id="posts-container" class="clearfix">

		<?php if ( have_posts() ) : ?>

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

		<?php else : ?>

			<div class="post clearfix" data-lazyload="no" style="display: block !important"> 
				<div class="header-container">
					<div class="center-wrap">
						<div class="post-header">
							<p class="infinite-text start"><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'alpha' ); ?><span>.</span><span>.</span><span>.</span></p>
						</div>
					</div>
				</div>
			</div>

		<?php endif; ?>

	</div>
	
<?php get_footer(); ?>