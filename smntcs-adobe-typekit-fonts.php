<?php
/*
Plugin Name: SMNTCS Adobe Typekit Fonts
Description: Adds Adobe Typekit Fonts to your WordPress site. 
Version: 1.0
Author: Niels Lange
Author URI: https://nielslange.com
Requires at least: 3.4
Tested up to: 4.6.2
License: GPLv2 or later
Text Domain: smntcs-adobe-typekit-fonts
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2016 Niels Lange
*/

// Avoid direct plugin access
if ( !defined( 'ABSPATH' ) ) exit;

// Load text domain
add_action('plugins_loaded', 'smntcs_adobe_typekit_fonts_load_textdomain');
function smntcs_adobe_typekit_fonts_load_textdomain() {
	load_plugin_textdomain( 'smntcs-adobe-typekit-fonts', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

// Add Adobe Typekit Fonts to WordPress Customizer
add_action( 'customize_register', 'smntcs_adobe_typekit_fonts_register_customize' );
function smntcs_adobe_typekit_fonts_register_customize( $wp_customize ) {
	$wp_customize->add_section( 'adobe_typekit_fonts_section', array(
		'priority' 	=> 150,
		'title' 	=> __('Adobe Typekit Fonts', 'smntcs-adobe-typekit-fonts'),
	));

	$wp_customize->add_setting( 'adobe_typekit_fonts_code', array( 
		'default' 	=> '',
		'type'		=> 'option',
	));
	
	$wp_customize->add_control( 'adobe_typekit_fonts_code', array(
		'label' 	=> __('Adobe Typekit Fonts code', 'smntcs-adobe-typekit-fonts'),
		'section' 	=> 'adobe_typekit_fonts_section',
		'type' 		=> 'textarea',
	));
	
	$wp_customize->add_setting( 'adobe_typekit_fonts_custom_css', array(
		'default' 	=> '',
		'type'		=> 'option',
	));
	
	$wp_customize->add_control( 'adobe_typekit_fonts_custom_css', array(
		'label' 	=> __('Adobe Typekit Fonts custom CSS', 'smntcs-adobe-typekit-fonts'),
		'section' 	=> 'adobe_typekit_fonts_section',
		'type' 		=> 'textarea',
	));
}

// Load Adobe Typekit Fonts code and custom CSS
add_action('wp_head', 'smntcs_adobe_typekit_fonts_enqueue');
function smntcs_adobe_typekit_fonts_enqueue() {
	if ( get_option('adobe_typekit_fonts_code') && get_option('adobe_typekit_fonts_custom_css') ) {
		print(get_option('adobe_typekit_fonts_code'));
		printf('<style type="text/css" media="screen">%s</style>', get_option('adobe_typekit_fonts_custom_css'));
	}
}