<?php
/**
 * Single project view.
 *
 * @package V2JDA
 */

get_header();

while ( have_posts() ) : the_post();
	$id      = get_the_ID();
	$status  = wp_get_post_terms( $id, 'project_status', array( 'fields' => 'names' ) );
	$status  = ! empty( $status ) ? $status[0] : '';
	$address = v2jda_project_meta( 'address' );
	$area    = v2jda_project_meta( 'area' );
	$price   = v2jda_project_meta( 'price' );
	$rera    = v2jda_project_meta( 'rera' );
	$map     = v2jda_project_meta( 'map' );
	$brochure = v2jda_project_meta( 'brochure' );

	$thumb = get_the_post_thumbnail_url( $id, 'v2jda-hero' );
	if ( ! $thumb ) {
		$thumb = 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=1920&q=80';
	}
?>

<section class="page-hero" style="background: linear-gradient(rgba(14,23,38,.78), rgba(14,23,38,.88)), url('<?php echo esc_url( $thumb ); ?>') center/cover no-repeat;">
	<div class="container">
		<?php if ( $status ) : ?>
			<span class="eyebrow" data-aos="fade-up" style="color:var(--brand)"><?php echo esc_html( $status ); ?></span>
		<?php endif; ?>
		<h1 data-aos="fade-up" data-delay="100"><?php the_title(); ?></h1>
		<p class="crumbs" data-aos="fade-up" data-delay="200">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'v2jda' ); ?></a> &nbsp;/&nbsp;
			<a href="<?php echo esc_url( home_url( '/projects/' ) ); ?>"><?php esc_html_e( 'Projects', 'v2jda' ); ?></a> &nbsp;/&nbsp;
			<?php the_title(); ?>
		</p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="contact-grid">
			<div data-aos="fade-right">
				<?php if ( has_post_thumbnail() ) : ?>
					<div style="border-radius: var(--radius); overflow: hidden; box-shadow: var(--shadow-md); margin-bottom: 24px">
						<?php the_post_thumbnail( 'v2jda-hero', array( 'style' => 'width:100%; height:auto; display:block' ) ); ?>
					</div>
				<?php endif; ?>

				<h2><?php esc_html_e( 'About this project', 'v2jda' ); ?></h2>
				<div style="margin-top:12px">
					<?php the_content(); ?>
				</div>

				<?php if ( $map ) : ?>
					<h3 style="margin-top:30px"><?php esc_html_e( 'Location', 'v2jda' ); ?></h3>
					<div style="margin-top:12px; border-radius: var(--radius); overflow: hidden">
						<iframe src="<?php echo esc_url( $map ); ?>" width="100%" height="380" style="border:0" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
				<?php endif; ?>
			</div>

			<aside data-aos="fade-left">
				<div class="form" style="position: sticky; top: 100px;">
					<h3 style="font-family:'Poppins'; font-size:1.1rem; margin-bottom: 18px"><?php esc_html_e( 'Project Details', 'v2jda' ); ?></h3>
					<ul style="list-style:none; padding:0; margin:0; display:grid; gap:10px;">
						<?php if ( $price ) : ?>
							<li><strong><?php esc_html_e( 'Price:', 'v2jda' ); ?></strong> <?php echo esc_html( $price ); ?></li>
						<?php endif; ?>
						<?php if ( $area ) : ?>
							<li><strong><?php esc_html_e( 'Plot Size:', 'v2jda' ); ?></strong> <?php echo esc_html( $area ); ?></li>
						<?php endif; ?>
						<?php if ( $address ) : ?>
							<li><strong><?php esc_html_e( 'Location:', 'v2jda' ); ?></strong> <?php echo esc_html( $address ); ?></li>
						<?php endif; ?>
						<?php if ( $rera ) : ?>
							<li><strong><?php esc_html_e( 'Approval:', 'v2jda' ); ?></strong> <?php echo esc_html( $rera ); ?></li>
						<?php endif; ?>
						<?php if ( $status ) : ?>
							<li><strong><?php esc_html_e( 'Status:', 'v2jda' ); ?></strong> <?php echo esc_html( $status ); ?></li>
						<?php endif; ?>
					</ul>

					<?php if ( $brochure ) : ?>
						<a href="<?php echo esc_url( $brochure ); ?>" target="_blank" rel="noopener" class="btn btn-ghost" style="margin-top:18px; width:100%">
							<i class="fa-solid fa-file-arrow-down"></i> <?php esc_html_e( 'Download Brochure', 'v2jda' ); ?>
						</a>
					<?php endif; ?>

					<hr style="border:0; border-top:1px solid var(--line); margin:22px 0">
					<h3 style="font-family:'Poppins'; font-size:1.05rem; margin-bottom:12px"><?php esc_html_e( 'Enquire about this project', 'v2jda' ); ?></h3>
					<?php v2jda_lead_form( array( 'interest' => 'Site Visit' ) ); ?>
				</div>
			</aside>
		</div>
	</div>
</section>

<section class="section section-soft">
	<div class="container">
		<div class="section-head">
			<h2 data-aos="fade-up"><?php esc_html_e( 'Other Projects', 'v2jda' ); ?></h2>
		</div>
		<div class="project-grid">
			<?php
			$related = new WP_Query( array(
				'post_type'      => 'project',
				'posts_per_page' => 3,
				'post__not_in'   => array( $id ),
				'orderby'        => 'rand',
			) );
			$i = 0;
			while ( $related->have_posts() ) {
				$related->the_post();
				v2jda_render_project_card( get_post(), $i * 100 );
				$i++;
			}
			wp_reset_postdata();
			?>
		</div>
	</div>
</section>

<?php endwhile; ?>

<?php get_footer();
