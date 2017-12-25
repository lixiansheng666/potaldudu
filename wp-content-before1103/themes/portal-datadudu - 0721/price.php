
<?php 
/**
 * Template Name:Price
 *
 */

get_header(); ?>

<div class="price">
    <div class="row-fluid  priceHeader">
    <img src="<?php echo get_template_directory_uri(); ?>/images/priceHeader.png" width="100%" height="auto">
    </div>

    <div class="container-fluid FeaturedProjects" style="margin-top: 60px">
        <div class="row text-center"style="margin-bottom: 40px">
            <div class="col-md-2"></div>
            <div class="col-md-2 col-sm-4 ">
                <img src="<?php echo get_template_directory_uri(); ?>/images/ico/highStability.png" style="width: 130px;height: auto;">
                <h4>高稳定性 </h4>
                <p> 采用多域分布式及多备份冗余架构，让平台服务可用性达99.95%，存储数据可用性不低于99.9999999%。</p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2 col-sm-4">
                <img src="<?php echo get_template_directory_uri(); ?>/images/ico/elasticity.png" style="width:auto;height: 105px;">
                <h4>弹性自由 </h4>
                <p> 根据资源用量可随时升级和切换不同套餐，所有功能API全部开放，数据转入转出轻松自由。</p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2 col-sm-4">
                <img src="<?php echo get_template_directory_uri(); ?>/images/ico/Safe.png" style="width:auto;height: 105px;">
                <h4>真安全</h4>
                <p> 高效DDoS 防护，加密安全密钥自由控制数据读写权限，安全无忧。</p>
            </div>
            <div class="col-md-2"></div>
        </div>

        <div class="row text-center">
            <div class="col-md-2"></div>
            <div class="col-md-2 col-sm-4">
                <img src="<?php echo get_template_directory_uri(); ?>/images/ico/inexpensive.png" style="width: 130px;height: auto;">
                <h4>   低成本</h4>
                <p> 高性价比，即付即用，无需服务器网络和硬件等维护，0 成本运维。</p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2 col-sm-4">
                <img src="<?php echo get_template_directory_uri(); ?>/images/ico/high-performance.png" style="width:auto;height: 105px;">
                <h4>高性能 </h4>
                <p> 平台具备PB级高速数据服务能力，扫清一切性能瓶颈。</p>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-2 col-sm-4">
                <img src="<?php echo get_template_directory_uri(); ?>/images/ico/big-data.png" style="width: 130px;height: auto;">
                <h4>迈向大数据</h4>
                <p>强大的可视化图形页面、数据分析、数据智能预警、感应器指令管理等功能，让您轻松搭建出无穷的应用，真正让大数据改变我们的生活。</p>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>
    <div class="row-fluid text-center"style="color:#ffffff;background-color: #0068b7;padding: 15px 0"><h1>会员特权详情表</h1></div>
    <div class="row-fluid">
        <div class="col-xs-0 col-sm-1 col-md-1 col-lg-2"></div>
        <div class="col-xs-12 col-sm-5 col-md-5  col-lg-4" >

                <ul class="price_header">

                    <li>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/ico/new_user.png" style="float: left" class="price_user">
                        <h5 style="padding-top: 25px"><b>普通用户 </b></h5>
                        <h5><b>每个数据空间提供100MB免费存储空间及1GB对外数据流量
</b></h5>

                    </li>

                </ul>

        </div>

        <div class="col-xs-12 col-sm-5 col-md-5  col-lg-4">
            <div class="text-block">
                <ul class="item-list">

                    <li>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/ico/user.png" style="float: left" class="price_user">
                        <h5 style="padding-top: 25px"><b>轻松连智能硬件设备用户</b> </h5>
                        <h5><b>每个设备包含1GB免费存储空间及5GB对外数据流量</b></h5>

                    </li>
                </ul>

            </div>
        </div>
        <div class="col-xs-0 col-sm-1 col-md-1 col-lg-2"></div>
    </div>

</div>

<div class="container-fluid">
<div class="row-fluid price_table">
        <table class="table table-striped text-center">
            <thead class="text-center">
            <tr>
                <th class="text-center">套餐</th>
                <th class="text-center">存储空间</th>
                <th class="text-center">下载流量</th>
                <th class="text-center">费用</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>UbiBot 免费套餐</td>
                <td>100MB</td>
                <td>1GB</td>
                <td><button class="btn btn-info "><a href="">0元/月</a></button></td>
            </tr>

            <tr>
                <td>UbiBot 1G</td>
                <td>1GB</td>
                <td>5GB</td>
                <td><button class="btn btn-info"><a href="">5元/月</a></button></td>
            </tr>

            <tr>
                <td>UbiBot 2G</td>
                <td>2GB</td>
                <td>10GB</td>
                <td><button class="btn btn-info"><a href="">10元/月</a></button></td>
            </tr>

            <tr>
                <td>UbiBot 4G</td>
                <td>4GB</td>
                <td>20GB</td>
                <td><button class="btn btn-info"><a href="">20元/月</a></button></td>
            </tr>

            <tr>
                <td>UbiBot 8G</td>
                <td>8GB</td>
                <td>40GB</td>
                <td><button class="btn btn-info"><a href="">40元/月</a></button></td>
            </tr>

            <tr>
                <td>UbiBot 16G</td>
                <td>16GB</td>
                <td>80GB</td>
                <td><button class="btn btn-info"><a href="">80元/月</a></button></td>
            </tr>
            <tbody>

        </table>
</div>
</div>

<div class="container-fluid">
    <div class="row-fluid ">
        <div class=" col-sm-1 col-md-1 col-lg-1"></div>
        <div class="col-md-10 price_warn">
            <p class="text-center" style="color:#0068b7">流量仅计算数据流出量，数据流入量免费; 流量超过部分按0.7元/GB收取 <span style="color: #000000;">(当流量超出套餐，可设置自动关闭数据功能)</span></p>
        </div>
        <div class=" col-sm-1 col-md-1 col-lg-1"></div>
    </div>
</div>
<?php get_footer(); ?>

