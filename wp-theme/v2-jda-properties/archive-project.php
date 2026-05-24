<?php
/**
 * Project archive (when accessed via /projects/ if no Page exists).
 *
 * @package V2JDA
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<h1 data-aos="fade-up"><?php post_type_archive_title(); ?></h1>
		<p class="crumbs" data-aos="fade-up" data-delay="100"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'v2jda' ); ?></a> &nbsp;/&nbsp; <?php esc_html_e( 'Projects', 'v2jda' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="tabs" data-aos="fade-up">
			<button class="tab active" data-filter="all"><?php esc_html_e( 'All', 'v2jda' ); ?></button>
			<button class="tab" data-filter="ongoing"><?php esc_html_e( 'Ongoing', 'v2jda' ); ?></button>
			<button class="tab" data-filter="completed"><?php esc_html_e( 'Completed', 'v2jda' ); ?></button>
			<button class="tab" data-filter="upcoming"><?php esc_html_e( 'Upcoming', 'v2jda' ); ?></button>
		</div>

		<div class="project-grid">
			<?php
			if ( have_posts() ) :
				$i = 0;
				while ( have_posts() ) :
					the_post();
					v2jda_render_project_card( get_post(), ( $i % 3 ) * 100 );
					$i++;
				endwhile;
			else : ?>
				<p style="text-align:center; grid-column: 1 / -1; color: var(--muted)">
					<?php esc_html_e( 'No projects yet. Add some from the WordPress admin (Projects → Add New).', 'v2jda' ); ?>
				</p>
			<?php endif; ?>
		</div>

		<div style="text-align:center; margin-top:40px">
			<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
		</div>
	</div>
</section>

<?php get_footer();
