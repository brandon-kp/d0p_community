<div class="mainForum">
	<?php foreach($categories as $cat):?>
	<div class="cats NewPostCat">
		<b><a href="<?php echo site_url('forum/category/'.$cat['id']);?>"><?php echo $cat['title'];?></a></b>
		<br />
		<span class="catSmallDesc"><?php echo $cat['description'];?></span>
		<br />
		<span class="smallText">Last Comment By: <a href="<?php echo site_url('~'.$cat['last_comment']);?>"><?php echo $cat['username'];?></a> 
		&nbsp;&nbsp;<?php echo timespan($cat['last_comment_date'],time());?> ago</span>
		<br />
	</div>
	<?php endforeach;?>
</div>