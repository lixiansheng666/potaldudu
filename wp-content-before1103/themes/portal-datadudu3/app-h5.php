<?php
/**
 * Template Name:app-h5-2
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
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.touchSlider.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){

            $(".main_visual").hover(function(){
                $("#btn_prev,#btn_next").fadeIn()
            },function(){
                $("#btn_prev,#btn_next").fadeOut()
            });

            $dragBln = false;

            $(".main_image").touchSlider({
                flexible : true,
                speed : 200,
                btn_prev : $("#btn_prev"),
                btn_next : $("#btn_next"),
                paging : $(".flicking_con a"),
                counter : function (e){
                    $(".flicking_con a").removeClass("on").eq(e.current-1).addClass("on");
                }
            });

            $(".main_image").bind("mousedown", function() {
                $dragBln = false;
            });

            $(".main_image").bind("dragstart", function() {
                $dragBln = true;
            });

            $(".main_image a").click(function(){
                if($dragBln) {
                    return false;
                }
            });

//            timer = setInterval(function(){
//                $("#btn_next").click();
//            }, 3000);
//
//            $(".main_visual").hover(function(){
//                clearInterval(timer);
//            },function(){
//                timer = setInterval(function(){
//                    $("#btn_next").click();
//                },3000);
//            });
//
//            $(".main_image").bind("touchstart",function(){
//                clearInterval(timer);
//            }).bind("touchend", function(){
//                timer = setInterval(function(){
//                    $("#btn_next").click();
//                }, 3000);
//            });

        });

    </script>

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
        border-color: green;
    }
    .wrapper {
        /*border: 5px solid red;*/
        box-sizing: border-box;

    }
    </style>
</head>
<body>

<div class="wrapper">
<div style="width: 100%;box-sizing: border-box;">
    <div class="main_visual">
        <div class="flicking_con">
<!--            <a href="#">1</a>-->
<!--            <a href="#">2</a>-->
<!--            <a href="#">3</a>-->
<!--            <a href="#">4</a>-->
<!--            <a href="#">5</a>-->
        </div>
        <div class="main_image">
            <ul>

                <li><a href="#" onclick="return openPage();"><span class="img_3"></span></a></li>
                <li><a href="#" onclick="return openPage();"><span class="img_4"></span></a></li>
                <li><a href="#" onclick="return openPage();"><span class="img_1"></span></a></li>
                <li><a href="#" onclick="return openPage();"><span class="img_2"></span></a></li>
                <li><a href="#" onclick="return openPage();"><span class="img_5"></span></a></li>
            </ul>
            <a href="javascript:;" id="btn_prev"></a>
            <a href="javascript:;" id="btn_next"></a>
        </div>
    </div>
</div>

    <div class="container-fluid">
        <div class="blog-head text-center">
        </div>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8 col-md-12 col-sm-12 blog-left">
                <?php $myqueryargss = array(
                    'post_type' => 'post',
                    'posts_per_page' => 9,//（每页的条数）
                    'orderby'=> 'date',
                    'category_name'=>'news',//（分类名称）
                    'order' => 'DESC',
                ); ?>
                <?php $myquerys= new WP_Query( $myqueryargss );?>
                <?php if ($myquerys->have_posts()) {
                    foreach ($myquerys->posts as $post) {
//							var_dump($post);
//							var_dump(get_home_url());
                        ?>
                        <div class="">
                            <div class="col-lg-6 col-md-6 col-sm-6" style="padding: 0px 10px;float:left;width: 69%;">
                                <a href="<?php echo "//www.ubibot.cn"."/app-h5-view?postID=".$post->ID; ?>" class="bg" style="color: #686868;font-size: 15px;"><?php the_title_attribute(); ?></a>
                                <br>
                                <span class="" style="color: #999;"></span><p style="font-weight: normal;color: #8C8C8C;font-size: 10px;"><?php the_time('Y年n月j日 H:i:s') ?></p>

                            </div>
                            <div class="blog-main-one" style="border-bottom: 1px solid #e7e7e7;">
                                <div class="blog-one" style="margin-top: 1em;margin-bottom: 1em;">
                                    <div class=" blog-one-left" style="float:right;">
                                        <a href="<?php echo "//www.ubibot.cn"."/app-h5-view?postID=".$post->ID; ?>">
                                            <?php the_post_thumbnail(array(200,50)); ?>
                                        </a>
                                    </div>
                                    <div class=" blog-one-left" style="padding: 0px 10px;">

                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                    <?php }
                }
                wp_reset_postdata();
                ?>



                <div class="clearfix"></div>
            </div>


        </div>
    </div>

</div>
</body>
</html>