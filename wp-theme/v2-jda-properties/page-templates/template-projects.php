<?php
/**
 * Template Name: V2 JDA - Projects
 *
 * @package V2JDA
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<h1 data-aos="fade-up"><?php esc_html_e( 'Our Projects', 'v2jda' ); ?></h1>
		<p class="crumbs" data-aos="fade-up" data-delay="100"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'v2jda' ); ?></a> &nbsp;/&nbsp; <?php esc_html_e( 'Projects', 'v2jda' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow" data-aos="fade-up"><?php esc_html_e( 'Our Portfolio', 'v2jda' ); ?></span>
			<h2 data-aos="fade-up" data-delay="100"><?php esc_html_e( 'JDA & RERA Approved Developments', 'v2jda' ); ?></h2>
			<p data-aos="fade-up" data-delay="200"><?php esc_html_e( 'Filter by status to view ongoing, completed or upcoming projects.', 'v2jda' ); ?></p>
		</div>

		<div class="tabs" data-aos="fade-up">
			<button class="tab active" data-filter="all"><?php esc_html_e( 'All', 'v2jda' ); ?></button>
			<button class="tab" data-filter="ongoing"><?php esc_html_e( 'Ongoing', 'v2jda' ); ?></button>
			<button class="tab" data-filter="completed"><?php esc_html_e( 'Completed', 'v2jda' ); ?></button>
			<button class="tab" data-filter="upcoming"><?php esc_html_e( 'Upcoming', 'v2jda' ); ?></button>
		</div>

		<div class="project-grid">
			<?php
			$q = new WP_Query( array(
				'post_type'      => 'project',
				'posts_per_page' => 24,
			) );
			if ( $q->have_posts() ) {
				$i = 0;
				while ( $q->have_posts() ) {
					$q->the_post();
					v2jda_render_project_card( get_post(), ( $i % 3 ) * 100 );
					$i++;
				}
				wp_reset_postdata();
			} else {
				// Placeholder content if no projects yet.
				$demos = array(
					array( 'title' => 'Greenfield Residency',   'status' => 'Ongoing',   'cat' => 'ongoing',   'address' => 'Ajmer Road, Jaipur',   'area' => '100–300 Sq. Yd.', 'img' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=900&q=80' ),
					array( 'title' => 'Heritage Villas',        'status' => 'Completed', 'cat' => 'completed', 'address' => 'Tonk Road, Jaipur',    'area' => '3 & 4 BHK Villas', 'img' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80' ),
					array( 'title' => 'Royal Enclave',          'status' => 'Upcoming',  'cat' => 'upcoming',  'address' => 'Sikar Road, Jaipur',   'area' => '150–500 Sq. Yd.', 'img' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?auto=format&fit=crop&w=900&q=80' ),
					array( 'title' => 'Sunrise Greens',         'status' => 'Ongoing',   'cat' => 'ongoing',   'address' => 'Ring Road, Jaipur',    'area' => '120–250 Sq. Yd.', 'img' => 'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=900&q=80' ),
					array( 'title' => 'Aravali Heights',        'status' => 'Completed', 'cat' => 'completed', 'address' => 'Kalwar Road, Jaipur',  'area' => '200–400 Sq. Yd.', 'img' => 'https://images.unsplash.com/photo-1572120360610-d971b9d7767c?auto=format&fit=crop&w=900&q=80' ),
					array( 'title' => 'Pink City Plots',        'status' => 'Upcoming',  'cat' => 'upcoming',  'address' => 'Agra Road, Jaipur',    'area' => '90–250 Sq. Yd.',  'img' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=900&q=80' ),
				);
				foreach ( $demos as $i => $d ) :
					$cls = 'project-badge';
					if ( $d['cat'] === 'completed' ) { $cls .= ' completed'; }
					if ( $d['cat'] === 'upcoming' )  { $cls .= ' upcoming'; }
				?>
					<article class="project-card" data-aos="fade-up" data-delay="<?php echo esc_attr( ( $i % 3 ) * 100 ); ?>" data-category="<?php echo esc_attr( $d['cat'] ); ?>">
						<div class="project-thumb">
							<img src="<?php echo esc_url( $d['img'] ); ?>" alt="<?php echo esc_attr( $d['title'] ); ?>" loading="lazy" />
							<span class="<?php echo esc_attr( $cls ); ?>"><?php echo esc_html( $d['status'] ); ?></span>
						</div>
						<div class="project-body">
							<h3><?php echo esc_html( $d['title'] ); ?></h3>
							<p><?php esc_html_e( 'JDA approved layout with internal roads, parks and modern amenities.', 'v2jda' ); ?></p>
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
	</div>
</section>

<section class="cta-band">
	<div class="container">
		<h2 data-aos="fade-up"><?php esc_html_e( 'Looking for a specific location or budget?', 'v2jda' ); ?></h2>
		<p data-aos="fade-up" data-delay="100"><?php esc_html_e( 'Tell us your requirement and we will share matching options within 24 hours.', 'v2jda' ); ?></p>
		<div data-aos="fade-up" data-delay="200">
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> <?php esc_html_e( 'Send Requirement', 'v2jda' ); ?></a>
		</div>
	</div>
</section>

<?php get_footer();
