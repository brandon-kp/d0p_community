<div id="account_col">
	<div id="toolbar">
		<?php echo $template['partials']['toolbar'];?>
	</div>
</div>

<div id="gallery">
	<?php echo form_open_multipart('myaccount/uploadphotos_process');?>
	<div id="upload_photo">
		<p><input type="file" name="userfile" /></p>
		<p><input type="submit" name="submit" value="Done" /></p>
	</div>
	<?php echo form_close();?>
	
	<?php echo form_open('myaccount/updatephotos_process');?>
	<?php foreach($userphotos as $photo):?>
		<div class="photo">
			<img style="max-width:150px; max-height:80px;" src="<?php echo site_url('images/index/'.$photo['hash']);?>s" alt="" /><br />
			<span class="caption" id="<?php echo $photo['hash'];?>">
				<?php if($photo['caption']==''):?><em>Click here to update caption</em>
				<?php else: echo '<em>'.$photo['caption'].'</em>'; endif;?>
			</span><br />
			<span class="options">
				<label for="delete">Delete this Photo</label><input type="checkbox" name="delete[]" value="<?php echo $photo['hash'];?>" /> |
				<label for="default">Set as Default</label><input type="radio" name="default" value="<?php echo $photo['hash'];?>" />
			</span>
		</div>
	<?php endforeach;?>
		<div class="clear"></div>
		<input type="submit" value="Go" />
	<?php form_close();?>
</div>

<script>
$('.caption em').click(function(){
	var name = $(this).attr('id');
	$(this).parent().html('<input type="text" name="captions[]" value="" placeholder="Click here to update caption" />');
});
</script>