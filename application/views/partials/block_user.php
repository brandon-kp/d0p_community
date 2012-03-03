<?php echo form_open('userprofile/blockuser_process');?>
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
				<label for="sub">Are you sure?::.</label>
			</p><p>
				<input type="submit" name="sub" value="Yeah, I'm sure" />
				<input type="hidden" name="id" value="<?php echo $userprofile['id'];?>" />
			</p>		
		</div>
		<div class="clear"></div>
	</div>
</div>
<?php echo form_close();?>