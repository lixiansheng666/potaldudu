
<?php 
/**
 * Template Name:默认模板
 *
 */
 
get_header(); ?>
<div class="blog" style="margin-top: 15px;">
		<div class="container">
			<div class="blog-top">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<?php if ( have_posts()) : while( have_posts()) : the_post(); ?>
					<div class="blog-main">
					</div>
					<div class="blog-main-one">
							<?php the_content(); ?>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
