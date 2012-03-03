<div id="konny">	
	<div id="GoodiePopBox"></div>
	<div class="proHead"><?php echo $profiledata['name'];?></div>
	<div class="proPic">
		<a href="<?php echo site_url('usergallery/index/'.$profiledata['id']);?>">
			<img src="<?php echo site_url($profiledata['photo']);?>" alt="Users Picture" style="max-width:130px;" />
		</a>
		<br />
		<a href="<?php echo site_url('usergallery/index/'.$profiledata['id']);?>">View Gallery (<?php echo $profiledata['gallery_count'];?>)</a>  
	</div>
	<?php include 'userprofile/proinfotable.php';?>
	<div class="contactTable" id="ContactTable">
	</div>
	<div class="proQuote clear"><?php echo $profiledata['signature'];?></div>
	
	<div id="ProfileContents">
		<div class="proProfile">
			<div class="extraTableSide">
				<p class="extraTableTitle TitleSide">Contact</p>
				<ul>
					<li><a href="<?php echo site_url('userprofile/addbuddy/'.$profiledata['id']);?>">Add Buddy</a></li>
					<li><a href="<?php echo site_url('messages/send/'.$profiledata['id']);?>">Message Buddy</a></li>
					<li><a href="<?php echo site_url('userprofile/blockuser/'.$profiledata['id']);?>">Block User</a></li>
				</ul>
				<p class="extraTableTitle TitleSide"><?php echo $profiledata['side_title'];?></p>
				<?php echo $profiledata['side_table'];?>
		  	</div>
		</div>
		
		<div class="ProContents">
			<div id="mainContents">
				<?php echo $profiledata['main_table'];?>
			</div>
			<div class="extraTable1">
				<p class="ExtraTableTitle"><?php echo $profiledata['extra_title1'];?></p>
		  		<?php echo $profiledata['extra_table1'];?>
		  	</div>
		  	<div class="extraTable2">
				<p class="ExtraTableTitle"><?php echo $profiledata['extra_title2'];?></p>
	  			<?php echo $profiledata['extra_table2'];?>				
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<!--<p class="MLine clear">
		John's 5 Newest Layouts 
		<a href="http://web.archive.org/web/20081017171839/http://www.skem9.com/layouts/usersLayouts.php?user=1">Browse all of John's Layouts</a>
	</p>
	<div class="top5Layouts">
		<a href="http://web.archive.org/web/20081017171839/http://www.skem9.com/layouts/reviews.php?layout=217600">pastel sexxy bitch<br />
			<img style="width:150px;" src="http://web.archive.org/web/20081017171839im_/http://www.skem9.com/a.homes/pics/layouts/layoutPics/th_/2008/04/28/1/481559f7c3af8_1.jpg" alt="Preview" />
		</a>
		<br />
	</div>
	<div class="top5Layouts">
		<a href="http://web.archive.org/web/20081017171839/http://www.skem9.com/layouts/reviews.php?layout=217600">pastel sexxy bitch<br />
			<img style="width:150px;" src="http://web.archive.org/web/20081017171839im_/http://www.skem9.com/a.homes/pics/layouts/layoutPics/th_/2008/04/28/1/481559f7c3af8_1.jpg" alt="Preview" />
		</a>
		<br />
	</div>
	<div class="top5Layouts">
		<a href="http://web.archive.org/web/20081017171839/http://www.skem9.com/layouts/reviews.php?layout=217600">pastel sexxy bitch<br />
			<img style="width:150px;" src="http://web.archive.org/web/20081017171839im_/http://www.skem9.com/a.homes/pics/layouts/layoutPics/th_/2008/04/28/1/481559f7c3af8_1.jpg" alt="Preview" />
		</a>
		<br />
	</div>
	<div class="top5Layouts">
		<a href="http://web.archive.org/web/20081017171839/http://www.skem9.com/layouts/reviews.php?layout=217600">pastel sexxy bitch<br />
			<img style="width:150px;" src="http://web.archive.org/web/20081017171839im_/http://www.skem9.com/a.homes/pics/layouts/layoutPics/th_/2008/04/28/1/481559f7c3af8_1.jpg" alt="Preview" />
		</a>
		<br />
	</div>
	<div class="top5Layouts">
		<a href="http://web.archive.org/web/20081017171839/http://www.skem9.com/layouts/reviews.php?layout=217600">pastel sexxy bitch<br />
			<img style="width:150px;" src="http://web.archive.org/web/20081017171839im_/http://www.skem9.com/a.homes/pics/layouts/layoutPics/th_/2008/04/28/1/481559f7c3af8_1.jpg" alt="Preview" />
		</a>
		<br />
	</div>-->
	<div class="clear"></div>
	
	<div class="UProSide">
		<p class="MLine"><b><?php echo $profiledata['name'];?> Has <?php echo count($buddies);?> Buddies</b></p>
		<ul id="Friends">
		<?php foreach($buddies as $buddy):?>
				<li><a href="<?php echo site_url('userprofile/index/~'.$buddy['id']);?>"><?php echo $buddy['name'];?><br /><img width="90" src="<?php echo site_url($buddy['photo']);?>s.png" alt="friends Pic" /></a></li>
		<?php endforeach;?>
		</ul>
		<div class="clear"></div>
		<p class="browse">
			<a href="http://web.archive.org/web/20081017171839/http://www.skem9.com/myFriends.php?u=1">View All Buddies</a>
		</p>
	</div>
	<div class="Comments">
		<p class="MLine"><b><?php echo $profiledata['name'];?> Has <?php echo count($comments);?> Comment(s)</b></p>
		<?php foreach($comments as $comment):?>
		<div class="commentsPeps">
			<span class="comName">&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('userprofile/~'.$comment['from']);?>"><?php echo $comment['name'];?></a> ~ <?php echo date("D M d, Y g:ia", $comment['date']);?></span>
			<div class="comImg"><a href="<?php echo site_url('userprofile/~'.$comment['from']);?>"><img src="<?php echo site_url($comment['photo']);?>" alt="Picture.." /></a></div>
			<div class="commentMess"><?php echo $comment['text']; ?></div>
			<div class="clear"></div>
		</div>		
		<?php endforeach;?>
		<p class="browse">
			<a class="pdot" href="<?php echo site_url('userprofile/allcomments/'.$profiledata['id']);?>">View / Edit Comments</a>
		</p>
		<?php if($profiledata['id'] == $userprofile['id']):?>
		<p class="MLine">You can't comment on yourself, you egomaniac.</p>
		<?php elseif($profiledata['show_form'] == true):?>
			<?php echo form_open('userprofile/comments_process');?>
				<div class="commentForm">
					<p><textarea name="text" id="formMessage"></textarea></p>
					<p><input type="submit" name="submit" value="Post Comment" /></p>
					<input type="hidden" name="to" value="<?php echo $profiledata['id'];?>"/>
				</div>
			<?php echo form_close();?>
		<?php else:?>
			<p class="MLine">You have to be logged in to leave a comment!</p>
		<?php endif;?>
		<p class="centered"></p>
	</div>
	
	<div class="clear"></div>
</div>
