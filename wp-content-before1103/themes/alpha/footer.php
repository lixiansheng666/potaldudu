<?php
/**
 * The footer of the theme
 */
?>

		<?php if ( ! is_page_template( 'template-portfolio.php' ) ) : ?>
			<!-- Footer Wrapper Start -->
			<footer id="footer"<?php if ( get_option( 'alpha_footer_type' ) == 'normal' ) : ?> class="w-normal"<?php endif; ?>>

				<?php if ( get_option( 'alpha_footer_type' ) == 'normal' ) : ?>
					<div class="normal lazybg" data-bg="<?php echo esc_url( get_option( 'alpha_footer_img' ) ); ?>">
						<?php dynamic_sidebar( 'alpha_footer_widget_sec_1' ); ?>
					</div>
				<?php endif; ?>
				<div class="minimal"><?php dynamic_sidebar( 'alpha_footer_widget' ); ?></div>

			</footer>
			<!-- Footer Wrapper End -->
		<?php endif; ?>

		</main>
		<!-- Main Wrapper End -->

		<!-- GTT Button -->
		<a id="top" href="#"><?php echo alpha_svg( 'arrow_up' ); ?></a> 

		<!-- IE7 Message Start -->
		<div id="oldie">
			<p><?php esc_html_e('This is a unique website which will require a more modern browser to work!', 'alpha'); ?><br /><br />
			<a href="<?php echo esc_url( 'https://www.google.com/chrome/' ); ?>" target="_blank"><?php esc_html_e('Please upgrade today!', 'alpha'); ?></a>
			</p>
		</div>
		<!-- IE7 Message End -->

	</div>

	<div id="preloader" data-ajax="<?php echo esc_attr( get_option( 'alpha_ajax', 'enabled' ) ); ?>"></div>

	<?php wp_footer(); ?>

</body>
</html>