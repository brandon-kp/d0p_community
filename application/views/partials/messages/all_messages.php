<div id="privatemessages">
	<?php include 'sidepanel.php';?>
	
	<div id="messages_col">
	<?php foreach($messages as $message):?>
	
	<div class="message <?php if($message['status'] == '1'): echo "read"; endif;?>">
		<a class="sender" href="<?php echo site_url('userprofile/index/'.$message['from']);?>"><img class="user_thumb" src="<?php echo site_url($message['photo']);?>" alt="Users Picture" style="max-width:40px;" /> <?php echo $message['name'];?></a>
		<a class="subject" href="<?php echo site_url('messages/read/'.$message['hash']);?>"><?php echo $message['subject'];?></a>
		<span class="time"><?php echo timespan($message['date'], now());?> Ago</span>
	</div>
	
	<?php endforeach;?>
	</div>
</div>