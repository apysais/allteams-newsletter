<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class ATN_Model_DataSource{
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
	
	public function query($query_data = array()){
		//by default post type is posts
		$post_type = array('post');
		if( isset($query_data['post_type']) 
			&& !empty($query_data['post_type'])
			&& is_array($query_data['post_type'])
		){
			$post_type = $query_data['post_type'];
		}
		//by default get this week
		$date_query = array(
			'date_query' => array(
				array(
					'year' => date( 'Y' ),
					'week' => date( 'W' ),
				),
			),
		);
		if( isset($query_data['date_query']) 
			&& !empty($query_data['date_query'])
			&& is_array($query_data['date_query'])
		){
			$date_query = array(
				'date_query' => array(
					array(
						'after' => '-'.$query_data['date_query'].' days',
						'inclusive' => true,
					),
				),
			);
		}
		//posts_per_page
		$posts_per_page = -1;
		if( isset($query_data['posts_per_page']) 
			&& !empty($query_data['posts_per_page'])
		){
			$posts_per_page = $query_data['posts_per_page'];
		}
		$args = array(
			$post_type,
			$date_query,
			'posts_per_page' => $posts_per_page
		);
		$query = new WP_Query( $args );
		if ( $query->have_posts() ) {
			wp_reset_postdata();
			return $query;
		}
		return false;
	}
	
	public function __construct(){
	}
}