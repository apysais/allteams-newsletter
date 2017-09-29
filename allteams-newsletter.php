<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              allteams.nz
 * @since             1.0.0
 * @package           Allteams_Newsletter
 *
 * @wordpress-plugin
 * Plugin Name:       AllTeams Newsletter
 * Plugin URI:        allteams.nz
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            AllTeams
 * Author URI:        allteams.nz
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       allteams-newsletter
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-allteams-newsletter-activator.php
 */
function activate_allteams_newsletter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-allteams-newsletter-activator.php';
	Allteams_Newsletter_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-allteams-newsletter-deactivator.php
 */
function deactivate_allteams_newsletter() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-allteams-newsletter-deactivator.php';
	Allteams_Newsletter_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_allteams_newsletter' );
register_deactivation_hook( __FILE__, 'deactivate_allteams_newsletter' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-allteams-newsletter.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_allteams_newsletter() {

	$plugin = new Allteams_Newsletter();
	$plugin->run();
	init_updater();
}
run_allteams_newsletter();
function init_updater(){
	$updater = new AllT_Updater( __FILE__ ); // instantiate our class
	$updater->set_username( 'apysais' ); // set username
	$updater->set_repository( 'allteams-newsletter' ); // set repo
	$updater->initialize(); // initialize the updater
}