<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $portfolio_layout_mode
* @var $portfolio_module
* @var $creative_module_mobile_check
* @var $portfolio_columns_count
* @var $grid_featured_img_size
* @var $portfolio_colorize_effect
* @var $portfolio_filter_mode
* @var $portfolio_filter_exclude_cat
* @var $portfolio_filter_name
* @var $portfolio_pagination
* @var $portfolio_pagination_mode
* @var $pagination_output
* @var $portfolio_post_number
* @var $portfolio_categories
* @var $portfolio_categories_exclude
* @var $orderby
* @var $order
*/

/*
$output = $portfolio_layout_mode = $portfolio_module = $creative_module_mobile_check = $portfolio_columns_count = 
$grid_featured_img_size = $portfolio_colorize_effect = $portfolio_filter_mode = $portfolio_filter_exclude_cat = 
$portfolio_filter_name = $portfolio_pagination = $portfolio_pagination_mode = $pagination_output = 
$portfolio_post_number = $portfolio_categories = $portfolio_categories_exclude = $orderby = $order = $el_class = '';
extract(shortcode_atts(array(
	'portfolio_layout_mode' 		=> '',
	'portfolio_module' 				=> '',
	'creative_module_mobile_check' 	=> 'no',
	'portfolio_columns_count' 		=> '',
	'grid_featured_img_size' 		=> '700x700',
	'portfolio_colorize_effect' 	=> '',
	'portfolio_filter_mode' 		=> 'no',
	'portfolio_filter_name' 		=> '',
	'portfolio_filter_exclude_cat'	=> '', 
	'portfolio_pagination'			=> 'no',
	'portfolio_pagination_mode'		=> 'classic',
	'portfolio_post_number' 		=> 'All',
	'portfolio_categories'			=> '',
	'portfolio_categories_exclude'	=> '',
	'orderby' 						=> '',
	'order'							=> '',
    'el_class' 						=> ''
), $atts));
*/

$output = $pagination_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);
global $post;

// Narrow by categories
if($portfolio_categories == 'portfolio')
$portfolio_categories = '';

// Explode Grid Featured Image Size
$grid_img_size = array_map('trim', preg_split("/[x|X|*]/", $grid_featured_img_size));

// Post teaser count
if ( $portfolio_post_number != '' && !is_numeric($portfolio_post_number) ) $portfolio_post_number = -1;
if ( $portfolio_post_number != '' && is_numeric($portfolio_post_number) ) $portfolio_post_number = $portfolio_post_number;

// Masonry Data-cols
$data_cols_masonry = '';
if($portfolio_layout_mode == "masonry-ly-portfolio") {
	if ( $portfolio_columns_count=="2clm" ) { $portfolio_columns_count = ' az-col-full-width-6 '; $data_cols_masonry = ' data-cols="2"'; }
	if ( $portfolio_columns_count=="3clm" ) { $portfolio_columns_count = ' az-col-full-width-4 '; $data_cols_masonry = ' data-cols="3"'; }
	if ( $portfolio_columns_count=="4clm" ) { $portfolio_columns_count = ' az-col-full-width-3 '; $data_cols_masonry = ' data-cols="4"'; }
	if ( $portfolio_columns_count=="5clm" ) { $portfolio_columns_count = ' az-col-full-width-3 '; $data_cols_masonry = ' data-cols="4"'; }
	if ( $portfolio_columns_count=="6clm" ) { $portfolio_columns_count = ' az-col-full-width-3 '; $data_cols_masonry = ' data-cols="4"'; }
}

// Columns
if ( $portfolio_columns_count=="2clm" ) { $portfolio_columns_count = ' az-col-full-width-6 '; }
if ( $portfolio_columns_count=="3clm" ) { $portfolio_columns_count = ' az-col-full-width-4 '; }
if ( $portfolio_columns_count=="4clm" ) { $portfolio_columns_count = ' az-col-full-width-3 '; }
if ( $portfolio_columns_count=="5clm" ) { $portfolio_columns_count = ' az-col-full-width-2 '; }
if ( $portfolio_columns_count=="6clm" ) { $portfolio_columns_count = ' az-col-full-width-1 '; }

// Pagination
if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
	$paged = get_query_var('page');
} else {
	$paged = 1;
}

