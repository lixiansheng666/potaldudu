<?php

/*
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**
         * This is a test function that will let you see when the compiler hook occurs.
         * It only runs if a field    set with compiler=>true is changed.
         * */
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
             */
        }

        /**
         * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         * Simply include this function in the child themes functions.php file.
         * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         * so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults($defaults) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }

        public function setSections() {

            /**
             * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns      = array();

            if ( is_dir( $sample_patterns_path ) ) :

                if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                    $sample_patterns = array();

                    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                        if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                            $name              = explode( '.', $sample_patterns_file );
                            $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                            $sample_patterns[] = array(
                                'alt' => $name,
                                'img' => $sample_patterns_url . $sample_patterns_file
                            );
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct          = wp_get_theme();
            $this->theme = $ct;
            $item_name   = $this->theme->get( 'Name' );
            $tags        = $this->theme->Tags;
            $screenshot  = $this->theme->get_screenshot();
            $class       = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'redux-framework-demo' ), $this->theme->display( 'Name' ) );

            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                Redux_Functions::initWpFilesystem();
                
                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS

            /*-----------------------------------------------------------------------------------*/
            /*  - General
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'      =>  __('General', 'redux-framework-demo'),
                'desc'       =>  __('Welcome to the Alice Options Panel! Control and configure the general setup of your theme.', 'redux-framework-demo'),
                'icon'       =>  'font-icon-house',
                'customizer' =>  false,  
                'fields'     =>  array(
                    // Custom Admin Logo + Custom Favicon + Custom iOS Icons
                    array(
                        'id'        =>  'custom_admin_logo',
                        'type'      =>  'media', 
                        'title'     =>  __('Custom Admin Login Logo', 'redux-framework-demo'),
                        'subtitle'  =>  __('Upload 260 x 98px image here to replace the admin login logo', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),

                    array(
                        'id'        =>  'favicon',
                        'type'      =>  'media', 
                        'title'     =>  __('Favicon Upload', 'redux-framework-demo'),
                        'subtitle'  =>  __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),

                    array(
                        'id'        =>  'custom_ios_bookmark_title',
                        'type'      =>  'text', 
                        'title'     =>  __('Custom iOS Bookmark Title', 'redux-framework-demo'),
                        'subtitle'  =>  __('Enter a custom title for your site for when it is added as an iOS bookmark.', 'redux-framework-demo'),
                        'default'   =>  ''
                    ),

                    array(
                        'id'        =>  'custom_ios_57',
                        'type'      =>  'media', 
                        'title'     =>  __('Custom iOS 57x57', 'redux-framework-demo'),
                        'subtitle'  =>  __('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),

                    array(
                        'id'        =>  'custom_ios_72',
                        'type'      =>  'media', 
                        'title'     =>  __('Custom iOS 72x72', 'redux-framework-demo'),
                        'subtitle'  =>  __('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),

                    array(
                        'id'        =>  'custom_ios_114',
                        'type'      =>  'media', 
                        'title'     =>  __('Custom iOS 114x114', 'redux-framework-demo'),
                        'subtitle'  =>  __('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),

                    array(
                        'id'        =>  'custom_ios_144',
                        'type'      =>  'media', 
                        'title'     =>  __('Custom iOS 144x144', 'redux-framework-demo'),
                        'subtitle'  =>  __('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),

                )
            );

                // Preloader
                $this->sections[] = array(
                    'title'         =>  __('Preloader', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false, 
                    'fields'        =>  array(
                        
                        // Preloader
                        array(
                            'id'        =>  'preloader_settings',
                            'type'      =>  'switch',
                            'title'     =>  __('Preloader Page/Post', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable/Disable preloader page/post for your site.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  0
                        ),

                        array(
                            'id'        =>  'global_preloader_visibility',
                            'type'      =>  'button_set',
                            'required'  =>  array('preloader_settings','=','1'), 
                            'title'     =>  __('Global Preloader Setting', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable or Disable the Preloader.<br/><br/><em>If you want can modify in each page/post the setting about the preloader.</em>', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'show'  =>  'Show',
                                'hide'  =>  'Hide',
                            ),
                            'default'   =>  'show',
                        ),

                        array(
                            'id'        =>  'preloader_design_mode',
                            'type'      =>  'button_set',
                            'required'  =>  array('preloader_settings','=','1'),
                            'title'     =>  __('Preloader Design', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your design for your preloader.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                '1'     =>  'Default',
                                '2'     =>  'Image'
                            ),
                            'default'   =>  '1'
                        ),

                        array(
                            'id'        =>  'preloader_media_image',
                            'type'      =>  'media', 
                            'required'  =>  array('preloader_design_mode','=','2'),
                            'title'     =>  __('Preloader Custom Image', 'redux-framework-demo'),
                            'subtitle'  =>  __('Upload a PNG or GIF image that will be used in all applicable areas on your site as the loading image.', 'redux-framework-demo'),
                            'desc'      =>  ''
                        ),

                    )
                );

                // Common
                $this->sections[] = array(
                    'title'         =>  __('Common Options', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false, 
                    'fields'        =>  array(
                        
                        // Animation on Mobile Devices
                        array(
                            'id'        =>  'enable_mobile_scroll_animation_effects',
                            'type'      =>  'switch',
                            'title'     =>  __('Scroll Animation Effects on Mobile/Tablet devices', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable/Disable scroll animation effects on mobile/tablet devices for items.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  0
                        ),

                        // Back to Top
                        array(
                            'id'        =>  'enable_back_to_top',
                            'type'      =>  'switch',
                            'title'     =>  __('Back to Top', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable/Disable Back to Top Feature.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  1
                        ),

                        // Comments Pages
                        array(
                            'id'        =>  'enable_comments_page',
                            'type'      =>  'switch',
                            'title'     =>  __('Comments Pages', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable/Disable for Pages only.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  1
                        ),

                        // Disable Right Click
                        array(
                            'id'        =>  'disable_right_click',
                            'type'      =>  'switch',
                            'title'     =>  __('Disable Right Click', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable/Disable Right Click Feature.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  0
                        ),

                    )
                );

                // Tracking Code
                $this->sections[] = array(
                    'title'         =>  __('Tracking Code', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false,
                    'fields'        =>  array(
                        
                        // Tracking Code
                        array(
                            'id'        =>  'tracking_code',
                            'type'      =>  'text',
                            'title'     =>  __('Tracking Code', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Paste your Google Analytics Property ID ( UA-XXXX-Y ).<br/><br/>This code will be added before the closing &lt;head&gt; tag.', 'redux-framework-demo'),
                            'desc'      =>  __('NOTE: This use a default analytics js code. If you want a specific requirements not use this but include the script manually.', 'redux-framework-demo')
                        ),

                    )
                );

                // Custom CSS/JS Options
                $this->sections[] = array(
                    'title'         =>  __('Custom CSS/JS', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false,
                    'fields'        =>  array(

                        // Enable Custom CSS
                        array(
                            'id'        =>  'enable_custom_css',
                            'type'      =>  'switch', 
                            'title'     =>  __('Custom CSS', 'redux-framework-demo'),
                            'subtitle'  =>  __('Do you want enable custom css?', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  0
                        ),

                        // Custom CSS
                        array(
                            'id'        =>  'custom_css',
                            'type'      =>  'ace_editor',
                            'required'  =>  array('enable_custom_css','=','1'),
                            'title'     =>  __('Custom CSS Code', 'redux-framework-demo'),
                            'subtitle'  =>  __('If you have any custom CSS you would like added to the site, please enter it here.<br/><br/>This code will be added before the closing &lt;head&gt; tag.', 'redux-framework-demo'),
                            'mode'      =>  'css',
                            'theme'     =>  'monokai',
                            'desc'      =>  ''
                        ),

                        // Enable Custom JS
                        array(
                            'id'        =>  'enable_custom_js',
                            'type'      =>  'switch', 
                            'title'     =>  __('Custom JS', 'redux-framework-demo'),
                            'subtitle'  =>  __('Do you want enable custom js?', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  0
                        ),

                        // Custom JS
                        array(
                            'id'        =>  'custom_js',
                            'type'      =>  'ace_editor',
                            'mode'      =>  'javascript',
                            'theme'     =>  'chrome',
                            'required'  =>  array('enable_custom_js','=','1'),
                            'title'     =>  __('Custom JS Code', 'redux-framework-demo'),
                            'subtitle'  =>  __('If you have any custom js you would like added to the site, please enter it here.<br/><br/>This code will be added before the closing &lt;body&gt; tag.', 'redux-framework-demo'),
                            'desc'      =>  __('NOTE: Write or Copy &amp; Paste only the javascript/jquery code without the &lt;script&gt; tag.', 'redux-framework-demo')
                        ),

                    )
                );

                // Performance
                $this->sections[] = array(
                    'title'         =>  __('Performance', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false, 
                    'fields'        =>  array(
                        
                        // Preloader
                        array(
                            'id'        =>  'performance_minified_settings',
                            'type'      =>  'switch',
                            'title'     =>  __('Load Minified File', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Load style.css and the main.js minfied version, the other files are already minified by default.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  0
                        ),

                    )
                );


            
            /*-----------------------------------------------------------------------------------*/
            /*  - Typography
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'      =>  __('Typography', 'redux-framework-demo'),
                'desc'       =>  __('Welcome to the Alice Options Panel! Control and configure the typography of your theme.', 'redux-framework-demo'),
                'icon'       =>  'font-icon-pencil',
                'customizer' =>  false,  
                'fields'     =>  array(
                    
                    // Enable Custom Fonts
                    array(
                        'id'        =>  'enable_custom_fonts',
                        'type'      =>  'switch', 
                        'title'     =>  __('Custom Fonts', 'redux-framework-demo'),
                        'subtitle'  =>  __('Do you want enable custom fonts?', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  0
                    ),

                    // Logo Text
                    array(
                        'id'            =>  'logo_text_typo',
                        'type'          =>  'typography',
                        'required'      =>  array('enable_custom_fonts','=','1'),
                        'title'         =>  __( 'Logo Text', 'redux-framework-demo' ),
                        'compiler'      =>  false, // Use if you want to hook in your own CSS compiler
                        'google'        =>  true,  // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   =>  false, // Select a backup non-google font in addition to a google font
                        'font-style'    =>  false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'font-weight'   =>  false,
                        'font-size'     =>  false,
                        'subsets'       =>  true,  // Only appears if google is true and subsets not set to false
                        'line-height'   =>  false,
                        'text-align'    =>  false,
                        'word-spacing'  =>  false,
                        'letter-spacing'=>  false,
                        'color'         =>  false,
                        'preview'       =>  true,  // Disable the previewer
                        'all_styles'    =>  true,  // Enable all Google Font style/weight variations to be added to the page
                        'units'         =>  'rem',
                        'subtitle'      =>  __( 'You can change the font of these elements: logo text type only.<br><br>( see the documentation for details )', 'redux-framework-demo' ),
                        
                        'default'  => array(
                            'font-family' =>  'Montserrat',
                            'google'      =>  true
                        ),
                    ),

                    // Body and Others
                    array(
                        'id'            =>  'general_body_common_text_typo',
                        'type'          =>  'typography',
                        'required'      =>  array('enable_custom_fonts','=','1'),
                        'title'         =>  __( 'Body and Others', 'redux-framework-demo' ),
                        'compiler'      =>  false, // Use if you want to hook in your own CSS compiler
                        'google'        =>  true,  // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   =>  false, // Select a backup non-google font in addition to a google font
                        'font-style'    =>  false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'font-weight'   =>  false,
                        'font-size'     =>  false,
                        'subsets'       =>  true,  // Only appears if google is true and subsets not set to false
                        'line-height'   =>  false,
                        'text-align'    =>  false,
                        'word-spacing'  =>  false,
                        'letter-spacing'=>  false,
                        'color'         =>  false,
                        'preview'       =>  true,  // Disable the previewer
                        'all_styles'    =>  true,  // Enable all Google Font style/weight variations to be added to the page
                        'units'         =>  'rem',
                        'subtitle'      =>  __( 'You can change the font of these elements: body and others elements.<br><br>( see the documentation for details )', 'redux-framework-demo' ),
                        
                        'default'  => array(
                            'font-family' =>  'Source Sans Pro',
                            'google'      =>  true
                        ),
                    ),

                    // Headings and Others
                    array(
                        'id'            =>  'general_heading_common_text_typo',
                        'type'          =>  'typography',
                        'required'      =>  array('enable_custom_fonts','=','1'),
                        'title'         =>  __( 'Headings and Others', 'redux-framework-demo' ),
                        'compiler'      =>  false, // Use if you want to hook in your own CSS compiler
                        'google'        =>  true,  // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   =>  false, // Select a backup non-google font in addition to a google font
                        'font-style'    =>  false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'font-weight'   =>  false,
                        'font-size'     =>  false,
                        'subsets'       =>  true,  // Only appears if google is true and subsets not set to false
                        'line-height'   =>  false,
                        'text-align'    =>  false,
                        'word-spacing'  =>  false,
                        'letter-spacing'=>  false,
                        'color'         =>  false,
                        'preview'       =>  true,  // Disable the previewer
                        'all_styles'    =>  true,  // Enable all Google Font style/weight variations to be added to the page
                        'units'         =>  'rem',
                        'subtitle'      =>  __( 'You can change the font of these elements: headings and others elements.<br><br>( see the documentation for details )', 'redux-framework-demo' ),
                        
                        'default'  => array(
                            'font-family' =>  'Montserrat',
                            'google'      =>  true
                        ),
                    ),

                    // Special and Others
                    array(
                        'id'            =>  'general_special_common_text_typo',
                        'type'          =>  'typography',
                        'required'      =>  array('enable_custom_fonts','=','1'),
                        'title'         =>  __( 'Special and Others', 'redux-framework-demo' ),
                        'compiler'      =>  false, // Use if you want to hook in your own CSS compiler
                        'google'        =>  true,  // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   =>  false, // Select a backup non-google font in addition to a google font
                        'font-style'    =>  false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'font-weight'   =>  false,
                        'font-size'     =>  false,
                        'subsets'       =>  true,  // Only appears if google is true and subsets not set to false
                        'line-height'   =>  false,
                        'text-align'    =>  false,
                        'word-spacing'  =>  false,
                        'letter-spacing'=>  false,
                        'color'         =>  false,
                        'preview'       =>  true,  // Disable the previewer
                        'all_styles'    =>  true,  // Enable all Google Font style/weight variations to be added to the page
                        'units'         =>  'rem',
                        'subtitle'      =>  __( 'You can change the font of these elements: Normal Title Header and others elements.<br><br>( see the documentation for details )', 'redux-framework-demo' ),
                        
                        'default'  => array(
                            'font-family' =>  'Crimson Text',
                            'google'      =>  true
                        ),
                    ),
                    

                )
            );

            /*-----------------------------------------------------------------------------------*/
            /*  - Colors
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'      =>  __('Colors', 'redux-framework-demo'),
                'desc'       =>  __('Welcome to the Alice Options Panel! Control and configure the colors setup of your theme.', 'redux-framework-demo'),
                'icon'       =>  'font-icon-brush',
                'customizer' =>  true,  
                'fields'     =>  array(

                    // Enable Custom Colors
                    array(
                        'id'        =>  'enable_custom_colors',
                        'type'      =>  'switch', 
                        'title'     =>  __('Custom Colors', 'redux-framework-demo'),
                        'subtitle'  =>  __('Do you want enable custom colors?', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  0
                    ),

                    // Logo/Navigation Type Colors
                    array(
                        'id'            =>  'light_type_custom_color',
                        'type'          =>  'color',   
                        'required'      =>  array('enable_custom_colors','=','1'),
                        'title'         =>  __( 'Light Type Logo/Navigation Colors', 'redux-framework-demo' ), 
                        'subtitle'      =>  __( 'You can change the colors based on Light Logo/Navigation Type.<br><br>This modify the colors for header and some elements of Title Header.<br><br>( see the documentation for details )', 'redux-framework-demo' ),
                        'default'       =>  '#FFFFFF',
                        'transparent'   =>  false,
                    ),

                    array(
                        'id'            =>  'dark_type_custom_color',
                        'type'          =>  'color',   
                        'required'      =>  array('enable_custom_colors','=','1'),
                        'title'         =>  __( 'Dark Type Logo/Navigation Colors', 'redux-framework-demo' ), 
                        'subtitle'      =>  __( 'You can change the colors based on Dark Logo/Navigation Type.<br><br>This modify the colors for header and some elements of Title Header.<br><br>( see the documentation for details )', 'redux-framework-demo' ),
                        'default'       =>  '#28282E',
                        'transparent'   =>  false,
                    ),

                    // Body and Others
                    array(
                        'id'            =>  'general_body_custom_color',
                        'type'          =>  'color',   
                        'required'      =>  array('enable_custom_colors','=','1'),
                        'title'         =>  __( 'Body and Others Colors', 'redux-framework-demo' ), 
                        'subtitle'      =>  __( 'You can change the colors of these elements: body and others elements connected with this color.<br><br>( see the documentation for details )', 'redux-framework-demo' ),
                        'default'       =>  '#5D556F',
                        'transparent'   =>  false,
                    ),

                    // Main and Others
                    array(
                        'id'            =>  'general_main_custom_color',
                        'type'          =>  'color',   
                        'required'      =>  array('enable_custom_colors','=','1'),
                        'title'         =>  __( 'Main and Others Colors', 'redux-framework-demo' ), 
                        'subtitle'      =>  __( 'You can change the colors of these elements: link and others elements connected with this color.<br><br>( see the documentation for details )', 'redux-framework-demo' ),
                        'default'       =>  '#EF4135',
                        'transparent'   =>  false,
                    ),

                )
            );


            /*-----------------------------------------------------------------------------------*/
            /*  - Header
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'     =>  __('Header', 'redux-framework-demo'),
                'icon'      =>  'font-icon-list-2'
            );

                // Logo
                $this->sections[] = array(
                    'title'         =>  __('Menu & Logo', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false,
                    'fields'        =>  array(

                        // Menu Type
                        array(
                            'id'        =>  'global_menu_type',
                            'type'      =>  'button_set',
                            'title'     =>  __('Menu Type', 'redux-framework-demo'), 
                            'subtitle'  =>  __('The setting refers to which type of menu will appear.<br/><br/><em>The social icons appear into footer credits area.</em>', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'creative' =>  'Creative',
                                'classic'  =>  'Classic',
                            ),
                            'default'   =>  'creative',
                        ),

                        // Logo/Navigation Type
                        array(
                            'id'        =>  'global_logo_navi_type_color',
                            'type'      =>  'button_set',
                            'title'     =>  __('Global Logo/Navigation Type', 'redux-framework-demo'), 
                            'subtitle'  =>  __('The setting refers to which type of logo/navigation will appear.<br/><br/><em>If you want can modify in each page/post the setting about the color type.</em>', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'light' =>  'Light',
                                'dark'  =>  'Dark',
                            ),
                            'default'   =>  'light',
                        ),

                        // Logo Top Value
                        array(
                            'id'       =>  'logo_top_value',
                            'type'     =>  'text',
                            'title'    =>  __( 'Logo Top Value', 'redux-framework-demo' ),
                            'subtitle' =>  __( 'Set your custom value for top logo position.<br/><br/><em>Default is 3</em>', 'redux-framework-demo' ),
                            'desc'     =>  __( 'Insert only a number. (no px)', 'redux-framework-demo' ),
                            'default'  =>  '',
                        ),
                        
                        // Logo Max-Height Value
                        array(
                            'id'       =>  'logo_max_height_value',
                            'type'     =>  'text',
                            'title'    =>  __( 'Logo Max-Height Value', 'redux-framework-demo' ),
                            'subtitle' =>  __( 'Set a max height for the logo here, and this will resize it on the front end if your logo image is bigger.<br/><br/><em>Default is 50</em>', 'redux-framework-demo' ),
                            'desc'     =>  __( 'Insert only a number. (no px)', 'redux-framework-demo' ),
                            'default'  =>  '50',
                        ),

                        // Logo Text or Logo Image
                        array(
                            'id'        =>  'use_logo_image',
                            'type'      =>  'switch',
                            'title'     =>  __('Use Image for Logo?', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Upload a logo for your theme.<br/> Otherwise you will see the Plain Text Logo.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  0
                        ),

                        array(
                            'id'        =>  'logo',
                            'type'      =>  'media',
                            'required'  =>  array('use_logo_image','=','1'),    
                            'title'     =>  __('Logo PNG Upload', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Upload your logo.', 'redux-framework-demo'),
                            'desc'      =>  ''  
                        ),

                        array(
                            'id'        =>  'retina_logo',
                            'type'      =>  'media',
                            'required'  =>  array('use_logo_image','=','1'),
                            'title'     =>  __('Retina PNG Logo Upload', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Upload your Retina Logo for Retina Devices. Double Size of Logo PNG.', 'redux-framework-demo'),
                            'desc'      =>  ''  
                        ),

                        array(
                            'id'        =>  'dark_logo',
                            'type'      =>  'media',
                            'required'  =>  array('use_logo_image','=','1'),    
                            'title'     =>  __('Dark Logo PNG Upload', 'redux-framework-demo'), 
                            'subtitle'  =>  __('<em>Optional</em>. Upload your Dark Logo version.', 'redux-framework-demo'),
                            'desc'      =>  ''  
                        ),

                        array(
                            'id'        =>  'dark_retina_logo',
                            'type'      =>  'media',
                            'required'  =>  array('use_logo_image','=','1'),
                            'title'     =>  __('Dark Retina PNG Logo Upload', 'redux-framework-demo'), 
                            'subtitle'  =>  __('<em>Optional</em>. Upload your Dark Retina Logo version for Retina Devices. Double Size of Dark Logo PNG.', 'redux-framework-demo'),
                            'desc'      =>  ''  
                        ),

                    )
                );

                // Top Side
                $this->sections[] = array(
                    'title'         =>  __('Top Side', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false,
                    'fields'        =>  array(

                        array(
                            'id'        =>  'global_optional_header_menu',
                            'type'      =>  'button_set',
                            'title'     =>  __('Search/Share/Language Menu', 'redux-framework-demo'), 
                            'subtitle'  =>  __('The setting refers to enable search, share and language switcher functionality on header area.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'show'  =>  'Show',
                                'hide'  =>  'Hide',
                            ),
                            'default'   =>  'hide',
                        ),

                        // Scroll Fx
                        array(
                            'id'        =>  'global_optional_header_menu_scroll',
                            'type'      =>  'button_set',
                            'required'  =>  array('global_optional_header_menu','=','show'),
                            'title'     =>  __( 'Scroll Effects', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Activate the scroll feature for search/share menu.<br/><br/><em>Available on with Menu Creative.</em>', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'always'   =>  'Always Visible',
                                'scroll'   =>  'Only Scroll Up',
                            ),
                            'default'   =>  'always',
                        ),

                        // Search
                        array(
                            'id'        =>  'global_menu_search_button',
                            'type'      =>  'button_set',
                            'required'  =>  array('global_optional_header_menu','=','show'),
                            'title'     =>  __( 'Search', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Enable or Disable Search Feature.', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'enable'   =>  'Enable',
                                'disable'  =>  'Disable',
                            ),
                            'default'   =>  'disable',
                        ),

                        // Share
                        array(
                            'id'        =>  'global_menu_share_button',
                            'type'      =>  'button_set',
                            'required'  =>  array('global_optional_header_menu','=','show'),
                            'title'     =>  __( 'Share', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Enable or Disable Share Page Feature.', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'enable'   =>  'Enable',
                                'disable'  =>  'Disable',
                            ),
                            'default'   =>  'disable',
                        ),

                        // Twitter
                        array(
                            'id'        =>  'header_twitter_share',
                            'type'      =>  'checkbox',
                            'required'  =>  array('global_menu_share_button','=','enable'),
                            'title'     =>  __('Twitter', 'redux-framework-demo'), 
                            'subtitle'  =>  'Tweet it.',
                            'desc'      =>  '',
                            'default'   =>  '1'
                        ),  

                        // Facebook
                        array(
                            'id'        =>  'header_facebook_share',
                            'type'      =>  'checkbox',
                            'required'  =>  array('global_menu_share_button','=','enable'),
                            'title'     =>  __('Facebook', 'redux-framework-demo'), 
                            'subtitle'  =>  'Share it.',
                            'desc'      =>  '',
                            'default'   =>  '1'
                        ),

                        // Google Plus
                        array(
                            'id'        =>  'header_google_share',
                            'type'      =>  'checkbox',
                            'required'  =>  array('global_menu_share_button','=','enable'),
                            'title'     =>  __('Google Plus', 'redux-framework-demo'), 
                            'subtitle'  =>  'Google it.',
                            'desc'      =>  '',
                            'default'   =>  '1'
                        ),

                        // Pinterest
                        array(
                            'id'        =>  'header_pinterest_share',
                            'type'      =>  'checkbox',
                            'required'  =>  array('global_menu_share_button','=','enable'),
                            'title'     =>  __('Pinterest', 'redux-framework-demo'), 
                            'subtitle'  =>  'Pin it.',
                            'desc'      =>  '',
                            'default'   =>  '1'
                        ),

                        // Linked In
                        array(
                            'id'        =>  'header_linkedin_share',
                            'type'      =>  'checkbox',
                            'required'  =>  array('global_menu_share_button','=','enable'),
                            'title'     =>  __('Linked In', 'redux-framework-demo'), 
                            'subtitle'  =>  'Linked it.',
                            'desc'      =>  '',
                            'default'   =>  '1'
                        ),

                        // Language Switcher
                        array(
                            'id'        =>  'global_menu_language_button',
                            'type'      =>  'button_set',
                            'required'  =>  array('global_optional_header_menu','=','show'),
                            'title'     =>  __( 'Language Switcher', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Enable or Disable Language Switcher Feature.<br/><em>Required WPML Installed</em>', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'enable'   =>  'Enable',
                                'disable'  =>  'Disable',
                            ),
                            'default'   =>  'disable',
                        ),

                    )
                );
                
                // Left Side
                $this->sections[] = array(
                    'title'         =>  __('Left Side', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false,
                    'fields'        =>  array(

                        array(
                            'id'            =>  'left_side_slogan_visibility',
                            'type'          =>  'button_set',
                            'title'         =>  __( 'Left Side Panel', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'The setting refers to enable the slogan box in the menu area.', 'redux-framework-demo' ), 
                            'options'       =>  array(
                                'show'   =>  'Show',
                                'hide'   =>  'Hide',
                            ),
                            'default'       =>  'show',
                        ),

                        array(
                            'id'            =>  'left_side_header_menu',
                            'type'          =>  'button_set',
                            'required'      =>  array('left_side_slogan_visibility','=','show'),
                            'title'         =>  __( 'Left Side Mode', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Choose if the slogan area have the solid background or a custom image background.', 'redux-framework-demo' ), 
                            'options'       =>  array(
                                'solid_color'   =>  'Solid Color',
                                'bg_image'      =>  'Background Image',
                            ),
                            'default'       =>  'solid_color',
                        ),

                        array(
                            'id'            =>  'left_side_background_color',
                            'type'          =>  'color',
                            'required'      =>  array('left_side_header_menu','=','solid_color'),   
                            'title'         =>  __( 'Solid Background Color', 'redux-framework-demo' ), 
                            'subtitle'      =>  __( '<em>Optional</em>. Select your custom hex color.', 'redux-framework-demo' ),
                            'default'       =>  '',
                            'transparent'   =>  false,
                        ),

                        array(
                            'id'            =>  'left_side_overaly_mask_color',
                            'type'          =>  'color_rgba',
                            'required'      =>  array('left_side_header_menu','=','bg_image'),   
                            'title'         =>  __( 'Mask Overlay Color', 'redux-framework-demo' ), 
                            'subtitle'      =>  __( '<em>Required</em>. Select your custom hex color with opacity.', 'redux-framework-demo' ),
                            'default'       =>  array( 'color' => '#000000', 'alpha' => '0.55' ),
                            'validate'      =>  'colorrgba',
                            'transparent'   =>  false,
                        ),

                        // Image
                        array(
                            'id'            =>  'left_side_background_image',
                            'type'          =>  'media',  
                            'title'         =>  __( 'Background Image', 'redux-framework-demo' ), 
                            'subtitle'      =>  __( '<em>Required</em>. Upload your background image.', 'redux-framework-demo' ),
                            'desc'          =>  '',
                            'required'      =>  array('left_side_header_menu','=','bg_image'),
                        ),

                        array(
                            'id'        =>  'left_side_background_image_position',
                            'type'      =>  'select',
                            'title'     =>  __('Background Image: Position', 'redux-framework-demo'), 
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
                            'required'  =>  array('left_side_header_menu','=','bg_image'),
                        ),

                        array(
                            'id'        =>  'left_side_background_image_repeat',
                            'type'      =>  'select',
                            'title'     =>  __('Background Image: Repeat', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your background image repeat.', 'redux-framework-demo'),
                            'options'   =>  array(
                                'no_repeat' =>  __( 'No Repeat', 'redux-framework-demo' ),
                                'repeat'    =>  __( 'Repeat', 'redux-framework-demo' ),
                                'repeat_x'  =>  __( 'Repeat Horizontally', 'redux-framework-demo' ),
                                'repeat_y'  =>  __( 'Repeat Vertically', 'redux-framework-demo' ),
                                'stretch'   =>  __( 'Stretch to fit', 'redux-framework-demo' ),
                            ),
                            'default'   =>  'stretch',
                            'required'  =>  array('left_side_header_menu','=','bg_image'),
                        ),
                        
                        // Slogan Image/Text
                        array(
                            'id'            =>  'left_side_header_slogan_logo',
                            'type'          =>  'media',   
                            'required'      =>  array('left_side_slogan_visibility','=','show'),
                            'title'         =>  __('Slogan Logo', 'redux-framework-demo'), 
                            'subtitle'      =>  __('<em>Optional</em>. Upload your slogan logo.', 'redux-framework-demo'),
                            'desc'          =>  '',  
                        ),

                        array(
                            'id'            =>  'left_side_header_slogan_text',
                            'type'          =>  'textarea',   
                            'required'      =>  array('left_side_slogan_visibility','=','show'),
                            'title'         =>  __('Slogan Text', 'redux-framework-demo'), 
                            'subtitle'      =>  __('<em>Optional</em>. Enter your slogan text.<br/><em>Only br and strong HTML tags is allowed.</em>', 'redux-framework-demo'),
                            'desc'          =>  '',
                            'validate'      =>  'html',  
                        ),

                        array(
                            'id'            =>  'left_side_header_slogan_text_color',
                            'type'          =>  'color',
                            'required'      =>  array('left_side_slogan_visibility','=','show'),
                            'title'         =>  __( 'Slogan Text Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a text color for your slogan text.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                        ),

                    )
                );

                // Right Side
                $this->sections[] = array(
                    'title'         =>  __('Right Side', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false,
                    'fields'        =>  array(

                        array(
                            'id'        =>  'header_social_link',
                            'type'      =>  'switch',
                            'title'     =>  __('Social Profiles', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Activate this to enable social profiles on your header.<br/><br/>You can set your social profile in <strong>Social Options Tabs</strong>.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  0
                        ),

                    )
                );

            /*-----------------------------------------------------------------------------------*/
            /*  - Title Header
            /*-----------------------------------------------------------------------------------*/

            // Title Header
            $this->sections[] = array(
                'title'         =>  __('Title Header', 'redux-framework-demo'),
                'desc'          =>  __('Control and configure the globals variable about the title header for pages, posts and custom post types ( portfolio and team ). If you want can modify in each page the all settings based on your needs.', 'redux-framework-demo'),
                'icon'          =>  'font-icon-book',
                'customizer'    =>  false,
                'fields'        =>  array(

                    array(
                        'id'        =>  'global_title_header_visibility',
                        'type'      =>  'button_set',
                        'title'     =>  __('Title Header', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enable or Disable the Title Header Area.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'show'  =>  'Show',
                            'hide'  =>  'Hide',
                        ),
                        'default'   =>  'show',
                    ),

                    // Title Header Hide Options
                    array(
                        'id'        =>  'global_title_header_hide_visibility',
                        'type'      =>  'button_set',
                        'required'      =>  array('global_title_header_visibility','=','hide'),
                        'title'     =>  __('Title Header', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Select if the page header is transparent or has a simple background color when this is hide.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'transparent'  =>  'Transparent',
                            'colorful'     =>  'Colorful',
                        ),
                        'default'   =>  'colorful',
                    ),

                    array(
                        'id'            =>  'global_title_header_hide_color',
                        'type'          =>  'color',   
                        'required'      =>  array('global_title_header_hide_visibility','=','colorful'),
                        'title'         =>  __( 'Title Header Hide Background Color', 'redux-framework-demo' ), 
                        'subtitle'      =>  __( '<em>Optional</em>. Choose a background color for your title header when this is hide.', 'redux-framework-demo' ),
                        'default'       =>  '',
                        'transparent'   =>  false,
                    ),

                    // Title Header
                    array(
                        'id'            =>  'global_title_header_normal_bg_color',
                        'type'          =>  'color',   
                        'required'      =>  array('global_title_header_visibility','=','show'),
                        'title'         =>  __( 'Title Header Background Color', 'redux-framework-demo' ), 
                        'subtitle'      =>  __( '<em>Optional</em>. Choose a background color for your title header section.', 'redux-framework-demo' ),
                        'default'       =>  '',
                        'transparent'   =>  false,
                    ),

                    array(
                        'id'        =>  'global_title_header_layout_container',
                        'type'      =>  'button_set',
                        'required'  =>  array('global_title_header_visibility','=','show'), 
                        'title'     =>  __('Title Header Layout', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Select your layout for the title header page.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'normal'      =>  'Normal',
                            'fullscreen'  =>  'Full Screen',
                        ),
                        'default'   =>  'normal',
                    ),

                    array(
                        'id'        =>  'global_title_header_height',
                        'type'      =>  'text',
                        'required'  =>  array('global_title_header_layout_container','=','normal'),
                        'title'     =>  __( 'Title Header Height', 'redux-framework-demo' ),
                        'subtitle'  =>  __( 'Select your custom height for your title header page.<br/>Default is 600px.', 'redux-framework-demo' ),
                        'desc'      =>  '',
                        'default'   =>  '',
                    ),

                    array(
                        'id'        =>  'global_scroll_to_section',
                        'type'      =>  'button_set',
                        'required'  =>  array('global_title_header_layout_container','=','fullscreen'),
                        'title'     =>  __( 'Scroll Button To Next Section', 'redux-framework-demo' ),
                        'subtitle'  =>  __( 'Enable or Disable Scroll Button Feature.', 'redux-framework-demo' ),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'enable'   =>  'Enable',
                            'disable'  =>  'Disable',
                        ),
                        'default'   =>  'disable',
                    ),

                    array(
                        'id'        =>  'global_title_header_text_visibility',
                        'type'      =>  'button_set',
                        'required'  =>  array('global_title_header_visibility','=','show'),
                        'title'     =>  __('Title Header Text', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enable or Disable the Title Header Text.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'show'  =>  'Show',
                            'hide'  =>  'Hide',
                        ),
                        'default'   =>  'show',
                    ),

                    array(
                        'id'            =>  'global_title_header_text_color',
                        'type'          =>  'color',   
                        'required'      =>  array('global_title_header_text_visibility','=','show'),
                        'title'         =>  __( 'Title Header Text Color', 'redux-framework-demo' ), 
                        'subtitle'      =>  __( '<em>Optional</em>. Choose a text color for your heading and subheading.', 'redux-framework-demo' ),
                        'default'       =>  '',
                        'transparent'   =>  false,
                    ),

                )
            );


            /*-----------------------------------------------------------------------------------*/
            /*  - Footer
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'      =>  __('Footer', 'redux-framework-demo'),
                'desc'       =>  __('Control and configure of your footer area.', 'redux-framework-demo'),
                'icon'       =>  'font-icon-cone',
                'customizer' =>  false,
                'fields'     =>  array(

                    array(
                        'id'        =>  'global_footer_widget_visibility',
                        'type'      =>  'button_set',
                        'title'     =>  __('Global Footer Widgets Area', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enable or Disable the Footer Widgets Area.<br/><br/><em>If you want can modify in each page/post the setting about the visibility about the footer widgets area.</em>', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'show'  =>  'Show',
                            'hide'  =>  'Hide',
                        ),
                        'default'   =>  'hide',
                    ),

                    array(
                        'id'        =>  'footer_widget_area_color_type',
                        'type'      =>  'button_set',
                        'title'     =>  __('Footer Widgets Color Type', 'redux-framework-demo'), 
                        'subtitle'  =>  __('The setting refers to which color type for footer widgets area will appear.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'light-type' =>  'Light',
                            'dark-type'  =>  'Dark',
                        ),
                        'default'   =>  'dark-type',
                    ),

                    array(
                        'id'        =>  'footer_widget_columns',
                        'type'      =>  'button_set',
                        'title'     =>  __('Footer Widget Columns', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Select the columns for footer widget area.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            '2'     =>  '2 Columns',
                            '3'     =>  '3 Columns',
                            '4'     =>  '4 Columns'
                        ),
                        'default'   =>  '3',
                    ),

                    // Copyright/Credits Text
                    array(
                        'id'        =>  'footer_credits_text',
                        'type'      =>  'editor',
                        'title'     =>  __('Credits Section Area', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Optional. Please enter your custom credits/copyright section text.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'args'   => array(
                            'teeny'         => false,
                            'wpautop'       => true,
                            'media_buttons' => false
                        )
                    ),
                )
            );

            /*-----------------------------------------------------------------------------------*/
            /*  - Portfolio
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'      =>  __('Portfolio', 'redux-framework-demo'),
                'desc'       =>  __('Control and configure the general setup of your portfolio.', 'redux-framework-demo'),
                'icon'       =>  'font-icon-grid',
                'customizer' =>  false,
                'fields'     =>  array( 

                    array(
                        'id'        =>  'portfolio_rewrite_slug', 
                        'type'      =>  'text', 
                        'title'     =>  __('Custom Slug', 'redux-framework-demo'),
                        'subtitle'  =>  __('If you want your portfolio post type to have a custom slug in the url, please enter it here.<br/><br/>
                                        <b>You will still have to refresh your permalinks after saving this!</b><br/><br/>
                                        This is done by going to <b>Settings -> Permalinks</b> and clicking save.', 'redux-framework-demo'),
                        'desc'      => ''
                    ),

                    array(
                        'id'        =>  'navigation_portfolio_mode',
                        'type'      =>  'button_set',
                        'title'     =>  __('Navigation Portfolio Posts Mode', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Select your navigation portfolio posts mode.<br/><br/>
                                            <strong>Normal:</strong><br/>You can navigate all single posts without limitation.<br/><br/>
                                            <strong>Categories:</strong><br/>You can navigate all single posts based on categories attributes.<br/><br/>It is recommended to use this navigation only if you have multiple portfolio pages based on different categories.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'normal'       =>  'Normal',
                            'categories'   =>  'Categories'
                        ),
                        'default'   =>  'normal',
                    ),

                    array(
                        'id'        =>  'back_to_portfolio',
                        'type'      =>  'switch',
                        'title'     =>  __('Back to Main Portfolio Page on Navigation?', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enable/Disable Back to Portfolio Button.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  0
                    ),

                    array(
                        'id'        =>  'back_to_portfolio_mode',
                        'type'      =>  'button_set',
                        'required'  =>  array('back_to_portfolio','=','1'),
                        'title'     =>  __('Back To Portfolio Mode', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Select your back to portfolio button mode.<br/><br/>
                                            <strong>Simple:</strong><br/>You have a global link for all single portfolio post.<br/><br/>
                                            <strong>Custom:</strong><br/>You can have a different URL for each single portfolio post.<br/><br/>You need set the URL inside the single portfolio post for each post in the respective metabox.<br/><br/>It is recommended to use this if you have multiple portfolio pages based on different categories.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'general'   =>  'General',
                            'custom'    =>  'Custom'
                        ),
                        'default'   =>  'general',
                    ),

                    array(
                        'id'        =>  'back_to_portfolio_url_general',
                        'type'      =>  'select',
                        'data'      =>  'pages',
                        'required'  =>  array('back_to_portfolio_mode','=','general'),    
                        'title'     =>  __('Portfolio Main Page', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Required. Select the page that is your main portfolio index page. This is used to link to the page from the portfolio post detail page..', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  ''  
                    ),

                    array(
                        'id'        =>  'enable_comment_portfolio',
                        'type'      =>  'switch',
                        'title'     =>  __('Enable Comments Template on Single Portfolio Post?', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enable/Disable Comments Template.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  0
                    ),
                                            
                )
            );

            /*-----------------------------------------------------------------------------------*/
            /*  - Team
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'      =>  __('Team', 'redux-framework-demo'),
                'desc'       =>  __('Control and configure the general setup of your team.', 'redux-framework-demo'),
                'icon'       =>  'font-icon-group',
                'customizer' =>  false,
                'fields'     =>  array(
                    array(
                        'id'        =>  'team_rewrite_slug', 
                        'type'      =>  'text', 
                        'title'     =>  __('Custom Slug', 'redux-framework-demo'),
                        'subtitle'  =>  __('If you want your team post type to have a custom slug in the url, please enter it here.<br/><br/>
                                        <b>You will still have to refresh your permalinks after saving this!</b><br/><br/>
                                        This is done by going to <b>Settings -> Permalinks</b> and clicking save.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ), 

                    array(
                        'id'        =>  'navigation_team_mode',
                        'type'      =>  'button_set',
                        'title'     =>  __('Navigation Team Posts Mode', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Select your navigation team posts mode.<br/><br/>
                                            <strong>Normal:</strong><br/>You can navigate all single posts without limitation.<br/><br/>
                                            <strong>Disciplines:</strong><br/>You can navigate all single posts based on disciplines attributes.<br/><br/>It is recommended to use this navigation only if you have multiple team pages based on different disciplines.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'normal'        =>  'Normal',
                            'disciplines'   =>  'Disciplines'
                        ),
                        'default'   =>  'normal',
                    ),

                    array(
                        'id'        =>  'back_to_team',
                        'type'      =>  'switch',
                        'title'     =>  __('Back to Main Team Page on Navigation?', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enable/Disable Back to Team Button.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  0
                    ),

                    array(
                        'id'        =>  'back_to_team_mode',
                        'type'      =>  'button_set',
                        'required'  =>  array('back_to_team','=','1'),
                        'title'     =>  __('Back To Team Mode', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Select your back to team button mode.<br/><br/>
                                            <strong>Simple:</strong><br/>You have a global link for all single team post.<br/><br/>
                                            <strong>Custom:</strong><br/>You can have a different URL for each single team post.<br/><br/>You need set the URL inside the single team post for each post in the respective metabox.<br/><br/>It is recommended to use this if you have multiple team pages based on different disciplines.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'general'   =>  'General',
                            'custom'    =>  'Custom'
                        ),
                        'default'   =>  'general',
                    ),

                    array(
                        'id'        =>  'back_to_team_url_general',
                        'type'      =>  'select',
                        'data'      =>  'pages',
                        'required'  =>  array('back_to_team_mode','=','general'),    
                        'title'     =>  __('Team Main Page', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Required. Select the page that is your main team index page. This is used to link to the page from the team post detail page..', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  ''  
                    ),                         
                )
            );

            /*-----------------------------------------------------------------------------------*/
            /*  - Blog
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'      =>  __('Blog', 'redux-framework-demo'),
                'desc'       =>  __('Control and configure the general setup of your blog.', 'redux-framework-demo'),
                'icon'       =>  'font-icon-align-left',
                'customizer' =>  false,
                'fields'     =>  array(

                    array(
                        'id'        =>  'blog_layout_mode',
                        'type'      =>  'image_select',
                        'title'     =>  __('Blog Layout Mode', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Select the layout for the blog page.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'wide'    =>  array('title' => 'Wide', 'img' => ReduxFramework::$_url .'/assets/img/blog_wide.png'),
                            'grid'    =>  array('title' => 'Grid', 'img' => ReduxFramework::$_url .'/assets/img/blog_grid.png')
                        ),
                        'default'   =>  'wide'
                    ),

                    array(
                        'id'        =>  'blog_grid_columns',
                        'type'      =>  'button_set',
                        'required'  =>  array('blog_layout_mode','=','grid'), 
                        'title'     =>  __('Blog Grid Columns', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Select your columns for the blog grid layout only.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            '1'     =>  '1 Column',
                            '2'     =>  '2 Columns',
                            '3'     =>  '3 Columns',
                            '4'     =>  '4 Columns'
                        ),
                        'default'   =>  '3',
                    ),

                    // Size Post Thumbnails
                    array(
                        'id'        => 'wide_post_thumb_size',
                        'type'      => 'text',
                        'required'  =>  array('blog_layout_mode','=','wide'), 
                        'title'     =>  __('Post Thumbnail Size: Wide Blog Layout', 'redux-framework-demo'),
                        'subtitle'  =>  __('Optional. Set your custom size of post thumbnail.<br/><em>Default is 1000x500</em>', 'redux-framework-demo'),
                        'desc'      =>  __('Insert only number value like this example: 200x100 (Width x Height).', 'redux-framework-demo'),
                        'default'   =>  '1000x500'
                    ),

                    array(
                        'id'        => 'grid_one_post_thumb_size',
                        'type'      => 'text',
                        'required'  => array(
                            array( 'blog_layout_mode', '=', 'grid' ),
                            array( 'blog_grid_columns', '=', '1' ),
                        ),
                        'title'     =>  __('Post Thumbnail Size: Grid Blog 1 Col', 'redux-framework-demo'),
                        'subtitle'  =>  __('Optional. Set your custom size of post thumbnail.<br/><em>Default is 1000x600</em>', 'redux-framework-demo'),
                        'desc'      =>  __('Insert only number value like this example: 200x100 (Width x Height).', 'redux-framework-demo'),
                        'default'   =>  '1000x600'
                    ),

                    array(
                        'id'        => 'grid_two_post_thumb_size',
                        'type'      => 'text',
                        'required'  => array(
                            array( 'blog_layout_mode', '=', 'grid' ),
                            array( 'blog_grid_columns', '=', '2' ),
                        ),
                        'title'     =>  __('Post Thumbnail Size: Grid Blog 2 Cols', 'redux-framework-demo'),
                        'subtitle'  =>  __('Optional. Set your custom size of post thumbnail.<br/><em>Default is 800x800</em>', 'redux-framework-demo'),
                        'desc'      =>  __('Insert only number value like this example: 200x100 (Width x Height).', 'redux-framework-demo'),
                        'default'   =>  '800x800'
                    ),

                    array(
                        'id'        => 'grid_three_post_thumb_size',
                        'type'      => 'text',
                        'required'  => array(
                            array( 'blog_layout_mode', '=', 'grid' ),
                            array( 'blog_grid_columns', '=', '3' ),
                        ), 
                        'title'     =>  __('Post Thumbnail Size: Grid Blog 3 Cols', 'redux-framework-demo'),
                        'subtitle'  =>  __('Optional. Set your custom size of post thumbnail.<br/><em>Default is 800x800</em>', 'redux-framework-demo'),
                        'desc'      =>  __('Insert only number value like this example: 200x100 (Width x Height).', 'redux-framework-demo'),
                        'default'   =>  '800x800'
                    ),

                    array(
                        'id'        => 'grid_four_post_thumb_size',
                        'type'      => 'text',
                        'required'  => array(
                            array( 'blog_layout_mode', '=', 'grid' ),
                            array( 'blog_grid_columns', '=', '4' ),
                        ), 
                        'title'     =>  __('Post Thumbnail Size: Grid Blog 4 Cols', 'redux-framework-demo'),
                        'subtitle'  =>  __('Optional. Set your custom size of post thumbnail.<br/><em>Default is 800x800</em>', 'redux-framework-demo'),
                        'desc'      =>  __('Insert only number value like this example: 200x100 (Width x Height).', 'redux-framework-demo'),
                        'default'   =>  '800x800'
                    ),

                    array(
                        'id'        =>  'blog_pagination_select',
                        'type'      =>  'button_set',
                        'title'     =>  __('Blog Pagination', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Choose your favourite pagination for your blog page.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'options'   =>  array(
                            'simple_blog_pagination'            =>  'Normal',
                            'infinite_scroll_blog_pagination'   =>  'Infinite Scroll',
                        ),
                        'default'   =>  'simple_blog_pagination',
                    ),

                    array(
                        'id'        =>  'back_to_posts',
                        'type'      =>  'switch',
                        'title'     =>  __('Back to Main Blog Page on Navigation?', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enable/Disable Back to Posts Button.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  0
                    ),

                    array(
                        'id'        =>  'back_to_posts_url',
                        'type'      =>  'select',
                        'data'      =>  'pages',
                        'required'  =>  array('back_to_posts','=','1'),    
                        'title'     =>  __('Blog Main Page', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Required. Select the page that is your main blog index page. This is used to link to the page from the blog post detail page.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  ''  
                    ),

                )
            );

            /*-----------------------------------------------------------------------------------*/
            /*  - Misc
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'     =>  __('Misc', 'redux-framework-demo'),
                'desc'      =>  __('Control and configure the misc options available.', 'redux-framework-demo'),
                'icon'      =>  'font-icon-droplets',
            );

                // Error Page
                $this->sections[] = array(
                    'title'         =>  __('Error Page', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false,
                    'fields'        =>  array(

                        array(
                            'id'        =>  'error_preloader_visibility',
                            'type'      =>  'button_set',
                            'title'     =>  __('Error Preloader Setting', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable or Disable the Preloader for Error Page.<br/><br/>Work only if you have activated the Preloader Feature in General Tabs -> Preloader.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'show'  =>  'Show',
                                'hide'  =>  'Hide',
                            ),
                            'default'   =>  'hide',
                        ),

                        array(
                            'id'        =>  'error_logo_navi_type_color',
                            'type'      =>  'button_set',
                            'title'     =>  __('Error Logo/Navigation Type', 'redux-framework-demo'), 
                            'subtitle'  =>  __('The setting refers to which type of logo/navigation will appear only for Error Page.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'light' =>  'Light',
                                'dark'  =>  'Dark',
                            ),
                            'default'   =>  'light',
                        ),

                        // Customize Error Page
                        array(
                            'id'        =>  'error_customize_settings',
                            'type'      =>  'switch',
                            'title'     =>  __('Error Customize Settings', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable/Disable the customize settings for Error Page.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'default'   =>  0
                        ),

                        array(
                            'id'        =>  'error_custom_title',
                            'type'      =>  'text',
                            'title'     =>  __( 'Error Title', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Optional. Enter your custom error title text.', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'default'   =>  '',
                            'required'  =>  array('error_customize_settings','=','1'),
                        ),

                        array(
                            'id'        =>  'error_custom_subheading',
                            'type'      =>  'text',
                            'title'     =>  __( 'Error SubHeading', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Optional. Enter your custom error subheading text.', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'default'   =>  '',
                            'required'  =>  array('error_customize_settings','=','1'),
                        ),

                        array(
                            'id'        =>  'error_custom_back_button',
                            'type'      =>  'text',
                            'title'     =>  __( 'Error Back Button', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Optional. Enter your custom error button text.', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'default'   =>  '',
                            'required'  =>  array('error_customize_settings','=','1'),
                        ),

                        array(
                            'id'            =>  'error_left_side_bg',
                            'type'          =>  'color',
                            'title'         =>  __( 'Left Side: Background Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a background color for your left side container.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                            'required'      =>  array( 'error_customize_settings', '=', '1' ),
                        ),

                        array(
                            'id'            =>  'error_left_side_title_color',
                            'type'          =>  'color',
                            'title'         =>  __( 'Left Side: Title Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a text color for your title.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                            'required'      =>  array( 'error_customize_settings', '=', '1' ),
                        ),

                        array(
                            'id'            =>  'error_left_side_subheading_color',
                            'type'          =>  'color',
                            'title'         =>  __( 'Left Side: Subheading Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a text color for your subheading.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                            'required'      =>  array( 'error_customize_settings', '=', '1' ),
                        ),

                        array(
                            'id'            =>  'error_right_side_bg',
                            'type'          =>  'color',
                            'title'         =>  __( 'Right Side: Background Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a background color for your right side container.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                            'required'      =>  array( 'error_customize_settings', '=', '1' ),
                        ),

                        array(
                            'id'            =>  'error_right_side_button',
                            'type'          =>  'color',
                            'title'         =>  __( 'Right Side: Button Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a text color for your button back.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                            'required'      =>  array( 'error_customize_settings', '=', '1' ),
                        ),
                      

                    )
                );

                // Archives Page
                $this->sections[] = array(
                    'title'         =>  __('Archives Page', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false,
                    'fields'        =>  array(

                        array(
                            'id'        =>  'archive_preloader_visibility',
                            'type'      =>  'button_set',
                            'title'     =>  __('Archive Preloader Setting', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable or Disable the Preloader for Archive Pages.<br/><br/>Work only if you have activated the Preloader Feature in General Tabs -> Preloader.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'show'  =>  'Show',
                                'hide'  =>  'Hide',
                            ),
                            'default'   =>  'hide',
                        ),

                        array(
                            'id'        =>  'archive_logo_navi_type_color',
                            'type'      =>  'button_set',
                            'title'     =>  __('Archive Logo/Navigation Type', 'redux-framework-demo'), 
                            'subtitle'  =>  __('The setting refers to which type of logo/navigation will appear only for Archive Pages.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'light' =>  'Light',
                                'dark'  =>  'Dark',
                            ),
                            'default'   =>  'light',
                        ),

                        array(
                            'id'        =>  'archive_footer_widget_visibility',
                            'type'      =>  'button_set',
                            'title'     =>  __('Archive Footer Widgets Area', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable or Disable the Footer Widgets for Archive Pages.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'show'  =>  'Show',
                                'hide'  =>  'Hide',
                            ),
                            'default'   =>  'hide',
                        ),

                        array(
                            'id'        =>  'archive_layout_mode',
                            'type'      =>  'image_select',
                            'title'     =>  __('Archive Layout Mode', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select the layout for the archive pages.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'wide'    =>  array('title' => 'Wide', 'img' => ReduxFramework::$_url .'/assets/img/blog_wide.png'),
                                'grid'    =>  array('title' => 'Grid', 'img' => ReduxFramework::$_url .'/assets/img/blog_grid.png')
                            ),
                            'default'   =>  'wide'
                        ),

                        array(
                            'id'        =>  'archive_grid_columns',
                            'type'      =>  'button_set',
                            'title'     =>  __('Archive Grid Columns', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your columns for the archive grid layout only.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                '1'     =>  '1 Column',
                                '2'     =>  '2 Columns',
                                '3'     =>  '3 Columns',
                                '4'     =>  '4 Columns'
                            ),
                            'default'   =>  '3',
                            'required'  =>  array('archive_layout_mode','=','grid'), 
                        ),

                        array(
                            'id'        =>  'archive_title_header_visibility',
                            'type'      =>  'button_set',
                            'title'     =>  __('Archive Title Header', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable or Disable the Archive Title Header Area.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'show'  =>  'Show',
                                'hide'  =>  'Hide',
                            ),
                            'default'   =>  'show',
                        ),
                        
                        array(
                            'id'        =>  'archive_title_header_layout_container',
                            'type'      =>  'button_set',
                            'title'     =>  __('Archive Header Layout', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your layout for the archive title header pages.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'normal'      =>  'Normal',
                                'fullscreen'  =>  'Full Screen',
                            ),
                            'default'   =>  'normal',
                            'required'  =>  array('archive_title_header_visibility','=','show'),
                        ),

                        array(
                            'id'        =>  'archive_title_header_height',
                            'type'      =>  'text',
                            'title'     =>  __( 'Archive Title Header Height', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Select your custom height for your archive title header pages.<br/>Default is 600px.', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'default'   =>  '',
                            'required'  =>  array('archive_title_header_layout_container','=','normal'),
                        ),

                        array(
                            'id'        =>  'archive_scroll_to_section',
                            'type'      =>  'button_set',
                            'title'     =>  __( 'Scroll Button To Next Section', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Enable or Disable Scroll Button Feature.', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'enable'   =>  'Enable',
                                'disable'  =>  'Disable',
                            ),
                            'default'   =>  'disable',
                            'required'  =>  array('archive_title_header_layout_container','=','fullscreen'),
                        ),

                        array(
                            'id'        =>  'archive_title_header_module',
                            'type'      =>  'select',
                            'title'     =>  __('Archive Title Header Module', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your favorite Archive Title Header Module.', 'redux-framework-demo'),
                            'options'   =>  array(
                                'normal'            =>  __( 'Normal', 'redux-framework-demo' ),
                                'image'             =>  __( 'Image', 'redux-framework-demo' ),
                                'image_parallax'    =>  __( 'Image Parallax', 'redux-framework-demo' ),
                            ),
                            'default'   =>  'normal',
                            'required'  =>  array('archive_title_header_visibility', '=', 'show' ),
                        ),

                        array(
                            'id'            =>  'archive_title_header_normal_bg_color',
                            'type'          =>  'color',
                            'title'         =>  __( 'Archive Title Header Background Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a background color for your archive title header section.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                            'required'      =>  array( 'archive_title_header_module', '=', 'normal' ),
                        ),

                        array(
                            'id'        =>  'archive_title_header_image',
                            'type'      =>  'media', 
                            'title'     =>  __('Archive Title Header Background Image', 'redux-framework-demo'),
                            'subtitle'  =>  __('Upload your image.', 'redux-framework-demo'),
                            'default'   =>  '',
                            'required'  =>  array( 'archive_title_header_module', '=', 'image' ),
                        ),

                        array(
                            'id'        =>  'archive_title_header_image_position',
                            'type'      =>  'select',
                            'title'     =>  __('Archive Title Header Image Position', 'redux-framework-demo'), 
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
                            'required'  =>  array( 'archive_title_header_module', '=', 'image' ),
                        ),

                        array(
                            'id'        =>  'archive_title_header_image_repeat',
                            'type'      =>  'select',
                            'title'     =>  __('Archive Title Header Image Repeat', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your background image repeat.', 'redux-framework-demo'),
                            'options'   =>  array(
                                'no_repeat' =>  __( 'No Repeat', 'redux-framework-demo' ),
                                'repeat'    =>  __( 'Repeat', 'redux-framework-demo' ),
                                'repeat_x'  =>  __( 'Repeat Horizontally', 'redux-framework-demo' ),
                                'repeat_y'  =>  __( 'Repeat Vertically', 'redux-framework-demo' ),
                                'stretch'   =>  __( 'Stretch to fit', 'redux-framework-demo' ),
                            ),
                            'default'   =>  'stretch',
                            'required'  =>  array( 'archive_title_header_module', '=', 'image' ),
                        ),

                        array(
                            'id'        =>  'archive_title_header_image_parallax',
                            'type'      =>  'media', 
                            'title'     =>  __('Archive Title Header Background Image Parallax', 'redux-framework-demo'),
                            'subtitle'  =>  __('Upload your image.', 'redux-framework-demo'),
                            'default'   =>  '',
                            'required'  =>  array( 'archive_title_header_module', '=', 'image_parallax' ),
                        ),

                        array(
                            'id'        =>  'archive_title_header_mask_mode',
                            'type'      =>  'select',
                            'title'     =>  __('Archive Title Header Mask', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your favorite Archive Title Header Mask Mode.', 'redux-framework-demo'),
                            'options'   =>  array(
                                'none'                  =>  __( 'None', 'redux-framework-demo' ),
                                'mask_color'            =>  __( 'Mask Color', 'redux-framework-demo' ),
                                'mask_pattern'          =>  __( 'Mask Pattern', 'redux-framework-demo' ),
                                'mask_pattern_color'    =>  __( 'Mask Color and Pattern', 'redux-framework-demo' ),
                            ),
                            'default'   =>  'none',
                            'required'  => array( 'archive_title_header_module', '!=', 'normal' ),
                        ),

                        array(
                            'id'        =>  'archive_title_header_mask_pattern',
                            'type'      =>  'media', 
                            'title'     =>  __('Pattern Mask', 'redux-framework-demo'),
                            'subtitle'  =>  __('Optional. Upload your pattern image.', 'redux-framework-demo'),
                            'default'   =>  '',
                            'required'  => array(
                                array( 'archive_title_header_mask_mode', '!=', 'none' ),
                                array( 'archive_title_header_mask_mode', '!=', 'mask_color' ),
                            ),
                        ),

                        array(
                            'id'            =>  'archive_title_header_mask_pattern_opacity',
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
                                array( 'archive_title_header_mask_mode', '!=', 'none' ),
                                array( 'archive_title_header_mask_mode', '!=', 'mask_color' ),
                            ),
                        ),

                        array(
                            'id'            =>  'archive_title_header_mask_background',
                            'type'          =>  'color_rgba',  
                            'title'         =>  __( 'Color Mask', 'redux-framework-demo' ), 
                            'subtitle'      =>  __( 'Optional. Select your custom hex color with opacity.', 'redux-framework-demo' ),
                            'default'       =>  array( 'color' => '#000000', 'alpha' => '0.55' ),
                            'validate'      =>  'colorrgba',
                            'transparent'   =>  false,
                            'required'  => array(
                                array( 'archive_title_header_mask_mode', '!=', 'none' ),
                                array( 'archive_title_header_mask_mode', '!=', 'mask_pattern' ),
                            ),
                        ),

                        array(
                            'id'            =>  'archive_title_header_text_color',
                            'type'          =>  'color',
                            'title'         =>  __( 'Archive Title Header Text Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a text color for your heading and subheading.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                            'required'      =>  array( 'archive_title_header_visibility', '!=', 'hide' ),
                        ),
                        

                    )
                );

                // Search Page
                $this->sections[] = array(
                    'title'         =>  __('Search Page', 'redux-framework-demo'),
                    'subsection'    =>  true,
                    'icon'          =>  'font-icon-arrow-right-simple-thin-round',
                    'customizer'    =>  false,
                    'fields'        =>  array(

                        array(
                            'id'        =>  'search_preloader_visibility',
                            'type'      =>  'button_set',
                            'title'     =>  __('Search Preloader Setting', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable or Disable the Preloader for Search Page Results.<br/><br/>Work only if you have activated the Preloader Feature in General Tabs -> Preloader.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'show'  =>  'Show',
                                'hide'  =>  'Hide',
                            ),
                            'default'   =>  'hide',
                        ),

                        array(
                            'id'        =>  'search_logo_navi_type_color',
                            'type'      =>  'button_set',
                            'title'     =>  __('Search Logo/Navigation Type', 'redux-framework-demo'), 
                            'subtitle'  =>  __('The setting refers to which type of logo/navigation will appear only for Serch Page Results.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'light' =>  'Light',
                                'dark'  =>  'Dark',
                            ),
                            'default'   =>  'light',
                        ),

                        array(
                            'id'        =>  'search_footer_widget_visibility',
                            'type'      =>  'button_set',
                            'title'     =>  __('Search Footer Widgets Area', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable or Disable the Footer Widgets for Search Page Results.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'show'  =>  'Show',
                                'hide'  =>  'Hide',
                            ),
                            'default'   =>  'hide',
                        ),

                        array(
                            'id'        =>  'search_layout_mode',
                            'type'      =>  'image_select',
                            'title'     =>  __('Search Layout Mode', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select the layout for the search page.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'wide'    =>  array('title' => 'Wide', 'img' => ReduxFramework::$_url .'/assets/img/blog_wide.png'),
                                'grid'    =>  array('title' => 'Grid', 'img' => ReduxFramework::$_url .'/assets/img/blog_grid.png')
                            ),
                            'default'   =>  'wide'
                        ),

                        array(
                            'id'        =>  'search_grid_columns',
                            'type'      =>  'button_set',
                            'title'     =>  __('Search Grid Columns', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your columns for the search grid layout only.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                '1'     =>  '1 Column',
                                '2'     =>  '2 Columns',
                                '3'     =>  '3 Columns',
                                '4'     =>  '4 Columns'
                            ),
                            'default'   =>  '3',
                            'required'  =>  array('search_layout_mode','=','grid'), 
                        ),

                        array(
                            'id'        =>  'search_title_header_visibility',
                            'type'      =>  'button_set',
                            'title'     =>  __('Search Title Header', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Enable or Disable the Search Title Header Area.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'show'  =>  'Show',
                                'hide'  =>  'Hide',
                            ),
                            'default'   =>  'show',
                        ),
                        
                        array(
                            'id'        =>  'search_title_header_layout_container',
                            'type'      =>  'button_set',
                            'title'     =>  __('Search Header Layout', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your layout for the search title header page.', 'redux-framework-demo'),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'normal'      =>  'Normal',
                                'fullscreen'  =>  'Full Screen',
                            ),
                            'default'   =>  'normal',
                            'required'  =>  array('search_title_header_visibility','=','show'),
                        ),

                        array(
                            'id'        =>  'search_title_header_height',
                            'type'      =>  'text',
                            'title'     =>  __( 'Search Title Header Height', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Select your custom height for your search title header page.<br/>Default is 600px.', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'default'   =>  '',
                            'required'  =>  array('search_title_header_layout_container','=','normal'),
                        ),

                        array(
                            'id'        =>  'search_scroll_to_section',
                            'type'      =>  'button_set',
                            'title'     =>  __( 'Scroll Button To Next Section', 'redux-framework-demo' ),
                            'subtitle'  =>  __( 'Enable or Disable Scroll Button Feature.', 'redux-framework-demo' ),
                            'desc'      =>  '',
                            'options'   =>  array(
                                'enable'   =>  'Enable',
                                'disable'  =>  'Disable',
                            ),
                            'default'   =>  'disable',
                            'required'  =>  array('search_title_header_layout_container','=','fullscreen'),
                        ),

                        array(
                            'id'        =>  'search_title_header_module',
                            'type'      =>  'select',
                            'title'     =>  __('Search Title Header Module', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your favorite Search Title Header Module.', 'redux-framework-demo'),
                            'options'   =>  array(
                                'normal'            =>  __( 'Normal', 'redux-framework-demo' ),
                                'image'             =>  __( 'Image', 'redux-framework-demo' ),
                                'image_parallax'    =>  __( 'Image Parallax', 'redux-framework-demo' ),
                            ),
                            'default'   =>  'normal',
                            'required'  =>  array('search_title_header_visibility', '=', 'show' ),
                        ),

                        array(
                            'id'            =>  'search_title_header_normal_bg_color',
                            'type'          =>  'color',
                            'title'         =>  __( 'Search Title Header Background Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a background color for your search title header section.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                            'required'      =>  array( 'search_title_header_module', '=', 'normal' ),
                        ),

                        array(
                            'id'        =>  'search_title_header_image',
                            'type'      =>  'media', 
                            'title'     =>  __('Search Title Header Background Image', 'redux-framework-demo'),
                            'subtitle'  =>  __('Upload your image.', 'redux-framework-demo'),
                            'default'   =>  '',
                            'required'  =>  array( 'search_title_header_module', '=', 'image' ),
                        ),

                        array(
                            'id'        =>  'search_title_header_image_position',
                            'type'      =>  'select',
                            'title'     =>  __('Search Title Header Image Position', 'redux-framework-demo'), 
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
                            'required'  =>  array( 'search_title_header_module', '=', 'image' ),
                        ),

                        array(
                            'id'        =>  'search_title_header_image_repeat',
                            'type'      =>  'select',
                            'title'     =>  __('Search Title Header Image Repeat', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your background image repeat.', 'redux-framework-demo'),
                            'options'   =>  array(
                                'no_repeat' =>  __( 'No Repeat', 'redux-framework-demo' ),
                                'repeat'    =>  __( 'Repeat', 'redux-framework-demo' ),
                                'repeat_x'  =>  __( 'Repeat Horizontally', 'redux-framework-demo' ),
                                'repeat_y'  =>  __( 'Repeat Vertically', 'redux-framework-demo' ),
                                'stretch'   =>  __( 'Stretch to fit', 'redux-framework-demo' ),
                            ),
                            'default'   =>  'stretch',
                            'required'  =>  array( 'search_title_header_module', '=', 'image' ),
                        ),

                        array(
                            'id'        =>  'search_title_header_image_parallax',
                            'type'      =>  'media', 
                            'title'     =>  __('Search Title Header Background Image Parallax', 'redux-framework-demo'),
                            'subtitle'  =>  __('Upload your image.', 'redux-framework-demo'),
                            'default'   =>  '',
                            'required'  =>  array( 'search_title_header_module', '=', 'image_parallax' ),
                        ),

                        array(
                            'id'        =>  'search_title_header_mask_mode',
                            'type'      =>  'select',
                            'title'     =>  __('Search Title Header Mask', 'redux-framework-demo'), 
                            'subtitle'  =>  __('Select your favorite Search Title Header Mask Mode.', 'redux-framework-demo'),
                            'options'   =>  array(
                                'none'                  =>  __( 'None', 'redux-framework-demo' ),
                                'mask_color'            =>  __( 'Mask Color', 'redux-framework-demo' ),
                                'mask_pattern'          =>  __( 'Mask Pattern', 'redux-framework-demo' ),
                                'mask_pattern_color'    =>  __( 'Mask Color and Pattern', 'redux-framework-demo' ),
                            ),
                            'default'   =>  'none',
                            'required'  => array( 'search_title_header_module', '!=', 'normal' ),
                        ),

                        array(
                            'id'        =>  'search_title_header_mask_pattern',
                            'type'      =>  'media', 
                            'title'     =>  __('Pattern Mask', 'redux-framework-demo'),
                            'subtitle'  =>  __('Optional. Upload your pattern image.', 'redux-framework-demo'),
                            'default'   =>  '',
                            'required'  => array(
                                array( 'search_title_header_mask_mode', '!=', 'none' ),
                                array( 'search_title_header_mask_mode', '!=', 'mask_color' ),
                            ),
                        ),

                        array(
                            'id'            =>  'search_title_header_mask_pattern_opacity',
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
                                array( 'search_title_header_mask_mode', '!=', 'none' ),
                                array( 'search_title_header_mask_mode', '!=', 'mask_color' ),
                            ),
                        ),

                        array(
                            'id'            =>  'search_title_header_mask_background',
                            'type'          =>  'color_rgba',  
                            'title'         =>  __( 'Color Mask', 'redux-framework-demo' ), 
                            'subtitle'      =>  __( 'Optional. Select your custom hex color with opacity.', 'redux-framework-demo' ),
                            'default'       =>  array( 'color' => '#000000', 'alpha' => '0.55' ),
                            'validate'      =>  'colorrgba',
                            'transparent'   =>  false,
                            'required'  => array(
                                array( 'search_title_header_mask_mode', '!=', 'none' ),
                                array( 'search_title_header_mask_mode', '!=', 'mask_pattern' ),
                            ),
                        ),

                        array(
                            'id'            =>  'search_title_header_text_color',
                            'type'          =>  'color',
                            'title'         =>  __( 'Search Title Header Text Color', 'redux-framework-demo' ),
                            'subtitle'      =>  __( 'Optional. Choose a text color for your heading and subheading.', 'redux-framework-demo' ),
                            'output'        =>  false,
                            'validate'      =>  false,
                            'transparent'   =>  false,
                            'default'       =>  '',
                            'required'      =>  array( 'search_title_header_visibility', '!=', 'hide' ),
                        ),
                        

                    )
                );

            /*-----------------------------------------------------------------------------------*/
            /*  - Social
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'     =>  __('Social', 'redux-framework-demo'),
                'desc'      =>  __('Control and configure the general setup of your social profile.', 'redux-framework-demo'),
                'icon'      =>  'font-icon-social-twitter',
                'fields'    =>  array(
                    array(
                        'id'        =>  '500px-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('500PX URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your 500PX URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'behance-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Behance URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Behance URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'bebo-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Bebo URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Bebo URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'blogger-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Blogger URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Blogger URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'deviant-art-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Deviant Art URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Deviant Art URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'digg-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Digg URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Digg URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'dribbble-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Dribbble URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Dribbble URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'email-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Email URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Email URL.<br><br>Example: mailto:someone@example.com', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'envato-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Envato URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Envato URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'evernote-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Evernote URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Envernote URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'facebook-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Facebook URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Facebook URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'flickr-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Flickr URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Flickr URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'forrst-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Forrst URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Forrst URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'github-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Github URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Github URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'google-plus-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Google Plus URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Google Plus URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'grooveshark-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Grooveshark URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Grooveshark URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'instagram-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Instagram URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Instagram URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'last-fm-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Last FM URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Last FM URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'linkedin-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Linked In URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Linked In URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'paypal-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Paypal URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Paypal URL.<br><br>Example: mailto:someone@example.com', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'pinterest-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Pinterest URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Pinterest URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'quora-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Quora URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Quora URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'skype-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Skype URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Skype URL.<br><br>Example: skype:username?call', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'soundcloud-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Soundcloud URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Soundcloud URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'stumbleupon-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Stumble Upon URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Stumble Upon URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'tumblr-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Tumblr URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Tumblr URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'twitter-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Twitter URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Twitter URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'viddler-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Viddler URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Viddler URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'vimeo-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Vimeo URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Vimeo URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'virb-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Virb URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Virb URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'wordpress-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Wordpress URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Wordpress URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'xing-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Xing URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Xing URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'yahoo-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Yahoo URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Yahoo URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'yelp-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Yelp URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Yelp URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'youtube-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('You Tube URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your You Tube URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    ),
                    array(
                        'id'        =>  'zerply-url', 
                        'type'      =>  'text', 
                        'title'     =>  __('Zerply URL', 'redux-framework-demo'),
                        'subtitle'  =>  __('Please enter in your Zerply URL.', 'redux-framework-demo'),
                        'desc'      =>  ''
                    )
                )
            );

            /*-----------------------------------------------------------------------------------*/
            /*  - Automatic Updates
            /*-----------------------------------------------------------------------------------*/
            $this->sections[] = array(
                'title'     =>  __('Theme Updates', 'redux-framework-demo'),
                'desc'      =>  __('Here you can enabled the Automatic Update for Alice Theme.', 'redux-framework-demo'),
                'icon'      =>  'font-icon-cycle',
                'fields'    =>  array(

                    array(
                        'id'        =>  'enable-auto-updates',
                        'type'      =>  'switch',
                        'title'     =>  __('Enable Auto Updates', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enable/Disable the automatic updates for your theme.', 'redux-framework-demo'),
                        'desc'      =>  '',
                        'default'   =>  0
                    ),

                    array(
                        'id'        =>  'envato-license-key',
                        'type'      =>  'text',
                        'required'  =>  array('enable-auto-updates','=','1'),
                        'title'     =>  __('Item Purchase Code', 'redux-framework-demo'), 
                        'subtitle'  =>  __('Enter your Envato license key here if you wish to receive auto updates for your theme.', 'redux-framework-demo'),
                        'default'   =>  'Insert here the License Key...'
                    ),
                )
            );

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'redux-framework-demo') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'redux-framework-demo') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'redux-framework-demo') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'redux-framework-demo') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'redux-framework-demo'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }
            
            $this->sections[] = array(
                'title'     => __('Import / Export', 'redux-framework-demo'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo'),
                'icon'      => 'font-icon-switch',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            );                     

            /*
            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'redux-framework-demo'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'redux-framework-demo'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
            */
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'alice',                 // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Alice', 'redux-framework-demo'),
                'page_title'        => __('Alice', 'redux-framework-demo'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'    => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII', // Must be defined to add google fonts to the typography module
                'google_update_weekly' => false,                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                   // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                  // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                  // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '',                  // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false,               // REMOVE

                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons']['twitter'] = array(
                'link' => 'http://twitter.com/bluxart',
                'title' => 'Follow me on Twitter', 
                'icon' => 'font-icon-social-twitter'
            );
            $this->args['share_icons']['dribbble'] = array(
                'link' => 'http://dribbble.com/Bluxart',
                'title' => 'Find me on Dribbble', 
                'icon' => 'font-icon-social-dribbble'
            );
            $this->args['share_icons']['forrst'] = array(
                'link' => 'http://forrst.com/people/Bluxart',
                'title' => 'Find me on Forrst', 
                'icon' => 'font-icon-social-forrst'
            );
            $this->args['share_icons']['behance'] = array(
                'link' => 'http://www.behance.net/alessioatzeni',
                'title' => 'Find me on Behance', 
                'icon' => 'font-icon-social-behance'
            );
            $this->args['share_icons']['facebook'] = array(
                'link' => 'https://www.facebook.com/atzenialessio',
                'title' => 'Follow me on Facebook', 
                'icon' => 'font-icon-social-facebook'
            );
            $this->args['share_icons']['google_plus'] = array(
                'link' => 'https://plus.google.com/105500420878314068694/posts',
                'title' => 'Find me on Google Plus', 
                'icon' => 'font-icon-social-google-plus'
            );
            $this->args['share_icons']['linked_in'] = array(
                'link' => 'http://www.linkedin.com/in/alessioatzeni',
                'title' => 'Find me on LinkedIn', 
                'icon' => 'font-icon-social-linkedin'
            );
            $this->args['share_icons']['envato'] = array(
                'link' => 'http://themeforest.net/user/Bluxart',
                'title' => 'Find me on Themeforest', 
                'icon' => 'font-icon-social-envato'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
            }

            // Add content after the form.
            // $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
 * Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
 * Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;
            $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }
endif;
