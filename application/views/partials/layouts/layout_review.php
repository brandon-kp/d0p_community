
<p class="LayoutTitle"><?php echo $layout['title'];?></p>
<div id="layout_content">
	<div id="thumbnail">
		<img src="http://i.imgur.com/<?php echo $layout['preview_image'];?>.png" style="max-width:200px" alt="layout preview" />
	</div>
	<div id="info_list">
		<ul class="left">
			<li>Submitted on</li>
			<li>Poster</li>
			<li>Category</li>
			<li>Votes</li>
		</ul>
		<ul class="right">
			<li><?php echo $layout['date'];?></li>
			<li><?php echo $layout['name'];?></li>
			<li><?php echo $layout['category'];?></li>
			<li><?php echo $layout['thumbs_up'].'/'.$layout['thumbs_down'];?></li>
		</ul>
		<div class="clear"></div>
		<div class="rate">
			<a id="thumbs_up" href="#"><img src="<?php echo base_url('assets/images/thumbs_up.png');?>" alt="Thumbs Up" /></a> / 
			<a id="thumbs_down" href="#"><img src="<?php echo base_url('assets/images/thumbs_down.png');?>" alt="Thumbs Down" /></a>
		</div>
		<div id="thanks_for_rating"><p class="success">Thanks for rating!</p></div>
		<p class="browAllU">Browse All of <a href="http://web.archive.org/web/20080213155410/http://www.skem9.com/layouts/usersLayouts.php?user=17959"><?php echo $layout['name'];?>'s Layouts</a></p>
	</div>
	<div class="clear"></div>
	
	<p class="layoutPlace"><?php echo $layout['type_title'].' '.$layout['type_keyword'];?></p>
	<p style="text-align:center"><?php echo $layout['type_description'];?></p>
	
	<p class="llnt">Notes</p>
	<p class="llside"><?php echo $layout['notes'];?></p>
	
	<p class="llnt">Code</p>
	<p class="llside"><textarea readonly="true" onclick="this.select()"><?php echo $layout['code'];?></textarea></p>
	
	<p class="llnt">Comments</p>
	<p class="llside">		
		<?php echo $layout['comments'].$layout['comment_form'];?>
	</p>
</div>

<script>
$('#thumbs_up').click(function(){
	var data = 'action=rating&thumbs_up=true&to=<?php echo $id;?>';
	$.ajax({
		  type: 'POST',
		  url: "<?php echo site_url('layouts/rate');?>",
		  data: data
		}).done(function( response ) {
			$('.rate')
				.slideUp('slow',function(){
					$('#thanks_for_rating').slideDown("slow");
				});
		});
	return false;	
});
$('#thumbs_down').click(function(){
	var data = 'action=rating&thumbs_down=true&to=<?php echo $id;?>';
	$.ajax({
		  type: 'POST',
		  url: "<?php echo site_url('layouts/rate');?>",
		  data: data
		}).done(function( response ) {
			alert(response);
			$('.rate')
				.slideUp('slow',function(){
					$('#thanks_for_rating').slideDown("slow");
				});
		});
	return false;	
});
</script>

<style>
#thanks_for_rating{display:none;}
.rate{text-align:center;}
.LayoutTitle {display:block; text-indent:20px;background:url("<?php echo base_url('assets/css/images');?>/head_on.gif"); font-size:1.4em; font-weight:normal; color:#000; font-family:georgia, new times roman, sans-serif;}
#layout_content{width:600px;}
#thumbnail{float:left; margin:0 5px; text-align:center; width:50%;}
#info_list{float:right; width:47%}
#info_list .left{float:left; margin-right:5px}
#info_list ul.left li{background:url("/community/assets/css/images/hover_on.gif") top repeat-x; text-indent:3px;  padding:0 3px;}
#info_list ul.right{float:left;}
.browAllU {line-height:20px; background:#222; text-align:center;}
.layoutPlace {margin:0; padding:5px; color:#0af; font-size:21px; background:#111; text-align:center; border-bottom:1px solid #666;}
.llnt {background:#333; margin:0; color:#6e9dd4; border:5px solid #0af; border-color:#000 #333 #000 #0af; margin-left:5px; padding:4px; font-size:15px;}
.llside{padding:5px; text-indent:15px;}
.llside textarea{width:500px; background:transparent; color:#eee; padding:5px; border:1px outset #6e9dd4; height:150px;}
</style>