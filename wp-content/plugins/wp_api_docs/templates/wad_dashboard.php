<?php
global $snipr_vars, $snipr_main;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if(isset($_POST['wad_main_settings']))
	{
		update_option( 'wad_title', $_POST['wad_title']);
		update_option( 'wad_logo', $_POST['wad_logo'] );
		update_option( 'wad_company', $_POST['wad_company']);
	}
	if(isset($_POST['wad_style_settings']))
	{
		update_option( 'wad_main_color', $_POST['main_color'] );
		update_option( 'wad_dark_color', $_POST['dark_color'] );
	}
	if( isset($_POST['wad_permalink_settings']))
	{
		update_option( 'wad_post_type', $_POST['wad_post_type']);
		update_option( 'wad_category', $_POST['wad_category']);	
		update_option( 'wad_tags', $_POST['wad_tags']);	
	}
	
	if(isset($_POST['wad_plugin_developing']))
	{
		update_option( 'wad_developing_mode', $_POST['wad_developing_mode'] );
	}
}

$wad_main_color = get_option('wad_main_color', '#DF314D');
$wad_dark_color = get_option('wad_dark_color', '#BB3248');
$wad_title = get_option('wad_title', __('Wiki API Docs','wad'));
$wad_logo = get_option('wad_logo', '');
$wad_company = get_option('wad_company','');
$wad_post_type = get_option('wad_post_type', WAD_POST_TYPE);
$wad_category = get_option('wad_category', MAIN_WAD_CATEGORY);
$wad_tags = get_option('wad_tags', MAIN_WAD_TAGS);
$wad_developing_mode = get_option('wad_developing_mode', 0);
?>
<div id="wad_dashboard" class="wrap wad ad_dashboard">
	
    <div class="ad_dasboard_boxes adheader">
    	<h3>Wiki API Docs</h3>
        <div class="version"><em><?php _e('Version','wad'); ?> <?php echo WAD_VERSION; ?></em></div>
    </div>
    <?php
	if( current_user_can(WAD_ROLE_ADMIN))
	{
		?>
        <div class="ad_dasboard_boxes menu">
            <a href="post-new.php?post_type=docs" class="plus main_button" title="<?php _e('Add New','wad'); ?>">+</a><a href="edit.php?post_type=docs" class="main_button action_button"><?php _e('Document','wad'); ?></a>
            
        </div>
        <?php
	}
	?>
	
    <h2 class="messages-position"></h2>
    <?php
	// admin_notice Messages
    if( !empty($notice) )
	{
		foreach($notice as $note)
		{
			echo !empty($note) ? '<div class="updated wad-message"><p>'.$note.'</p></div>' : '';
		}
	}
	?>
    
    
    <div class="container">
    	<div class="left_content snipr_dasboard_boxes">
         
            
            <div style="padding:20px;">
             
                <table id="tuna_tab_customization">
                    <tr>
                        <td valign="top">
                            <div id="tuna_tab_left">
                                <ul>
                                	<?php
									if( current_user_can(WAD_ROLE_ADMIN))
									{
										?>
                                        <li><a class="focused" data-target="main-settings" title=""><?php _e('Main Settings', 'wad'); ?></a></li>
                                        <li><a data-target="style-settings" title=""><?php _e('Style', 'wad'); ?></a></li>
                                        <li><a data-target="permalink-settings" title=""><?php _e('Permalinks', 'wad'); ?></a></li>
                                        <?php
										if(isset($_GET['devtab']))
										{
											?>
                                            <li><a data-target="devtab" title=""><?php _e('Developing', 'wad'); ?></a></li>
                                            <?php
										}
									}
									?>
                                </ul>					
                            </div>
                        </td>
                        <td width="100%"  valign="top">
                            <div id="tuna_tab_right">
                                <p id="tuna_tab_arrow" style="top:4px"></p>
                                <div class="customization_right_in">
                                    
									<?php
									if( current_user_can(WAD_ROLE_ADMIN))
									{
										?>
										<div id="main-settings" class="nfer"> <!-- style="display:none;" -->
                                            <h2><?php _e('Main Settings','wad'); ?></h2>
                                            <em class="hr_line"></em>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="tuna_meta metabox-holder">
                                    
                                                    <div class="postbox nobg">
                                                        <div class="inside">
                                                            <table class="form-table">
                                                                <tbody>
                                                                	<tr>
                                                                        <th scope="row">
                                                                            <?php _e( "Main Title", 'wad' ); ?>
                                                                            <span class="description"><?php _e('The title to be shown in the header.', 'wad'); ?></span>
                                                                        </th>
                                                                        <td>	
                                                                            <input name="wad_title" type="text" value="<?php echo $wad_title; ?>">
                                                                            <span class="description"></span>
                                                                        </td>
                                                                    </tr>
                                                                 	<tr>
                                                                        <th scope="row">
                                                                            <?php _e( "Company Name", 'wad' ); ?>
                                                                            <span class="description"><?php _e('The name to be shown next to the logo in the sidebar.', 'wad'); ?></span>
                                                                        </th>
                                                                        <td>	
                                                                            <input name="wad_company" type="text" value="<?php echo $wad_company; ?>">
                                                                            <span class="description"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <?php _e('Logo', 'wad'); ?>
                                                                            <span class="description"><?php _e('The logo to show in the upper left corner of the sidebar.', 'wad'); ?></span>
                                                                        </th>
                                                                        <td class="field">
                                                                            <?php
                                                                            if( !empty( $wad_logo ))
                                                                            {
                                                                                echo '<img src="'.$wad_logo.'" width="150" alt="'.__('Company Logo', 'wad').'" />';
                                                                            }
                                                                            else
                                                                            {
                                                                                echo __('No logo uploaded.', 'wad');
                                                                            }
                                                                            ?>
                                                                            <span class="description">
                                                                                <span style="margin: 5px 0pt;">
                                                                                    <input type="text" id="wad_logo" name="wad_logo" style="width:400px;" value="<?php echo $wad_logo; ?>" /> 
                                                                                    <a class="button-secondary" id="wad_logo_media_button"><?php _e('Open Media','wad'); ?></a>
                                                                                </span>
                                                                                <?php _e('logos can be uploaded in JPG, GIF of PNG file.', 'wad'); ?> 
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- end .postbox -->
                                                </div>
                                                <!-- end .tuna_meta -->
                                                
                                                <div class="btn_container_with_menu" style="margin-top:40px;">
                                                    <input type="submit" value="<?php _e('Save Settings', 'wad'); ?>" class="main_button" name="wad_main_settings" />
                                                </div>
                                        	</form>
                                        </div>
                                        <!-- end #main-settings -->
                                        
                                        
                                        
                                        
                                        
                                        
                                        <div id="style-settings" style="display:none;" class="nfer">
                                            <h2><?php _e('Style','wad'); ?></h2>
                                            <em class="hr_line"></em>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="tuna_meta metabox-holder">
                                    
                                                    <div class="postbox nobg">
                                                        <div class="inside">
                                                            <table class="form-table">
                                                                <tbody>
                                                                 
                                                                 	<tr>
                                                                        <th scope="row">
                                                                            <?php _e( "Page Colors", 'wad' ); ?>
                                                                            <span class="description"><?php _e('The default colors used to style your pages.', 'wad'); ?></span>
                                                                        </th>
                                                                        <td>
                                                                            <div>
                                                                            	<?php _e( "Main Color", 'wad' ); ?><br />
                                                                            	<input name="main_color" type="text" class="wad_colorpick" value="<?php echo $wad_main_color; ?>">
                                                                                <span class="description" style="margin: -5px 0 10px 0;">
                                                                                	<?php _e( "The main color used for the header", 'wad' ); ?>
                                                                                </span>
                                                                            </div>
                                                                            <div>
                                                                            	<?php _e( "Dark Color", 'wad' ); ?><br />
                                                                            	<input name="dark_color" type="text" class="wad_colorpick" value="<?php echo $wad_dark_color; ?>">
                                                                                <span class="description" style="margin: -5px 0 10px 0;">
                                                                                	<?php _e( "A slightly darker version of the main color.", 'wad' ); ?>
                                                                                </span>
                                                                            </div>
                                                                            <span class="description"></span>
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- end .postbox -->
                                                </div>
                                                <!-- end .tuna_meta -->
                                                
                                                <div class="btn_container_with_menu" style="margin-top:40px;">
                                                    <input type="submit" value="<?php _e('Save Settings', 'wad'); ?>" class="main_button" name="wad_style_settings" />
                                                </div>
                                        	</form>
                                        </div>
                                        <!-- end #style-settings -->
                                        
                                        
                                        
                                        
                                        
                                        <div id="permalink-settings" style="display:none;" class="nfer">
                                            <h2><?php _e('Permalinks','wad'); ?></h2>
                                            <em class="hr_line"></em>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="tuna_meta metabox-holder">
                                                
                                                	<div style="background-color:#F8F1B0; border:solid 1px #946300; border-radius:5px; padding:10px;">
                                                    	<strong><?php _e('NOTE:','wad'); ?></strong> <?php echo sprintf(__('After changing these values you will need to update your %s!','wad'), '<a href="'.get_admin_url().'options-permalink.php">'.__('permalinks','wad').'</a>'); ?>
                                                    </div>
                                    
                                                    <div class="postbox nobg">
                                                        <div class="inside">
                                                            <table class="form-table">
                                                                <tbody>
                                                                 
                                                                 	<tr>
                                                                        <th scope="row">
                                                                            <?php _e( "Docs Post Type", 'wad' ); ?>
                                                                            <span class="description"><?php _e('Add your preferred Document post type slug.', 'wad'); ?></span>
                                                                        </th>
                                                                        <td>
                                                                            <input name="wad_post_type" type="text" value="<?php echo $wad_post_type; ?>">  
                                                                            <span class="description"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <?php _e( "Docs Categories", 'wad' ); ?>
                                                                            <span class="description"><?php _e('Add your preferred category slug.', 'wad'); ?></span>
                                                                        </th>
                                                                        <td>
                                                                            <input name="wad_category" type="text" value="<?php echo $wad_category; ?>">  
                                                                            <span class="description"></span>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <?php _e( "Docs Tags", 'wad' ); ?>
                                                                            <span class="description"><?php _e('Add your preferred tag slug.', 'wad'); ?></span>
                                                                        </th>
                                                                        <td>
                                                                            <input name="wad_tags" type="text" value="<?php echo $wad_tags; ?>">  
                                                                            <span class="description"></span>
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- end .postbox -->
                                                </div>
                                                <!-- end .tuna_meta -->
                                                
                                                <div class="btn_container_with_menu" style="margin-top:40px;">
                                                    <input type="submit" value="<?php _e('Save Settings', 'wad'); ?>" class="main_button" name="wad_permalink_settings" />
                                                </div>
                                        	</form>
                                        </div>
                                        <!-- end #permalink-settings -->
                                        
                                        
                                        
                                        
                                        
                                        <div id="devtab" class="nfer" style="display:none;">
                                            <h2><?php _e('Developing','snipr'); ?></h2>
                                            <em class="hr_line"></em>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="tuna_meta metabox-holder">
                                    
                                                    <div class="postbox nobg">
                                                        <div class="inside">
                                                            <table class="form-table">
                                                                <tbody>
                                                                    <tr>
                                                                        <th scope="row">
                                                                            <?php _e( "Enable developing mode", 'wad' ); ?>
                                                                            <span class="description"><?php _e('Do you want to enable the plugin developing mode?', 'wad'); ?></span>
                                                                        </th>
                                                                        <td>
                                                                            <select name="wad_developing_mode">
                                                                               <option value="0" <?php echo selected( 0, $wad_developing_mode, false ); ?>><?php _e('No', 'wad'); ?></option>
                                                                               <option value="1" <?php echo selected( 1, $wad_developing_mode, false ); ?>><?php _e('Yes', 'wad'); ?></option>
                                                                            </select>
                                                                            <span class="description"></span>
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- end .postbox -->
                                                </div>
                                                <!-- end .tuna_meta -->
                                                
                                                <div class="btn_container_with_menu" style="margin-top:40px;">
                                                    <input type="submit" value="<?php _e('Save Settings', 'wad'); ?>" class="main_button" name="wad_plugin_developing" />
                                                </div>
                                        	</form>
                                        </div>
                                        <!-- end #devtab -->
										<?php
									}
									?>
                                        
                                    
                                    
                                </div>
                                <!-- end .customization_right_in -->
                            </div>
                            <!-- end #tuna_tab_right -->
                        </td>
                    </tr>
                </table>
                
                
                
            </div> <!-- end tablist -->
            
            
            
            
            
            
            
            
        	
        </div>
        <div class="sidebar ad_dasboard_boxes">
        	
            <div class="content">
            	<h2>#wikiapidocs <small style="font-size:14px; color:#999;"><em><?php echo WAD_VERSION; ?></em></small></h2>
                <p>
                	<?php echo sprintf(__('Thanks for using the %s Wordpress plugin. We hope you like it.','wad'), '"Wiki API Docs"'); ?>
                </p>
                <hr />
                <!--<p>
                	<a href="http://wordpress-advertising.com/faq/" class="wpproads_info_btn" target="_blank">
                        <i class="fa fa-question"></i>
                        <?php _e('FAQ','wad'); ?>
                    </a>
                </p>-->
                <p>
                	<a href="http://tunasite.com/helpdesk/" class="snipr_info_btn" target="_blank">
                        <i class="fa fa-comments-o"></i>
                        <?php _e('Helpdesk','wad'); ?>
                    </a>
                </p>
                <p>
                	<a href="http://wpsnipr.com/index.php/api/" class="snipr_info_btn" target="_blank">
                        <i class="fa fa-cog"></i>
                        <?php _e('API','wad'); ?>
                    </a>
                </p>
                
            </div>
            
        </div>
    </div>
    
</div>
<!-- end wrap -->


<script type='text/javascript'>
jQuery(document).ready(function($) {
	
	// Color Picker
	$('.wad_colorpick').wpColorPicker();
	
	
	
	/*
	 * Media Popup - works for admins only
	*/
	$('#wad_logo_media_button').click(function()
	{
		wp.media.editor.send.attachment = function(props, attachment)
		{
			$('#wad_logo').val(attachment.url);
		}
		wp.media.editor.open(this);
		
		return false;
	});
   
	
    
    // switching between tabs
	$('#tuna_tab_left').find('a').click(function(){
		
		var nfer_id = $(this).data('target');
		
		$('.nfer').hide();
		$('#'+nfer_id).show();
		
		change_tab_position($(this));
		
		//window.location.hash = nfer_id;
		return false;
		
	});
	// position of the arrow
	function change_tab_position(obj){

		// class switch
		$('#tuna_tab_left').find('a').removeClass('focused');
		obj.addClass('focused');

		var menu_position = obj.position();
		$('#tuna_tab_arrow').css({'top':(menu_position.top+3)+'px'}).show();
	}
    
});
</script>