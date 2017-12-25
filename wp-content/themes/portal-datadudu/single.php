<?php
/*
 * Template Name:single
 *
 */
get_header();



function relatedPostsbyCategory(){
	//$original_post = $post;
	global $post;
	$categories = get_the_category($post->ID);
	if ($categories) {
		$category_ids = array();
		foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
		$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'posts_per_page'=> 5, // Number of related posts that will be shown.
				'ignore_sticky_posts'=>1
		);
		$my_query = new wp_query( $args );?>
		<div class="blog-main-container">
			<div class="blog-main" style="border: 1px dashed #999;margin-top: 20px;padding: 10px 10px;">
				<a href="#" class="bg" style="color: #337ab7;">相关文章</a>
				<ul>
					<?php if( $my_query->have_posts() ) { while( $my_query->have_posts() ) { $my_query->the_post(); ?>
						<li style="padding-left: 8px;"><img src="<?php echo get_template_directory_uri(); ?>/images/dian.gif" style="padding-right: 10px;">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>" style="color: #999;"><?php the_title(); ?></a>
						</li>
						<?php
					}
					}?>
				</ul>
			</div>
		</div>
	<?php }
	//$post = $original_post;
	wp_reset_query();
}?>


	<nav class="navbar" role="navigation"  style="background-color: #1285D7;">
		<?php get_template_part('searchform'); ?>
	</nav>
	<div class="blog" style="margin-bottom: 61px;">
		<div class="container-fluid">
			<div class="blog-top">
			<div class="col-lg-2"></div>
            <?php get_sidebar(); ?>
	<div class="col-lg-6 col-md-8 col-sm-8 blog-left">

					<?php if ( have_posts()) : while( have_posts()) : the_post(); ?>
                    <div class="blog-main-container">
					<div class="blog-main" style="margin-top: 20px;margin-bottom: 10px;padding: 10px 10px;" >
						<a href="<?php the_permalink(); ?>" class="bg"  style="color: #337ab7;"><?php the_title(); ?></a>
<!--						<p>Post by <a href="#">--><?php //the_author_posts_link(); ?><!-- </a> --><?php //the_time('Y年n月j日') ?><!-- <a href="#">--><?php //comments_popup_link('暂无评论', '1条', '%条'); ?><!--</a></p>-->
					<span class="blog-comments" style="margin: 0px;padding-top: 10px;float: right;">
								<span class="fa fa-calendar" aria-hidden="true" style="color: #999;"></span>&nbsp;<span style="font-weight: normal;color: #999;"><?php the_time('Y年n月j日') ?></span>
						</span>
                        </div>
					<div class="blog-main-one" style="border-top:1px dashed #999;border-bottom:1px dashed #999;">
						<div class="blog-one" style="margin-top: 1em;padding: 0px 10px;">
							<p> <?php the_content(); ?></p>
						</div>
					</div>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
					<!--<div class="comments">
<!--						--><?php //comments_template(); ?>

                    <?php relatedPostsbyCategory(); ?>
                    <?php
                    global $post;
                    $args = array( 'posts_per_page' => 5,'category_name'=> 'faqs', 'order'=> 'ASC');
                    ?>
                        <div class="blog-main-container">
							<div class="blog-main" style="border: 1px dashed #999;margin-top: 20px;padding: 10px 10px;">
								<a href="#" class="bg" style="color: #337ab7;">您可能感兴趣的问题</a>
										<ul class="inside text-left">
											<?php
											$rand_posts = get_posts( $args );
											foreach ( $rand_posts as $post ) :
												setup_postdata( $post ); ?>
												<li style="padding-left: 8px;"><img src="<?php echo get_template_directory_uri(); ?>/images/dian.gif" style="padding-right: 10px;">
                                                    <a title="<?php the_title(); ?>" href="<?php echo the_permalink(); ?>" style="color: #999;"><?php the_title(); ?></a>
                                                </li>
											<?php endforeach;
											wp_reset_postdata(); ?>
										</ul>
							</div>
						</div>

                       <div class="blog-main-container">
							<div class="blog-main" style="border: 1px dashed #999;margin-top: 20px;padding: 10px 10px;">
								<a href="#" class="bg" style="color: #337ab7;">热门标签</a>
										<ul class="inside text-left">
											<?php
											//彩色标签
											add_filter('widget_tag_cloud_args','style_tags');
											function style_tags($args) {
												$args = array(
														'largest'=> '15',
														'smallest'=> '15',
														'unit' => 'px',
														'format'=> 'flat',
														'number' => '50',
														'orderby' => 'name',
														'order' => 'ASC'
												);
												return $args;
											}
											function colorCloud($text) {
												$text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
												return $text;
											}
											function colorCloudCallback($matches) {
												$text = $matches[1];
												$colors=array('ff3300','0517c2','0fc317','e7cc17','601165','ffb900','f74e1e','00a4ef','7fba00');
												$color=$colors[dechex(rand(0,3))];
												$pattern = '/style=(\'|\")(.*)(\'|\")/i';
												$text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
												return "<a $text>";
											}
											add_filter('wp_tag_cloud', 'colorCloud', 1);
											?>
											<?php wp_tag_cloud('smallest=12&largest=18&unit=px&number=20');?>
										</ul>
							</div>
						</div>


					</div>
				</div>

				<div class="clearfix"></div>
			</div>
		</div>

   <?php get_footer();?>