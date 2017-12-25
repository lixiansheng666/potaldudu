<?php
/**
 * Template Name:app-download
 *
 */
get_header(); ?>
<div class="container-fluid app" style="background-color: #f2f2f2">
	<div class="row" style="">
<div class="col-lg-12 col-xs-12 col-sm-12" style="padding: 0px 20px;">
	<div class="col-sm-1 col-md-1 col-lg-2"></div>
	<div class="col-sm-9 col-md-8 col-lg-5" style="padding: 100px 20px 100px 20px;">
	    <p style="font-size: 50px;color: #fff;margin-bottom: 30px;">多平台接入</p>
	    <p style="font-size: 20px;color: #fff;">跨平台的物联网应用接入，全面支持桌面浏览器及iOS、Android、PC离线工具，让您随时随地了解您的设备动态，掌握您的轻松连无线环境感知设备数据。</p>

		<div class="col-sm-4 col-md-4 col-lg-3 text-center" style="padding:0px;">
		<button type="button" onclick="window.open('//itunes.apple.com/cn/app/%E8%BD%BB%E6%9D%BE%E8%BF%9E/id1237146577')" class="col-sm-12 col-md-12 col-lg-12 btn btn-lg" onMouseOut="this.style.backgroundColor='#008cd7'" onMouseOver="this.style.backgroundColor='#00b3ca'" style="font-size:10px;background-color: #008cd7;border-radius: 20px;margin-top: 50px;margin-bottom:9px;padding: 12px 8px 12px 8px;">
			<i class="fa fa-apple" style="margin-right:5px;color: #fff;"></i><span style="color: #fff;">iOS下载</span>
		</button>
		<span style="font-size: 12px;color: #fff;margin-top: 10px;">支持IOS 9.0+的设备</span>
        </div>

		<div class="col-sm-4 col-md-4 col-lg-3 text-center" style="padding:0px 0px 0px 10px;">
		<button type="button" onclick="window.open('<?php echo home_url();?>/download/542/','_self')"   class="col-sm-12 col-md-12 col-lg-12 btn btn-lg" onMouseOut="this.style.backgroundColor='#008cd7'" onMouseOver="this.style.backgroundColor='#00b3ca'" style="font-size:10px;background-color: #008cd7;border-radius: 20px;margin-top: 50px;margin-bottom:9px;padding: 6px 8px 2px 8px;">
			<i class="fa fa-android" style="margin-right:5px;color: #fff;"></i>
			<span style="color: #fff;">Android下载
				<br><span style="font-size: 12px;">v<?php echo do_shortcode( '[download_data id="542" data="version"]' );?></span>
			</span>
		</button>
		<span style="font-size: 12px;color: #fff;margin-top: 10px;">支持Android4.2+的设备</span>
        </div>

		<div class="col-sm-4 col-md-4 col-lg-6 text-center">
			<div class="col-sm-4 col-md-4 col-lg-3 text-center hoverchangecolor" style="margin-top: 50px;padding:0px;">
				<a href="http://appstore.huawei.com/app/C100018127" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/huawei.png">
					<p style="font-size: 12px;color: #fff;margin-top: 5px;">华为应用</p>
				</a>
			</div>
			<div class="col-sm-4 col-md-4 col-lg-3 text-center hoverchangecolor" style="margin-top: 50px;padding:0px;">
				<a href="http://app.mi.com/details?id=com.datadudu.ubibot&ref=search" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/xiaomi.png">
					<p style="font-size: 12px;color: #fff;margin-top: 5px;">小米应用</p>
				</a>
			</div>
			<div class="col-sm-4 col-md-4 col-lg-3 text-center hoverchangecolor" style="margin-top: 50px;padding:0px;">
				<a href="http://android.myapp.com/myapp/detail.htm?apkName=com.datadudu.ubibot" target="_blank">
					<img src="<?php echo get_template_directory_uri(); ?>/images/yingyongbao.png">
					<p style="font-size: 12px;color: #fff;margin-top: 5px;">腾讯应用宝</p>
				</a>
			</div>

		</div>

		<div class="col-sm-10 col-md-10 col-lg-10" style="margin-top: 50px;padding:0px;">
		<span style="font-size: 12px;color: #fff;">注：网页导入安卓客户端的用户，请允许手机安全来源设置中的安装未知来源的设置；若无法安装，请根据手机型号对应的应用市场页面进行下载。</span>
		</div>

		<div class="col-sm-10 col-md-10 col-lg-12" style="margin-top: 50px;padding:0px;">
		<div class="col-sm-4 col-md-4 col-lg-3" style="padding:0px;">
		<button type="button" onclick="window.open('<?php echo home_url();?>/download/634/')" class="col-sm-12 col-md-12 col-lg-12 btn btn-lg" onMouseOut="this.style.backgroundColor='#008cd7'" onMouseOver="this.style.backgroundColor='#00b3ca'" style="font-size:10px;background-color: #008cd7;border-radius: 20px;">
			<i class="fa fa-windows" style="margin-right:5px;color: #fff;"></i><span style="color: #fff;">离线工具
			<span style="font-size: 12px;">v<?php echo do_shortcode( '[download_data id="634" data="version"]' );?></span>
			</span >
		</button>
		</div>
		<div class="col-sm-8 col-md-8 col-lg-7" >
			<span class="col-sm-12 col-md-12 col-lg-12" style="padding: 0px;font-size: 12px;color: #fff;margin-top: 5px;">仅供设备在离线状态下使用，需Windows7+且<a href="//pan.baidu.com/s/1i4M7IML" target="_blank" style="text-decoration: underline;color: #fff;">.NET Framework4.5+</a>及以上版本。</span>
		</div>
        </div>


	</div>

