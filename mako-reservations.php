<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://jefferykarbowski.com
 * @since             1.0.0
 * @package           Mako_Reservations
 *
 * @wordpress-plugin
 * Plugin Name:       Mako Reservations
 * Plugin URI:        https://makoreservations.com/
 * Description:       Wordpress Plugin for displaying Mako Reservations Calendars.
 * Version:           1.2.0
 * Author:            Jeffery Karbowski
 * Author URI:        https://jefferykarbowski.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mako-reservations
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MAKO_RESERVATIONS_VERSION', '1.2.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mako-reservations-activator.php
 */
function activate_mako_reservations() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mako-reservations-activator.php';
	Mako_Reservations_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mako-reservations-deactivator.php
 */
function deactivate_mako_reservations() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mako-reservations-deactivator.php';
	Mako_Reservations_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mako_reservations' );
register_deactivation_hook( __FILE__, 'deactivate_mako_reservations' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mako-reservations.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mako_reservations() {

	$plugin = new Mako_Reservations();
	$plugin->run();

}
run_mako_reservations();


require plugin_dir_path( __FILE__ ) . 'vendors/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
    'https://github.com/jefferykarbowski/mako-reservations/',
    __FILE__,
    'mako-reservations'
);
$myUpdateChecker->setBranch('main');
