<?php
header("Content-type: text/css; charset: UTF-8");

$main_color = get_option('wad_main_color', '#DF314D');
$dark_color = get_option('wad_dark_color', '#BB3248');
?>

/* ----------------------------------- header ------------------------------------- */
#wad_container header {
	background: <?php echo $main_color; ?>;
}


/**
 * RESPONSIVE
 */
@media only screen and (max-width: 480px), only screen and (max-device-width: 480px) {
    #wad_container header {
        background: -moz-linear-gradient(top,<?php echo $main_color; ?> 0,<?php echo $dark_color; ?> 100%);
        background: -webkit-linear-gradient(top,<?php echo $main_color; ?> 0,<?php echo $dark_color; ?> 100%);
        background: -o-linear-gradient(top,<?php echo $main_color; ?> 0,<?php echo $dark_color; ?> 100%);
        background: -ms-linear-gradient(top,<?php echo $main_color; ?> 0,<?php echo $dark_color; ?> 100%);
        background: linear-gradient(top,<?php echo $main_color; ?> 0,<?php echo $dark_color; ?> 100%);
    }
    
    #wad_container #header-toggle {
    	background: <?php echo $main_color; ?>;
        border: 1px solid <?php echo $dark_color; ?>;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.35),0 1px 0 <?php echo $dark_color; ?>;
        background: -o-linear-gradient(top,rgba(233, 30, 99, 0) 0,<?php echo $dark_color; ?> 100%);
        background: -ms-linear-gradient(top,rgba(233, 30, 99, 0) 0,<?php echo $dark_color; ?> 100%);
        background: -moz-linear-gradient(top,rgba(233, 30, 99, 0) 0,<?php echo $dark_color; ?> 100%);
        background: -webkit-linear-gradient(top,rgba(233, 30, 99, 0) 0,<?php echo $dark_color; ?> 100%);
        background: linear-gradient(top,rgba(233, 30, 99, 0) 0,<?php echo $dark_color; ?> 100%);	
    	
    }
}



    