<?php
/**
 * Initialize the custom theme options.
 */
add_action( 'admin_init', 'custom_theme_options' );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => '',
          'content'   => ''
        )
      ),
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'analytics',
        'title'       => esc_html__( 'Analytics &  Meta', 'alpha' )
      ),
      array(
        'id'          => 'css',
        'title'       => esc_html__( 'Custom CSS', 'alpha' )
      ),
      array(
        'id'          => 'log',
        'title'       => esc_html__('Changelog', 'alpha' )
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'alpha_tracking_enable',
        'label'       => esc_html__( 'Enable analytics', 'alpha' ),
        'desc'        => esc_html__( 'Please select this if you\'ll be using Google Analytics in the theme.', 'alpha' ),
        'std'         => 'disabled',
        'type'        => 'radio',
        'section'     => 'analytics',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => esc_html__( 'Enabled', 'alpha' ),
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => esc_html__( 'Disabled', 'alpha' ),
            'src'         => ''
          )
        ),
      ),


      array(
        'id'          => 'alpha_meta_enable',
        'label'       => esc_html__( 'Enable social meta tags', 'alpha' ),
        'desc'        => esc_html__( 'Please select this if you want the theme to output some social meta tags into the header. If you\'re already using a SEO or social plugin which does this, you should disable the function to make sure that you don\'t have any conflicts.', 'alpha' ),
        'std'         => 'enabled',
        'type'        => 'radio',
        'section'     => 'analytics',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'enabled',
            'label'       => esc_html__( 'Enabled', 'alpha' ),
            'src'         => ''
          ),
          array(
            'value'       => 'disabled',
            'label'       => esc_html__( 'Disabled', 'alpha' ),
            'src'         => ''
          )
        ),
      ),

      array(
        'id'          => 'alpha_changelog',
        'label'       => esc_html__( 'Changelog', 'alpha' ),
        'desc'        => '<ul>
<li><strong>Version 1.0.2 : 19 February 2016</strong><br>~ Fixed some minor initialization issues<br><br></li>
<li><strong>Version 1.0.1 : 18 February 2016</strong><br>~ Fixed an issue with custom CSS not showing up<br>~ Fixed an issue with the flickr feed<br><br></li>
<li><strong>Version 1.0 : 17 February 2016</strong><br>~ First release</li>
</ul>',
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'log',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => ''
      ),

      array(
        'id'          => 'alpha_tracking',
        'label'       => esc_html__( 'Analytics code', 'alpha' ),
        'desc'        => esc_html__( 'Put your Analytics code inside here. Make sure you include the entire script, not just your ID.', 'alpha' ),
        'std'         => '',
        'type'        => 'textarea-simple',
        'section'     => 'analytics',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),

      
      array(
        'id'          => 'alpha_custom_css_code',
        'label'       => esc_html__( 'Custom CSS', 'alpha' ),
        'desc'        => esc_html__( 'Write any custom css here. Please don\'t change theme files, because you won\'t be able to easily update in the future.', 'alpha' ),
        'std'         => '',
        'type'        => 'css',
        'section'     => 'css',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      ),
      array(
        'id'          => 'alpha_updates_about',
        'label'       => esc_html__( 'About', 'alpha' ),
        'desc'        => esc_html__( 'These two fields are required for the theme automatic updates. If you want to protect yourself against security attacks and have the latest features available as soon as they appear, you should complete this section, and you\'ll be notified about new theme updates whenever they appear on ThemeForest.', 'alpha' ),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'updates',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => ''
      )
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}

?>