<?php
/**
* Shortcode attributes
* @var $atts
* @var $el_class
* @var $section_id
* @var $section_class
* @var $section_mode
* @var $row_class
* @var $bg_mode
* @var $no_margin_padding
* @var $no_content_wrap
* @var $scroll_button
* @var $scroll_id
* @var $custom_bg_color
* @var $bg_position
* @var $bg_repeat
* @var $bg_image_background_color
* @var $section_overlay
* @var $section_overaly_color
* @var $video_mode
* @var $custom_video_mobile_settings
* @var $custom_video_youtube
* @var $custom_video_youtube_module
* @var $custom_video_vimeo
* @var $custom_video_vimeo_module
* @var $custom_video_webm
* @var $custom_video_mp4
* @var $custom_video_self_hosted_module
* @var $custom_image_video
* @var $custom_image_youtube_video
* @var $custom_image_self_video
* @var $video_overlay
* @var $video_color_overlay
* @var $pattern
* @var $padding
* @var $padding_top_value
* @var $padding_bottom_value
* @var $responsive_lg
* @var $responsive_md
* @var $responsive_sm
* @var $responsive_xs
* @var $detect_contrast
* @var $image
* @var $image_parallax
* @var $content - shortcode content
*/

/*
$output = $el_class = $section_id = $section_class = $section_mode = $row_class = $bg_mode = $no_margin_padding = $no_content_wrap = $scroll_button = $scroll_id = 
$custom_bg_color = $bg_position = $bg_repeat = $bg_image_background_color = $section_overlay = $section_overaly_color = $video_mode = $custom_video_mobile_settings = $custom_video_youtube = 
$custom_video_youtube_module = $custom_video_vimeo = $custom_video_vimeo_module = $custom_video_webm = $custom_video_mp4 = $custom_video_self_hosted_module = 
$custom_image_video = $custom_image_youtube_video = $custom_image_self_video = $video_overlay = $video_color_overlay = $pattern = $padding = $padding_top_value = $padding_bottom_value = 
$responsive_lg = $responsive_md = $responsive_sm = $responsive_xs = $detect_contrast = $image = $image_parallax = '';
extract(shortcode_atts(array(
    'el_class'                          => '',
    'section_id'                        => '',
    'section_class'                     => '',
    'section_mode'                      => 'normal',
    'row_class'                         => 'row',
    'bg_mode'                           => '',
    'no_margin_padding'                 => '',
    'no_content_wrap'                   => '',
    'scroll_button'                     => '',
    'scroll_id'                         => '',
    'custom_bg_color'                   => '',
    'bg_position'                       => '',
    'bg_repeat'                         => '',
    'bg_image_background_color'         => '',
    'section_overlay'                   => '',
    'section_overaly_color'             => '',
    'video_mode'                        => '',
    'custom_video_mobile_settings'      => 'new-window',
    'custom_image_video'                => '',
    'custom_image_youtube_video'        => '',
    'custom_image_self_video'           => '',
    'video_overlay'                     => '',
    'video_color_overlay'               => '',
    'custom_video_youtube'              => '',
    'custom_video_youtube_module'       => '',
    'custom_video_vimeo'                => '',
    'custom_video_vimeo_module'         => '',
    'custom_video_webm'                 => '',
    'custom_video_mp4'                  => '',
    'custom_video_self_hosted_module'   => '',
    'pattern'                           => '',
    'padding'                           => 'no-padding',
    'padding_top_value'                 => '',
    'padding_bottom_value'              => '',
    'responsive_lg'                     => '',
    'responsive_md'                     => '',
    'responsive_sm'                     => '',
    'responsive_xs'                     => '',
    'detect_contrast'                   => 'no-detect',
    'image'                             => $image,
    'image_parallax'                    => $image_parallax
), $atts));
*/

$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

// Mobile Detect
$detect = new Mobile_Detect;

if ($bg_mode=="video") {
    if ( $detect->isMobile() ) {
        $device_version = 'mobile-version';
    } else {
        $device_version = 'desktop-version';
    }
} else {
    $device_version = '';
}

// Scroll Button Section
$scrBtn = null;
if ($scroll_button==true) {
    if ($section_mode=="fluid" || $section_mode=="full-screen" ) {
        $srcBtn = '
        <a href="#'.esc_attr($scroll_id).'" class="scroll-btn-full-area"><i class="font-icon-arrow-down-simple-thin-round animated-opacity"></i></a>
        ';
    } else {
        $srcBtn = '';
    }
} else {
    $srcBtn = '';
}

