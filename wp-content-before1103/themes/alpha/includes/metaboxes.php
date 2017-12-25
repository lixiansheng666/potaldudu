<?php

// This file contains sidebar information.

add_action( 'admin_init', 'alpha_meta_boxes' );


function alpha_meta_boxes() {

  $alpha_folio_design = array(
    'id'        => 'alpha_folio_design',
    'title' => esc_html__( 'Portfolio Settings', 'alpha' ),
    'desc' => '',
    'pages' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(

        array(
          'label' => esc_html__( 'Categories', 'alpha' ),
          'id' => 'folio_cats',
          'type' => 'taxonomy-checkbox',
          'taxonomy'    => 'portfolio_category',
          'desc' => esc_html__( 'You have the possibility to select only certain categories to appear in this portfolio page. If there is no selection, all portfolio items will appear in the grid.', 'alpha' )
        ),

        array(
          'label' => esc_html__( 'Prepended slide', 'alpha' ),
          'id' => 'desc_1',
          'type' => 'textblock-titled',
          'desc' => esc_html__( 'These options allow you to define and configure an "initial slide" will show up before all other projects. It should be used as a "description" or "intro" for the current portfolio', 'alpha')
        ),

        array(
          'label' => '',
          'id' => 'pre_enable',
          'type' => 'radio',
          'choices' => array(
            array(
              'value'       => 'yes',
              'label'       => esc_html__( 'Enable slide', 'alpha' )
            ),
            array(
              'value'       => 'no',
              'label'       => esc_html__( 'Don\'t enable slide', 'alpha' )
            )
          )
        ),

        array(
          'label' => esc_html__( 'Background color', 'alpha' ),
          'id' => 'pre_bgcolor',
          'type' => 'colorpicker'
        ),

        array(
          'label' => esc_html__( 'Background image', 'alpha' ),
          'desc' => esc_html__( 'If present, it will overwrite the background color', 'alpha' ),
          'id' => 'pre_bgimg',
          'type' => 'upload'
        ),

        array(
          'label' => esc_html__( 'Background style', 'alpha' ),
          'desc' => esc_html__( 'It affects the text color & logo/menu style.', 'alpha' ),
          'id' => 'pre_bgstyle',
          'type' => 'radio',
          'std' => 'light',
          'choices' => array(
            array(
              'value'       => 'light',
              'label'       => esc_html__( 'Light', 'alpha' )
            ),
            array(
              'value'       => 'dark',
              'label'       => esc_html__( 'Dark', 'alpha' )
            )
          )
        ),

        array(
          'label' => esc_html__( 'Title', 'alpha' ),
          'id' => 'pre_title',
          'type' => 'text'
        ),

        array(
          'label' => esc_html__( 'Subtitle', 'alpha' ),
          'id' => 'pre_subtitle',
          'type' => 'text'
        )

      )
    );


  $alpha_header_design = array(
    'id'        => 'alpha_header_design',
    'title' => esc_html__( 'Header Settings', 'alpha' ),
    'desc' => '',
    'pages' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(

        array(
          'label' => esc_html__( 'Custom header', 'alpha' ),
          'id' => 'header_enable',
          'type' => 'radio',
          'std' => 'no',
          'choices' => array(
            array(
              'value'       => 'yes',
              'label'       => esc_html__( 'Enable', 'alpha' )
            ),
            array(
              'value'       => 'no',
              'label'       => esc_html__( 'Don\'t enable', 'alpha' )
            )
          )
        ),

        array(
          'label' => esc_html__( 'Height', 'alpha' ),
          'id' => 'header_height',
          'type' => 'select',
          'desc' => '',
          'std' => '2',
          'choices' => array(
            array(
              'value'       => '4',
              'label'       => esc_html__( '25%', 'alpha' )
            ),
            array(
              'value'       => '2',
              'label'       => esc_html__( '50%', 'alpha' )
            ),
            array(
              'value'       => '1.33',
              'label'       => esc_html__( '75%', 'alpha' )
            ),
            array(
              'value'       => '1',
              'label'       => esc_html__( '100%', 'alpha' )
            )
          )
        ),

        array(
          'label' => esc_html__( 'Background color', 'alpha' ),
          'id' => 'header_bgcolor',
          'type' => 'colorpicker',
          'std' => '#fff'
        ),

        array(
          'label' => esc_html__( 'Background image', 'alpha' ),
          'desc' => esc_html__( 'If headersent, it will overwrite the background color', 'alpha' ),
          'id' => 'header_bgimg',
          'type' => 'upload',
          'std' => ''
        ),

        array(
          'label' => esc_html__( 'Background style', 'alpha' ),
          'desc' => esc_html__( 'It affects the text color & logo/menu style.', 'alpha' ),
          'id' => 'header_bgstyle',
          'type' => 'radio',
          'std' => 'light',
          'choices' => array(
            array(
              'value'       => 'light',
              'label'       => esc_html__( 'Light', 'alpha' )
            ),
            array(
              'value'       => 'dark',
              'label'       => esc_html__( 'Dark', 'alpha' )
            )
          )
        ),

        array(
          'label' => esc_html__( 'Title', 'alpha' ),
          'id' => 'header_title',
          'type' => 'text',
          'desc' => esc_html__( 'H1 element', 'alpha' )
        ),

        array(
          'label' => esc_html__( 'Subtitle', 'alpha' ),
          'id' => 'header_subtitle',
          'type' => 'text',
          'desc' => esc_html__( 'H2 element', 'alpha' )
        )

      )
    );

  $alpha_folio_header = array(
    'id'        => 'alpha_folio_header',
    'title' => esc_html__( 'Featured Image Style', 'alpha' ),
    'desc' => '',
    'pages' => array( 'portfolio', 'post' ),
    'context' => 'side',
    'priority' => 'low',
    'fields' => array(

          array(
          'label' => esc_html__( 'Background style', 'alpha' ),
          'id' => 'alpha_folio_featured_style',
          'type' => 'select',
          'std' => 'light',
          'desc' => '',
          'choices' => array(
            array(
                'value' => 'light',
                'label' => esc_html__( 'Light', 'alpha' )
                ),
            array(
                'value' => 'dark',
                'label' => esc_html__( 'Dark', 'alpha' )
                )
            )
          ),


        )
    );



  $alpha_page_type = array(
    'id'        => 'alpha_page_type',
    'title' => esc_html__( 'Page layout', 'alpha' ),
    'desc' => esc_html__( 'If you\'re using the page builder to create your content, full width should be enabled.', 'alpha'),
    'pages' => array( 'page' ),
    'context' => 'side',
    'priority' => 'high',
    'fields' => array(

          array(
          'label' => esc_html__( 'Full width', 'alpha' ),
          'id' => 'alpha_using_vc',
          'type' => 'select',
          'std' => 'using-vc',
          'desc' => '',
          'choices' => array(
            array(
                'value' => 'using-vc',
                'label' => esc_html__( 'Enabled', 'alpha' )
                ),
            array(
                'value' => 'no-vc',
                'label' => esc_html__( 'Disabled', 'alpha' )
                )
            )
          ),


        )
    );

  $alpha_folio_header_2 = array(
    'id'        => 'alpha_folio_header_2',
    'title' => esc_html__( 'Mobile Featured Image Style', 'alpha' ),
    'desc' => '',
    'pages' => array( 'portfolio' ),
    'context' => 'side',
    'priority' => 'low',
    'fields' => array(

          array(
          'label' => esc_html__( 'Background style', 'alpha' ),
          'id' => 'alpha_folio_mobile_featured_style',
          'type' => 'select',
          'std' => 'auto',
          'desc' => esc_html__( 'Change if mobile image is present and it has a different style than regular image', 'alpha' ),
          'choices' => array(
            array(
                'value' => 'auto',
                'label' => esc_html__( 'Inherit', 'alpha' )
                ),
            array(
                'value' => 'light',
                'label' => esc_html__( 'Light', 'alpha' )
                ),
            array(
                'value' => 'dark',
                'label' => esc_html__( 'Dark', 'alpha' )
                )
            )
          ),


        )
    );


  $alpha_folio_page = array(
    'id'        => 'alpha_folio_page',
    'title' => esc_html__( 'Portfolio page', 'alpha' ),
    'desc' => '',
    'pages' => array( 'portfolio' ),
    'context' => 'side',
    'priority' => 'low',
    'fields' => array(

          array(
          'label' => esc_html__( 'Choose a portfolio for this item', 'alpha' ),
          'id' => 'alpha_folio_page_select',
          'type' => 'select',
          'std' => 'a',
          'desc' => '',
          'choices' => array(
            array(
                'value' => 'a',
                'label' => esc_html__( 'Portfolio #1', 'alpha' )
                ),
            array(
                'value' => 'b',
                'label' => esc_html__( 'Portfolio #2', 'alpha' )
                ),
            array(
                'value' => 'c',
                'label' => esc_html__( 'Portfolio #3', 'alpha' )
                ),
            array(
                'value' => 'd',
                'label' => esc_html__( 'Portfolio #4', 'alpha' )
                ),
            array(
                'value' => 'e',
                'label' => esc_html__( 'Portfolio #5', 'alpha' )
                ),
            array(
                'value' => 'f',
                'label' => esc_html__( 'Portfolio #6', 'alpha' )
                ),
            array(
                'value' => 'g',
                'label' => esc_html__( 'Portfolio #7', 'alpha' )
                ),
            array(
                'value' => 'h',
                'label' => esc_html__( 'Portfolio #8', 'alpha' )
                ),
            array(
                'value' => 'i',
                'label' => esc_html__( 'Portfolio #9', 'alpha' )
                ),
            array(
                'value' => 'j',
                'label' => esc_html__( 'Portfolio #10', 'alpha' )
                )
            )
          ),


        )
    );

$alpha_contact_meta = array(
    'id'        => 'alpha_contact_meta',
    'title' => esc_html__( 'Map Options', 'alpha' ),
    'desc' => esc_html__( 'Use the following fields to configure this page\'s map. If you choose to hide the map, you could use a static image or slider, just like in any other page, however, if you choose to show the map, the static image will no longer appear.', 'alpha' ),
    'pages' => array( 'page' ),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
          'label' => esc_html__( 'Enable map', 'alpha' ),
          'id' => 'alpha_show_map',
          'type' => 'radio',
          'desc' => '',
          'std' => 'wout-custom-header-map',
          'choices' => array(
            array(
                'value' => 'w-custom-header-map',
                'label' => esc_html__( 'Enabled', 'alpha' )
                ),
            array(
                'value' => 'wout-custom-header-map',
                'label' => esc_html__( 'Disabled', 'alpha' )
                )
            )
          ),
        array(
          'label' => esc_html__( 'Map zoom level', 'alpha' ),
          'id' => 'alpha_map_zoom',
          'type' => 'text',
          'desc' => esc_html__( 'Should be a number between 1 and 21.', 'alpha' ),
          'std' => '16'
          ),
        array(
          'label' => esc_html__( 'Map style', 'alpha' ),
          'id' => 'alpha_map_style',
          'type' => 'radio',
          'desc' => '',
          'std' => 'true',
          'choices' => array(
            array(
                'value' => 'true',
                'label' => esc_html__( 'Greyscale', 'alpha' )
                ),
            array(
                'value' => 'false',
                'label' => esc_html__( 'Default', 'alpha' )
                )
            )
          ),
        array(
          'label' => esc_html__( 'Map latitude', 'alpha' ),
          'id' => 'alpha_map_lat',
          'type' => 'text',
          'desc' => esc_html__( 'Enter a latitude coordinate for the map\'s center (your POI).', 'alpha' ),
          'std' => ''
          ),
        array(
          'label' => esc_html__( 'Map longitude', 'alpha' ),
          'id' => 'alpha_map_long',
          'type' => 'text',
          'desc' => esc_html__( 'Enter a longitude coordinate for the map\'s center (your POI).', 'alpha' ),
          'std' => ''
          ),
        array(
          'label' => esc_html__( 'Show marker', 'alpha' ),
          'id' => 'alpha_map_marker',
          'type' => 'radio',
          'desc' => '',
          'std' => 'true',
          'choices' => array(
            array(
                'value' => 'true',
                'label' => esc_html__( 'Show', 'alpha' )
                ),
            array(
                'value' => 'false',
                'label' => esc_html__( 'Hide', 'alpha' )
                )
            )
          ),
        array(
          'label' => esc_html__( 'Marker image', 'alpha' ),
          'id' => 'alpha_map_img',
          'type' => 'upload',
          'desc' => esc_html__( 'Upload an image which will be the marker on your map.', 'alpha' ),
          'std' => ''
          )
        )
);

    /*---------------------------------
        INIT METABOXES
        ------------------------------------*/

    $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : 'no');
    $template_file = $post_id != 'no' ? get_post_meta($post_id,'_wp_page_template',TRUE) : 'no';

    if ( $template_file == 'template-portfolio.php' ) {
    	ot_register_meta_box($alpha_folio_design);
    } else if($template_file == 'template-contact.php') {
      ot_register_meta_box($alpha_contact_meta);
      ot_register_meta_box($alpha_header_design);
    } else {
      ot_register_meta_box($alpha_page_type);
      ot_register_meta_box($alpha_header_design);
    }

  	ot_register_meta_box($alpha_folio_header);
    ot_register_meta_box($alpha_folio_header_2);
    ot_register_meta_box($alpha_folio_page);

}

?>