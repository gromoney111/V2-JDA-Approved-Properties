<?php
/**
 * Site header.
 *
 * @package V2JDA
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if ( function_exists( 'wp_body_open' ) ) wp_body_open(); ?>

<a class="screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'v2jda' ); ?></a>

<header class="site-header" role="banner">
	<div class="container nav">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo" aria-label="<?php bloginfo( 'name' ); ?>">
			<?php if ( has_custom_logo() ) : the_custom_logo(); else : ?>
				<span class="mark">V2</span>
				<span><?php bloginfo( 'name' ); ?><small><?php esc_html_e( 'JDA & RERA Approved', 'v2jda' ); ?></small></span>
			<?php endif; ?>
		</a>

		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'nav-links',
				'fallback_cb'    => 'v2jda_default_nav',
			) );
		} else {
			v2jda_default_nav();
		}
		?>

		<div class="nav-cta">
			<a href="tel:+<?php echo esc_attr( preg_replace( '/\D/', '', v2jda_opt( 'phone_e164', '917597961878' ) ) ); ?>" class="phone-pill">
				<i class="fa-solid fa-phone"></i> <?php echo esc_html( v2jda_opt( 'phone', '+91 75979 61878' ) ); ?>
			</a>
			<button class="menu-toggle" aria-label="<?php esc_attr_e( 'Toggle menu', 'v2jda' ); ?>" aria-expanded="false">
				<i class="fa-solid fa-bars"></i>
			</button>
		</div>
	</div>
</header>

<?php
/**
 * Default navigation if the user hasn't created a Primary menu yet.
 */
function v2jda_default_nav() {
	$items = array(
		'/'         => __( 'Home', 'v2jda' ),
		'/about/'   => __( 'About', 'v2jda' ),
		'/projects/'=> __( 'Projects', 'v2jda' ),
		'/gallery/' => __( 'Gallery', 'v2jda' ),
		'/media/'   => __( 'Media', 'v2jda' ),
		'/contact/' => __( 'Contact', 'v2jda' ),
	);
	$current = trailingslashit( wp_parse_url( home_url( $_SERVER['REQUEST_URI'] ?? '/' ), PHP_URL_PATH ) );
	echo '<ul class="nav-links">';
	foreach ( $items as $path => $label ) {
		$active = ( $current === $path || ( $path === '/' && is_front_page() ) ) ? ' class="active"' : '';
		printf( '<li><a href="%s"%s>%s</a></li>', esc_url( home_url( $path ) ), $active, esc_html( $label ) );
	}
	echo '</ul>';
}
?>

<main id="content" class="site-main">
