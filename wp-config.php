<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */

error_reporting(-1);

// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
define('DB_NAME', 'shop');

/** MySQL数据库用户名 */
define('DB_USER', 'datadudu_wp');

/** MySQL数据库密码 */
define('DB_PASSWORD', 'K5VZALW3GFhU6QZS');

/** MySQL主机 */
define('DB_HOST', 'localhost');

/** 创建数据表时默认的文字编码 */
define('DB_CHARSET', 'utf8mb4');

/** 数据库整理类型。如不确定请勿更改 */
define('DB_COLLATE', '');

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/
 * WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '&%QXS3)~mk>3[5(=b3&TCZ0Jl*2~|=unflNR+bd570l#&hu1%+;/*tLfUcXvJy{3');
define('SECURE_AUTH_KEY',  ':RCTb9VC$vE|nu!8o+7<oRC},,2K+nZR9vSbMuGbW;dw!/zksIO kl+w1:|BSJ&l');
define('LOGGED_IN_KEY',    'B.}]H}~Ne.O&z&K_5(&OY{v(<;nSLR%}* XQ3X[3I3AJ$sS>-kUz23.BAl)U-@?{');
define('NONCE_KEY',        '^xh=<#wg~WK;*0:-ec6o!Yy`Q{!>k$B5sQ#F.+=BrIB-5mc9x[2NINawx[K=q=4D');
define('AUTH_SALT',        'WLxcLaS^J^X{8F1l~d%4Dtv_mm2DW%IJmB`(t_OQ}iCz:GmeSg.0ib[O?QR4c#f|');
define('SECURE_AUTH_SALT', '}>Cwb^M8qB zwV(&K(^nhN.1U6,[aArWG4wmz;Wfmg*1b8k0YFd%Wja>_3Jje>5<');
define('LOGGED_IN_SALT',   'C&b<hy4b7NXjw5s!n7WKOE.x#+BfW$XBPx_r%%1%9H?nN.JVaX@j5Z*V5Qn;OgLF');
define('NONCE_SALT',       '=tdE3d#|8EIbopqS4R@=0>8|]W}8mXxrPMN_AdAYa Ur)8T%9}6<&DR&IB{yx[6n');

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix  = 'dudu';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/**
 * zh_CN本地化设置：启用ICP备案号显示
 *
 * 可在设置→常规中修改。
 * 如需禁用，请移除或注释掉本行。
 */
define('WP_ZH_CN_ICP_NUM', true);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** 设置WordPress变量和包含文件。 */
require_once(ABSPATH . 'wp-settings.php');
