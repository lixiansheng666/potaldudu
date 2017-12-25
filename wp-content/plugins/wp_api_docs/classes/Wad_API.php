<?php 
// Exit if accessed directly
if ( ! defined( "ABSPATH" ) ) exit;


if ( ! class_exists( "Wad_API" ) ) : 
    
class Wad_API { 
    
    public function __construct() {
       
    }
    
	
	
	/**
	 * Load Styles
	 */
	public static function load_styles()
	{
		wp_enqueue_style('wad_style');
		wp_enqueue_style('wad_colors');
		wp_enqueue_style('wad_responsive');
		wp_enqueue_style('wad_font_awesome_style');
	}
	
	/**
	 * Load Scripts
	 */
	public static function load_scripts()
	{
		wp_enqueue_script('wad_jscookie');
		wp_enqueue_script('wad_touchSwipe');
	}
	
	
	
	/**
	 * Get Header
	 */
	public static function get_header(){
		$template = WAD_TPL_DIR.'/wad/header-wad.php';
		require_once($template);
	}
	
	/**
	 * Get Footer
	 */
	public static function get_footer($args = array()){
		
		$default = array(
			'cookie' => 1
		);
		$args = wp_parse_args($args, $default);
		
		$template = WAD_TPL_DIR.'/wad/footer-wad.php';
		require_once($template);	
	}
    

}
    
endif;
?>