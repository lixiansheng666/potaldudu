<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $video_player_type
* @var $custom_video_webm
* @var $custom_video_mp4
* @var $link_video_others
* @var $poster_image
* @var $responsive_lg
* @var $responsive_md
* @var $responsive_sm
* @var $responsive_xs
*/

/*
$output = $video_player_type = $custom_video_webm = $custom_video_mp4 = $link_video_others = $poster_image = $el_class = $responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = '';
extract( shortcode_atts( array(
	'video_player_type' => '',
	'custom_video_webm' => '',
	'custom_video_mp4' 	=> '',
	'link_video_others' => '',
	'el_class' 			=> '',
	'poster_image' 		=> $poster_image,
	'responsive_lg'		=> '',
    'responsive_md' 	=> '',
    'responsive_sm' 	=> '',
    'responsive_xs' 	=> ''
), $atts ) );
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass( $el_class );

// Grab Image
$img_id = preg_replace('/[^\d]/', '', $poster_image);
$image_string = wp_get_attachment_image_src( $img_id, 'full');
$image_string = $image_string[0];

// Get Uniq Id
$uniq_self = uniqid();

/** @var WP_Embed $wp_embed  */
global $wp_embed;
$embed = $wp_embed->run_shortcode( '[embed]'.esc_url($link_video_others).'[/embed]' );

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'video-player-builder'.$el_class, $this->settings['base']);
$class = setClass(array($css_class, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

$video_output = null;
if ($video_player_type=="self_hosted_mode") {
	$video_output = '
		<div class="video-container">
			<video id="video-'.$uniq_self.'" class="video video-js video-shortcode vjs-default-skin" preload="auto" style="width: 100%; height: 100%;" poster="'.$image_string.'" data-volume="50">
				<source type="video/webm" src="'.esc_url($custom_video_webm).'">
				<source type="video/mp4" src="'.esc_url($custom_video_mp4).'">
			</video>
		</div>
		';
}

if ($video_player_type=="others_video_mode") {
	$video_output = '
	<div class="videoWrapper">'.$embed.'</div>
	';
}

$output .= '
<div'.$class.'>';
$output .= $video_output;
$output .= '
</div>'.$this->endBlockComment('az_video_player');

echo $output;

?>