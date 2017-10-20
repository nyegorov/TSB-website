<?php
/**
 * TSB back compat functionality
 *
 * Prevents TSB from running on WordPress versions prior to 4.1,
 * since this theme is not meant to be backward compatible beyond that and
 * relies on many newer functions and markup changes introduced in 4.1.
 *
 * @package WordPress
 * @subpackage TSB
 * @since TSB 1.0
 */

/**
 * Prevent switching to TSB on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since TSB 1.0
 */
function tsb_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'tsb_upgrade_notice' );
}
add_action( 'after_switch_theme', 'tsb_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * TSB on WordPress versions prior to 4.1.
 *
 * @since TSB 1.0
 */
function tsb_upgrade_notice() {
	$message = sprintf( __( 'TSB requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'tsb' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Customizer from being loaded on WordPress versions prior to 4.1.
 *
 * @since TSB 1.0
 */
function tsb_customize() {
	wp_die( sprintf( __( 'TSB requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'tsb' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}
add_action( 'load-customize.php', 'tsb_customize' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.1.
 *
 * @since TSB 1.0
 */
function tsb_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'TSB requires at least WordPress version 4.1. You are running version %s. Please upgrade and try again.', 'tsb' ), $GLOBALS['wp_version'] ) );
	}
}
add_action( 'template_redirect', 'tsb_preview' );
