<?php

// This file contains new maps or map updates for the Visual Composer 

// Accordion



vc_map_update( 'vc_tta_accordion', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => esc_html__("Active tab", 'alpha'),
        "param_name" => "active_tab",
        "description" => esc_html__("Enter tab number to be active on load or enter false to collapse all tabs (0 is the first one).", 'alpha')
      ),
      array(
        "type" => 'dropdown',
        "heading" => esc_html__("Type", 'alpha'),
        "param_name" => "type",
           "value" => array("Accordion" => 'accordion', "Toggle" => 'toggle'),
           "description" => esc_html__("Inside accordions only one section can be visible at a time. With toggles the user can open all the sections at once.", 'alpha')
      ),
      array(
        "type" => "textfield",
        "heading" => esc_html__("Extra class name", 'alpha'),
        "param_name" => "el_class",
        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
      )
  )

) );


// Flickr

vc_map_update( 'vc_flickr', array(
	"params" =>array(
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Flickr ID", 'alpha'),
	      "param_name" => "flickr_id",
	      'admin_label' => true,
	      "description" => sprintf(esc_html__('To find your flickID visit %s.', 'alpha'), '<a href="http://idgettr.com/" target="_blank">idGettr</a>')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Number of photos", 'alpha'),
	      "param_name" => "count",
	      "value" => "",
	      "description" => esc_html__("Choose a number of items to display (between 1-20).", 'alpha')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Extra class name", 'alpha'),
	      "param_name" => "el_class",
	      "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
	    )
	)
) );


// Message Box

vc_map_update( 'vc_message', array(
	"params" =>array(
	    array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Message box type", 'alpha'),
	      "param_name" => "color",
	      "value" => array(esc_html__('Informational', 'alpha') => "alert-info", esc_html__('Warning', 'alpha') => "alert-block", esc_html__('Success', 'alpha') => "alert-success", esc_html__('Error', 'alpha') => "alert-error"),
	      "description" => esc_html__("Select message type.", 'alpha')
	    ),
	    array(
	      "type" => "textarea_html",
	      "holder" => "div",
	      "class" => "messagebox_text",
	      "heading" => esc_html__("Message text", 'alpha'),
	      "param_name" => "content",
	      "value" => esc_html__("<p>I am message box. Click edit button to change this text.</p>", 'alpha')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Extra class name", 'alpha'),
	      "param_name" => "el_class",
	      "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
	    )
	)
) );

// Separator

vc_map_update( 'vc_separator', array(
	"description" => esc_html__('Divider', 'alpha'),
	"show_settings_on_create" => true,
	//"controls"	=> 'popup_delete',
	"params" =>array(
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Top margin", 'alpha'),
	      "param_name" => "height_2",
	      "value" => "0",
	      "description" => esc_html__("Enter a numeric value for the top margin of this divider (in px).", 'alpha')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Bottom margin", 'alpha'),
	      "param_name" => "height",
	      "value" => "50",
	      "description" => esc_html__("Enter a numeric value for the bottom margin of this divider (in px).", 'alpha')
	    )
	)
) );

// Single Image

vc_map_update( 'vc_single_image', array(
	"description" => esc_html__('Simple image', 'alpha'),
	"params" =>array(
	    array(
	      "type" => "attach_image",
	      "heading" => esc_html__("Image", 'alpha'),
	      "param_name" => "image",
	      "value" => "",
	      "description" => esc_html__("Select image from media library.", 'alpha')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Image link", 'alpha'),
	      "param_name" => "img_link_custom",
	      "description" => esc_html__("Enter url if you want this image to have link.", 'alpha')
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => esc_html__("Link Target", 'alpha'),
	      "param_name" => "img_link_target",
	      "value" => $target_arr
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Extra class name", 'alpha'),
	      "param_name" => "el_class",
	      "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
	    )
	)
) );



// Tabs



vc_map_update( 'vc_tta_tabs', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => esc_html__("Extra class name", 'alpha'),
        "param_name" => "el_class",
        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
      )
   )
) );

vc_map_update( 'vc_tta_section', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => esc_html__("Title", 'alpha'),
        "param_name" => "title",
        "description" => esc_html__("Tab title - ONLY FOR TABS & ACCORDIONS", 'alpha')
      ),
      array(
        "type" => "tab_id",
        "heading" => esc_html__("Tab ID", 'alpha'),
        "param_name" => "tab_id"
      )
  )
) );

