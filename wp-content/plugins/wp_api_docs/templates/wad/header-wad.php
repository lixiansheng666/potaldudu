<?php
$wad_title = get_option('wad_title', __('Wiki API Docs','wad'));
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>> <!--<![endif]-->

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php echo $wad_title; ?></title>

<?php
if(function_exists('wp_head')) { wp_head(); }
?>
</head>

<body id="wad_container" <?php body_class(); ?>>

<div class="container desktop">

	<header>
    	<a href="#" data-toggle="#sidebar" id="header-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </a>
    	<h3><a href="<?php echo get_bloginfo('url').'/'.WAD_POST_TYPE; ?>"><?php echo $wad_title; ?>gsdfgdfsgdsfgsfdgsf</a></h3>
    </header>
    
   