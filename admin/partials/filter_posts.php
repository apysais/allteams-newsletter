<div class="filter-posts wrap">
	<h2>Latest Article</h2>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="">Maximum Number of articles to show : </label></th>
				<td>
					<p>By leaving this field 0, no limit will be set</p>
					<input name="wp[posts_per_page]" style="width:80%;" class="wp_posts_per_page" value="5">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="">Show article from the last :</label></th>
				<td>
					 <input name="wp[last_date_query]" style="width:80%;" class="wp_last_date_query" value="7"> days
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="">Show article by category :</label></th>
				<td>
					<select name="wp[category][]" class="wp_category" style="width:80%;" multiple>
						<?php foreach($categories as $k => $v) { ?>
								<option value="<?php echo $v->term_id;?>"><?php echo $v->name;?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
</div>
