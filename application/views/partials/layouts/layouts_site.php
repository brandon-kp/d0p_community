
<div id="cats">
	<p class="head"><?php echo $type['title'].' '.$type['keyword'];?></p>
	<p class="desc">
		<span><img src="<?php echo $type['logo'];?>.png" style="float:left;clear:left" alt="" /><?php echo $type['description'];?></span>
		<div class="clear"></div>
	</p>
	<p class="head">Site Notes</p>
	<p class="desc"><?php echo $type['site_notes'];?></p>
	
	<p class="head">Browse by Category</p>
	<p class="desc">
		<div class="cats_list">
		<?php $i = 0; foreach($cats as $cat): $j = ++$i;?>
			<a href="#"><?php echo ucwords($cat['title']);?></a> (<?php echo $cat['count'];?> submissions)<br />
			<?php 
			if(floor(count($cats)/2) == $j):
				echo '</div><div class="cats_list">';
			endif;
		endforeach;?>
		</div>
		<div class="clear"></div>
		<a href="<?php echo site_url('layouts/'.$site);?>">Show All Layouts</a>
	</p>
</div>
<?php echo form_open('');?>
<div class="layoutshere">
	Browsing  Layouts &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	Show <select name="show" onchange="this.form.submit();"><option value="10">10</option><option value="20" selected="selected">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="60">60</option><option value="70">70</option><option value="80">80</option></select> Layouts Per Page 
</div>
<div style="text-align:center;"></div>
<?php echo form_close();?>

<div id="layouts_list">
	<?php foreach($layouts as $layout):?>
<table class="layHome" id="layout193420">
	<tr>
		<td class="layHead" colspan="2"><a href="<?php echo site_url('layouts/review/'.$layout['id']);?>"><?php echo $layout['title'];?></a></td>
	</tr><tr>
		<td class="layleft">Submited By <a href="<?php echo site_url('~').$layout['user_id'];?>"><?php echo $layout['name'];?></a><br /><i>6</i>&nbsp; hours ago
		<br /> <a href="http://web.archive.org/web/20080102125522/http://www.skem9.com/layouts/reviews.php?layout=193420"><img src="http://i.imgur.com/<?php echo $layout['preview_image']?>.png" style="width:150px" alt="Preview" /></a><br /><a href="http://web.archive.org/web/20080102125522/http://www.skem9.com/layouts/LayoutPreview.php?layoutid=193420">Preview</a></td>
		<td class="layright">
			<span>Posters Notes:</span>
			<div class="Pnotes"><?php echo $layout['notes'];?></div>
			<br /><br />
			<a href="http://web.archive.org/web/20080102125522/http://www.skem9.com/layouts/UsersLayouts-235500">Browse other layouts from <?php echo $layout['name'];?></a>
		</td>
	</tr><tr>
		<td></td>
		<td class="Hrating">
			<div id="rating_193420" class="rating"><?php echo $layout['thumbs_up'];?> Thumbs Up / <?php echo $layout['thumbs_down'];?> Thumbs Down</div>
		</td>
	</tr><tr>
		<td class="layBot" colspan="2"></td>
	</tr>
</table>
	<?php endforeach;?>
</div>
	
<style>
#cats{color:#fff; font-weight:bold; background:#000 url("<?php echo site_url('assets/css/images');?>/foot_bg.gif") center top repeat-x; padding:2px; text-align:center;}
#cats p.head{color:white; font-weight:bold; text-indent:15px; background:#242424; padding:5px 0px; margin:5px;}
p.desc{margin:10px;}
p.desc span, p.desc div, p.desc *, #cats{font-weight:500!important;}
.cats_list{float:left; text-align:center; width:48%;}
.layoutshere {color:#000; font-weight:bold; background:#6e9dd4 url("<?php echo site_url('assets/css/images');?>/head_on.gif"); padding:2px; text-align:center;}
.featured, .layHome {width:100%; border-collapse: collapse; border:1px solid #6e9dd4; margin:5px;}
.featured td, .layHome td {color:white; vertical-align:top;}
.layHead {font-weight:bold; text-indent:20px; height:30px; background: url("<?php echo site_url('assets/css/images');?>/foot_bg.gif") bottom;}
.layBot {font-weight:bold; background:url("<?php echo site_url('assets/css/images');?>/top5sf.gif") bottom repeat-x; height:1px !important;}
.layleft {width:50%; text-align:center; vertical-align:top;}
.layright {vertical-align:top;}
.Hrating {text-align:center;}
.Pnotes {overflow:auto; padding:3px; height:160px; width:275px;}
#layouts_list{float:left; width:600px}
</style>