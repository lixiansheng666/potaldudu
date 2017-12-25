<?php
/**
 * Template Name:app-h5-view
 *
 */
//var_dump($_REQUEST["postID"]);

//var_dump($_REQUEST["searchTerm"]);
if($_REQUEST["postID"]){
    ?>
    <?php
/*
 * Template Name:single
 *
 */
?>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="轻松连™,全球领先的无线智能环境感知设备,智能硬件产品,物联网大数据服务云平台,物联网多行业解决方案">
        <meta name="keyword" content="轻松连,ubibot,物联网,大数据,无线感知,环境感知,智能硬件, 环境监测,传感器, iot, internet of things">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
        <title><?php wp_title('-', true, 'right'); ?></title>

        <!-- Bootstrap Core CSS -->
<!--        <link href="--><?php //echo get_template_directory_uri(); ?><!--/css/bootstrap.min.css" rel="stylesheet">-->
<!--        <link href="--><?php //echo get_template_directory_uri(); ?><!--/css/font-awesome/css/bootstrap.min.css" rel="stylesheet">-->

        <!-- Custom CSS -->
<!--        <link rel="stylesheet" type="text/css" href="--><?php //bloginfo('stylesheet_url'); ?><!--">-->
<!--        <link href="--><?php //echo get_template_directory_uri(); ?><!--/css/jquery.mobile-1.4.5.min.css" rel="stylesheet">-->
        <!-- Custom Fonts -->
<!--        <link href="--><?php //echo get_template_directory_uri(); ?><!--/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">-->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />

<!--        <script type="text/javascript" src="--><?php //echo get_template_directory_uri(); ?><!--/js/jquery.mobile-1.4.5.min.js"></script>-->
<!--        <script type="text/javascript" src="--><?php //echo get_template_directory_uri(); ?><!--/js/jquery.touchSlider.js"></script>-->
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
                border-color: green;
            }
            .wrapper {
                /*border: 5px solid red;*/
                box-sizing: border-box;
            }
        </style>
    </head>
<body>
<div style="padding: 10px;border-bottom:1px solid #e7e7e7;background-color:#EFEFF4;">
<a href="#" onclick="javascript:window.history.back();return false;" style="font-size: 12px;"><img src="<?php echo get_template_directory_uri(); ?>/images/back.png"></a>
</div>

	<div class="blog" style="padding: 0px 10px;">
		<div class="container-fluid">
			<div class="blog-top" style="padding: 0px 10px;">
			<div class="col-lg-2"></div>
	        <div class="col-lg-8 col-md-12 col-sm-12 blog-left" style="text-align: center;">
                    <?php
                    $my_postid=$_REQUEST["postID"];
                    $content_post = get_post($my_postid);
//                    var_dump($content_post);
                    $content = $content_post->post_content;
                    $title = $content_post->post_title;
                    $date = $content_post->post_date;
                    ?>
                    <h2><?php echo $title;?></h2>
                    <p style="color: #999;text-align:right;"><?php echo $date;?></p>
                    <div style="text-align: justify;"><?php echo $content;?></div>

				</div></div>
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
<?php
};
?>