<?php
/**
 * Plugin Name:           SMNTCS Adobe Typekit Fonts
 * Plugin URI:            https://github.com/nielslange/smntcs-adobe-typekit-fonts
 * Description:           Adds Adobe Typekit Fonts to your WordPress site.
 * Author:                Niels Lange
 * Author URI:            https://nielslange.de
 * Text Domain:           smntcs-adobe-typekit-fonts
 * Version:               1.9
 * Requires PHP:          5.6
 * Requires at least:     3.4
 * License:               GPL v2 or later
 * License URI:           https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package SMNTCS_Adobe_Typekit_Fonts
 */

defined( 'ABSPATH' ) || exit;

/**
 * SMNTCS_Nord_Admin_Theme main class.
 *
 * @since 1.6.0
 */
class SMNTCS_Adobe_Typekit_Fonts {

	/**
	 * Initialise the plugin.
	 *
	 * @return void
	 * @since 1.2.0
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'register_customizer' ) );
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), array( $this, 'settings_link' ) );
		add_action( 'wp_head', array( $this, 'enqueue_adobe_typekit_fonts' ) );
	}

	/**
	 * Add settings link on plugin page.
	 *
	 * @param string $links The settings link on the plugin page.
	 * @return mixed
	 * @since 1.0.0
	 */
	public function settings_link( $links ) {
		$links         = (array) $links;
		$admin_url     = admin_url( 'customize.php?autofocus[control]=adobe_typekit_fonts_code' );
		$settings_link = sprintf( '<a href="%s">%s</a>', $admin_url, __( 'Settings', 'smntcs-adobe-typekit-fonts' ) );

		array_unshift( $links, $settings_link );

		return $links;
	}

	/**
	 * Add Adobe Typekit Fonts to WordPress Customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize The instance of the WP_Customize_Manager class.
	 * @return void
	 * @since 1.0.0
	 */
	public function register_customizer( $wp_customize ) {
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
				'default' => '',
				'type'    => 'option',
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
				'default' => '',
				'type'    => 'option',
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

	/**
	 * Load Adobe Typekit Fonts code and custom CSS
	 */
	public function enqueue_adobe_typekit_fonts() {
		if ( get_option( 'adobe_typekit_fonts_code' ) && get_option( 'adobe_typekit_fonts_custom_css' ) ) {
			// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			print( get_option( 'adobe_typekit_fonts_code' ) );
			printf( '<style type="text/css" media="screen">%s</style>', esc_attr( get_option( 'adobe_typekit_fonts_custom_css' ) ) );
		}
	}
}

new SMNTCS_Adobe_Typekit_Fonts();
