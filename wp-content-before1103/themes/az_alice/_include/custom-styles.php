<?php 
$options_alice = get_option('alice');

// Custom CSS
if( !empty($options_alice['custom_css']) && $options_alice['enable_custom_css'] == 1 ){

    if ( !function_exists('az_custom_css_header') ) {   
        function az_custom_css_header() {
            global $options_alice;

            $custom_css_output = $options_alice['custom_css'];
            if ( $custom_css_output !== '' ) {
                echo '
                <style type="text/css">
                    /* ALICE CUSTOM CSS */
                    '.$custom_css_output.'
                </style>'."\n";

            }
        }
    }

    add_action('wp_head', 'az_custom_css_header');
}


// Custom Fonts
if( !empty($options_alice['enable_custom_fonts']) && $options_alice['enable_custom_fonts'] == 1 ){

    if ( !function_exists('az_custom_fonts_header') ) {   
        function az_custom_fonts_header() {
            global $options_alice;

            // Create Custom CSS

            $custom_font_css = '

                /* CUSTOM FONTS */

                .logo-setup.logo-text { font-family: '.$options_alice['logo_text_typo']['font-family'].', "HelveticaNeue", helvetica, arial, sans-serif; }

                body, input, button, select, textarea, .comment-author .comment-title { font-family: '.$options_alice['general_body_common_text_typo']['font-family'].', "HelveticaNeue", helvetica, arial, sans-serif; }

                #blog .post-creative .post-link .post-naming .post-date,#blog .post-creative .post-link .post-naming .post-title,#error-page .box-content-titles .error-subheading,#error-page .box-content-titles .error-title,#title-header-flexslider.flexslider .slider-content .slide-subtitle,#title-header-flexslider.flexslider .slider-content.big-format-heading .slide-title,.az-button,.az-divider,.big-format-heading .box-content-titles .subheading,.big-format-heading .box-content-titles .title,.box-content-titles .subheading,.entry-meta-area,.footer .credits,.footer .share-footer,.form-submit #submit,.infinite-scroll p,.menu-search,.menu-share,.mm-panel .sub-menu li a,.mm-panel ul li a,.mm-classic-panel ul li a,.mm-classic-panel .sub-menu li a,.modal-search .search-subtitle,.modal-search form#searchform input[type=text],.normal-pagination .next-post a .pagination-inner,.normal-pagination .prev-post a .pagination-inner,.portfolio-navi-popup .counter-portfolio,.share-btn-footer>span,.team-navi-popup .counter-team,.dots-menu-navigation .dots-menu-label,#az_header_language_list .lang,h1,h2,h3,h4,h5,h6 { font-family: '.$options_alice['general_heading_common_text_typo']['font-family'].', "HelveticaNeue", helvetica, arial, sans-serif; } 
            
                #blog.grid .count-number-post,#title-header-flexslider.flexslider .slider-content .slide-title,.bg-slogan-content .slogan-text,.box-content-titles .title,.wp-caption,blockquote { font-family: '.$options_alice['general_special_common_text_typo']['font-family'].', Georgia, "Times New Roman", Times, serif; }
                
                /* END CUSTOM FONTS */

            ';

            echo '
            <style type="text/css">
                '.$custom_font_css.'
            </style>'."\n";


        }
    }
    
    add_action('wp_head', 'az_custom_fonts_header');
}