// Classic/Creative Module and Pagination Settings Classes
if($portfolio_module == "creative-module" && $portfolio_pagination == "yes" && $portfolio_pagination_mode == "infinite-pag") {
	$nav_mode_pag = ' classic-pagination';
}
else if($portfolio_pagination == "yes" && $portfolio_pagination_mode == "infinite-pag") {
	$nav_mode_pag = ' infinite-scroll-pagination';
} 
else if($portfolio_pagination == "yes" && $portfolio_pagination_mode == "classic-pag") {
	$nav_mode_pag = ' classic-pagination';
}
else {
	$nav_mode_pag = ' no-pagination';
}

// Argumnets
$portfolio_exclude_var = esc_attr($portfolio_categories_exclude);
$portfolio_exclude_var = explode(',', $portfolio_exclude_var);

if ( !empty($portfolio_categories_exclude) ){

	$args = array(
		'posts_per_page' => $portfolio_post_number,
		'post_type' => 'portfolio',
		'paged'	=> $paged,
		'project-category' => esc_attr($portfolio_categories),
		'orderby' => $orderby,
		'order' => $order,
		'tax_query'	=> array(
	        array(
	            'taxonomy'	=> 'project-category',
	            'field'		=> 'slug',
	            'terms'		=> $portfolio_exclude_var,
	            'operator'	=> 'NOT IN',
	        ),
	    )
	);

} else {

	$args = array(
		'posts_per_page' => $portfolio_post_number,
		'post_type' => 'portfolio',
		'paged'	=> $paged,
		'project-category' => esc_attr($portfolio_categories),
		'orderby' => $orderby,
		'order' => $order
	);

}

// Run query
$my_query = new WP_Query($args);

// Mobile Detect
$detect = new Mobile_Detect;

if ($portfolio_module=="creative-module" && $creative_module_mobile_check=="no") {
	if ( $detect->isMobile() ) {
		$portfolio_module = 'classic-module';
	} 
}

if ($portfolio_module=="creative-module" && $creative_module_mobile_check=="yes") {
	if ( $detect->isMobile() ) {
		$portfolio_module = 'creative-module';
	}
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'portfolio-output'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $portfolio_layout_mode, $portfolio_module, $nav_mode_pag));

// Filter
$filter_mode = '';
if($portfolio_filter_mode == "yes") {
	$filter_mode = 'isotope';

	$output .= '
	<div id="filter-isotope" class="portfolio-filter">
		<div id="count-projects"><span class="current-number">00</span><span class="num-name"> / '. __( 'Projects', AZ_THEME_NAME ). '</span></div>
		<ul>
			<li><a href="#" class="has-items selected" data-filter="*">'.$portfolio_filter_name.'</a></li>';
			
			$portfolio_filter_exclude_var = esc_attr($portfolio_filter_exclude_cat);
			$portfolio_filter_exclude_var = explode(',', $portfolio_filter_exclude_var);


			if ( !empty($portfolio_filter_exclude_cat) ){

				$args_mod = array(
					'hide_empty' => 'false',
	                'orderby'	 => 'name',
	                'order'		 => 'ASC',
	                'exclude'	 => $portfolio_filter_exclude_var
				);

			} else {

				// If you change the order filter category
				$args_mod = array(
					'hide_empty' => 'false',
	                'orderby'	 => 'name',
	                'order'		 => 'ASC'
				);

			}

			$list_categories = get_terms( 'project-category', $args_mod);

			foreach ($list_categories as $list_category) :
			if(empty($portfolio_categories)){
				$output .= '
				<li><a href="#" data-filter=".'.strtolower(str_replace(" ","-", ($list_category->slug))).'">'.$list_category->name.'</a></li>';
			}
			else{
				if(strstr($portfolio_categories, $list_category->slug))
				{	
					$output .= '
					<li><a href="#" data-filter=".'.strtolower(str_replace(" ","-", ($list_category->slug))).'">'.$list_category->name.'</a></li>';
				}
			}
			endforeach;
	$output .= '
		</ul>
	</div>';

} else {
	$filter_mode = '';
}

$output .= '
<div id="portfolio-item-section"'.$class.$data_cols_masonry.'>';
// Counter
$counter = $counter_total = 0;

// Output Portfolio Posts
while($my_query->have_posts()) : $my_query->the_post();


