<div class="browse">
	<?php foreach($pages['pages'] as $page):?>
	<a class="pdot" href="<?php echo $page['url'];?>"><?php echo $page['text'];?></a>
	<?php endforeach;?>
</div>
<div id="layout_list">
	<?php foreach($layouts as $layout):?>
	    <h3><a href="#"><?php echo $layout['title'];?></a></h3>
	    <div class="content">
	    	<div class="thumbnail">
	    		<a href="<?php echo site_url('layouts/review/'.$layout['id']); ?>"><img src="http://i.imgur.com/<?php echo $layout['preview_image'];?>s.jpg" alt="" /><br />Review Layout</a>
	    	</div>
	    	<div class="description"><?php echo $layout['notes'];?><div id="thanks_for_rating"><p class="success">Thanks for rating!</p></div></div>
	    	<div class="rate">
				<a data-id="<?php echo $layout['id'];?>" id="thumbs_up" href="#"><?php echo $layout['thumbs_up'];?><img src="<?php echo base_url('assets/images/thumbs_up.png');?>" alt="Thumbs Up" /></a> / 
				<a data-id="<?php echo $layout['id'];?>" id="thumbs_down" href="#"><?php echo $layout['thumbs_down'];?><img src="<?php echo base_url('assets/images/thumbs_down.png');?>" alt="Thumbs Down" /></a>
			</div>
			<div class="clear"></div>
	    </div>
<?php endforeach;?></div>

<style>
#layout_list{float:right; width:650px;}
#layout_list h3{font-size:14px; margin:5px; padding:3px; background:url(<?php echo base_url('assets/css');?>/images/foot_bg.gif); border:solid #333; border-width:1px 1px 0 1px;}
#layout_list h3 a{display:block; background:#444; margin:2px; padding:3px;}
#layout_list div.content{width:598px; margin:-5px auto 0 auto; padding:20px; background:url(<?php echo base_url('assets/css');?>/images/foot_bg.gif) center -34px repeat-x; background-color:#000; border:solid #333; border-width:0 1px 1px 1px;}
#layout_list .thumbnail{width:145px; float:left;}
#layout_list .description{float:right; width:450px}

.browse {width:650px; float:right;background:#545454 url(<?php echo base_url('assets/css');?>/images/head_off.gif); padding:4px;text-align:center;}
.browse a, .browse a:visited {background:transparent; border:1px solid #545454; padding:3px; color:#000; text-decoration:none;}
.browse a:hover, .browse a:active, .browse a:focus {background:#242424; border:1px solid #000; color:#6E9DD4;}
.browse span {background:#B4B4B4; padding:3px; color:#000; border:1px solid #000;}

.rate{float:right}
.rate a{color:#ddd;}
#thanks_for_rating{display:none;}
</style>

<script>
$(function() {
	$( "#layout_list" ).accordion({
		active: false,
		collapsible: false
	});
});

$('#thumbs_up').click(function(){
	var id = $(this).attr('data-id');
	var data = 'action=rating&thumbs_up=true&to='+id;
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
	var id = $(this).attr('data-id');
	var data = 'action=rating&thumbs_down=true&to='+id;
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