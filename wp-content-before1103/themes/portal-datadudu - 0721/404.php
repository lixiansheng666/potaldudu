<?php get_header('404'); ?>
	<body>
		
		<div class="header">
			<img src="<?php echo get_template_directory_uri(); ?>/images/ico/footer-logo.png" />
		</div>
		
		<p class="error">404</p>
		
		<div class="content">
			<h2>您请求的页面没找到！</h2>
			
			<p class="text">
				你正在寻找的页面不存在或暂时不可用，您可能想要搜索我们的网站或浏览我们的网站。
			
				<form name="searchform" onSubmit="return dosearch();">
					<input type="hidden" name="sengine" value="http://www.google.com/search?q=www.datadudu.cn+" />
					<input type="text" name="searchterms" class="inputform">
					<input type="submit" name="SearchSubmit" value="Search" class="button"> 
				</form>
				<!-- Change www.yoursite.com to your website domain -->
			</p>
				
			<p class="links">
				<a id="button" href="http://www.datadudu.cn/">&larr; 返回</a> <a href="http://www.datadudu.cn/">首页</a> <a href="#">社区与文档</a> <a href="http://www.datadudu.cn/aboutus">关于我们</a> <a href="#">新闻活动</a>
				
			</p>
		</div>
		
	</body>
</html>