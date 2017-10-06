<div class="filter-events wrap">
	<h2>Upcoming Events</h2>
	<table class="form-table">
		<tbody>
			<tr>
				<th scope="row"><label for="">Maximum Number of events to show : </label></th>
				<td>
					<p>By leaving this field 0, no limit will be set</p>
					<input name="events[posts_per_page]" style="width:80%;" class="events_posts_per_page" value="5">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="">Show all events for days upcoming :</label></th>
				<td>
					 <input name="events[date_query]" style="width:80%;" class="events_date_query" value="7">
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="">Show Events by category :</label></th>
				<td>
					<select name="events[category][]" class="events_category" style="width:80%;" multiple>
						<?php foreach($categories as $k => $v) { ?>
								<option value="<?php echo $v->slug;?>"><?php echo $v->name;?></option>
						<?php } ?>
					</select>
				</td>
			</tr>
		</tbody>
	</table>
</div>
