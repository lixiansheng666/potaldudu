<?php
/*
 * Template Name:single
 *
 */
get_header();?>
	<nav class="navbar" role="navigation"  style="background-color: #1285D7;">
		<?php get_template_part('searchform'); ?>
	</nav>
	<div class="blog" style="margin-bottom: 61px;">
		<div class="container-fluid">
			<div class="blog-top">
			<div class="col-lg-2"></div>
            <?php get_sidebar(); ?>
	<div class="col-lg-6 col-md-6 col-sm-8 blog-left">

					<?php if ( have_posts()) : while( have_posts()) : the_post(); ?>
                    <div class="blog-main-container">
					<div class="blog-main" style="margin-top: 50px;padding: 0px 10px;" >
						<a href="<?php the_permalink(); ?>" class="bg"  style="color: #337ab7;"><?php the_title(); ?></a>
<!--						<p>Post by <a href="#">--><?php //the_author_posts_link(); ?><!-- </a> --><?php //the_time('Y年n月j日') ?><!-- <a href="#">--><?php //comments_popup_link('暂无评论', '1条', '%条'); ?><!--</a></p>-->
					</div>
					<div class="blog-main-one">
						<div class="blog-one" style="background-color: #F8F8F8;margin-top: 1em;padding: 0px 10px;">

							<p> <?php the_content(); ?></p>
						</div>
						<div class="blog-comments" style="margin: 0px;padding: 0px;text-align: right;">
							<ul>
<!--								<li><span class="fa fa-bookmark" aria-hidden="true"></span>--><?php //the_category(','); ?><!--</li>-->
								<li><span class="fa fa-calendar" aria-hidden="true" style="color: #999;"></span><p style="font-weight: normal;"><?php the_time('Y年n月j日') ?></p></li>
<!--								<li><span class="fa fa-user" aria-hidden="true" style="color: #999;"></span><p style="font-weight: normal;">--><?php //the_author(); ?><!--</p></li>-->
<!--								<li><span class="fa fa-tags" aria-hidden="true"></span><a href="#">--><?php //the_tags() ?><!--</a></li>-->
							</ul>
						</div>
					</div>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
					<!--<div class="comments">
<!--						--><?php //comments_template(); ?>

											<?php
											global $post;
											$args = array( 'posts_per_page' => 5,'category_name'=> 'faqs', 'order'=> 'ASC');
											?>
                        <div class="blog-main-container">
							<div class="blog-main" style="border: 2px dashed #e7e7e7;margin-top: 50px;padding: 10px 10px;">
								<a href="#" class="bg" style="color: #337ab7;">您可能感兴趣的问题</a>
										<ul class="inside text-left">
											<?php
											$rand_posts = get_posts( $args );
											foreach ( $rand_posts as $post ) :
												setup_postdata( $post ); ?>
												<li style="padding-left: 8px;"><img src="<?php echo get_template_directory_uri(); ?>/images/dian.gif" style="padding-right: 10px;"><a href="<?php echo the_permalink(); ?>" style="color: #999;"><?php the_title(); ?></a></li>
											<?php endforeach;
											wp_reset_postdata(); ?>
										</ul>
							</div>
						</div>

                       <div class="blog-main-container">
							<div class="blog-main" style="border: 2px dashed #e7e7e7;margin-top: 20px;padding: 0px 10px;">
								<a href="#" class="bg" style="color: #337ab7;">热门标签</a>
										<ul class="inside text-left">
											<?php wp_tag_cloud('smallest=12&largest=18&unit=px&number=20');?>
										</ul>
							</div>
						</div>


					</div>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>
	</div>
   <?php get_footer();?>