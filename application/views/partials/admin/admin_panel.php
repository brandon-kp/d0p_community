<div id="content" class="container_16 clearfix">
	<div class="box">
		<h2>Pending Layouts</h2>
		<div class="utils">
			<a href="<?php echo site_url('admin/pendinglayouts');?>">View All</a>
		</div>
		<ul>
			<?php foreach($pending_layouts as $layout):?>
			<li>
				<a href="<?php echo site_url('layouts/preview/'.$layout['id']);?>"><?php echo $layout['title'];?></a>
				<span class="control">
					<a href="<?php echo site_url('admin/layouts/action/approve/id/'.$layout['id']);?>">[A]</a>
					<a href="<?php echo site_url('admin/layouts/action/deny/id/'.$layout['id']);?>">[D]</a>
				</span>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	
	<div class="box">
		<h2>Pending Tutorials</h2>
		<div class="utils">
			<a href="<?php echo site_url('tutorials/pendingtutorials');?>">View All</a>
		</div>
		<ul>
			<?php foreach($pending_tutorials as $tutorial):?>
			<li>
				<a href="<?php echo site_url('tutorials/preview/'.$tutorial['id']);?>"><?php echo $tutorial['title'];?></a>
				<span class="control">
					<a href="<?php echo site_url('admin/tutorials/action/approve/id/'.$tutorial['id']);?>">[A]</a>
					<a href="<?php echo site_url('admin/tutorials/action/deny/id/'.$tutorial['id']);?>">[D]</a>
				</span>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	
	<div class="box">
		<h2>User Content Stats</h2>
		<div class="tablecell"><strong><?php echo $stats['layouts'];?></strong> Layouts</div>
		<div class="tablecell"><strong><?php echo $stats['tutorials'];?></strong> Tutorials</div>
		<div class="tablecell"><strong><?php echo $stats['forum_topics'];?></strong> Forum Topics</div>
		<div class="tablecell"><strong><?php echo $stats['forum_comments'];?></strong> Forum Comments</div>
		<div class="tablecell"><strong><?php echo $stats['profile_comments'];?></strong> Profile Comments</div>
		<div class="tablecell"><strong><?php echo $stats['user_photos'];?></strong> User Photos</div>
	</div>
	
	<div class="box">
		<h2>System Stats</h2>
		<div class="tablecell"><strong><?php echo $stats['layout_categories'];?></strong> Layout Categories</div>
		<div class="tablecell"><strong><?php echo $stats['layout_types'];?></strong> Layout Types</div>
		<div class="tablecell"><strong><?php echo $stats['tutorial_categories'];?></strong> Tutorial Categories</div>
		<div class="tablecell"><strong><?php echo $stats['tutorial_subcategories'];?></strong> Tutorial Subcategories</div>
		<div class="tablecell"><strong><?php echo $stats['forum_categories'];?></strong> Forum Categories</div>
	</div>
</div>


<script>
$('.control a').click(function(){
	var url     = $(this).attr('href');
	var element = $(this).closest('li');
	$.ajax({
		  type: 'POST',
		  url: url
		}).done(function( response ) {
			$(element).fadeOut(500);
		});
	return false;	
});
</script>