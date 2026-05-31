<?php
/**
 * Search results template.
 *
 * @package V2JDA
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<h1 data-aos="fade-up"><?php printf( esc_html__( 'Search: %s', 'v2jda' ), '<span style="color:var(--brand)">' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
	</div>
</section>

<section class="section">
	<div class="container" style="max-width: 920px">
		<?php get_search_form(); ?>
		<?php if ( have_posts() ) : ?>
			<ul style="list-style:none; padding:0; margin:30px 0 0; display:grid; gap:20px;">
				<?php while ( have_posts() ) : the_post(); ?>
					<li class="project-card" style="padding:22px" data-aos="fade-up">
						<small style="color:var(--muted)"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?> &middot; <?php echo esc_html( get_the_date() ); ?></small>
						<h3 style="margin:6px 0"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
					</li>
				<?php endwhile; ?>
			</ul>
			<div style="text-align:center; margin-top:40px"><?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?></div>
		<?php else : ?>
			<p style="margin-top:24px; color: var(--muted); text-align:center">
				<?php esc_html_e( 'No results. Try a different keyword.', 'v2jda' ); ?>
			</p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
