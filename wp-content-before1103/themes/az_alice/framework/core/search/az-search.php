<?php
$options_alice = get_option('alice');

// Mobile Detect
$detect = new Mobile_Detect;
$device_version = '';
if ( $detect->isMobile() ) {
    $device_version = 'mobile-version';
} else {
    $device_version = 'desktop-version';
}

// Title Header
$bg_mode_output = $bg_mode_position = $bg_mode_repeat = $bg_mode_parallax = $text_color = $mask_output = $mask_rgba_value = null;

$search_title_header_visibility = $options_alice['search_title_header_visibility'];
$search_title_layout = $options_alice['search_title_header_layout_container'];
$search_title_height = $options_alice['search_title_header_height'];
$search_scroll = $options_alice['search_scroll_to_section'];
$search_title_module = $options_alice['search_title_header_module'];
$search_title_normal_bg_color = $options_alice['search_title_header_normal_bg_color'];
$search_title_image = $options_alice['search_title_header_image'];
$search_title_image_parallax = $options_alice['search_title_header_image_parallax'];
$search_title_img_position = $options_alice['search_title_header_image_position'];
$search_title_img_repeat = $options_alice['search_title_header_image_repeat'];
$search_title_mask = $options_alice['search_title_header_mask_mode'];
$search_title_mask_bg = $options_alice['search_title_header_mask_background'];
$search_title_mask_pattern = $options_alice['search_title_header_mask_pattern'];
$search_title_mask_pattern_opacity = $options_alice['search_title_header_mask_pattern_opacity'];
$search_title_text_color = $options_alice['search_title_header_text_color'];

// FullScreen/Normal Class
$mode_height = $fill_bg_h = $title_header_height_output = '';
if ( $search_title_layout == 'fullscreen') { 
    $title_header_layout_class = ' full-container';
    $mode_height = ' full-height';
} else {
    $title_header_layout_class = ' normal-container';
    $mode_height = ' normal-height';
}

// Check Height Value
if ( !empty($search_title_height) ) {
    $title_header_height_output = ' style="height: '.esc_attr($search_title_height).'px;"';
}

// Check Custom Background Color
if ( !empty($search_title_normal_bg_color) && !empty($search_title_height) ) { 
    $fill_bg_h = ' style="background-color: '.$search_title_normal_bg_color.'; height: '.esc_attr($search_title_height).'px;"'; 
}
else if ( empty($search_title_normal_bg_color) && !empty($search_title_height) ) {
    $fill_bg_h = ' style="height: '.esc_attr($search_title_height).'px;"'; 
}
else if ( !empty($search_title_normal_bg_color) && empty($search_title_height) ) {
    $fill_bg_h = ' style="background-color: '.$search_title_normal_bg_color.';"';
}

// Check Custom Text Color
if (!empty($search_title_text_color)) { 
    $text_color = ' style="color: '.$search_title_text_color.';"'; 
}

// Background Position
if ( $search_title_img_position == 'left_top') {
    $bg_mode_position = 'left top';
} else if ( $search_title_img_position == 'left_center') {
    $bg_mode_position = 'left center';
} else if ( $search_title_img_position == 'left_bottom') {
    $bg_mode_position = 'left bottom';
} else if ( $search_title_img_position == 'right_top') {
    $bg_mode_position = 'right top';
} else if ( $search_title_img_position == 'right_center') {
    $bg_mode_position = 'right center';
} else if ( $search_title_img_position == 'right_bottom') {
    $bg_mode_position = 'right bottom';
} else if ( $search_title_img_position == 'center_top') {
    $bg_mode_position = 'center top';
} else if ( $search_title_img_position == 'center_bottom') {
    $bg_mode_position = 'center bottom';
} else {
    $bg_mode_position = 'center center';
}

// Background Repeat
if ( $search_title_img_repeat == 'no_repeat') {
    $bg_mode_repeat = 'background-repeat: no-repeat;';
} else if ( $search_title_img_repeat == 'repeat') {
    $bg_mode_repeat = 'background-repeat: repeat;';
} else if ( $search_title_img_repeat == 'repeat_x') {
    $bg_mode_repeat = 'background-repeat: repeat-x;';
} else if ( $search_title_img_repeat == 'repeat_y') {
    $bg_mode_repeat = 'background-repeat: repeat-y;';
} else {
    $bg_mode_repeat = 'background-repeat: no-repeat; background-size: cover;';
}

// Output Title Header Image Output
if ( !empty($search_title_image['url']) ) {
    $bg_mode_output = ' style="background-image: url('.$search_title_image['url'].'); background-position:'.$bg_mode_position.'; '.$bg_mode_repeat.'"';
}
if ( !empty($search_title_height) && !empty($search_title_image['url']) ) {
    $bg_mode_output = ' style="background-image: url('.$search_title_image['url'].'); background-position:'.$bg_mode_position.'; '.$bg_mode_repeat.' height: '.esc_attr($search_title_height).'px;"';
}

