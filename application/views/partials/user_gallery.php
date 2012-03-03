<div id="gallery" style="width:880px;">
	<?php foreach($usergallery as $photo):?>
		<div class="photo">
			<a href="<?php echo site_url('usergallery/viewimage/'.$photo['hash']); ?>">
				<img style="max-width:150px; max-height:80px;" src="<?php echo site_url('images/index/'.$photo['hash']);?>s" alt="" />
			</a><br />
			<span class="caption" id="<?php echo $photo['hash'];?>">
				<?php echo '<em>'.$photo['caption'].'</em>';?>
			</span>
		</div>
	<?php endforeach;?>
		<div class="clear"></div>
</div>
