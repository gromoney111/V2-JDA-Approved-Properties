<?php
/**
 * Enqueue scripts and styles.
 *
 * @package V2JDA
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function v2jda_enqueue_assets() {
	// Google Fonts.
	wp_enqueue_style(
		'v2jda-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap',
		array(), null
	);

	// Font Awesome (CDN).
	wp_enqueue_style(
		'v2jda-fontawesome',
		'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
		array(), '6.5.2'
	);

	// Theme styles. Note: WordPress requires style.css for metadata, but our
	// real styles live in assets/css/main.css.
	wp_enqueue_style(
		'v2jda-main',
		V2JDA_URI . '/assets/css/main.css',
		array( 'v2jda-fonts', 'v2jda-fontawesome' ),
		V2JDA_VERSION
	);

	// Theme script.
	wp_enqueue_script(
		'v2jda-main',
		V2JDA_URI . '/assets/js/main.js',
		array(),
		V2JDA_VERSION,
		true
	);

	wp_localize_script( 'v2jda-main', 'V2JDA', array(
		'ajaxUrl'   => admin_url( 'admin-ajax.php' ),
		'nonce'     => wp_create_nonce( 'v2jda_lead' ),
		'thanksUrl' => esc_url( home_url( '/thank-you/' ) ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'v2jda_enqueue_assets' );
