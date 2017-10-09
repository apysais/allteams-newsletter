<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
*
* Will use this exclusive for WP posts and other CPT
*
**/
class ATN_Model_SendMail{
	/**
	 * instance of this class
	 *
	 * @since 3.12
	 * @access protected
	 * @var	null
	 * */
	protected static $instance = null;

    /**
     * use for magic setters and getter
     * we can use this when we instantiate the class
     * it holds the variable from __set
     *
     * @see function __get, function __set
     * @access protected
     * @var array
     * */
    protected $vars = array();

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
	
	public function send($data = array()){
		$to = $data['to'];
		$subject = $data['subject'];
		$headers = array('Content-Type: text/html; charset=UTF-8');
		ob_start(); 
		ATN_View::get_instance()->admin_partials('partials/email-templates/template.php', $data);
		$body = ob_get_contents();
		ob_end_clean();
		wp_mail( $to, $subject, $body, $headers );
	}		
	
	public function __construct(){}
}