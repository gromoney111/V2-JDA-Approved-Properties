<?php
/**
 * Template Name: V2 JDA - Gallery
 *
 * @package V2JDA
 */

get_header();
?>

<section class="page-hero">
	<div class="container">
		<h1 data-aos="fade-up"><?php esc_html_e( 'Project Gallery', 'v2jda' ); ?></h1>
		<p class="crumbs" data-aos="fade-up" data-delay="100"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'v2jda' ); ?></a> &nbsp;/&nbsp; <?php esc_html_e( 'Gallery', 'v2jda' ); ?></p>
	</div>
</section>

<section class="section">
	<div class="container">
		<div class="section-head">
			<span class="eyebrow" data-aos="fade-up"><?php esc_html_e( 'On The Ground', 'v2jda' ); ?></span>
			<h2 data-aos="fade-up" data-delay="100"><?php esc_html_e( 'Photos from our projects', 'v2jda' ); ?></h2>
			<p data-aos="fade-up" data-delay="200"><?php esc_html_e( 'Click any image to view it in full size.', 'v2jda' ); ?></p>
		</div>

		<div class="gallery-grid" data-aos="fade-up">
			<?php
			// Pull featured images from the Project CPT first.
			$gallery = new WP_Query( array(
				'post_type'      => 'project',
				'posts_per_page' => 12,
				'meta_query'     => array(
					array( 'key' => '_thumbnail_id', 'compare' => 'EXISTS' ),
				),
			) );

			if ( $gallery->have_posts() ) {
				$i = 0;
				while ( $gallery->have_posts() ) {
					$gallery->the_post();
					$cls = 'gallery-item';
					if ( $i === 0 ) $cls .= ' wide';
					if ( $i === 3 ) $cls .= ' tall';
					?>
					<div class="<?php echo esc_attr( $cls ); ?>">
						<?php the_post_thumbnail( 'v2jda-card', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
					</div>
					<?php
					$i++;
				}
				wp_reset_postdata();
			} else {
				$photos = array(
					'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1568605114967-8130f3a36994?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1572120360610-d971b9d7767c?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1570129477492-45c003edd2be?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1505691938895-1758d7feb511?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1494526585095-c41746248156?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1518780664697-55e3ad937233?auto=format&fit=crop&w=900&q=80',
					'https://images.unsplash.com/photo-1523217582562-09d0def993a6?auto=format&fit=crop&w=900&q=80',
				);
				foreach ( $photos as $i => $src ) :
					$cls = 'gallery-item';
					if ( $i === 0 ) $cls .= ' wide';
					if ( $i === 3 ) $cls .= ' tall';
				?>
					<div class="<?php echo esc_attr( $cls ); ?>">
						<img src="<?php echo esc_url( $src ); ?>" alt="<?php printf( esc_attr__( 'V2 JDA project photo %d', 'v2jda' ), $i + 1 ); ?>" loading="lazy" />
					</div>
				<?php endforeach;
			}
			?>
		</div>

		<p style="text-align:center; margin-top:30px; color:var(--muted)">
			<?php esc_html_e( 'Once you upload featured images to your Projects in WordPress, they will automatically appear here.', 'v2jda' ); ?>
		</p>
	</div>
</section>

<?php get_footer();
