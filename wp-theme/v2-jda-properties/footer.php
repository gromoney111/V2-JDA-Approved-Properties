<?php
/**
 * Site footer.
 *
 * @package V2JDA
 */
?>
</main><!-- #content -->

<footer class="site-footer" role="contentinfo">
	<div class="container foot-grid">
		<div class="foot-col foot-about">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo" style="margin-bottom:16px">
				<span class="mark">V2</span>
				<span style="color:#fff"><?php bloginfo( 'name' ); ?><small><?php esc_html_e( 'JDA & RERA Approved', 'v2jda' ); ?></small></span>
			</a>
			<p><?php echo esc_html( get_bloginfo( 'description' ) ?: 'Your trusted partner for JDA & RERA approved residential plots, villas and farm-house land across Jaipur.' ); ?></p>
			<div class="socials">
				<?php
				$socials = array(
					'facebook'  => 'fa-brands fa-facebook-f',
					'youtube'   => 'fa-brands fa-youtube',
					'instagram' => 'fa-brands fa-instagram',
					'whatsapp'  => 'fa-brands fa-whatsapp',
				);
				foreach ( $socials as $key => $icon ) {
					$url = v2jda_opt( "social_$key" );
					if ( $url ) {
						printf(
							'<a href="%s" target="_blank" rel="noopener" aria-label="%s"><i class="%s"></i></a>',
							esc_url( $url ), esc_attr( ucfirst( $key ) ), esc_attr( $icon )
						);
					}
				}
				$email = v2jda_opt( 'email' );
				if ( $email ) {
					printf( '<a href="mailto:%1$s" aria-label="Email"><i class="fa-solid fa-envelope"></i></a>', esc_attr( $email ) );
				}
				?>
			</div>
		</div>

		<div class="foot-col">
			<h4><?php esc_html_e( 'Quick Links', 'v2jda' ); ?></h4>
			<?php
			if ( has_nav_menu( 'footer' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'container'      => false,
					'items_wrap'     => '%3$s',
				) );
			} else {
				$links = array(
					'/'          => 'Home',
					'/about/'    => 'About Us',
					'/projects/' => 'Projects',
					'/gallery/'  => 'Gallery',
					'/media/'    => 'Media',
					'/contact/'  => 'Contact',
				);
				foreach ( $links as $url => $label ) {
					printf( '<a href="%s">%s</a>', esc_url( home_url( $url ) ), esc_html( $label ) );
				}
			}
			?>
		</div>

		<div class="foot-col">
			<h4><?php esc_html_e( 'Services', 'v2jda' ); ?></h4>
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Ongoing Projects', 'v2jda' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Completed Projects', 'v2jda' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Upcoming Projects', 'v2jda' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Site Visit Booking', 'v2jda' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><?php esc_html_e( 'Investment Advice', 'v2jda' ); ?></a>
		</div>

		<div class="foot-col">
			<h4><?php esc_html_e( 'Get in Touch', 'v2jda' ); ?></h4>
			<a href="tel:+<?php echo esc_attr( preg_replace( '/\D/', '', v2jda_opt( 'phone_e164', '917597961878' ) ) ); ?>"><i class="fa-solid fa-phone" style="margin-right:8px;color:var(--brand)"></i> <?php echo esc_html( v2jda_opt( 'phone', '+91 75979 61878' ) ); ?></a>
			<a href="mailto:<?php echo esc_attr( v2jda_opt( 'email', 'vishalkhandelwal267@gmail.com' ) ); ?>"><i class="fa-solid fa-envelope" style="margin-right:8px;color:var(--brand)"></i> <?php echo esc_html( v2jda_opt( 'email', 'vishalkhandelwal267@gmail.com' ) ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>"><i class="fa-solid fa-location-dot" style="margin-right:8px;color:var(--brand)"></i> <?php echo esc_html( v2jda_opt( 'address', 'Jaipur, Rajasthan' ) ); ?></a>
		</div>
	</div>

	<div class="foot-bottom">
		<div class="container">
			&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'v2jda' ); ?>
			&nbsp;|&nbsp;
			<?php esc_html_e( 'In association with Shyamashish Group.', 'v2jda' ); ?>
		</div>
	</div>
</footer>

<?php v2jda_floating_cta(); ?>

<?php wp_footer(); ?>
</body>
</html>
