<div id="atn-wrapper" class="newsletter-wrap wrap">
	<h1><?php echo $heading;?></h1>
	<div>
		<h2 class="nav-tab-wrapper wp-clearfix">
			<a href="#" class="nav-tab nav-tab-active">General</a>
			<!--<a href="#" class="nav-tab">#</a>
			<a href="#" class="nav-tab">#</a>
			<a href="#" class="nav-tab">#</a>-->
		</h2>
	</div>
	<div class="feature-section one-col">
		<p class="lead-description">Some description here</p>
	</div>
	<form name="filter-posts-form" method="post" action="<?php echo $action;?>">
		<input type="hidden" name="_method" value="<?php echo $method;?>">
		<?php ATN_View::get_instance()->admin_partials('partials/filter_posts.php', $posts); ?>
		<?php ATN_View::get_instance()->admin_partials('partials/filter_events.php', $events); ?>
		<?php ATN_View::get_instance()->admin_partials('partials/filter_galleries.php', $gallery); ?>
		<p class="submit"><input type="submit" name="query" id="query" class="button button-primary" value="Preview"></p>
		<p class="submit"><input type="submit" name="send-mail" id="send-mail" class="button button-primary" value="Send Mail"></p>
	</form>
</div>
