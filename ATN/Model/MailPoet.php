<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
*
* MailPoet extension
*
**/
class ATN_Model_MailPoet{
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
	
	public function mailpoet_allteams_shortcode($shortcode, $newsletter, $subscriber, $queue, $newsletter_body) {
		// always return the shortcode if it doesn't match your own!
		if (strpos($shortcode, 'custom:allteams_newsletter_post') !== false){
			return atn_mailpoet_shortcode_parse_posts($shortcode);
		}elseif(strpos($shortcode, 'custom:allteams_newsletter_events') !== false){
			return atn_mailpoet_shortcode_parse_events($shortcode);
		}elseif(strpos($shortcode, 'custom:allteams_newsletter_gallery') !== false){
			return atn_mailpoet_shortcode_parse_gallery($shortcode);
		}elseif(strpos($shortcode, 'custom:allteams_issue_posts') !== false){
			return atn_mailpoet_shortcode_parse_issue_posts($shortcode);
		}
		return $shortcode;
	}
	
	public function __construct(){
		add_filter('mailpoet_newsletter_shortcode', array($this, 'mailpoet_allteams_shortcode'), 10, 5);
	}
}