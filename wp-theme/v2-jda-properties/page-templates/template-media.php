<?php
/**
 * Template Name: V2 JDA - Media
 *
 * @package V2JDA
 */

get_header();

$youtube_channel = v2jda_opt( 'social_youtube', 'https://youtube.com/@v2jdaapprovedproperties' );
$facebook_page   = v2jda_opt( 'social_facebook', 'https://www.facebook.com/share/1Ct7vcFE6Y/' );
?>

<section class="page-hero">
	<div class="container">
		<h1 data-aos="fade-up"><?php esc_html_e( 'Media & Press', 'v2jda' ); ?></h1>
		<p class="crumbs" data-aos="fade-up" data-delay="100"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'v2jda' ); ?></a> &nbsp;/&nbsp; <?php esc_html_e( 'Media', 'v2jda' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow" data-aos="fade-up"><?php esc_html_e( 'Latest Videos', 'v2jda' ); ?></span>
			<h2 data-aos="fade-up" data-delay="100"><?php esc_html_e( 'Walk-throughs & Project Updates', 'v2jda' ); ?></h2>
			<p data-aos="fade-up" data-delay="200">
				<?php esc_html_e( 'Watch our latest project tours on our YouTube channel.', 'v2jda' ); ?>
			</p>
		</div>

		<div class="media-grid">
			<?php
			// Embeds the channel's latest uploads via the channel's RSS. As a friendly default
			// we show a couple of placeholder embeds — replace YOUTUBE_VIDEO_ID values with
			// the actual project video IDs (or use the WordPress block editor on this page).
			$videos = array(
				array( 'id' => 'dQw4w9WgXcQ', 'title' => 'Project walk-through (sample)' ),
				array( 'id' => 'ScMzIvxBSi4', 'title' => 'Customer testimonial (sample)' ),
			);
			foreach ( $videos as $v ) : ?>
				<div class="video-card" data-aos="fade-up">
					<iframe src="https://www.youtube.com/embed/<?php echo esc_attr( $v['id'] ); ?>?rel=0" title="<?php echo esc_attr( $v['title'] ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen loading="lazy"></iframe>
					<div class="v-body">
						<h3><?php echo esc_html( $v['title'] ); ?></h3>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<div style="text-align:center; margin-top:40px" data-aos="fade-up">
			<a href="<?php echo esc_url( $youtube_channel ); ?>" target="_blank" rel="noopener" class="btn btn-primary"><i class="fa-brands fa-youtube"></i> <?php esc_html_e( 'Subscribe on YouTube', 'v2jda' ); ?></a>
		</div>
	</div>
</section>

<section class="section section-soft">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow" data-aos="fade-up"><?php esc_html_e( 'Find us on Facebook', 'v2jda' ); ?></span>
			<h2 data-aos="fade-up" data-delay="100"><?php esc_html_e( 'Stay updated with our latest news', 'v2jda' ); ?></h2>
		</div>

		<div style="text-align:center" data-aos="fade-up">
			<a href="<?php echo esc_url( $facebook_page ); ?>" target="_blank" rel="noopener" class="btn btn-ghost"><i class="fa-brands fa-facebook-f"></i> <?php esc_html_e( 'Visit our Facebook Page', 'v2jda' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer();
