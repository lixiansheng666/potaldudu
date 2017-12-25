<?php
$options_alice = get_option('alice'); 

// Logo Top Value
$logo_top_value = '';
if (!empty($options_alice['logo_top_value'])) { 
	$logo_top_value = ' style="top:'.esc_attr($options_alice['logo_top_value']).'px;"';
}

// Logo Max-Height Value
$logo_max_height_value = '';
if (!empty($options_alice['logo_max_height_value'])) { 
	$logo_max_height_value = 'max-height:'.esc_attr($options_alice['logo_max_height_value']).'px;';
}

// Logo Options
if ( !empty($options_alice['use_logo_image']) ) {

    // Light
    $logo = $options_alice['logo'];
    $retina_logo = $options_alice['retina_logo'];
    $width = $options_alice['logo']['width'];
    $height = $options_alice['logo']['height'];

    if ($retina_logo['url'] == "" ) {
        $retina_logo['url'] = $logo['url'];
    }

    // Dark
    if ( !empty($options_alice['dark_logo']['url']) ) {
        $dark_logo = $options_alice['dark_logo'];
        $dark_retina_logo = $options_alice['dark_retina_logo'];
        $dark_width = $options_alice['dark_logo']['width'];
        $dark_height = $options_alice['dark_logo']['height'];

        if ($dark_retina_logo['url'] == "" ) {
            $dark_retina_logo['url'] = $dark_logo['url'];
        }
        $dark_img_logo = '<img class="standard dark-mod" src="'.$dark_logo['url'].'" alt="'.get_bloginfo('name').'" width="'.$dark_width.'" height="'.$dark_height.'" style="height: '.$dark_height.'px; '.$logo_max_height_value.'" />';
        $dark_img_retina_logo = '<img class="retina dark-mod" src="'.$dark_retina_logo['url'].'" alt="'.get_bloginfo('name').'" width="'.$dark_width.'" height="'.$dark_height.'" style="'.$logo_max_height_value.'" />';  
    } else {
        $dark_img_logo = $dark_img_retina_logo = '';
    }

}
?>

<!-- HEADER CREATIVE -->
<div id="nav-wrapper">

    <div class="wrap-position">
    	<?php
        if ( !empty($options_alice['use_logo_image'])) {?>
        <a class="logo-setup logo-img" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"<?php echo !empty( $logo_top_value ) ? $logo_top_value : ''; ?>>
            <img class="standard" src="<?php echo esc_url($logo['url']); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" style="height:<?php echo esc_attr($height); ?>px; <?php echo !empty( $logo_max_height_value ) ? $logo_max_height_value : ''; ?>" />
            <img class="retina" src="<?php echo esc_url($retina_logo['url']); ?>" alt="<?php bloginfo('name'); ?>" width="<?php echo esc_attr($width); ?>" height="<?php echo esc_attr($height); ?>" style="<?php echo !empty( $logo_max_height_value ) ? $logo_max_height_value : ''; ?>" />
            <?php if ( !empty($options_alice['dark_logo']['url']) ) { ?>
            <?php echo !empty( $dark_img_logo ) ? $dark_img_logo : '' . "\n"; ?>
            <?php echo !empty( $dark_img_retina_logo ) ? $dark_img_retina_logo : '' . "\n"; ?>
            <?php } ?>
        </a>    
        <?php } else { ?>
        <a class="logo-setup logo-text" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"<?php echo !empty( $logo_top_value ) ? $logo_top_value : ''; ?>><?php bloginfo('name'); ?></a>
        <?php } ?>
        <a class="menu-nav menu-trigger">
        	<div class="bars">
        		<i class="bar top"></i>
        		<i class="bar middle"></i>
        		<i class="bar bottom"></i>
        	</div>
        </a>

        <?php if( !empty($options_alice['global_menu_type']) && $options_alice['global_menu_type'] == 'creative') { ?>
            <?php get_template_part('framework/core/header/az-header-optional-menu'); ?>
        <?php } else { ?>
            <?php get_template_part('framework/core/header/az-header-classic-menu'); ?>
        <?php } ?>
    </div>

</div>
<!-- END HEADER CREATIVE -->
