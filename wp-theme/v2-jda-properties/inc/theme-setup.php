<?php
/**
 * Theme setup: supports, menus, image sizes.
 *
 * @package V2JDA
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function v2jda_theme_setup() {
	load_theme_textdomain( 'v2jda', V2JDA_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 60,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list',
		'gallery', 'caption', 'style', 'script', 'navigation-widgets'
	) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	// Custom image sizes for project cards & gallery.
	add_image_size( 'v2jda-card', 800, 600, true );
	add_image_size( 'v2jda-hero', 1920, 1080, true );
	add_image_size( 'v2jda-gallery', 600, 600, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'v2jda' ),
		'footer'  => __( 'Footer Menu', 'v2jda' ),
	) );
}
add_action( 'after_setup_theme', 'v2jda_theme_setup' );

/**
 * Auto-create the core pages on theme activation so the site is usable
 * immediately after installation.
 */
function v2jda_create_default_pages() {
	$pages = array(
		array( 'title' => 'Home',     'template' => '' ),
		array( 'title' => 'About',    'template' => 'page-templates/template-about.php' ),
		array( 'title' => 'Projects', 'template' => 'page-templates/template-projects.php' ),
		array( 'title' => 'Gallery',  'template' => 'page-templates/template-gallery.php' ),
		array( 'title' => 'Media',    'template' => 'page-templates/template-media.php' ),
		array( 'title' => 'Contact',  'template' => 'page-templates/template-contact.php' ),
	);

	$home_id = 0;

	foreach ( $pages as $p ) {
		$existing = get_page_by_path( sanitize_title( $p['title'] ) );
		if ( $existing ) {
			if ( $p['title'] === 'Home' ) { $home_id = $existing->ID; }
			continue;
		}
		$id = wp_insert_post( array(
			'post_title'   => $p['title'],
			'post_status'  => 'publish',
			'post_type'    => 'page',
			'post_content' => '',
		) );
		if ( $id && $p['template'] ) {
			update_post_meta( $id, '_wp_page_template', $p['template'] );
		}
		if ( $id && $p['title'] === 'Home' ) { $home_id = $id; }
	}

	if ( $home_id ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
	}
}
add_action( 'after_switch_theme', 'v2jda_create_default_pages' );

/**
 * Filter body classes for nicer styling hooks.
 */
function v2jda_body_class( $classes ) {
	if ( is_front_page() ) { $classes[] = 'is-home'; }
	if ( is_singular( 'project' ) || is_post_type_archive( 'project' ) ) { $classes[] = 'is-project'; }
	return $classes;
}
add_filter( 'body_class', 'v2jda_body_class' );
