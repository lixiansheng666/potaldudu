<?php 
/**
 * Plugin Name: Wiki API Docs
 * Plugin URI: 
 * Description: Wiki API Docs, Online Documentation Manager.
 * Version: 1.0.1
 * Author: 
 * Author URI: 
 * Requires at least: 3.8
 * Tested up to: 4.4.2
 */

// Exit if accessed directly
if ( ! defined( "ABSPATH" ) ) exit;
// Current plugin version
if ( ! defined( "WAD_VERSION" ) ) define( "WAD_VERSION", "1.0.1" );


if ( ! class_exists( "Wad_Main_Class" ) ) : 
    
class Wad_Main_Class { 
    
    /**
     * @var The single instance of the class
     */
    protected static $_instance = null;
    
    /**
     * Wad_Main_Class Instance
     *
     * Ensures only one instance of Wad_Main_Class is loaded or can be loaded.
     * @return Wad_Main_Class - Main instance
     */
    public static function instance() { 
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
    public function __construct() {
        global $wad_init;
        
        // Define constants
        $this->define_constants();
        
        // Classes ------------------------------------------------------------
        require_once( WAD_DIR."classes/Wad_Init.php");
        
        /* ----------------------------------------------------------------
         * Set Classes
         * ---------------------------------------------------------------- */
        $wad_init = new Wad_Init();
        
    }
    
    private function define_constants() {
		define( 'WAD_FOLDER', str_replace(basename( __FILE__),"",plugin_basename(__FILE__)));
		
        define( "WAD_URL", plugin_dir_url( __FILE__ ) );
        define( "WAD_DIR", plugin_dir_path( __FILE__ ) );
		
		define( 'WAD_INC_URL', WAD_URL. 'includes' );
		define( 'WAD_INC_DIR', WAD_DIR. 'includes' );
		define( 'WAD_TPL_URL', WAD_URL. 'templates' );
		define( 'WAD_TPL_DIR', WAD_DIR. 'templates' );
		
        define( "WAD_ROLE_ADMIN", "remove_users");
		
		define( 'MAIN_WAD_SLUG', get_option('wad_slug', ''));
		define( 'MAIN_WAD_CATEGORY', get_option('wad_category', 'wad-category'));
		define( 'MAIN_WAD_TAGS', get_option('wad_tags', 'wad-tags'));
		define( 'WAD_POST_TYPE', get_option('wad_post_type', 'docs'));
		
		load_plugin_textdomain( 'wad', false, plugin_basename( dirname( __FILE__ ) ) . '/localization' );
    }
    

}
    
endif;

/**
 * Returns the main instance of Wad_Main_Class to prevent the need to use globals.
 * @return Wad_Main_Class
 */
Wad_Main_Class::instance();

