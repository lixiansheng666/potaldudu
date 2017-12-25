<?php 
// Exit if accessed directly
if ( ! defined( "ABSPATH" ) ) exit;


if ( ! class_exists( "Wad_Templates" ) ) : 
    
class Wad_Templates { 
    
    public function __construct() {
       
    }
    
    
	/**
	 * SINGLE POST PAGE
	 */
	public function single_page()
	{
		Wad_API::load_scripts();
		Wad_API::load_styles();
		
		$html = '';
		$html.= '<div class="content">';
		
			$html.= $this->sidebar();
			
			$html.= '<div class="main main-content toppadding">';
				$html.= '<div class="inside">';
					
					if ( have_posts() ) : while ( have_posts() ) : the_post();
					
						$html.= '<h1>'.get_the_title().'</h1>';
						$html.= apply_filters( 'the_content', get_the_content());
						
					endwhile; else:
						$html.= '<center><h2>'.__('This post does not exists.', 'wad').'</h2></center>';
					endif;
					wp_reset_query();
					
				$html.= '</div>';
				
				$html.= $this->main_footer();
				
			$html.= '</div>';
			$html.= '<!-- end .main-content -->';
		$html.= '</div>';
		$html.= '<!-- end .content -->';
		
		
		return $html;
	}
	
	
	
	
	
	/**
	 * ARCHIVE PAGE (Home Page)
	 */
	public function archive_page()
	{
		Wad_API::load_scripts();
		Wad_API::load_styles();
		
		$wad_title = get_option('wad_title', __('Wiki API Docs','wad'));
		
		$html = '';
		$html.= '<div class="content">';
			
			$html.= $this->sidebar(array('closed' => 1));
		
			$html.= '<div class="main main-content toppadding">';
				$html.= '<div class="inside center">';
				
					$html.= '<div class="home_title">';
						$html.= '<h1>'.$wad_title.'</h1>';
					$html.= '</div>';
					$html.= '<!-- end .home_title -->';
					
					$html.= '<div style="margin-top:50px;">'.$this->search_box().'</div>';
					$html.= '<div style="margin-top:60px;">'.$this->category_boxes().'</div>';
					
				$html.= '</div>';
				
				$html.= $this->main_footer();
				
			$html.= '</div>';
			$html.= '<!-- end .main-content -->';
		$html.= '</div>';
		$html.= '<!-- end .content -->';
		
		return $html;
	}
	
	
	
	
	
	/**
	 * SEARCH PAGE
	 */
	public function search_page()
	{
		global $wad_main;
		
		Wad_API::load_scripts();
		Wad_API::load_styles();
		
		$html = '';
		$html.= '<div class="content">';
			
			$html.= $this->sidebar(array('closed' => 1));
		
			$html.= '<div class="main main-content toppadding">';
				$html.= '<div class="inside center">';
				
					$html.= '<div class="home_title">';
						$html.= '<h1>'.sprintf(__('Search Results for "%s"','wad'), $_GET['s']).'</h1>';
					$html.= '</div>';
					$html.= '<!-- end .home_title -->';
					
					$html.= '<div style="margin-top:50px;">'.$this->search_box(array('placeholder' => __('Looking for something else?','wad'))).'</div>';
					
					$html.= '<ul id="search_results" style="margin-top:60px;">';
						if ( is_search() && have_posts() ) : 
							
							while ( have_posts() ) : the_post();
								
								if( get_post_type() == WAD_POST_TYPE )
								{
									$title = $wad_main->highlight_search_terms(get_the_title(), $_GET['s']);
									$excerpt = $wad_main->highlight_search_terms(get_the_excerpt(), $_GET['s']);
									$term = wp_get_post_terms( get_the_ID(), MAIN_WAD_CATEGORY );
									
									$html.= '<li>';
										$html.= '<h3><a href="'.get_permalink(get_the_ID()).'">'.$title.'</a></h3>';
										$html.= '<span class="info">- '.$term[0]->name.'</span>';
										$html.= '<p>'.$excerpt.'</p>';
									$html.= '</li>';
									
								}
								
							endwhile; 
							
						endif;
						wp_reset_query();
					$html.= '</ul>';
					
				$html.= '</div>';
				
				$html.= $this->main_footer();
				
			$html.= '</div>';
			$html.= '<!-- end .main-content -->';
		$html.= '</div>';
		$html.= '<!-- end .content -->';
		
		return $html;
	}
	
	
	
	
	
