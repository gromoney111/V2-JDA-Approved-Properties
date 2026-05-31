<?php
/**
 * Home page template.
 *
 * @package V2JDA
 */

get_header();
?>

<!-- HERO -->
<section class="hero">
	<div class="hero-bg" aria-hidden="true" style="background-image: linear-gradient(rgba(14,23,38,.65), rgba(14,23,38,.85)), url('<?php echo esc_url( v2jda_opt( 'hero_image', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1920&q=80' ) ); ?>');"></div>
	<div class="hero-content">
		<span class="eyebrow" data-aos="fade-up"><?php echo esc_html( v2jda_opt( 'hero_eyebrow', 'JDA & RERA Approved · Jaipur' ) ); ?></span>
		<h1 data-aos="fade-up" data-delay="100"><?php echo esc_html( v2jda_opt( 'hero_title', 'Build Your Future on Approved Land' ) ); ?></h1>
		<p data-aos="fade-up" data-delay="200"><?php echo esc_html( v2jda_opt( 'hero_subtitle', 'Premium residential plots, villas and farm-house properties across Jaipur — verified, registered and ready for your dream home.' ) ); ?></p>
		<div class="hero-cta" data-aos="fade-up" data-delay="300">
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="btn btn-primary"><i class="fa-solid fa-building"></i> <?php esc_html_e( 'View Projects', 'v2jda' ); ?></a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-outline"><i class="fa-solid fa-headset"></i> <?php esc_html_e( 'Talk to an Expert', 'v2jda' ); ?></a>
		</div>
	</div>

	<div class="hero-stats">
		<div class="stat" data-aos="zoom-in"><strong data-count="500" data-suffix="+">0</strong><span><?php esc_html_e( 'Happy Customers', 'v2jda' ); ?></span></div>
		<div class="stat" data-aos="zoom-in" data-delay="100"><strong data-count="25" data-suffix="+">0</strong><span><?php esc_html_e( 'Projects Delivered', 'v2jda' ); ?></span></div>
		<div class="stat" data-aos="zoom-in" data-delay="200"><strong data-count="12" data-suffix="+">0</strong><span><?php esc_html_e( 'Years Experience', 'v2jda' ); ?></span></div>
		<div class="stat" data-aos="zoom-in" data-delay="300"><strong data-count="100" data-suffix="%">0</strong><span><?php esc_html_e( 'Approved Land', 'v2jda' ); ?></span></div>
	</div>

	<a href="#why-us" class="scroll-indicator" aria-label="Scroll down"><i class="fa-solid fa-chevron-down"></i></a>
</section>

