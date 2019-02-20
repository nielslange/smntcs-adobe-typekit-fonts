<?php
/**
 * Plugin Name: SMNTCS Adobe Typekit Fonts
 * Plugin URI: https://github.com/nielslange/smntcs-adobe-typekit-fonts
 * Description: Adds Adobe Typekit Fonts to your WordPress site.
 * Author: Niels Lange
 * Author URI: https://nielslange.com
 * Text Domain: smntcs-adobe-typekit-fonts
 * Version: 1.3
 * Requires at least: 3.4
 * Tested up to: 5.1
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// Avoid direct plugin access
if ( ! defined( 'ABSPATH' ) ) {
	die( '¯\_(ツ)_/¯' );
}

// Load text domain
add_action( 'plugins_loaded', 'smntcs_adobe_typekit_fonts_load_textdomain' );
function smntcs_adobe_typekit_fonts_load_textdomain() {
	load_plugin_textdomain( 'smntcs-adobe-typekit-fonts', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

// Add Adobe Typekit Fonts to WordPress Customizer
add_action( 'customize_register', 'smntcs_adobe_typekit_fonts_register_customize' );
function smntcs_adobe_typekit_fonts_register_customize( $wp_customize ) {
	$wp_customize->add_section( 'adobe_typekit_fonts_section', array(
		'priority' => 150,
		'title'    => __( 'Adobe Typekit Fonts', 'smntcs-adobe-typekit-fonts' ),
	) );

	$wp_customize->add_setting( 'adobe_typekit_fonts_code', array(
		'default' => '',
		'type'    => 'option',
	) );

	$wp_customize->add_control( 'adobe_typekit_fonts_code', array(
		'label'   => __( 'Adobe Typekit Fonts code', 'smntcs-adobe-typekit-fonts' ),
		'section' => 'adobe_typekit_fonts_section',
		'type'    => 'textarea',
	) );

	$wp_customize->add_setting( 'adobe_typekit_fonts_custom_css', array(
		'default' => '',
		'type'    => 'option',
	) );

	$wp_customize->add_control( 'adobe_typekit_fonts_custom_css', array(
		'label'   => __( 'Adobe Typekit Fonts custom CSS', 'smntcs-adobe-typekit-fonts' ),
		'section' => 'adobe_typekit_fonts_section',
		'type'    => 'textarea',
	) );
}

// Load Adobe Typekit Fonts code and custom CSS
add_action( 'wp_head', 'smntcs_adobe_typekit_fonts_enqueue' );
function smntcs_adobe_typekit_fonts_enqueue() {
	if ( get_option( 'adobe_typekit_fonts_code' ) && get_option( 'adobe_typekit_fonts_custom_css' ) ) {
		print( get_option( 'adobe_typekit_fonts_code' ) );
		printf( '<style type="text/css" media="screen">%s</style>', get_option( 'adobe_typekit_fonts_custom_css' ) );
	}
}