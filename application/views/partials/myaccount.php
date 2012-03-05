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
	<?php if($notifications['new_comments'] == TRUE): ?><a href="<?php echo site_url('/userprofile/allcomments');?>">You have new profile comments!</a><?php endif;?>
	</div>
	
	<div id="toolbar">
		<?php echo $template['partials']['toolbar'];?>
	</div>
</div>

<div id="tokens">
	<strong>Tokens</strong>
	<p>Coming soon...</p>
</div>

<div id="rightcol">
	<div id="updates_col">
		<?php foreach($account_updates as $update):?>
		<div class="update">
			<p class="info">
				<strong>NEWS FLASH</strong> .^. Posted By <a href="<?php echo site_url('userprofile/index/'.$update['poster']);?>"><?php echo $update['name'];?></a> on <?php echo $update['date'];?> .^.
			</p>
			<p class="text">
				<a href="<?php echo site_url('userprofile/index/'.$update['poster']);?>">
					<img src="<?php echo $update['photo'];?>" alt="User photo" />
				</a>
				<?php echo $update['text']; ?>
			</p>
			<div class="clear"></div>
		</div>
		<?php endforeach;?>
	</div>
	
	<div id="new_layouts">
		<span class="heading">My Buddie's newest Layouts</span>
		<div>
			<a href="#">
				Layout Title<br />
				<img src="http://192.168.0.13/community/index.php/images/index/6KCIdss.png" alt="" />
			</a>
		</div>
	</div>
	
	<div id="birthdays">
		<span class="heading">Today's Birthdays</span>
		<div>
			<a href="#">Mr. Evil</a>
			<a href="#">Mr. Evil</a>
			<a href="#">Mr. Evil</a>
			<a href="#">Mr. Evil</a>
		</div>
	</div>	
</div>

<!--  -->