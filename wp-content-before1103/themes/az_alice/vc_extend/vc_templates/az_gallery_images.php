<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $images_gallery
* @var $gallery_layout_mode
* @var $gallery_columns_count
* @var $gallery_random_order
* @var $grid_featured_img_size
* @var $hover_fx_style
*/

/*
$output = $images_gallery = $gallery_layout_mode = $gallery_columns_count = $gallery_random_order = $grid_featured_img_size = $hover_fx_style = $el_class = '';
extract( shortcode_atts( array(
	'images_gallery' 			=> '',
	'gallery_layout_mode'		=> '',
	'gallery_columns_count'		=> '',
	'grid_featured_img_size' 	=> '700x700',
	'gallery_random_order'		=> '',
	'hover_fx_style' 			=> 'normal-hover-fx',
	'el_class' 					=> ''
), $atts ) );
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

// Explode Grid Featured Image Size
$grid_img_size = array_map('trim', preg_split("/[x|X|*]/", $grid_featured_img_size));

// Explde Gallery Images
$images = explode(',', $images_gallery);

// Masonry Data-cols
$data_cols_masonry = '';
if($gallery_layout_mode == "masonry-ly-gallery") {
	if ( $gallery_columns_count=="2clm" ) { $gallery_columns_count = ' az-col-full-width-6 '; $data_cols_masonry = ' data-cols="2"'; }
	if ( $gallery_columns_count=="3clm" ) { $gallery_columns_count = ' az-col-full-width-4 '; $data_cols_masonry = ' data-cols="3"'; }
	if ( $gallery_columns_count=="4clm" ) { $gallery_columns_count = ' az-col-full-width-3 '; $data_cols_masonry = ' data-cols="4"'; }
	if ( $gallery_columns_count=="5clm" ) { $gallery_columns_count = ' az-col-full-width-3 '; $data_cols_masonry = ' data-cols="4"'; }
	if ( $gallery_columns_count=="6clm" ) { $gallery_columns_count = ' az-col-full-width-3 '; $data_cols_masonry = ' data-cols="4"'; }
}

// Columns
if ( $gallery_columns_count=="2clm" ) { $gallery_columns_count = ' az-col-full-width-6 '; }
if ( $gallery_columns_count=="3clm" ) { $gallery_columns_count = ' az-col-full-width-4 '; }
if ( $gallery_columns_count=="4clm" ) { $gallery_columns_count = ' az-col-full-width-3 '; }
if ( $gallery_columns_count=="5clm" ) { $gallery_columns_count = ' az-col-full-width-2 '; }
if ( $gallery_columns_count=="6clm" ) { $gallery_columns_count = ' az-col-full-width-1 '; }

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'gallery-output'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $hover_fx_style, $gallery_layout_mode));

$output .= '
<div id="gallery-images-section"'.$class.$data_cols_masonry.'>';

if($gallery_layout_mode == "masonry-ly-gallery") {
	$output .= '
	<div class="single-gallery-item'.$gallery_columns_count.'grid-sizer"></div>';
}

if(!empty($images_gallery)){

	// Create a name for gallery
	$gallery_fancy_name = 'gallery_fancy_'.uniqid().'';

	// Randomize Images
	if ($gallery_layout_mode == "grid-ly-gallery" && $gallery_random_order==true) {
		shuffle($images);
	}

	foreach($images as $image):

		$thumb = $image;
		$img_url = wp_get_attachment_image_src( $thumb, 'full' );
		$caption_attachment = get_post( $thumb );
		$caption_output = $caption_attachment->post_excerpt;

		$alt = get_post_meta($thumb, '_wp_attachment_image_alt', true);
		if ( !empty($alt) ){
			$alt = get_post_meta($thumb, '_wp_attachment_image_alt', true);
		} else {
			$alt = '00';
		}

		if($gallery_layout_mode == "masonry-ly-gallery") {
	    	$tw = max( floor( $img_url[1] / 480 ), 1 );
			$th = max( floor( $img_url[2] / 480 ), 1 );

			if ( ! strpos( $img_url[0], '.gif' ) ) {
				$imageV = aq_resize( $img_url[0], $tw * 480, $th * 480, true, false, true );
			} else {
				$imageV[0] = $img_url[0];
				$imageV[1] = $img_url[1];
				$imageV[2] = $img_url[2];
			}

	    } else {

	    	if ( ! strpos( $img_url[0], '.gif' ) ) {
				$imageV = aq_resize( $img_url[0], $grid_img_size[0], $grid_img_size[1], true, false, true );
			} else {
				$imageV[0] = $img_url[0];
				$imageV[1] = $img_url[1];
				$imageV[2] = $img_url[2];
			}
	    }

	    $caption_title_name = null;
		if(!empty($caption_output)){
			$caption_title_name = ' data-fancybox-title="'.esc_attr($caption_output).'"';
		} else {
			$caption_title_name = '';
		}

		$output .= '
		<div'.setClass(array('single-gallery-item', $gallery_columns_count)).'>';

		$output .= '
			<a class="gallery-item-box fancybox-thumb" href="'.$img_url[0].'"'.$caption_title_name.' data-fancybox-group="'.$gallery_fancy_name.'">
				<span class="gallery-overlay"><i class="icon-plus"></i></span>
				<img src="'.$imageV[0].'" width="'.$imageV[1].'" height="'.$imageV[2].'" alt="'.$alt.'" />
			</a>';

		$output .= '
		</div>';

	endforeach;
}


$output .= '
</div>'.$this->endBlockComment('az_gallery_images');

echo $output;

?>