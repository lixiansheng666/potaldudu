<?php

/**
 * Template Name:app-h5-search-view
 *
 */
if($_REQUEST["searchTerm"]){
	$keywords=$_REQUEST["searchTerm"];
;?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="轻松连™,全球领先的无线智能环境感知设备,智能硬件产品,物联网大数据服务云平台,物联网多行业解决方案">
	<meta name="keyword" content="轻松连,ubibot,物联网,大数据,无线感知,环境感知,智能硬件, 环境监测,传感器, iot, internet of things">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">

	<title><?php wp_title('-', true, 'right'); ?></title>

	<link href="<?php echo get_template_directory_uri(); ?>/css/appslide_style.css" rel="stylesheet">

	<!-- Bootstrap Core CSS -->
	<!--    <link href="--><?php //echo get_template_directory_uri(); ?><!--/css/jquery.mobile-1.4.5.min.css" rel="stylesheet">-->
	<link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome/css/bootstrap.min.css" rel="stylesheet">

	<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome/css/bootstrap.min.css" rel="stylesheet">
	<!--     Custom CSS -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">

	<!-- Custom Fonts -->
	<!--	<link href="--><?php //echo get_template_directory_uri(); ?><!--/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
	<!--    <script type="text/javascript" src="--><?php //echo get_template_directory_uri(); ?><!--/js/jquery.mobile-1.4.5.min.js"></script>-->

	<style>
		html, body {
			/*height:200px;*/
			/*touch-action: pan-y;*/
			/*overflow: scroll;*/
			/*border: 5px solid red;*/
			/*box-sizing: border-box;*/
			margin:0;
			/*padding: 0;*/
			margin-bottom:5px;/*ios少了1段border的height??*/
		}
		body {

		}
		.wrapper {
			/*border: 5px solid red;*/
			box-sizing: border-box;

		}
	</style>
</head>
<body>

<div class="wrapper">
	<div style="padding: 10px;border-bottom:1px solid #e7e7e7;background-color:#EFEFF4;">
		<a href="#" onclick="javascript:window.history.back();return false;" style="font-size: 12px;"><img src="<?php echo get_template_directory_uri(); ?>/images/back.png"></a>
	</div>
	<div class="container-fluid">
		<div class="blog-head text-center">
		</div>
		<div class="row">
			<div class="col-lg-2"></div>
			<div class="col-lg-8 col-md-12 col-sm-12 blog-left">
				<?php
//				$my_postid=$_REQUEST["postID"];
//				var_dump($my_postid);
				$myqueryargss = array(
					    'category_name'=>'product-use',
						'orderby'=> 'date',
						'order' => 'DESC',
						"s"=>$keywords
				);
				?>
				<?php $myquerys= new WP_Query( $myqueryargss );?>
				<?php if ($myquerys->have_posts()) {
					foreach ($myquerys->posts as $post) {
//							var_dump($post);
//							var_dump(get_home_url());
						?>
						<div class="">
							<div class="col-lg-6 col-md-6 col-sm-6" style="padding: 0px 10px;float:left;">
								<a href="<?php echo "//www.ubibot.cn"."/app-h5-view?postID=".$post->ID; ?>" class="bg" style="color: #0070BD;font-size: 15px;"><?php the_title_attribute(); ?></a>
								<br>
								<p style="color: #999;margin-top: 5px;">
									<?php echo lingfeng_strimwidth($post->post_content, 38 )?>
									<a href="<?php echo "//www.ubibot.cn"."/app-h5-view?postID=".$post->ID; ?>" style="text-decoration: underline;float: right;">阅读全文</a>
								</p>
								<p style="font-weight: normal;color: #8C8C8C;font-size: 10px;"><?php the_time('Y年n月j日 H:i:s') ?></p>

							</div>
							<div class="blog-main-one" style="border-bottom: 1px solid #e7e7e7;">
								<div class="blog-one" style="margin-top: 0.5em;margin-bottom: 0.5em;">

									<div class=" blog-one-left" style="padding: 0px 10px;">

									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>

					<?php }
				}else{ ?>
					<p>很遗憾，您搜索的内容不存在。</p>
				<?php }
				wp_reset_postdata();
				?>



				<div class="clearfix"></div>
			</div>


		</div>
	</div>

</div>
</body>
<script>
	window.addEventListener('message', function(evt){
		if(evt.data && evt.data == 'ubibot::buttonback') {
			console.log('trigger button back');
			window.history.back();return false;
		}
	});
</script>
</html>
	<?php  };?>