	/**
	 * TERM PAGE 
	 */
	public function term_page()
	{
		//Wad_API::load_scripts();
		Wad_API::load_styles();
		
		$html = '';
		$html.= '<div class="content">';
			$html.= '<div class="main main-content toppadding">';
				$html.= '<div class="inside center">';
				
					$html.= $this->search_box();
					
					$html.= '<div>'.get_query_var( 'taxonomy' ).' '.get_query_var( 'term' ).'</div>';
					
					$html.= '<div class="boxt_container">';
					
						$html.= '<div class="boxt">';
							$html.= '<h2><a href="">Title</a></h2>';
							$html.= '<p>is a test that can distinguish a human being from an</p>';
						$html.= '</div>';
						$html.= '<div class="boxt">';
							$html.= '<h2><a href="">Title</a></h2>';
							$html.= '<p>is a test that can distinguish a human being from an</p>';
							$html.= '<ul>';
								$html.= '<li>';
									$html.= '<a href="">Item 1</a>';
								$html.= '</li>';
							$html.= '</ul>';
						$html.= '</div>';
						$html.= '<div class="boxt">';
							$html.= '<h2><a href="">Title</a></h2>';
							$html.= '<p>is a test that can distinguish a human being from an</p>';
						$html.= '</div>';
						$html.= '<div class="boxt">';
							$html.= '<h2><a href="">Title</a></h2>';
							$html.= '<p>is a test that can distinguish a human being from an</p>';
						$html.= '</div>';
						
						$html.= '<div class="clearfix"></div>';
						
					$html.= '</div>';
					$html.= '<!-- end .box_container -->';
				
				$html.= '</div>';
				
				$html.= $this->main_footer();
				
			$html.= '</div>';
			$html.= '<!-- end .main-content -->';
		$html.= '</div>';
		$html.= '<!-- end .content -->';
		
		return $html;
	}
	
	
	
	
	/**
	 * SIDEBAR
	 */
	public function sidebar($args = array())
	{
		global $wad_main;
		
		$default = array(
			'closed' => 0
		);
		$args = wp_parse_args($args, $default);
		
		$wad_logo = get_option('wad_logo', '');
		$wad_company = get_option('wad_company','');
		
		Wad_API::load_styles();
		
		$html = '';
		$html.= '<div id="sidebar" class="left">';
			$html.= '<div class="swipe-area toppadding">';
				$html.= '<a href="#" data-toggle="#sidebar" id="sidebar-toggle">';
					$html.= '<span class="bar"></span>';
					$html.= '<span class="bar"></span>';
					$html.= '<span class="bar"></span>';
				$html.= '</a>';
			$html.= '</div>';
			$html.= '<div id="split_bar" class="toppadding"></div>';
			$html.= '<div class="left_inside">';
				$html.= '<div class="sidebar_header">';
					
					if( !empty($wad_logo) ){
						$html.= '<div class="sblogo">';
							$html.= '<a href="'.get_bloginfo('url').'/'.WAD_POST_TYPE.'">';
								$html.= '<img src="'.$wad_logo.'" />';
							$html.= '</a>';
						$html.= '</div>';
					}
					$html.= '<div class="sbtitle">';
						$html.= '<div class="name">'.$wad_company.'</div>';
					$html.= '</div>';
				$html.= '</div>';
					
					$html.= $wad_main->term_menu($args);
					
					// Sidebar Widget
					$html.= '<div class="wad_sidebar_widgets">';
						ob_start();
						dynamic_sidebar('wad-sidebar');
						$html.= ob_get_contents();
						ob_end_clean();
					$html.= '</div>';
			
			$html.= '</div>';
			
			// Sidebar Bottom
			$html.= '<div class="sidebar_bottom">';
				$html.= '<a id="wad_bottom_menu" class="sb_bottom sb_bottom_is_closed"></a>';
			$html.= '</div>';
			
		$html.= '</div>';
		
		return $html;
	}
	
	
	
	
	public function category_boxes($args = array())
	{
		global $wad_main;
		
		$default = array(
			'level' => 0,
			'terms' => $wad_main->get_categories(array('hide_empty' => true)),
		);
		$args = wp_parse_args($args, $default);
		
		$terms = $wad_main->custom_sorted_terms($args['terms']);
		
		$html = '';
		$html.= '<div class="boxt_container">';
		
			foreach( $terms as $i => $term )
			{
				/**$html.= '<div class="boxt">';
					$html.= '<h2>'.$term['name'].'</h2>';
					$html.= '<p class="desc">'.$term['description'].'</p>';
					
					// Load Posts
					$posts = $wad_main->get_posts(array(
						'tax_query' => array(
							array(
								'taxonomy' => MAIN_WAD_CATEGORY,
								'field' => 'term_id',
								'terms' => array($term['term_id']),
								'include_children' => false
							)
						),
						'order'     => 'ASC',
						'orderby'   => 'meta_value_num',
						'meta_key'  => '_wad_menu_pos'
					));
					
					if($posts){
						$html.= '<ul style="padding:0 40px;">';
							foreach($posts as $post){
								$html.= '<li class="post"><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a></li>';
							}
						$html.= '</ul>';
					}
					
				$html.= '</div>';	*/
			}
			$html.= '<div class="clearfix"></div>';
		$html.= '</div>';
		$html.= '<!-- end .boxt_container -->';
		
		return $html;
	}
	
	
	
	public function main_footer()
	{
		$html = '';
		$html.= '<div id="footer">';
			
			// Footer Widget
			$html.= '<div class="wad_footer_widgets">';
				ob_start();
				dynamic_sidebar('wad-footer');
				$html.= ob_get_contents();
				ob_end_clean();
			$html.= '</div>';
			
        $html.= '</div>';
		
		return $html;	
	}
	
	public function footer($args)
	{
		wp_localize_script('wad_main', 'wad_data', $args);
		wp_enqueue_script('wad_main');
		
		$html = '';
		$html.= '<script type="text/javascript">';
			$html.= 'jQuery(document).ready(function($){';
				$html.= 'var wad_main = new wad_main_js();';	
			$html.= '});';
		$html.= '</script>';
		
		return $html;	
	}
	
	
	
	/**
	 * Search Box
	 */
	public function search_box($args = array())
	{
		$default = array(
			'placeholder' => __('Looking for something?','wad')
		);
		$args = wp_parse_args($args, $default);
		
		$html = '';
		$html.= '<div class="search_box">';
			$html.= '<form class="wad_search" role="search" action="'.site_url("/").'" method="get" id="wad_searchform">';
				$html.= '<input class="text" type="text" name="s" autocomplete="off" placeholder="'.$args['placeholder'].'">';
				$html.= '<input type="hidden" name="post_type" value="'.WAD_POST_TYPE.'" />';
			$html.= '</form>';
			$html.= '<span class="search_icon"></span>';
		$html.= '</div>';	
		
		return $html;	
	}

}
    
endif;
?>