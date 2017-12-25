<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $latest_posts_layout_mode
* @var $latest_posts_columns_count
* @var $latest_posts_number
* @var $latest_posts_category
* @var $orderby
* @var $order
*/

/*
$output = $latest_posts_layout_mode = $latest_posts_columns_count = $latest_posts_number = $latest_posts_category = $orderby = $order = $el_class = '';
extract(shortcode_atts(array(
	'latest_posts_layout_mode' 	 => 'wide',
	'latest_posts_columns_count' => '',
	'latest_posts_number'	  	 => 'All',
	'latest_posts_category' 	 => '',
	'orderby' 					 => '',
	'order' 					 => '',
    'el_class' 					 => ''
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

global $post, $options_alice;

// Post teaser count
if ( $latest_posts_number != '' && !is_numeric($latest_posts_number) ) $latest_posts_number = -1;
if ( $latest_posts_number != '' && is_numeric($latest_posts_number) ) $latest_posts_number = $latest_posts_number;

// Columns
$data_cols = null;
if ($latest_posts_layout_mode=="grid") {
	if ( $latest_posts_columns_count=="1clm" ) { $latest_posts_columns_count = '1'; }
	if ( $latest_posts_columns_count=="2clm" ) { $latest_posts_columns_count = '2'; }
	if ( $latest_posts_columns_count=="3clm" ) { $latest_posts_columns_count = '3'; }
	if ( $latest_posts_columns_count=="4clm" ) { $latest_posts_columns_count = '4'; }

	$data_cols = ' data-cols="'.$latest_posts_columns_count.'"';
}

if ($latest_posts_layout_mode=="wide") {
	$data_cols = '';
}

// Post Thumbnails Size
$wide_img_size = (!empty($options_alice['wide_post_thumb_size'])) ? $options_alice['wide_post_thumb_size'] : '1000x500';
$grid_one_img_size = (!empty($options_alice['grid_one_post_thumb_size'])) ? $options_alice['grid_one_post_thumb_size'] : '1000x600';
$grid_two_img_size = (!empty($options_alice['grid_two_post_thumb_size'])) ? $options_alice['grid_two_post_thumb_size'] : '550x550';
$grid_three_img_size = (!empty($options_alice['grid_three_post_thumb_size'])) ? $options_alice['grid_three_post_thumb_size'] : '400x400';
$grid_four_img_size = (!empty($options_alice['grid_four_post_thumb_size'])) ? $options_alice['grid_four_post_thumb_size'] : '350x350';

// Argumnets
$args = array(
	'showposts'			  => $latest_posts_number,
	'category_name' 	  => $latest_posts_category,
	'orderby' 			  => $orderby,
	'order' 			  => $order,
	'ignore_sticky_posts' => 1
);

// Run query
$my_query = new WP_Query($args);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'az-latest-posts-output'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $latest_posts_layout_mode));

$output .= '
<div id="blog"'.$class.''.$data_cols.'>
	<div class="az-latest-posts-container">';

// Output Team Posts
while($my_query->have_posts()) : $my_query->the_post();

	$post_id = $my_query->post->ID; // Get post ID

	$output .= '
	<article id="post-'.$post_id.'" class="item-blog">
		<div class="post-container">';

		if ( has_post_thumbnail() ) {
			$thumb = get_post_thumbnail_id( $post_id );
			$img_url = wp_get_attachment_url( $thumb, 'full' );

		    // Explode Featured Image Sizes
		    $wide_th_output = array_map('trim', preg_split("/[x|X|*]/", esc_attr($wide_img_size) ));
		    $grid_one_th_output = array_map('trim', preg_split("/[x|X|*]/", esc_attr($grid_one_img_size) ));
		    $grid_two_th_output = array_map('trim', preg_split("/[x|X|*]/", esc_attr($grid_two_img_size) ));
		    $grid_three_th_output = array_map('trim', preg_split("/[x|X|*]/", esc_attr($grid_three_img_size) ));
		    $grid_four_th_output = array_map('trim', preg_split("/[x|X|*]/", esc_attr($grid_four_img_size) ));

			switch ( $latest_posts_layout_mode ) {

		    	case 'grid':
		    		switch ( $latest_posts_columns_count ) {
		    			case '1':
		    				$img = aq_resize( $img_url, $grid_one_th_output[0], $grid_one_th_output[1], true, false, true );
		    				break;

		    			case '2':
		    				$img = aq_resize( $img_url, $grid_two_th_output[0], $grid_two_th_output[1], true, false, true );
		    				break;

		    			case '3':
		                    $img = aq_resize( $img_url, $grid_three_th_output[0], $grid_three_th_output[1], true, false, true );
		                    break;

		                case '4':
		    				$img = aq_resize( $img_url, $grid_four_th_output[0], $grid_four_th_output[1], true, false, true );
		    				break;

		    			default:
		    				$img = aq_resize( $img_url, '400', '400', true, false, true );
		    		}
		    		break;

		        case 'wide':
		                $img = aq_resize( $img_url, $wide_th_output[0], $wide_th_output[1], true, false, true );
		            break;
		    	
		    	default:
		    		$img = aq_resize( $img_url, '1000', '500', true, false, true );
		    }

		    $mode_img = ' style="background-image: url('.$img[0].');"';
		} else {
			$mode_img = '';
		}

		$output .= '
			<div class="post-creative post-image"'.$mode_img.'>
				<a class="post-link" title="'.get_the_title().'" href="'.get_permalink($post_id).'">
					<div class="post-caption">
						<div class="post-naming">
							<h2 class="post-title">'.get_the_title().'</h2>
							<span class="post-date"><time datetime="'.get_the_time( 'c' ).'">'.get_the_time( get_option('date_format') ).'</time></span>
						</div>
					</div>
				</a>
			</div>
		';


	$output .= '
		</div>
	</article>';

endwhile;

wp_reset_query();

$output .= '
	</div>
</div>'.$this->endBlockComment('az_latest_posts');

echo $output;

?>