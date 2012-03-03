<div id="account_col">
	<h2 id="welcome_name"> Welcome, <?php echo $account_info['name'];?>!</h2>
	<div id="photo">
		<a href="<?php echo site_url('userprofile/index/'.$account_info['id']);?>">
			<img src="<?php echo $account_info['photo'];?>s.png" alt="User photo" />
		</a>
	</div>
	<div id="messages">
	<?php if($notifications['buddy_requests'] == TRUE): ?><a href="<?php echo site_url('/myaccount/managebuddies');?>">You have new buddy request(s)!</a><?php endif;?>
	<?php if($notifications['new_messages'] == TRUE): ?><a href="<?php echo site_url('/messages');?>">You have new private messages!</a><?php endif;?>
	</div>
	
	<div id="toolbar">
		<?php echo $template['partials']['toolbar'];?>
	</div>
</div>

<div id="updates_col">
	<?php foreach($account_updates as $update):?>
	<div class="update">
		<p class="info">
			.:: Posted By <a href="<?php echo site_url('userprofile/index/'.$update['poster']);?>"><?php echo $update['name'];?></a> on <?php echo $update['date'];?> ::.
		</p>
		<p class="text">
			<a href="<?php echo site_url('userprofile/index/'.$update['poster']);?>">
				<img src="<?php echo $update['photo'];?>" alt="User photo" />
			</a>
			<?php echo $update['text']; ?>
		</p>
	</div>
	<?php endforeach;?>
</div>