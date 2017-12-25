<?php 
// Exit if accessed directly
if ( ! defined( "ABSPATH" ) ) exit;


if ( ! class_exists( "Wad_CPTs" ) ) : 
    
class Wad_CPTs { 

	//public $category_slug = MAIN_WAD_CATEGORY;
    
    public function __construct() {
        add_action('init', array($this, 'register_wad_posttype'));
	    add_action('init', array($this, 'register_wad_taxonomy'));
	    add_filter( 'single_template', array($this, 'file_template'));
	    add_filter( 'archive_template', array($this, 'archive_template'));
		add_filter( 'template_include', array($this, 'search_template'), 1 );
	    
		add_action( MAIN_WAD_CATEGORY.'_add_form_fields', array($this, 'edit_wad_category_meta'), 10, 2 );
	   	add_action( MAIN_WAD_CATEGORY.'_edit_form_fields', array($this, 'edit_wad_category_meta'), 10, 2);
		add_action( 'edited_'.MAIN_WAD_CATEGORY, array($this, 'save_wad_category_meta'), 10, 2);
		add_action( 'create_'.MAIN_WAD_CATEGORY, array($this, 'save_wad_category_meta'), 10, 2 );
		
	    add_action( 'add_meta_boxes', array($this, 'wad_meta_options'));
		add_action( 'save_post', array($this, 'wad_meta_options_save_postdata'));
    }
    
	
	
	
	/* ----------------------------------------------------------------
	 * WAD Post Type
	 * ---------------------------------------------------------------- */
	public function register_wad_posttype() 
	{
		global $wad_main;
		
		$pt_name = __('Docs','wad');
		$pt_main_slg = MAIN_WAD_SLUG;
		$pt_main_slug = !empty( $pt_main_slg ) ? $pt_main_slg.'/' : '';
		$pt_name_clean = WAD_POST_TYPE;
	
		$labels = array(
			'name' 				=> $pt_name,
			'singular_name'		=> $pt_name,
			'add_new' 			=> __( 'Add New' ),
			'add_new_item' 		=> $pt_name,
			'edit_item' 		=> $pt_name,
			'new_item' 			=> $pt_name,
			'view_item' 		=> $pt_name,
			'search_items' 		=> $pt_name,
			'not_found' 		=> $pt_name,
			'not_found_in_trash'=> $pt_name,
			'parent_item_colon' => $pt_name,
			'menu_name'			=> $pt_name
		);
		
		//$taxonomies = array('post_tag'); // 'post_tag', 'category'
		
		//$supports = array('title','editor','author','thumbnail','excerpt','comments','revisions');
		$supports = array('title','editor','author','excerpt');
		
		$post_type_args = array(
			'labels' 			=> $labels,
			'singular_label' 	=> $pt_name,
			'public' 			=> true,
			'show_ui' 			=> true,
			'publicly_queryable'=> true,
			'query_var'			=> true,
			'capability_type' 	=> 'post',
			'has_archive' 		=> true,
			'hierarchical' 		=> false,
			'rewrite' 			=> array('slug' => $pt_main_slug.$pt_name_clean, 'with_front' => false ),
			'supports' 			=> $supports,
			//'menu_position' 	=> 5,
			'menu_icon' 		=> WAD_INC_URL.'/images/forum_ico_16.png',
			'show_in_menu'      => 'wad_menu',
			//'taxonomies'		=> $taxonomies
		 );
		 register_post_type($pt_name_clean, $post_type_args);
	}

    
	
	
	
	
	public function register_wad_taxonomy()
	{
		$pt_main_slg = MAIN_WAD_SLUG;
		$pt_main_slug = !empty( $pt_main_slg ) ? $pt_main_slg.'/' : '';
		
		// Register Tags
		register_taxonomy( 
			MAIN_WAD_TAGS, 
			array(WAD_POST_TYPE), 
			array( 
				'hierarchical' => false, 
				'labels' => array(
					'name'  => __('Docs Tag','wad'),
					'add_new_item'  => __( 'Add New Docs Tag', 'wad' ),
					'menu_name' => __( 'Doc Tags', 'wad' ), 
				), 
				'query_var' => true, 
				//'rewrite' => true,
				'rewrite' => array('slug' => $pt_main_slug.MAIN_WAD_TAGS, 'with_front' => false),
				'show_in_nav_menus' => false,
				'show_admin_column' => false,
				'show_tagcloud' => true,
			) 
		);
		
		// Register Categorie
		register_taxonomy( 
			MAIN_WAD_CATEGORY, 
			array(WAD_POST_TYPE), 
			array( 
				'hierarchical' => true, 
				'labels' => array(
					'name'  => __('Docs Category','wpfe'),
					'add_new_item'  => __( 'Add New Docs Category', 'wpfe' ),
					'menu_name' => __( 'Doc Categories', 'wpfe' ), 
				), 
				'query_var' => true, 
				//'rewrite' => true,
				'rewrite' => array('slug' => $pt_main_slug.MAIN_WAD_CATEGORY, 'with_front' => false),
				'show_in_nav_menus' => false,
				'show_admin_column' => false,
				'show_tagcloud' => false,
			) 
		);
		
		//register_taxonomy_for_object_type( MAIN_FE_TOPIC_CATEGORY, 'fetopic' );
		
		if( !term_exists( 'intro', MAIN_WAD_CATEGORY ) && !wp_count_terms( MAIN_WAD_CATEGORY, array('hide_empty' => false) ) )
		{
			wp_insert_term(
			  __('Intro','wad'), // the term 
			  MAIN_WAD_CATEGORY, // the taxonomy
			  array(
				'description'=> 'Intro pages.',
				'slug' => 'intro',
				'parent'=> 0
			  )
			);
		}	
	}
	
	
	
	
	
