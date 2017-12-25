<?php 
// Exit if accessed directly
if ( ! defined( "ABSPATH" ) ) exit;


if ( ! class_exists( "Wad_Init" ) ) : 
    
class Wad_Init { 
    
    public function __construct() 
	{
		global $wad_main, $wad_templates, $wad_cpts, $wad_shortcodes;
		
        // Load Functions -------------------------------------------------
        require_once( WAD_DIR."/includes/ajax_functions.php");
		
		// Load Classes ---------------------------------------------------
        require_once( WAD_DIR."/classes/Wad_Main.php");
		require_once( WAD_DIR."/classes/Wad_Templates.php");
		require_once( WAD_DIR."/classes/Wad_CPTs.php");
		require_once( WAD_DIR."/classes/Wad_Shortcodes.php");
		require_once( WAD_DIR."/classes/Wad_API.php");
		
		/* ----------------------------------------------------------------
         * Set Classes
         * ---------------------------------------------------------------- */
        $wad_main = new Wad_Main();
		$wad_templates = new Wad_Templates();
		$wad_cpts = new Wad_CPTs();
		$wad_shortcodes = new Wad_Shortcodes();
        
		// Actions --------------------------------------------------------
		add_action('wp', array($this, 'color_stylesheet'));
		//add_action('plugins_loaded', array($this, 'plugins_loaded'));
		add_action('init', array( $this, 'init_method'));
		//add_action('init', array( $this, 'custom_rewrite_tags'), 10, 0);
        add_action("admin_menu", array($this, "register_wad_menu"));
		add_action('admin_menu', array( $this,'admin_actions'));
		add_action('admin_head', array( $this, 'menu_highlight' ));
		add_action( 'widgets_init', array($this, 'widgets_init'));
		//add_action('after_setup_theme', array($this, 'theme_setup'), 11);
    }
    
	
	
	
	
	/**
	 * Plugins Loaded
	 */
	/*public function plugins_loaded()
	{
		define( 'MAIN_WAD_SLUG', get_option('wad_slug', ''));
		define( 'MAIN_WAD_CATEGORY', get_option('wad_category', 'wad-category'));
		define( 'MAIN_WAD_TAGS', get_option('wad_tags', 'wad-tags'));
		define( 'WAD_POST_TYPE', get_option('wad_post_type', 'docs'));
	}*/
	
	
	
	
	
	/**
	 * REWRITE TAGS
	 * add_rewrite_endpoint - edit name.
	 */
	/*public $edit_rewrite_endpoint = 'wad';
	
	public function wad_query_vars($query_vars)
	{
		$query_vars[] = $this->edit_rewrite_endpoint;
   		return $query_vars;
	}*/
	
	public function custom_rewrite_tags() 
	{
		/**
		 * Rewrite endpoint
		 * Used in WP_Snipr_CPTs.php - function snipr_file_template()
		 *
		 * http://codex.wordpress.org/Rewrite_API/add_rewrite_endpoint
		 */
		//add_rewrite_endpoint( $this->edit_rewrite_endpoint, EP_ALL );
		
		//add_rewrite_tag('%docs%', '([^&]+)'); //([0-9]+)
		//add_rewrite_tag('%sniprBranch%', '([^&]+)');
		//add_rewrite_tag('%sniprRaw%', '([^&]+)');
		//add_rewrite_tag('%pasREF%', '([^&]+)');
		
		// Functions are called in WP_Snipr_CPTs.php - snipr_editor_action()
		//$mod_rewrite_str = get_option('wp_snipr_mod_rewrite', 'snipr_new_project');
		//add_rewrite_rule('^'.$mod_rewrite_str.'/([^/]*)/?','index.php?sniprNewProject=$matches[1]','top'); // /([^/]*)/([^/]*)
		//add_rewrite_rule('^snipr_new_project_branch/([^/]*)/([^/]*)/?','index.php?sniprNewProject=$matches[1]&sniprBranch=$matches[2]','top');
		//add_rewrite_rule('^docs/([^/]*)/?','index.php?docs=$matches[1]','top');
	}
	
	
	
	
	
	
	
	/*
	 * Init actions
	 *
	 * @access public
	 * @return null
	*/
	public function init_method() 
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui-core');
		
		/**
		 * Register scripts & styles for later use
		 */
		wp_register_script('wad_jscookie', WAD_INC_URL . '/javascript/jquery.cookie.js' ); // , array( 'jquery' ), WAD_VERSION, true
		wp_register_script('wad_touchSwipe', WAD_INC_URL . '/javascript/jquery.touchSwipe.min.js', array( 'jquery' ), WAD_VERSION, true );
		wp_register_script('wad_main', WAD_INC_URL.'/javascript/wad_main.js');
		
