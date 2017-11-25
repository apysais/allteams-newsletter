<!DOCTYPE html>
<html>
<head>
<style>
	/* Shrink Wrap Layout Pattern CSS */
	@media only screen and (max-width: 599px) {
        td[class="hero"] img {
            width: 100%;
            height: auto !important;
        }
	    td[class="pattern"] td{
	        width: 100%;
	    }
	}
	/* List with Thumbnails Pattern CSS */
	@media only screen and (max-width: 599px) {
        td[class="pattern"] img {
            width: 100%;
            height: auto !important;
        }
        td[class="pattern"] .col {
            width: 25%;
        }
	}
    @media only screen and (max-width: 430px) {
        td[class="pattern"] .col {
            width: 50%;
            float: left;
            margin-bottom: 20px;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }
        td[class="pattern"] .col table,
        td[class="pattern"] .col img { width: 100%; }
    }
    @media only screen and (max-width: 380px) {
        td[class="pattern"] .col {
            width: 100%;
            display: block;
            float: none;
            padding: 0 !important;
        }
        td[class="pattern"] .col tr {
            display: table-cell;
            width: 60%;
        }
        td[class="pattern"] .col tr:first-child {
            width: 40%;
            padding-right: 20px;
        }
        td[class="pattern"] .col td {
            font-size: 16px !important;
        }
    }
</style>
</head>
<body>
<h1>Latest Article</h1>
<h4>Shortcode for mailpoet</h4>
<code>[custom:allteams_newsletter_post posts_per_page:<?php echo $wp_post_per_page;?> show_article_from_last:<?php echo $wp_last_date_query;?> category:<?php echo $wp_category;?>]</code>
<table cellpadding="0" cellspacing="0">
    <?php if( $posts ){ ?>
		<?php foreach($posts as $key => $val){ ?>
			<tr>
				<td class="pattern" width="600">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td class="hero">
								<?php if ( has_post_thumbnail( $val->ID ) ) { ?>
									<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $val->ID ), 'medium' ); ?>
									<?php if ( ! empty( $large_image_url[0] ) ) { ?>
										<img src="<?php echo esc_url( $large_image_url[0] );?>" alt="" style="display: block; border: 0;" />
									<?php } ?>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="left" style="font-family: arial,sans-serif; color: #333;">
								<h3><?php echo $val->post_title;?></h3>
							</td>
						</tr>
						<tr>
							<td align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #666; padding-bottom: 20px;">
								<?php echo substr(strip_tags($val->post_content),0, 250);?>...	
							</td>
						</tr>
						<tr>
							<td align="left">
								<a href="<?php echo esc_url( get_permalink($val->ID) ); ?>">View this article</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="pattern" width="600"><p></p></td>
			</tr>
		<?php }//foeach posts ?>
	<?php }//if posts ?>
</table>

<hr>

<h1>Upcoming Events</h1>
<h4>Shortcode for mailpoet</h4>
<code>[custom:allteams_newsletter_events posts_per_page:<?php echo $events_post_per_page;?> show_upcoming_days:<?php echo $events_show_upcoming_days;?> category:<?php echo $events_category;?>]</code>
<table cellpadding="0" cellspacing="0">
    <?php if( $events ){ ?>
		<?php foreach($events as $key => $val){ ?>
			<?php
			$start_date = eo_get_the_start('l j F y', $val->ID, $val->occurrence_id);
			$end_date = eo_get_the_end('l j F y', $val->ID, $val->occurrence_id);
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
			?>
			<tr>
				<td class="pattern" width="600">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td class="hero">
								<?php if ( has_post_thumbnail( $val->ID ) ) { ?>
									<?php $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $val->ID ), 'medium' ); ?>
									<?php if ( ! empty( $large_image_url[0] ) ) { ?>
										<img src="<?php echo esc_url( $large_image_url[0] );?>" alt="" style="display: block; border: 0;" />
									<?php } ?>
								<?php } ?>
							</td>
						</tr>
						<tr>
							<td align="left" style="font-family: arial,sans-serif; color: #333;">
								<h3><?php echo $val->post_title;?></h3>
							</td>
						</tr>
						<tr>
							<td align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #666; padding-bottom: 20px;">
								<p><?php echo substr(strip_tags($val->post_content),0, 250);?>...</p>
								<p>Start Date : <?php echo $start_date;?></p>
								<p>End Date : <?php echo $end_date;?></p>
								<p>Location : <?php echo $event_address;?></p>
							</td>
						</tr>
						<tr>
							<td align="left">
								<a href="<?php echo esc_url( get_permalink($val->ID) ); ?>">View this event</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="pattern" width="600"><p></p></td>
			</tr>
		<?php }//foeach posts ?>
	<?php }//if posts ?>
</table>

<hr>

<h1>Latest Gallery</h1>

<table cellpadding="0" cellspacing="0">
    <?php if( $galleries ){ ?>
		<?php foreach($galleries as $key => $val){ ?>
			<tr>
				<td class="pattern" width="600">
					<table cellpadding="0" cellspacing="0">
						<tr>
							<td align="left" style="font-family: arial,sans-serif; color: #333;">
								<h3><?php echo $val['data']->post_title;?></h3>
							</td>
						</tr>
						<tr>
							<td align="left" style="font-family: arial,sans-serif; font-size: 14px; line-height: 20px !important; color: #666; padding-bottom: 20px;">
								
								<table cellpadding="0" cellspacing="0">
									<tr>
										<td class="pattern" width="600">
											<table cellpadding="0" cellspacing="0">
												<tr>
													<?php if(isset($val['images']) ){ ?>
														<?php if( isset($val['images']['gallery']) ){ ?>
																<?php foreach($val['images']['gallery'] as $k => $v){ ?>
																		<td class="col" width="140" style="padding: 0 5px;">
																			<table cellpadding="0" cellspacing="0">
																				<tr>
																					<td align="left"><img src="<?php echo $v['src'];?>" width="140" alt="images" style="display: block; border: 0;" /></td>
																				</tr>
																				<tr>
																					<td align="left" style="font-family: arial,sans-serif; font-size: 14px; color: #333; padding-top: 10px;">
																						<strong><?php echo $v['title'];?></strong><br />
																						<?php echo $v['caption'];?>
																					</td>
																				</tr>
																			</table>
																		</td>
																<?php } ?>
														<?php } ?>
													<?php } ?>
												</tr>
											</table>
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<tr>
							<td align="left">
								<a href="<?php echo esc_url( get_permalink($val['data']->ID) ); ?>">View this Gallery</a>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td class="pattern" width="600"><p></p></td>
			</tr>
		<?php }//foeach posts ?>
	<?php }//if posts ?>
</table>
</body>
</html>