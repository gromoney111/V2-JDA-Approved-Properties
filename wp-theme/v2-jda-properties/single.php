<?php
/**
 * Single post template (default).
 *
 * @package V2JDA
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<h1 data-aos="fade-up"><?php the_title(); ?></h1>
		<p class="crumbs" data-aos="fade-up" data-delay="100"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'v2jda' ); ?></a> &nbsp;/&nbsp; <?php esc_html_e( 'Blog', 'v2jda' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container" style="max-width: 820px">
		<?php while ( have_posts() ) : the_post(); ?>
			<article class="entry" data-aos="fade-up">
				<p style="color:var(--muted); font-size:.9rem">
					<?php echo esc_html( get_the_date() ); ?> &middot; <?php the_author(); ?>
				</p>
				<?php if ( has_post_thumbnail() ) : ?>
					<div style="border-radius: var(--radius); overflow: hidden; margin: 18px 0 24px">
						<?php the_post_thumbnail( 'v2jda-hero', array( 'style' => 'width:100%; height:auto; display:block' ) ); ?>
					</div>
				<?php endif; ?>
				<div class="entry-content"><?php the_content(); ?></div>
				<?php wp_link_pages(); ?>
			</article>
			<?php if ( comments_open() || get_comments_number() ) comments_template(); ?>
		<?php endwhile; ?>
	</div>
</section>

<?php get_footer();
