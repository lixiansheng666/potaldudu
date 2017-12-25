<?php
$options_alice = get_option('alice'); 

$share_btn = $search_btn = $lang_switch = null;
if( !empty($options_alice['global_optional_header_menu']) && $options_alice['global_optional_header_menu'] == 'show') {
	// Share Btn
	if( !empty($options_alice['global_menu_share_button']) && $options_alice['global_menu_share_button'] == 'enable') {
		$share_btn = '<li><a class="menu-share open-modal-share"><i class="font-icon-share"></i></a></li>';
	}
	// Search Btn
	if( !empty($options_alice['global_menu_search_button']) && $options_alice['global_menu_search_button'] == 'enable') {
		$search_btn = '<li><a class="menu-search open-modal-search"><i class="font-icon-search"></i></a></li>';
	}
	// Language Switcher
	if( !empty($options_alice['global_menu_language_button']) && $options_alice['global_menu_language_button'] == 'enable') {
		if( class_exists( 'SitePress' )) {
			if( function_exists( 'icl_get_languages' )) {
			$languages = icl_get_languages('skip_missing=0&orderby=code');
				if(!empty($languages)){
					$lang_switch .= '<li class="lang_switch"><div id="az_header_language_list">';
					foreach($languages as $l){
						$lang_switch .=  '<span class="lang">';
						if(!$l['active']) $lang_switch .= '<a href="'.$l['url'].'">';
						$lang_switch .=  icl_disp_language($l['language_code'], 0);
						if(!$l['active']) $lang_switch .= '</a>';
						$lang_switch .=  '</span>';
					}
					$lang_switch .= '</div></li>';
				}
			}
		}
	}
}
?>

<!-- Start Menu Panel -->
<nav class="mm-classic-panel">
    <?php if ( has_nav_menu( 'primary_menu' ) ) {

        wp_nav_menu( array(
            'container' => false,
            'menu_class' => 'sf-menu',
            'echo' => true,
            'before' => '',
            'after' => '',
            'link_before' => '',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s'.$lang_switch.$search_btn.$share_btn.'</ul>',
            'link_after' => '',
            'depth' => 2,
            'theme_location' => 'primary_menu',
            'walker' => new az_Nav_Walker()
            )
        );

    } else {

        echo '<ul class="sf-menu"><li><a href="#">'. __('No menu assigned!', AZ_THEME_NAME ) . '</a></li></ul>';

    } ?>

</nav>
<!-- End Menu Panel -->