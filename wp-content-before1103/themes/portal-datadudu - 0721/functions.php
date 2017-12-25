<?php
function mytheme_get_avatar($avatar) {

    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"gravatar.duoshuo.com",$avatar);

    return $avatar;

}

//fix XML-RPC attack bug
add_filter( 'xmlrpc_methods', 'remove_xmlrpc_pingback_ping' );
function remove_xmlrpc_pingback_ping( $methods ) {
	unset( $methods['pingback.ping'] );
	return $methods;
}


add_filter( 'get_avatar', 'mytheme_get_avatar', 10, 3 );
//解决用户头像不显示问题

/*
register_nav_menu( $location, $description )
函数功能：开启导航菜单功能
@参数 string $location, 导航菜单的位置
@参数 string $description, 导航菜单的描述
开启多个位置的导航菜单，只需要重复调用此函数即可
*/
register_nav_menu( 'daohangding', '网站的顶部导航' );  //注册一个菜单
register_nav_menu( 'daohangzhu', '网站的主导航' );     //注册一个菜单
register_nav_menu( 'daohangdi', '网站的底部导航' );     //注册一个菜单

/*
register_sidebar( $args )
函数功能：开启侧边栏功能
@参数 array $args，参数是一个数组，包含多个成员参数。
所有可选的成员参数，都包含在下面的示例代码中。
*/

register_sidebar( array(
  'name'						=> '侧边栏',					//侧边栏的名称
  'id'								=> 'sidebar-1',					//侧边栏的编号
  'description'				=> '侧边栏',					//侧边栏的描述
  'class'						=> '',
  'before_widget'			=> '<li id="%1$s" class="widget %2$s">',
  'after_widget'			=> '</li>',
  'before_title'				=> '<h3>',
  'after_title'					=> '</h3>' 
) );



/**
* 想要wp_title()函数实现，访问首页显示“站点标题-站点副标题”
* 如果存在翻页且正方的不是第1页，标题格式“标题-第2页”
* 当使用短横线-作为分隔符时，会将短横线转成字符实体&#8211;
* 而我们不需要字符实体，因此需要替换字符实体
* wp_title()函数显示的内容，在分隔符前后会有空格，也要去掉
*/
add_filter('wp_title', 'domi_wp_title', 10, 2);
function domi_wp_title($title, $sep) {
	global $paged, $page;

	//如果是feed页，返回默认标题内容
	if ( is_feed() ) { 
		return $title;
	}

	// 标题中追加站点标题
	$title .= get_bloginfo( 'name' );

	// 网站首页追加站点副标题
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// 标题中显示第几页
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( '第%s页', max( $paged, $page ) );

	//去除空格，-的字符实体
	$search = array('&#8211;', ' ');
	$replace = array('-', '');
	$title = str_replace($search, $replace, $title);

	return $title;	
}
/*
add_theme_support($features, $arguments)
函数功能：开启缩略图功能
@参数 string $features, 此参数是告诉wordpress你要开启什么功能
@参数 array $arguments, 此参数是告诉wordpress哪些信息类型想要开启缩略图
第二个参数如果不填写，那么文章信息和页面信息都开启缩略图功能。
*/
add_theme_support('post-thumbnails');
set_post_thumbnail_size(265, 132, true);

/*
	add_image_size( $name, $width, $height, $crop )
	函数功能：增加一种新尺寸的图片

	特别说明：
	一般情况下，当你上传一张图片时，除了上传的原图外，wordpress还会把原图结成三种尺寸的图片，一个是“缩略图”， 一个是“中等尺寸图”，一个是“大尺寸图片”。
	如果你的网站，需要两种尺寸的缩略图，比如一个是150*150， 一个是150*180。而你在上传图片时，wordpress默认只能生成一种尺寸的。
	而通过此函数，可以让wordpress在原图的基础上修改出两种尺寸的缩略图

	@参数$name, 增加的新尺寸图片的名称。比如,thumbnail代表的是缩略图，medium代表的是中等尺寸图，large代表的是大尺寸图，full代表的是完整尺寸图。那么你新创建的这个尺寸的图片，叫什么名字？你自己命名即可

	@参数$width,	代表的是你设置的新尺寸的宽度是多少？填写数字，不用写单位。因为单位默认为像素即px

	@参数$height, 代表的是你设置的新尺寸的高度是多少？填写数字，不用单位

	@参数$crop, 代表的是压缩模式还是剪切模式。

	范例：
	//当上传图片时，给我新生成一种尺寸的图片。尺寸为300*200, 缩放模式
	add_image_size( 'cat-thumb', 300, 200, false ); 

	// 当上传图片时，给我新生成一种尺寸的图片。尺寸为220*180, 裁剪模式
	add_image_size( 'hom-thumb', 220, 180, true ); 
*/
//add_action('login_enqueue_scripts','login_protection');
//function login_protection()
	//{
	//if($_GET['best'] != 'cloud')header('Location: http://www.datadudu.cn/');
	//}
	
	// add more buttons to the html editor
