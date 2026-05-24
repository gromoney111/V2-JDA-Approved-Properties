<?php
/**
 * Fallback / blog index template.
 *
 * @package V2JDA
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<h1 data-aos="fade-up">
			<?php
			if ( is_home() ) {
				echo esc_html( get_bloginfo( 'name' ) );
			} else {
				the_archive_title();
			}
			?>
		</h1>
	</div>
</section>

<section class="section">
	<div class="container" style="max-width: 920px">
		<?php if ( have_posts() ) : ?>
			<div class="project-grid">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="project-card" data-aos="fade-up">
						<a href="<?php the_permalink(); ?>" class="project-thumb">
							<?php
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'v2jda-card' );
							} else {
								echo '<img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&w=900&q=80" alt="" loading="lazy" />';
							}
							?>
						</a>
						<div class="project-body">
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
							<div class="project-meta">
								<span><i class="fa-solid fa-calendar"></i> <?php echo esc_html( get_the_date() ); ?></span>
							</div>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
			<div style="text-align:center; margin-top:40px">
				<?php the_posts_pagination( array( 'mid_size' => 1 ) ); ?>
			</div>
		<?php else : ?>
			<p style="text-align:center; color: var(--muted)">
				<?php esc_html_e( 'No content yet.', 'v2jda' ); ?>
			</p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
