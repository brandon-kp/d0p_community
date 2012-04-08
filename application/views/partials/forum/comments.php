<div id="forum">
<div class="spons">
		<?php if($userprofile['account_type'] >1):?>
		<a href="<?php echo site_url('forum/deletetopic/'.$coms[0]['topic']);?>">Delete Thread</a>
		<a href="<?php echo site_url('forum/makesticky/'.$coms[0]['topic'].'/'.$coms[0]['sticky']);?>">Make Un/Sticky</a>
		<a href="<?php echo site_url('forum/locktopic/'.$coms[0]['topic'].'/'.$coms[0]['locked']);?>">Lock Thread</a>
		<?php endif;?>
</div>
	
<div id="breadcrumb">
	<a href="<?php echo site_url('forum');?>">Forum</a> <span>&#187;</span>
	<a href="<?php echo site_url('forum/category/'.$cat_info['id']);?>"><?php echo $cat_info['title'];?></a> <span>&#187;</span>
	<strong><?php echo $coms[0]['title'];?></strong>
</div>

<div class="browse">
<?php echo $pages;?>
</div>

<?php foreach($coms as $com):?>
<div class="ForumComs">
	<div class="LeftSide">
		<a href="<?php echo site_url('~'.$com['poster']);?>">
			<?php echo $com['name'];?><br />
			<img style="width:100px;" src="<?php echo site_url($com['photo']);?>" alt="User Picture.." /><br />
		</a>
		<?php echo substr(age($com['birthday'], time()),0,2);?>/<?php echo substr($com['gender'],0,1);?>
		<?php if($com['account_type'] >1):?><br /><img src="<?php echo base_url('assets/images/'.$com['account_type']);?>" alt="Admin Account" /><?php endif;?>
	</div>
	<div class="message" id="c_<?echo $com['id'];?>">
		<p class="TimeStamp">Posted at <?php echo date('m/d/y, g:ia', $com['date']);?>
		<?php if($com['edited']=='1'):?><span>edited</span><?php endif;?>
		<?php if($this->session->userdata('id')==$com['poster']):?><em><a class="edit_link" href="#" data-comid="<?php echo $com['id'];?>">Edit</a> ~ <a class="delete_link" href="#" data-comid="<?php echo $com['id'];?>">Remove</a></em><?php endif;?>
		</p>
		<p class="commentBody"><?php echo $com['text'];?></p>
		<p class="Signature"><?php echo $com['signature'];?></p>
		<p class="UserRating"><?php echo $com['post_count'].$this->forum_library->postcount_taglines($com['post_count']);?></p>
	</div>
</div>
<?php endforeach;?>

<div class="clear"></div>

<div class="browse">
<?php echo $pages;?>
</div>

<div id="ReplyComms">
	<?php echo $reply;?>
</div>

</div>

<script>
$('.edit_link').click(function(){
	var comment_id = $(this).attr('data-comid');
	var comment_text = $('#c_'+comment_id+' p.commentBody').text();
	$('#c_'+comment_id+' p.commentBody').html('<?php echo form_open(null,array('id'=>'edit_form'));?><div><input type="hidden" name="comment" value="'+comment_id+'" /><textarea name="edit">'+comment_text+'</textarea><br /><input id="edit_sub" type="submit" name="sub" value="Edit post" /></div><?php echo form_close();?>');
	return false;
});

$('#edit_sub').live('click',function(){
	var data = $('#edit_form').serialize();
	var text = $('textarea[name=edit]').val();
	$.ajax({
		  type: 'POST',
		  url: '<?php echo $_SERVER['REQUEST_URI'];?>',
		  data: data
		}).done(function() {
			$('#edit_form').html(text);
		});
	return false;
});

$('.delete_link').click(function(){

	var comment_id = $(this).attr('data-comid');
	var data = '&delete='+comment_id;
	$(this).parent().parent().parent().parent().slideUp('slow');
	$.ajax({
		  type: 'POST',
		  url: '<?php echo $_SERVER['REQUEST_URI'];?>',
		  data: data
		});
	return false;
});
</script>

