<?php
/**
 * Template Name:cloudforce_index
 *
 */
get_header(); ?>


<div class="container-fluid new-index">
<div class="row-fluid">
    <div class="aboutUs col-xs-12 col-sm-12 col-md-4 col-lg-4">
       <h2 class="about-company">公司介绍</h2><span>Company Introduction</span>

        <div class="company-con">
            <?php
            $args=array(
                'cat' => 62,   // 分类ID
                'posts_per_page' => 1, // 显示篇数
            );
            query_posts($args);
            if(have_posts()) : while (have_posts()) : the_post();
            ?>

        <?php if (has_excerpt()) {
            echo $description = get_the_excerpt(); //文章编辑中的摘要
        }else {
            echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 275,"……"); //文章编辑中若无摘要，自定截取文章内容字数做为摘要
        } ?>
            <?php  endwhile; endif; wp_reset_query(); ?>
        </div>
        <div class="text-right"><button type="button" class="btn btn-default btn-xs" style="width: 70px"><a href="<?php echo get_permalink(52);?>" ><span style="font-size: 8px">更多>></span></a></button></div>
    </div>

    <div class="news col-xs-12 col-sm-12 col-md-4 col-lg-4" style="margin-bottom: 40px">
        <h2 class="about-company">新闻动态</h2><span>Company News</span>
        <div class="news-list">
        <ul>
            <?php
            $args=array(
                'cat' => 11,   // 分类ID
                'posts_per_page' => 6, // 显示篇数
            );
            query_posts($args);
            if(have_posts()) : while (have_posts()) : the_post();
                ?>
                <li style="list-style: initial">

                    <h4 style="font-size: 12px;margin-top: 0;margin-bottom: 0">  <a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 40, '..'); ?></a>
                    <span style="float: right;color: #0068b7;font-size: 12px;padding-top: 4px"><?php the_time('n/j') ?></span></h4>

                </li>
            <?php  endwhile; endif; wp_reset_query(); ?>
        </ul>
        </div>
        <div class="text-right"><button type="button" class="btn btn-default btn-xs" style="width: 70px"><a href="http://www.cloudforce.cn/company-news/" style="font-size: 8px">更多>></a></button></div>
    </div>

    <div class="industry-news col-xs-12 col-sm-12 col-md-4 col-lg-4">
        <h2 class="about-company">行业新闻</h2><span> Industry News</span>
        <div class="industry-news-list">
            <ul>
                <?php
                $args=array(
                    'cat' => 12,   // 分类ID
                    'posts_per_page' => 6, // 显示篇数
                );
                query_posts($args);
                if(have_posts()) : while (have_posts()) : the_post();
                    ?>
                    <li>
                 <h4> <a href="<?php the_permalink(); ?>"><?php echo mb_strimwidth(get_the_title(), 0, 40, '..'); ?></a>
                        <span><?php the_time('n/j') ?></span></h4>
                    </li>
                <?php  endwhile; endif; wp_reset_query(); ?>



            </ul>
        </div>
        <div class="text-right"><button type="button" class="btn btn-default btn-xs" style="width: 70px"><a href="http://www.cloudforce.cn/related-news/" style="font-size: 8px">更多>></a></button></div>
    </div>
</div>


    <div class="row-fluid products">
        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <h2 class="products-title">产品及服务</h2><span> Products and Services</span>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right " id="Switch" style="padding-right:0">
            <div class="og_next" style="float: right;display: inline"></div>
            <div class="og_prev" style="float: right;display: inline"></div>
        </div>

        <div class="box" style="margin-top:50px;" id="sideOld">
            <div class="picbox">

                <ul class="piclist mainlist">
                    <li><a href="<?php bloginfo('url'); ?>/products/smart-wireless-tags/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/ubibot.png" width="220" height="105" alt="无线智能感知标签" /></a> <h3 class="text-center">无线智能感知标签</h3></li>
                    <li><a href="<?php bloginfo('url'); ?>/products/xinbao-smart-wireless-ecg/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/xinbao.png" alt="心宝无线智能心电仪"/></a> <h3 class="text-center">心宝无线智能心电仪</h3></li>
                    <li><a href="<?php bloginfo('url'); ?>/services/smart-device-iot-design/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/zhinengyingjian.png" alt="智能硬件服务" /></a> <h3 class="text-center">智能硬件服务</h3></li>
                    <li><a href="<?php bloginfo('url'); ?>/products/service-cloud/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/yunpingtai.png" alt="企业应用云"/></a> <h3 class="text-center">企业应用云</h3></li>
                    <li><a href="http://www.ubibot.cn/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/datas.png" alt="轻松连™大数据平台" /></a> <h3 class="text-center">轻松连™大数据平台</h3></li>
                    <li><a href="<?php bloginfo('url'); ?>/products/smart-wireless-tags/"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/ubibot.png"  alt="无线智能感知标签"/></a> <h3 class="text-center">无线智能感知标签</h3></li>
                    <li><a href="<?php bloginfo('url'); ?>/products/xinbao-smart-wireless-ecg/" ><img src="<?php echo get_template_directory_uri(); ?>/assets/images/xinbao.png" alt="心宝无线智能心电仪"/></a> <h3 class="text-center">心宝无线智能心电仪</h3></li>
                    <li><a href="<?php bloginfo('url'); ?>/services/smart-device-iot-design/" ><img src="<?php echo get_template_directory_uri(); ?>/assets/images/zhinengyingjian.png" alt="智能硬件服务"/></a> <h3 class="text-center">智能硬件服务</h3></li>
                </ul>
                <ul class="piclist swaplist"></ul>
            </div>

        </div>
    </div>

    <div id="slider">
        <ul class="slides clearfix">

            <li>
                <div>
                    <a href="<?php bloginfo('url'); ?>/products/smart-wireless-tags/"> <img class="responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/ubibot.png" alt="无线智能感知标签"></a>
                    <p class="text-center">无线智能感知标签</p>
                </div>
            </li>
            <li>
                <div>
                    <a href="<?php bloginfo('url'); ?>/products/xinbao-smart-wireless-ecg/"> <img class="responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/xinbao.png" alt="心宝无线智能心电仪"></a>
                    <p class="text-center">心宝无线智能心电仪</p>
                </div>
            </li>

            <li>
                <div>
                    <a href="<?php bloginfo('url'); ?>/services/smart-device-iot-design/"><img class="responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/zhinengyingjian.png" alt="智能硬件服务"></a>
                    <p class="text-center">智能硬件服务</p>
                </div>
            </li>

            <li>
                <div>
                    <a href="<?php bloginfo('url'); ?>/products/service-cloud/"><img class="responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/yunpingtai.png" alt="企业应用云"></a>
                    <p class="text-center">企业应用云</p>
                </div>
            </li>

            <li>
                <div>
                    <a href="http://www.ubibot.cn/" target="_blank"> <img class="responsive" src="<?php echo get_template_directory_uri(); ?>/assets/images/datas.png" alt="轻松连™大数据平台" ></a>
                    <p class="text-center">轻松连™大数据平台</p>
                </div>
            </li>
        </ul>
            <ul class="controls">
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/prev.png" alt="previous"></li>
                <li><img src="<?php echo get_template_directory_uri(); ?>/assets/images/next.png" alt="next"></li>
            </ul>

    </div>
</div>
<?php get_footer();


