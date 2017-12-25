<?php 
/*
 * Template Name: page-blog
 *
 */
get_header();?>

	<div class="blog">
		<div class="container">
			<div class="blog-head text-center">
				<h1>新闻中心</h1>
			</div>
			<div class="blog-top">
				<div class="col-md-9 blog-left">
					<?php
					$page = get_query_var('paged') ? get_query_var('paged') : 1;
					$search_args = array(
							'post_type' =>'post',
							'posts_per_page' => '4',
							'paged' => $page
					);
					query_posts($search_args);
					?>
					<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
					<div class="blog-main">
						<a href="<?php the_permalink(); ?>" class="bg"><?php the_title_attribute(); ?></a>
						<p>Post by <a href="#"><?php the_author_posts_link(); ?></a> <?php the_time('Y年n月j日') ?> <a href="#"><?php comments_popup_link('暂无评论', '1条', '%条'); ?></a></p>
					</div>
					<div class="blog-main-one">
						<div class="blog-one">
							<div class="col-md-5 blog-one-left">
								<?php the_post_thumbnail();?>

							</div>
							<div class="col-md-7 blog-one-left">
								<p>
									<?php echo lingfeng_strimwidth( get_the_content(), 200 )?>
								</p>
								<div class="b-btn">
									<a href="<?php the_permalink() ?>">阅读更多</a>
								</div>
							</div>
							<div class="clearfix"></div>
						</div>
						<div class="blog-comments">
							<ul>
								<li><span class="fa fa-bookmark" ></span><a href="#"><?php the_category(','); ?></a></li>
								<li><span class="fa fa-calendar"></span><p><?php the_time('Y年n月j日') ?></p></li>
								<li><span class="fa fa-user"></span><a href="#"><?php the_author(); ?></a></li>
								<li><span class="fa fa-tags" aria-hidden="true"></span><a href="#"><?php the_tags() ?></a></li>
							</ul>
						</div>
					</div>
					<?php endwhile; ?>
					<?php else : ?>
					<?php endif; ?>


				</div>

				<?php get_sidebar(); ?>
				<div class="clearfix"></div>
			</div>
			<div class="pagination">
				<div class="wp_nav"><?php echo wp_nav(); ?></div>
			</div>
		</div>
	</div>
   <?php get_footer();?>