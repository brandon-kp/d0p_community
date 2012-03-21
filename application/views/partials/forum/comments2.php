<div id="forum">
<div id="breadcrumb">
	<a href="<?php echo site_url('forum');?>">Forum</a> <span>&#187;</span>
	<a href="<?php echo site_url('forum/category/'.$cat_info['id']);?>"><?php echo $cat_info['title'];?></a> <span>&#187;</span>
	<strong><?php echo $coms[0]['title'];?></strong>
</div>

<?php foreach($coms as $com):?>
<div class="ForumComs">
	<div class="LeftSide">
		<a href="<?php echo site_url('~'.$com['poster']);?>">
			<?php echo $com['name'];?><br />
			<img style="width:100px;" src="<?php echo site_url($com['photo']);?>" alt="User Picture.." /><br />
		</a>
		<?php echo substr(age($com['birthday'], time()),0,2);?>/<?php echo substr($com['gender'],0,1);?>
	</div>
	<div class="message">
		<p class="TimeStamp">Posted at <?php echo date('m/d/y, g:ia', $com['date']);?></p>
		<p class="commentBody"><?php echo $com['text'].$com['id'];?></p>
		<p class="Signature"><?php echo $com['signature'];?></p>
	</div>
</div>
<?php endforeach;?>

<div class="clear"></div>
<div class="browse"></div>
<div class="clear"></div>

<div id="ReplyComms">
	<?php echo $reply;?>
</div>
</div>