		wp_register_style( 'wad_style', WAD_INC_URL."/css/wad_style.css", false, WAD_VERSION, "all" );
		wp_register_style( 'wad_colors', get_bloginfo('url')."?wad_stylesheet", false, WAD_VERSION, "all" );
		wp_register_style( 'wad_responsive', WAD_INC_URL."/css/responsive.css", false, WAD_VERSION, "all" );
		wp_register_style( 'wad_font_awesome_style', WAD_INC_URL.'/font-awesome/css/font-awesome.min.css', false, WAD_VERSION, 'all');
		
		
	}
	
	
	public function theme_setup()
	{
		/**
		 * Create Menu
		 */
		add_theme_support( 'menus' );
		/*register_nav_menus( array(
			'wad_menu' => __('Wad Menu', 'wad')
		) );*/
		register_nav_menu('wad_menu', __('Wad Menu', 'wad'));
	}
	
	
	
	public function admin_actions() 
	{
		global $snipr_vars;
		
		wp_enqueue_script('wp-color-picker');
    	wp_enqueue_style( 'wp-color-picker' );
		
		wp_enqueue_style( 'wad_admin_style', WAD_INC_URL . '/css/admin.css', false, WAD_VERSION, "all" );
		wp_enqueue_style( 'tuna_admin_style', WAD_INC_URL . '/css/tuna-admin.css', false, WAD_VERSION, "all" );
		wp_enqueue_style( 'tuna_admin_colors', WAD_INC_URL . '/css/tuna-admin-colors.php', false, WAD_VERSION, "all" );
		
		wp_enqueue_style( 'wad_font_awesome_style');
	}
	
	
	
	public function widgets_init()
	{
		// Sidebar Widgets
		register_sidebar(array(
				'name' => __( 'Wiki API Docs Sidebar', 'wad' ),
				'id' => 'wad-sidebar',
				'description' => __( 'Widgets in this area will be shown in the Wiki API Docs sidebar under the menu items.', 'wad' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="wad-widget-title">',
				'after_title'   => '</h2>',
		));
		
		// Footer Widgets
		register_sidebar(
			array(
				'name' => __( 'Wiki API Docs Footer', 'wad' ),
				'id' => 'wad-footer',
				'description' => __( 'Widgets in this area will be shown in the Wiki API Docs footer.', 'wad' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h2 class="wad-widget-title">',
				'after_title'   => '</h2>',
		));
	}

	
	
	
	
	/**
	 * Register Admin Menu
	 */
	public function register_wad_menu()
	{
		global $snipr_vars;
		
		$user_can = WAD_ROLE_ADMIN;
		
		add_object_page(__("Wiki API Docs",'wad'), __("Wiki API Docs",'wad'), $user_can, "wad_menu", array($this, "wad_menu_dashboard"), 'dashicons-book-alt');
		add_submenu_page("wad_menu", __('Dashboard', 'wad'), __('Dashboard', 'wad'), $user_can, "wad_menu", array( $this, "wad_menu_dashboard"));
		add_submenu_page('wad_menu', __('Categories','wad'), __('Categories','wad'), WAD_ROLE_ADMIN, 'edit-tags.php?taxonomy='.MAIN_WAD_CATEGORY.'&post_type='.WAD_POST_TYPE);
		add_submenu_page('wad_menu', __('Tags','wad'), __('Tags','wad'), WAD_ROLE_ADMIN, 'edit-tags.php?taxonomy='.MAIN_WAD_TAGS.'&post_type='.WAD_POST_TYPE);
		
		// Order Sub menus
		if( current_user_can($user_can))
		{
			add_filter( 'custom_menu_order', array($this, 'submenu_order') );
		}
	}
	
	
	public function wad_menu_dashboard()
	{
		global $snipr_vars;
		
		include( WAD_TPL_DIR.'/wad_dashboard.php');
	}
	
	
	/**
	 * Order submenus.
	 */
	function submenu_order( $menu_ord ) 
	{
		global $submenu;
			
		// Enable the next line to see all menu orders
		if( isset($submenu['wad_menu']))
		{
			$arr = array();
			$arr[] = $submenu['wad_menu'][1];
			$arr[] = $submenu['wad_menu'][0];
			$arr[] = $submenu['wad_menu'][3];
			$arr[] = $submenu['wad_menu'][2];
			$submenu['wad_menu'] = $arr;
		}
	
		return $menu_ord;
	}
	
	
	/**
	 * Highlights the correct top level admin menu item for post types.
	 */
	public function menu_highlight() 
	{
		global $menu, $submenu, $parent_file, $submenu_file, $self, $post_type, $taxonomy;
		
		if ( isset( $post_type ) && $post_type == WAD_POST_TYPE) 
		{	
			if(isset( $taxonomy) && !is_object($taxonomy))
			{
				$submenu_file = 'edit-tags.php?taxonomy=' . esc_attr( $taxonomy ).'&post_type='.esc_attr( $post_type );
			}
			else
			{
				$submenu_file = 'edit.php?post_type=' . esc_attr( $post_type );
			}
			
			$parent_file  = 'wad_menu';
		}
	}
	
	
	
	
	public function color_stylesheet()
	{
		if(isset($_GET['wad_stylesheet']))
		{
			require_once(WAD_INC_DIR.'/css/wad_colors.php');
			exit;	
		}
	}

}
    
endif;
?>