// Output Title Header Image Parallax
if ( !empty($search_title_image_parallax['url']) ) {
    $bg_mode_parallax = ' style="background-image: url('.$search_title_image_parallax['url'].');"';
}
if ( !empty($search_title_height) && !empty($search_title_image_parallax['url']) ) {
    $bg_mode_parallax = ' style="background-image: url('.$search_title_image_parallax['url'].'); height: '.esc_attr($search_title_height).'px;"';
}

// Check Mask Module
if ( $search_title_mask == 'mask_color' || $search_title_mask == 'mask_pattern_color' ) {
    $mask_rgba_value = Redux_Helpers::hex2rgba(''.$search_title_mask_bg['color'].'', ''.$search_title_mask_bg['alpha'].'');
}

if ( $search_title_mask == 'mask_color') {
    $mask_output = '<span class="overlay-bg" style="background-color: '.$mask_rgba_value.';"></span>';
} else if ( $search_title_mask == 'mask_pattern') {
    $mask_output = '<span class="overlay-pattern" style="background-image: url('.$search_title_mask_pattern['url'].'); opacity: '.$search_title_mask_pattern_opacity.';"></span>';
} else if ( $search_title_mask == 'mask_pattern_color') {
    $mask_output = '<span class="overlay-pattern" style="background-image: url('.$search_title_mask_pattern['url'].'); opacity: '.$search_title_mask_pattern_opacity.';"></span><span class="overlay-bg" style="background-color: '.$mask_rgba_value.';"></span>';
} else {
    $mask_output = '';
}
?>

<div class="wrap-title-header <?php echo esc_attr($device_version); ?>"> 
<?php if($search_title_header_visibility == 'show') { ?>
    
    <div class="fake-layer-spacer<?php echo esc_attr($mode_height); ?>"<?php echo !empty( $title_header_height_output ) ? $title_header_height_output : ''; ?>></div>

    <?php if ( $search_title_module == 'image') { ?>

    <div id="image-header" class="title-header-spacer">
        <div class="title-header-container imagize<?php echo esc_attr($mode_height); ?><?php echo esc_attr($title_header_layout_class); ?>"<?php echo !empty( $bg_mode_output ) ? $bg_mode_output : ''; ?>>
            <?php echo !empty( $mask_output ) ? $mask_output : ''; ?>
            <div class="box-content">
                <div class="box-content-titles">
                    <h1 class="title"<?php echo !empty( $text_color ) ? $text_color : ''; ?>><?php echo az_custom_get_page_title(); ?></h1>
                </div>
            </div>
        </div>
        <?php if($search_title_layout == 'fullscreen' && $search_scroll == 'enable') { echo '<a class="scroll-btn-full-area-title-header"><i class="font-icon-arrow-down-simple-thin-round animated-opacity"></i></a>'; } ?>
    </div>

    <?php } else if ( $search_title_module == 'image_parallax') { ?>
    
    <div id="image-parallax-header" class="title-header-spacer">
        <div class="title-header-container imagize-parallax<?php echo esc_attr($mode_height); ?><?php echo esc_attr($title_header_layout_class); ?>"<?php echo !empty( $bg_mode_parallax ) ? $bg_mode_parallax : ''; ?>>
            <?php echo !empty( $mask_output ) ? $mask_output : ''; ?>
            <div class="box-content">
                <div class="box-content-titles">
                    <h1 class="title"<?php echo !empty( $text_color ) ? $text_color : ''; ?>><?php echo az_custom_get_page_title(); ?></h1>
                </div>
            </div>
        </div>
        <?php if($search_title_layout == 'fullscreen' && $search_scroll == 'enable') { echo '<a class="scroll-btn-full-area-title-header"><i class="font-icon-arrow-down-simple-thin-round animated-opacity"></i></a>'; } ?>
    </div>
    
    <?php } else { ?>
    
    <div id="text-header" class="title-header-spacer">           
        <div class="title-header-container<?php echo esc_attr($mode_height); ?><?php echo esc_attr($title_header_layout_class); ?>"<?php echo !empty( $fill_bg_h ) ? $fill_bg_h : ''; ?>>
            <div class="box-content">
                <div class="box-content-titles">
                    <h1 class="title"<?php echo !empty( $text_color ) ? $text_color : ''; ?>><?php echo az_custom_get_page_title(); ?></h1>
                </div>
            </div>
        </div>
        <?php if($search_title_layout == 'fullscreen' && $search_scroll == 'enable') { echo '<a class="scroll-btn-full-area-title-header"><i class="font-icon-arrow-down-simple-thin-round animated-opacity"></i></a>'; } ?>
    </div>
    
    <?php } ?>

<?php } else { ?>
    
    <div class="no-page-header colorful-version"></div>

<?php } ?>
</div>
