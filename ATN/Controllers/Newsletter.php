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
	
	public function newsletter_article(){
		$form_post = $_POST;
		$data = array();
		$this->atn_main();

		if( isset($form_post['query']) 
			&& isset($form_post['wp'])
		){
			$wp_forms = $form_post['wp'];
			$ds = new ATN_Model_DataWP;
			if( isset($wp_forms['last_date_query']) ){
				$wp_forms['date_query'] = '-'.$wp_forms['last_date_query'].' days';
			}
			if( isset($wp_forms['posts_per_page']) 
				&& $wp_forms['posts_per_page'] == 0
			){
				$wp_forms['posts_per_page'] = -1;
			}
			$query = $ds->query($wp_forms);
			
			if( $query ){
				$data['post_count'] = $query->post_count;
				$data['posts'] = $query->posts;
				
			}
		}
		if( isset($form_post['events'])
		){
			//_dump($form_post['events']);
			$event_forms['numberposts'] = $form_post['events']['posts_per_page'];
			$event_forms['event-category'] = implode(',',$form_post['events']['category']);
			if( isset($form_post['events']['date_query']) ){
				$event_forms['event_start_before'] = '+'.$form_post['events']['date_query'].' days';
			}
			$event_query = new ATN_Model_DataEventOrganiser;
			$event_get_query = $event_query->query($event_forms);
			$data['event_count'] = $event_get_query->post_count;
			$data['events'] = $event_get_query->posts;
		}
		ATN_View::get_instance()->admin_partials('partials/email-templates/template.php', $data);
	}
	
	public function atn_main(){
		global $wpdb;
		$data = array();
		
		$menu_slug = $this->menu_slug;
		$data['heading'] = 'AllTeams Newsletter';
		$data['method'] = 'newsletter_article';
		$data['action'] = 'admin.php?page=' . $menu_slug;
		$data['posts']['categories'] =  get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC'
		) );
		$taxonomies = get_terms('event-category');
		$data['events']['categories'] = $taxonomies;		
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
