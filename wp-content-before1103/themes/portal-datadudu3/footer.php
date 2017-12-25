<?php
/**
 * The template for displaying the footer
 * 
 */
?>

<!-- Footer start-->
<div class="col-lg-12 col-xs-12 col-sm-12 footed">
        <div class="row-fluid footedinfo">
            <div class="col-md-2 col-sm-1 col-lg-2"></div>

            <div class="col-md-5 col-sm-6 col-xs-12 col-lg-5 footer-left" style="color: #fff;">
                    <p style="margin-bottom: 10px;">
                        <a href="//www.ubibot.cn/privacy/">关于隐私</a>
                    &nbsp;<span>|</span>&nbsp;<a href="//www.ubibot.cn/privacy/">法律声明</a>
                    &nbsp;<span>|</span>&nbsp;<a href="//www.ubibot.cn/aboutus/">关于我们</a>
                    &nbsp;<span>|</span>&nbsp;<a href="//www.cloudforce.cn/contact-us" target="_blank">联系我们</a>
                    </p>
                <p style="margin-bottom: 10px;">©UbiBot.cn, 2013~2017. All rights reserved.&nbsp;轻松连 版权所有</p>
                <p style="margin-bottom: 10px;">ICP证：辽ICP备14013544号-3</p>
            </div>

            <div class="col-md-1 col-sm-1 col-xs-12 col-lg-1 text-right footer-right">
                <img src="<?php echo get_template_directory_uri(); ?>/images/ico/cloudforce_weixin.png" style="height: 80px;;">
                </div>

            <div class="col-md-4 col-sm-4 col-xs-12 col-lg-3">
                <p style="margin-bottom: 20px;"><span class="">关注轻松连微信公众平台</span></p>
                <p><span class="">官方客服电话：</span>400-036-1016</p>
                <p><span class="">业务咨询电话：</span>0411-86686675</p>
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


