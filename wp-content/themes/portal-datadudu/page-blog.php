<?php
/*
 * Template Name: page-blog
 *
 */
get_header();?>
	<nav class="navbar" role="navigation"  style="background-color: #1285D7;">
		<?php get_template_part('searchform'); ?>
	</nav>

	<div class="blog" style="margin-bottom: 61px;">
		<div class="container-fluid">
			<div class="blog-head text-center">
				<h1>新闻中心</h1>
			</div>
			<div class="blog-top">
				<div class="col-lg-2"></div>
				<?php get_sidebar(); ?>
				<div class="col-lg-6 col-md-6 col-sm-8 blog-left">

					<?php if (have_posts()) : ?>
						<?php while (have_posts()) : the_post(); ?>
							<div class="blog-main-container">
								<div class="blog-main" style="margin-top: 30px;padding: 0px 10px;">
									<a href="<?php the_permalink(); ?>" class="bg" style="color: #337ab7;"><?php the_title_attribute(); ?></a>
									<!--								<span class="b-btn" style="float: right;margin-top: 5px;"><a href="--><?php //the_permalink() ?><!--" style="background: #337ab7">详情</a></span>-->
									<span class="b-btn" style="float: right;margin-top: 5px;"><span class="fa fa-calendar" style="color: #999;"></span><span style="font-weight: normal;color: #999;"><?php the_time('Y年n月j日') ?></span></span>
								</div>
								<div class="blog-main-one" style="border-bottom: 2px solid #e7e7e7;">
									<div class="blog-one" style="background-color: #F8F8F8;margin-top: 1em;">
										<div class=" blog-one-left">
											<?php the_post_thumbnail();?>
										</div>
										<div class=" blog-one-left" style="padding: 0px 10px;">
											<p>
												<?php echo lingfeng_strimwidth( get_the_content(), 200 )?>......
												<a href="<?php the_permalink() ?>" style="text-decoration: underline;">阅读全文</a>
											</p>

										</div>
										<div class="clearfix"></div>
									</div>

									<div class="blog-comments" style="margin-top: 1em;padding: 0px;text-align: right;">
										<ul>
											<!--										<li><span class="fa fa-bookmark" ></span><a href="#">--><?php //the_category(','); ?><!--</a></li>-->
											<!--										<li><span class="fa fa-calendar" style="color: #999;"></span><p style="font-weight: normal;">--><?php //the_time('Y年n月j日') ?><!--</p></li>-->
											<!--										<li><span class="fa fa-user" style="color: #999;"></span><p style="font-weight: normal;">--><?php //the_author(); ?><!--</p></li>-->
											<!--										<li><span class="fa fa-tags" aria-hidden="true"></span><a href="#">--><?php //the_tags() ?><!--</a></li>-->
										</ul>
									</div>
								</div>
							</div>
						<?php endwhile; ?>
					<?php else : ?>
					<?php endif; ?>

					<div class="pagination">
						<div class="wp_nav"><?php echo wp_nav(); ?></div>
					</div>
				</div>


				<div class="clearfix"></div>
			</div>


		</div>
	</div>
   <?php get_footer();?>