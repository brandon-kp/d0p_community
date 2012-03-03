<?php echo form_open('messages/reply_process', array('id'=>'reply_form'));?>
<div id="readmessage">
	<input type="button" value="Reply" id="open_reply" />
	<div id="sendmessage" style="width:600px">
		<p><label for="subject">Subject::.</label> <input type="text" name="subject" value="Re: <?php echo $message['subject']; ?>" /></p>
		<p><label for="message">Message::.</label> <textarea onkeyup='this.rows = (this.value.split("\n").length||1);' name="message" style="width:550px"><?php echo "\r\n\r\n\r\n\r\n\r\n\r\n";?>
--------------BEGIN MESSAGE----------------
---From: <?php echo $message['from']."\r\n"; ?>
---To:   <?php echo $message['to']."\r\n"; ?>
---Date: <?php echo $message['date']."\r\n";?>
---Text: <?php echo $message['text']."\r\n"; ?>
--------------END MESSAGE----------------		
		</textarea></p>
		<p id="replyp"><input type="submit" id="send_reply" name="sub" value="Send Message" /></p>
		<input type="hidden" name="to" value="<?php echo $message['from']; ?>" />
		<input type="hidden" name="hash" value="<?php echo $message['hash']; ?>" />
	</div><div class="clear"></div>
	<div id="userthumb"><a class="sender" href="<?php echo site_url('userprofile/index/'.$message['from']);?>"><img class="user_thumb" src="<?php echo site_url($message['photo']);?>" alt="Users Picture" style="max-width:150px;" /> <?php echo $message['name'];?></a></div>
	<p><?php echo str_replace("\n",'<br />',$message['text']);?></p>
</div>
<?php echo form_close();?>

<script type="text/javascript">
$('#open_reply').click(function(){
	$('#sendmessage').slideDown("slow");
	$(this).hide();
});

$('#send_reply').click(function(){
	$('#replyp').prepend('<img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" alt="Loading..." id="loading_img" />');
	var data = $('#reply_form').serialize();

	$.ajax({
		  type: 'POST',
		  url: "<?php echo site_url('messages/reply_process');?>",
		  data: data
		}).done(function( response ) {
			$('#sendmessage')
				.slideUp('slow',function(){
					$(this).html('<p class="success">Your messages was sent!</p>');
				})
				.slideDown('slow');
		});
	return false;
});
</script>