function appthemes_add_quicktags() {
    if (wp_script_is('quicktags')){
?>
    <script type="text/javascript">
	
	QTags.addButton( 'API标题样式', 'API标题样式', '\n<span style="color: #3187bf; font-size: 18pt; background-color: #d9edf7;">', '</span>\n' );
	QTags.addButton( 'API发送地址', 'API发送地址', '\n<span style="color: #a94442; background-color: #f2dede;">', '</span>\n' );
	QTags.addButton( '注意', '注意', '\n<span style="color: #ffffff; background-color: #ff3366;">', '</span>\n' );
	QTags.addButton( '请求参数', 'API有效的请求参数', '\n<table style="height: 132px; width: 599px; background-color: #dff0d8;"><tbody><tr><td style="width: 589px;"><ul>', '</ul></td></tr></tbody></table>\n' );
	

    </script>

    </script>
<?php
    }
}
add_action( 'admin_print_footer_scripts', 'appthemes_add_quicktags' );


	
//API Add transposh

/*
add_theme_support($features, $arguments)
函数功能：开启缩略图功能
@参数 string $features, 此参数是告诉wordpress你要开启什么功能
@参数 array $arguments, 此参数是告诉wordpress哪些信息类型想要开启缩略图
第二个参数如果不填写，那么文章信息和页面信息都开启缩略图功能。
*/
add_theme_support('post-thumbnails');

//the_post_thumbnail("thumbnail"); // 小缩略图 (默认 150px x 150px )
//the_post_thumbnail("medium"); // 中缩略图 (默认 300px x 300px )-自适应图像比例
//the_post_thumbnail("large"); // 大缩略图 (默认 640px x 640px )-自适应图像比例
//the_post_thumbnail("full"); // 完整尺寸
//the_post_thumbnail( array(600,600) ); // 自定义大小
set_post_thumbnail_size(350, 250, true);



/*
	add_image_size( $name, $width, $height, $crop )
	函数功能：增加一种新尺寸的图片

	特别说明：
	一般情况下，当你上传一张图片时，除了上传的原图外，wordpress还会把原图结成三种尺寸的图片，一个是“缩略图”， 一个是“中等尺寸图”，一个是“大尺寸图片”。
	如果你的网站，需要两种尺寸的缩略图，比如一个是150*150， 一个是150*180。而你在上传图片时，wordpress默认只能生成一种尺寸的。
	而通过此函数，可以让wordpress在原图的基础上修改出两种尺寸的缩略图

	@参数$name, 增加的新尺寸图片的名称。比如,thumbnail代表的是缩略图，medium代表的是中等尺寸图，large代表的是大尺寸图，full代表的是完整尺寸图。那么你新创建的这个尺寸的图片，叫什么名字？你自己命名即可

	@参数$width,	代表的是你设置的新尺寸的宽度是多少？填写数字，不用写单位。因为单位默认为像素即px

	@参数$height, 代表的是你设置的新尺寸的高度是多少？填写数字，不用单位

	@参数$crop, 代表的是压缩模式还是剪切模式。

	范例：
	//当上传图片时，给我新生成一种尺寸的图片。尺寸为300*200, 缩放模式
	add_image_size( 'cat-thumb', 300, 200, false ); 

	// 当上传图片时，给我新生成一种尺寸的图片。尺寸为220*180, 裁剪模式
	add_image_size( 'hom-thumb', 220, 180, true ); 
*/
//输出缩略图地址 From wpdaxue.com






/**
 * lingfeng_strimwidth( ) 函数
 * 功能：字符串截取，并去除字符串中的html和php标签
 * @Param string $str			要截取的原始字符串
 * @Param int $len				截取的长度
 * @Param string $suffix		字符串结尾的标识
 * @Return string					处理后的字符串
 */
function lingfeng_strimwidth( $str, $len, $start = 0, $suffix = '……' ) {
    $str = str_replace(array(' ', '　','&nbsp;', '\r\n'), '', strip_tags( $str ));
    if ( $len>mb_strlen( $str ) ) {
        return mb_substr( $str, $start, $len );
    }
    return mb_substr($str, $start, $len) . $suffix;
}



//分页源码
function wp_nav( $p = 2 ){  if ( is_singular() ) return;
    global $wp_query, $paged;  $max_page = $wp_query->max_num_pages;
    if ( $max_page == 1 ) return;  if ( empty( $paged ) ) $paged = 1;  echo '<span class="page-numbers">' . $paged . ' / ' . $max_page . ' </span> ';
    if ( $paged > 1 ) p_link( $paged - 1, __('&laquo; Previous'),__('&laquo; Previous') );  if ( $paged > $p + 1 ) p_link( 1, 'First page' );
    if ( $paged > $p + 2 ) echo '<span class="page-numbers">...</span>';  for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
        if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );  }
    if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers">...</span>';  if ( $paged < $max_page - $p ) p_link( $max_page, 'Last page' );
    if ( $paged < $max_page ) p_link( $paged + 1, __('Next &raquo;'), __('Next &raquo;') );}function p_link( $i, $title = '', $linktype = '' ){
    if ( $title == '' ) $title = "The {$i} page";  if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
    echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";}

//彩色标签
function colorCloud($text) {
    $text = preg_replace_callback('|<a (.+?)>|i','colorCloudCallback', $text);
    return $text;
}
function colorCloudCallback($matches) {
    $text = $matches[1];
    $color = dechex(rand(0,16777215));
    $pattern = '/style=(\'|\”)(.*)(\'|\”)/i';
    $text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
    return "<a $text>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);


//自定义小工具
function yundanran_sidebar_left()
{
    register_sidebar( array(
        'name' => 'tektea - 右边栏',
        'id' => 'sidebar-left',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h2 class="title">',
        'after_title' => '</h2>',
    ) );
}
add_action( 'widgets_init', 'yundanran_sidebar_left' );



?>



