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
 * Version:           1.3.2
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

define( 'PLUGIN_NAME_VERSION', '1.3.2' );
//define('TO_MAIL', 'mike@allteams.com');
define('TO_MAIL', 'allan.paul.casilum@gmail.com');
define('SUBJECT_MAIL', 'Test Mail');
/**
 * For autoloading classes
 * */
spl_autoload_register('atn_autoload_class');
function atn_autoload_class($class_name){
    if ( false !== strpos( $class_name, 'ATN' ) ) {
		$include_classes_dir = realpath( get_template_directory( __FILE__ ) ) . DIRECTORY_SEPARATOR;
		$admin_classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR;
		$class_file = str_replace( '_', DIRECTORY_SEPARATOR, $class_name ) . '.php';
		if( file_exists($include_classes_dir . $class_file) ){
			require_once $include_classes_dir . $class_file;
		}
		if( file_exists($admin_classes_dir . $class_file) ){
			require_once $admin_classes_dir . $class_file;
		}
	}
}
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
require plugin_dir_path( __FILE__ ) . 'function-helper.php';
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
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
	allteams_news_letter_init_updater();

	new ATN_Admin_Newsletter;
	//mailpoet shortcode
	ATN_Model_MailPoet::get_instance();
}
add_action('plugins_loaded', 'run_allteams_newsletter');
function atn_get_plugin_details(){
	// Check if get_plugins() function exists. This is required on the front end of the
	// site, since it is in a file that is normally only loaded in the admin.
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
	}
	$ret = get_plugins();
	return $ret['allteams-newsletter/allteams-newsletter.php'];
}
function atn_get_text_domain(){
	$ret = atn_get_plugin_details();
	return $ret['TextDomain'];
}
function atn_get_plugin_dir(){
	return plugin_dir_path( __FILE__ );
}

function allteams_news_letter_init_updater(){
	$updater = new ATN_Updater( __FILE__ ); // instantiate our class
	$updater->set_username( 'apysais' ); // set username
	$updater->set_repository( 'allteams-newsletter' ); // set repo
	$updater->initialize(); // initialize the updater
}

function test(){
	$sh = "[custom:allteams_newsletter_gallery posts_per_page:5 show_img_from_last:7]";

	if (strpos($sh, 'custom:allteams_newsletter_gallery') !== false) {
		atn_mailpoet_shortcode_parse_gallery($sh);
	}else{
		echo 'x';
	}
	//atn_mailpoet_shortcode_parse_events($sh);
	exit();
}
//add_action('init','test');