// No Content Center
$no_wrap = null;
if ($no_content_wrap==true) {
    if ($section_mode=="full-screen") {
        $no_wrap = ' no-content';
    } else {
        $no_wrap = ' with-content';
    }
} else {
    $no_wrap = ' with-content';
}

// No Margin and Padding
$no_mrg_pdg = null;
if ($no_margin_padding==true) {
    if ($section_mode=="fluid") {
        $no_mrg_pdg = 'no-margin-and-padding';
    } else {
        $no_mrg_pdg = '';
    }
} else {
    $no_mrg_pdg = '';
}

// Section Mode
if ($section_mode=="normal") { $row_class = 'row'; $section_mode = 'container'; }
if ($section_mode=="fluid") { $row_class = 'row'; $section_mode = 'container-fluid'; }
if ($section_mode=="full-screen") { $row_class = 'row content-full-screen'; $section_mode = 'container-fluid full-screen'.$no_wrap.''; $section_class = 'section-full-area '.$section_class.''; }

// BG Mode
$img_id = preg_replace('/[^\d]/', '', $image);
$image_string = wp_get_attachment_image_src( $img_id, 'full');
$image_string = $image_string[0];

// Parallax
$img_parallax_id = preg_replace('/[^\d]/', '', $image_parallax);
$image_parallax_string = wp_get_attachment_image_src( $img_parallax_id, 'full');
//$image_parallax_string = $image_parallax_string[0];

// Pattern Mode
$pattern_id = preg_replace('/[^\d]/', '', $pattern);
$pattern_string = wp_get_attachment_image_src( $pattern_id, 'full');
$pattern_string = $pattern_string[0];

$pattern_output = null;
if ($bg_mode=="custom_image_bg" || $bg_mode=="custom_image_bg_parallax" || $bg_mode=="custom" || $bg_mode=="video") {
    if(!empty($pattern)) { 
        $pattern_output .= '
        <div class="section-overlay-pattern" style="background-image: url('.$pattern_string.');"></div>
        '; 
    } else { 
        $pattern_output = ''; 
    }
} else { 
    $pattern_output = ''; 
}

// Mask
$section_mask_output = null;
if ($bg_mode=="custom_image_bg" || $bg_mode=="custom_image_bg_parallax") { 
    if ($section_overlay == "yes_mask_overlay") {
        $section_mask_output = '
        <div class="section-overlay-mask" style="background-color: '.$section_overaly_color.';"></div>
        ';
    }
}

// Combination Background Modules
$bg_position = str_replace("_", " ", $bg_position);
$img_bg = $bg_img_prx = null;

if ($bg_mode=="default" && $padding=="custom-padding") { $bg_mode = ' style="padding-top: '.esc_attr($padding_top_value).'px; padding-bottom: '.esc_attr($padding_bottom_value).'px;"'; }
else if ($bg_mode=="default") { $bg_mode = ''; }

if ($bg_mode=="custom" && $padding=="custom-padding") { $bg_mode = ' style="background-color: '.$custom_bg_color.'; padding-top: '.esc_attr($padding_top_value).'px; padding-bottom: '.esc_attr($padding_bottom_value).'px;"'; } 
else if ($bg_mode=="custom") { $bg_mode = ' style="background-color: '.$custom_bg_color.';"'; }

if ($bg_repeat=="stretch") { $bg_repeat = 'background-repeat: no-repeat; background-size: cover;'; } 
else { $bg_repeat = 'background-repeat: '.$bg_repeat.';'; }

if ($bg_mode=="custom_image_bg" && $padding=="custom-padding") {
    $bg_image_background_color =  (!empty($bg_image_background_color) ? 'background-color: '.$bg_image_background_color.'; ' : '');
    $bg_mode = ' style="'.$bg_image_background_color.'background-attachment: scroll; background-position: '.$bg_position.'; '.$bg_repeat.' background-image: url('.$image_string.'); padding-top: '.esc_attr($padding_top_value).'px; padding-bottom: '.esc_attr($padding_bottom_value).'px;"'; $img_bg = 'image-cont'; 
}
else if ($bg_mode=="custom_image_bg") { 
    $bg_image_background_color =  (!empty($bg_image_background_color) ? 'background-color: '.$bg_image_background_color.'; ' : '');
    $bg_mode = ' style="'.$bg_image_background_color.'background-attachment: scroll; background-position: '.$bg_position.'; '.$bg_repeat.' background-image: url('.$image_string.');"'; $img_bg = 'image-cont';
}

