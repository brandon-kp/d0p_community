<div id="forum">
	<div class="spons">
		<a href="<?php echo site_url('forum/newtopic/'.$cat_info['id']);?>">New Topic</a>
	</div>
	
	<div id="ForumNotes"><b><?php echo $cat_info['title'];?></b><br /><?php echo $cat_info['description'];?></div>
	<div class="top_links">
		<a href="<?php echo site_url('forum');?>">Forum</a> .^. 
		<select onchange="location.href=this.value"><?php foreach($categories as $cat):?>
			<option value="<?php echo site_url('forum/category/'.$cat['id']);?>" <?php if($this->uri->segment(3) == $cat['id']):echo'selected="selected"';endif;?>><?php echo $cat['title'];?></option>
		<?php endforeach;?></select>
	</div>
	<?php $i=0; foreach($topics['sticky'] as $topic):?>
	<div class="topics Stickie <?php if($i%2):echo"odd";else:echo"even";endif;?>">
		<p class="topicsTitle">
			<img src="<?php echo base_url('assets/images/sticky.gif');?>" alt="sticky" title="sticky" />
			&nbsp;&nbsp;
			<a href="<?php echo site_url('forum/comments/'.$topic['id'].'/'.$cat_info['id']);?>"><?php echo $topic['title'];?></a>
		</p><p class="topicsSmall">
			Started by 
			<a href="<?php echo site_url('~'.$topic['user_id']);?>">
				<?php echo $topic['name'];?>
			</a> 
			at <i><?php echo date('m/d/y, g:ia', $topic['start_date']);?></i> 
			with <?php echo $topic['reply_count'];?> replies
		</p><p class="topicLast"><?php if($topic['reply_count'] > 0):?>
			Last reply was <?php echo timespan($topic['last_reply_date'],time());?> ago by 
			<a href="<?php echo site_url('~'.$topic['user_id']);?>"><?php echo $topic['last_reply_name'];?></a> &nbsp;&nbsp;&nbsp;&nbsp;
			<span>
				<a href="http://web.archive.org/web/20071220222035/http://www.skem9.com/forum/comments/13171/1/">1</a>
				<a href="http://web.archive.org/web/20071220222035/http://www.skem9.com/forum/comments/13171/2/">2</a>
			</span>
			<?php endif;?>
		</p>
	</div>
	<?php $i++; endforeach;
		  $i=0; foreach($topics['normal'] as $topic):?>
	<div class="topics <?php if($i%2):echo"odd";else:echo"even";endif;?>">
		<p class="topicsTitle">
			<?php if($topic['locked']=='1'):?><img src="<?php echo base_url('assets/images/locked.gif');?>" alt="locked" title="locked" /><?php endif;?>
			<a href="<?php echo site_url('forum/comments/'.$topic['id'].'/'.$cat_info['id']);?>"><?php echo $topic['title'];?></a>
		</p><p class="topicsSmall">
			Started by 
			<a href="<?php echo site_url('~'.$topic['user_id']);?>">
				<?php echo $topic['name'];?>
			</a> 
			at <i><?php echo date('m/d/y, g:ia', $topic['start_date']);?></i> 
			with <?php echo $topic['reply_count'];?> replies
		</p><p class="topicLast"><?php if($topic['reply_count'] > 0):?>
			Last reply was <?php echo timespan($topic['last_reply_date'],time());?> ago by 
			<a href="<?php echo site_url('~'.$topic['user_id']);?>"><?php echo $topic['last_reply_name'];?></a> &nbsp;&nbsp;&nbsp;&nbsp;
			<span>
				<a href="http://web.archive.org/web/20071220222035/http://www.skem9.com/forum/comments/13171/1/">1</a>
				<a href="http://web.archive.org/web/20071220222035/http://www.skem9.com/forum/comments/13171/2/">2</a>
			</span>
			<?php endif;?>
		</p>
	</div>
	<?php $i++; endforeach;?>
<div class="clear"></div>
</div>