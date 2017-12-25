<?php
/**
 * The template for displaying the footer
 * 
 */
?>

<!-- Footer start-->
<div class="container-fluid footed">
    <div>
        <div class="row-fluid footedinfo">
            <div class="col-md-1 col-sm-0 col-lg-2"></div>

            <div class="col-md-4 col-sm-4 col-xs-12 col-lg-3">
                <span style="float: left;padding: 5px 10px 5px 0"><img src="<?php echo get_template_directory_uri(); ?>/images/ico/footer-logo.png"></span>
                <h3>轻松连 - UbiBot </h3>
                <!--<div class="col-md-2"><img src="./images/ico/footer-logo.png"></div>-->
                <!--<div class="col-md-10"><h2>DATA DUDU</h2></div>-->
                    <span>因物联网而生，致力于打造最完整、完善、安全可靠的物联网大数据产品及服务。</span>
            </div>

            <div class="col-md-3 col-sm-3 col-xs-12 col-lg-3">
                <h3><a href="">快速链接 </a></h3>
                <div class=" footedmenu" style="margin-right: 50px">
                    <ul>
                        <li><i class="fa fa-long-arrow-right"></i><a href="http://www.ubibot.cn/">首页</a></li>
                        <li><i class="fa fa-long-arrow-right"></i><a target="_blank" href="http://www.ubibot.cn/aboutus/">关于我们</a></li>
                        <li><i class="fa fa-long-arrow-right"></i><a target="_blank" href=" http://www.cloudforce.cn/career">加入我们</a></li>
<!--                        <li><i class="fa fa-long-arrow-right"></i><a href="">团队</a></li>-->
                        <li><i class="fa fa-long-arrow-right"></i><a target="_blank" href="http://www.cloudforce.cn/contact-us">联系我们</a></li>
                    </ul>
                </div>

                <div class=" footedmenu">
                    <ul>
 			 <li><i class="fa fa-long-arrow-right"></i><a target="_blank" href="http://www.cloudforce.cn">云动力科技官网</a></li>
                        <li><i class="fa fa-long-arrow-right"></i><a target="_blank" href="http://www.ubibot.cn/privacy/">关于隐私</a></li>
                        <li><i class="fa fa-long-arrow-right"></i><a target="_blank" href="http://www.ubibot.cn/privacy/">版权声明</a></li>
                    </ul>
                </div>

            </div>

            <div class="col-md-4 col-sm-5 col-xs-12 col-lg-3 text-left">
                <h3><a href=""> 联系我们</a></h3>
                <p><span class=""></span><i class="fa fa-phone"> </i>0411-86686675<br>
                    <span class="icon icon-phone"></span><i class="fa fa-envelope "> </i>info@cloudforce.cn<br>
                    <span class="icon icon-mobile"></span> <i class="fa fa-map-marker" style="margin-right: 17px"> </i>辽宁省大连市甘井子区虹港路23号六楼<br>
                </p>

                <ul class="social-links">
                    <li class=""><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/ico/facebook.png"></a></li>
                    <li class=""><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/ico/twitter.png"></a></li>
                    <li class=""><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/ico/linkedin.png"></a></li>
                    <li class=""><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/ico/googleplus.png"></a></li>
                    <li class=""><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/ico/youtube.png"></a></li>
                </ul>
            </div>

            <div class=" col-xs-1"></div>
        </div>
    </div>
    <div class=" row-fluid ">

        <div class="col-md-12 copyrights text-center">
            <span style="color: #FFFFFF;">Copyrights © 2013-2016 UbiBot.cn All Rights Reserved. 大连云动力科技有限公司 版权所有
</span><br> <span style="color: #FFFFFF;">ICP证：辽ICP备14013544号-3
</span>

        </div>
    </div>
</div>
<?php wp_footer(); ?>
<!-- Footer end-->

<!-- jQuery -->
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/easySlider.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/online.js"></script>

<script type="text/javascript">
    $(function() {
        $("#slider").easySlider( {
            slideSpeed: 500,
            paginationSpacing: "15px",
            paginationDiameter: "12px",
            paginationPositionFromBottom: "20px",
            slidesClass: ".slides",
            controlsClass: ".controls",
            paginationClass: ".pagination"
        });
    });
</script>

</body>

</html>
