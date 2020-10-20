<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://jefferykarbowski.com
 * @since      1.0.0
 *
 * @package    Mako_Reservations
 * @subpackage Mako_Reservations/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mako_Reservations
 * @subpackage Mako_Reservations/includes
 * @author     Jeffery Karbowski <jefferykarbowski@gmail.com>
 */
class Mako_Reservations_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mako-reservations',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