$counter++;
$counter_total = $my_query->post_count;
	
	// Get post ID
	$post_id = $my_query->post->ID; // Get post ID

	// Get the Categories from Portfolio for Filter
	$terms = get_the_terms( $post->ID, 'project-category');
	$list_categories = NULL;

	if ( !empty($terms) ){
		foreach ( $terms as $term ) {
		   	$list_categories .= strtolower(str_replace(" ","-", ($term->slug))).' ';
		}
	}

	// Colorize FX
	$colorize_fx_project = $colorize_fx_class = $colorize_hover = '';
	if ($portfolio_colorize_effect==true) {
		$colorize_fx_project = get_post_meta($post->ID, 'az_colorize_project_fx', true);
        
    	if(!empty($colorize_fx_project['color'])) {
    		$color_output = $colorize_fx_project['color'];
    		$alpha_output = $colorize_fx_project['alpha'];
    		$colorize_rgba_output = Redux_Helpers::hex2rgba(''.$color_output.'', ''.$alpha_output.'');

    		$colorize_hover = ' style="background-color: '.$colorize_rgba_output.';"';
			$colorize_fx_class = ' colorize-portfolio-item';
    	} else {
    		$color_output = $alpha_output = $colorize_hover = $colorize_fx_class = '';
    	}

	}

	// Start Item
	$output .= '
	<div'.setClass(array('single-portfolio-item', $portfolio_columns_count, $list_categories)).'>';

	// Featured Image
	if ( has_post_thumbnail() ) {
	    $thumb = get_post_thumbnail_id();
	    $img_url = wp_get_attachment_image_src( $thumb, 'full' );  

	    if($portfolio_layout_mode == "masonry-ly-portfolio") {
	    	$tw = max( floor( $img_url[1] / 480 ), 1 );
			$th = max( floor( $img_url[2] / 480 ), 1 );

			if ( !strpos( $img_url[0], '.gif' ) ) {
				$image = aq_resize( $img_url[0], $tw * 480, $th * 480, true, false, true );
			} else {
				$image[0] = $img_url[0];
				$image[1] = $img_url[1];
				$image[2] = $img_url[2];
			}

	    } else {
	    	if ( !strpos( $img_url[0], '.gif' ) ) {
				$image = aq_resize( $img_url[0], $grid_img_size[0], $grid_img_size[1], true, false, true );
			} else {
				$image[0] = $img_url[0];
				$image[1] = $img_url[1];
				$image[2] = $img_url[2];
			}
	    }
    } else {
    	$image[0] = get_template_directory_uri() . '/_include/img/blank.png';
    	$image[1] = '500';
    	$image[2] = '500';
    }

    // Get the Attributes from Portfolio
	$attrs = get_the_terms( $post->ID, 'project-attribute' );
	$attributes_fields = NULL;

	if ( !empty($attrs) ){
		foreach ( $attrs as $attr ) {
			$attributes_fields[] = $attr->name;
		}
		$on_attributes = join( " / ", $attributes_fields );
	}


	// Creative Module
	if ($portfolio_module=="creative-module") {

		$output .= '
			<a class="creative-portfolio-popup'.$colorize_fx_class.'" title="'.get_the_title().'" data-target="portfolio_'.$post_id.'"'.$colorize_hover.'>
				<div class="portfolio-box">
					<div class="portfolio-naming">
						<h2 class="portfolio-title">'.get_the_title().'</h2>';
					if( !empty($on_attributes) ){
						$output .= '<h3 class="portfolio-attributes">'.$on_attributes.'</h3>';
					}
		$output .= '</div>
				</div>
			</a>
			<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.get_the_title().'" />
		';

		// Modal Variables
		$img_url = '';

		// Image Creative
		$image_creative_portfolio = get_post_meta($post->ID, 'az_portfolio_single_creative_image', true);
		if ( !empty($image_creative_portfolio) ){
			$image_creative_portfolio = get_post_meta($post->ID, 'az_portfolio_single_creative_image', true);
		} else {
			$image_creative_portfolio = get_template_directory_uri() . '/_include/img/blank.png';
		}

		// Gallery Creative
		$gallery_creative_portfolio = get_post_meta($post->ID, 'az_portfolio_single_creative_gallery_image', true);
		if ( !empty($gallery_creative_portfolio) ){
			$gallery_creative_portfolio = get_post_meta($post->ID, 'az_portfolio_single_creative_gallery_image', true);
		} else {
			$gallery_creative_portfolio = '';
		}

		// Content Creative
		$content_creative_portfolio = get_post_meta($post->ID, 'az_portfolio_single_creative_output_text', true);
		if ( !empty($content_creative_portfolio) ){
			$content_creative_portfolio = get_post_meta($post->ID, 'az_portfolio_single_creative_output_text', true);
		} else {
			$content_creative_portfolio = __( 'Insert your portfolio description.', AZ_THEME_NAME );
		}

		if ( !empty($image_creative_portfolio['url']) ) {
		    $img_bg_url = $image_creative_portfolio['url'];
		} else {
			$img_bg_url = get_template_directory_uri() . '/_include/img/blank.png';
		}

		// Get Uniq Id
		$uniq_self = uniqid();

		$output .= '
		<div class="modal prt" data-modal="portfolio_'.$post_id.'">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="portfolio-modal-container">';

						if(!empty($gallery_creative_portfolio)){
							$images = explode(',', $gallery_creative_portfolio);

							$output .= '
							<div id="creative-popup-flexslider-'.$uniq_self.'" class="portfolio-creative-slider flexslider" data-slide-type="fade" data-slide-easing="swing" data-slide-loop="false" data-slideshow="false">
								<ul class="slides">';

							foreach($images as $image):
								$src = wp_get_attachment_image_src( $image, 'full' );

								$output .= '
									<li class="portfolio-modal-image slide" style="background-image: url('.$src[0].');"></li>';
							endforeach;

							$output .= '
								</ul>
							</div>';

						} else {
							$output .= '
							<div class="portfolio-modal-image" style="background-image: url('.$img_bg_url.');"></div>';
						}
							
				$output	.=' <div class="portfolio-modal-description">
								<h2 class="portfolio-modal-title">'.get_the_title().'</h2>
								<h3 class="portfolio-modal-attributes">'.$on_attributes.'</h3>
								'.do_shortcode($content_creative_portfolio).'
							</div>

							<div class="portfolio-navi-popup">
								<a class="close-portfolio-modal"><i class="font-icon-plus-3"></i></a>
								<a class="prev-portfolio-modal"><i class="font-icon-arrow-left-simple-thin-round"></i></a>
								<a class="next-portfolio-modal"><i class="font-icon-arrow-right-simple-thin-round"></i></a>
								<span class="counter-portfolio">'.$counter.'/'.$counter_total.'</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		';

	}

	// Classic Module
	if ($portfolio_module=="classic-module") {

		// Project Type
		$project_type = get_post_meta($post->ID, 'az_portfolio_project_type', true);
		if ( !empty($project_type) ){
			$project_type = get_post_meta($post->ID, 'az_portfolio_project_type', true);
		} else {
			$project_type = 'normal_type';
		}

		// Fancy Mode
		$fancy_mode = get_post_meta($post->ID, 'az_portfolio_fancybox_mode', true);
		if ( !empty($fancy_mode) ){
			$fancy_mode = get_post_meta($post->ID, 'az_portfolio_fancybox_mode', true);
		} else {
			$fancy_mode = 'image_mod';
		}

		// Fancy Images
		$fancy_default_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );

		$fancy_image_diff = get_post_meta($post->ID, 'az_portfolio_fancybox_image_diff', true);
		if ( !empty($fancy_image_diff) ){
			$fancy_image_diff = get_post_meta($post->ID, 'az_portfolio_fancybox_image_diff', true);
		} else {
			$fancy_image_diff = '';
		}

		// Fancy Gallery Images
		$fancy_gallery_images = get_post_meta($post->ID, 'az_portfolio_fancybox_gallery_image', true);
		if ( !empty($fancy_gallery_images) ){
			$fancy_gallery_images = get_post_meta($post->ID, 'az_portfolio_fancybox_gallery_image', true);
		} else {
			$fancy_gallery_images = '';
		}

		$fancy_gallery_name = get_post_meta($post->ID, 'az_portfolio_fancybox_gallery_name', true);
		if ( !empty($fancy_gallery_name) ){
			$fancy_gallery_name = get_post_meta($post->ID, 'az_portfolio_fancybox_gallery_name', true);
		} else {
			$fancy_gallery_name = '';
		}

		// Fancy Video
		$fancy_video_url = get_post_meta($post->ID, 'az_portfolio_fancybox_video_url', true);
		if ( !empty($fancy_video_url) ){
			$fancy_video_url = get_post_meta($post->ID, 'az_portfolio_fancybox_video_url', true);
		} else {
			$fancy_video_url = '#';
		}

		$fancy_video_caption = get_post_meta($post->ID, 'az_portfolio_fancybox_video_caption', true);
		if ( !empty($fancy_video_caption) ){
			$fancy_video_caption = get_post_meta($post->ID, 'az_portfolio_fancybox_video_caption', true);
		} else {
			$fancy_video_caption = '';
		}
		
		// Fancy Gallery Videos
		$fancy_gallery_videos = get_post_meta($post->ID, 'az_portfolio_fancybox_gallery_video', true);
		if ( !empty($fancy_gallery_videos) ){
			$fancy_gallery_videos = get_post_meta($post->ID, 'az_portfolio_fancybox_gallery_video', true);
		} else {
			$fancy_gallery_videos = '';
		}

		$fancy_gallery_video_name = get_post_meta($post->ID, 'az_portfolio_fancybox_video_gallery_name', true);
		if ( !empty($fancy_gallery_video_name) ){
			$fancy_gallery_video_name = get_post_meta($post->ID, 'az_portfolio_fancybox_video_gallery_name', true);
		} else {
			$fancy_gallery_video_name = '';
		}
		
		// External
		$external_url = get_post_meta($post->ID, 'az_portfolio_external_url', true);
		if ( !empty($external_url) ){
			$external_url = get_post_meta($post->ID, 'az_portfolio_external_url', true);
		} else {
			$external_url = '#';
		}

		$ext_url_target = get_post_meta($post->ID, 'az_portfolio_external_url_target', true);
		if ( !empty($ext_url_target) ){
			$ext_url_target = get_post_meta($post->ID, 'az_portfolio_external_url_target', true);
		} else {
			$ext_url_target = '_self';
		}

		// Project Type Output
		if( $project_type == "normal_type" ) {

			$output .= '
				<a class="classic-portfolio-box normal-type-prt'.$colorize_fx_class.'" href="'.get_permalink($post_id).'" title="'.get_the_title().'"'.$colorize_hover.'>
					<div class="portfolio-box">
						<div class="portfolio-naming">
							<h2 class="portfolio-title">'.get_the_title().'</h2>';
						if( !empty($on_attributes) ){
							$output .= '
							<h3 class="portfolio-attributes">'.$on_attributes.'</h3>';
						}
			$output .= '</div>
					</div>
				</a>
				<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.get_the_title().'" />
			';
		}

		if( $project_type == "fancybox_type" ) {

			if( $fancy_mode == "image_mod" ) {
				// Fancy Image
				$images = explode(',', $fancy_gallery_images);
				$output_image_result = (!empty($fancy_image_diff['url'])) ? $fancy_image_diff['url'] : $fancy_default_image[0];

				// Grab Gallery Name
				$fancy_image_gallery_name = (!empty($fancy_gallery_name) ? ' data-fancybox-group="'.esc_attr($fancy_gallery_name).'"' : '');

				// Alt/Caption Text Image
				$caption_title_name = null;
				if(!empty($fancy_image_diff['url'])) {

					$caption_attachment = get_post( $fancy_image_diff['id'] );
					$caption_output = $caption_attachment->post_excerpt;

					if(!empty($caption_output)){
						$caption_title_name = ' data-fancybox-title="'.esc_attr($caption_output).'"';
					} else {
						$caption_title_name = '';
					}
				} else {

					$caption_attachment = get_post( $thumb );
					$caption_output = $caption_attachment->post_excerpt;

					if(!empty($caption_output)){
						$caption_title_name = ' data-fancybox-title="'.esc_attr($caption_output).'"';
					} else {
						$caption_title_name = '';
					}
				}

				$output .= '
					<a class="classic-portfolio-box fancy-type-prt fancybox-thumb'.$colorize_fx_class.'" href="'.$output_image_result.'" title="'.get_the_title().'"'.$caption_title_name.$fancy_image_gallery_name.$colorize_hover.'>
						<div class="portfolio-box">
							<div class="portfolio-naming">
								<h2 class="portfolio-title">'.get_the_title().'</h2>';
							if( !empty($on_attributes) ){
								$output .= '
								<h3 class="portfolio-attributes">'.$on_attributes.'</h3>';
							}
				$output .= '</div>
						</div>
					</a>
					<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.get_the_title().'" />
				';

				// Output Images Gallery Array
				if(!empty($fancy_gallery_images)){
					foreach($images as $image):
						$src = wp_get_attachment_image_src( $image, 'full' );
						$caption_attachment = get_post( $image );
						$caption_output = $caption_attachment->post_excerpt;
						
						$caption_title_name = null;
						if(!empty($caption_output)){
							$caption_title_name = ' data-fancybox-title="'.esc_attr($caption_output).'"';
						} else {
							$caption_title_name = '';
						}
						$output .= '
						<a class="fancybox-thumb hidden" href="'.$src[0].'"'.$caption_title_name.$fancy_image_gallery_name.'></a>';
					endforeach;
				}

			} else {
				// Fancy Video

				// Grab Gallery Name
				$fancy_video_gallery_name = (!empty($fancy_gallery_video_name) ? ' data-fancybox-group="'.esc_attr($fancy_gallery_video_name).'"' : '');

				// Grab Caption Title
				$caption_title_name = (!empty($fancy_video_caption) ? ' data-fancybox-title="'.esc_attr($fancy_video_caption).'"' : '');

				$output .= '
					<a class="classic-portfolio-box fancy-type-prt fancybox-media'.$colorize_fx_class.'" href="'.esc_url($fancy_video_url).'" title="'.get_the_title().'"'.$caption_title_name.$fancy_video_gallery_name.$colorize_hover.'>
						<div class="portfolio-box">
							<div class="portfolio-naming">
								<h2 class="portfolio-title">'.get_the_title().'</h2>';
							if( !empty($on_attributes) ){
								$output .= '
								<h3 class="portfolio-attributes">'.$on_attributes.'</h3>';
							}
				$output .= '</div>
						</div>
					</a>
					<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.get_the_title().'" />
				';

				if(!empty($fancy_gallery_videos)){
					$values = $fancy_gallery_videos;
					if(is_array($values)) {
						foreach ($values as $value) :

							$caption_title_name = null;
							if (!empty($value['description'])) {
								$caption_title_name = ' data-fancybox-title="'.esc_attr($value['description']).'"';
							}

							if (!empty($value['url'])) {
		                 		$output .= '
		                 		<a class="fancybox-media hidden" href="'.esc_url($value['url']).'"'.$caption_title_name.$fancy_video_gallery_name.'></a>';
		                 	}

	                    endforeach;
					}
				}

			}

		}

		if( $project_type == "external_type" ) {

			$target_output = '';
			if ( $ext_url_target == "_blank"){
				$target_output = ' target="_blank" ';
			} else {
				$target_output = '';
			}

			$output .= '
				<a class="classic-portfolio-box external-type-prt'.$colorize_fx_class.'" href="'.esc_url($external_url).'" title="'.get_the_title().'"'.$target_output.$colorize_hover.'>
					<div class="portfolio-box">
						<div class="portfolio-naming">
							<h2 class="portfolio-title">'.get_the_title().'</h2>';
						if( !empty($on_attributes) ){
							$output .= '
							<h3 class="portfolio-attributes">'.$on_attributes.'</h3>';
						}
			$output .= '</div>
					</div>
				</a>
				<img src="'.$image[0].'" width="'.$image[1].'" height="'.$image[2].'" alt="'.get_the_title().'" />
			';
		}
	}


	// End Item
    $output .= '
    </div>';

endwhile;

$output .= '
</div>'.$this->endBlockComment('az_portfolio_grid');

echo $output;

if($portfolio_module=="classic-module" && $portfolio_pagination == "yes" && $portfolio_pagination_mode == "infinite-pag") {
	$pagination_output .= '
	<div class="portfolio-infinite-activated infinite-scroll">
		<span class="preloader"></span>
		<p class="end">'. __( 'No More Posts', AZ_THEME_NAME ) .'</p>
		<a id="infinite-link" href="'. get_pagenum_link( $paged + 1 ) .'">'. __( 'Load More Posts', AZ_THEME_NAME ). '</a>
	</div>';
}
else if( $portfolio_pagination == "yes" && $portfolio_pagination_mode == "classic-pag" || $portfolio_module == "creative-module" && $portfolio_pagination == "yes" && $portfolio_pagination_mode == "infinite-pag") {
	$pagination_output .= az_number_pagination( $my_query, true );
}

echo $pagination_output;

wp_reset_query();

?>