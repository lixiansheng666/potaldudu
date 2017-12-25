<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package	   TGM-Plugin-Activation
 * @subpackage Example
 * @version	   2.3.6
 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author	   Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'alpha_register_required_plugins' );

function alpha_register_required_plugins() {

	$plugins = array(

        array(
			'name'     				=> esc_html__( 'Krown Portfolio', 'alpha' ),
			'slug'     				=> 'krown-portfolio', 
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/krown-portfolio.zip', 
			'required' 				=> true, 
			'version' 				=> '0.3', 
			'force_activation' 		=> false, 
			'force_deactivation' 	=> false,
			'external_url' 			=> ''
		),

        array(
			'name'     				=> esc_html__( 'Visual Composer', 'alpha' ),
			'slug'     				=> 'js_composer', 
			'source'   				=> get_stylesheet_directory() . '/includes/plugins/js_composer.zip', 
			'required' 				=> true, 
			'version' 				=> '4.9.1', 
			'force_activation' 		=> false, 
			'force_deactivation' 	=> true,
			'external_url' 			=> ''
		),

        array(
            'name'      => esc_html__( 'oAuth Twitter Feed for Developers', 'alpha' ),
            'slug'      => 'oauth-twitter-feed-for-developers',
            'required'  => true,
            'force_activation' => false,
			'version' 				=> '2.2.1'
        ),

        array(
            'name'      => esc_html__( 'Contact Form 7', 'alpha' ),
            'slug'      => 'contact-form-7',
            'required'  => true,
            'force_activation' => false,
			'version' 				=> '4.3.1'
        )


	);
	
	$config = array(
		'id'           => 'alpha',                 
		'default_path' => '',                      
		'menu'         => 'tgmpa-install-plugins', 
		'parent_slug'  => 'themes.php',            
		'capability'   => 'edit_theme_options',   
		'has_notices'  => true,                   
		'dismissable'  => true,                   
		'dismiss_msg'  => '',                      
		'is_automatic' => true,                   
		'message'      => ''                  
	);

	tgmpa( $plugins, $config );

}