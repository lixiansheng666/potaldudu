<?php

function alpha_parse_tweet( $string ) {

    $content_array = explode( " ", $string );
    $output = '';

    foreach ( $content_array as $content ) {

        if ( substr( $content, 0, 7 ) == "http://" ) {
            $content = '<a href="' . esc_url( $content ) . '">' . $content . '</a>';
        }

        //starts with www.
        if ( substr( $content, 0, 4 ) == "www." ) {
            $content = '<a href="' . esc_url( 'http://' . $content ) . '">' . $content . '</a>';
        }

        if ( substr( $content, 0, 8 ) == "https://" ) {
            $content = '<a href="' . esc_url( $content ) . '">' . $content . '</a>';
        }

        if ( substr( $content, 0, 1 ) == "#" ) {
            $content = '<a href="' . esc_url( 'https://twitter.com/search?src=hash&q=' . $content ) . '">' . $content . '</a>';
        }

        if ( substr( $content, 0, 1 ) == "@" ) {
            $content = '<a href="' . esc_url( 'https://twitter.com/' . $content ) . '">' . $content . '</a>';
        }

        $output .= " " . $content;

    }

    $output = trim( $output );

    return $output;

}

$output = $width = $el_class = $title = $twitter_name = $tweet_count = $el_position = $tweets_count = '';

extract( shortcode_atts( array(
    'el_class' 		 => '',
    'twitter_name'   => 'rubenbristian',
    'no' 			 => '3',
    'avatar' 		 => ''
), $atts ) );

$output = '';

if ( function_exists( 'getTweets' ) ) {

	$tweets = getTweets( $twitter_name, $no );

    if ( ! empty ( $tweets['error'] ) ) {

		$output = '<p>Error (go to Settings > Twitter Feed Auth to resolve this): <span style="color:red; ">' . $tweets['error'] . '</span></p>';

    } else {

	$img = wp_get_attachment_image_src( $avatar, 'full' );

		$output = '<section class="krown-twitter clearfix rotenabled' . ( $el_class != '' ? ' ' . $el_class : '' ) . '">
		<ul>';

    	foreach ( $tweets as $tweet ) {

    		$output .= '<li>

    			<p class="body">' . alpha_parse_tweet( $tweet['text'] ) . '</p>

                <a class="subtitle" href="' . esc_url( 'https://twitter.com/' . $twitter_name . '/status/' . $tweet['id_str'] ) . '">
                    <img src="' . aq_resize( $img[0], '40', '40', true ) . '" alt="' . $twitter_name . '" />
                    <span>' . $twitter_name . ' ' . esc_html__('on', 'alpha') . ' ' . date( 'j F o', strtotime( $tweet['created_at'] ) ) . '</span>
                </a>

    			<div class="intents">
    				<a class="popup reply" data-name="' . esc_html__( 'Reply' ,'alpha' ) . '" data-width="400" data-height="200" href="' . esc_url( 'https://twitter.com/intent/tweet?in_reply_to=' . $tweet['id_str'] ) . '"></a>
    				<a class="popup retweet" data-name="' . esc_html__( 'Retweet' ,'alpha' ) . '" data-width="400" data-height="200" href="' . esc_url( 'https://twitter.com/intent/retweet?tweet_id=' . $tweet['id_str'] ) . '"></a>
    				<a class="popup favorite" data-name="' . esc_html__( 'Favorite' ,'alpha' ) . '" data-width="400" data-height="200" href="' . esc_url( 'https://twitter.com/intent/favorite?tweet_id=' . $tweet['id_str'] ) . '"></a>
    			</div>
    		</li>';

    	}

    }

    $output .= '</ul></section>';

} else {

	$output = '<p style="font-weight:bold;">Please install the <a href="' . esc_url( 'http://wordpress.org/plugins/oauth-twitter-feed-for-developers/' ) . '">oAuth Twitter Feed Plugin</a> and configure it properly for the twitter widget to run. Read more about this in the manual.</p>';

}

echo $output;