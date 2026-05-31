<?php
/**
 * V2 JDA Approved Properties - Theme functions.
 *
 * @package V2JDA
 */

if ( ! defined( 'ABSPATH' ) ) { exit; }

define( 'V2JDA_VERSION', '1.0.0' );
define( 'V2JDA_DIR', get_template_directory() );
define( 'V2JDA_URI', get_template_directory_uri() );

require_once V2JDA_DIR . '/inc/theme-setup.php';
require_once V2JDA_DIR . '/inc/enqueue.php';
require_once V2JDA_DIR . '/inc/cpt-project.php';
require_once V2JDA_DIR . '/inc/customizer.php';
require_once V2JDA_DIR . '/inc/lead-handler.php';
require_once V2JDA_DIR . '/inc/template-helpers.php';
require_once V2JDA_DIR . '/inc/seo.php';
