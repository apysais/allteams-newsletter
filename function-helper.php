<?php

function checkPositive($number) {
   if (!is_numeric(substr($number, 0, 1))) {
       $sign = substr($number, 0, 1);
       return 'before';
   }
   return 'after';
}
if( !function_exists('atn_get_posts') ){
    function atn_get_posts($num_article = 5, $article_from_last = 7, $category = array()){

        $ds = new ATN_Model_DataWP;
        $arg = array(
            'date_query' => $article_from_last . ' days ago',
            'posts_per_page' => $num_article,
            'category' => $category
        );

        $query = $ds->query($arg);

        return $query;
    }
}
if( !function_exists('atn_mailpoet_shortcode_parse_posts') ){
    function atn_mailpoet_shortcode_parse_posts($mailpoet_shortcode = ''){
        $atts = shortcode_parse_atts(strip_tags($mailpoet_shortcode));
		$arg = array();
        foreach($atts as $k => $v){
            $to_array = explode(':',$v);
            foreach($to_array as $to_arrayk => $to_arrayv){
                if( $to_arrayv == 'posts_per_page' ){
                    $arg['posts_per_page'] = $to_array[1];
                }
                if( $to_arrayv == 'category' ){
                    $category = rtrim($to_array[1],']');
                    $arg['category'] = array();
                    if( trim($category)!= '' ){
                        $arg['category'] = explode(',',$category);
                    }
                }
                if( $to_arrayv == 'show_article_from_last' ){
                    $arg['date_query'] = $to_array[1];
                }
            }
        }
		
        $wp_posts = atn_get_posts($arg['posts_per_page'], $arg['date_query'], $arg['category']);
        
        $data = [
            'wp_posts' => $wp_posts
        ];

        return ATN_MailPoetTemplate::get_instance()->get('wp-template-posts.php', $data);
    }
}
if( !function_exists('atn_mailpoet_shortcode_parse_events') ){
    //[custom:allteams_newsletter_events post_per_page:5 show_upcoming_days:7 category:'']
    function atn_mailpoet_shortcode_parse_events($mailpoet_shortcode = ''){
        $atts = shortcode_parse_atts(strip_tags($mailpoet_shortcode));

        $arg = array();
        foreach($atts as $k => $v){
            $to_array = explode(':',$v);
            //print_r($to_array);
            foreach($to_array as $to_arrayk => $to_arrayv){
                if( $to_arrayv == 'post_per_page' ){
                    $arg['numberposts'] = $to_array[1];
                }
                if( $to_arrayv == 'category' ){
                    $category = rtrim($to_array[1],']');
                    $arg['event-category'] = array();
                    if( trim($category)!= '' ){
                        $arg['event-category'] = $category;
                    }
                }
                if( $to_arrayv == 'show_upcoming_days' ){
                    $arg['event_start_before'] = '+'.$to_array[1].' days';
                }
            }
        }

        $event_posts = atn_get_events($arg['numberposts'], $arg['event_start_before'], $arg['event-category']);
        $data = [
            'event_posts' => $event_posts
        ];
        return ATN_MailPoetTemplate::get_instance()->get('wp-template-eo-events.php', $data);
		
    }
}
if( !function_exists('atn_get_events') ){
    function atn_get_events($num_event_show = 5, $event_upcoming = 7, $category = array()){
        $event_query = new ATN_Model_DataEventOrganiser;
        $arg = array(
            'event_start_before' => $event_upcoming,
            'numberposts' => $num_event_show,
            'event-category' => is_array($category) ? implode(',',$category) : $category
        );

        $event_get_query = $event_query->query($arg);

        return $event_get_query;
    }
}
if( !function_exists('atn_mailpoet_shortcode_parse_gallery') ){
    //[custom:allteams_newsletter_gallery post_per_page:5 show_img_from_last:7]
    function atn_mailpoet_shortcode_parse_gallery($mailpoet_shortcode = ''){
        $atts = shortcode_parse_atts(strip_tags($mailpoet_shortcode));
        //print_r($atts);
        $arg = array();
        foreach($atts as $k => $v){
            $to_array = explode(':',$v);
            //print_r($to_array);
            foreach($to_array as $to_arrayk => $to_arrayv){
                if( $to_arrayv == 'posts_per_page' ){
                    $arg['posts_per_page'] = $to_array[1];
                }
                if( $to_arrayv == 'show_img_from_last' ){
                    $arg['date_query'] = rtrim($to_array[1],']').' days ago';
                }
            }
        }
        $gallery_posts = atn_get_galleries($arg['posts_per_page'], $arg['date_query']);
        return ATN_MailPoetTemplate::get_instance()->get('wp-template-envira-gallery.php', ['gallery_posts' => $gallery_posts]);
    }
}
if( !function_exists('atn_get_galleries') ){
    function atn_get_galleries($num_gallery_show = 5, $show_img_from_last_day = 7){
        $gallery_obj = new ATN_Model_DataEnviraGallery;
        $arg = array(
            'date_query' => $show_img_from_last_day,
            'posts_per_page' => $num_gallery_show
        );

        $gallery_get_query = $gallery_obj->query($arg);

        return $gallery_get_query;
    }
}
/*
* Allteams Issue Data
*/
if( !function_exists('atn_get_issues_cpt') ){
    function atn_get_issues_cpt(){
        return ACG_Issues_Get::get_instance()->posts();
    }
}
if( !function_exists('atn_mailpoet_shortcode_parse_issue_posts') ){
    function atn_mailpoet_shortcode_parse_issue_posts($mailpoet_shortcode = ''){
        if (defined('ACG_VERSION')) {
            $atts = shortcode_parse_atts(strip_tags($mailpoet_shortcode));
              
            $wp_posts = atn_get_issues_cpt();
            
            $data = [
                'wp_posts' => $wp_posts
            ];

            return ATN_MailPoetTemplate::get_instance()->get('wp-template-issue-posts.php', $data);
        }
    }
}