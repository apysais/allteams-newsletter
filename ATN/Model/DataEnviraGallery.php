<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
*
* Will use this exclusive for event organiser
http://codex.wp-event-organiser.com
*
**/
class ATN_Model_DataEnviraGallery{
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
	
	private function _get_images($posts_id, $skip_empty = true, $search_terms = ''){
		// Now loop through all the galleries found and only use galleries that have images in them.
		$ret = array();
		$data = get_post_meta( $posts_id, '_eg_gallery_data', true );
		if ( $skip_empty && !empty( $data['gallery'] ) ) {
			//_dump($data);
			// Skip default/dynamic gallery types.
			//$type = Envira_Gallery_Shortcode::get_instance()->get_config( 'type', $data );
			//if ( 'defaults' === Envira_Gallery_Shortcode::get_instance()->get_config( 'type', $data ) || 'dynamic' === Envira_Gallery_Shortcode::get_instance()->get_config( 'type', $data ) ) {
			//	continue;
			//}

			// Add gallery to array of galleries.
			$ret = $data;
		}

		// Return the gallery data.
		return $ret;
	}
	
	public function query($query_data = array()){
		$envira_ret = array();
		if ( is_plugin_active( 'envira-gallery/envira-gallery.php' ) ) {
			// Build WP_Query arguments.
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
			$query = wp_parse_args($query_data, array(
				'post_type'     => 'envira',
				'post_status'   => 'publish',
				'posts_per_page'=> 99,
				'no_found_rows' => true,
				'meta_query'    => array(
					array(
						'key'   => '_eg_gallery_data',
						'compare' => 'EXISTS',
					),
				),
			));
			
			$query['date_query'] = $date_query;
			//_dump($query);
			$envira = new WP_Query($query);
			//_dump($envira);
			if ( $envira->have_posts() ) {
				foreach ( $envira->posts as $key => $val ) {
					$envira_ret[] = array(
						'data' => $val,
						'images' => $this->_get_images($val->ID)
					);
				}
			}
			wp_reset_postdata();
			return $envira_ret;
		}
		return false;
	}
	
	public function __construct(){
	}
}