<?php
/**
 * Template Name: V2 JDA - About
 *
 * @package V2JDA
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<h1 data-aos="fade-up"><?php the_title(); ?></h1>
		<p class="crumbs" data-aos="fade-up" data-delay="100"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'v2jda' ); ?></a> &nbsp;/&nbsp; <?php the_title(); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="about-grid">
			<div class="about-img-wrap" data-aos="fade-right">
				<img src="https://images.unsplash.com/photo-1551836022-deb4988cc6c0?auto=format&fit=crop&w=900&q=80" alt="<?php esc_attr_e( 'About V2 JDA Approved Properties', 'v2jda' ); ?>" />
			</div>
			<div class="about-text" data-aos="fade-left">
				<span class="eyebrow"><?php esc_html_e( 'Who We Are', 'v2jda' ); ?></span>
				<h2><?php esc_html_e( 'Honest Advice, Approved Properties', 'v2jda' ); ?></h2>

				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php if ( get_the_content() ) : the_content(); else : ?>
						<p><?php esc_html_e( 'V2 JDA Approved Properties is a Jaipur-based real estate firm with over a decade of experience in residential land, plotted developments and villa projects. Working in association with the Shyamashish Group, we focus exclusively on JDA and RERA approved properties so that our customers can buy with complete confidence.', 'v2jda' ); ?></p>
						<p><?php esc_html_e( 'Our mission is simple: connect Jaipur families and investors with land that is genuinely approved, fairly priced, and located in growth corridors. We handle everything from site visits and price negotiation to registry, mutation and possession.', 'v2jda' ); ?></p>
					<?php endif; ?>
				<?php endwhile; endif; ?>

				<ul>
					<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'Decade of local market experience', 'v2jda' ); ?></li>
					<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'Only JDA & RERA approved inventory', 'v2jda' ); ?></li>
					<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'In-house legal & documentation team', 'v2jda' ); ?></li>
					<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'Post-sale support & resale assistance', 'v2jda' ); ?></li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="section section-soft">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow" data-aos="fade-up"><?php esc_html_e( 'Our Values', 'v2jda' ); ?></span>
			<h2 data-aos="fade-up" data-delay="100"><?php esc_html_e( 'What Drives Us', 'v2jda' ); ?></h2>
		</div>
		<div class="usp-grid">
			<?php
			$values = array(
				array( 'fa-solid fa-shield-halved', 'Trust',           'Every property is independently verified before we list it.' ),
				array( 'fa-solid fa-eye',           'Transparency',    'No hidden charges, no fine print — just clear, written terms.' ),
				array( 'fa-solid fa-people-group',  'Customer First',  'Your goal — investment or end-use — drives our recommendation.' ),
				array( 'fa-solid fa-chart-line',    'Long-Term Value', 'We focus on locations and layouts that appreciate well over time.' ),
			);
			foreach ( $values as $i => $v ) : ?>
				<div class="usp-card" data-aos="fade-up" data-delay="<?php echo esc_attr( $i * 100 ); ?>">
					<div class="usp-icon"><i class="<?php echo esc_attr( $v[0] ); ?>"></i></div>
					<h3><?php echo esc_html( $v[1] ); ?></h3>
					<p><?php echo esc_html( $v[2] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<section class="cta-band">
	<div class="container">
		<h2 data-aos="fade-up"><?php esc_html_e( 'Want to know more about our journey?', 'v2jda' ); ?></h2>
		<p data-aos="fade-up" data-delay="100"><?php esc_html_e( 'Speak directly with our founder, Vishal Khandelwal.', 'v2jda' ); ?></p>
		<div data-aos="fade-up" data-delay="200">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary"><i class="fa-solid fa-comments"></i> <?php esc_html_e( 'Contact Us', 'v2jda' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer();
