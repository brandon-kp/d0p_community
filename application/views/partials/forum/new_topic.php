<div id="breadcrumb">
	<a href="<?php echo site_url('forum');?>">Forum</a> <span>&#187;</span>
	<a href="<?php echo site_url('forum/category/'.$cat_info['id']);?>"><?php echo $cat_info['title'];?></a> <span>&#187;</span>
	<strong>New Topic</strong>
</div>
<div id="ForumReply">
	<?php echo form_open();?>
	<div class="labels">
		<label for="title">Topic Title::.</label><br /><br />
		<label for="text">Topic Text::.</label>
	</div>
	<div class="fields">
		<input type="text" name="title" value="" /><br />
		<textarea name="text"></textarea>
		<input type="submit" name="submit" value="Create Topic" />
	</div>
	<?php echo form_close();?>
</div>

<style>
.labels{float:left;}
.fields{float:right;}
</style>