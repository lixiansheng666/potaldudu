<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $team_layout_mode
* @var $team_module
* @var $creative_module_mobile_check
* @var $team_columns_count
* @var $featured_img_size
* @var $team_post_number
* @var $team_categories
* @var $orderby
* @var $order
*/

/*
$output = $team_layout_mode = $team_module = $creative_module_mobile_check = $team_columns_count = $featured_img_size = $team_post_number = $team_categories = $orderby = $order = $el_class = '';
extract(shortcode_atts(array(
	'team_layout_mode' 			   	=> '',
	'team_module' 					=> '',
	'creative_module_mobile_check' 	=> 'no',
	'team_columns_count' 			=> '',
	'featured_img_size' 			=> '700x700',
	'team_post_number' 				=> 'All',
	'team_categories' 				=> '',
	'orderby' 						=> '',
	'order' 						=> '',
    'el_class' 						=> ''
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
if ( $team_post_number != '' && !is_numeric($team_post_number) ) $team_post_number = -1;
if ( $team_post_number != '' && is_numeric($team_post_number) ) $team_post_number = $team_post_number;

// Columns
if ( $team_columns_count=="2clm" ) { $team_columns_count = ' az-col-full-width-6'; }
if ( $team_columns_count=="3clm" ) { $team_columns_count = ' az-col-full-width-4'; }
if ( $team_columns_count=="4clm" ) { $team_columns_count = ' az-col-full-width-3'; }
if ( $team_columns_count=="5clm" ) { $team_columns_count = ' az-col-full-width-2'; }
if ( $team_columns_count=="6clm" ) { $team_columns_count = ' az-col-full-width-1'; }

// Argumnets
$args = array(
	'posts_per_page' => $team_post_number,
	'post_type' => 'team',
	'disciplines' => esc_attr($team_categories),
	'orderby' => $orderby,
	'order' => $order
);

// Run query
$my_query = new WP_Query($args);

// Mobile Detect
$detect = new Mobile_Detect;

if ($team_module=="creative-module" && $creative_module_mobile_check=="no") {
	if ( $detect->isMobile() ) {
		$team_module = 'classic-module';
	} 
}

if ($team_module=="creative-module" && $creative_module_mobile_check=="yes") {
	if ( $detect->isMobile() ) {
		$team_module = 'creative-module';
	}
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'team-output'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $team_layout_mode, $team_module));

$output .= '
<div id="team-people-section"'.$class.'>';

// Counter
$counter = $counter_total = 0;

// Output Team Posts
while($my_query->have_posts()) : $my_query->the_post();

$counter++;
$counter_total = $my_query->post_count;

	$post_id = $my_query->post->ID; // Get post ID

	// Start Item
	$output .= '
	<div class="single-team-item'.$team_columns_count.'">';

	// Featured Image
	if ( has_post_thumbnail() ) {
	    $thumb = get_post_thumbnail_id();
	    $img_url = wp_get_attachment_image_src( $thumb, 'full' );  

	    if ( !strpos( $img_url[0], '.gif' ) ) {
			$image = aq_resize( $img_url[0], $img_size[0], $img_size[1], true, false, true );
		} else {
			$image[0] = $img_url[0];
			$image[1] = $img_url[1];
			$image[2] = $img_url[2];
		}

    } else {
    	$image[0] = get_template_directory_uri() . '/_include/img/blank.png';
    	$image[1] = '500';
    	$image[2] = '500';
    }

    // Get the Attributes from Team
	$attrs = get_the_terms( $post->ID, 'attributes' );
	$attributes_fields = NULL;

	if ( !empty($attrs) ){
		foreach ( $attrs as $attr ) {
			$attributes_fields[] = $attr->name;
		}
		$on_attributes = join( " / ", $attributes_fields );
	}

	if ($team_module=="creative-module") {
		// Creative Module
	    $output .= '
	    	<a class="creative-team-popup" title="'.get_the_title().'" data-target="team_'.$post_id.'">
	    		<div class="team-box">
	    			<div class="team-naming">
	    				<h2 class="team-title">'.get_the_title().'</h2>';
	    			if( !empty($on_attributes) ){
	    				$output .= '<h3 class="team-attributes">'.$on_attributes.'</h3>';
	    			}
	    $output .= '</div>
	    		</div>
	    	</a>
	    	<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.get_the_title().'" />
	    ';

		// Modal Variables
	    $img_url = '';

	    // Image Creative
	    $image_creative_team = get_post_meta($post->ID, 'az_team_single_creative_image', true);
		if ( !empty($image_creative_team) ){
			$image_creative_team = get_post_meta($post->ID, 'az_team_single_creative_image', true);
		} else {
			$image_creative_team = get_template_directory_uri() . '/_include/img/blank.png';
		}

	    // Content Creative
	    $content_creative_team = get_post_meta($post->ID, 'az_team_single_creative_output_text', true);
		if ( !empty($content_creative_team) ){
			$content_creative_team = get_post_meta($post->ID, 'az_team_single_creative_output_text', true);
		} else {
			$content_creative_team = __( 'Insert your team description.', AZ_THEME_NAME );
		}

		if ( !empty($image_creative_team['url']) ) {
            $img_bg_url = $image_creative_team['url'];
        } else {
        	$img_bg_url = get_template_directory_uri() . '/_include/img/blank.png';
        }

	    $output .= '
		<div class="modal tm" data-modal="team_'.$post_id.'">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="team-modal-container">
							<div class="team-modal-image" style="background-image: url('.$img_bg_url.');"></div>
							<div class="team-modal-description">
								<h2 class="team-modal-title">'.get_the_title().'</h2>
								<h3 class="team-modal-attributes">'.$on_attributes.'</h3>
								'.do_shortcode($content_creative_team).'
							</div>

							<div class="team-navi-popup">
								<a class="close-team-modal"><i class="font-icon-plus-3"></i></a>
								<a class="prev-team-modal"><i class="font-icon-arrow-left-simple-thin-round"></i></a>
								<a class="next-team-modal"><i class="font-icon-arrow-right-simple-thin-round"></i></a>
								<span class="counter-team">'.$counter.'/'.$counter_total.'</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		';
	}

	else {
		// Classic Module
	    $output .= '
	    	<a class="classic-team-box" href="'.get_permalink($post_id).'" title="'.get_the_title().'">
	    		<div class="team-box">
	    			<div class="team-naming">
	    				<h2 class="team-title">'.get_the_title().'</h2>';
	    			if( !empty($on_attributes) ){
	    				$output .= '
	    				<h3 class="team-attributes">'.$on_attributes.'</h3>';
	    			}
	    $output .= '</div>
	    		</div>
	    	</a>
	    	<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.get_the_title().'" />
	    ';
	}

    // End Item
    $output .= '
    </div>';

endwhile;

wp_reset_query();

$output .= '
</div>'.$this->endBlockComment('az_team_grid');

echo $output;

?>