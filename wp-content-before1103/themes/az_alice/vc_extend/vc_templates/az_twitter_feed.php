<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $twitter_feed_colors
* @var $twitter_feed_type
* @var $tweets_total
* @var $twitter_username
*/

/*
$output = $el_class = $twitter_feed_colors = $twitter_feed_type = $tweets_total = $twitter_username = '';
extract(shortcode_atts( array(
	'twitter_feed_colors' => 'dark-mode',
	'twitter_feed_type'   => 'slide',
	'twitter_username' 	  => 'bluxart',
	'tweets_total' 		  => '1',
	'el_class' 			  => '',
), $atts ) );
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$el_class = $this->getExtraClass($el_class);

// Get Uniq Id
$uniq_self = uniqid();

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'az-twitter-feed'.$el_class, $this->settings['base']);
$class = setClass(array('flexslider', $css_class, $twitter_feed_colors));

$output .= '
<div id="twitter-feed-section-'.$uniq_self.'"'.$class.' data-slide-type="'.$twitter_feed_type.'" data-slide-easing="swing" data-slide-loop="false" data-slideshow="false">
	<ul class="slides">';

if ( function_exists( 'getTweets' ) ) {

	$tweets = getTweets(intval($tweets_total), $twitter_username);
	foreach($tweets as $tweet) {

	$output .= '
		<li class="twitter-feed-item slide">
			<div class="twitter-wrap">
				<span class="tweet_text">' . TwitterFilter($tweet['text']) . '</span>
			</div>
		</li>';		
	}

} else {

	$output .= '
		<li class="error">Please install the <a href="http://wordpress.org/plugins/oauth-twitter-feed-for-developers/">oAuth Twitter Feed Plugin</a> and configure it properly for the twitter widget to run. Read more about this in the manual.</li>';

}

$output .= '
	</ul>
</div>';

echo $output.$this->endBlockComment('az_twitter_feed');

?>