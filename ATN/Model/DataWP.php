<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
*
* Will use this exclusive for WP posts and other CPT
*
**/
class ATN_Model_DataWP{
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
			'year' => date( 'Y' ),
			'week' => date( 'W' ),
		);
		if( isset($query_data['date_query']) 
			&& !empty($query_data['date_query'])
		){
			$query_after_before = checkPositive($query_data['date_query']);

			$date_query = array(
				$query_after_before => $query_data['date_query'],
				'inclusive' => true,
			);
		}
		//posts_per_page
		$posts_per_page = -1;
		if( isset($query_data['posts_per_page']) 
			&& trim($query_data['posts_per_page'])!= ''
		){
			$posts_per_page = $query_data['posts_per_page'];
		}
		//category
		$category = '';
		if( isset($query_data['category']) 
		){
			$category = $query_data['category'];
		}
		$args = array(
			'post_status' => array('future','publish'),
			'post_type'=> $post_type,
			'date_query' => $date_query,
			'posts_per_page' => $posts_per_page,
			'cat' => $category
		);
		//print_r($args);
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