<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class ATN_Admin_Newsletter {
	protected static $instance = null;
	
	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		/*
		 * @TODO :
		 *
		 * - Uncomment following lines if the admin class should only be available for super admins
		 */
		/* if( ! is_super_admin() ) {
			return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
	
	public function menu_slug(){
		return 'atn-main';
	}
	
	/**
	 * Add sub menu page
	 *
	 * @since 1.0.0
	 */
	public function add_admin_menu() {
		$textdomain = atn_get_text_domain();
		add_menu_page(
			esc_html__( 'AllTeams Newsletter', $textdomain ),
			esc_html__( 'AllTeams Newsletter', $textdomain ),
			'manage_options',
			$this->menu_slug(),
			array(ATN_Controllers_Newsletter::get_instance(), 'controller')
		);
	}
	
	public function __construct(){
		if ( is_admin() ) {
			add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
		}
	}
}
