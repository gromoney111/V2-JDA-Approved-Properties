<?php
/**
 * Project custom post type + Project Status taxonomy + meta box.
 *
 * @package V2JDA
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function v2jda_register_project_cpt() {
	$labels = array(
		'name'               => __( 'Projects', 'v2jda' ),
		'singular_name'      => __( 'Project', 'v2jda' ),
		'add_new_item'       => __( 'Add New Project', 'v2jda' ),
		'edit_item'          => __( 'Edit Project', 'v2jda' ),
		'new_item'           => __( 'New Project', 'v2jda' ),
		'view_item'          => __( 'View Project', 'v2jda' ),
		'search_items'       => __( 'Search Projects', 'v2jda' ),
		'not_found'          => __( 'No projects found', 'v2jda' ),
		'not_found_in_trash' => __( 'No projects found in trash', 'v2jda' ),
		'menu_name'          => __( 'Projects', 'v2jda' ),
	);

	register_post_type( 'project', array(
		'labels'        => $labels,
		'public'        => true,
		'has_archive'   => true,
		'menu_icon'     => 'dashicons-building',
		'menu_position' => 20,
		'rewrite'       => array( 'slug' => 'projects' ),
		'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'  => true,
	) );
}
add_action( 'init', 'v2jda_register_project_cpt' );

function v2jda_register_project_status_tax() {
	register_taxonomy( 'project_status', 'project', array(
		'labels'            => array(
			'name'          => __( 'Project Status', 'v2jda' ),
			'singular_name' => __( 'Project Status', 'v2jda' ),
		),
		'hierarchical'      => true,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'project-status' ),
	) );

	register_taxonomy( 'project_location', 'project', array(
		'labels'            => array(
			'name'          => __( 'Locations', 'v2jda' ),
			'singular_name' => __( 'Location', 'v2jda' ),
		),
		'hierarchical'      => false,
		'show_admin_column' => true,
		'show_in_rest'      => true,
		'rewrite'           => array( 'slug' => 'project-location' ),
	) );
}
add_action( 'init', 'v2jda_register_project_status_tax' );

/**
 * Seed default Project Status terms when the theme is activated.
 */
function v2jda_seed_project_terms() {
	foreach ( array( 'Ongoing', 'Completed', 'Upcoming' ) as $term ) {
		if ( ! term_exists( $term, 'project_status' ) ) {
			wp_insert_term( $term, 'project_status' );
		}
	}
}
add_action( 'after_switch_theme', 'v2jda_seed_project_terms' );

/* ----------------------------------------------------------------
 * Simple custom meta box for project facts (no ACF dependency).
 * ---------------------------------------------------------------- */

function v2jda_project_meta_box() {
	add_meta_box(
		'v2jda_project_meta',
		__( 'Project Details', 'v2jda' ),
		'v2jda_project_meta_box_render',
		'project',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'v2jda_project_meta_box' );

function v2jda_project_meta_box_render( $post ) {
	wp_nonce_field( 'v2jda_save_project_meta', 'v2jda_project_meta_nonce' );

	$fields = array(
		'price'    => array( 'label' => 'Starting Price (e.g. ₹25 Lakh onwards)', 'type' => 'text' ),
		'area'    => array( 'label' => 'Plot Area / Size (e.g. 100–300 Sq. Yd.)', 'type' => 'text' ),
		'address' => array( 'label' => 'Address / Location',                       'type' => 'text' ),
		'rera'    => array( 'label' => 'RERA / JDA Approval Number',               'type' => 'text' ),
		'map'     => array( 'label' => 'Google Maps Embed URL (optional)',         'type' => 'url'  ),
		'brochure'=> array( 'label' => 'Brochure URL (optional)',                  'type' => 'url'  ),
	);

	echo '<table class="form-table">';
	foreach ( $fields as $key => $f ) {
		$value = get_post_meta( $post->ID, '_v2jda_' . $key, true );
		printf(
			'<tr><th scope="row"><label for="v2jda_%1$s">%2$s</label></th><td><input type="%3$s" id="v2jda_%1$s" name="v2jda_%1$s" value="%4$s" class="large-text" /></td></tr>',
			esc_attr( $key ),
			esc_html( $f['label'] ),
			esc_attr( $f['type'] ),
			esc_attr( $value )
		);
	}
	echo '</table>';
}

function v2jda_save_project_meta( $post_id ) {
	if ( ! isset( $_POST['v2jda_project_meta_nonce'] ) ) { return; }
	if ( ! wp_verify_nonce( $_POST['v2jda_project_meta_nonce'], 'v2jda_save_project_meta' ) ) { return; }
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return; }
	if ( ! current_user_can( 'edit_post', $post_id ) ) { return; }

	$keys = array( 'price', 'area', 'address', 'rera', 'map', 'brochure' );
	foreach ( $keys as $key ) {
		if ( isset( $_POST[ 'v2jda_' . $key ] ) ) {
			$val = wp_unslash( $_POST[ 'v2jda_' . $key ] );
			$val = in_array( $key, array( 'map', 'brochure' ), true ) ? esc_url_raw( $val ) : sanitize_text_field( $val );
			update_post_meta( $post_id, '_v2jda_' . $key, $val );
		}
	}
}
add_action( 'save_post_project', 'v2jda_save_project_meta' );

/**
 * Helper to read project meta from templates.
 */
function v2jda_project_meta( $key, $post_id = null ) {
	$post_id = $post_id ?: get_the_ID();
	return get_post_meta( $post_id, '_v2jda_' . $key, true );
}
