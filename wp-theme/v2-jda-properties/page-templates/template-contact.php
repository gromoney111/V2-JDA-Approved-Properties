<?php
/**
 * Template Name: V2 JDA - Contact
 *
 * @package V2JDA
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<h1 data-aos="fade-up"><?php esc_html_e( 'Get in Touch', 'v2jda' ); ?></h1>
		<p class="crumbs" data-aos="fade-up" data-delay="100"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'v2jda' ); ?></a> &nbsp;/&nbsp; <?php esc_html_e( 'Contact', 'v2jda' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="contact-grid">
			<div class="contact-info" data-aos="fade-right">
				<h3><?php esc_html_e( 'Talk to a property expert', 'v2jda' ); ?></h3>
				<p><?php esc_html_e( 'Share your requirement and we will get back to you with the best matching JDA approved options.', 'v2jda' ); ?></p>

				<ul class="info-list">
					<li>
						<i class="fa-solid fa-phone"></i>
						<div>
							<strong><?php esc_html_e( 'Call us', 'v2jda' ); ?></strong>
							<a href="tel:+<?php echo esc_attr( preg_replace( '/\D/', '', v2jda_opt( 'phone_e164', '917597961878' ) ) ); ?>"><?php echo esc_html( v2jda_opt( 'phone', '+91 75979 61878' ) ); ?></a>
						</div>
					</li>
					<li>
						<i class="fa-solid fa-envelope"></i>
						<div>
							<strong><?php esc_html_e( 'Email', 'v2jda' ); ?></strong>
							<a href="mailto:<?php echo esc_attr( v2jda_opt( 'email', 'vishalkhandelwal267@gmail.com' ) ); ?>"><?php echo esc_html( v2jda_opt( 'email', 'vishalkhandelwal267@gmail.com' ) ); ?></a>
						</div>
					</li>
					<li>
						<i class="fa-solid fa-location-dot"></i>
						<div>
							<strong><?php esc_html_e( 'Address', 'v2jda' ); ?></strong>
							<span><?php echo esc_html( v2jda_opt( 'address', 'Jaipur, Rajasthan, India' ) ); ?></span>
						</div>
					</li>
					<li>
						<i class="fa-brands fa-whatsapp"></i>
						<div>
							<strong><?php esc_html_e( 'WhatsApp', 'v2jda' ); ?></strong>
							<a href="<?php echo esc_url( v2jda_opt( 'social_whatsapp', 'https://wa.me/917597961878' ) ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Chat with us', 'v2jda' ); ?></a>
						</div>
					</li>
				</ul>

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
					?>
				</div>
			</div>

			<div data-aos="fade-left">
				<?php v2jda_lead_form(); ?>
			</div>
		</div>
	</div>
</section>

<section class="section section-soft" style="padding-top:0">
	<div class="container">
		<div data-aos="fade-up" style="border-radius:var(--radius); overflow:hidden; box-shadow: var(--shadow-sm)">
			<iframe
				src="https://www.google.com/maps?q=Jaipur,Rajasthan&output=embed"
				title="<?php esc_attr_e( 'V2 JDA Approved Properties location', 'v2jda' ); ?>"
				width="100%" height="380" style="border:0; display:block;"
				allowfullscreen loading="lazy"
				referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
</section>

<?php get_footer();
