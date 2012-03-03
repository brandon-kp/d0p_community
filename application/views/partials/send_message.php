<?php echo form_open('messages/sendmessage_process');?>
<div id="sendmessage">
	<div class="userbox">
		<a href="<?php echo site_url('userprofile/index/'.$userbox['id']);?>"><img class="user_thumb" src="<?php echo site_url($userbox['photo']);?>" alt="Users Picture" style="max-width:140px;" /> <?php echo $userbox['name'];?></a>
	</div>
	<div class="form">
		<p><label for="subject">Subject::.</label> <input type="text" name="subject" value="" /></p>
		<p><label for="message">Message::.</label> <textarea name="message"></textarea></p>
		<p><input type="submit" name="sub" value="Send Message" /></p>
		<input type="hidden" name="to" value="<?php echo $userbox['id']; ?>" />
	</div>
</div>
<?php echo form_close();?>