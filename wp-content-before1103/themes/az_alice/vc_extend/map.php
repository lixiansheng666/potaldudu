<?php 

/*-----------------------------------------------------------------------------------*/
/*	Section - Row
/*-----------------------------------------------------------------------------------*/
vc_map_update( 'vc_row', array(
	'name' => __( 'Section/Row', AZ_THEME_NAME),
	'description' => __( 'Place content elements inside the section', AZ_THEME_NAME),
	'show_settings_on_create' => true,
	'params' => array(
		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra Section ID name', AZ_THEME_NAME),
		  	'param_name' => 'section_id',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add an ID and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra Section Class name', AZ_THEME_NAME),
		  	'param_name' => 'section_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Section Mode', AZ_THEME_NAME),
		  	'param_name' => 'section_mode',
		  	'value' => array(
		  		__('Default', AZ_THEME_NAME) 	 => 'normal', 
		  		__('Full Width', AZ_THEME_NAME)  => 'fluid',
		  		__('Full Screen', AZ_THEME_NAME) => 'full-screen'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Choose Layout Mode.<br/>Default 1170px Container.<br/>Full Width is a 100% Width Container.', AZ_THEME_NAME)
		),

		// No Padding - Margin
		array(
		  	'type' => 'checkbox',
		  	'heading' => __('No Margin and Padding', AZ_THEME_NAME),
		  	'param_name' => 'no_margin_padding',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable it if you want a container without margin and padding. Useful for sliders, maps, etc.' , AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'section_mode', 
		  		'value' => array( 'fluid' )
		  	)
		),

		// No Content Center
		array(
		  	'type' => 'checkbox',
		  	'heading' => __('No Content Center', AZ_THEME_NAME),
		  	'param_name' => 'no_content_wrap',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable it if you want a container without center the content. Useful for Google Maps Full Screen.' , AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'section_mode', 
		  		'value' => array( 'full-screen' )
		  	)
		),

		array(
		  	'type' => 'checkbox',
		  	'heading' => __('Scroll Button to Next Section', AZ_THEME_NAME),
		  	'param_name' => 'scroll_button',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable it if you want a button scroll to next section.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'section_mode', 
		  		'value' => array( 'fluid', 'full-screen' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('ID Next Section - Required', AZ_THEME_NAME),
		  	'param_name' => 'scroll_id',
		  	'description' => __('Enter ID of Next Section. For set the ID of Next Section click on Edit (pencil icon) and write your ID and copy and paste here.', AZ_THEME_NAME),
		  	'value' => '',
		  	'admin_label' => true,
		  	'dependency' => array(
		  		'element' => 'scroll_button', 
		  		'value' => array( 'yes' )
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Section Module', AZ_THEME_NAME),
		  	'param_name' => 'bg_mode',
		  	'value' => array(
		  		__('Default', AZ_THEME_NAME) 	  			=> 'default', 
		  		__('Custom Image', AZ_THEME_NAME) 			=> 'custom_image_bg',
		  		__('Custom Image Parallax', AZ_THEME_NAME) 	=> 'custom_image_bg_parallax', 
		  		__('Custom Color', AZ_THEME_NAME) 			=> 'custom', 
		  		__('Custom Video', AZ_THEME_NAME) 			=> 'video'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Choose your favorite Section Module.', AZ_THEME_NAME)
		),

		// Custom Image Parallax Settings
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Image Parallax', AZ_THEME_NAME),
		  	'param_name' => 'image_parallax',
		  	'value' => '',
		  	'description' => __('Select image from media library.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_mode', 
		  		'value' => array( 'custom_image_bg_parallax' )
		  	)
		),

		// Custom Image Settings
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Image', AZ_THEME_NAME),
		  	'param_name' => 'image',
		  	'value' => '',
		  	'description' => __('Select image from media library.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_mode', 
		  		'value' => array( 'custom_image_bg' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Background Color Image', AZ_THEME_NAME),
		  	'param_name' => 'bg_image_background_color',
		  	'description' => __('Choose a background color if you want use a transparent image.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'image',
		  		'not_empty' => true
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Background Image Position', AZ_THEME_NAME),
		  	'param_name' => 'bg_position',
		  	'value' => 
			  	array(
			  		__('Left Top', AZ_THEME_NAME) 	 	=> 'left top',
					__('Left Center', AZ_THEME_NAME) 	=> 'left center',
					__('Left Bottom', AZ_THEME_NAME) 	=> 'left bottom', 
					__('Center Top', AZ_THEME_NAME) 	=> 'center top',
					__('Center Center', AZ_THEME_NAME) 	=> 'center center',
					__('Center Bottom', AZ_THEME_NAME) 	=> 'center bottom',
					__('Right Top', AZ_THEME_NAME) 		=> 'right top',
					__('Right Center', AZ_THEME_NAME) 	=> 'right center',
					__('Right Bottom', AZ_THEME_NAME) 	=> 'right bottom'
				),
		  	'dependency' => array(
		  		'element' => 'image',
		  		'not_empty' => true
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Background Image Repeat', AZ_THEME_NAME),
		  	'param_name' => 'bg_repeat',
		  	'value' => array(
			  	__('No Repeat', AZ_THEME_NAME) 			 => 'no-repeat',
				__('Repeat', AZ_THEME_NAME) 			 => 'repeat',
				__('Repeat Horizontally', AZ_THEME_NAME) => 'repeat-x',
				__('Repeat vertically', AZ_THEME_NAME) 	 => 'repeat-y',
				__('Stretch to fit', AZ_THEME_NAME) 	 => 'stretch'
			),
		  	'dependency' => array(
		  		'element' => 'image', 
		  		'not_empty' => true
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'section_overlay',
		  	'value' => array(
		  		__('No Overlay Mask', AZ_THEME_NAME) 	=> 'no_mask_overlay', 
		  		__('Yes, Overlay Mask', AZ_THEME_NAME) 	=> 'yes_mask_overlay'
		  	),
		  	'description' => __('Enable or Disable the custom options for overlay section.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_mode', 
		  		'value' => array( 'custom_image_bg', 'custom_image_bg_parallax' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Background Color Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'section_overaly_color',
		  	'description' => __('Choose a background color overlay for your section block. Only if Overlay Mask is enabled.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'section_overlay',
		  		'value' => array( 'yes_mask_overlay' )
		  	)
		),

		// Background Color Without Image Settings
		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Background Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_bg_color',
		  	'description' => __('Select a custom background color.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_mode', 
		  		'value' => array( 'custom' )
		  	)
		),

		// Video Settings
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Video Mode', AZ_THEME_NAME),
		  	'param_name' => 'video_mode',
		  	'value' => array(
		  		__('Self-Hosted', AZ_THEME_NAME) => 'self_hosted', 
		  		__('Youtube', AZ_THEME_NAME) 	 => 'youtube_url',
		  		__('Vimeo', AZ_THEME_NAME) 		 => 'vimeo_embed_code'
		  	),
		  	'description' => __('Choose your Video Module.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_mode', 
		  		'value' => array( 'video' )
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Mobile Video Settings', AZ_THEME_NAME),
		  	'param_name' => 'custom_video_mobile_settings',
		  	'value' => array(
		  		__('New Window', AZ_THEME_NAME) => 'new-window', 
		  		__('Popup', AZ_THEME_NAME) 		=> 'lightbox'
		  	),
		  	'description' => __('Required. Choose if your video open in new window or pop-up.<br/><em>Work only with Play/Pause Video Module</em>', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_mode',
		  		'value' => array( 'video' )
		  	)
		),

		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Mobile Background Image Fallback', AZ_THEME_NAME),
		  	'param_name' => 'custom_image_video',
		  	'value' => '',
		  	'description' => __('Required. Upload your image for mobile and tablet devices.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_mode',
		  		'value' => array( 'video' )
		  	)
		),

		/* Self-Hosted */
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Self-Video Background Image Fallback', AZ_THEME_NAME),
		  	'param_name' => 'custom_image_self_video',
		  	'value' => '',
		  	'description' => __('Optional. Upload your image.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_mode',
		  		'value' => array( 'self_hosted' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('WEBM File URL', AZ_THEME_NAME),
		  	'param_name' => 'custom_video_webm',
		  	'description' => __('Required. Upload a WEBM File.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_mode', 
		  		'value' => array( 'self_hosted' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('MP4 File URL', AZ_THEME_NAME),
		  	'param_name' => 'custom_video_mp4',
		  	'description' => __('Required. Upload a MP4 File.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_mode', 
		  		'value' => array( 'self_hosted' )
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Self-Hosted Video Module', AZ_THEME_NAME),
		  	'param_name' => 'custom_video_self_hosted_module',
		  	'value' => array(
		  		__('Decorative', AZ_THEME_NAME) => 'decorative_video_self_hosted', 
		  		__('Play/Pause', AZ_THEME_NAME) => 'play_pause_video_self_hosted'
		  	),
		  	'description' => __('Choose Self Hosted Background Module.<br/><strong>Decorative</strong>: The video has autoplay, loop and mute audio enabled.<br/><strong>Play/Pause</strong>: The video has autoplay, loop and mute disabled. You can play &amp; pause the video with a click, remember with this module NOT insert any content into the section.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_mode',
		  		'value' => array( 'self_hosted' )
		  	)
		),

		/* Youtube */
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Youtube Background Image Fallback', AZ_THEME_NAME),
		  	'param_name' => 'custom_image_youtube_video',
		  	'value' => '',
		  	'description' => __('Optional. Upload your image.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_mode',
		  		'value' => array( 'youtube_url' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Youtube Video ID', AZ_THEME_NAME),
		  	'param_name' => 'custom_video_youtube',
		  	'description' => __('Enter only ID video from Youtube.<br/>Example: 3XviR7esUvo', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_mode', 
		  		'value' => array( 'youtube_url' )
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Youtube Video Module', AZ_THEME_NAME),
		  	'param_name' => 'custom_video_youtube_module',
		  	'value' => array(
		  		__('Decorative', AZ_THEME_NAME) => 'decorative_video_youtube', 
		  		__('Play/Pause', AZ_THEME_NAME) => 'play_pause_video_youtube'
		  	),
		  	'description' => __('Choose Youtube Background Module.<br/><strong>Decorative</strong>: The video has autoplay, loop and mute audio enabled.<br/><strong>Play/Pause</strong>: The video has autoplay, loop and mute disabled. You can play &amp; pause the video with a click, remember with this module NOT insert any content into the section.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_mode',
		  		'value' => array( 'youtube_url' )
		  	)
		),

		/* Vimeo */
		array(
  			'type' => 'textfield',
			'heading' => __('Vimeo Video ID', AZ_THEME_NAME),
			'param_name' => 'custom_video_vimeo',
			'description' => __('Enter only ID video from Vimeo.<br/>Example: 116214074', AZ_THEME_NAME),
			'dependency' => array(
				'element' => 'video_mode', 
				'value' => array( 'vimeo_embed_code' )
			)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Vimeo Video Module', AZ_THEME_NAME),
		  	'param_name' => 'custom_video_vimeo_module',
		  	'value' => array(
		  		__('Decorative', AZ_THEME_NAME) => 'decorative_video_vimeo', 
		  		__('Play/Pause', AZ_THEME_NAME) => 'play_pause_video_vimeo'
		  	),
		  	'description' => __('Choose Vimeo Background Module.<br/><strong>Decorative</strong>: The video has autoplay, loop and mute audio enabled.<br/><strong>Play/Pause</strong>: The video has autoplay, loop and mute disabled. You can play &amp; pause the video with a click, remember with this module NOT insert any content into the section.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_mode', 
		  		'value' => array( 'vimeo_embed_code' )
		  	)
		),

		// Video Overlay
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Video Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'video_overlay',
		  	'value' => array(
		  		__('No Overlay Mask', AZ_THEME_NAME) 	=> 'no_video_overlay', 
		  		__('Yes, Overlay Mask', AZ_THEME_NAME) 	=> 'yes_video_overlay'
		  	),
		  	'description' => __('Enable or Disable the custom options for video overlay section.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_mode', 
		  		'value' => array( 'video' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Video Overlay Color', AZ_THEME_NAME),
		  	'param_name' => 'video_color_overlay',
		  	'description' => __('Select a custom color for video overlay block. Only if Video Overlay Mask is enabled.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_overlay', 
		  		'value' => array( 'yes_video_overlay' )
		  	)
		),

		// Pattern Settings
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Pattern Image', AZ_THEME_NAME),
		  	'param_name' => 'pattern',
		  	'value' => '',
		  	'description' => __('Optional. Select a pattern from media library.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_mode', 
		  		'value' => array( 'custom_image_bg', 'custom_image_bg_parallax', 'custom', 'video' )
		  	)
		),

		// Padding Settings
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Section Padding', AZ_THEME_NAME),
		  	'param_name' => 'padding',
		  	'value' => array(
		  		__('No Padding', AZ_THEME_NAME) 	 => 'no-padding', 
		  		__('Small Padding', AZ_THEME_NAME) 	 => 'small-padding', 
		  		__('Default Padding', AZ_THEME_NAME) => 'default-padding', 
		  		__('Large Padding', AZ_THEME_NAME) 	 => 'large-padding', 
		  		__('Custom Padding', AZ_THEME_NAME)  => 'custom-padding'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Define the sections top and bottom padding.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Padding Top', AZ_THEME_NAME),
		  	'param_name' => 'padding_top_value',
		  	'description' => __('Padding Top value in pixel. Enter only number value. Default value is 70.', AZ_THEME_NAME),
		  	'value' => '70',
		  	'dependency' => array(
		  		'element' => 'padding',
		  		'value' => array( 'custom-padding' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Padding Bottom', AZ_THEME_NAME),
		  	'param_name' => 'padding_bottom_value',
		  	'description' => __('Padding Bottom value in pixel. Enter only number value. Default value is 70.', AZ_THEME_NAME),
		  	'value' => '70',
		  	'dependency' => array(
		  		'element' => 'padding', 
		  		'value' => array( 'custom-padding' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra Row Class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Section Colors Detect */
		$sections_colors_check
	)
));


vc_map_update( 'vc_row_inner', array(
	'params' => array(
	  	array(
	    	'type' => 'textfield',
	    	'heading' => __('Extra class name', AZ_THEME_NAME),
	    	'param_name' => 'el_class',
	    	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
	  	)
	),
));


/*-----------------------------------------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------------------------------------*/

global $vc_column_width_list;
$vc_column_width_list = array(
	__( '1 column - 1/12', AZ_THEME_NAME ) 	  => '1/12',
	__( '2 columns - 1/6', AZ_THEME_NAME ) 	  => '1/6',
	__( '3 columns - 1/4', AZ_THEME_NAME ) 	  => '1/4',
	__( '4 columns - 1/3', AZ_THEME_NAME ) 	  => '1/3',
	__( '5 columns - 5/12', AZ_THEME_NAME )   => '5/12',
	__( '6 columns - 1/2', AZ_THEME_NAME ) 	  => '1/2',
	__( '7 columns - 7/12', AZ_THEME_NAME )   => '7/12',
	__( '8 columns - 2/3', AZ_THEME_NAME ) 	  => '2/3',
	__( '9 columns - 3/4', AZ_THEME_NAME ) 	  => '3/4',
	__( '10 columns - 5/6', AZ_THEME_NAME )   => '5/6',
	__( '11 columns - 11/12', AZ_THEME_NAME ) => '11/12',
	__( '12 columns - 1/1', AZ_THEME_NAME )   => '1/1'
);

vc_map_update( 'vc_column', array(
	'params' => array(
		
		array(
			'type' => 'dropdown',
			'heading' => __('Width', AZ_THEME_NAME),
			'param_name' => 'width',
			'value' => $vc_column_width_list,
			'description' => __('Select column width.', AZ_THEME_NAME),
			'std' => '1/1'
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Column Mode', AZ_THEME_NAME),
		  	'param_name' => 'column_mode',
		  	'value' => array(
		  		__('Default', AZ_THEME_NAME) => 'default',
		  		__('Custom Image', AZ_THEME_NAME) => 'custom_col_image_bg',
		  		__('Custom Color', AZ_THEME_NAME) => 'custom_col_color'
		  	),
		  	'description' => __('Choose your favorite Column Module.', AZ_THEME_NAME)
		),

		// Custom Image Settings
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Image', AZ_THEME_NAME),
		  	'param_name' => 'image',
		  	'value' => '',
		  	'description' => __('Select image from media library.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'column_mode',
		  		'value' => array( 'custom_col_image_bg' )
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Background Image Position', AZ_THEME_NAME),
		  	'param_name' => 'bg_col_position',
		  	'value' => array(
			  	__('Left Top', AZ_THEME_NAME) 	 	=> 'left top',
				__('Left Center', AZ_THEME_NAME) 	=> 'left center',
				__('Left Bottom', AZ_THEME_NAME) 	=> 'left bottom', 
				__('Center Top', AZ_THEME_NAME) 	=> 'center top',
				__('Center Center', AZ_THEME_NAME) 	=> 'center center',
				__('Center Bottom', AZ_THEME_NAME) 	=> 'center bottom',
				__('Right Top', AZ_THEME_NAME) 		=> 'right top',
				__('Right Center', AZ_THEME_NAME) 	=> 'right center',
				__('Right Bottom', AZ_THEME_NAME) 	=> 'right bottom'
			),
		  	'dependency' => array(
		  		'element' => 'image', 
		  		'not_empty' => true
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Background Image Repeat', AZ_THEME_NAME),
		  	'param_name' => 'bg_col_repeat',
		  	'value' => array(
			  	__('No Repeat', AZ_THEME_NAME) 			 => 'no-repeat',
				__('Repeat', AZ_THEME_NAME) 			 => 'repeat',
				__('Repeat Horizontally', AZ_THEME_NAME) => 'repeat-x',
				__('Repeat vertically', AZ_THEME_NAME) 	 => 'repeat-y',
				__('Stretch to fit', AZ_THEME_NAME) 	 => 'stretch'
			),
		  	'dependency' => array(
		  		'element' => 'image', 
		  		'not_empty' => true
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'bg_column_overlay',
		  	'value' => array(
		  		__('No Overlay Mask', AZ_THEME_NAME) 	=> 'no_mask_overlay', 
		  		__('Yes, Overlay Mask', AZ_THEME_NAME) 	=> 'yes_mask_overlay'
		  	),
		  	'description' => __('Enable or Disable the custom options for overlay column.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'column_mode', 
		  		'value' => array( 'custom_col_image_bg' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Background Color Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'bg_column_overaly_color',
		  	'description' => __('Choose a background color overlay for your column block. Only if Overlay Mask is enabled.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'bg_column_overlay', 
		  		'value' => array( 'yes_mask_overlay' )
		  	)
		),

		// Custom Column Color
		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Background Color', AZ_THEME_NAME),
		  	'param_name' => 'custom_bg_color',
		  	'description' => __('Select a custom background color.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'column_mode', 
		  		'value' => array( 'custom_col_color' )
		  	)
		),

	  	array(
	    	'type' => 'textfield',
	    	'heading' => __('Extra class name', AZ_THEME_NAME),
	    	'param_name' => 'el_class',
	    	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

	  	/* Equals Col Height Group */
		array(
		  	'type' => 'checkbox',
		  	'group' => __( 'Equals Col Height', AZ_THEME_NAME ),
		  	'heading' => __('Equals Columns Height Script?', AZ_THEME_NAME),
		  	'param_name' => 'equals_col_height',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'description' => __('Enable Equals Columns Height!', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'checkbox',
		  	'group' => __( 'Equals Col Height', AZ_THEME_NAME ),
		  	'heading' => __('Vertical Center Text?', AZ_THEME_NAME),
		  	'param_name' => 'vertical_center_text',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'description' => __('Enable Vertical Center Text.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'equals_col_height', 
		  		'value' => array( 'yes' )
		  	)
		),

		array(
		  	'type' => 'checkbox',
		  	'group' => __( 'Equals Col Height', AZ_THEME_NAME ),
		  	'heading' => __('Vertical Center Text on Mobile/Tablet Devices?', AZ_THEME_NAME),
		  	'param_name' => 'vertical_center_text_mobile',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'description' => __('Enable Vertical Center Text on Mobile/Tablet Devices.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'equals_col_height', 
		  		'value' => array( 'yes' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'group' => __( 'Equals Col Height', AZ_THEME_NAME ),
		  	'heading' => __('Min Column Height', AZ_THEME_NAME),
		  	'param_name' => 'min_column_height',
		  	'description' => __('Define the min-height of the column in pixel. It is useful for tablet/mobile devices if you use a column image/color mode without text inside the column. Enter only number value. Default value is 350.', AZ_THEME_NAME),
		  	'value' => '350',
		  	'dependency' => array(
		  		'element' => 'equals_col_height', 
		  		'value' => array( 'yes' )
		  	)
		),

		array(
		  	'type' => 'checkbox',
		  	'group' => __( 'Equals Col Height', AZ_THEME_NAME ),
		  	'heading' => __('Remove Padding?', AZ_THEME_NAME),
		  	'param_name' => 'remove_col_padding',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'description' => __('Remove the padding around the column.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'equals_col_height', 
		  		'value' => array( 'yes' )
		  	)
		),

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
));

vc_map_update( 'vc_column_inner', array(
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __('Width', AZ_THEME_NAME),
			'param_name' => 'width',
			'value' => $vc_column_width_list,
			'description' => __('Select column width.', AZ_THEME_NAME),
			'std' => '1/1'
		),

	  	array(
	    	'type' => 'textfield',
	    	'heading' => __('Extra class name', AZ_THEME_NAME),
	    	'param_name' => 'el_class',
	    	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
	  	)
	  	
	),
));

/*-----------------------------------------------------------------------------------*/
/*	Accordions
/*-----------------------------------------------------------------------------------*/
vc_map_update( 'vc_accordion', array(
	'deprecated' => '4.8',
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Toggle ID', AZ_THEME_NAME ),
			'param_name' => 'toggle_id',
			'description' => __( 'Optional. Insert an ID for have a toggle effect. Leave blank if you want a simple accordion.', AZ_THEME_NAME )
		),

	  	array(
	    	'type' => 'textfield',
	    	'heading' => __('Extra class name', AZ_THEME_NAME),
	    	'param_name' => 'el_class',
	    	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
	  	)
	),
));

vc_map_update( 'vc_accordion_tab', array(
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', AZ_THEME_NAME ),
			'param_name' => 'title',
			'description' => __( 'Accordion section title.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Toggle Parent ID', AZ_THEME_NAME ),
			'param_name' => 'toggle_id_parent',
			'description' => __( 'Optional. Copy the same ID from accordion element for have a toggle effect. Leave blank if you want a simple accordion.', AZ_THEME_NAME )
		),

		array(
			'type' => 'checkbox',
			'heading' => __( 'Collapse', AZ_THEME_NAME ),
			'param_name' => 'collapsible',
			'description' => __( 'Select checkbox to allow section to be collapsible.', AZ_THEME_NAME ),
			'value' => array( __( 'Allow', AZ_THEME_NAME ) => 'yes' )
		)
	),
));


/*-----------------------------------------------------------------------------------*/
/*	Special Heading
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Special_Heading extends WPBakeryShortCode {}
vc_map(array(
	'name' => __('Special Heading', AZ_THEME_NAME),
	'description' => __( 'A special heading text block', AZ_THEME_NAME),
	'base' => 'az_special_heading',
	'icon' => 'icon-wpb-layer-shape-text',
	'category' => __('Content', AZ_THEME_NAME),
	'params' => array(
		
		array(
    		'type' => 'textfield',
    		'heading' => __('Heading Title', AZ_THEME_NAME),
    		'param_name' => 'special_heading_title',
    		'value' => '',
    		'admin_label' => true,
    		'description' => __('Required. Enter the your title. You can use only br html tag.', AZ_THEME_NAME)
    	),

    	array(
    		'type' => 'textfield',
    		'heading' => __('Heading Sub Title', AZ_THEME_NAME),
    		'param_name' => 'special_heading_subtitle',
    		'value' => '',
    		'admin_label' => true,
    		'description' => __('Optional. Enter the your sub-title. You can use only br html tag.', AZ_THEME_NAME)
    	),

    	array(
			'type' => 'dropdown',
			'heading' => __('Colors Mode', AZ_THEME_NAME),
			'param_name' => 'special_heading_colors_mode',
			'value' => array(
				__('Default', AZ_THEME_NAME) => 'default-special-heading-color',
				__('Custom', AZ_THEME_NAME)  => 'custom-special-heading-color'
			),
			'admin_label' => true,
			'description' => __('Select the special heading color mode.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Special Heading Color Master', AZ_THEME_NAME),
		  	'param_name' => 'special_heading_master_color',
		  	'description' => __('Choose a color for your title and subtitle.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'special_heading_colors_mode',
		  		'value' => array( 'custom-special-heading-color' )
		  	)
		),

		array(
		  	'type' => 'checkbox',
		  	'heading' => __('Wrap Special Heading in a link?', AZ_THEME_NAME),
		  	'param_name' => 'special_heading_wrap_link',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'description' => __('Enable a URL link for the current special heading block.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Link URL', AZ_THEME_NAME),
		  	'param_name' => 'special_heading_wrap_link_url',
		  	'description' => __('Where should your special heading box link to?', AZ_THEME_NAME),
		  	'value' => '',
		  	'dependency' => array(
		  		'element' => 'special_heading_wrap_link', 
		  		'value' => 'yes',
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', AZ_THEME_NAME ),
			'param_name' => 'special_heading_link_target',
			'value' => $target_arr,
		  	'dependency' => array(
		  		'element' => 'special_heading_wrap_link', 
		  		'value' => 'yes',
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Typo */
		$responsive_typo_check,
		$responsive_typo_default,
		$responsive_typo_medium,
		$responsive_typo_small,
		$responsive_typo_very_small,
		$responsive_typo_ultra_small,
		
		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
));


/*-----------------------------------------------------------------------------------*/
/*	Text Block
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Column_Text extends WPBakeryShortCode {}
vc_map(array(
	'name' => __('Text Block', AZ_THEME_NAME),
	'description' => __( 'A block of text with WYSIWYG editor', AZ_THEME_NAME),
	'base' => 'az_column_text',
	'icon' => 'icon-wpb-layer-shape-text',
	'category' => __('Content', AZ_THEME_NAME),
	'wrapper_class' => 'clearfix',
	'params' => array(
		array(
		  	'type' => 'textarea_html',
		  	'holder' => 'div',
		  	'heading' => __('Text', AZ_THEME_NAME),
		  	'param_name' => 'content',
		  	'value' => __('I am text block. Click edit button to change this text.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
));

/*-----------------------------------------------------------------------------------*/
/*	Button
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Button extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Button', AZ_THEME_NAME),
	'description' => __('Eye catching button', AZ_THEME_NAME),
    'base'		=> 'az_button',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

    	array(
    		'type' => 'textfield',
    		'heading' => __('Button Text', AZ_THEME_NAME),
    		'param_name' => 'button_text',
    		'value' => '',
    		'admin_label' => true,
    		'description' => __('Enter the your text, this appear on your button.', AZ_THEME_NAME)
    	),

    	array(
    		'type' => 'dropdown',
    		'heading' => __('Button Alignment', AZ_THEME_NAME),
    		'param_name' => 'button_alignment',
    		'value' => array(
    			__('No Align', AZ_THEME_NAME) 	  => 'noalign',
    			__('Left Align', AZ_THEME_NAME)   => 'textalignleft',
    			__('Center Align', AZ_THEME_NAME) => 'textaligncenter',
    			__('Right Align', AZ_THEME_NAME)  => 'textalignright'
    		),
    		'admin_label' => true,
    		'description' => __('Select the button alignment.', AZ_THEME_NAME)
    	),

    	array(
    		'type' => 'textfield',
    		'heading' => __('Button Link URL', AZ_THEME_NAME),
    		'param_name' => 'button_link_url',
    		'admin_label' => true,
    		'description' => __('Where should your button link to?', AZ_THEME_NAME)
    	),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Button Link Target', AZ_THEME_NAME ),
			'param_name' => 'button_link_target',
			'value' => $target_arr
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Button Colors Mode', AZ_THEME_NAME),
			'param_name' => 'button_colors_mode',
			'value' => array(
				__('Default', AZ_THEME_NAME) => 'default-btn-color',
				__('Custom', AZ_THEME_NAME)  => 'custom-btn-color'
			),
			'admin_label' => true,
			'description' => __('Select the button colors mode.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Color Master', AZ_THEME_NAME),
		  	'param_name' => 'button_master_color',
		  	'description' => __('Choose a color for your button.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'button_colors_mode',
		  		'value' => array( 'custom-btn-color' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Color Hover', AZ_THEME_NAME),
		  	'param_name' => 'button_master_color_hover',
		  	'description' => __('Choose a color for your button hover state.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'button_colors_mode',
		  		'value' => array( 'custom-btn-color' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Color Text', AZ_THEME_NAME),
		  	'param_name' => 'button_master_color_text',
		  	'description' => __('Choose a color for your button text.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'button_colors_mode',
		  		'value' => array( 'custom-btn-color' )
		  	)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Button Color Text Hover', AZ_THEME_NAME),
		  	'param_name' => 'button_master_color_hover_text',
		  	'description' => __('Choose a color for your button text hover state.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'button_colors_mode',
		  		'value' => array( 'custom-btn-color' )
		  	)
		),

		array(
		  	'type' => 'checkbox',
		  	'heading' => __('Inverted Color?', AZ_THEME_NAME),
		  	'param_name' => 'inverted_enabled',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'description' => __('Inverted Colors for your button.', AZ_THEME_NAME)
		),

		$icon_mode,
		$icon_dropdown,
		$alice_icon_pack,
		$alice_icon_social_pack,
		$linecons_icon_pack,
		$steady_icon_pack,
		$vicons_icon_pack,
		$fontawesome_icon_pack,

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
    )
));


/*-----------------------------------------------------------------------------------*/
/*	Divider & Blank Divider ( Empty Space )
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Divider extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Divider', AZ_THEME_NAME),
	'description' => __( 'Horizontal separator line', AZ_THEME_NAME),
    'base'		=> 'az_divider',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(

    	array(
		  	'type' => 'textfield',
		  	'heading' => __('Divider Number Text', AZ_THEME_NAME),
		  	'param_name' => 'divider_number_text',
		  	'value' => '01',
		  	'admin_label' => true,
		  	'description' => __('Required. Enter a number text for divider. Only number.', AZ_THEME_NAME)
		),

    	array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Divider Color', AZ_THEME_NAME),
		  	'param_name' => 'divider_color',
		  	'description' => __('Optional. Choose a color for your divider.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Text Color', AZ_THEME_NAME),
		  	'param_name' => 'divider_text_color',
		  	'description' => __('Optional. Choose a color for your text divider.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Margin Top Value', AZ_THEME_NAME),
		  	'param_name' => 'margin_top_value',
		  	'value' => '',
		  	'admin_label' => true,
		  	'description' => __('Margin Top Value in pixel. Enter only number value. Default value is 60.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Margin Bottom Value', AZ_THEME_NAME),
		  	'param_name' => 'margin_bottom_value',
		  	'value' => '',
		  	'admin_label' => true,
		  	'description' => __('Margin Bottom Value in pixel. Enter only number value. Default value is 60.', AZ_THEME_NAME)
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
    )
));


class WPBakeryShortCode_AZ_Blank_Divider extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Blank Divider', AZ_THEME_NAME),
	'description' => __('Blank space with custom height', AZ_THEME_NAME),
    'base'		=> 'az_blank_divider',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(
		array(
		  	'type' => 'textfield',
		  	'heading' => __('Height Value', AZ_THEME_NAME),
		  	'param_name' => 'height_value',
		  	'admin_label' => true,
		  	'description' => __('Height Value in pixel. Enter only number value. Default value is 20.', AZ_THEME_NAME),
		  	'value' => '20'
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs
    )
));

/*-----------------------------------------------------------------------------------*/
/*	Box Icons
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Box_Icon extends WPBakeryShortCode {}
vc_map(array(
	'name'		=> __('Box Icon', AZ_THEME_NAME),
	'description' => __( 'Display Box Icon Service', AZ_THEME_NAME),
    'base'		=> 'az_box_icon',
    'icon'      => 'icon-wpb-ui-empty_space',
	'category' 	=> __('Content', AZ_THEME_NAME),
	'show_settings_on_create' => true,
    'params'	=> array(
		array(
			'type' => 'dropdown',
			'heading' => __( 'Box Icon Module', AZ_THEME_NAME ),
			'param_name' => 'box_icon_module',
			'value' => array(
				__('Normal', AZ_THEME_NAME) => 'box-default',
				__('Icon', AZ_THEME_NAME) => 'box-icon',
				__('Image', AZ_THEME_NAME) => 'box-image',
				__('SVG Image', AZ_THEME_NAME) => 'box-svg',
			),
			'admin_label' => true,
			'description' => __( 'Choose Box Icon Module.<br/>Remember to select the <strong>Full-Width Section</strong> and enabled the <strong>No Margin and Padding</strong> option.', AZ_THEME_NAME )
		),

		array(
		  	'type' => 'checkbox',
		  	'heading' => __('Wrap Box Icon in a link?', AZ_THEME_NAME),
		  	'param_name' => 'box_wrap_link',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'description' => __('Enable a URL link for the current box icon.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Link URL', AZ_THEME_NAME),
		  	'param_name' => 'box_wrap_link_url',
		  	'description' => __('Where should your box icon link to?', AZ_THEME_NAME),
		  	'value' => '',
		  	'dependency' => array(
		  		'element' => 'box_wrap_link', 
		  		'value' => 'yes',
		  	)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', AZ_THEME_NAME ),
			'param_name' => 'box_icon_target',
			'value' => $target_arr,
		  	'dependency' => array(
		  		'element' => 'box_wrap_link', 
		  		'value' => 'yes',
		  	)
		),

		// Icon
		array(
			'type' => 'dropdown',
			'heading' => __('Icon Mode', AZ_THEME_NAME),
			'param_name' => 'icon_mode',
			'value' => array(
				__('No', AZ_THEME_NAME) => 'no-icon',
				__('Yes', AZ_THEME_NAME)  => 'yes-icon'
			),
			'description' => __('Should an icon?', AZ_THEME_NAME),
			'dependency' => array(
				'element' => 'box_icon_module',
				'value' => 'box-icon',
			)
		),

		$icon_size,
		$icon_color,
		$icon_dropdown,
		$alice_icon_pack,
		$alice_icon_social_pack,
		$linecons_icon_pack,
		$steady_icon_pack,
		$vicons_icon_pack,
		$fontawesome_icon_pack,

		// Image and SVG
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Image', AZ_THEME_NAME),
		  	'param_name' => 'image',
		  	'value' => '',
		  	'description' => __('Select image from media library.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'box_icon_module',
		  		'value' => array( 'box-image', 'box-svg' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'SVG Image Size', AZ_THEME_NAME ),
			'param_name' => 'svg_img_size',
			'value' => '75x75',
			'description' => __( 'Required. Enter image size in pixels like this example: 200x100 (Width x Height).', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'box_icon_module',
				'value' => 'box-svg',
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Box Title', AZ_THEME_NAME),
			'param_name' => 'box_icon_title',
			'value' => 'Your Title...',
			'description' => __('Required. Enter your Box Icon Title here.', AZ_THEME_NAME)
		),

		array(
			'type' => 'textarea_html',
			'heading' => __('Box Text', AZ_THEME_NAME),
			'param_name' => 'content',
			'value' => '',
			'description' => __('Required. Enter your Box Icon Text here.', AZ_THEME_NAME)
		),

        array(
		  	'type' => 'textfield',
		  	'heading' => __('Extra class name', AZ_THEME_NAME),
		  	'param_name' => 'el_class',
		  	'admin_label' => true,
		  	'description' => __('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME)
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
    )
));


/*-----------------------------------------------------------------------------------*/
/*	Team
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Team_Grid extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Team Grid', AZ_THEME_NAME ),
	'base' => 'az_team_grid',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Team Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Team Layout Mode', AZ_THEME_NAME ),
			'param_name' => 'team_layout_mode',
			'value' => array(
				__('Grid Full-Width', AZ_THEME_NAME) => 'grid-ly-team'
			),
			'description' => __( 'Choose Team Layout Mode.<br/>Remember to select the <strong>Full-Width Section</strong> and enabled the <strong>No Margin and Padding</strong> option.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Team Module', AZ_THEME_NAME ),
			'param_name' => 'team_module',
			'value' => array(
				__('Classic', AZ_THEME_NAME) => 'classic-module',
				__('Creative', AZ_THEME_NAME) => 'creative-module'
			),
			'admin_label' => true,
			'description' => __( 'Choose Team Module.<br/>Classic: Open the team links into the respective single post.<br/>Creative: Open the team links via modal pop-up.', AZ_THEME_NAME )
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Creative Module for Mobile/Tablet devices', AZ_THEME_NAME),
		  	'param_name' => 'creative_module_mobile_check',
		  	'value' => array(
				__('No', AZ_THEME_NAME) => 'no',
				__('Yes', AZ_THEME_NAME) => 'yes'
			),
		  	'description' => __('You can disable the creative module for mobile and tablet devices, if disabled the team posts works like classic module.' , AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'team_module',
				'value' => array( 'creative-module' )
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', AZ_THEME_NAME ),
			'param_name' => 'team_columns_count',
			'value' => array(
				__( '2 Columns', AZ_THEME_NAME ) => '2clm',
				__( '3 Columns', AZ_THEME_NAME ) => '3clm',
				__( '4 Columns', AZ_THEME_NAME ) => '4clm',
				__( '5 Columns', AZ_THEME_NAME ) => '5clm',
				__( '6 Columns', AZ_THEME_NAME ) => '6clm'
			),
			'admin_label' => true,
			'description' => __( 'How many columns should be displayed?', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'team_layout_mode',
				'value' => array( 'grid-ly-team' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Featured Image Size', AZ_THEME_NAME ),
			'param_name' => 'featured_img_size',
			'value' => '700x700',
			'admin_label' => true,
			'description' => __( 'Required. Enter image size in pixels like this example: 200x100 (Width x Height).', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'team_layout_mode',
				'value' => array( 'grid-ly-team' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Team Post Number', AZ_THEME_NAME ),
			'param_name' => 'team_post_number',
			'admin_label' => true,
			'description' => __( 'How many post to show? Enter number or word "All". Defaul value is All.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Team Post Disciplines', AZ_THEME_NAME ),
			'param_name' => 'team_categories',
			'admin_label' => true,
			'description' => __( 'If you want to show only certain team categories/disciplines, not the entire team posts, please write the categories in this field, separated by commas. Please use the <strong>disciplines slug</strong>, not the title.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', AZ_THEME_NAME ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', AZ_THEME_NAME ) => 'date',
				__( 'ID', AZ_THEME_NAME ) => 'ID',
				__( 'Author', AZ_THEME_NAME ) => 'author',
				__( 'Title', AZ_THEME_NAME ) => 'title',
				__( 'Modified', AZ_THEME_NAME ) => 'modified',
				__( 'Random', AZ_THEME_NAME ) => 'rand',
				__( 'Menu Order', AZ_THEME_NAME ) => 'menu_order'
			),
			'admin_label' => true,
			'description' => sprintf(__('Select how to sort retrieved posts. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order way', AZ_THEME_NAME ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', AZ_THEME_NAME ) => 'DESC',
				__( 'Ascending', AZ_THEME_NAME ) => 'ASC'
			),
			'admin_label' => true,
			'description' => sprintf(__('Designates the ascending or descending order. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Portfolio
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Portfolio_Grid extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Portfolio Grid', AZ_THEME_NAME ),
	'base' => 'az_portfolio_grid',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Portfolio Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Portfolio Layout Mode', AZ_THEME_NAME ),
			'param_name' => 'portfolio_layout_mode',
			'value' => array(
				__('Grid Full-Width', AZ_THEME_NAME) => 'grid-ly-portfolio',
				__('Masonry Full-Width', AZ_THEME_NAME) => 'masonry-ly-portfolio'
			),
			'admin_label' => true,
			'description' => __( 'Choose Portfolio Layout Mode.<br/>Remember to select the <strong>Full-Width Section</strong> and enabled the <strong>No Margin and Padding</strong> option.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Portfolio Module', AZ_THEME_NAME ),
			'param_name' => 'portfolio_module',
			'value' => array(
				__('Classic', AZ_THEME_NAME) => 'classic-module',
				__('Creative', AZ_THEME_NAME) => 'creative-module'
			),
			'admin_label' => true,
			'description' => __( 'Choose Portfolio Module.<br/>Classic: Open the portfolio links into the respective single post.<br/>Creative: Open the portfolio links via modal pop-up.', AZ_THEME_NAME )
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Creative Module for Mobile/Tablet devices', AZ_THEME_NAME),
		  	'param_name' => 'creative_module_mobile_check',
		  	'value' => array(
				__('No', AZ_THEME_NAME) => 'no',
				__('Yes', AZ_THEME_NAME) => 'yes'
			),
		  	'description' => __('You can disable the creative module for mobile and tablet devices, if disabled the portfolio posts works like classic module.' , AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'portfolio_module',
				'value' => array( 'creative-module' )
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', AZ_THEME_NAME ),
			'param_name' => 'portfolio_columns_count',
			'value' => array(
				__( '2 Columns', AZ_THEME_NAME ) => '2clm',
				__( '3 Columns', AZ_THEME_NAME ) => '3clm',
				__( '4 Columns', AZ_THEME_NAME ) => '4clm',
				__( '5 Columns (Only Grid)', AZ_THEME_NAME ) => '5clm',
				__( '6 Columns (Only Grid)', AZ_THEME_NAME ) => '6clm'
			),
			'admin_label' => true,
			'description' => __( 'How many columns should be displayed?', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Featured Image Size for Grid Portfolio', AZ_THEME_NAME ),
			'param_name' => 'grid_featured_img_size',
			'value' => '700x700',
			'description' => __( 'Required. Enter image size in pixels like this example: 200x100 (Width x Height).', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'portfolio_layout_mode',
				'value' => array( 'grid-ly-portfolio' )
			)
		),

		array(
			'type' => 'checkbox',
			'heading' => __('Colorize Effect', AZ_THEME_NAME),
			'param_name' => 'portfolio_colorize_effect',
			'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Enable or Disable the Colorize Effect.<br/>You can set different hover color for each single portfolio post. You can set the colors in Portfolio Metabox inside the respective single portfolio post.', AZ_THEME_NAME)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Sorting and Filtering', AZ_THEME_NAME),
			'param_name' => 'portfolio_filter_mode',
			'value' => array(
				__('No', AZ_THEME_NAME) => 'no',
				__('Yes', AZ_THEME_NAME) => 'yes'
			),
			'admin_label' => true,
			'description' => __('Should the sorting options based on project-category be displayed? Disable if you want display only a single custom portfolio project-category.', AZ_THEME_NAME)
		),

		array(
			'type' => 'textfield',
			'heading' => __('Portfolio Sorting Name', AZ_THEME_NAME),
			'param_name' => 'portfolio_filter_name',
			'value' => 'All',
			'description' => __('Enter sorting name. Defaul value is All', AZ_THEME_NAME),
			'dependency' => array(
				'element' => 'portfolio_filter_mode',
				'value' => array( 'yes' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Exclude Portfolio Category ID Filter', AZ_THEME_NAME ),
			'param_name' => 'portfolio_filter_exclude_cat',
			'admin_label' => true,
			'description' => __( 'If you want to exclude only certain portfolio categories from filter, please write the project-category ID in this field, separated by commas. Please use the <strong>project-category ID</strong>, not the title or slug.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'portfolio_filter_mode',
				'value' => array( 'yes' )
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Pagination', AZ_THEME_NAME),
			'param_name' => 'portfolio_pagination',
			'value' => array(
				__('No', AZ_THEME_NAME) => 'no',
				__('Yes', AZ_THEME_NAME) => 'yes'
			),
			'admin_label' => true,
			'description' => __('Enable if you want a Pagination.', AZ_THEME_NAME)
		),

		array(
			'type' => 'dropdown',
			'heading' => __('Pagination Mode', AZ_THEME_NAME),
			'param_name' => 'portfolio_pagination_mode',
			'value' => array(
				__('Classic', AZ_THEME_NAME) => 'classic-pag',
				__('Infinite Scroll', AZ_THEME_NAME) => 'infinite-pag'
			),
			'admin_label' => true,
			'description' => __('Select your favorite pagination mode.<br>The infinite scroll not work if you have enabled the Portfolio Creative Module.', AZ_THEME_NAME),
			'dependency' => array(
				'element' => 'portfolio_pagination',
				'value' => array( 'yes' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Portfolio Post Number', AZ_THEME_NAME ),
			'param_name' => 'portfolio_post_number',
			'admin_label' => true,
			'description' => __( 'How many post to show? Enter number or word "All". Defaul value is All.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Portfolio Post Category', AZ_THEME_NAME ),
			'param_name' => 'portfolio_categories',
			'admin_label' => true,
			'description' => __( 'If you want to show only certain portfolio categories, not the entire portfolio posts, please write the categories in this field, separated by commas. Please use the <strong>project-category slug</strong>, not the title.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Exclude Portfolio Post Category', AZ_THEME_NAME ),
			'param_name' => 'portfolio_categories_exclude',
			'admin_label' => true,
			'description' => __( 'If you want to exclude only certain portfolio categories and show the others portfolio posts, please write the categories in this field, separated by commas. Please use the <strong>project-category slug</strong>, not the title.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', AZ_THEME_NAME ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', AZ_THEME_NAME ) => 'date',
				__( 'ID', AZ_THEME_NAME ) => 'ID',
				__( 'Author', AZ_THEME_NAME ) => 'author',
				__( 'Title', AZ_THEME_NAME ) => 'title',
				__( 'Modified', AZ_THEME_NAME ) => 'modified',
				__( 'Random', AZ_THEME_NAME ) => 'rand',
				__( 'Menu Order', AZ_THEME_NAME ) => 'menu_order'
			),
			'admin_label' => true,
			'description' => sprintf(__('Select how to sort retrieved posts. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order way', AZ_THEME_NAME ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', AZ_THEME_NAME ) => 'DESC',
				__( 'Ascending', AZ_THEME_NAME ) => 'ASC'
			),
			'admin_label' => true,
			'description' => sprintf(__('Designates the ascending or descending order. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Related Posts
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Related_Posts extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Related Team/Portfolio Posts', AZ_THEME_NAME ),
	'base' => 'az_related_posts',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Related Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Related Posts Module', AZ_THEME_NAME ),
			'param_name' => 'related_posts_module',
			'value' => array(
				__('Team', AZ_THEME_NAME) => 'team',
				__('Portfolio', AZ_THEME_NAME) => 'portfolio'
			),
			'admin_label' => true,
			'description' => __( 'Choose the custom post type.<br/>Remember to select the <strong>Full-Width Section</strong> and enabled the <strong>No Margin and Padding</strong> option.', AZ_THEME_NAME )
		),

		// Team
		array(
			'type' => 'dropdown',
			'heading' => __( 'Related Posts Team Taxonomy', AZ_THEME_NAME ),
			'param_name' => 'related_posts_module_taxonomy_team',
			'value' => array(
				__('Disciplines', AZ_THEME_NAME) => 'disciplines',
				__('Attributes', AZ_THEME_NAME) => 'attributes'
			),
			'admin_label' => true,
			'description' => __( 'Choose the taxonomy for display the team posts related.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'related_posts_module',
				'value' => array( 'team' )
			)
		),

		// Portfolio
		array(
			'type' => 'dropdown',
			'heading' => __( 'Related Posts Portfolio Taxonomy', AZ_THEME_NAME ),
			'param_name' => 'related_posts_module_taxonomy_portfolio',
			'value' => array(
				__('Project Category', AZ_THEME_NAME) => 'project-category',
				__('Project Attributes', AZ_THEME_NAME) => 'project-attribute'
			),
			'admin_label' => true,
			'description' => __( 'Choose the taxonomy for display the portfolio posts related.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'related_posts_module',
				'value' => array( 'portfolio' )
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', AZ_THEME_NAME ),
			'param_name' => 'related_posts_columns_count',
			'value' => array(
				__( '2 Columns', AZ_THEME_NAME ) => '2clm',
				__( '3 Columns', AZ_THEME_NAME ) => '3clm',
				__( '4 Columns', AZ_THEME_NAME ) => '4clm',
				__( '5 Columns', AZ_THEME_NAME ) => '5clm',
				__( '6 Columns', AZ_THEME_NAME ) => '6clm'
			),
			'admin_label' => true,
			'description' => __( 'How many columns should be displayed?', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Featured Image Size', AZ_THEME_NAME ),
			'param_name' => 'featured_img_size',
			'value' => '700x700',
			'admin_label' => true,
			'description' => __( 'Required. Enter image size in pixels like this example: 200x100 (Width x Height).', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Related Posts Number', AZ_THEME_NAME ),
			'param_name' => 'related_posts_number',
			'admin_label' => true,
			'description' => __( 'How many post to show? Enter number or word "All". Defaul value is All.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Exclude Posts ID', AZ_THEME_NAME ),
			'param_name' => 'related_posts_exclude_ids',
			'admin_label' => true,
			'description' => __( 'If you want to exclude only certain team or portfolio from related posts, please write the post ID in this field, separated by commas. Please use the <strong>post ID</strong>, not the title or slug.', AZ_THEME_NAME ),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', AZ_THEME_NAME ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', AZ_THEME_NAME ) => 'date',
				__( 'ID', AZ_THEME_NAME ) => 'ID',
				__( 'Author', AZ_THEME_NAME ) => 'author',
				__( 'Title', AZ_THEME_NAME ) => 'title',
				__( 'Modified', AZ_THEME_NAME ) => 'modified',
				__( 'Random', AZ_THEME_NAME ) => 'rand',
				__( 'Menu Order', AZ_THEME_NAME ) => 'menu_order'
			),
			'admin_label' => true,
			'description' => sprintf(__('Select how to sort retrieved posts. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order way', AZ_THEME_NAME ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', AZ_THEME_NAME ) => 'DESC',
				__( 'Ascending', AZ_THEME_NAME ) => 'ASC'
			),
			'admin_label' => true,
			'description' => sprintf(__('Designates the ascending or descending order. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Testimonials
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Testimonials_Grid extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Testimonials Grid', AZ_THEME_NAME ),
	'base' => 'az_testimonials_grid',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Testimonials Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Testimonials Color', AZ_THEME_NAME ),
			'param_name' => 'testimonials_color',
			'value' => array(
				__( 'Dark', AZ_THEME_NAME ) => 'dark-mode',
				__( 'White', AZ_THEME_NAME ) => 'white-mode'
			),
			'admin_label' => true,
			'description' => __( 'Select your favorite color for the testimonials post.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Testimonial Type', AZ_THEME_NAME ),
			'param_name' => 'testimonials_type',
			'value' => array(
				__( 'Slide', AZ_THEME_NAME ) => 'slide',
				__( 'Fade', AZ_THEME_NAME ) => 'fade'
			),
			'admin_label' => true,
			'description' => __( 'Select your favorite effect.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Testimonials Post Category', AZ_THEME_NAME ),
			'param_name' => 'testimonials_categories',
			'admin_label' => true,
			'description' => __( 'If you want to show only certain testimonials categories, not the entire testimonial posts, please write the categories in this field, separated by commas. Please use the <strong>testimonial-category slug</strong>, not the title.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', AZ_THEME_NAME ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', AZ_THEME_NAME ) => 'date',
				__( 'ID', AZ_THEME_NAME ) => 'ID',
				__( 'Author', AZ_THEME_NAME ) => 'author',
				__( 'Title', AZ_THEME_NAME ) => 'title',
				__( 'Modified', AZ_THEME_NAME ) => 'modified',
				__( 'Random', AZ_THEME_NAME ) => 'rand',
				__( 'Menu Order', AZ_THEME_NAME ) => 'menu_order'
			),
			'admin_label' => true,
			'description' => sprintf(__('Select how to sort retrieved posts. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order way', AZ_THEME_NAME ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', AZ_THEME_NAME ) => 'DESC',
				__( 'Ascending', AZ_THEME_NAME ) => 'ASC'
			),
			'admin_label' => true,
			'description' => sprintf(__('Designates the ascending or descending order. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Clients
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Clients_Grid extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Clients Grid', AZ_THEME_NAME ),
	'base' => 'az_clients_grid',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Clients Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Clients Layout Mode', AZ_THEME_NAME ),
			'param_name' => 'clients_layout_mode',
			'value' => array(
				__('Grid Full-Width', AZ_THEME_NAME) => 'grid-ly-clients'
			),
			'admin_label' => true,
			'description' => __( 'Choose Clients Layout Mode.<br/>Remember to select the <strong>Full-Width Section</strong> and enabled the <strong>No Margin and Padding</strong> option.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', AZ_THEME_NAME ),
			'param_name' => 'clients_columns_count',
			'value' => array(
				__( '1 Columns', AZ_THEME_NAME ) => '1clm',
				__( '2 Columns', AZ_THEME_NAME ) => '2clm',
				__( '3 Columns', AZ_THEME_NAME ) => '3clm',
				__( '4 Columns', AZ_THEME_NAME ) => '4clm',
				__( '5 Columns', AZ_THEME_NAME ) => '5clm',
				__( '6 Columns', AZ_THEME_NAME ) => '6clm'
			),
			'admin_label' => true,
			'description' => __( 'How many columns should be displayed?', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Clients Post Category', AZ_THEME_NAME ),
			'param_name' => 'clients_categories',
			'admin_label' => true,
			'description' => __( 'If you want to show only certain clients categories, not the entire client posts, please write the categories in this field, separated by commas. Please use the <strong>client-category slug</strong>, not the title.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', AZ_THEME_NAME ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', AZ_THEME_NAME ) => 'date',
				__( 'ID', AZ_THEME_NAME ) => 'ID',
				__( 'Author', AZ_THEME_NAME ) => 'author',
				__( 'Title', AZ_THEME_NAME ) => 'title',
				__( 'Modified', AZ_THEME_NAME ) => 'modified',
				__( 'Random', AZ_THEME_NAME ) => 'rand',
				__( 'Menu Order', AZ_THEME_NAME ) => 'menu_order'
			),
			'admin_label' => true,
			'description' => sprintf(__('Select how to sort retrieved posts. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order way', AZ_THEME_NAME ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', AZ_THEME_NAME ) => 'DESC',
				__( 'Ascending', AZ_THEME_NAME ) => 'ASC'
			),
			'admin_label' => true,
			'description' => sprintf(__('Designates the ascending or descending order. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Latest Posts
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Latest_Posts extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Latest Blog Posts', AZ_THEME_NAME ),
	'base' => 'az_latest_posts',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Display Latest Posts', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Latest Posts Layout Mode', AZ_THEME_NAME ),
			'param_name' => 'latest_posts_layout_mode',
			'value' => array(
				__('Wide Full-Width', AZ_THEME_NAME) => 'wide',
				__('Grid Full-Width', AZ_THEME_NAME) => 'grid'
			),
			'admin_label' => true,
			'description' => __( 'Choose Latest Posts Layout Mode.<br/>Remember to select the <strong>Full-Width Section</strong> and enabled the <strong>No Margin and Padding</strong> option.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', AZ_THEME_NAME ),
			'param_name' => 'latest_posts_columns_count',
			'value' => array(
				__( '1 Columns', AZ_THEME_NAME ) => '1clm',
				__( '2 Columns', AZ_THEME_NAME ) => '2clm',
				__( '3 Columns', AZ_THEME_NAME ) => '3clm',
				__( '4 Columns', AZ_THEME_NAME ) => '4clm',
			),
			'admin_label' => true,
			'description' => __( 'How many columns should be displayed?', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'latest_posts_layout_mode',
				'value' => array( 'grid' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Latest Posts Number', AZ_THEME_NAME ),
			'param_name' => 'latest_posts_number',
			'admin_label' => true,
			'description' => __( 'How many post to show? Enter number or word "All". Defaul value is All.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Latest Posts Category', AZ_THEME_NAME ),
			'param_name' => 'latest_posts_category',
			'admin_label' => true,
			'description' => __( 'If you want to show only certain post categories, not the entire blog posts, please write the categories in this field, separated by commas. Please use the <strong>category slug</strong>, not the title.', AZ_THEME_NAME ),
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', AZ_THEME_NAME ),
			'param_name' => 'orderby',
			'value' => array(
				'',
				__( 'Date', AZ_THEME_NAME ) => 'date',
				__( 'ID', AZ_THEME_NAME ) => 'ID',
				__( 'Author', AZ_THEME_NAME ) => 'author',
				__( 'Title', AZ_THEME_NAME ) => 'title',
				__( 'Modified', AZ_THEME_NAME ) => 'modified',
				__( 'Random', AZ_THEME_NAME ) => 'rand',
				__( 'Menu Order', AZ_THEME_NAME ) => 'menu_order'
			),
			'admin_label' => true,
			'description' => sprintf(__('Select how to sort retrieved posts. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Order way', AZ_THEME_NAME ),
			'param_name' => 'order',
			'value' => array(
				__( 'Descending', AZ_THEME_NAME ) => 'DESC',
				__( 'Ascending', AZ_THEME_NAME ) => 'ASC'
			),
			'admin_label' => true,
			'description' => sprintf(__('Designates the ascending or descending order. More at %s.', AZ_THEME_NAME), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>')
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Single Image
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Single_Image extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Single Image', AZ_THEME_NAME ),
	'base' => 'az_single_image',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Single Image', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', AZ_THEME_NAME ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Required. Select image from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail Image Size', AZ_THEME_NAME ),
			'param_name' => 'thumbnail_img_size',
			'value' => '',
			'admin_label' => true,
			'description' => __( 'Optional. Enter image size in pixels like this example: 200x100 (Width x Height), if not present load the full image size.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Mode', AZ_THEME_NAME ),
			'param_name' => 'image_mode',
			'value' => array(
		  		__('Image Responsive', AZ_THEME_NAME) => 'normal-image', 
		  		__('Full Image Responsive', AZ_THEME_NAME) => 'full-image-responsive'
		  	),
		  	'admin_label' => true,
		  	'description' => __( 'Choose Image Mode.<br/>Image Responsive: Image is responsive but not has 100% width.<br/>Full Image Responsive: Image is responsive and has 100% width.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Link Mode', AZ_THEME_NAME ),
			'param_name' => 'image_link_mode',
			'value' => array(
				__('No', AZ_THEME_NAME) => 'no-link',
				__('Yes', AZ_THEME_NAME) => 'with-link'
			),
			'admin_label' => true,
			'description' => __( 'Optional. Enabled if you want a link url for your image.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Link URL', AZ_THEME_NAME ),
			'param_name' => 'image_link_url',
			'description' => __( 'Where should your image link to?.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'image_link_mode',
				'value' => array( 'with-link' )
			)
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Link Target', AZ_THEME_NAME ),
			'param_name' => 'image_link_target',
			'value' => $target_arr,
			'dependency' => array(
				'element' => 'image_link_mode',
				'value' => array( 'with-link' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Gallery Images
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Gallery_Images extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Gallery Images', AZ_THEME_NAME ),
	'base' => 'az_gallery_images',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Gallery Images', AZ_THEME_NAME ),
	'params' => array(

		$hover_fx,

		array(
			'type' => 'attach_images',
			'heading' => __( 'Images for Gallery', AZ_THEME_NAME ),
			'param_name' => 'images_gallery',
			'value' => '',
			'description' => __( 'Required. Select images from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Gallery Layout Mode', AZ_THEME_NAME ),
			'param_name' => 'gallery_layout_mode',
			'value' => array(
				__('Grid Full-Width', AZ_THEME_NAME) => 'grid-ly-gallery',
				__('Masonry Full-Width', AZ_THEME_NAME) => 'masonry-ly-gallery'
			),
			'admin_label' => true,
			'description' => __( 'Choose Gallery Layout Mode.<br/>Remember to select the <strong>Full-Width Section</strong> and enabled the <strong>No Margin and Padding</strong> option.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns', AZ_THEME_NAME ),
			'param_name' => 'gallery_columns_count',
			'value' => array(
				__( '2 Columns', AZ_THEME_NAME ) => '2clm',
				__( '3 Columns', AZ_THEME_NAME ) => '3clm',
				__( '4 Columns', AZ_THEME_NAME ) => '4clm',
				__( '5 Columns (Only Grid)', AZ_THEME_NAME ) => '5clm',
				__( '6 Columns (Only Grid)', AZ_THEME_NAME ) => '6clm'
			),
			'admin_label' => true,
			'description' => __( 'How many columns should be displayed?', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Featured Image Size for Grid Gallery', AZ_THEME_NAME ),
			'param_name' => 'grid_featured_img_size',
			'value' => '700x700',
			'description' => __( 'Required. Enter image size in pixels like this example: 200x100 (Width x Height).', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'gallery_layout_mode',
				'value' => array( 'grid-ly-gallery' )
			)
		),

		array(
		  	'type' => 'checkbox',
		  	'heading' => __('Random Order Image?', AZ_THEME_NAME),
		  	'param_name' => 'gallery_random_order',
		  	'value' => array(
		  		__('Yes, please', AZ_THEME_NAME) => 'yes'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Optional. Randomize image order.' , AZ_THEME_NAME),
		  	'dependency' => array(
				'element' => 'gallery_layout_mode',
				'value' => array( 'grid-ly-gallery' )
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)
		
	)
) );

/*-----------------------------------------------------------------------------------*/
/*	AZ Slider Images
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Slider_Images extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'AZ Slider Images', AZ_THEME_NAME ),
	'base' => 'az_slider_images',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Slider Images', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'attach_images',
			'heading' => __( 'Images for Slider', AZ_THEME_NAME ),
			'param_name' => 'az_images_gallery',
			'value' => '',
			'description' => __( 'Required. Select images from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Slider Navigation Color', AZ_THEME_NAME ),
			'param_name' => 'az_slider_nav_color',
			'value' => array(
				__( 'White', AZ_THEME_NAME ) => 'white-mode',
				__( 'Dark', AZ_THEME_NAME ) => 'dark-mode'
			),
			'admin_label' => true,
			'description' => __( 'Select your favorite color for the navigation slider.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Slider Animation', AZ_THEME_NAME ),
			'param_name' => 'az_slider_animations',
			'value' => array(
		  		__('Fade', AZ_THEME_NAME) => 'fade', 
		  		__('Slide', AZ_THEME_NAME) => 'slide'
		  	),
		  	'admin_label' => true,
		  	'description' => __( 'Choose Slider Animation.', AZ_THEME_NAME )
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Slider Height Module', AZ_THEME_NAME),
		  	'param_name' => 'az_slider_module_h',
		  	'value' => array(
		  		__('Normal', AZ_THEME_NAME) 	 => 'normal_height_slider', 
		  		__('Full Screen', AZ_THEME_NAME) => 'full_screen_slider'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Choose a height mode for your slider.<br>If you select the <strong>Full Screen Slider</strong>, remember to select the <strong>Full Screen Section</strong> and enabled the <strong>No Content Center</strong> option.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Slider Height', AZ_THEME_NAME),
		  	'param_name' => 'az_slider_height',
		  	'value' => '500',
		  	'description' => __('Please enter the height for your slider in pixel. Enter only number value. Default Value 500.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'az_slider_module_h', 
		  		'value' => array( 'normal_height_slider' )
		  	)
		),

		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'az_slider_overlay',
		  	'value' => array(
		  		__('No Overlay Mask', AZ_THEME_NAME) 	=> 'no_mask_overlay', 
		  		__('Yes, Overlay Mask', AZ_THEME_NAME) 	=> 'yes_mask_overlay'
		  	),
		  	'description' => __('Enable or Disable the custom options for overlay section.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'colorpicker',
		  	'heading' => __('Slider Color Overlay Mask', AZ_THEME_NAME),
		  	'param_name' => 'az_slider_overaly_color',
		  	'description' => __('Choose a background color overlay for your slider block. Only if Overlay Mask is enabled.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'az_slider_overlay',
		  		'value' => array( 'yes_mask_overlay' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)
		
	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Lightbox Image/Video/Gallery
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Lightbox_Image extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Lightbox Image', AZ_THEME_NAME ),
	'base' => 'az_lightbox_image',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Image Lightbox', AZ_THEME_NAME ),
	'params' => array(

		$hover_fx,

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', AZ_THEME_NAME ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Required. Select image from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'attach_image',
			'heading' => __( 'Different Image', AZ_THEME_NAME ),
			'param_name' => 'image_different_popup',
			'value' => '',
			'description' => __( 'Optional. Select image from media library, if you want a different popup image.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'image',
				'not_empty' => true
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail Image Size', AZ_THEME_NAME ),
			'param_name' => 'thumbnail_img_size',
			'value' => '',
			'admin_label' => true,
			'description' => __( 'Optional. Enter image size in pixels like this example: 200x100 (Width x Height), if not present load the full image size.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Mode', AZ_THEME_NAME ),
			'param_name' => 'image_mode',
			'value' => array(
		  		__('Image Responsive', AZ_THEME_NAME) => 'normal-image', 
		  		__('Full Image Responsive', AZ_THEME_NAME) => 'full-image-responsive'
		  	),
		  	'admin_label' => true,
		  	'description' => __( 'Choose Image Mode.<br/>Image Responsive: Image is responsive but not has 100% width.<br/>Full Image Responsive: Image is responsive and has 100% width.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Caption Title', AZ_THEME_NAME ),
			'param_name' => 'caption_image_title',
			'description' => __( 'Optional. Insert the title of your image. <strong>NO HTML</strong>', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Fancybox Gallery Name', AZ_THEME_NAME ),
			'param_name' => 'image_gallery_name',
			'admin_label' => true,
			'description' => __( 'Optional. Insert a name if you want a gallery between other lightbox image shortcode only. Remember to add/write the same name for each shortcode.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
) );

class WPBakeryShortCode_AZ_Lightbox_Images_Gallery extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Lightbox Image Gallery', AZ_THEME_NAME ),
	'base' => 'az_lightbox_images_gallery',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Gallery Images Lightbox', AZ_THEME_NAME ),
	'params' => array(

		$hover_fx,

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', AZ_THEME_NAME ),
			'param_name' => 'image',
			'value' => '',
			'description' => __( 'Required. Select image from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'attach_image',
			'heading' => __( 'Different Image', AZ_THEME_NAME ),
			'param_name' => 'image_different_popup',
			'value' => '',
			'description' => __( 'Optional. Select image from media library, if you want a different popup image.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'image',
				'not_empty' => true
			)
		),

		array(
			'type' => 'attach_images',
			'heading' => __( 'Images for Gallery', AZ_THEME_NAME ),
			'param_name' => 'images_gallery',
			'value' => '',
			'description' => __( 'Required. Select images from media library.', AZ_THEME_NAME ),
			'dependency' => array(
				'element' => 'image',
				'not_empty' => true
			)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail Image Size', AZ_THEME_NAME ),
			'param_name' => 'thumbnail_img_size',
			'value' => '',
			'admin_label' => true,
			'description' => __( 'Optional. Enter image size in pixels like this example: 200x100 (Width x Height), if not present load the full image size.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Mode', AZ_THEME_NAME ),
			'param_name' => 'image_mode',
			'value' => array(
		  		__('Image Responsive', AZ_THEME_NAME) => 'normal-image', 
		  		__('Full Image Responsive', AZ_THEME_NAME) => 'full-image-responsive'
		  	),
		  	'admin_label' => true,
		  	'description' => __( 'Choose Image Mode.<br/>Image Responsive: Image is responsive but not has 100% width.<br/>Full Image Responsive: Image is responsive and has 100% width.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Fancybox Gallery Name', AZ_THEME_NAME ),
			'param_name' => 'images_gallery_name',
			'admin_label' => true,
			'description' => __( 'Required. Insert a name for the lightbox gallery.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
) );

class WPBakeryShortCode_AZ_Lightbox_Video extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Lightbox Video', AZ_THEME_NAME ),
	'base' => 'az_lightbox_video',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Video Lightbox', AZ_THEME_NAME ),
	'params' => array(

		$hover_fx,

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', AZ_THEME_NAME ),
			'param_name' => 'image_video',
			'value' => '',
			'description' => __( 'Required. Select image from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail Image Size', AZ_THEME_NAME ),
			'param_name' => 'thumbnail_img_size',
			'value' => '',
			'admin_label' => true,
			'description' => __( 'Optional. Enter image size in pixels like this example: 200x100 (Width x Height), if not present load the full image size.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Mode', AZ_THEME_NAME ),
			'param_name' => 'image_mode',
			'value' => array(
		  		__('Image Responsive', AZ_THEME_NAME) => 'normal-image', 
		  		__('Full Image Responsive', AZ_THEME_NAME) => 'full-image-responsive'
		  	),
		  	'admin_label' => true,
		  	'description' => __( 'Choose Image Mode.<br/>Image Responsive: Image is responsive but not has 100% width.<br/>Full Image Responsive: Image is responsive and has 100% width.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Video Link URL', AZ_THEME_NAME ),
			'param_name' => 'video_link',
			'admin_label' => true,
			'description' => __( 'Only Youtube and Vimeo Support.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Caption Title', AZ_THEME_NAME ),
			'param_name' => 'caption_video_title',
			'description' => __( 'Optional. Insert the title of your video. <strong>NO HTML</strong>', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Fancybox Gallery Name', AZ_THEME_NAME ),
			'param_name' => 'video_gallery_name',
			'admin_label' => true,
			'description' => __( 'Optional. Insert a name if you want a gallery between other lightbox video shortcode only. Remember to add/write the same name for each shortcode.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
) );

class WPBakeryShortCode_AZ_Lightbox_Videos_Gallery extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Lightbox Video Gallery', AZ_THEME_NAME ),
	'base' => 'az_lightbox_videos_gallery',
	'icon' => 'icon-wpb-single-image',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Gallery Videos Lightbox', AZ_THEME_NAME ),
	'params' => array(

		$hover_fx,

		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', AZ_THEME_NAME ),
			'param_name' => 'image_video',
			'value' => '',
			'description' => __( 'Required. Select image from media library.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Thumbnail Image Size', AZ_THEME_NAME ),
			'param_name' => 'thumbnail_img_size',
			'value' => '',
			'admin_label' => true,
			'description' => __( 'Optional. Enter image size in pixels like this example: 200x100 (Width x Height), if not present load the full image size.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Mode', AZ_THEME_NAME ),
			'param_name' => 'image_mode',
			'value' => array(
		  		__('Image Responsive', AZ_THEME_NAME) => 'normal-image', 
		  		__('Full Image Responsive', AZ_THEME_NAME) => 'full-image-responsive'
		  	),
		  	'admin_label' => true,
		  	'description' => __( 'Choose Image Mode.<br/>Image Responsive: Image is responsive but not has 100% width.<br/>Full Image Responsive: Image is responsive and has 100% width.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Video Link URL', AZ_THEME_NAME ),
			'param_name' => 'video_link',
			'description' => __( 'Required. Only Youtube and Vimeo Support.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Caption Title', AZ_THEME_NAME ),
			'param_name' => 'caption_video_title',
			'description' => __( 'Optional. Insert the title of your video. <strong>NO HTML</strong>', AZ_THEME_NAME )
		),

		array(
			'type' => 'exploded_textarea',
			'heading' => __( 'Videos Links URL', AZ_THEME_NAME ),
			'param_name' => 'video_links',
			'description' => __( 'Required. Enter links for each video here. Divide links with linebreaks (Enter).<br/>Only Youtube and Vimeo Support.<br/> Example: Video URL|Optional Caption', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Fancybox Gallery Name', AZ_THEME_NAME ),
			'param_name' => 'videos_gallery_name',
			'admin_label' => true,
			'description' => __( 'Required. Insert a name for the lightbox gallery.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs,

		/* Animations */
		$animated_choice,
		$animated_effects,
		$animated_delay
	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Audio & Video
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Audio_Player extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Audio', AZ_THEME_NAME ),
	'base' => 'az_audio_player',
	'icon' => 'icon-wpb-film-youtube',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Embed Audio Player', AZ_THEME_NAME ),
	'params' => array(
		/* Others Video Types */
		array(
			'type' => 'textfield',
			'heading' => __( 'MP3 File URL', AZ_THEME_NAME ),
			'param_name' => 'audio_link',
			'admin_label' => true,
			'description' => __( 'Link to MP3 file.', AZ_THEME_NAME )
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs
	)
) );

class WPBakeryShortCode_AZ_Video_Player extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Video', AZ_THEME_NAME ),
	'base' => 'az_video_player',
	'icon' => 'icon-wpb-film-youtube',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Embed Video Player', AZ_THEME_NAME ),
	'params' => array(
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Video Player Type', AZ_THEME_NAME),
		  	'param_name' => 'video_player_type',
		  	'value' => array(
		  		__('Self-Hosted', AZ_THEME_NAME) 	=> 'self_hosted_mode', 
		  		__('Vimeo/Youtube/Others', AZ_THEME_NAME) 	=> 'others_video_mode'
		  	),
		  	'description' => __('Choose your Video Type.', AZ_THEME_NAME)
		),

		/* Self-Hosted Player */
		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Poster Image', AZ_THEME_NAME),
		  	'param_name' => 'poster_image',
		  	'value' => '',
		  	'description' => __('Required. Select image from media library.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_player_type',
		  		'value' => array( 'self_hosted_mode' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('WEBM File URL', AZ_THEME_NAME),
		  	'param_name' => 'custom_video_webm',
		  	'admin_label' => true,
		  	'description' => __('Required. Upload a WEBM File.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_player_type', 
		  		'value' => array( 'self_hosted_mode' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('MP4 File URL', AZ_THEME_NAME),
		  	'param_name' => 'custom_video_mp4',
		  	'admin_label' => true,
		  	'description' => __('Required. Upload a MP4 File.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'video_player_type', 
		  		'value' => array( 'self_hosted_mode' )
		  	)
		),

		/* Others Video Types */
		array(
			'type' => 'textfield',
			'heading' => __( 'Video link', AZ_THEME_NAME ),
			'param_name' => 'link_video_others',
			'admin_label' => true,
			'description' => sprintf( __( 'Link to the video. More about supported formats at %s.', AZ_THEME_NAME ), '<a href="http://codex.wordpress.org/Embeds#Okay.2C_So_What_Sites_Can_I_Embed_From.3F" target="_blank">WordPress codex page</a>' ),
			'dependency' => array(
		  		'element' => 'video_player_type', 
		  		'value' => array( 'others_video_mode' )
		  	)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		),

		/* Responsive Visibility */
		$responsive_lg,
		$responsive_md,
		$responsive_sm,
		$responsive_xs
	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Google Maps
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Google_Maps extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Map', AZ_THEME_NAME ),
	'base' => 'az_google_maps',
	'icon' => 'icon-wpb-map-pin',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Map Block', AZ_THEME_NAME ),
	'params' => array(
		
		array(
		  	'type' => 'dropdown',
		  	'heading' => __('Map Height Module', AZ_THEME_NAME),
		  	'param_name' => 'map_module_h',
		  	'value' => array(
		  		__('Normal', AZ_THEME_NAME) 	 => 'normal_height_map', 
		  		__('Full Screen', AZ_THEME_NAME) => 'full_screen_map'
		  	),
		  	'admin_label' => true,
		  	'description' => __('Choose a height mode for your map.<br>If you select the <strong>Full Screen Map</strong>, remember to select the <strong>Full Screen Section</strong> and enabled the <strong>No Content Center</strong> option.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Height', AZ_THEME_NAME),
		  	'param_name' => 'map_height',
		  	'value' => '500',
		  	'description' => __('Please enter the height for your map in pixel. Enter only number value. Default Value 500.', AZ_THEME_NAME),
		  	'dependency' => array(
		  		'element' => 'map_module_h', 
		  		'value' => array( 'normal_height_map' )
		  	)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Latitude', AZ_THEME_NAME),
		  	'param_name' => 'map_latidude',
		  	'admin_label' => true,
		  	'description' => __('Please enter the latitude for the maps center point.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Longitude', AZ_THEME_NAME),
		  	'param_name' => 'map_longitude',
		  	'admin_label' => true,
		  	'description' => __('Please enter the longitude for the maps center point.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Map Zoom', AZ_THEME_NAME),
		  	'param_name' => 'map_zoom',
		  	'admin_label' => true,
		  	'description' => __('Value should be between 1-18, 1 being the entire earth and 18 being right at street level.', AZ_THEME_NAME),
		  	'value' => '14'
		),

		array(
		  	'type' => 'attach_image',
		  	'heading' => __('Marker Icon', AZ_THEME_NAME),
		  	'param_name' => 'marker_image',
		  	'value' => '',
		  	'description' => __('Optional. Select image from media library.', AZ_THEME_NAME)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );

/*-----------------------------------------------------------------------------------*/
/*	Twitter Feed
/*-----------------------------------------------------------------------------------*/
class WPBakeryShortCode_AZ_Twitter_Feed extends WPBakeryShortCode {}
vc_map( array(
	'name' => __( 'Twitter Feed', AZ_THEME_NAME ),
	'base' => 'az_twitter_feed',
	'icon' => 'icon-wpb-map-pin',
	'category' => __( 'Content', AZ_THEME_NAME ),
	'description' => __( 'Twitter Feed', AZ_THEME_NAME ),
	'params' => array(

		array(
			'type' => 'dropdown',
			'heading' => __( 'Twitter Feed Texts Color', AZ_THEME_NAME ),
			'param_name' => 'twitter_feed_colors',
			'value' => array(
				__( 'Dark', AZ_THEME_NAME ) => 'dark-mode',
				__( 'White', AZ_THEME_NAME ) => 'white-mode'
			),
			'admin_label' => true,
			'description' => __( 'Select your favorite color for the twitter feed text.', AZ_THEME_NAME )
		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'Twitter Feed Type', AZ_THEME_NAME ),
			'param_name' => 'twitter_feed_type',
			'value' => array(
				__( 'Slide', AZ_THEME_NAME ) => 'slide',
				__( 'Fade', AZ_THEME_NAME ) => 'fade'
			),
			'admin_label' => true,
			'description' => __( 'Select your favorite effect.', AZ_THEME_NAME )
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Twitter Username', AZ_THEME_NAME),
		  	'param_name' => 'twitter_username',
		  	'value' => 'Bluxart',
		  	'admin_label' => true,
		  	'description' => __('Required. Insert here your twitter username only.', AZ_THEME_NAME)
		),

		array(
		  	'type' => 'textfield',
		  	'heading' => __('Number of Tweets', AZ_THEME_NAME),
		  	'param_name' => 'tweets_total',
		  	'value' => '1',
		  	'admin_label' => true,
		  	'description' => __('Display total tweets. Change number up to 20 for number of tweets.', AZ_THEME_NAME)
		),

		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', AZ_THEME_NAME ),
			'param_name' => 'el_class',
			'admin_label' => true,
			'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css/js file.', AZ_THEME_NAME )
		)

	)
) );

?>