</div>
</div>
</div>


	<div class="col-lg-12 col-xs-12 col-sm-12 text-center"  >
		<div class="col-lg-2"></div>
		   <div class="col-sm-4 col-md-4 col-lg-3" style="padding: 20px 25px 20px 25px;">
			       <div class='container2'>
			   <h3 style="font-size: 28px;margin-bottom: 10px;text-align: left;">线上使用</h3>
			   <p class="onlyPCmargin1" style="text-align: left;">设备可通过WiFi直接接入大数据平台，并可在多种终端进行方位使用及数据实时采集与传输。</p>
			   <img src="<?php echo get_template_directory_uri(); ?>/images/online.png" style="padding-top: 10px;">
			   <h3 style="font-size: 28px;padding-top: 0px;text-align: left;">线下使用</h3>
			   <p class="onlyPCmargin1" style="margin-bottom: 10px;text-align: left;">无网络情况下，设备可通过USB和WiFi AP两种方式进行数据读取和设备配置。</p>
			   <img src="<?php echo get_template_directory_uri(); ?>/images/underline.png" >
				   </div>
           </div>

		<div class="col-sm-4 col-md-4 col-lg-3" style="padding: 20px 25px 20px 25px;">

				<?php
				global $post;
				$args = array( 'posts_per_page' => 6,'category_name'=> 'releases', 'order'=> 'DESC');
				?>
				<h3 style="font-size: 28px;margin-bottom: -10px;text-align: left;">版本记录<span style="font-size:15px;float: right;text-align: right;margin-top:8px;"><button type="button" class="btn btn-default btn-xs" style="width: 70px;border-radius: 50px;color: #000;" onclick="javascrtpt:window.location.href='<?php echo site_url() . '/category/releases'; ?>'">更多>></button></span></h3>
				<ul  class="clearfix inside text-left onlyPCmargin2" style="font-size: 15px;">
					<?php
					$rand_posts = get_posts( $args );
					foreach ( $rand_posts as $post ) :
					setup_postdata( $post ); ?>
					<li class="onlyPCmargin1"><img src="<?php echo get_template_directory_uri(); ?>/images/dian.gif" style="padding-right: 8px;"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a><span style="float: right;text-align: right;"><?php the_date("m-d"); ?></span></li>
					<?php endforeach;
					wp_reset_postdata(); ?>


				</ul>



			<h3 style="font-size: 28px;margin-bottom: 0px;text-align: left;margin-top: 0px;" class="instructionpc">说明书下载<span style="font-size:15px;float: right;text-align: right;margin-top:8px;"><button type="button" class="btn btn-default btn-xs" style="width: 70px;border-radius: 50px;color: #000;" onclick="javascrtpt:window.location.href='<?php echo site_url() . '/category/manuals'; ?>'">更多>></button></span></h3>
