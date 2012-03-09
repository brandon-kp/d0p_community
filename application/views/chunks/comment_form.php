<?php echo form_open();?>
<div class="commentForm">
	<p><textarea name="text" id="formMessage"></textarea></p>
	<p><input type="submit" name="submit_comment" value="Post Comment" /></p>
	<input type="hidden" name="to" value="<?php echo $to;?>"/>
</div>
<?php echo form_close();?>