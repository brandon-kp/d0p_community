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
	<p><?php echo $account_info['tokens'];?> Tokens</p>
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
		<span class="heading">My Buddies' Newest Layouts</span>
		<ul>
			<?php foreach($newest_layouts as $new_layout):?>
			<li>
				<a href="<?php echo site_url('layouts/review/'.$new_layout['id']);?>">
					<?php echo $new_layout['title'];?><br />
					<img src="http://i.imgur.com/<?php echo $new_layout['preview_image'];?>.png" alt="" />
				</a>
			</li>
			<?php endforeach;?>
		</ul>
	</div>
	
	<div id="birthdays">
		<span class="heading">Today's Birthdays</span>
		<div>
			<?php if(count($birthdays)>0):foreach($birthdays as $birthday):?>
			<a class="bday" href="<?php echo site_url('~'.$birthday['id']);?>"><?php echo $birthday['name'];?></a>
			<?php endforeach; else:?>
			No birthdays today.<br /> <a href="http://wolframalpha.com">What are the odds?</a>
			<?php endif;?>
		</div>
	</div>	
</div>

<!--  -->