<?php foreach($coms as $comment):?>

<div class="commentsPeps">
	<span class="comName">&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('/~'.$comment['from']);?>"><?php echo $comment['name'];?></a> ~ <?php echo date("D M d, Y g:ia", $comment['date']);?></span>
	<div class="comImg"><a href="<?php echo site_url('~'.$comment['from']);?>"><img src="<?php echo site_url($comment['photo']);?>" alt="Picture.." /></a></div>
	<div class="commentMess"><?php echo $comment['text']; ?></div>
	<div class="clear"></div>
	<?php if($comment['from'] === $this->session->userdata('id')):?>
	<!-- I need to let users delete their stuff at some point. -->
	<?php endif;?>
</div>
<?php 
endforeach;
?>