<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta name="description" content="轻松连-领先的无线智能环境感知设备, 物联网大数据服务云平台供应商。提供传感器采集感知，数据监测, 分析预警一体化产品。 覆盖农业种植养殖、仓库冷链、工业监管、科学试验、智慧供热监测等领域。 产品支持低功耗WiFi, GPRS, 3G/4G, ZigBee, UWB, NB-IOT等多种通讯传输方式。 ">
    <meta name="keyword" content="轻松连,ubibot,物联网,大数据,无线感知,环境感知,无线传感器, 智能硬件, 环境监测,传感器, iot, internet of things, WiFi, zigbee, uwb, nbiot, 温度,湿度,光照,震动, 远程监测报警">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php wp_title('-', true, 'right'); ?></title>
	
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
	 <link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>">
    <!-- Custom JS -->
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/siderbarchange.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/slide.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/frontend.js"></script>

    <!-- Custom Fonts -->
    <link href="<?php echo get_template_directory_uri(); ?>/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
	<meta name="viewport" content="width=768,initial-scale=0.4">
<!--	--><?php //wp_head(); ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?7325523f1e2dc110fd06a7e7c77db65f";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            // 判断img轮转，实现a跳转
            // 推荐品牌滑动翻转效果
            brandPicTurn();
        });
        function brandPicTurn(){
            $(".brand_detail").hide();
            $(".brand_item").hover(
                function(){
                    $(this).children(".brand_name").hide();
                    $(this).children(".brand_detail").show();
                }
                , function(){
                    $(this).children(".brand_detail").hide();
                    $(this).children(".brand_name").show();
                }
            );
        }
    </script>
    <style type="text/css">
        *{margin:0; padding:0;}
        a{text-decoration: none;}
        img{max-width: 100%; height: auto;}
        .weixin-tip{display: none; position: fixed; left:0; top:0; bottom:0; background: rgba(0,0,0,0.8); filter:alpha(opacity=80);  height: 100%; width: 100%; z-index: 100;}
        .weixin-tip p{text-align: center; margin-top: 10%; padding:0 5%;}
    </style>
</head>

<body data-spy="scroll" data-target="#myScrollspy">
<!-- Navigation -->

<!-- Header -->
    <div class="container-fluid topnav" style="padding-right: 1px; padding-left: 1px;">
<!--        <div class="row">-->
        <div class="col-lg-2"></div>
            <nav class="navbar col-lg-8 center-header" role="navigation" >
                <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#example-navbar-collapse">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header">

                    <div class="header-logo col-sm-9 heade-logo" style="padding-right: 0px;padding-top:10px;padding-bottom:10px;">
                        <a class="logoLong" href="<?php echo home_url();?>/" style="float: left;"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/newLogo.png" alt="轻松连logo图标"></a>
                    </div>

                </div>

				 <div class="collapse col-lg-9 dropdown right-header" id="example-navbar-collapse" style="float: right;">

                <ul class="nav navbar-nav  header-nav">
                    <li>
                        <a href="<?php echo home_url();?>/">首页</a>
                    </li>
                    <li>
                        <a type="button" class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" style="cursor: pointer;">
                            轻松连系列产品
                        </a>

                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1" style="margin-right: 335px;width:500px">
                            <li role="" >

                              <a href="<?php echo home_url();?>/ubibot-ws1/"> <img src="<?php echo get_template_directory_uri(); ?>/images/ico/dudu_white.png" alt="嘟嘟白色图标"></a>
                                <span >智能感知标签 WS1</span>
                            </li>

                            <li role="" style="margin-left:10px;">
                                <a href="<?php echo home_url();?>/ubibot-ws1pro/"> <img src="<?php echo get_template_directory_uri(); ?>/images/ico/dudu_Switch.png" alt="嘟嘟检测仪图标"></a>
                                <span >智能监测仪 WS1 PRO</span>
                            </li>

                            <li role="" style="margin-left:10px;">
                                <a href="<?php echo home_url();?>/big-data-platform/"> <img src="<?php echo get_template_directory_uri(); ?>/images/ico/dudu_big_data_console.png" alt="嘟嘟大数据图标"></a>
                                <span >物联网大数据平台</span>
                            </li>

                            <!--<li role="" style="margin-left:10px;">
                                <a href="http://www.ubibot.cn/location/"> <img src="--><?php //echo get_template_directory_uri(); ?><!--/images/ico/location_dh.jpg"></a>
                                <span >高精度定位设备</span>
                            </li>-->
                            
                        </ul>

                    </li>
                    <li>
                        <a href="//console.ubibot.cn/login.html" target="_blank">管理控制台</a>
                    </li>
                    <li>
                        <a href="<?php echo home_url();?>/pricing/">计费方式</a>
                    </li>
                    <li>
                        <a href="<?php echo home_url();?>/category/faqs/">社区与文档</a>
                    </li>
                    <li>
                        <a href="<?php echo home_url();?>/category/news/">新闻中心</a>
                    </li>
<!--                    <li>-->
<!--                        <a href="//www.ubibot.cn/aboutus/">关于我们</a>-->
<!--                    </li>-->
                    <li>
                        <a href="<?php echo home_url();?>/setup/">软件及APP下载</a>
                    </li>
                </ul>
            </div>
            </nav>
        <div class="col-lg-2"></div>
<!--        </div>-->
    </div>
   
