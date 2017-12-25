<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $clients_layout_mode
* @var $clients_columns_count
* @var $clients_categories
* @var $orderby
* @var $order
*/

/*
$output = $clients_layout_mode = $clients_columns_count = $clients_categories = $orderby = $order = $el_class = '';
extract(shortcode_atts(array(
	'clients_layout_mode' 	=> '',
	'clients_columns_count' => '',
	'clients_categories'	=> '',
	'orderby' 				=> '',
	'order' 				=> '',
    'el_class' 				=> ''
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

global $post;

// Columns
if ( $clients_columns_count=="1clm" ) { $clients_columns_count = ' az-col-full-width-12'; }
if ( $clients_columns_count=="2clm" ) { $clients_columns_count = ' az-col-full-width-6'; }
if ( $clients_columns_count=="3clm" ) { $clients_columns_count = ' az-col-full-width-4'; }
if ( $clients_columns_count=="4clm" ) { $clients_columns_count = ' az-col-full-width-3'; }
if ( $clients_columns_count=="5clm" ) { $clients_columns_count = ' az-col-full-width-2'; }
if ( $clients_columns_count=="6clm" ) { $clients_columns_count = ' az-col-full-width-1'; }

// Argumnets
$args = array(
	'posts_per_page' => -1,
	'post_type' => 'client',
	'client-category' => esc_attr($clients_categories),
	'orderby' => $orderby,
	'order' => $order
);

// Run query
$my_query = new WP_Query($args);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'client-output'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $clients_layout_mode));

$output .= '
<div id="client-section"'.$class.'>';

// Output Team Posts
while($my_query->have_posts()) : $my_query->the_post();

	$post_id = $my_query->post->ID; // Get post ID

	// Start Item
	$output .= '
	<div class="single-client-item'.$clients_columns_count.'">';

	// Featured Image
	if ( has_post_thumbnail() ) {
	    $thumb = get_post_thumbnail_id();
	    $img_url = wp_get_attachment_image_src( $thumb, 'full' );
    } else {
    	$img_url[0] = get_template_directory_uri() . '/_include/img/blank.png';
    	$img_url[1] = '500';
    	$img_url[2] = '500';
    }

    // Output URL
    $client_url = get_post_meta($post->ID, 'az_client_url', true);
	if ( !empty($client_url) ){
		$client_url = get_post_meta($post->ID, 'az_client_url', true);
	} else {
		$client_url = '';
	}

	$client_url_target = get_post_meta($post->ID, 'az_client_url_target', true);
	if ( !empty($client_url_target) ){
		$client_url_target = get_post_meta($post->ID, 'az_client_url_target', true);
	} else {
		$client_url_target = '_self';
	}

    if(!empty($client_url)){
    	$client_url = ' href="'.esc_url($client_url).'"';
    	$client_link_class = ' with-link';

    	if ( $client_url_target == "_blank"){
			$target_output = ' target="_blank" ';
		} else {
			$target_output = '';
		}

    } else {
    	$client_url = $target_output = '';
    	$client_link_class = ' no-link';
    }

    // Output BG
    $client_bg = get_post_meta($post->ID, 'az_client_background', true);
	if ( !empty($client_bg) ){
		$client_bg = get_post_meta($post->ID, 'az_client_background', true);
	} else {
		$client_bg = '';
	}

    if(!empty($client_bg)){
    	$bg_output = ' style="background-color: '.$client_bg.';"';
    } else {
    	$bg_output = '';
    }

	$output .= '
		<a class="clients-box'.$client_link_class.'"'.$client_url.' title="'.get_the_title().'"'.$target_output.$bg_output.'>
			<img class="aligncenter" src="'.$img_url[0].'" width="'.$img_url[1].'" height="'.$img_url[2].'" alt="'.get_the_title().'" />
		</a>
	';

    // End Item
    $output .= '
    </div>';

endwhile;

wp_reset_query();

$output .= '
</div>'.$this->endBlockComment('az_clients_grid');

echo $output;

?>