<!-- WHY CHOOSE US -->
<section class="section" id="why-us">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow" data-aos="fade-up"><?php esc_html_e( 'Why Choose Us', 'v2jda' ); ?></span>
			<h2 data-aos="fade-up" data-delay="100"><?php esc_html_e( 'Trusted Real Estate Partner in Jaipur', 'v2jda' ); ?></h2>
			<p data-aos="fade-up" data-delay="200"><?php esc_html_e( 'We help you invest with confidence by offering only government-approved, dispute-free properties with complete documentation.', 'v2jda' ); ?></p>
		</div>

		<div class="usp-grid">
			<?php
			$usps = array(
				array( 'fa-solid fa-stamp',         'JDA & RERA Approved', 'Every plot is officially approved — clear title, regulated layout, peace of mind.' ),
				array( 'fa-solid fa-location-dot',  'Prime Locations',     'Hand-picked sites near Jaipur Ring Road, Ajmer Road, Sikar Road and Tonk Road.' ),
				array( 'fa-solid fa-handshake',     'Transparent Dealings','Clear pricing, registered agreements and end-to-end documentation support.' ),
				array( 'fa-solid fa-rotate',        'Easy Resale & ROI',   'Approved layouts appreciate faster — great for self-use or long-term investment.' ),
			);
			foreach ( $usps as $i => $u ) :
			?>
				<div class="usp-card" data-aos="fade-up" data-delay="<?php echo esc_attr( $i * 100 ); ?>">
					<div class="usp-icon"><i class="<?php echo esc_attr( $u[0] ); ?>"></i></div>
					<h3><?php echo esc_html( $u[1] ); ?></h3>
					<p><?php echo esc_html( $u[2] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- FEATURED PROJECTS -->
<section class="section section-soft">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow" data-aos="fade-up"><?php esc_html_e( 'Our Portfolio', 'v2jda' ); ?></span>
			<h2 data-aos="fade-up" data-delay="100"><?php esc_html_e( 'Featured Projects', 'v2jda' ); ?></h2>
			<p data-aos="fade-up" data-delay="200"><?php esc_html_e( 'Explore a selection of our ongoing and completed JDA-approved residential developments around Jaipur.', 'v2jda' ); ?></p>
		</div>

		<div class="project-grid">
			<?php
			$featured = new WP_Query( array(
				'post_type'      => 'project',
				'posts_per_page' => 3,
				'orderby'        => 'menu_order date',
				'order'          => 'DESC',
			) );

			if ( $featured->have_posts() ) {
				$i = 0;
				while ( $featured->have_posts() ) {
					$featured->the_post();
					v2jda_render_project_card( get_post(), $i * 100 );
					$i++;
				}
				wp_reset_postdata();
			} else {
				// Demo placeholders so the home page is not empty before content is added.
				$demos = array(
					array( 'title' => 'Greenfield Residency', 'status' => 'Ongoing',   'address' => 'Ajmer Road, Jaipur',  'area' => '100–300 Sq. Yd.', 'img' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=900&q=80' ),
					array( 'title' => 'Heritage Villas',      'status' => 'Completed', 'address' => 'Tonk Road, Jaipur',   'area' => '3 & 4 BHK Villas', 'img' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80' ),
					array( 'title' => 'Royal Enclave',        'status' => 'Upcoming',  'address' => 'Sikar Road, Jaipur',  'area' => '150–500 Sq. Yd.', 'img' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?auto=format&fit=crop&w=900&q=80' ),
				);
				foreach ( $demos as $i => $d ) :
					$cls = 'project-badge';
					if ( $d['status'] === 'Completed' ) { $cls .= ' completed'; }
					if ( $d['status'] === 'Upcoming' )  { $cls .= ' upcoming'; }
				?>
					<article class="project-card" data-aos="fade-up" data-delay="<?php echo esc_attr( $i * 100 ); ?>">
						<div class="project-thumb">
							<img src="<?php echo esc_url( $d['img'] ); ?>" alt="<?php echo esc_attr( $d['title'] ); ?>" loading="lazy" />
							<span class="<?php echo esc_attr( $cls ); ?>"><?php echo esc_html( $d['status'] ); ?></span>
						</div>
						<div class="project-body">
							<h3><?php echo esc_html( $d['title'] ); ?></h3>
							<p><?php esc_html_e( 'Planned township with wide internal roads, parks and modern amenities.', 'v2jda' ); ?></p>
							<div class="project-meta">
								<span><i class="fa-solid fa-location-dot"></i> <?php echo esc_html( $d['address'] ); ?></span>
								<span><i class="fa-solid fa-ruler-combined"></i> <?php echo esc_html( $d['area'] ); ?></span>
							</div>
						</div>
					</article>
				<?php endforeach;
			}
			?>
		</div>

		<div style="text-align:center; margin-top:40px" data-aos="fade-up">
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>" class="btn btn-ghost"><?php esc_html_e( 'View All Projects', 'v2jda' ); ?> <i class="fa-solid fa-arrow-right"></i></a>
		</div>
	</div>
</section>

<!-- ABOUT TEASER -->
<section class="section">
	<div class="container">
		<div class="about-grid">
			<div class="about-img-wrap" data-aos="fade-right">
				<img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=900&q=80" alt="<?php esc_attr_e( 'V2 JDA Approved Properties team', 'v2jda' ); ?>" />
			</div>
			<div class="about-text" data-aos="fade-left">
				<span class="eyebrow"><?php esc_html_e( 'About V2 JDA Approved Properties', 'v2jda' ); ?></span>
				<h2><?php esc_html_e( 'Helping Jaipur Build Dream Homes', 'v2jda' ); ?></h2>
				<p><?php esc_html_e( 'V2 JDA Approved Properties is a Jaipur-based real estate firm specialising in JDA & RERA approved residential plots, villas and farm-house land. In association with the Shyamashish Group, we curate properties that combine prime locations, clean paperwork and long-term value.', 'v2jda' ); ?></p>
				<ul>
					<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'Hand-picked, government-approved layouts', 'v2jda' ); ?></li>
					<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'End-to-end legal & registry support', 'v2jda' ); ?></li>
					<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( 'Personalised site visits and consultations', 'v2jda' ); ?></li>
					<li><i class="fa-solid fa-circle-check"></i> <?php esc_html_e( '500+ satisfied customers across Jaipur', 'v2jda' ); ?></li>
				</ul>
				<div style="margin-top:24px">
					<a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" class="btn btn-ghost"><?php esc_html_e( 'Read More', 'v2jda' ); ?> <i class="fa-solid fa-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- TESTIMONIALS -->
<section class="section section-soft">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow" data-aos="fade-up"><?php esc_html_e( 'Client Reviews', 'v2jda' ); ?></span>
			<h2 data-aos="fade-up" data-delay="100"><?php esc_html_e( 'What Our Customers Say', 'v2jda' ); ?></h2>
		</div>
		<div class="testimonial-grid">
			<?php
			$reviews = array(
				array( 'RS', 'Rohit Sharma',   'Plot Buyer, Ajmer Road',  'The team guided me through every step of buying my first plot near Ajmer Road. Documentation was completely transparent and registry was smooth.' ),
				array( 'PA', 'Priya Agarwal',  'Investor, Tonk Road',     'I bought a farm-house plot through V2 JDA Approved Properties. The site visit was well organised and pricing was honest. Highly recommend.' ),
				array( 'MK', 'Mahesh Kumawat', 'Villa Owner, Sikar Road', 'Vishal ji personally helped us pick the right villa within our budget. Three years on, the appreciation has been excellent.' ),
			);
			foreach ( $reviews as $i => $r ) : ?>
				<div class="testimonial" data-aos="fade-up" data-delay="<?php echo esc_attr( $i * 100 ); ?>">
					<div class="t-rating">
						<?php for ( $s = 0; $s < 5; $s++ ) echo '<i class="fa-solid fa-star"></i>'; ?>
					</div>
					<p><?php echo esc_html( $r[3] ); ?></p>
					<div class="t-author">
						<div class="avatar"><?php echo esc_html( $r[0] ); ?></div>
						<div><strong><?php echo esc_html( $r[1] ); ?></strong><small><?php echo esc_html( $r[2] ); ?></small></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- CTA BAND -->
<section class="cta-band">
	<div class="container">
		<h2 data-aos="fade-up"><?php esc_html_e( 'Ready to Find Your Perfect Plot?', 'v2jda' ); ?></h2>
		<p data-aos="fade-up" data-delay="100"><?php esc_html_e( 'Schedule a free site visit with our property expert today.', 'v2jda' ); ?></p>
		<div data-aos="fade-up" data-delay="200">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary"><i class="fa-solid fa-calendar-check"></i> <?php esc_html_e( 'Book a Site Visit', 'v2jda' ); ?></a>
			<a href="tel:+<?php echo esc_attr( preg_replace( '/\D/', '', v2jda_opt( 'phone_e164', '917597961878' ) ) ); ?>" class="btn btn-outline" style="margin-left:10px"><i class="fa-solid fa-phone"></i> <?php echo esc_html( v2jda_opt( 'phone', '+91 75979 61878' ) ); ?></a>
		</div>
	</div>
</section>

<?php get_footer();
