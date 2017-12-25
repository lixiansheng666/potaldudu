<?php
$redux_opt_name = "alice";

if ( !function_exists( "redux_add_metaboxes" ) ):
    function redux_add_metaboxes($metaboxes) {

        // Global Alice
        global $options_alice;

        // ID prefix
        $prefix = 'az_';

        // Define arrays
        $metaboxes = array();

        // Revolution Slider
        include_once(ABSPATH.'wp-admin/includes/plugin.php');

        if (is_plugin_active('revslider/revslider.php')) {
            global $wpdb;
            $query = $wpdb->prepare(
              "
              SELECT id, title, alias
              FROM ".$wpdb->prefix."revslider_sliders
              ORDER BY %s ASC LIMIT 100
              ", 'id'
            );

            $rs = $wpdb->get_results($query);
            $revsliders = array();
            if ($rs) {
                foreach ( $rs as $slider ) {
                    $revsliders[$slider->alias] = $slider->alias;
                }
            } else {
                $revsliders["No sliders found"] = 0;
            }
        } else {
            $revsliders["No Plugin Installed"] = null;
        }

        // Main Settings

        /*-----------------------------------------------------------------------------------*/
        /*  - Preloader
        /*-----------------------------------------------------------------------------------*/
        if( !empty($options_alice['preloader_settings']) && $options_alice['preloader_settings'] == 1) {

            $main_settings[] = array(
                'title'     => __( 'Preloader', 'redux-framework-demo' ),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
                    array(
                        'id'        =>  $prefix . 'preloader_display',
                        'type'      =>  'button_set',
                        'title'     =>  __('Preloader Settings', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enable or Disable the Preloader.', 'redux-framework-demo'),
                        'options'   =>  array(
                            'show'  =>  'Show',
                            'hide'  =>  'Hide',
                        ),
                        'default'   =>  $options_alice['global_preloader_visibility'],
                    ),
                ),
            );

        }

        /*-----------------------------------------------------------------------------------*/
        /*  - Logo & Menu
        /*-----------------------------------------------------------------------------------*/
        $main_settings[] = array(
            'title'     => __( 'Logo & Menu', 'redux-framework-demo' ),
            'icon'      => 'el-icon-cog',
            'fields'    => array(

                array(
                    'id'        =>  $prefix . 'logo_navi_type_color',
                    'type'      =>  'button_set',
                    'title'     =>  __('Logo/Navigation Type', 'redux-framework-demo'), 
                    'subtitle'  =>  __('The setting refers to which type of logo/navigation will appear.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'light' =>  'Light',
                        'dark'  =>  'Dark',
                    ),
                    'default'   =>  $options_alice['global_logo_navi_type_color'],
                ),
            ),
        );

        /*-----------------------------------------------------------------------------------*/
        /*  - Dots Menu
        /*-----------------------------------------------------------------------------------*/
        $main_settings[] = array(
            'title'     => __( 'Dots Menu', 'redux-framework-demo' ),
            'icon'      => 'el-icon-cog',
            'fields'    => array(

                array(
                    'id'        =>  $prefix . 'dots_menu_display',
                    'type'      =>  'button_set',
                    'title'     =>  __('Dots Menu', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Side dots navigation on left side of the page. Useful for long pages.', 'redux-framework-demo'),
                    'options'   =>  array(
                        ''      =>  'Hide',
                        'show'  =>  'Show',
                    ),
                    'default'   =>  '',
                ),

                array(
                    'id'        =>  $prefix . 'dots_menu_id_sections',
                    'type'      =>  'text',
                    'title'     =>  __( 'Section IDs', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Required. Write the section ids in this field, separated by commas.<br><br><em>ID of the top page is main.</em>', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'dots_menu_display', '=', 'show' ),
                ),

                array(
                    'id'        =>  $prefix . 'dots_menu_label_sections',
                    'type'      =>  'text',
                    'title'     =>  __( 'Label Section IDs', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Optional. Write the label text for your sections ids in this field, separated by commas.', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'dots_menu_display', '=', 'show' ),
                ),

            ),
        );


        /*-----------------------------------------------------------------------------------*/
        /*  - Footer Widget
        /*-----------------------------------------------------------------------------------*/
        $main_settings[] = array(
            'title'     => __( 'Footer Widget', 'redux-framework-demo' ),
            'icon'      => 'el-icon-cog',
            'fields'    => array(

                array(
                    'id'        =>  $prefix . 'footer_widget_display',
                    'type'      =>  'button_set',
                    'title'     =>  __('Footer Widget Settings', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Enable or Disable the Footer Widget Area.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'show'  =>  'Show',
                        'hide'  =>  'Hide',
                    ),
                    'default'   =>  $options_alice['global_footer_widget_visibility'],
                ),

            ),
        );

        /*-----------------------------------------------------------------------------------*/
        /*  - Title Header for Pages/Posts
        /*-----------------------------------------------------------------------------------*/
        $main_settings[] = array(
            'title'     => __( 'Title Header', 'redux-framework-demo' ),
            'icon'      => 'el-icon-cog',
            'fields'    => array(
                // Title Header
                array(
                    'id'        =>  $prefix . 'title_header_display',
                    'type'      =>  'button_set',
                    'title'     =>  __('Title Header', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Enable or Disable the Title Header Area.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'show'  =>  'Show',
                        'hide'  =>  'Hide',
                    ),
                    'default'   =>  $options_alice['global_title_header_visibility'],
                ),

                // Title Header Hide Options
                array(
                    'id'        =>  $prefix . 'title_header_hide_display',
                    'type'      =>  'button_set',
                    'title'     =>  __('Title Header Hide Module', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select if the page header is transparent or has a simple background color when this is hide.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'transparent'  =>  'Transparent',
                        'colorful'  =>  'Colorful',
                    ),
                    'default'   =>  $options_alice['global_title_header_hide_visibility'],
                    'required'  =>  array( $prefix . 'title_header_display', '=', 'hide' ),
                ),

                array(
                    'id'            =>  $prefix .'title_header_hide_color',
                    'type'          =>  'color',
                    'title'         =>  __( 'Title Header Text Color', 'redux-framework-demo' ),
                    'subtitle'      =>  __( 'Optional. Choose a text color for your heading and subheading.', 'redux-framework-demo' ),
                    'output'        =>  false,
                    'validate'      =>  false,
                    'transparent'   =>  false,
                    'default'       =>  $options_alice['global_title_header_hide_color'],
                    'required'  => array(
                        array( $prefix . 'title_header_display', '=', 'hide' ),
                        array( $prefix . 'title_header_hide_display', '=', 'colorful' ),
                    ),
                ),

                // Title Header Layout
                array(
                    'id'        =>  $prefix . 'title_header_layout',
                    'type'      =>  'button_set',
                    'title'     =>  __('Title Header Layout', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your layout for the title header page.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'normal'     =>  'Normal',
                        'fullscreen' =>  'Full Screen',
                    ),
                    'default'   =>  $options_alice['global_title_header_layout_container'],
                    'required'  =>  array( $prefix . 'title_header_display', '!=', 'hide' ),
                ),

                // Title Header Height
                array(
                    'id'        => $prefix . 'title_header_height',
                    'type'      => 'text',
                    'title'     => __( 'Title Header Height', 'redux-framework-demo' ),
                    'subtitle'  => __( 'Select your custom height for your title header page. Default is 600px.<br><br><em>Enter only a number value.</em>', 'redux-framework-demo' ),
                    'default'   => $options_alice['global_title_header_height'],
                    'required'  => array(
                        array( $prefix . 'title_header_display', '!=', 'hide' ),
                        array( $prefix . 'title_header_layout', '!=', 'fullscreen' ),
                    ),
                ),

                // Title Header Scroll To Next Section
                array(
                    'id'        =>  $prefix . 'scroll_to_section',
                    'type'      =>  'button_set',
                    'title'     =>  __('Scroll Button To Next Section', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Enable or Disable Scroll Button Feature.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'enable'    =>  'Enable',
                        'disable'   =>  'Disable',
                    ),
                    'default'   =>  $options_alice['global_scroll_to_section'],
                    'required'  =>  array( $prefix . 'title_header_layout', '=', 'fullscreen' ),
                ),

                // Title Header Module
                array(
                    'id'        =>  $prefix . 'title_header_module',
                    'type'      =>  'select',
                    'title'     =>  __('Title Header Module', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your favorite Title Header Module.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'normal'            =>  __( 'Normal', 'redux-framework-demo' ),
                        'image'             =>  __( 'Image', 'redux-framework-demo' ),
                        'image_parallax'    =>  __( 'Image Parallax', 'redux-framework-demo' ),
                        'video'             =>  __( 'Video', 'redux-framework-demo' ),
                        'slider'            =>  __( 'Slider', 'redux-framework-demo' ),
                        'animate'           =>  __( 'Animated Pattern Background', 'redux-framework-demo' ),
                    ),
                    'default'   =>  'normal',
                    'required'  =>  array( $prefix . 'title_header_display', '!=', 'hide' ),
                ),

                // Title Header Module: Normal
                array(
                    'id'            =>  $prefix .'title_header_normal_bg_color',
                    'type'          =>  'color',
                    'title'         =>  __( 'Title Header Background Color', 'redux-framework-demo' ),
                    'subtitle'      =>  __( 'Optional. Choose a background color for your title header section.', 'redux-framework-demo' ),
                    'output'        =>  false,
                    'validate'      =>  false,
                    'transparent'   =>  false,
                    'default'       =>  $options_alice['global_title_header_normal_bg_color'],
                    'required'      =>  array( $prefix . 'title_header_module', '=', 'normal' ),
                ),

                // Title Header Module: Image
                array(
                    'id'        =>  $prefix . 'title_header_image',
                    'type'      =>  'media', 
                    'title'     =>  __('Title Header Background Image', 'redux-framework-demo'),
                    'subtitle'  =>  __('Upload your image.', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'image' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_image_position',
                    'type'      =>  'select',
                    'title'     =>  __('Title Header Image Position', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your background image position.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'left_top'      =>  __( 'Left Top', 'redux-framework-demo' ),
                        'left_center'   =>  __( 'Left Center', 'redux-framework-demo' ),
                        'left_bottom'   =>  __( 'Left Bottom', 'redux-framework-demo' ),
                        'center_top'    =>  __( 'Center Top', 'redux-framework-demo' ),
                        'center_center' =>  __( 'Center Center', 'redux-framework-demo' ),
                        'center_bottom' =>  __( 'Center Bottom', 'redux-framework-demo' ),
                        'right_top'     =>  __( 'Right Top', 'redux-framework-demo' ),
                        'right_center'  =>  __( 'Right Center', 'redux-framework-demo' ),
                        'right_bottom'  =>  __( 'Right Bottom', 'redux-framework-demo' ),
                    ),
                    'default'   =>  'center_center',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'image' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_image_repeat',
                    'type'      =>  'select',
                    'title'     =>  __('Title Header Image Repeat', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your background image repeat.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'no_repeat' =>  __( 'No Repeat', 'redux-framework-demo' ),
                        'repeat'    =>  __( 'Repeat', 'redux-framework-demo' ),
                        'repeat_x'  =>  __( 'Repeat Horizontally', 'redux-framework-demo' ),
                        'repeat_y'  =>  __( 'Repeat Vertically', 'redux-framework-demo' ),
                        'stretch'   =>  __( 'Stretch to fit', 'redux-framework-demo' ),
                    ),
                    'default'   =>  'stretch',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'image' ),
                ),

                // Title Header Module: Image Parallax
                array(
                    'id'        =>  $prefix .'title_header_image_parallax',
                    'type'      =>  'media', 
                    'title'     =>  __('Title Header Background Image Parallax', 'redux-framework-demo'),
                    'subtitle'  =>  __('Upload your image.', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'image_parallax' ),
                ),

                // Pattern & Background Color Mask Overlay
                array(
                    'id'        =>  $prefix . 'title_header_mask_mode',
                    'type'      =>  'select',
                    'title'     =>  __('Title Header Mask', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your favorite Title Header Mask Mode.<br><br><em>Not work with Revolution Slider</em>', 'redux-framework-demo'),
                    'options'   =>  array(
                        'none'                  =>  __( 'None', 'redux-framework-demo' ),
                        'mask_color'            =>  __( 'Mask Color', 'redux-framework-demo' ),
                        'mask_pattern'          =>  __( 'Mask Pattern', 'redux-framework-demo' ),
                        'mask_pattern_color'    =>  __( 'Mask Color and Pattern', 'redux-framework-demo' ),
                    ),
                    'default'   =>  'none',
                    'required'  => array(
                        array( $prefix . 'title_header_module', '!=', 'normal' ),
                        array( $prefix . 'title_header_module', '!=', 'animate' ),
                    ),
                ),
                
                // Pattern
                array(
                    'id'        =>  $prefix . 'title_header_mask_pattern',
                    'type'      =>  'media', 
                    'title'     =>  __('Pattern Mask', 'redux-framework-demo'),
                    'subtitle'  =>  __('Optional. Upload your pattern image.', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  => array(
                        array( $prefix . 'title_header_mask_mode', '!=', 'none' ),
                        array( $prefix . 'title_header_mask_mode', '!=', 'mask_color' ),
                    ),
                ),

                array(
                    'id'            =>  $prefix . 'title_header_mask_pattern_opacity',
                    'type'          =>  'slider', 
                    'title'         =>  __('Pattern Mask Opacity', 'redux-framework-demo'),
                    'subtitle'      =>  __('Optional. Choose opacity value for your pattern image.', 'redux-framework-demo'),
                    'default'       =>  1,
                    'min'           =>  0,
                    'step'          =>  .01,
                    'max'           =>  1,
                    'resolution'    =>  0.01,
                    'display_value' => 'text',
                    'required'  => array(
                        array( $prefix . 'title_header_mask_mode', '!=', 'none' ),
                        array( $prefix . 'title_header_mask_mode', '!=', 'mask_color' ),
                    ),
                ),

                // Color
                array(
                    'id'            =>  $prefix . 'title_header_mask_background',
                    'type'          =>  'color_rgba',  
                    'title'         =>  __( 'Color Mask', 'redux-framework-demo' ), 
                    'subtitle'      =>  __( 'Optional. Select your custom hex color with opacity.', 'redux-framework-demo' ),
                    'default'       =>  array( 'color' => '#000000', 'alpha' => '0.55' ),
                    'validate'      =>  'colorrgba',
                    'transparent'   =>  false,
                    'required'  => array(
                        array( $prefix . 'title_header_mask_mode', '!=', 'none' ),
                        array( $prefix . 'title_header_mask_mode', '!=', 'mask_pattern' ),
                    ),
                ),

                // Title Header Module: Animated Pattern Background
                array(
                    'id'            =>  $prefix . 'animated_pattern_background_color',
                    'type'          =>  'color',
                    'title'         =>  __( 'Pattern Background Color', 'redux-framework-demo' ),
                    'subtitle'      =>  __( 'Optional. Choose a background color for your title header section is your pattern background image is a transparent png.', 'redux-framework-demo' ),
                    'output'        =>  false,
                    'validate'      =>  false,
                    'transparent'   =>  false,
                    'default'       =>  '',
                    'required'      =>  array( $prefix . 'title_header_module', '=', 'animate' ),
                ),

                array(
                    'id'        =>  $prefix . 'animated_pattern_background_image',
                    'type'      =>  'media', 
                    'title'     =>  __('Pattern Background Image', 'redux-framework-demo'),
                    'subtitle'  =>  __('Upload a pattern background Png image.', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'animate' ),
                ),

                array(
                    'id'        =>  $prefix . 'animated_pattern_animation_moveset',
                    'type'      =>  'select',
                    'title'     =>  __('Pattern Animation Moveset', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your favorite moveset.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'topbottom'  =>  __( 'Top to Bottom', 'redux-framework-demo' ),
                        'bottomtop'  =>  __( 'Bottom to Top', 'redux-framework-demo' ),
                        'leftright'  =>  __( 'Left to Right', 'redux-framework-demo' ),
                        'rightleft'  =>  __( 'Right to Left', 'redux-framework-demo' ),
                    ),
                    'default'   =>  'bottomtop',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'animate' ),
                ),

                array(
                    'id'        =>  $prefix . 'animated_pattern_animation_duration',
                    'type'      =>  'text',
                    'title'     =>  __( 'Pattern Duration Animation', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Enter your custom duration of animation. Default is 20 seconds.<br><br><em>Enter only a number value.</em>', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'animate' ),
                ),

                // Title Header Module: Video
                array(
                    'id'        =>  $prefix . 'title_header_video_mode',
                    'type'      =>  'select',
                    'title'     =>  __('Video Mode', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your video mode.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'vimeo_embed_code'  =>  __( 'Vimeo', 'redux-framework-demo' ),
                        'youtube_url'       =>  __( 'Youtube', 'redux-framework-demo'),
                        'self_hosted'       =>  __( 'Self Hosted Video', 'redux-framework-demo' ),
                    ),
                    'default'   =>  'self_hosted',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'video' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_mobile_settings',
                    'type'      =>  'button_set',
                    'title'     =>  __('Video Mobile Settings', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Choose the option for video on mobile/tablets.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'lightbox'  =>  'Pop-up',
                        ''          =>  'New Window',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'video' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_image',
                    'type'      =>  'media', 
                    'title'     =>  __('Mobile Background Image Fallback', 'redux-framework-demo'),
                    'subtitle'  =>  __('Required. Upload your image for mobile and tablet devices.', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'video' ),
                ),

                // Self-Hosted Video
                array(
                    'id'        =>  $prefix . 'title_header_video_self_image',
                    'type'      =>  'media', 
                    'title'     =>  __('Self-Hosted Background Image Fallback', 'redux-framework-demo'),
                    'subtitle'  =>  __('Optional. Upload your image.', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'self_hosted' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_volume',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'Mute Video', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Mute the audio.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        ''      =>  'Yes',
                        'off'   =>  'No',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'self_hosted' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_autoplay',
                    'type'      =>  'button_set',
                    'title'     =>  __('Video Autoplay', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Autoplay the video.', 'redux-framework-demo'),
                    'options'   =>  array(
                        ''      =>  'Yes',
                        'off'   =>  'No',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'self_hosted' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_loop',
                    'type'      =>  'button_set',
                    'title'     =>  __('Video Loop', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Loop the video.', 'redux-framework-demo'),
                    'options'   =>  array(
                        ''      =>  'Yes',
                        'off'   =>  'No',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'self_hosted' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_webm',
                    'type'      =>  'media', 
                    'preview'   =>  false,
                    'mode'      =>  false,
                    'title'     =>  __('WEBM File', 'redux-framework-demo'),
                    'subtitle'  =>  __('Required. Upload a WEBM video file.<br><br><em>You must include both formats.</em>', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'self_hosted' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_mp4',
                    'type'      =>  'media', 
                    'preview'   =>  false,
                    'mode'      =>  false,
                    'title'     =>  __('MP4 File', 'redux-framework-demo'),
                    'subtitle'  =>  __('Required. Upload a MP4 video file.<br><br><em>You must include both formats.</em>', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'self_hosted' ),
                ),

                // Youtube URL
                array(
                    'id'        =>  $prefix . 'title_header_video_youtube_image',
                    'type'      =>  'media', 
                    'title'     =>  __('Youtube Background Image Fallback', 'redux-framework-demo'),
                    'subtitle'  =>  __('Optional. Upload your image.', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'youtube_url' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_youtube_url',
                    'type'      =>  'text',
                    'title'     =>  __( 'Youtube Video ID', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Required. Enter only ID video from Youtube.<br><br><em>Example: 3XviR7esUvo</em>', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'youtube_url' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_youtube_volume',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'Mute Video', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Mute the audio.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        ''      =>  'Yes',
                        'off'   =>  'No',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'youtube_url' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_youtube_autoplay',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'Autoplay Video', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Autoplay the video.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        ''      =>  'Yes',
                        'off'   =>  'No',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'youtube_url' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_youtube_loop',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'Loop Video', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Loop the video.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        ''      =>  'Yes',
                        'off'   =>  'No',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'youtube_url' ),
                ),

                // Vimeo Embed Code
                array(
                    'id'        =>  $prefix . 'title_header_video_vimeo_id',
                    'type'      =>  'text',
                    'title'     =>  __( 'Vimeo Video ID', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Required. Enter only ID video from Vimeo.<br><br><em>Example: 116214074</em>', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'vimeo_embed_code' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_vimeo_volume',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'Mute Video', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Mute the audio.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        ''      =>  'Yes',
                        'off'   =>  'No',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'vimeo_embed_code' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_vimeo_autoplay',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'Autoplay Video', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Autoplay the video.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        ''      =>  'Yes',
                        'off'   =>  'No',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'vimeo_embed_code' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_video_vimeo_loop',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'Loop Video', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Loop the video.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        ''      =>  'Yes',
                        'off'   =>  'No',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_video_mode', '=', 'vimeo_embed_code' ),
                ),

                // Title Header Module: Slider
                array(
                    'id'        =>  $prefix . 'title_header_slider_mode',
                    'type'      =>  'select',
                    'title'     =>  __('Slider Mode', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your slider mode.<br><br><em>For use Revolution Slider you need install and activate the plugin.</em>', 'redux-framework-demo'),
                    'options'   =>  array(
                        'az_slider'  =>  __( 'AZ Slider', 'redux-framework-demo' ),
                        'rev_slider' =>  __( 'Revolution Slider', 'redux-framework-demo'),
                    ),
                    'default'   =>  'az_slider',
                    'required'  =>  array( $prefix . 'title_header_module', '=', 'slider' ),
                ),

                // AZ Slider Settings
                array(
                    'id'        =>  $prefix . 'title_header_az_slider_text_format',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'AZ Slider Text and Caption Size Format', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Select your size/design for slider text.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        'normal_format'  =>  'Normal',
                        'big_format'     =>  'Big',
                    ),
                    'default'   =>  'normal_format',
                    'required'  =>  array( $prefix . 'title_header_slider_mode', '=', 'az_slider' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_az_slider_animation_type',
                    'type'      =>  'select',
                    'title'     =>  __('AZ Slider Animation', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your animation type.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'fade'  =>  __( 'Fade', 'redux-framework-demo' ),
                        'slide' =>  __( 'Slide', 'redux-framework-demo'),
                    ),
                    'default'   =>  'slide',
                    'required'  =>  array( $prefix . 'title_header_slider_mode', '=', 'az_slider' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_az_slider_autoplay',
                    'type'      =>  'button_set',
                    'title'     =>  __('AZ Slider Autoplay', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Choose if your slider start automatically.', 'redux-framework-demo'),
                    'options'   =>  array(
                        ''    =>  __( 'On', 'redux-framework-demo' ),
                        'off' =>  __( 'Off', 'redux-framework-demo'),
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_slider_mode', '=', 'az_slider' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_az_slider_loop',
                    'type'      =>  'button_set',
                    'title'     =>  __('AZ Slider Loop', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Choose if your slider have a loop.', 'redux-framework-demo'),
                    'options'   =>  array(
                        ''      =>  __( 'On', 'redux-framework-demo' ),
                        'off'   =>  __( 'Off', 'redux-framework-demo'),
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_az_slider_autoplay', '=', '' ),
                ),

                array(
                    'id'        => $prefix . 'title_header_az_slider_slide_speed',
                    'type'      => 'text',
                    'title'     => __( 'AZ Slider Slide Speed', 'redux-framework-demo' ),
                    'subtitle'  => __( 'Set the speed of animations of slide, in milliseconds. Default is 600.<br><br><em>Enter only a number value.</em>', 'redux-framework-demo' ),
                    'default'   => '600',
                    'required'  =>  array( $prefix . 'title_header_slider_mode', '=', 'az_slider' ),
                ),

                array(
                    'id'        => $prefix . 'title_header_az_slider_slideshow_speed',
                    'type'      => 'text',
                    'title'     => __( 'AZ Slider SlideShow Speed', 'redux-framework-demo' ),
                    'subtitle'  => __( 'Set the speed of the slideshow cycling, in milliseconds. Default is 7000.<br><br><em>Required Autoplay Enabled.<br>Enter only a number value.</em>', 'redux-framework-demo' ),
                    'default'   => '7000',
                    'required'  =>  array( $prefix . 'title_header_slider_mode', '=', 'az_slider' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_az_slider_parallax',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'Parallax', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Parallax slide to scroll.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        ''      =>  'On',
                        'off'   =>  'Off',
                    ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_slider_mode', '=', 'az_slider' ),
                ),

                array(
                    'id'          =>  $prefix . 'title_header_az_slider_alias',
                    'type'        =>  'slides',
                    'title'       =>  __( 'Slides Options', 'redux-framework-demo' ),
                    'subtitle'    =>  __( 'Unlimited slides with drag and drop sortings.', 'redux-framework-demo' ),
                    'desc'        =>  '',
                    'placeholder' =>  array(
                        'title'       => __( 'Optional. Insert a title.', 'redux-framework-demo' ),
                        'description' => __( 'Optional. Insert a caption.', 'redux-framework-demo' ),
                        'url'         => __( 'Optional. Insert a link. Only URL.', 'redux-framework-demo' ),
                    ),
                    'required'  =>  array( $prefix . 'title_header_slider_mode', '=', 'az_slider' ),
                ),

                // Revolution Slider
                array(
                    'id'        =>  $prefix . 'title_header_revolution_slider_alias',
                    'type'      =>  'select',
                    'title'     =>  __('Revolution Slider Alias', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your Revolution Slider Alias.', 'redux-framework-demo'),
                    'options'   =>  $revsliders,
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_slider_mode', '=', 'rev_slider' ),
                ),

                // Title Header Text
                array(
                    'id'        =>  $prefix . 'title_header_text_display',
                    'type'      =>  'button_set',
                    'title'     =>  __('Title Header Text', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Enable or Disable the Title Header Text.<br><br><em>Not visible with Slider Mode.</em>', 'redux-framework-demo'),
                    'options'   =>  array(
                        'show'  =>  'Show',
                        'hide'  =>  'Hide',
                    ),
                    'default'   =>  $options_alice['global_title_header_text_visibility'],
                    'required'  =>  array( $prefix . 'title_header_display', '!=', 'hide' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_text_format',
                    'type'      =>  'button_set',
                    'title'     =>  __( 'Heading & Subheading Size Format', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Select your size/design for title header text.', 'redux-framework-demo' ),
                    'options'   =>  array(
                        'normal_format'  =>  'Normal',
                        'big_format'     =>  'Big',
                    ),
                    'default'   =>  'normal_format',
                    'required'  =>  array( $prefix . 'title_header_text_display', '!=', 'hide' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_text_heading',
                    'type'      =>  'text',
                    'title'     =>  __( 'Heading', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Enter your custom heading.<br>Default is page/post title.', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_text_display', '!=', 'hide' ),
                ),

                array(
                    'id'        =>  $prefix . 'title_header_text_subheading',
                    'type'      =>  'textarea',
                    'title'     =>  __( 'Subheading', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Enter your page subheading.', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'title_header_text_display', '!=', 'hide' ),
                ),

                array(
                    'id'            =>  $prefix . 'title_header_text_color',
                    'type'          =>  'color',
                    'title'         =>  __( 'Title Header Text Color', 'redux-framework-demo' ),
                    'subtitle'      =>  __( 'Optional. Choose a text color for your heading and subheading.', 'redux-framework-demo' ),
                    'output'        =>  false,
                    'validate'      =>  false,
                    'transparent'   =>  false,
                    'default'       =>  $options_alice['global_title_header_text_color'],
                    'required'      =>  array( $prefix . 'title_header_text_display', '!=', 'hide' ),
                ),

            ),
        );
        
        // Set Main settings array for all post types
        $page_settings = $post_settings = $team_settings = $portfolio_settings = $main_settings;


        /*-----------------------------------------------------------------------------------*/
        /*  - For Team Only
        /*-----------------------------------------------------------------------------------*/
        $team_settings[] = array(
            'title' => __( 'Team', 'redux-framework-demo' ),
            'icon'  => 'el-icon-cog'
        );

        $team_settings[] = array(
            'title'      => __( 'Creative Module', 'redux-framework-demo' ),
            'icon'       => 'font-icon-arrow-right-simple-thin-round',
            'subsection' =>  true,
            'fields'     => array(

                array(
                    'id'        =>  $prefix . 'team_single_creative_image',
                    'type'      =>  'media', 
                    'title'     =>  __('Single Team Creative Mode: Image', 'redux-framework-demo'),
                    'subtitle'  =>  __('Required. Upload an image.<br><br><strong>This is available only for Team Creative Module.</strong></br>', 'redux-framework-demo'),
                    'default'   =>  '',
                ),

                array(
                    'id'        =>  $prefix . 'team_single_creative_output_text',
                    'type'      =>  'editor',
                    'title'     =>  __('Single Team Creative Mode: Description', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Required. Enter a description.<br><br><strong>This is available only for Team Creative Module.</strong></br>', 'redux-framework-demo'),
                    'default'   =>  '',
                    'args'   => array(
                        'teeny'     => false,
                        'wpautop'   => false
                    )
                ),

            ),
        );
        
        if( $options_alice['back_to_team'] == 1 && $options_alice['back_to_team_mode'] == "custom" ) {

            $team_settings[] = array(
                'title'      => __( 'Back to URL', 'redux-framework-demo' ),
                'icon'       => 'font-icon-arrow-right-simple-thin-round',
                'subsection' =>  true,
                'fields'     => array(

                    array(
                        'id'        =>  $prefix . 'back_team_url_custom',
                        'type'      =>  'select',
                        'data'      =>  'pages',
                        'title'     =>  __( 'Custom Back to Team Page', 'redux-framework-demo' ),
                        'subtitle'  =>  __( 'Required. Select your custom main team page for back to team feature.', 'redux-framework-demo' ),
                        'default'   =>  '',
                    ),

                ),
            );

        }

        /*-----------------------------------------------------------------------------------*/
        /*  - For Portfolio Only
        /*-----------------------------------------------------------------------------------*/
        $portfolio_settings[] = array(
            'title' => __( 'Portfolio', 'redux-framework-demo' ),
            'icon'  => 'el-icon-cog'
        );

        $portfolio_settings[] = array(
            'title'      => __( 'Creative Module', 'redux-framework-demo' ),
            'icon'       => 'font-icon-arrow-right-simple-thin-round',
            'subsection' =>  true,
            'fields'     => array(

                array(
                    'id'        =>  $prefix . 'portfolio_single_creative_image',
                    'type'      =>  'media', 
                    'title'     =>  __('Single Portfolio Creative Mode: Image', 'redux-framework-demo'),
                    'subtitle'  =>  __('Required. Upload an image.<br><br><strong>This is available only for Portfolio Creative Module.</strong></br>', 'redux-framework-demo'),
                    'default'   =>  '',
                ),

                array(
                    'id'        =>  $prefix . 'portfolio_single_creative_gallery_image',
                    'type'      =>  'gallery',
                    'title'     =>  __('Single Portfolio Creative Mode: Gallery', 'redux-framework-demo'),
                    'subtitle'  =>  __('Optional. Create a gallery images.<br><br><strong>This is available only for Portfolio Creative Module.</strong></br>', 'redux-framework-demo')
                ),

                array(
                    'id'        =>  $prefix . 'portfolio_single_creative_output_text',
                    'type'      =>  'editor',
                    'title'     =>  __('Single Portfolio Creative Mode: Description', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Required. Enter a description.<br><br><strong>This is available only for Portfolio Creative Module.</strong></br>', 'redux-framework-demo'),
                    'default'   =>  '',
                    'args'   => array(
                        'teeny'     => false,
                        'wpautop'   => false
                    )
                ),

            ),
        );

        $portfolio_settings[] = array(
            'title'      => __( 'Project Type', 'redux-framework-demo' ),
            'icon'       => 'font-icon-arrow-right-simple-thin-round',
            'subsection' => true,
            'fields'     => array(

                array(
                    'id'        =>  $prefix . 'portfolio_project_type',
                    'type'      =>  'select',
                    'title'     =>  __('Single Portfolio Project Type', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select your single portfolio project type.<br><br>
                                        <em><strong>Normal</strong>: Open the single portfolio post in its corresponding single page.</em><br><br>
                                        <em><strong>Fancybox</strong>: Open the single portfolio post with the fancybox pop-up for images or videos. This type is excluded from the navigation.</em><br><br>
                                        <em><strong>External URL</strong>: Open the single portfolio post indicated in the URL Field. This type is excluded from the navigation.</em><br><br>
                                        <strong>This is available only for Portfolio Classic Module.</strong>', 'redux-framework-demo'),
                    'options'   =>  array(
                        'normal_type'   =>  __( 'Normal', 'redux-framework-demo' ),
                        'fancybox_type' =>  __( 'Fancybox', 'redux-framework-demo' ),
                        'external_type' =>  __( 'External URL', 'redux-framework-demo' ),
                    ),
                    'default'   =>  ''
                ),

                // Fancy Image
                array(
                    'id'        =>  $prefix . 'portfolio_fancybox_mode',
                    'type'      =>  'button_set',
                    'title'     =>  __('Fancybox Mode', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Select if you want a fancybox with image/images or video/videos pop-up.', 'redux-framework-demo'),
                    'options'   =>  array(
                        'image_mod' =>  'Image',
                        'video_mod' =>  'Video',
                    ),
                    'default'   =>  'image_mod',
                    'required'  =>  array( $prefix . 'portfolio_project_type', '=', 'fancybox_type' ),
                ),

                array(
                    'id'        =>  $prefix . 'portfolio_fancybox_image_diff',
                    'type'      =>  'media', 
                    'title'     =>  __('Fancy Image', 'redux-framework-demo'),
                    'subtitle'  =>  __('Optional. Upload an image if you want display another image instead the default featured image.<br><br><em>If you want a caption set/write the Caption Field field when select the image.</em>', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'portfolio_fancybox_mode', '=', 'image_mod' ),
                ),

                array(
                    'id'        =>  $prefix . 'portfolio_fancybox_gallery_image',
                    'type'      =>  'gallery',
                    'title'     =>  __('Fancy Gallery Images', 'redux-framework-demo'),
                    'subtitle'  =>  __('Optional. Create a gallery images.<br><br><em>If you want a caption set/write the Caption Field when select the image.</em>', 'redux-framework-demo'),
                    'required'  =>  array( $prefix . 'portfolio_fancybox_mode', '=', 'image_mod' ),
                ),

                array(
                    'id'        =>  $prefix . 'portfolio_fancybox_gallery_name',
                    'type'      =>  'text',
                    'title'     =>  __( 'Fancy Image Gallery Name', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Optional. Enter a gallery name if you want use Fancy Gallery Images or you want a gallery between other portfolio fancybox type posts.', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'portfolio_fancybox_mode', '=', 'image_mod' ),
                ),
                
                // Fancy Video
                array(
                    'id'        =>  $prefix . 'portfolio_fancybox_video_url',
                    'type'      =>  'text',
                    'title'     =>  __('Fancy Video URL', 'redux-framework-demo'),
                    'subtitle'  =>  __('Required. Enter video url.<br><br><em>Only Youtube and Vimeo Support.</em>', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'portfolio_fancybox_mode', '=', 'video_mod'),
                ),

                array(
                    'id'        =>  $prefix . 'portfolio_fancybox_video_caption',
                    'type'      =>  'text',
                    'title'     =>  __('Fancy Video Caption', 'redux-framework-demo'),
                    'subtitle'  =>  __('Optional. Insert a caption text.', 'redux-framework-demo'),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'portfolio_fancybox_mode', '=', 'video_mod'),
                ),

                array(
                    'id'          =>  $prefix . 'portfolio_fancybox_gallery_video',
                    'type'        =>  'slides',
                    'title'       =>  __( 'Fancy Gallery Videos', 'redux-framework-demo' ),
                    'subtitle'    =>  __( 'Optional. Create a gallery videos.', 'redux-framework-demo' ),
                    'desc'        =>  '',
                    'placeholder' =>  array(
                        'title'       => __( 'Optional. Identify the video here.', 'redux-framework-demo' ),
                        'url'         => __( 'Required. Insert a link. Only URL.', 'redux-framework-demo' ),
                        'description' => __( 'Optional. Insert a caption.', 'redux-framework-demo' ),
                    ),
                    'required'  =>  array( $prefix . 'portfolio_fancybox_mode', '=', 'video_mod' ),
                ),

                array(
                    'id'        =>  $prefix . 'portfolio_fancybox_video_gallery_name',
                    'type'      =>  'text',
                    'title'     =>  __( 'Fancy Video Gallery Name', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Optional. Enter a gallery name if you want use Fancy Gallery Videos or you want a gallery between other portfolio fancybox type posts.', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'portfolio_fancybox_mode', '=', 'video_mod' ),
                ),

                // External URL
                array(
                    'id'        =>  $prefix . 'portfolio_external_url',
                    'type'      =>  'text',
                    'title'     =>  __( 'External URL', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Required. Enter your custom link location (remember to include "http://").', 'redux-framework-demo' ),
                    'default'   =>  '',
                    'required'  =>  array( $prefix . 'portfolio_project_type', '=', 'external_type' ),
                ),

                array(
                    'id'        =>  $prefix . 'portfolio_external_url_target',
                    'type'      =>  'button_set',
                    'title'     =>  __('Target URL', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Specifies where to open the linked document.', 'redux-framework-demo'),
                    'options'   =>  array(
                        '_self'  =>  'Same Window',
                        '_blank' =>  'New Window',
                    ),
                    'default'   =>  '_self',
                    'required'  =>  array( $prefix . 'portfolio_project_type', '=', 'external_type' ),
                ),

            ),
        );

        $portfolio_settings[] = array(
            'title'      => __( 'Colorize FX', 'redux-framework-demo' ),
            'icon'       => 'font-icon-arrow-right-simple-thin-round',
            'subsection' =>  true,
            'fields'     => array(

                array(
                    'id'        =>  $prefix . 'colorize_project_fx',
                    'type'      =>  'color_rgba',
                    'title'     =>  __( 'Colorize Effect', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Required. Select your custom color hover effect.<br><br><strong>This is available only for Portfolio Colorize Effect option active.</strong></br>', 'redux-framework-demo' ),
                    'default'       =>  array( 'color' => '#000000', 'alpha' => '0.01' ),
                    'validate'      =>  'colorrgba',
                    'transparent'   =>  false
                ),

            ),
        );

        if( $options_alice['back_to_portfolio'] == 1 && $options_alice['back_to_portfolio_mode'] == "custom" ) {

            $portfolio_settings[] = array(
                'title'      => __( 'Back to URL', 'redux-framework-demo' ),
                'icon'       => 'font-icon-arrow-right-simple-thin-round',
                'subsection' =>  true,
                'fields'     => array(

                    array(
                        'id'        =>  $prefix . 'back_portfolio_url_custom',
                        'type'      =>  'select',
                        'data'      =>  'pages',
                        'title'     =>  __( 'Custom Back to Portfolio Page', 'redux-framework-demo' ),
                        'subtitle'  =>  __( 'Required. Select your custom main portfolio page for back to team feature.', 'redux-framework-demo' ),
                        'default'   =>  '',
                    ),

                ),
            );

        }

        /*-----------------------------------------------------------------------------------*/
        /*  - Clients
        /*-----------------------------------------------------------------------------------*/
        $client_settings[] = array(
            'title'     => __( 'Optional Info', 'redux-framework-demo' ),
            'icon'      => 'el-icon-cog',
            'fields'    => array(

                array(
                    'id'            =>  $prefix . 'client_background',
                    'type'          =>  'color',
                    'title'         =>  __( 'Background Color', 'redux-framework-demo' ),
                    'subtitle'      =>  __( 'Optional. Choose a background color for your client logo.', 'redux-framework-demo' ),
                    'output'        =>  false,
                    'validate'      =>  false,
                    'transparent'   =>  false,
                    'default'       =>  ''
                ),

                array(
                    'id'        =>  $prefix . 'client_url',
                    'type'      =>  'text',
                    'title'     =>  __( 'Client URL', 'redux-framework-demo' ),
                    'subtitle'  =>  __( 'Optional. Enter the link here. (remember to include "http://").', 'redux-framework-demo' ),
                    'default'   =>  ''
                ),

                array(
                    'id'        =>  $prefix . 'client_url_target',
                    'type'      =>  'button_set',
                    'title'     =>  __('Target URL', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Specifies where to open the linked document.', 'redux-framework-demo'),
                    'options'   =>  array(
                        '_self'  =>  'Same Window',
                        '_blank' =>  'New Window',
                    ),
                    'default'   =>  '_self'
                ),

            ),
        );

        /*-----------------------------------------------------------------------------------*/
        /*  - Testimonial
        /*-----------------------------------------------------------------------------------*/
        $testimonial_settings[] = array(
            'title'     => __( 'Testimonial Info', 'redux-framework-demo' ),
            'icon'      => 'el-icon-cog',
            'fields'    => array(

                array(
                    'id'          =>  $prefix . 'testimonial_caption',
                    'type'        =>  'text',
                    'title'       =>  __( 'Testimonial Caption', 'redux-framework-demo' ),
                    'subtitle'    =>  __( 'Optional. Enter the caption text here.', 'redux-framework-demo' ),
                    'description' =>  __( 'Example: Co-founder of Company', 'redux-framework-demo'),
                    'default'     =>  ''
                ),

                array(
                    'id'        =>  $prefix . 'testimonial_quote',
                    'type'      =>  'editor',
                    'title'     =>  __('Testimonial Quote', 'redux-framework-demo'), 
                    'subtitle'  =>  __('Required. Enter a quote text.', 'redux-framework-demo'),
                    'default'   =>  '',
                    'args'   => array(
                        'teeny'     => false,
                        'wpautop'       => true,
                        'media_buttons' => false
                    )
                ),

            ),
        );

        /*-----------------------------------------------------------------------------------*/
        /*  - Define Metaboxes
        /*-----------------------------------------------------------------------------------*/
        
        // Pages
        $metaboxes[] = array(
            'id'            => 'az-page-metaboxes',
            'title'         => __( 'Page Settings', 'redux-framework-demo' ),
            'post_types'    => array( 'page' ),
            'position'      => 'normal',
            'priority'      => 'high',
            'sidebar'       => true,
            'sections'      => $page_settings
        );

        // Posts
        $metaboxes[] = array(
            'id'            => 'az-post-metaboxes',
            'title'         => __( 'Post Settings', 'redux-framework-demo' ),
            'post_types'    => array( 'post' ),
            'position'      => 'normal',
            'priority'      => 'high',
            'sidebar'       => true,
            'sections'      => $post_settings
        );

        // Team
        $metaboxes[] = array(
            'id'            => 'az-post-metaboxes',
            'title'         => __( 'Team Settings', 'redux-framework-demo' ),
            'post_types'    => array( 'team' ),
            'position'      => 'normal',
            'priority'      => 'high',
            'sidebar'       => true,
            'sections'      => $team_settings
        );

        // Portfolio
        $metaboxes[] = array(
            'id'            => 'az-post-metaboxes',
            'title'         => __( 'Portfolio Settings', 'redux-framework-demo' ),
            'post_types'    => array( 'portfolio' ),
            'position'      => 'normal',
            'priority'      => 'high',
            'sidebar'       => true,
            'sections'      => $portfolio_settings
        );

        // Client
        $metaboxes[] = array(
            'id'            => 'az-post-metaboxes',
            'title'         => __( 'Client Settings', 'redux-framework-demo' ),
            'post_types'    => array( 'client' ),
            'position'      => 'normal',
            'priority'      => 'high',
            'sidebar'       => true,
            'sections'      => $client_settings
        );

        // Testimonial
        $metaboxes[] = array(
            'id'            => 'az-post-metaboxes',
            'title'         => __( 'Testimonial Settings', 'redux-framework-demo' ),
            'post_types'    => array( 'testimonial' ),
            'position'      => 'normal',
            'priority'      => 'high',
            'sidebar'       => true,
            'sections'      => $testimonial_settings
        );


    return $metaboxes;
  }
  add_action('redux/metaboxes/alice/boxes', 'redux_add_metaboxes');
endif;

// The loader will load all of the extensions automatically based on your $redux_opt_name
require_once(dirname(__FILE__).'/loader.php');