// NEW - Team

// Text Block

vc_map_update( 'vc_column_text', array(
  "params" => array(
      array(
        "type" => "textarea_html",
        "holder" => "div",
        "heading" => esc_html__("Text", 'alpha'),
        "param_name" => "content",
        "value" => esc_html__("<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>", 'alpha')
      ),
      array(
        "type" => "textfield",
        "heading" => esc_html__("Extra class name", 'alpha'),
        "param_name" => "el_class",
        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
      )
  )

) );

vc_map_update( 'vc_column_inner', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => esc_html__("Extra class name", 'alpha'),
        "param_name" => "el_class",
        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
      )
  )

) );



vc_map_update( 'vc_column', array(
  "params" => array(

    array(
      "type" => "colorpicker",
      "heading" => esc_html__("Background Color", 'alpha'),
      "param_name" => "background",
      "value" => "#f9f9f9",
      "description" => esc_html__("The columns's background color.", 'alpha')
    ),
      array(
        "type" => "textfield",
        "heading" => esc_html__("Extra class name", 'alpha'),
        "param_name" => "el_class",
        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
      )
  )

) );


vc_map_update( 'vc_row', array(
  "params" => array(

    array(
      "type" => "colorpicker",
      "heading" => esc_html__("Background Color", 'alpha'),
      "param_name" => "background",
      "value" => "#f9f9f9",
      "description" => esc_html__("The rows's background color.", 'alpha')
    ),
    array(
      "type" => "attach_image",
      "heading" => esc_html__("Background Image", 'alpha'),
      "param_name" => "background_img",
      "value" => "",
      "description" => esc_html__("An optional image background.", 'alpha')
    ),

      array(
        "type" => 'checkbox',
        "heading" => esc_html__("Full width", 'alpha'),
        "param_name" => "full_width",
        "description" => esc_html__("If selected, the row and it's columns will not have any margins (useful for images).", 'alpha'),
        "value" => Array(esc_html__("Yes, please", 'alpha') => 'yes')
      ),
      array(
        "type" => "textfield",
        "heading" => esc_html__("Extra class name", 'alpha'),
        "param_name" => "el_class",
        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
      )
  )

) );

// Text Separator

vc_map_update( 'vc_text_separator', array(
	"name" => esc_html__('Section Titles', 'alpha'),
	"params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Title", 'alpha'),
	      "param_name" => "title",
	      "holder" => "div",
	      "value" => "",
	      "description" => esc_html__("Section title (H3).", 'alpha')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Bottom margin", 'alpha'),
	      "param_name" => "margin",
	      "value" => "30",
	      "description" => esc_html__("Choose a bottom margin for the block.", 'alpha')
	    ),
      array(
        "type" => "dropdown",
        "heading" => esc_html__("Alignment", 'alpha'),
        "param_name" => "alignment",
        "value" => array(esc_html__("Align left", 'alpha') => "left", esc_html__("Align right", 'alpha') => "right", esc_html__("Align center", 'alpha') => "center"),
        "description" => esc_html__("Select title alignment.", 'alpha')
      ),
	    array(
	      "type" => "textfield",
	      "heading" => esc_html__("Extra class name", 'alpha'),
	      "param_name" => "el_class",
	      "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
	    )
	)

) );

// NEW - Twitter

vc_map( array(
  "name" => esc_html__("Twitter Widget", 'alpha'),
  "base" => "vc_twitter",
  "icon" => 'icon-wpb-ui-twitter',
  "category" => esc_html__('Social', 'alpha'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => esc_html__("Twitter username", 'alpha'),
      "param_name" => "twitter_name",
      "description" => esc_html__("Type in twitter profile name from which load tweets (without @).", 'alpha')
    ),
    array(
        "type" => "attach_image",
        "heading" => esc_html__("Avatar", 'alpha'),
        "param_name" => "avatar",
        "value" => "",
        "description" => esc_html__("Choose an avatar for the widget.", 'alpha')
    ),
    array(
        "type" => "textfield",
        "heading" => esc_html__("Count", 'alpha'),
        "param_name" => "no",
        "value" => "3",
        "description" => esc_html__("Choose how many tweets you want to display.", 'alpha')
    ),
    array(
      "type" => "textfield",
      "heading" => esc_html__("Extra class name", 'alpha'),
      "param_name" => "el_class",
      "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'alpha')
    )
  )
) );

?>