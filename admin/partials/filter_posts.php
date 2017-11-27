<div class="filter-posts wrap">
	<h2>Latest Article</h2>
	<h4>Default Shortcode for mailpoet</h4>
	<code>[custom:allteams_newsletter_post posts_per_page:<span class="article_posts_per_page">5</span> show_article_from_last:<span class="article_show_article_from_last">5</span> category:<span class="article_category"></span>]</code>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="">Maximum Number of articles to show : </label></th>
				<td>
					<p>By leaving this field 0, no limit will be set</p>
					<input name="wp[posts_per_page]" style="width:80%;" class="wp_posts_per_page" value="<?php echo isset($input['posts_per_page']) ? $input['posts_per_page']: '5';?>">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="">Show article from the last :</label></th>
				<td>
					 <input name="wp[last_date_query]" style="width:80%;" class="wp_last_date_query" value="<?php echo isset($input['last_date_query']) ? $input['last_date_query']: '7';?>"> days
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="">Show article by category :</label></th>
				<td>
					<select name="wp[category][]" class="wp_category" style="width:80%;" multiple>
						<?php foreach($categories as $k => $v) { ?>
								<?php $selected = ''; ?>
								<?php if( in_array($v->term_id, $input['category']) ){ ?>
										<?php $selected = 'selected'; ?>
								<?php } ?>
								<option value="<?php echo $v->term_id;?>" <?php echo $selected;?>><?php echo $v->name;?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
	<code>[custom:allteams_newsletter_post posts_per_page:<span class="article_posts_per_page">5</span> show_article_from_last:<span class="article_show_article_from_last">5</span> category:<span class="article_category"></span>]</code>
</div>
