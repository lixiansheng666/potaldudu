<!DOCTYPE html>
<!--[if lt IE 9]> <html <?php language_attributes(); ?> class="ie8 ie" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml"> <!--<![endif]-->
<head>

	<!-- META -->

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta name="msapplication-tap-highlight" content="no" />

	<!-- LINKS -->

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!-- WP HEAD -->

	<?php wp_head(); ?>
		
</head>

<body id="body" <?php body_class(); ?> data-background="<?php alpha_header_color(); ?>">

	<div id="wrapper">

	    <!-- Primary Header Start -->
	    <header id="header" class="clearfix">

			<!-- Logo Start -->
			<div id="logo-holder" class="left" itemscope itemtype="http://schema.org/Organization">

				<?php 

				$logo_light = get_option( 'alpha_logo_light', get_template_directory_uri() . '/images/logo-light.png');
				$logo_dark = get_option( 'alpha_logo_dark', get_template_directory_uri() . '/images/logo-dark.png' );

				?>

				<a id="logo" href="<?php echo esc_url( home_url('/') ); ?>" style="width:<?php echo get_option( 'alpha_logo_width', '70' ); ?>px;height:auto;" itemprop="url">

					<div class="light">
						<img class="regular-logo" src="<?php echo esc_url( $logo_light ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="logo" />
					</div>
					
					<div class="dark">
						<img class="regular-logo" src="<?php echo esc_url( $logo_dark ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" itemprop="logo" />
					</div>

				</a>

			</div>
			<!-- Logo End -->

	        <div id="menu-holder" class="right">
				<a id="menu-opener" class="lines-button" href="#"><span class="lines"></span></a>
			</div>

			<a class="post-close" href="#"><?php echo alpha_svg('close'); ?></a>

		</header>
		<!-- Primary Header End -->

        <!-- Menu Start -->
		<nav id="main-menu" class="clearfix style-full lazybg" style="background-color:<?php echo get_option( 'alpha_menu_bg_color', '#222' ); ?>" data-bg="<?php echo get_option( 'alpha_menu_bg_img', '' ); ?>">
	        	
        	<div>

				<?php if ( has_nav_menu( 'primary' ) ) :

					wp_nav_menu( array(
						'container' => false,
						'menu_class' => 'clearfix top-menu',
						'echo' => true,
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 2,
						'theme_location' => 'primary',
						'walker' => new Alpha_Nav_Walker()
						)
					);

				else : ?>

					<ul class="top-menu">           
						<li class="menu-item"><a href="<?php echo esc_url( home_url('/') ); ?>"><?php _e( 'Homepage', 'alpha' ); ?></a></li>     
					    <li class="menu-item"><a href="<?php echo admin_url('nav-menus.php'); ?>"><?php _e( 'Set Up Your Menu', 'alpha' ); ?></a></li>
					</ul>

				<?php endif; ?>

				<div id="menu-widget"><?php echo do_shortcode( get_option( 'alpha_menu_text' ) ); ?></div>

			</div>

		</nav>	
		<!-- Menu End -->

		<!-- Main Wrapper Start -->

		<main id="content">