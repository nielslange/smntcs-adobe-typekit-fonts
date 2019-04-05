<?php
/**
 * Plugin Name: SMNTCS Adobe Typekit Fonts
 * Plugin URI: https://github.com/nielslange/smntcs-adobe-typekit-fonts
 * Description: Adds Adobe Typekit Fonts to your WordPress site.
 * Author: Niels Lange <info@nielslange.de>
 * Author URI: https://nielslange.de
 * Text Domain: smntcs-adobe-typekit-fonts
 * Version: 1.4
 * Requires at least: 3.4
 * Requires PHP: 5.6
 * Tested up to: 5.1
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @category   Plugin
 * @package    WordPress
 * @subpackage SMNTCS Adobe Typekit Fonts
 * @author     Niels Lange <info@nielslange.de>
 * @license    http://opensource.org/licenses/gpl-license.php GNU Public License
 */

/**
 * Avoid direct plugin access
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '¯\_(ツ)_/¯' );
}

add_action( 'plugins_loaded', 'smntcs_adobe_typekit_fonts_load_textdomain' );
/**
 * Load text domain
 */
function smntcs_adobe_typekit_fonts_load_textdomain() {
	load_plugin_textdomain( 'smntcs-adobe-typekit-fonts', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

add_action( 'customize_register', 'smntcs_adobe_typekit_fonts_register_customize' );
/**
 * Add Adobe Typekit Fonts to WordPress Customizer
 *
 * @param WP_Customize_Manager $wp_customize The instance of the WP_Customize_Manager class.
 */
function smntcs_adobe_typekit_fonts_register_customize( $wp_customize ) {
	$wp_customize->add_section(
		'adobe_typekit_fonts_section',
		array(
			'priority' => 150,
			'title'    => __( 'Adobe Typekit Fonts', 'smntcs-adobe-typekit-fonts' ),
		)
	);

	$wp_customize->add_setting(
		'adobe_typekit_fonts_code',
		array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);

	$wp_customize->add_control(
		'adobe_typekit_fonts_code',
		array(
			'label'   => __( 'Adobe Typekit Fonts code', 'smntcs-adobe-typekit-fonts' ),
			'section' => 'adobe_typekit_fonts_section',
			'type'    => 'textarea',
		)
	);

	$wp_customize->add_setting(
		'adobe_typekit_fonts_custom_css',
		array(
			'default'           => '',
			'type'              => 'option',
			'sanitize_callback' => 'sanitize_textarea_field',
		)
	);

	$wp_customize->add_control(
		'adobe_typekit_fonts_custom_css',
		array(
			'label'   => __( 'Adobe Typekit Fonts custom CSS', 'smntcs-adobe-typekit-fonts' ),
			'section' => 'adobe_typekit_fonts_section',
			'type'    => 'textarea',
		)
	);
}

add_action( 'wp_head', 'smntcs_adobe_typekit_fonts_enqueue' );
/**
 * Load Adobe Typekit Fonts code and custom CSS
 */
function smntcs_adobe_typekit_fonts_enqueue() {
	if ( get_option( 'adobe_typekit_fonts_code' ) && get_option( 'adobe_typekit_fonts_custom_css' ) ) {
		print( esc_html( get_option( 'adobe_typekit_fonts_code' ) ) );
		printf( '<style type="text/css" media="screen">%s</style>', esc_html( get_option( 'adobe_typekit_fonts_custom_css' ) ) );
	}
}
