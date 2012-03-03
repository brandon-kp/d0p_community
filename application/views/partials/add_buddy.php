<?php echo form_open('userprofile/addbuddy_process');?>
<div id="add_buddy">
	<div class="buddy_box">
		<div class="user">
			<a href="<?php echo site_url('userprofile/index/~'.$userprofile['id']);?>"><?php echo $userprofile['name'];?>
			<br />
			<img src="<?php echo site_url().'/'.$userprofile['photo'];?>" alt="" />
			</a>
		</div>
		
		<div class="controls">
			<p>
				<label for="buddy_message">Include a message with yoru request::.</label>
			</p><p>
				<textarea name="buddy_message" maxlength="140"></textarea>
			</p><p>
				<input type="submit" name="sub" value="Send Request" />
				<input type="hidden" name="id" value="<?php echo $userprofile['id'];?>" />
			</p>		
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php echo form_close();?>