if ($bg_mode=="custom_image_bg_parallax" && $padding=="custom-padding") {
    $bg_mode = ' style="padding-top: '.esc_attr($padding_top_value).'px; padding-bottom: '.esc_attr($padding_bottom_value).'px;"'; $img_bg = 'image-parallax-cont'; 
    $bg_img_prx = '<div class="img-parallax-layer" style="background-image: url('.$image_parallax_string[0].'); min-height:'.$image_parallax_string[2].'px;"></div>';
}
else if ($bg_mode=="custom_image_bg_parallax") { 
    $bg_mode = ''; $img_bg = 'image-parallax-cont';
    $bg_img_prx = '<div class="img-parallax-layer" style="background-image: url('.$image_parallax_string[0].'); min-height:'.$image_parallax_string[2].'px;"></div>';
}

// Video Output
$video_output = $video_mobile_out = $video_loop_output = $video_mask_output = $video_module_output = null;

// Mask Output
if($video_overlay == "yes_video_overlay"){
    $video_mask_output = '
    <div class="section-video-overlay-mask" style="background-color:'.$video_color_overlay.';"></div>
    ';
}

if ($bg_mode=="video" && $padding=="custom-padding") {
    $v_image = wp_get_attachment_url($custom_image_video);
    $bg_video_image = ( !empty($v_image) ) ? 'background-image: url('.$v_image.');' : '';

    $bg_mode = ' style="padding-top: '.esc_attr($padding_top_value).'px; padding-bottom: '.esc_attr($padding_bottom_value).'px;"';

    // Vimeo
    if ($video_mode=='vimeo_embed_code') {

        // Check Video Mobile/Tablets Settings
        if ( $custom_video_mobile_settings == 'lightbox' ) {
            $video_mobile_out = 'fancybox-media fancybox-video-popup';
        } else {
            $video_mobile_out = 'new-window-video';
        }

        $uniq_vimeo = uniqid();
        $vimeo_video_id = esc_attr( $custom_video_vimeo );

        // Decorative Module - Autoplay/Loop/Mute Enabled
        if ($custom_video_vimeo_module=='decorative_video_vimeo') {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>
                ';

            } else {

                $video_module_output = '
                <div class="video-status-vimeo-decorative"></div>
                <div class="video-embed-wrap">
                    <iframe class="vimeo video-section '.$custom_video_vimeo_module.'" id="player_'.$uniq_vimeo.'" src="http://player.vimeo.com/video/'.$vimeo_video_id.'?api=1&player_id=player_'.$uniq_vimeo.'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
                ';

            }
    
        }

        // Play/Pause Module - Autoplay/Loop/Mute Disabled
        else {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <a href="https://vimeo.com/'.$vimeo_video_id.'" target="_blank" class="mobile_video_button '.$video_mobile_out.'"><i class="font-icon-play"></i></a>
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>
                ';


            } else {

                $video_module_output = '
                <div class="video-status-vimeo pause" data-videovimeocheck="player_'.$uniq_vimeo.'">
                    <a href="#" class="vimeo_player_Section_button" data-videoid="player_'.$uniq_vimeo.'"><i class="font-icon-play"></i></a>
                </div>
                <div class="video-embed-wrap">
                    <iframe class="vimeo video-section '.$custom_video_vimeo_module.'" id="player_'.$uniq_vimeo.'" src="http://player.vimeo.com/video/'.$vimeo_video_id.'?api=1&player_id=player_'.$uniq_vimeo.'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
                ';

            }

        }

        $video_output = '
        <div class="video-section-container vimeo-video">
            '.$video_mask_output.'
            '.$video_module_output.'
        </div>';

    }
    // Youtube
    else if ($video_mode=='youtube_url') {

        // Check Video Mobile/Tablets Settings
        if ( $custom_video_mobile_settings == 'lightbox' ) {
            $video_mobile_out = 'fancybox-media fancybox-video-popup';
        } else {
            $video_mobile_out = 'new-window-video';
        }
        
        $yt_image = wp_get_attachment_url($custom_image_youtube_video);
        $bg_video_image_youtube = ( !empty($yt_image) ) ? '<div class="no-autoplay-video-fallback-image" style="background-image: url('.$yt_image.');"></div>' : '';

        $uniq_youtube = uniqid();
        $player_youtube_id = 'player_'.$uniq_youtube;

        $escape_url_yt = esc_attr( $custom_video_youtube );
        $youtube_video_url = "videoURL:'https://www.youtube.com/watch?v=$escape_url_yt'";
        $youtube_container = "containment:'.video-section-container.youtube-video.$player_youtube_id'";

        // Decorative Module - Autoplay/Loop/Mute Enabled
        if ($custom_video_youtube_module=='decorative_video_youtube') {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>';

            } else {

                $video_module_output = '
                '.$bg_video_image_youtube.'
                <a class="player_YT_Mod_section '.$custom_video_youtube_module.'" data-property="{'.$youtube_video_url.','.$youtube_container.',startAt:0,mute:true,autoPlay:true,loop:true,opacity:1,printUrl:false,showControls:false,stopMovieOnBlur:false}"></a>
                ';

            }

        }

        // Play/Pause Module - Autoplay/Loop/Mute Disabled
        else {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <a href="https://www.youtube.com/watch?v='.$escape_url_yt.'" target="_blank" class="mobile_video_button '.$video_mobile_out.'"><i class="font-icon-play"></i></a>
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>';

            } else {

                $video_module_output = '
                <div class="video-status-youtube pause" data-videocheck="'.$player_youtube_id.'">
                    <a href="#" class="player_YT_Mod_Section_button" data-videoid="'.$player_youtube_id.'"><i class="font-icon-play"></i></a>
                </div>
                '.$bg_video_image_youtube.'
                <a id="'.$player_youtube_id.'" data-player="'.$player_youtube_id.'" class="player_YT_Mod_section '.$custom_video_youtube_module.'" data-property="{'.$youtube_video_url.','.$youtube_container.',startAt:0,mute:false,autoPlay:false,loop:false,opacity:1,printUrl:false,showControls:false,stopMovieOnBlur:false}"></a>
                ';

            }

        }

        $video_output = '
        <div class="video-section-container youtube-video '.$player_youtube_id.' '.$custom_video_youtube_module.'">
        '.$video_mask_output.'
        '.$video_module_output.'
        </div>
        ';

    }
    // Self-Hosted
    else if ($video_mode=='self_hosted') {

        // Check Video Mobile/Tablets Settings
        if ( $custom_video_mobile_settings == 'lightbox' ) {
            $video_mobile_out = 'fancybox-media fancybox-video-popup-self-hosted';
        } else {
            $video_mobile_out = 'new-window-video';
        }

        $self_image = wp_get_attachment_url($custom_image_self_video);
        $bg_video_image_self = ( !empty($self_image) ) ? '<div class="no-autoplay-video-fallback-image-self" style="background-image: url('.$self_image.');"></div>' : '';

        $uniq_self = uniqid();
        $player_self_id = 'player_self_'.$uniq_self;

        // Decorative Module - Autoplay/Loop/Mute Enabled
        if ($custom_video_self_hosted_module=='decorative_video_self_hosted') {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>';

            } else {

                $video_module_output = '
                <div class="video-status-self-decorative"></div>
                <div class="video-wrap">
                    <video id="'.$player_self_id.'" class="video video-section '.$custom_video_self_hosted_module.'" preloader="auto" loop width="1920" height="800" data-volume="mute" data-autoplay="true">
                        <source type="video/webm" src="'.esc_url($custom_video_webm).'">
                        <source type="video/mp4" src="'.esc_url($custom_video_mp4).'">
                    </video>
                </div>
                ';

            }

        }

        // Play/Pause Module - Autoplay/Loop/Mute Disabled
        else {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <a href="'.esc_url($custom_video_mp4).'" target="_blank" class="mobile_video_button '.$video_mobile_out.'" data-poster="'.$self_image.'"><i class="font-icon-play"></i></a>
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>';

            } else {

                $video_module_output = '
                <div class="video-status-self pause">
                    <a href="#" class="self_player_section_button"><i class="font-icon-play"></i></a>
                </div>
                '.$bg_video_image_self.'
                <div class="video-wrap">
                    <video id="'.$player_self_id.'" class="video video-section '.$custom_video_self_hosted_module.'" preloader="auto" width="1920" height="800" data-volume="unmute" data-autoplay="false">
                        <source type="video/webm" src="'.esc_url($custom_video_webm).'">
                        <source type="video/mp4" src="'.esc_url($custom_video_mp4).'">
                    </video>
                </div>
                ';

            }

        }

        $video_output = '
        <div class="video-section-container self-hosted-video">
        '.$video_mask_output.'
        '.$video_module_output.'
        </div>
        ';

    }
}
else if ($bg_mode=="video") {
    $bg_mode = ''; 
    $v_image = wp_get_attachment_url($custom_image_video);
    $bg_video_image = ( !empty($v_image) ) ? 'background-image: url('.$v_image.');' : '';

    // Vimeo
    if ($video_mode=='vimeo_embed_code') {

        // Check Video Mobile/Tablets Settings
        if ( $custom_video_mobile_settings == 'lightbox' ) {
            $video_mobile_out = 'fancybox-media fancybox-video-popup';
        } else {
            $video_mobile_out = 'new-window-video';
        }

        $uniq_vimeo = uniqid();
        $vimeo_video_id = esc_attr( $custom_video_vimeo );

        // Decorative Module - Autoplay/Loop/Mute Enabled
        if ($custom_video_vimeo_module=='decorative_video_vimeo') {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>
                ';

            } else {

                $video_module_output = '
                <div class="video-status-vimeo-decorative"></div>
                <div class="video-embed-wrap">
                    <iframe class="vimeo video-section '.$custom_video_vimeo_module.'" id="player_'.$uniq_vimeo.'" src="http://player.vimeo.com/video/'.$vimeo_video_id.'?api=1&player_id=player_'.$uniq_vimeo.'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
                ';

            }
    
        }

        // Play/Pause Module - Autoplay/Loop/Mute Disabled
        else {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <a href="https://vimeo.com/'.$vimeo_video_id.'" target="_blank" class="mobile_video_button '.$video_mobile_out.'"><i class="font-icon-play"></i></a>
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>
                ';


            } else {

                $video_module_output = '
                <div class="video-status-vimeo pause" data-videovimeocheck="player_'.$uniq_vimeo.'">
                    <a href="#" class="vimeo_player_Section_button" data-videoid="player_'.$uniq_vimeo.'"><i class="font-icon-play"></i></a>
                </div>
                <div class="video-embed-wrap">
                    <iframe class="vimeo video-section '.$custom_video_vimeo_module.'" id="player_'.$uniq_vimeo.'" src="http://player.vimeo.com/video/'.$vimeo_video_id.'?api=1&player_id=player_'.$uniq_vimeo.'" width="100%" height="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
                ';

            }

        }

        $video_output = '
        <div class="video-section-container vimeo-video">
            '.$video_mask_output.'
            '.$video_module_output.'
        </div>';

    }
    // Youtube
    else if ($video_mode=='youtube_url') {

        // Check Video Mobile/Tablets Settings
        if ( $custom_video_mobile_settings == 'lightbox' ) {
            $video_mobile_out = 'fancybox-media fancybox-video-popup';
        } else {
            $video_mobile_out = 'new-window-video';
        }

        $yt_image = wp_get_attachment_url($custom_image_youtube_video);
        $bg_video_image_youtube = ( !empty($yt_image) ) ? '<div class="no-autoplay-video-fallback-image" style="background-image: url('.$yt_image.');"></div>' : '';

        $uniq_youtube = uniqid();
        $player_youtube_id = 'player_'.$uniq_youtube;

        $escape_url_yt = esc_attr( $custom_video_youtube );
        $youtube_video_url = "videoURL:'https://www.youtube.com/watch?v=$escape_url_yt'";
        $youtube_container = "containment:'.video-section-container.youtube-video.$player_youtube_id'";

        // Decorative Module - Autoplay/Loop/Mute Enabled
        if ($custom_video_youtube_module=='decorative_video_youtube') {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>';

            } else {

                $video_module_output = '
                '.$bg_video_image_youtube.'
                <a class="player_YT_Mod_section '.$custom_video_youtube_module.'" data-property="{'.$youtube_video_url.','.$youtube_container.',startAt:0,mute:true,autoPlay:true,loop:true,opacity:1,printUrl:false,showControls:false,stopMovieOnBlur:false}"></a>
                ';

            }

        }

        // Play/Pause Module - Autoplay/Loop/Mute Disabled
        else {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <a href="https://www.youtube.com/watch?v='.$escape_url_yt.'" target="_blank" class="mobile_video_button '.$video_mobile_out.'"><i class="font-icon-play"></i></a>
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>';

            } else {

                $video_module_output = '
                <div class="video-status-youtube pause" data-videocheck="'.$player_youtube_id.'">
                    <a href="#" class="player_YT_Mod_Section_button" data-videoid="'.$player_youtube_id.'"><i class="font-icon-play"></i></a>
                </div>
                '.$bg_video_image_youtube.'
                <a id="'.$player_youtube_id.'" data-player="'.$player_youtube_id.'" class="player_YT_Mod_section '.$custom_video_youtube_module.'" data-property="{'.$youtube_video_url.','.$youtube_container.',startAt:0,mute:false,autoPlay:false,loop:false,opacity:1,printUrl:false,showControls:false,stopMovieOnBlur:false}"></a>
                ';

            }

        }

        $video_output = '
        <div class="video-section-container youtube-video '.$player_youtube_id.' '.$custom_video_youtube_module.'">
        '.$video_mask_output.'
        '.$video_module_output.'
        </div>
        ';

    }
    // Self-Hosted
    else if ($video_mode=='self_hosted') {

        // Check Video Mobile/Tablets Settings
        if ( $custom_video_mobile_settings == 'lightbox' ) {
            $video_mobile_out = 'fancybox-media fancybox-video-popup-self-hosted';
        } else {
            $video_mobile_out = 'new-window-video';
        }

        $self_image = wp_get_attachment_url($custom_image_self_video);
        $bg_video_image_self = ( !empty($self_image) ) ? '<div class="no-autoplay-video-fallback-image-self" style="background-image: url('.$self_image.');"></div>' : '';

        $uniq_self = uniqid();
        $player_self_id = 'player_self_'.$uniq_self;

        // Decorative Module - Autoplay/Loop/Mute Enabled
        if ($custom_video_self_hosted_module=='decorative_video_self_hosted') {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>';

            } else {

                $video_module_output = '
                <div class="video-status-self-decorative"></div>
                <div class="video-wrap">
                    <video id="'.$player_self_id.'" class="video video-section '.$custom_video_self_hosted_module.'" preloader="auto" loop width="1920" height="800" data-volume="mute" data-autoplay="true">
                        <source type="video/webm" src="'.esc_url($custom_video_webm).'">
                        <source type="video/mp4" src="'.esc_url($custom_video_mp4).'">
                    </video>
                </div>
                ';

            }

        }

        // Play/Pause Module - Autoplay/Loop/Mute Disabled
        else {

            // if Mobile/Tablet
            if ( $detect->isMobile() ) {

                $video_module_output = '
                <a href="'.esc_url($custom_video_mp4).'" target="_blank" class="mobile_video_button '.$video_mobile_out.'" data-poster="'.$self_image.'"><i class="font-icon-play"></i></a>
                <div class="mobile-video-fallback-image" style="'.$bg_video_image.'"></div>';

            } else {

                $video_module_output = '
                <div class="video-status-self pause">
                    <a href="#" class="self_player_section_button"><i class="font-icon-play"></i></a>
                </div>
                '.$bg_video_image_self.'
                <div class="video-wrap">
                    <video id="'.$player_self_id.'" class="video video-section '.$custom_video_self_hosted_module.'" preloader="auto" width="1920" height="800" data-volume="unmute" data-autoplay="false">
                        <source type="video/webm" src="'.esc_url($custom_video_webm).'">
                        <source type="video/mp4" src="'.esc_url($custom_video_mp4).'">
                    </video>
                </div>
                ';

            }

        }

        $video_output = '
        <div class="video-section-container self-hosted-video">
        '.$video_mask_output.'
        '.$video_module_output.'
        </div>
        ';

    }
}

