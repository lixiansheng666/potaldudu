<?php
$options_alice = get_option('alice'); 
?>

<?php if( !empty($options_alice['global_optional_header_menu']) && $options_alice['global_optional_header_menu'] == 'show') { ?>
<!-- Start Search/Share Menu -->
<div class="optional-menu" data-menu="<?php echo esc_attr($options_alice['global_optional_header_menu_scroll']); ?>">
    <?php if( !empty($options_alice['global_menu_share_button']) && $options_alice['global_menu_share_button'] == 'enable') { ?>
    <a class="menu-share open-modal-share"><?php _e('Share', AZ_THEME_NAME); ?></a>
    <?php } ?>
    <?php if( !empty($options_alice['global_menu_search_button']) && $options_alice['global_menu_search_button'] == 'enable') { ?>
    <a class="menu-search open-modal-search"><?php _e('Search', AZ_THEME_NAME); ?></a>
    <?php } ?>
    <?php if( !empty($options_alice['global_menu_language_button']) && $options_alice['global_menu_language_button'] == 'enable') { ?>
	<?php
	if( class_exists( 'SitePress' )) {
		if( function_exists( 'icl_get_languages' )) {
		$languages = icl_get_languages('skip_missing=0&orderby=code');
			if(!empty($languages)){
				echo '<div id="az_header_language_list">';
				foreach($languages as $l){
					echo '<span class="lang">';
					if(!$l['active']) echo '<a href="'.$l['url'].'">';
					echo icl_disp_language($l['language_code'], 0);
					if(!$l['active']) echo '</a>';
					echo '</span>';
				}
				echo '</div>';
			}
		}
	}
	?>
	<?php } ?>
</div>
<!-- End Search/Share Menu -->
<?php } ?>