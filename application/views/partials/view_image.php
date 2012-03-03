<div id="view_image" style="width:880px;">
	<div class="photo">
		<img style="max-width:768px; max-height:600px;" src="<?php echo site_url('images/index/'.$usergallery['hash']);?>l" alt="" />
		<br />
		<span class="caption" id="<?php echo $usergallery['hash'];?>">
			<?php echo '<em>'.$usergallery['caption'].'</em>';?>
		</span>
	</div>
	<div class="clear"></div>
</div>
