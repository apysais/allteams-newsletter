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
        //print_r($atts);
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
		//print_r($arg);
        $wp_posts = atn_get_posts($arg['posts_per_page'], $arg['date_query'], $arg['category']);

        $table = '<table cellpadding="0" cellspacing="0">';
            if( $wp_posts ){
                $posts = $wp_posts->posts;
                $posts_count = $wp_posts->post_count;
                foreach($posts as $key => $val){
                    $table .= '<tr>';
                        $table .= '<td class="pattern" width="600">';
                            $table .= '<table cellpadding="0" cellspacing="0">';
                                $table .= '<tr>';
                                    $table .= '<td valign="top" style="word-break:break-word;word-wrap:break-word;border-collapse:collapse;padding-bottom:20px;padding-right:20px">';
                                        $table .= '<h2 style="text-align:left;padding:0;font-style:normal;font-weight:normal;margin:0 0 7.2px;color:#222222;font-family:\'Trebuchet MS\',\'Lucida Grande\',\'Lucida Sans Unicode\',\'Lucida Sans\',Tahoma,sans-serif;font-size:24px;line-height:38.4px">'.$val->post_title.'</h2>';
                                    $table .= '</td>';
                                $table .= '</tr>';
                                $table .= '<tr>';
                                    $table .= '<td class="hero">';
                                        if ( has_post_thumbnail( $val->ID ) ) {
                                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $val->ID ), 'large' );
                                            if ( ! empty( $large_image_url[0] ) ) {
                                                $table .= '<img src="'.esc_url( $large_image_url[0] ).'" alt="" width="100%" style="display: block; border: 0;" />';
                                            }
                                        }
                                    $table .= '</td>';
                                $table .= '</tr>';
                                $table .= '<tr>';
                                    $table .= '<td align="left">';
                                        $table .= '<p></p>';
                                    $table .= '</td>';
                                $table .= '</tr>';
                                $table .= '<tr>';
                                    $table .= '<td align="left" style="word-break:break-word;word-wrap:break-word;text-align:left;border-collapse:collapse;color:#000000;font-family:Arial,\'Helvetica Neue\',Helvetica,sans-serif;font-size:16px;line-height:25.6px">';
                                        $table .= substr(strip_tags($val->post_content),0, 250) . '';
                                    $table .= '</td>';
                                $table .= '</tr>';
                                $table .= '<tr>';
                                    $table .= '<td align="center">';
                                        $table .= '<a href="'.esc_url( get_permalink($val->ID) ).'">Read More</a>';
                                    $table .= '</td>';
                                $table .= '</tr>';
                            $table .= '</table>';
                        $table .= '</td>';
                    $table .= '</tr>';
                    $table .= '<tr>';
                        $table .= '<td class="pattern" width="100%"><p></p></td>';
                    $table .= '</tr>';
                    $table .= '<tr>';
                        $table .= '<td class="pattern" width="100%"><hr style="border: 1px solid black;margin-bottom: 20px;"/></td>';
                    $table .= '</tr>';
                }

          } else {
            $table .= '<tr>';
                $table .= '<td align="left">';
                    $table .= '<h2>There are no Posts</h2>';
                $table .= '</td>';
            $table .= '</tr>';
          }

        $table .= '</table>';
        return $table;
    }
}
if( !function_exists('atn_mailpoet_shortcode_parse_events') ){
    //[custom:allteams_newsletter_events post_per_page:5 show_upcoming_days:7 category:'']
    function atn_mailpoet_shortcode_parse_events($mailpoet_shortcode = ''){
        $atts = shortcode_parse_atts(strip_tags($mailpoet_shortcode));
        //print_r($atts);
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
		//print_r($arg);
        $event_posts = atn_get_events($arg['numberposts'], $arg['event_start_before'], $arg['event-category']);
		//print_r($event_posts);
        $table = '<table cellpadding="0" cellspacing="0">';
            if( $event_posts ){
                $events = $event_posts;
                //$event_count = $event_posts->post_count;
                foreach($events as $key => $val){
                    $is_all_day = eo_is_all_day($val->ID);
                    $start_date = eo_get_the_start('l, j F, Y', $val->ID, $val->occurrence_id);
                    $start_time = eo_get_the_start('h:i A', $val->ID, $val->occurrence_id);
                    $end_date = eo_get_the_end('l, j F, Y', $val->ID, $val->occurrence_id);
                    $end_time = eo_get_the_end('h:i A', $val->ID, $val->occurrence_id);
                    $current_events_venue_id = eo_get_venue($val->ID);
                    $address_details = eo_get_venue_address($current_events_venue_id);
                    $event_address = '';
                    $event_city = '';
                    $event_state = '';
                    if( $current_events_venue_id ){
                        $event_address = $address_details['address'];
                        $event_city = $address_details['city'];
                        $event_state = $address_details['state'];
                    }

                    $table .= '<tr>';
                        $table .= '<td class="pattern" width="600">';
                            $table .= '<table cellpadding="0" cellspacing="0">';
                                $table .= '<tr>';
                                    $table .= '<td valign="top" style="word-break:break-word;word-wrap:break-word;border-collapse:collapse;padding-bottom:20px;padding-right:20px">';
                                        $table .= '<h2 style="text-align:left;padding:0;font-style:normal;font-weight:normal;margin:0 0 7.2px;color:#222222;font-family:\'Trebuchet MS\',\'Lucida Grande\',\'Lucida Sans Unicode\',\'Lucida Sans\',Tahoma,sans-serif;font-size:24px;line-height:38.4px">'.$val->post_title.'</h2>';
                                    $table .= '</td>';
                                $table .= '</tr>';
								$table .= '<tr>';
                                    $table .= '<td class="hero">';
                                        if ( has_post_thumbnail( $val->ID ) ) {
                                            $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $val->ID ), 'large' );
                                            if ( ! empty( $large_image_url[0] ) ) {
                                                $table .= '<img src="'.esc_url( $large_image_url[0] ).'" alt="" style="display: block; border: 0;" width="100%" />';
                                            }
                                        }
                                    $table .= '</td>';
                                $table .= '</tr>';
                                $table .= '<tr>';
                                    $table .= '<td align="left" style="word-break:break-word;word-wrap:break-word;text-align:left;border-collapse:collapse;color:#000000;font-family:Arial,\'Helvetica Neue\',Helvetica,sans-serif;font-size:16px;line-height:25.6px">';
                                        $table .= '<p>'.substr(strip_tags($val->post_content),0, 250).'</p>';
                                        if( $is_all_day == 1 ) {
											$table .= '<p>Date : '.$start_date.'</p>';
											$table .= '<p>Time : All Day</p>';
										} else {
											$table .= '<p>Date : '.$start_date.'</p>';
											$table .= '<p>Time : '.$start_time.' - '.$end_time.'</p>';
										}
                                        //$table .= '<p>Start Date : '.$start_date.'</p>';
                                        //$table .= '<p>End Date : '.$end_date.'</p>';
										if( trim($event_address) != '' ) {
											$table .= '<p>Location : '.$event_address.'</p>';
										}
                                    $table .= '</td>';
                                $table .= '</tr>';
                                $table .= '<tr>';
                                    $table .= '<td align="center">';
                                        $table .= '<a href="'.esc_url( get_permalink($val->ID) ).'">View this event</a>';
                                    $table .= '</td>';
                                $table .= '</tr>';
                            $table .= '</table>';
                        $table .= '</td>';
                    $table .= '</tr>';
                    $table .= '<tr>';
                        $table .= '<td class="pattern" width="600"><p></p></td>';
                    $table .= '</tr>';
                    $table .= '<tr>';
                        $table .= '<td class="pattern" width="100%"><hr style="border: 1px solid black;margin-bottom: 20px;"/></td>';
                    $table .= '</tr>';
                }//foeach posts
            } else {
              $table .= '<tr>';
                  $table .= '<td align="left">';
                      $table .= '<h2>There are no upcoming Events</h2>';
                  $table .= '</td>';
              $table .= '</tr>';
            }//if posts
        $table .= '</table>';
        return $table;
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
		//print_r($arg);
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

        $table = '<table cellpadding="0" cellspacing="0">';
            if( $gallery_posts ){
                foreach($gallery_posts as $key => $val){
                    $table .= '<tr>';
                        $table .= '<td>';
                            $table .= '<table cellpadding="0" cellspacing="0">';
                                $table .= '<tr>';
                                    $table .= '<td align="left" style="font-family: arial,sans-serif; color: #333;">';
                                        $table .= '<h2>'.$val['data']->post_title.'</h2>';
                                    $table .= '</td>';
                                $table .= '</tr>';
                                $table .= '<tr>';

                                    if(isset($val['images']) ){
                                        if( isset($val['images']['gallery']) ){
                                            foreach($val['images']['gallery'] as $k => $v){
                                                $table .= '<tr>';
                                                    $table .= '<td class="col" style="padding: 0 5px;">';
                                                        //$table .= '<table cellpadding="0" cellspacing="0">';
                                                            //$table .= '<tr>';
                                                                $table .= '<img src="'.$v['src'].'" alt="images" width="300" height="250" style="max-width: 100%;display: block; border: 0;margin-bottom:10px;" />';
                                                        //$table .= '</table>';
                                                    $table .= '</td>';
                                                $table .= '</tr>';
                                            }//foreach
                                        }//if( isset($val['images']['gallery']) )
                                    }//if(isset($val['images']) )

                                $table .= '</tr>';
                                $table .= '<tr>';
                                $table .= '<td >';
                                        $table .= '<a href="'.esc_url( get_permalink($val['data']->ID) ).'">View this Gallery</a>';
                                    $table .= '</td>';
                                $table .= '</tr>';
                                $table .= '<tr>';
                                    $table .= '<td class="pattern" width="600"><p></p></td>';
                                $table .= '</tr>';
                                $table .= '<tr>';
                                    $table .= '<td class="pattern" width="100%"><hr style="border: 1px solid black;margin-bottom: 20px;"/></td>';
                                $table .= '</tr>';
                            $table .= '</table>';
                        $table .= '</td>';
                    $table .= '</tr>';
                }//foeach posts
            }//if posts
        $table .= '</table>';
        return $table;
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
