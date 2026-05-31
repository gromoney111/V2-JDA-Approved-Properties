<?php
/**
 * 404 not found template.
 *
 * @package V2JDA
 */

get_header();
?>

<section class="page-hero" style="padding-bottom:160px">
	<div class="container">
		<h1 data-aos="fade-up" style="font-size: clamp(3rem, 8vw, 6rem)">404</h1>
		<p class="crumbs" data-aos="fade-up" data-delay="100" style="font-size:1.1rem; color:#fff">
			<?php esc_html_e( 'The page you are looking for could not be found.', 'v2jda' ); ?>
		</p>
		<div data-aos="fade-up" data-delay="200" style="margin-top:24px">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary"><i class="fa-solid fa-home"></i> <?php esc_html_e( 'Back to Home', 'v2jda' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="btn btn-outline" style="margin-left:8px"><i class="fa-solid fa-building"></i> <?php esc_html_e( 'Browse Projects', 'v2jda' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer();