// Custom Colors
if( !empty($options_alice['enable_custom_colors']) && $options_alice['enable_custom_colors'] == 1 ){

    if ( !function_exists('az_custom_colors_header') ) {   

        // Hex to Rgb
        function hex2rgb($hex) {
           $hex = str_replace("#", "", $hex);

           if(strlen($hex) == 3) {
              $r = hexdec(substr($hex,0,1).substr($hex,0,1));
              $g = hexdec(substr($hex,1,1).substr($hex,1,1));
              $b = hexdec(substr($hex,2,1).substr($hex,2,1));
           } else {
              $r = hexdec(substr($hex,0,2));
              $g = hexdec(substr($hex,2,2));
              $b = hexdec(substr($hex,4,2));
           }
           $rgb = array($r, $g, $b);
           //return implode(",", $rgb); // returns the rgb values separated by commas
           return $rgb; // returns an array with the rgb values
        }

        function az_custom_colors_header() {
            global $options_alice;

            // Create Custom CSS

            $custom_colors_css = '

                /* CUSTOM COLORS */

                ::selection { background: '.$options_alice['general_main_custom_color'].'; }
                ::-moz-selection { background: '.$options_alice['general_main_custom_color'].'; }

                .light-type #title-header-flexslider.flexslider .slider-content .slide-subtitle,.light-type #title-header-flexslider.flexslider .slider-content .slide-title,.light-type .box-content-titles .subheading,.light-type .box-content-titles .title,.light-type .logo-setup.logo-text,.light-type .mobile_video_button.normal-inside i,.light-type .optional-menu a,.light-type #az_header_language_list .lang a,.light-type .player_YT_Mod_button.normal-inside i,.light-type .scroll-btn-full-area-title-header i,.light-type .self_player_button.normal-inside i,.light-type .vimeo_player_button.normal-inside i,.no-touch .light-type .optional-menu a:hover, .light-type .mm-classic-panel ul li a { color: '.$options_alice['light_type_custom_color'].'; }

                .light-type .menu-nav .bars .top,.light-type .menu-nav .bars .middle,.light-type .menu-nav .bars .bottom { background: '.$options_alice['light_type_custom_color'].'; }

                .light-type .optional-menu .menu-share::before, .light-type .optional-menu .menu-search::before, .light-type #az_header_language_list::before, .light-type .mm-classic-panel ul li::before { background: rgba('.implode(',', hex2rgb($options_alice['light_type_custom_color'])).',0.35); }

                .light-type #title-header-flexslider.flexslider .flex-control-nav li a { border-color: '.$options_alice['light_type_custom_color'].'; }

                .light-type #title-header-flexslider.flexslider .flex-control-nav li a::before,.light-type #title-header-flexslider.flexslider .flex-control-nav li a.flex-active,.no-touch .light-type #title-header-flexslider.flexslider .flex-control-nav li a:hover::after { background: rgba('.implode(',', hex2rgb($options_alice['light_type_custom_color'])).',0.6); }

                .light-type .mobile_video_button.normal-inside,.light-type .self_player_button.normal-inside,.light-type .player_YT_Mod_button.normal-inside,.light-type .vimeo_player_button.normal-inside { border-color: rgba('.implode(',', hex2rgb($options_alice['light_type_custom_color'])).',0.35); }

                .light-type .mobile_video_button.normal-inside:hover,.light-type .self_player_button.normal-inside:hover,.light-type .player_YT_Mod_button.normal-inside:hover,.light-type .vimeo_player_button.normal-inside:hover { background-color: rgba('.implode(',', hex2rgb($options_alice['light_type_custom_color'])).',0.175); }

                .dark-type #title-header-flexslider.flexslider .slider-content .slide-subtitle,.dark-type #title-header-flexslider.flexslider .slider-content .slide-title,.dark-type .box-content-titles .subheading,.dark-type .box-content-titles .title,.dark-type .logo-setup.logo-text,.dark-type .mobile_video_button.normal-inside i,.dark-type .optional-menu a,.dark-type #az_header_language_list .lang a,.dark-type .player_YT_Mod_button.normal-inside i,.dark-type .scroll-btn-full-area-title-header i,.dark-type .self_player_button.normal-inside i,.dark-type .vimeo_player_button.normal-inside i,.no-touch .dark-type .optional-menu a:hover, .dark-type .mm-classic-panel ul li a { color: '.$options_alice['dark_type_custom_color'].'; }

                .dark-type .menu-nav .bars .top,.dark-type .menu-nav .bars .middle,.dark-type .menu-nav .bars .bottom { background: '.$options_alice['dark_type_custom_color'].'; }

                .dark-type .optional-menu .menu-share::before,.dark-type .optional-menu .menu-search::before, .dark-type #az_header_language_list::before, .dark-type .mm-classic-panel ul li::before { background: rgba('.implode(',', hex2rgb($options_alice['dark_type_custom_color'])).',0.35); }

                .dark-type #title-header-flexslider.flexslider .flex-control-nav li a { border-color: '.$options_alice['dark_type_custom_color'].'; }

                .dark-type #title-header-flexslider.flexslider .flex-control-nav li a.flex-active,.dark-type #title-header-flexslider.flexslider .flex-control-nav li a::before,.no-touch .dark-type #title-header-flexslider.flexslider .flex-control-nav li a:hover::after { background-color: rgba('.implode(',', hex2rgb($options_alice['dark_type_custom_color'])).',0.6); }

                .dark-type .mobile_video_button.normal-inside,.dark-type .player_YT_Mod_button.normal-inside,.dark-type .self_player_button.normal-inside,.dark-type .vimeo_player_button.normal-inside { border-color: rgba('.implode(',', hex2rgb($options_alice['dark_type_custom_color'])).',0.35); }

                .dark-type .mobile_video_button.normal-inside:hover,.dark-type .player_YT_Mod_button.normal-inside:hover,.dark-type .self_player_button.normal-inside:hover,.dark-type .vimeo_player_button.normal-inside:hover { background-color: rgba('.implode(',', hex2rgb($options_alice['dark_type_custom_color'])).',0.175); }

                .az-box-icon .az-box-icon-media i,.az-box-icon .box-wrapper-link,.az-box-icon .box-wrapper-link .box-text,.portfolio-filter li a,body { color: '.$options_alice['general_body_custom_color'].'; }

                #az_header_language_list .lang,.dropcap-color,.highlight-normal-text,.no-touch #cancel-comment-reply-link:hover,.no-touch #cd-zoom-in:hover i,.no-touch #cd-zoom-out:hover i,.no-touch #error-page .back-home:hover,.no-touch #twitter-feed-section .tweet_text a:hover,.no-touch .az-box-icon .box-wrapper-link:hover .box-title,.no-touch .az-social-profiles ul.az-social-profiles-link li a:hover,.no-touch .credits-social ul li a:hover,.no-touch .footer .credits-social ul li a:hover,.no-touch .dark-type.footer-widget-area a:hover,.no-touch .footer .credits a:hover,.no-touch .mm-panel ul li a:hover,.no-touch .portfolio-filter li a:hover,.no-touch a:active,.no-touch a:focus,.no-touch a:hover,.normal-pagination.numbers-only a.active,.normal-pagination.numbers-only a.nothing-dot,.portfolio-filter li a.selected,a:active,a:focus,.no-touch .panel-title > a:hover { color: '.$options_alice['general_main_custom_color'].'; }

                .no-touch .mm-panel ul li a:hover,.mm-panel li.current a,.mm-panel li.current-cat a,.mm-panel li.current_page_item a,.mm-panel li.current-menu-item a,.mm-panel li.current-page-ancestor a,.mm-panel li.current-menu-ancestor a { color: '.$options_alice['general_main_custom_color'].'; }

                .no-touch .mm-panel .sub-menu li a:hover,.mm-panel .sub-menu li.current a,.mm-panel .sub-menu li.current-cat a,.mm-panel .sub-menu li.current_page_item a,.mm-panel .sub-menu li.current-menu-item a,.mm-panel .sub-menu li.current-page-ancestor a,.mm-panel .sub-menu li.current-menu-ancestor a { color: '.$options_alice['general_main_custom_color'].'!important; }

                .no-touch .mm-classic-panel ul li a:hover,.mm-classic-panel li.current > a,.mm-classic-panel li.current-cat > a,.mm-classic-panel li.current_page_item > a,.mm-classic-panel li.current-menu-item > a,.mm-classic-panel li.current-page-ancestor > a,.mm-classic-panel li.current-menu-ancestor > a { color: '.$options_alice['general_main_custom_color'].'!important; }

                .no-touch .mm-classic-panel .sub-menu li a:hover,.mm-classic-panel .sub-menu li.current > a,.mm-classic-panel .sub-menu li.current-cat > a,.mm-classic-panel .sub-menu li.current_page_item > a,.mm-classic-panel .sub-menu li.current-menu-item > a,.mm-classic-panel .sub-menu li.current-page-ancestor > a,.mm-classic-panel .sub-menu li.current-menu-ancestor > a { color: '.$options_alice['general_main_custom_color'].'!important; }

                #preloader-container .pre-progress-bar,.bg-slogan-menu.bg-solid-color-slogan,.form-submit::after,.form-submit::before,.highlight-color-text,.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,.mejs-controls .mejs-time-rail .mejs-time-current,.mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current,.no-touch .normal-pagination .back-post a:hover,.no-touch .normal-pagination .next-post a:hover,.no-touch .normal-pagination .prev-post a:hover,.no-touch .normal-pagination.numbers-only a:hover,.no-touch .tagcloud a:hover,.no-touch a.az-button:hover,.optional-menu a::after,.tagcloud a:active,.tagcloud a:focus,a.az-button:active,a.az-button:focus,.no-touch .wpcf7 .wpcf7-submit:hover { background: '.$options_alice['general_main_custom_color'].'; }

                .dark-type.footer-widget-area .tagcloud a:focus,.dark-type.footer-widget-area .tagcloud a:hover,.no-touch #creative-popup-flexslider .flex-direction-nav li a:hover,.no-touch .dark-type.footer-widget-area .tagcloud a:active,.no-touch .portfolio-navi-popup a:hover,.no-touch .team-navi-popup a:hover,.no-touch a.az-button.inverted-mode:hover,a.az-button.inverted-mode:active,a.az-button.inverted-mode:focus { background: '.$options_alice['general_main_custom_color'].'; border-color: '.$options_alice['general_main_custom_color'].'; }

                #searchform input[type=text]:focus,.preloader,.respond-comment textarea:focus,.respond-field input:focus,.widget_search form input[type=text]:focus,.wpcf7 input[type=text]:focus,.wpcf7 input[type=email]:focus, .wpcf7 textarea:focus { border-color: '.$options_alice['general_main_custom_color'].'; }

                .no-touch .mejs-overlay:hover .mejs-overlay-button {  background-color: '.$options_alice['general_main_custom_color'].';  }

                .no-touch .light-type .logo-setup.logo-text:hover, .no-touch .dark-type .logo-setup.logo-text:hover { color: '.$options_alice['general_main_custom_color'].'!important; }

                @media (min-width: 320px) and (max-width: 1024px) {

                    #my-menu.mobile-menu .mm-panel li.current a,#my-menu.mobile-menu .mm-panel li.current-cat a,#my-menu.mobile-menu .mm-panel li.current-menu-ancestor a,#my-menu.mobile-menu .mm-panel li.current-menu-item a,#my-menu.mobile-menu .mm-panel li.current-page-ancestor a,#my-menu.mobile-menu .mm-panel li.current_page_item a,.no-touch #my-menu.mobile-menu .credits-social ul li a:hover,.no-touch #my-menu.mobile-menu .mm-panel ul li a:hover { color: '.$options_alice['general_main_custom_color'].'; }

                    .no-touch #my-menu.mobile-menu .sub-menu li a:hover { color: '.$options_alice['general_main_custom_color'].' !important; }

                }

                /* END CUSTOM COLORS */

            ';

            echo '
            <style type="text/css">
                '.$custom_colors_css.'
            </style>'."\n";


        }
    }
    
    add_action('wp_head', 'az_custom_colors_header');
}

?>