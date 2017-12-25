<?php
/**
 * 404 Page Template
 */
get_header(); ?>

	<header id="page-header" class="uninit" style="background-color: #fff" data-height="1" data-background="light">
		<div>
			<div class="page-header-type">
				<h1><?php esc_html_e( 'Uh oh! (404 Error)', 'alpha' ); ?></h1>
				<h2 class="subtitle"><?php esc_html_e( 'We are really sorry but the page you requested is missing.', 'alpha' ); ?></h2>
			</div>
		</div>
	</header>

	<?php rewind_posts(); ?>

<?php get_footer(); ?>