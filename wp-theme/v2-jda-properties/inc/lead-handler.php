<?php
/**
 * Lead capture: AJAX endpoint that
 *   1. saves lead as a `lead` CPT entry,
 *   2. forwards to Google Sheets (Apps Script Web App), and
 *   3. emails site admin.
 *
 * @package V2JDA
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Register Lead CPT (admin-only, not public). */
function v2jda_register_lead_cpt() {
	register_post_type( 'lead', array(
		'labels' => array(
			'name'          => __( 'Leads', 'v2jda' ),
			'singular_name' => __( 'Lead', 'v2jda' ),
			'menu_name'     => __( 'Leads', 'v2jda' ),
		),
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_icon'           => 'dashicons-email-alt',
		'menu_position'       => 21,
		'capability_type'     => 'post',
		'supports'            => array( 'title', 'editor', 'custom-fields' ),
		'exclude_from_search' => true,
	) );
}
add_action( 'init', 'v2jda_register_lead_cpt' );

/* Show lead details column in admin list. */
function v2jda_lead_columns( $cols ) {
	$cols = array(
		'cb'        => $cols['cb'] ?? '',
		'title'     => __( 'Name', 'v2jda' ),
		'phone'     => __( 'Phone', 'v2jda' ),
		'email'     => __( 'Email', 'v2jda' ),
		'interest'  => __( 'Interest', 'v2jda' ),
		'source'    => __( 'Source', 'v2jda' ),
		'date'      => __( 'Submitted', 'v2jda' ),
	);
	return $cols;
}
add_filter( 'manage_lead_posts_columns', 'v2jda_lead_columns' );

function v2jda_lead_column_content( $col, $post_id ) {
	switch ( $col ) {
		case 'phone':    echo esc_html( get_post_meta( $post_id, 'phone', true ) ); break;
		case 'email':    echo esc_html( get_post_meta( $post_id, 'email', true ) ); break;
		case 'interest': echo esc_html( get_post_meta( $post_id, 'interest', true ) ); break;
		case 'source':   echo esc_html( get_post_meta( $post_id, 'source', true ) ); break;
	}
}
add_action( 'manage_lead_posts_custom_column', 'v2jda_lead_column_content', 10, 2 );

/* AJAX handlers (logged-in + logged-out). */
add_action( 'wp_ajax_v2jda_submit_lead',        'v2jda_handle_lead' );
add_action( 'wp_ajax_nopriv_v2jda_submit_lead', 'v2jda_handle_lead' );

function v2jda_handle_lead() {
	check_ajax_referer( 'v2jda_lead', 'nonce' );

	// Honeypot anti-spam: real users will leave this empty.
	if ( ! empty( $_POST['website'] ) ) {
		wp_send_json_success( array( 'message' => 'Thanks!' ) );
	}

	$name     = isset( $_POST['name'] )     ? sanitize_text_field( wp_unslash( $_POST['name'] ) )     : '';
	$phone    = isset( $_POST['phone'] )    ? sanitize_text_field( wp_unslash( $_POST['phone'] ) )    : '';
	$email    = isset( $_POST['email'] )    ? sanitize_email( wp_unslash( $_POST['email'] ) )         : '';
	$interest = isset( $_POST['interest'] ) ? sanitize_text_field( wp_unslash( $_POST['interest'] ) ) : '';
	$message  = isset( $_POST['message'] )  ? sanitize_textarea_field( wp_unslash( $_POST['message'] ) ) : '';
	$source   = isset( $_POST['source'] )   ? esc_url_raw( wp_unslash( $_POST['source'] ) )           : '';

	if ( ! $name || ! $phone ) {
		wp_send_json_error( array( 'message' => __( 'Please provide your name and phone number.', 'v2jda' ) ), 400 );
	}

	// 1. Save in WordPress.
	$post_id = wp_insert_post( array(
		'post_type'    => 'lead',
		'post_status'  => 'private',
		'post_title'   => $name . ' - ' . $phone,
		'post_content' => $message,
		'meta_input'   => array(
			'phone'    => $phone,
			'email'    => $email,
			'interest' => $interest,
			'source'   => $source,
			'ip'       => isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( $_SERVER['REMOTE_ADDR'] ) : '',
			'agent'    => isset( $_SERVER['HTTP_USER_AGENT'] ) ? sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ) : '',
		),
	) );

	// 2. Forward to Google Sheets (if configured).
	$sheets = v2jda_opt( 'sheets_url' );
	if ( $sheets ) {
		wp_remote_post( $sheets, array(
			'timeout'  => 8,
			'blocking' => false,
			'body'     => array(
				'name'         => $name,
				'phone'        => $phone,
				'email'        => $email,
				'interest'     => $interest,
				'message'      => $message,
				'source'       => $source,
				'submitted_at' => current_time( 'mysql' ),
			),
		) );
	}

	// 3. Email admin.
	$notify = v2jda_opt( 'lead_email', get_option( 'admin_email' ) );
	if ( $notify ) {
		$body  = "New lead from " . get_bloginfo( 'name' ) . "\n\n";
		$body .= "Name: $name\nPhone: $phone\nEmail: $email\nInterest: $interest\n\nMessage:\n$message\n\nSource: $source\n";
		wp_mail( $notify, '[V2 JDA] New Lead: ' . $name, $body );
	}

	wp_send_json_success( array(
		'message'   => __( 'Thank you! We have received your enquiry and will call you shortly.', 'v2jda' ),
		'post_id'   => $post_id,
	) );
}
