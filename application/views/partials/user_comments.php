<style type="text/css">

.commentsPeps {margin:0px 5px 3px 5px; width:640px; border:1px inset #525252; padding:5px; background:url(<?php echo base_url();?>assets/css/images/foot_bg.gif) repeat-x top #000;}
.commentsPeps span.comName {display:block; text-indent:15px; background:#242424; padding:5px 0px;}
.commentsPeps .commentMess {float:right; width:535px;}
.commentsPeps .comImg {float:left;}
.clear {clear:both;}
.BuddyInfo {float:right; width:200px; margin-right:10px;}
#AllComments {float:left; width:650px;}
textarea {background:#222; color:#ddd; padding:2px; border-color:#0af; border-width:2px;}
#smilies h3, #formInputsTog h3 {margin:0; color:#0af; background:#222; text-indent:15px; border-width:0px 1px 1px; border-style:solid; border-color:#444;}
#smilies h3 img, #formInputsTog h3 img {float:right; width:25px; margin-top:-20px;}
#formInputsTog input {width:400px; background:#444; color:#0af; border-color:#0af;}
#formInputsTog #switchingTog {width:100px;}
#colorsRight {float:left; margin-right:10px;}
#colorsRight div {border:1px solid #0af; width:200px; height:110px; margin:5px 0; display:block; line-height:100px; text-align:center; font-size:20px; color:#999;}
#gridTable {border-collapse:collapse; cursor:pointer;}
#gridTable td {width:10px;}
.BuddyInfo .Udata {background:#222; border:1px solid #555; text-align:center; margin:0;}
.BuddyInfo .Uname {margin:0;}
.editingCom { width:425px;}
.Ulinks a {display:block; width:100%; line-height:20px; text-indent:15px; background:#333; border:1px solid #000;}
.Ulinks a:hover {background:#222; border-color:#0Af; text-decoration:none;}
#editorLine, .buttons {text-align:center;}

.ComsTitle {background:#222; line-height:25px; text-indent:25px; color:#ddd; margin-bottom:5px; border-bottom:1px solid #555;}

#updatedLine {text-align:center; color:#0af; background:#222; font-size:16px;}

.NOTES{ .browse is the class for the paging of the comments. }
.browse {background:#545454 url(<?php echo base_url();?>assets/css/images/head_off.gif); padding:4px;text-align:center;}
.browse a, .browse a:visited {background:transparent; border:1px solid #545454; padding:3px; color:#000; text-decoration:none;}
.browse a:hover, .browse a:active, .browse a:focus {background:#242424; border:1px solid #000; color:#6E9DD4;}
.browse span {background:#B4B4B4; padding:3px; color:#000; border:1px solid #000;}
#new_comment{display:none;}
textarea{width:80%; height:80px;}
</style>


<div id="AllComments">
	<div id="new_comment">
		<?php if($profiledata['id'] == $userprofile['id']):?>
		<p class="MLine">You can't comment on yourself, you egomaniac.</p>
		<?php elseif($profiledata['show_form'] == true):?>
			<?php echo form_open('userprofile/comments_process', array('id'=>'comment_form'));?>
				<div class="commentForm">
					<p><textarea name="text" id="formMessage"></textarea></p>
					<p><input type="submit" name="submit" value="Post Comment" /></p>
					<input type="hidden" name="to" value="<?php echo $profiledata['id'];?>"/>
				</div>
			<?php echo form_close();?>
		<?php else:?>
			<p class="MLine">You have to be logged in to leave a comment!</p>
		<?php endif;?>	
	</div>
	
	<div id="update_comments"><div id="update_comments1">
		<div class="ComsTitle"><?php echo $profiledata['name'];?> Has <?php echo count($comments);?> Comment(s)</div>
		<?php foreach($comments as $comment):?>
		<div class="commentsPeps">
			<span class="comName">
				&nbsp;&nbsp;&nbsp;
				<a href="<?php echo site_url('userprofile/index/~'.$comment['from']);?>">
					<?php echo $comment['name'];?></a> ~ 
					<?php echo date("D M d, Y g:ia", $comment['date']);?></span>
			<div class="comImg"><a href="<?php echo site_url('userprofile/index/~'.$comment['from']);?>"><img style="max-width:80px" src="<?php echo site_url($comment['photo']);?>" alt="Picture.." /></a></div>
			<div class="commentMess"><?php echo $comment['text']; ?></div>
			<div class="clear" style="text-align:center;"></div>
			<div class="clear"></div>
		</div>		
		<?php endforeach;?>
	</div></div>			
	<p class="browse">
		<?php echo $pages;?>
	</p>
</div>
	
<div class="BuddyInfo">
	<div class="Udata">
		<p class="Uname">
			<a href="<?php echo site_url('userprofile/index/~'.$profiledata['id'])?>">
				<?php echo $profiledata['name'];?>
				<br />
				<img src="<?php echo site_url($profiledata['photo']);?>s.png" alt="users picture" />
			</a>
		</p>
		<?php echo substr(age($profiledata['birthday'], time()),0,2);?> / <?php echo substr($profiledata['gender'],0,1);?>
		<br />Location: <?php echo $profiledata['location'];?>
	</div>
	
	<div class="Ulinks">
		<a href="<?php echo site_url('userprofile/addbuddy/'.$profiledata['id']);?>">Add Buddy</a>
		<a href="<?php echo site_url('messages/send/'.$profiledata['id']);?>">Send Message</a>
		<a href="<?php echo site_url('userprofile/blockuser/'.$profiledata['id']);?>">Block Buddy</a>
		<a href="#" id="newComment">Add New Comment</a>
	</div>
</div>


<script>
$('.commentForm input[type=submit]').click(function(){
	$('.commentForm').prepend('<img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" alt="Loading..." id="loading_img" />');
	var data = $('#comment_form').serialize();

	$.ajax({
		  type: 'POST',
		  url: "<?php echo site_url('userprofile/comments_process');?>",
		  data: data
		}).done(function( response ) {
			$('.commentForm')
				.slideUp('slow',function(){
					$(this).html('<p class="success">Your comment was posted!</p>');
				})
				.slideDown('slow', function(){
					$('#update_comments').slideUp("slow").load(window.location+' #update_comments1').slideDown("slow");
				});
		});
	return false;
});
$('#newComment').click(function(){
	$('#new_comment').slideDown("slow");
	return false;
});
</script>