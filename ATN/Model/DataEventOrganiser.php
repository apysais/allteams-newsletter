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
class ATN_Model_DataEventOrganiser{
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
	/**
		http://codex.wp-event-organiser.com/function-eo_get_events.html
		The $args array can include the following.

		event_start_before - default: null Events that start before the given date
		event_end_before - default: null Events that end before the given date
		event_start_after - default: null Events that start before the given date
		event_end_after - default: null. Events that end after the given date. This argument, and those above expect dates in Y-m-d format or relative dates.
		ondate - Events that start on this specific date given as a string in YYYY-MM-DD format or relative format. default: null
		numberposts - default is -1 (all events)
		orderby - default is eventstart. You can also have eventend.
		showpastevents - default is true (it's recommended to use event_start_after=today or event_end_after=today instead)
		event-category - the slug of an event category. Get events for this category
		event-venue - the slug of an event venue. Get events for this venue
		event-tag - the slug of an event venue. Get events for this tag
		group_events_by - If set to 'series', only the first matching occurrence of a recurring event is returned.
		bookee_id - (int) ID of user to retrieve events for which the user is attending
	**/
	public function query($query_data = array()){
		if ( is_plugin_active( 'event-organiser/event-organiser.php' ) ) {
			$query = wp_parse_args($query_data, array(
				'posts_per_page'   => -1,
				'post_type'        => 'event',
				'suppress_filters' => false,
				'orderby'          => 'eventstart',
				'order'            => 'ASC',
				'showrepeats'      => 1,
				'group_events_by'  => '',
				'showpastevents'   => true,
				'no_found_rows'    => true,
				'event_start_before'    => 'now',
				'event_end_after'    => 'now',
			));
			if ( ! empty( $query['numberposts'] ) ) {
				$query['posts_per_page'] = (int) $query['numberposts'];
			}
			$eo = new WP_Query($query);
			wp_reset_postdata();
			return $eo;
		}
		
		return false;
	}
	
	public function __construct(){
	}
}