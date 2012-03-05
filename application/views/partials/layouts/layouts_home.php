<div class="BrowsingSites">
	<?php foreach($types as $cat):?>
	<div class="ThisSite" id="site<?php echo $cat['id'];?>">
		<p class="sitesTitle"><?php echo $cat['title'];?></p>
		<a class="SiteLink" href="<?php echo site_url('layouts/site/'.$cat['id']);?>">
			<img src="<?php echo $cat['logo'];?>.png" alt="<?php echo $cat['title'];?> Layouts" />
		</a>
		<div class="siteInfos" onclick="window.location='<?php echo site_url('layouts/site/'.$cat['id']);?>';">
			<!--<p><span>146,949</span> Layouts</p>--><p class="Snotes"><?php echo $cat['description'];?></p>
		</div>
	</div>
	<?php endforeach;?>
	<div class="clear"></div>
</div>


<style type="text/css">
.ThisSite {-moz-border-radius:3%; background:#111; height:270px; border:1px solid #0af; width:200px; padding:5px; margin:5px; float:left;}
.siteInfos {cursor:pointer; -moz-border-radius:3%;background:#000; border:1px solid #555; padding:4px; overflow:auto; z-index:10;}
.SiteLink img {z-index:5;}
.musicProInfo {background:#222; padding:5px; clear:both; text-align:center; color:#ccc; border-style:solid; border-width:5px; border-color:#333 #000;}
.siteInfos p {margin:2px; background:#0af; color:#000; text-indent:20px; font-weight:bold;}
.siteInfos p.Snotes {background:transparent; text-indent:10px; color:#ddd; font-weight:normal;}
.sitesTitle {margin:2px; color:#0af; text-align:center; font-weight:bold; background:#333; border-width:5px; border-style:solid; border-color:#111 #555; font-size:1.1em;;}
.sideBar {width:250px; float:right;}
.BrowsingSites {float:left; width:670px;}
.NewWid {float:left; width:300px; height:250px;}
</style>