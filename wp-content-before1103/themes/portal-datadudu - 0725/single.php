<?php 
/*
 * Template Name:single
 *
 */
get_header();?>

	<div class="blog" style="margin-top: 15px;">
		<div class="container">
			<div class="blog-top">
				<div class="col-md-9 blog-left">
					<?php if ( have_posts()) : while( have_posts()) : the_post(); ?>
					<div class="blog-main">
						<a href="<?php the_permalink(); ?>" class="bg"><?php the_title(); ?></a>
						<p>Post by <a href="#"><?php the_author_posts_link(); ?> </a> <?php the_time('Y年n月j日') ?> <a href="#"><?php comments_popup_link('暂无评论', '1条', '%条'); ?></a></p>
					</div>
					<div class="blog-main-one">
						<div class="blog-one">

							<p> <?php the_content(); ?></p>
						</div>
						<div class="blog-comments">
							<ul>
								<li><span class="fa fa-bookmark" aria-hidden="true"></span><?php the_category(','); ?></li>
								<li><span class="fa fa-calendar" aria-hidden="true"></span><p><?php the_time('Y年n月j日') ?></p></li>
								<li><span class="fa fa-user" aria-hidden="true"></span><a href="#"><?php the_author(); ?></a></li>
								<li><span class="fa fa-tags" aria-hidden="true"></span><a href="#"><?php the_tags() ?></a></li>
							</ul>
						</div>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
					<!--<div class="comments">
						<?php comments_template(); ?>
					</div>-->
				</div>
				 <?php get_sidebar(); ?>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
   <?php get_footer();?>