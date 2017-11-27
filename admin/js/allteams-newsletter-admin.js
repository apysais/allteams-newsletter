(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	function allt_init_wp(){
		let span_wp_posts_per_page;
		let span_wp_last_date_query;
		let span_article_category;
		
		let input_wp_posts_per_page;
		let input_wp_last_date_query;
		let input_wp_category;
		
		input_wp_posts_per_page = $('.wp_posts_per_page');
		input_wp_last_date_query = $('.wp_last_date_query');
		input_wp_category = $('.wp_category');
		
		span_wp_posts_per_page = $('.article_posts_per_page');
		span_wp_last_date_query = $('.article_show_article_from_last');
		span_article_category = $('.article_category');
		
		input_wp_posts_per_page.on('change',function(){
			let _this_val = $(this).val();
			span_wp_posts_per_page.html(_this_val);
		});
		
		input_wp_last_date_query.on('change',function(){
			let _this_val = $(this).val();
			span_wp_last_date_query.html(_this_val);
		});
		
		input_wp_category.on('change',function(){
			let _this = $(this);
			//console.log(_this.map(function() {return _this.val();}).get().join(','));
			span_article_category.html(_this.map(function() {return _this.val();}).get().join(','));
		});
	}
	
	function allt_init_events(){
		let span_event_posts_per_page;
		let span_event_show_upcoming_days;
		let span_event_category;
		
		let input_event_posts_per_page;
		let input_event_show_upcoming_days;
		let input_event_category;
		
		input_event_posts_per_page = $('.events_posts_per_page');
		input_event_show_upcoming_days = $('.events_date_query');
		input_event_category = $('.events_category');
		
		span_event_posts_per_page = $('.span_event_posts_per_page');
		span_event_show_upcoming_days = $('.span_event_show_upcoming_days');
		span_event_category = $('.span_event_category');
		
		input_event_posts_per_page.on('change',function(){
			let _this_val = $(this).val();
			span_event_posts_per_page.html(_this_val);
		});
		
		input_event_show_upcoming_days.on('change',function(){
			let _this_val = $(this).val();
			span_event_show_upcoming_days.html(_this_val);
		});
		
		input_event_category.on('change',function(){
			let _this = $(this);
			//console.log(_this.map(function() {return _this.val();}).get().join(','));
			span_event_category.html(_this.map(function() {return _this.val();}).get().join(','));
		});
	}
	
	function allt_init_gellery(){
		let span_gallery_posts_per_page;
		let span_gallery_show_img_from_last;
		
		let input_gallery_posts_per_page;
		let input_gallery_last_date_query;
		
		input_gallery_posts_per_page = $('.gallery_posts_per_page');
		input_gallery_last_date_query = $('.gallery_last_date_query');
		
		span_gallery_posts_per_page = $('.span_gallery_posts_per_page');
		span_gallery_show_img_from_last = $('.span_gallery_show_img_from_last');
		
		input_gallery_posts_per_page.on('change',function(){
			let _this_val = $(this).val();
			span_gallery_posts_per_page.html(_this_val);
		});
		
		input_gallery_last_date_query.on('change',function(){
			let _this_val = $(this).val();
			span_gallery_show_img_from_last.html(_this_val);
		});
	}		
	$( window ).load(function() {
		allt_init_wp();
		allt_init_events();
		allt_init_gellery();
	});
})( jQuery );
