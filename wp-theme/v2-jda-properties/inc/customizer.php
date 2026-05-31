<?php
/**
 * Customizer settings: contact details, social links, hero copy, lead webhook.
 *
 * @package V2JDA
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

function v2jda_customize_register( $wp_customize ) {

	/* ---- Contact ---- */
	$wp_customize->add_section( 'v2jda_contact', array(
		'title'    => __( 'V2 JDA - Contact', 'v2jda' ),
		'priority' => 30,
	) );

	$contact = array(
		'phone'    => array( 'label' => 'Phone Number',  'default' => '+91 75979 61878' ),
		'phone_e164' => array( 'label' => 'Phone (digits only, e.g. 917597961878 - used for WhatsApp & tel: links)', 'default' => '917597961878' ),
		'email'    => array( 'label' => 'Email',         'default' => 'vishalkhandelwal267@gmail.com' ),
		'address'  => array( 'label' => 'Address',       'default' => 'Jaipur, Rajasthan, India' ),
	);
	foreach ( $contact as $k => $cfg ) {
		$wp_customize->add_setting( "v2jda_$k", array(
			'default'           => $cfg['default'],
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( "v2jda_$k", array(
			'label'   => $cfg['label'],
			'section' => 'v2jda_contact',
			'type'    => 'text',
		) );
	}

	/* ---- Social links ---- */
	$wp_customize->add_section( 'v2jda_social', array(
		'title'    => __( 'V2 JDA - Social Links', 'v2jda' ),
		'priority' => 31,
	) );
	$socials = array(
		'facebook'  => array( 'label' => 'Facebook URL',  'default' => 'https://www.facebook.com/share/1Ct7vcFE6Y/' ),
		'youtube'   => array( 'label' => 'YouTube URL',   'default' => 'https://youtube.com/@v2jdaapprovedproperties' ),
		'instagram' => array( 'label' => 'Instagram URL', 'default' => '' ),
		'whatsapp'  => array( 'label' => 'WhatsApp URL',  'default' => 'https://wa.me/917597961878' ),
	);
	foreach ( $socials as $k => $cfg ) {
		$wp_customize->add_setting( "v2jda_social_$k", array(
			'default'           => $cfg['default'],
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		) );
		$wp_customize->add_control( "v2jda_social_$k", array(
			'label'   => $cfg['label'],
			'section' => 'v2jda_social',
			'type'    => 'url',
		) );
	}

	/* ---- Hero copy ---- */
	$wp_customize->add_section( 'v2jda_hero', array(
		'title'    => __( 'V2 JDA - Hero', 'v2jda' ),
		'priority' => 32,
	) );
	$hero = array(
		'eyebrow'  => array( 'label' => 'Eyebrow Text',     'default' => 'JDA & RERA Approved · Jaipur', 'type' => 'text' ),
		'title'    => array( 'label' => 'Hero Headline',    'default' => 'Build Your Future on Approved Land', 'type' => 'text' ),
		'subtitle' => array( 'label' => 'Hero Subheadline', 'default' => 'Premium residential plots, villas and farm-house properties across Jaipur — verified, registered and ready for your dream home.', 'type' => 'textarea' ),
		'image'    => array( 'label' => 'Hero Background Image URL', 'default' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1920&q=80', 'type' => 'url' ),
	);
	foreach ( $hero as $k => $cfg ) {
		$wp_customize->add_setting( "v2jda_hero_$k", array(
			'default'           => $cfg['default'],
			'sanitize_callback' => $cfg['type'] === 'url' ? 'esc_url_raw' : 'sanitize_text_field',
		) );
		$wp_customize->add_control( "v2jda_hero_$k", array(
			'label'   => $cfg['label'],
			'section' => 'v2jda_hero',
			'type'    => $cfg['type'],
		) );
	}

	/* ---- Lead capture ---- */
	$wp_customize->add_section( 'v2jda_leads', array(
		'title'    => __( 'V2 JDA - Lead Capture', 'v2jda' ),
		'priority' => 33,
	) );

	$wp_customize->add_setting( 'v2jda_sheets_url', array(
		'default'           => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( 'v2jda_sheets_url', array(
		'label'       => __( 'Google Apps Script Web App URL', 'v2jda' ),
		'description' => __( 'Paste the deployment URL from Google Apps Script (see docs/GOOGLE_SHEETS_SETUP.md). Leads will be saved both to Google Sheets and to the WordPress admin.', 'v2jda' ),
		'section'     => 'v2jda_leads',
		'type'        => 'url',
	) );

	$wp_customize->add_setting( 'v2jda_lead_email', array(
		'default'           => 'vishalkhandelwal267@gmail.com',
		'sanitize_callback' => 'sanitize_email',
	) );
	$wp_customize->add_control( 'v2jda_lead_email', array(
		'label'       => __( 'Notify Email (where new leads are emailed)', 'v2jda' ),
		'section'     => 'v2jda_leads',
		'type'        => 'email',
	) );
}
add_action( 'customize_register', 'v2jda_customize_register' );

/* Convenience accessor. */
function v2jda_opt( $key, $default = '' ) {
	return get_theme_mod( "v2jda_$key", $default );
}
