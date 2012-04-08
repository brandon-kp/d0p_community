<div class="tuCons">
	<div class="tutorial">
		<h3 class="tutName"><?php echo $tutorial['title'];?></h3>
		<p class="statLine"><?php echo ucwords($tutorial['subcategory_title'].' '.$tutorial['category_title']);?> Tutorials | Submited <?php echo date('F d, Y',$tutorial['date']);?></p>
		<p class="submitor">Written by: <a href="/~<?php echo $tutorial['submitter'];?>"><?php echo $tutorial['username'];?></a></p>
		<div class="ShortDesc"><?php echo $tutorial['description'];?></div>
		<div class="fulltext">
			<?php echo $tutorial['text'];?>
		</div>
		<div class="TutStats">
			<p class="tags">
				<img src="<?php echo base_url('assets/images/tags.gif');?>" alt="tags" /> 
				Tags: <?php echo $tutorial['tags'];?>
			</p>
			<p>
				<div class="rate">
					<?php echo $tutorial['thumbs_up'];?> <a id="thumbs_up" href="#"><img src="<?php echo base_url('assets/images/thumbs_up.png');?>" alt="Thumbs Up" /></a> / 
					<?php echo $tutorial['thumbs_down'];?> <a id="thumbs_down" href="#"><img src="<?php echo base_url('assets/images/thumbs_down.png');?>" alt="Thumbs Down" /></a>
				</div>
			</p>
			<div id="updatedLine"></div>
		</div>
	</div>
</div>



<style type="text/css">

.clear {clear:both;}
.doTheBrowse {float:left; width:465px; background:#333; margin:3px; border:1px solid #555;}
.doTheBrowse p.a {margin:2px 0; padding:0; color:#999; text-indent:10px; border-bottom:1px solid #0af; font-size:1.1em;}
.doTheBrowse h3 {margin:0; color:#0af; background:#000; border-bottom:1px solid #999; text-indent:15px;}
.doTheBrowse ul {margin:5px;; padding:0; list-style-type:none; border:1px solid #000; background:#111;}
.doTheBrowse li {margin:0; padding:0; list-style-type:none;}
.doTheBrowse li a {display:block; width:100%; text-align:center;}

.doTheBrowse li a span {color:#ddd;}
.doTheBrowse li a:hover span {color:#0af;}
.doTheBrowse .box {float:left; width:220px; margin:3px; border:1px solid #444; background:#222;}

.tutSide {float:left; width:300px;}
.sidebar {float:left; width:160px;}
.tuCons {float:right; width:750px; margin-right:5px;}

.tutorial {background:#111; padding:5px; border:1px solid #444; margin:4px;}
.tutorial h3.tutName {color:#0af; margin:0; text-indent:20px; border-bottom:2px dashed #444; font-family:georgia;}
.tutorial p.statLine {margin:0; color:#777; text-indent:10px; background:#000;}
.tutorial p.submitor {margin:0 0 5px 5px; color:#888; border-bottom:1px solid #444; background:#000;}
.TutStats {text-align:center; border-top:1px solid #777; margin:15px 5px 5px;}
.TutStats p {margin:0;}
.tutorial blockquote {background:#222; border:1px solid #6e9dd4; padding:5px; margin:5px 25px;}
.tutorial p.SmTitle {display:block; border-top:1px dashed #6e9dd4; text-indent:20px; font-size:1.2em; font-family:georgia; font-weight:bold; margin:0; color:#999;}

#smilies h3, #formInputsTog h3 {margin:0; color:#0af; background:#222; border-width:0px 1px 1px; border-style:solid; border-color:#444;}
#smilies h3 img, #formInputsTog h3 img {float:right; width:25px; margin-top:-20px;}
#formInputsTog input {width:400px; background:#444; color:#0af; border-color:#0af;}
#formInputsTog #switchingTog {width:100px;}
#colorsRight {float:left; margin-right:10px;}
#colorsRight div {border:1px solid #0af; width:200px; height:110px; margin:5px 0; display:block; line-height:100px; text-align:center; font-size:20px; color:#999;}
#gridTable {border-collapse:collapse; cursor:pointer;}
#gridTable td {width:10px;}
.MAforms textarea {background-color:#333333; color:#ddd; padding:5px; border-color:#0af;}
.ShortDesc {padding:10px; border-bottom:1px solid #555;}
.ComsError {background:url(/images/blue_site_theme/head_on.gif); color:#000; font-weight:bold; text-indent:10px; padding:5px; margin:5px;}
.commentsPeps {margin:0px 10px 3px 10px; width:690px; border:1px inset #525252; padding:5px; background:url(http://web.archive.org/web/20080914123012/http://www.skem9.com//images/blue_site_theme/foot_bg.gif) repeat-x top #000;}
.commentsPeps span.comName {display:block; text-indent:15px; background:#242424; padding:5px 0px; text-align:left;}
.commentsPeps .commentMess {float:right; width:585px; text-align:left;}
.commentsPeps .comImg {float:left;}
#updatedLine {border-width:5px; border-style:solid; border-color:#6e9dd4 #111;  color:#999; width:300px; margin:5px auto; }
</style>

<script>
$('#thumbs_up').click(function(){
	var data = 'action=rating&thumbs_up=true&to=<?php echo $id;?>';
	$.ajax({
		  type: 'POST',
		  url: "<?php echo site_url('tutorials/rate');?>",
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
		  url: "<?php echo site_url('tutorials/rate');?>",
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