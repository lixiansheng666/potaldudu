<?php
/**
 * Template Name:app-h5-faq
 *
 */
;?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="轻松连™,全球领先的无线智能环境感知设备,智能硬件产品,物联网大数据服务云平台,物联网多行业解决方案">
	<meta name="keyword" content="轻松连,ubibot,物联网,大数据,无线感知,环境感知,智能硬件, 环境监测,传感器, iot, internet of things">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">

	<title><?php wp_title('-', true, 'right'); ?></title>


	<!-- Bootstrap Core CSS -->
	<link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome/css/bootstrap.min.css" rel="stylesheet">

	<link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome/css/bootstrap.min.css" rel="stylesheet">
	<!--     Custom CSS -->
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">

	<!-- Custom Fonts -->
	<!--	<link href="--><?php //echo get_template_directory_uri(); ?><!--/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>


	<script>
		function openPage() {
			window.top.postMessage('ubibot://open-page/http://item.taobao.com/item.htm?spm=a1z10.3-c-s.w4002-13122698497.16.xOUFQQ&id=539846077732', '*');
			return false;
		}
	</script>
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
			background-color: #F1F1F1;
		}
		.wrapper {
			/*border: 5px solid red;*/
			box-sizing: border-box;
		}
	</style>
</head>
<body>

<div class="wrapper">
	<div style="z-index:999;position:fixed;top:0;width:100%;padding: 10px;border-bottom:1px solid #e7e7e7;background-color:#EFEFF4;">
		<a href="#" onclick="javascript:window.history.back();return false;" style="font-size: 12px;"><img src="<?php echo get_template_directory_uri(); ?>/images/back.png"></a>
	</div>
	<nav class="navbar" role="navigation"  style="background-color: #1285D7;margin-top:45px;">
		<?php get_template_part('searchform-app'); ?>
	</nav>

	<?php
	$target1 = get_category_by_slug( 'product-use' );
//	var_dump($target1);
	$args = array('parent' => $target1->cat_ID,"child_of"=>$target1->cat_ID,'hide_empty'=>0,'order'=> 'ASC');
	$sub1=get_categories($args);
	foreach($sub1 as $cat) {
		?>
	<div class="app-visited-font" style="background-color: #fff;margin-bottom: 10px;padding: 20px;">
		<a href="<?php echo "//www.ubibot.cn"."/app-h5-faq-view?postID=".$cat->cat_ID."&cat_post_ID=".$cat->cat_ID; ?>">
		<img src="<?php echo z_taxonomy_image_url($cat->term_id); ?>" style="height: 20%;"/>
		<?php $category_link = get_category_link($cat->cat_ID);?>
	    <span style="margin-left: 10px;font-size:18px;color: #000;">轻松连™<?php echo $cat->name;?><span style="float: right;font-size: 18px;margin-top:10%;">></span></span>
		</a>
		<hr style="margin: 10px;">
		<?php
		$childCategories=get_categories(array('parent'=> $cat->cat_ID,"child_of"=>$target1->cat_ID,'hide_empty'=>0,'order'=> 'ASC'));
	foreach($childCategories as $subcat) {
		//$subCatLink = get_category_link($subcat->cat_ID);
//		var_dump($subcat->cat_ID);
?>
		<a href='<?php echo "//www.ubibot.cn"."/app-h5-faq-view?postID=".$subcat->cat_ID."&cat_post_ID=".$cat->cat_ID; ?>' style="color: #000;"><?php echo $subcat->name; ?></a>&nbsp;
	<?php	} ?>
	</div>
	<?php	} ?>

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