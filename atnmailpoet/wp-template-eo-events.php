<table cellpadding="0" cellspacing="0">
    <?php if( $event_posts ){
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
            } ?>

            <tr>
                <td class="pattern" width="600">
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td valign="top" style="word-break:break-word;word-wrap:break-word;border-collapse:collapse;padding-bottom:20px;padding-right:20px">
                                <h2 style="text-align:left;padding:0;font-style:normal;font-weight:normal;margin:0 0 7.2px;color:#222222;font-family:\'Trebuchet MS\',\'Lucida Grande\',\'Lucida Sans Unicode\',\'Lucida Sans\',Tahoma,sans-serif;font-size:24px;line-height:38.4px"><?php echo $val->post_title;?></h2>
                            </td>
                        </tr>
                        <tr>
                            <td class="hero">
                                <?php if ( has_post_thumbnail( $val->ID ) ) {
                                    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $val->ID ), 'large' );
                                    if ( ! empty( $large_image_url[0] ) ) {
                                        ?><img src="<?php echo esc_url( $large_image_url[0] );?>" alt="" style="display: block; border: 0;" width="100%" /><?php
                                    }
                                } ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="left" style="word-break:break-word;word-wrap:break-word;text-align:left;border-collapse:collapse;color:#000000;font-family:Arial,\'Helvetica Neue\',Helvetica,sans-serif;font-size:16px;line-height:25.6px">
                                <p><?php echo substr(strip_tags($val->post_content),0, 250);?></p>
                                <?php if( $is_all_day == 1 ) { ?>
                                    <p>Date : <?php echo $start_date;?></p>
                                    <p>Time : All Day</p>
                                <?php } else { ?>
                                    <p>Date : <?php echo $start_date;?></p>
                                    <p>Time : <?php echo $start_time.' - '.$end_time;?></p>
                                <?php } ?>
                                <?php if( trim($event_address) != '' ) { ?>
                                    <p>Location : <?php echo $event_address;?></p>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <a href="<?php echo esc_url( get_permalink($val->ID) );?>">View this event</a>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="pattern" width="600"><p></p></td>
            </tr>
            <tr>
                <td class="pattern" width="100%"><hr style="border: 1px solid black;margin-bottom: 20px;"/></td>
            </tr>
        <?php }//foeach posts ?>
    <?php } else { ?>
        <tr>
            <td align="left">
                <h2>There are no upcoming Events</h2>
            </td>
        </tr>
    <?php }//if posts ?>
</table>