<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       allteams.nz
 * @since      1.0.0
 *
 * @package    Allteams_Newsletter
 * @subpackage Allteams_Newsletter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Allteams_Newsletter
 * @subpackage Allteams_Newsletter/includes
 * @author     AllTeams <mike@allteams.nz>
 */
class Allteams_Newsletter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'allteams-newsletter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
