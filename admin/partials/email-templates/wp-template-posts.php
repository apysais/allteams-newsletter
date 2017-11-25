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