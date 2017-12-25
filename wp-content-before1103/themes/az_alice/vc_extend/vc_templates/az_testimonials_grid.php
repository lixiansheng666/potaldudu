<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $testimonials_color
* @var $testimonials_type
* @var $testimonials_categories
* @var $orderby
* @var $order
*/

/*
$output = $testimonials_color = $testimonials_type = $testimonials_categories = $orderby = $order = $el_class = '';
extract(shortcode_atts(array(
	'testimonials_color'		=> 'dark-mode',
	'testimonials_type'			=> 'slide',
	'testimonials_categories'	=> '',
	'orderby' 					=> '',
	'order' 					=> '',
    'el_class' 					=> ''
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

global $post;

// Argumnets
$args = array(
	'posts_per_page' => -1,
	'post_type' => 'testimonial',
	'testimonial-category' => esc_attr($testimonials_categories),
	'orderby' => $orderby,
	'order' => $order
);

// Run query
$my_query = new WP_Query($args);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG,'az-testimonial-output'.$el_class, $this->settings['base']);
$class = setClass(array('flexslider', $css_class, $testimonials_color));

// Get Uniq Id
$uniq_self = uniqid();

$output .= '
<div id="testimonial-section-'.$uniq_self.'"'.$class.' data-slide-type="'.$testimonials_type.'" data-slide-easing="swing" data-slide-loop="false" data-slideshow="false">
	<ul class="slides">';

// Output Testimonial Posts
while($my_query->have_posts()) : $my_query->the_post();

	$post_id = $my_query->post->ID; // Get post ID

	// Testimonial Caption
	$testimonial_caption = get_post_meta($post->ID, 'az_testimonial_caption', true);
	if ( !empty($testimonial_caption) ){
		$testimonial_caption = get_post_meta($post->ID, 'az_testimonial_caption', true);
	} else {
		$testimonial_caption = '';
	}

	// Testimonial Quote Text
	$testimonial_quote_text = get_post_meta($post->ID, 'az_testimonial_quote', true);
	if ( !empty($testimonial_quote_text) ){
		$testimonial_quote_text = get_post_meta($post->ID, 'az_testimonial_quote', true);
	} else {
		$testimonial_quote_text = __( 'Insert your testimonial text.', AZ_THEME_NAME );
	}

	$output .= '
	<li class="testimonial-item slide">
		<div class="testimonial-wrap">';

		// Featured Image
		if ( has_post_thumbnail() ) {
		    $thumb = get_post_thumbnail_id();
		    $img_url = wp_get_attachment_image_src( $thumb, 'full' );

		    $output .= '
		    <div class="author-image"><img class="aligncenter" src="'.$img_url[0].'" width="'.$img_url[1].'" height="'.$img_url[2].'" alt="'.get_the_title().'" /></div>';
	    }

		$output .= '
		<div class="quote-text">'.$testimonial_quote_text.'</div>';

		$output .= '
		<div class="author-info">
			<span class="testimonial-title">- '.get_the_title().' -</span>';

		if ( !empty($testimonial_caption) ) {
			$output .= '
			<span class="testimonial-caption">'.esc_attr($testimonial_caption).'</span>';
		}

		$output .= '
		</div>';

	$output .= '
		</div>
	</li>';

endwhile;

wp_reset_query();

$output .= '
	</ul>
</div>'.$this->endBlockComment('az_clients_grid');

echo $output;

?>