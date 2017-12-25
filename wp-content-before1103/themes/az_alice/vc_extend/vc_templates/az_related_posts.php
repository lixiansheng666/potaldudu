<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $related_posts_module
* @var $related_posts_columns_count
* @var $related_posts_module_taxonomy_team
* @var $related_posts_module_taxonomy_portfolio
* @var $related_posts_exclude_ids
* @var $featured_img_size
* @var $related_posts_number
* @var $orderby
* @var $order
*/

/*
$output = $related_posts_module = $related_posts_columns_count = $related_posts_module_taxonomy_team = $related_posts_module_taxonomy_portfolio = $related_posts_exclude_ids = $featured_img_size = $related_posts_number = $orderby = $order = $el_class = '';
extract(shortcode_atts(array(
	'related_posts_module' 					  => '',
	'related_posts_columns_count' 			  => '',
	'related_posts_module_taxonomy_team'	  => '',
	'related_posts_module_taxonomy_portfolio' => '',
	'related_posts_exclude_ids'				  => '',
	'featured_img_size' 					  => '700x700',
	'related_posts_number' 					  => 'All',
	'orderby' 								  => '',
	'order' 								  => '',
    'el_class' 								  => ''
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

global $post;

// Explode Featured Image Size
$img_size = array_map('trim', preg_split("/[x|X|*]/", $featured_img_size));

// Post teaser count
if ( $related_posts_number != '' && !is_numeric($related_posts_number) ) $related_posts_number = -1;
if ( $related_posts_number != '' && is_numeric($related_posts_number) ) $related_posts_number = $related_posts_number;

// Columns
if ( $related_posts_columns_count=="2clm" ) { $related_posts_columns_count = ' az-col-full-width-6'; }
if ( $related_posts_columns_count=="3clm" ) { $related_posts_columns_count = ' az-col-full-width-4'; }
if ( $related_posts_columns_count=="4clm" ) { $related_posts_columns_count = ' az-col-full-width-3'; }
if ( $related_posts_columns_count=="5clm" ) { $related_posts_columns_count = ' az-col-full-width-2'; }
if ( $related_posts_columns_count=="6clm" ) { $related_posts_columns_count = ' az-col-full-width-1'; }

// Taxonomy
$related_taxonomy = null;
if ( $related_posts_module=="team" ) { $related_taxonomy = $related_posts_module_taxonomy_team; }
if ( $related_posts_module=="portfolio" ) { $related_taxonomy = $related_posts_module_taxonomy_portfolio; }

// get the custom post type's taxonomy terms
$custom_taxterms = wp_get_object_terms( $post->ID, $related_taxonomy, array('fields' => 'ids') );

// exclude post ids
$post_array = array($post->ID);

$related_exclude_var = esc_attr($related_posts_exclude_ids);
$related_exclude_var = explode(',', $related_exclude_var);

// Argumnets
$args = array(
	'post_type' 	 => $related_posts_module,
	'post_status' 	 => 'publish',
	'posts_per_page' => $related_posts_number,
	'orderby' 		 => $orderby,
	'order' 		 => $order,
	'tax_query' => array(
	    array(
	        'taxonomy' => $related_taxonomy,
	        'field' => 'id',
	        'terms' => $custom_taxterms
	    )
	),
	'post__not_in' => array_merge($post_array, $related_exclude_var),
);

// Run query
$my_query = new WP_Query($args);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'az-related-posts-output'.$el_class, $this->settings['base']);
$class = setClass(array($css_class));

$output .= '
<div id="az-related-posts-section"'.$class.'>';

// Output Team Posts
while($my_query->have_posts()) : $my_query->the_post();

	$post_id = $my_query->post->ID; // Get post ID

	// Start Item
	$output .= '
	<div class="single-related-item'.$related_posts_columns_count.'">';

		// Featured Image
		if ( has_post_thumbnail() ) {
		    $thumb = get_post_thumbnail_id();
		    $img_url = wp_get_attachment_url( $thumb, 'full' );  
		    $image = aq_resize( $img_url, $img_size[0], $img_size[1], true, false, true );
	    } else {
	    	$image[0] = get_template_directory_uri() . '/_include/img/blank.png';
	    	$image[1] = '500';
	    	$image[2] = '500';
	    }

		// Classic Module
	    $output .= '
	    	<a class="classic-related-post-box" href="'.get_permalink($post_id).'" title="'.get_the_title().'">
	    		<div class="related-post-box">
	    			<div class="related-post-naming">
	    				<h2 class="related-post-title">'.get_the_title().'</h2>';
	    $output .= '</div>
	    		</div>
	    	</a>
	    	<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.get_the_title().'" />
	    ';

    // End Item
    $output .= '
    </div>';

endwhile;

wp_reset_query();

$output .= '
</div>'.$this->endBlockComment('az_related_posts');

echo $output;

?>