// Responsive Visibility
if ($responsive_lg==true) { $responsive_lg = 'hidden-lg'; }
if ($responsive_md==true) { $responsive_md = 'hidden-md'; }
if ($responsive_sm==true) { $responsive_sm = 'hidden-sm'; }
if ($responsive_xs==true) { $responsive_xs = 'hidden-xs'; }

// Set ID and Classes
$el_class = $this->getExtraClass($el_class);
$section_id_Value = (!empty($section_id) ? ' id="'.esc_attr($section_id).'"' : '');
$css_class =  apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $row_class.(!empty($el_class) ? ' '.$el_class : ''), $this->settings['base']);
$class = setClass(array('main-content master-section-content', $device_version, $img_bg, $section_class, $detect_contrast, $no_mrg_pdg, $padding, $responsive_lg, $responsive_md, $responsive_sm, $responsive_xs));

// Output
$output .= '
<div'.$section_id_Value.$class.$bg_mode.'>'.$bg_img_prx.$pattern_output.$srcBtn.$video_output.$section_mask_output.'';
$output .= '
<div class="'.$section_mode.'">';
$output .= '
<div class="'.$css_class.'">';
$output .= 
wpb_js_remove_wpautop($content);
$output .= '
</div>';
$output .= '
</div>';
$output .= '
</div>'.$this->endBlockComment('row');

echo $output;