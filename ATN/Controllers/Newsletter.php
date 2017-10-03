<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class ATN_Controllers_Newsletter extends ATN_Base{
	protected static $instance = null;
	protected $menu_slug = null;
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
	
	public function atn_main(){
		global $wpdb;
		$data = array();
		$menu_slug = $this->menu_slug;
		$data['heading'] = 'AllTeams Newsletter';
		$data['method'] = '';
		$data['action'] = 'admin.php?page=' . $menu_slug;
		ATN_View::get_instance()->admin_partials('partials/main.php', $data);
	}

	/**
	 * Controller
	 *
	 * @param	$action		string | empty
	 * @parem	$arg		array
	 * 						optional, pass data for controller
	 * @return mix
	 * */
	public function controller($action = '', $arg = array()){
		$this->call_method($this, $action);
	}
	
	public function __construct(){
		$this->menu_slug = ATN_Admin_Newsletter::get_instance()->menu_slug();
	}
}
