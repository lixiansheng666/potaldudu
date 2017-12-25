<?php
$options_alice = get_option('alice'); 

// Left Side Bg Color/Bg Image
$bg_slogan_visibility = $bg_slogan_class = $bg_solid_color_output = $bg_overlay_mask = $bg_background_image = '';

// Slogan Class
if ( $options_alice['left_side_slogan_visibility'] == 'show' ){
    $bg_slogan_visibility = 'slogan-enabled';
} else {
    $bg_slogan_visibility = 'slogan-disabled';
}

$bg_slogan_menu = (!empty($options_alice['left_side_header_menu'])) ? $options_alice['left_side_header_menu'] : 'solid_color';

if ($bg_slogan_menu == 'solid_color') {
    $bg_slogan_class = 'bg-solid-color-slogan';

    if (!empty($options_alice['left_side_background_color'])) { 
        $bg_solid_color_output = ' style="background-color: '.$options_alice['left_side_background_color'].';"';
    }
}
else if ($bg_slogan_menu == 'bg_image') {
    $bg_img_position = $bg_img_repeat = '';
    $check_img_position = $options_alice['left_side_background_image_position'];
    $check_img_repeat = $options_alice['left_side_background_image_repeat'];

    // Background Position
    if ( $check_img_position == 'left_top') {
        $bg_img_position = 'left top';
    } else if ( $check_img_position == 'left_center') {
        $bg_img_position = 'left center';
    } else if ( $check_img_position == 'left_bottom') {
        $bg_img_position = 'left bottom';
    } else if ( $check_img_position == 'right_top') {
        $bg_img_position = 'right top';
    } else if ( $check_img_position == 'right_center') {
        $bg_img_position = 'right center';
    } else if ( $check_img_position == 'right_bottom') {
        $bg_img_position = 'right bottom';
    } else if ( $check_img_position == 'center_top') {
        $bg_img_position = 'center top';
    } else if ( $check_img_position == 'center_bottom') {
        $bg_img_position = 'center bottom';
    } else {
        $bg_img_position = 'center center';
    }

    // Background Repeat
    if ( $check_img_repeat == 'no_repeat') {
        $bg_img_repeat = 'background-repeat: no-repeat;';
    } else if ( $check_img_repeat == 'repeat') {
        $bg_img_repeat = 'background-repeat: repeat;';
    } else if ( $check_img_repeat == 'repeat_x') {
        $bg_img_repeat = 'background-repeat: repeat-x;';
    } else if ( $check_img_repeat == 'repeat_y') {
        $bg_img_repeat = 'background-repeat: repeat-y;';
    } else {
        $bg_img_repeat = 'background-repeat: no-repeat; background-size: cover;';
    }

    $rgba_value = Redux_Helpers::hex2rgba(''.$options_alice['left_side_overaly_mask_color']['color'].'', ''.$options_alice['left_side_overaly_mask_color']['alpha'].'');

    $bg_slogan_class = 'bg-image-slogan';
    $bg_overlay_mask = '<span class="bg-image-slogan-mask" style="background-color: '.$rgba_value.';"></span>';
    $bg_background_image = ' style="background-image: url('.$options_alice['left_side_background_image']['url'].'); background-position:'.$bg_img_position.'; '.$bg_img_repeat.'"';
}

// Slogan Text Color
$slogant_text_color = (!empty($options_alice['left_side_header_slogan_text_color'])) ? ' style="color: '.$options_alice['left_side_header_slogan_text_color'].';"' : '';
?>

<div id="my-menu" class="<?php echo esc_attr($bg_slogan_visibility); ?>">
    <?php if ( $options_alice['left_side_slogan_visibility'] == 'show' ){ ?>
    <!-- Start Slogan Panel -->
    <div class="bg-slogan-menu <?php echo esc_attr($bg_slogan_class); ?>"<?php echo !empty( $bg_solid_color_output ) ? $bg_solid_color_output : ''; ?><?php echo !empty( $bg_background_image ) ? $bg_background_image : ''; ?>>
        <?php echo !empty( $bg_overlay_mask ) ? $bg_overlay_mask : ''; ?>
        <div class="bg-slogan-content">
            <?php
            if ( !empty($options_alice['left_side_header_slogan_logo']['url'])) { ?>
            <a class="slogan-logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
                <img class="standard" src="<?php echo esc_url($options_alice['left_side_header_slogan_logo']['url']); ?>" width="<?php echo esc_attr($options_alice['left_side_header_slogan_logo']['width']); ?>" height="<?php echo esc_attr($options_alice['left_side_header_slogan_logo']['height']); ?>" alt="<?php bloginfo('name'); ?>" />
            </a>   
            <?php } ?>
            <?php
            if ( !empty($options_alice['left_side_header_slogan_text'])) { 
                $slogan_text_output = $options_alice['left_side_header_slogan_text'];
                $allowed_tags = array(
                    'br' => array(),
                    'strong' => array()
                ); 
            ?>
            <h3 class="slogan-text"<?php echo !empty( $slogant_text_color ) ? $slogant_text_color : ''; ?>><?php echo wp_kses($slogan_text_output, $allowed_tags); ?></h3>
            <?php } ?>
        </div>
    </div>
    <!-- End Slogan Panel -->
    <?php } ?>

    <!-- Start Menu Panel -->
    <nav class="mm-panel">
        <?php if ( has_nav_menu( 'primary_menu' ) ) {

            wp_nav_menu( array(
                'container' => false,
                'menu_class' => 'sf-menu',
                'echo' => true,
                'before' => '',
                'after' => '',
                'link_before' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
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

    <!-- Start Close Menu -->
    <a class="menu-trigger-close">
        <div class="bars">
            <i class="bar top"></i>
            <i class="bar bottom"></i>
        </div>
    </a>
    <!-- End Close Menu -->

    <?php get_template_part('framework/core/header/az-header-optional-menu'); ?>

    <?php if( !empty($options_alice['header_social_link']) && $options_alice['header_social_link'] == 1) { ?>

        <?php get_template_part('framework/core/header/az-socialize-links'); ?>
    
    <?php } ?>

</div>