	public function edit_wad_category_meta($tag = '', $taxonomy = '')
	{
		$wad_cat_menu_pos = is_object($tag) ? get_option( "_wad_cat_menu_pos_".$tag->term_id, '' ) : '';
		?>
		<tr class="form-field">
			<th scope="row" valign="top"><label for="wad_cat_menu_pos"><?php _e('Menu Position','wad'); ?></label></th>
			<td>
				<input type="text" name="wad_cat_menu_pos" id="wad_cat_menu_pos" value="<?php echo $wad_cat_menu_pos; ?>" placeholder="1" /><br />
				<p class="description"><?php _e('Menu Position in the sidebar menu.','wad'); ?></p>
			</td>
		</tr>
		<?php
	}
	
	
	public function save_wad_category_meta($term_id, $tt_id)
	{
		if (!$term_id) return;
		
		if (isset($_POST['wad_cat_menu_pos']))
		{
			update_option( "_wad_cat_menu_pos_".$term_id, $_POST['wad_cat_menu_pos'] );
			//update_metadata($_POST['taxonomy'], $term_id, '_wad_cat_menu_pos', $_POST['wad_cat_menu_pos']);
		}
	}
	
	
	
	
	
	
	
	/*
	 * META OPTIONS
	 * Adds a box to the main column on the Post and Page edit screens.
	 *
	 * @access public
	*/
	public function wad_meta_options() 
	{	
		// Projects
		add_meta_box( 'wad_meta_options', __( 'Wiki API Docs - Page Options', 'wad' ), array($this, 'wad_meta_options_box'), WAD_POST_TYPE, 'normal', 'high' );
	}
	
	
	public function wad_meta_options_box( $post )
	{	
		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'wad_meta_options_inner_box', 'wad_meta_options_inner_box_nonce' );
		
		$wad_menu_pos = get_post_meta( $post->ID, '_wad_menu_pos', true );
		$wad_menu_pos = !empty($wad_menu_pos) ? $wad_menu_pos : 1;
		?>
        <div class="tuna_meta">
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row">
							<?php _e( "Menu Position", 'wad' ); ?>
							<span class="description"><?php _e('Define the order of apearance in the sidebar menu.', 'wad'); ?></span>
						</th>
						<td>
							<input type="number" name="wad_menu_pos" value="<?php echo $wad_menu_pos; ?>" />
							<div style="clear:both;"></div>
						</td>
					</tr>
					
				</tbody>
			</table>
		</div>
        <?php
	}
	
	public function wad_meta_options_save_postdata( $post_id ) 
	{		
		// Check if our nonce is set.
		if ( ! isset( $_POST['wad_meta_options_inner_box_nonce'] ) )
		return $post_id;
		$nonce = $_POST['wad_meta_options_inner_box_nonce'];
		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'wad_meta_options_inner_box' ) )
		  return $post_id;
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
		  return $post_id;
		// Check the user's permissions.
		if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
		} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
		}
		/* OK, its safe for us to save the data now. */
			
		// Sanitize user input.
		//$code = htmlspecialchars(stripslashes($_POST['snipr_code']));
		
		// Update the meta field in the database.
		update_post_meta( $post_id, '_wad_menu_pos', $_POST['wad_menu_pos'] );
	}
	
	
	
	
	
	
	/* ----------------------------------------------------------------
	 * Custom Single template - wpsnipr/Snipr_Project.php page
	 * ---------------------------------------------------------------- */
	public function file_template( $single )
	{
		global $wp_query, $post;
		
		// Docs
		if ($post->post_type == WAD_POST_TYPE){
			if ( is_single() ){
				
				/**
				 * Rewrite check, Snipr_Init.php - function custom_rewrite_tags()
				 * Check which file we need to use based on the query vars.
				 */
				//$file_name = array_key_exists( $snipr_init->edit_rewrite_endpoint, $wp_query->query_vars ) ? 'Snipr_Editor' : 'Snipr_Project';
				
				// checks if the file exists in the theme first,
				// otherwise serve the file from the plugin
				if ( $theme_file = locate_template( array( 'wad/single.php' ) ) )
				{
					$single = $theme_file;
					return $single;
				} 
				else 
				{
					return WAD_TPL_DIR. '/wad/single.php';
				}
			}
		}
		
		return $single;
	}
	
	
	
	public function search_template($single)
	{
		global $wp_query;
		
		/**
		 * Is WAD search
		 */
		if( is_search() ) 
		{
			if ( $_GET['post_type'] == WAD_POST_TYPE) 
			{	
				return WAD_TPL_DIR. '/wad/search.php';
			}
		}
		
		
		return $single;
	}
	
	
	
	
	public function archive_template($single)
	{
		global $wp_query, $post;
		
		
		
		/**
		 * Is WAD tag or category
		 */
		if( is_tax() )
		{
			$items = array(MAIN_WAD_CATEGORY, MAIN_WAD_TAGS);
			
			if(in_array(get_query_var( 'taxonomy' ), $items))
			{
				$cat = get_term_by('slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ));
				return WAD_TPL_DIR. '/wad/terms.php';
			}
		}
		
		
		/**
		 * Is WAD archive
		 */
		if( !empty($post) && $post->post_type == WAD_POST_TYPE){
			
			if ( $theme_file = locate_template( array( 'wad/archive.php' ) ) )
			{
				$single = $theme_file;
				return $single;
			} 
			else 
			{
				return WAD_TPL_DIR. '/wad/archive.php';
			}
		}
		
		return $single;
	}
	
	

}
    
endif;
?>