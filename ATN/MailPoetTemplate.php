<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ATN_MailPoetTemplate{
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
    protected $vars = [];

    /**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() 
    {

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
		
	public function __construct()
    {

	}

    public function get($template_file = '', $data = [])
    {

        $template = 'atnmailpoet/' . $template_file;

        //check in the theme
        $theme = ATN_View::get_instance()->get_in_theme($template);
        if ( $theme ) {
            $get_template = $theme;
        } else {
            //check in the plugin
            $plugin = ATN_View::get_instance()->get_in_plugin($template);
            if( $plugin ) {
                $get_template = $plugin;
            }
        }

        ob_start();
        ATN_View::get_instance()->display($get_template, $data);
        return ob_get_clean();  
    }
}