<div class="filter-posts wrap">
	<h2>Latest Image</h2>
	<h4>Default Shortcode for mailpoet</h4>
	<code>[custom:allteams_newsletter_gallery post_per_page:<span class="span_gallery_posts_per_page">5</span> show_img_from_last:<span class="span_gallery_show_img_from_last">7</span> ]</code>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="">Maximum Number of galleries to show : </label></th>
				<td>
					<p>By leaving this field 0, no limit will be set</p>
					<input name="gallery[posts_per_page]" style="width:80%;" class="gallery_posts_per_page" value="<?php echo isset($input['posts_per_page']) ? $input['posts_per_page']: '5';?>">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="">Show Images from the last :</label></th>
				<td>
					 <input name="gallery[last_date_query]" style="width:80%;" class="gallery_last_date_query" value="<?php echo isset($input['last_date_query']) ? $input['last_date_query']: '7';?>"> days
				</td>
			</tr>
		</tbody>
	</table>
	<code>[custom:allteams_newsletter_gallery post_per_page:<span class="span_gallery_posts_per_page">5</span> show_img_from_last:<span class="span_gallery_show_img_from_last">7</span> ]</code>
</div>
