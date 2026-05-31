<?php
/**
 * Lightweight SEO helpers (meta description, Open Graph, JSON-LD).
 * If the user installs Yoast / Rank Math, those plugins take precedence
 * via their own filters.
 *
 * @package V2JDA
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function v2jda_meta_description() {
	if ( defined( 'WPSEO_VERSION' ) || defined( 'RANK_MATH_VERSION' ) ) { return; }

	$desc = '';
	if ( is_front_page() ) {
		$desc = get_bloginfo( 'description' );
		if ( ! $desc ) {
			$desc = 'V2 JDA Approved Properties offers JDA & RERA approved residential plots, villas and farm-house land in Jaipur. Trusted property dealer with 500+ happy customers.';
		}
	} elseif ( is_singular() ) {
		$desc = wp_strip_all_tags( get_the_excerpt() );
		if ( ! $desc ) { $desc = wp_trim_words( wp_strip_all_tags( get_the_content() ), 30 ); }
	} elseif ( is_archive() ) {
		$desc = wp_strip_all_tags( get_the_archive_description() );
	}
	if ( $desc ) {
		printf( '<meta name="description" content="%s" />' . "\n", esc_attr( wp_html_excerpt( $desc, 160, '' ) ) );
	}

	// Default keywords (you can refine per page later).
	$keywords = 'JDA approved plots Jaipur, RERA approved properties Jaipur, residential plots Jaipur, farm house land Jaipur, V2 JDA Approved Properties, real estate Jaipur, plots near Jaipur, property dealer Jaipur';
	printf( '<meta name="keywords" content="%s" />' . "\n", esc_attr( $keywords ) );

	// Open Graph
	$og_title = wp_get_document_title();
	$og_image = '';
	if ( is_singular() && has_post_thumbnail() ) {
		$og_image = get_the_post_thumbnail_url( null, 'v2jda-hero' );
	}
	if ( ! $og_image ) {
		$og_image = v2jda_opt( 'hero_image', 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1200&q=80' );
	}

	echo '<meta property="og:type" content="' . ( is_singular() ? 'article' : 'website' ) . '" />' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $og_title ) . '" />' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $desc ) . '" />' . "\n";
	echo '<meta property="og:url" content="' . esc_url( is_singular() ? get_permalink() : home_url( $_SERVER['REQUEST_URI'] ?? '/' ) ) . '" />' . "\n";
	echo '<meta property="og:image" content="' . esc_url( $og_image ) . '" />' . "\n";
	echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
}
add_action( 'wp_head', 'v2jda_meta_description', 1 );

/**
 * Site-wide JSON-LD: RealEstateAgent.
 */
function v2jda_jsonld_business() {
	if ( ! is_front_page() ) { return; }

	$socials = array_filter( array(
		v2jda_opt( 'social_facebook' ),
		v2jda_opt( 'social_youtube' ),
		v2jda_opt( 'social_instagram' ),
	) );

	$data = array(
		'@context'    => 'https://schema.org',
		'@type'       => 'RealEstateAgent',
		'name'        => get_bloginfo( 'name' ),
		'description' => get_bloginfo( 'description' ),
		'url'         => home_url( '/' ),
		'telephone'   => v2jda_opt( 'phone', '+91 75979 61878' ),
		'email'       => v2jda_opt( 'email', 'vishalkhandelwal267@gmail.com' ),
		'areaServed'  => 'Jaipur, Rajasthan, India',
		'address'     => array(
			'@type'           => 'PostalAddress',
			'addressLocality' => 'Jaipur',
			'addressRegion'   => 'Rajasthan',
			'addressCountry'  => 'IN',
		),
		'sameAs'      => array_values( $socials ),
	);

	echo '<script type="application/ld+json">' . wp_json_encode( $data, JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}
add_action( 'wp_head', 'v2jda_jsonld_business' );
