<?php

/**
 * Template Name:app-download
 *
 */
get_header(); ?>
<div id="slider">
    <ul class="slides clearfix">
        <li>
            <div style="position: relative">
            <img class="responsive" src="<?php echo get_template_directory_uri(); ?>/images/bg1.png">
            </div>
        </li>

        <li>
            <div style="position: relative">
            <img class="responsive" src="<?php echo get_template_directory_uri(); ?>/images/bg3.png">
            </div>
        </li>
    </ul>
    <ul class="controls">
        <li><img src="<?php echo get_template_directory_uri(); ?>/images/ico/prev.png" alt="previous"></li>
        <li><img src="<?php echo get_template_directory_uri(); ?>/images/ico/next.png" alt="next"></li>
    </ul>
    <ul class="pagination">
        <li class="active"></li>
        <li></li>
      
    </ul>
</div>
<div class="text-center">
		<button type="button" onclick="window.open('https://itunes.apple.com/cn/app/%E8%BD%BB%E6%9D%BE%E8%BF%9E/id1237146577')" class="btn btn-default btn-lg" style="background-color: rgba(255,255,255,.15);width: 200px">
			<i class="fa fa-apple" style="margin-right:10px;color: #BCA480"></i><span style="color: #BCA480">IOS立即下载</span >
		</button>

		<button type="button" onclick="window.open('http://www.ubibot.cn/download/542/')"   class="btn btn-default btn-lg" style="background-color: rgba(255,255,255,.15);width: 200px">
			<i class="fa fa-android" style="margin-right:10px;color: #BCA480"></i><span style="color: #BCA480">Android立即下载</span>
		</button>
						
		<button type="button" onclick="window.open('http://www.ubibot.cn/download/509/')" class="btn btn-default btn-lg" style="background-color: rgba(255,255,255,.15);width: 200px">
			<i class="fa fa-windows" style="margin-right:10px;color: #BCA480"></i><span style="color: #BCA480">PC端立即下载</span >
		</button>
						
</div>

<?php if( $posts ) : ?>  
<?php $posts = get_posts( "category=68&numberposts=10" ); ?>  
<div class="text-center" style="line-height: 33px;margin-top: 15px;">
	<p  style="display: -webkit-inline-box;">需要我们帮助您设置设备吗？获取帮助信息:
	
		<select id="SpecificationId" name="select" class="form-control" style="width:200px;margin-right:15px;">
		<?php foreach( $posts as $post ) : setup_postdata( $post ); ?>
			
		  <option value="<?php the_permalink() ?>"><?php the_title(); ?></option>
		  <?php endforeach; ?>  
		</select>
		
		<button type="button" onclick="getSpecification()" class="btn btn-primary">前往</button>
		<!--<button type="button" onclick="window.open('<?php the_permalink() ?>')" class="btn btn-primary">前往</button>-->
	</p>
</div>
	<div><center><a id="download_app" href="../up_file/xyy.apk"><br/></a></center></div>
	<div class="weixin-tip">
		<p>
			<img src="<?php echo get_template_directory_uri(); ?>/images/live_weixin.png" alt="微信打开"/>
		</p>
	</div>
<?php endif; ?>
<script type="text/JavaScript">
                  function getSpecification() {
                  window.open(document.getElementById("SpecificationId").value);
                    }

 </script>
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