<!--				<div class="col-sm-1 col-md-1 col-lg-1"></div>-->
				<?php
				global $post;
				$args = array( 'posts_per_page' => 6,'category_name'=> 'manuals', 'order'=> 'ASC',);
				$rand_posts = get_posts( $args );
				foreach ( $rand_posts as $post ) :
					setup_postdata( $post ); ?>
					<div class="col-sm-4 col-md-4 col-lg-4 hoverchangecolor" style="padding: 20px 20px 20px 0px;">
						<a href="<?php echo the_permalink(); ?>">
							<img src="<?php echo catch_that_image() ?>" style="height: 90px;" />
						<p style="font-size: 12px;"><?php the_title(); ?></p>
						</a>
					</div>
				<?php endforeach;
				wp_reset_postdata(); ?>


		</div>
		<div class="col-sm-4 col-md-4 col-lg-3" style="padding: 20px 25px 20px 25px;">
			<div class='container2'>
				<?php
				global $post;
				$args = array( 'posts_per_page' => 10,'category_name'=> 'faqs', 'order'=> 'ASC');
				?>

				<h3 style="font-size: 28px;text-align: left;">常见问题<span style="font-size:15px;float: right;text-align: right;margin-top:8px;"><button type="button" class="btn btn-default btn-xs" style="width: 70px;border-radius: 50px;color: #000;" onclick="javascrtpt:window.location.href='<?php echo site_url() . '/category/faqs'; ?>'">更多>></button></span></h3>



				<ul class="clearfix inside text-left" style="font-size: 15px;color:dodgerblue" >

					<?php
					$rand_posts = get_posts( $args );
					foreach ( $rand_posts as $post ) :
						setup_postdata( $post ); ?>
						<li class="onlyPCmargin1"><img src="<?php echo get_template_directory_uri(); ?>/images/dian.gif" style="padding-right: 8px;"><a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach;
					wp_reset_postdata(); ?>

				</ul>
			</div>
	</div>
		<div class="col-lg-2"></div>
</div>



	<div class="weixin-tip">
		<p>
			<img src="<?php echo get_template_directory_uri(); ?>/images/live_weixin.png" alt="微信打开"/>
		</p>
	</div>


<?php get_footer(); ?>

<script type="text/JavaScript">
	function getSpecification() {
		window.open(document.getElementById("SpecificationId").value);
	}

</script>
<!-- jQuery -->

<script src="<?php echo get_template_directory_uri(); ?>/js/easySlider.js"></script>
<!-- Bootstrap Core JavaScript -->

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
<script type="text/javascript">
	$(window).on("load",function(){
		var winHeight = $(window).height();

		$("#download_app").hide();

		function is_weixin() {
			var ua = navigator.userAgent.toLowerCase();
			//alert(ua);  //浏览器   mozilla/5.0 (windows nt 6.1) applewebkit/537.36(khtml,like gecko) chrome/41.0.2272.12 safari/53736
			//微信   mozilla/5.0 (linux;u;android 4.4.2;zh-cn;coolpad 8675 build/kot49h) applewebkit/533.1 (khtml,like gecko)version/4.0 mqqbrowser/5.4 tbs/025440 mobile safari/533.1 micromessenger/6.2.4.53_r843fb8e.600 nettype/wifi language/zh_cn

			if (ua.match(/MicroMessenger/i) == "micromessenger") {
				return true;
			} else {
				return false;
			}
		}
		var isWeixin = is_weixin();
		if(isWeixin){
			$(".weixin-tip").css("height",winHeight);
			$(".weixin-tip").show();
		}else{
			$("#download_app").show();
		}
	})
</script>
