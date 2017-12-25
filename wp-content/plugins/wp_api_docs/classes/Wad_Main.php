<?php 
// Exit if accessed directly
if ( ! defined( "ABSPATH" ) ) exit;


if ( ! class_exists( "Wad_Main" ) ) : 
    
class Wad_Main { 
    
    public function __construct() {
       
    }
	
	
    
	/**
	 * Get WAD Categories
	 */
	public function get_categories($args = array())
	{
		$default = array(
			'hide_empty' => false,
			'parent' => 0,
			'order_by' => 'term_id',
			'order' => 'DESC'
		);
		$args = wp_parse_args($args, $default);
		$terms = get_terms( MAIN_WAD_CATEGORY, $args );	
		
		return $terms;
	}
	
	
	/**
	 * Custom sort terms
	 */
	public function custom_sorted_terms($terms)
	{
		$wad_array = array();
		
		foreach( $terms as $i=> $term ) 
		{
			$pos = get_option( "_wad_cat_menu_pos_".$term->term_id, $i );
			$wad_array[$pos] = array('name' => $term->name, 'term_id' => $term->term_id, 'description' => $term->description);
		}
		
		ksort( $wad_array, SORT_NUMERIC );
		return $wad_array;
	}
	
	
	
	
	/**
	 * Get WAD Posts
	 * $custom_args (array)
	 * returns array
	 */
	public function get_posts($custom_args = array())
	{
		// Get Posts
		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => WAD_POST_TYPE,
			'post_status'      => 'publish',
		);
		
		$query = new WP_Query( wp_parse_args( $custom_args, $args ));
		return $query->get_posts();
	}
	
	
	
	
	/**
	 * Term Menu
	 * $args (array)
	 * return html
	 */
	public function term_menu($args = array())
	{	
		$default = array(
			'level' => 0,
			'closed' => 0,
			'terms' => $this->get_categories(array('hide_empty' => true)),
		);
		$args = wp_parse_args($args, $default);
		
		$html = '';
		//$terms = $args['terms'];
		$terms = $this->custom_sorted_terms($args['terms']);
		$class = !$args['level'] ? ' class="sidebar_menu"' : '';
		$page_term = wp_get_post_terms( get_the_ID(), MAIN_WAD_CATEGORY );
		
		$html.= '<ul'.$class.'>';
		
			foreach( $terms as $i => $term )
			{
				$term_meta = get_option( "taxonomy_".$term['term_id'] );
				//$post_count = $term->count;
				$cur_term = !$args['closed'] && !empty($page_term) ? $page_term[0]->term_id == $term['term_id'] ? ' open' : '' : '';
				// Check for sub categories
				$sub_terms = get_terms(MAIN_WAD_CATEGORY, array('parent' => $term['term_id'] , 'hide_empty'=> true ));
				
				$has_childs = $sub_terms ? ' childs' : '';
				$html.= '<li class="wad_cat'.$cur_term.$has_childs.'">';
					$html.= '<a class="wad_menu wad_menu_cat" data-id="'.$term['term_id'].'" >'.$term['name'].'</a>';
				
					// Show sub categories
					if( $sub_terms)
					{
						$html.= $this->term_menu(array('level' => $i+1, 'terms' => $sub_terms, 'closed' => $args['closed']));
					}
					
					// Load Posts
					$posts = $this->get_posts(array(
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
						$html.= '<ul>';
							foreach($posts as $post){
								$cur_post = get_the_ID() == $post->ID ? ' selected' : '';
								$html.= '<li class="post'.$cur_post.'"><a href="'.get_permalink($post->ID).'" class="wad_menu'.$cur_post.'">'.$post->post_title.'</a></li>';
							}
						$html.= '</ul>';
					}
				
				$html.= '</li>'; //href="'.get_term_link($term->slug, MAIN_WAD_CATEGORY).'"
			
			}
		$html.= '</ul>';	
		
		return $html;
	}
	
	
	
	
	/**
	 * Highlite matching words in search result.
	 * $text (string)
	 * $words (string)
	 */
	public function highlight_search_terms($text, $words) 
	{
		preg_match_all('~\w+~', $words, $m);
		if(!$m)
			return $text;
		$re = '~\\b(' . implode('|', $m[0]) . ')\\b~';
		
		return preg_replace($re, '<b>$0</b>', $text);
	}

}
    
endif;
?>