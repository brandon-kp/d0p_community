<div class="doTheBrowse">
	<h3>Tutorial Categories</h3>
	<?php foreach($cats['maincats'] as $main):?>
	<div class="box">
		<p class="a"><?php echo $main['title'];?></p>
		<ul>
			<?php foreach($cats['subcats'] as $subs): if($subs['parent'] == $main['id']):?><li>
				<a href="<?php echo site_url('tutorials/browse/'.$main['id'].'/'.$subs['id']);?>"><?php echo $subs['title'];?></a>
			</li><?php endif; endforeach;?>
		</ul>
	</div>
	<?php endforeach;?>
</div>

<div class="clear"></div>

<div class="midSect">
	<h3>Top Rated Tutorials</h3>
	<?php foreach($top_rated as $tuts):?>
	<div class="tut">
		<p class="tit"><a href="<?php echo site_url('tutorials/viewtutorial/'.$tuts['id']);?>"><?php echo $tuts['title'];?></a> <span class="goRigh"><?php echo $tuts['thumbs_up'];?> Votes</span></p>
		<p class="bb">Submitted By::. <a href="<?php echo $tuts['userid'];?>"><?php echo $tuts['name'];?></a> @ <?php echo date('m/d/y, g:ia',$tuts['date']);?></p>
		<p class="short"><?php echo $tuts['description'];?></p>
		<p class="tags"><img src="<?php echo base_url('assets/images/tags.gif');?>" alt="tags" />&nbsp;&nbsp;&nbsp;<?php echo $tuts['tags'];?></p>
	</div>
	<?php endforeach;?>
</div>

<div class="Tbox">
	<h3>Newest Tutorials</h3>
	<?php foreach($newest as $tut):?>
	<p class="bil">
		<a class="Tti" href="<?php echo site_url('tutorials/viewtutorial/'.$tut['id']);?>"><?php echo $tut['title'];?></a><br />
		<img src="<?php echo base_url('assets/images/tags.gif');?>" alt="tags" /> &nbsp;&nbsp;&nbsp;
		<?php echo $tut['tags'];?>
	</p>
	<?php endforeach;?>
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
.Tbox {width:300px; background:#111; float:right; margin:5px; padding:4px;}
.Tbox .a {margin:0; color:#ddd; border-bottom:1px solid #555;font-size:1.1em;}
.Tbox .bil {background:#222; padding:3px; margin:5px 0;}
.Tbox img {margin-right:10px;}
.Tbox p {margin:0;}
.Tbox a {color:#777;}
.Tbox a.Tti:link, .Tbox a.Tti:active, .Tbox a.Tti:visited {padding-left:10px; color:#6e9dd4;}
.Tbox a.Tti:hover { color:#0af;}

h3 {background:#222; text-indent:15px; margin:5px; color:#999; border-bottom:1px solid #0af;}
.midSect {float:left; width:460px;}
.tut {background:#222; border:1px solid #333; width:455px;}
.tut p {margin:0; padding:1px 5px;}
.tut .tit {background:#000; text-indent:15px;}
.Wfor {float:right; color:#999;}
.tut .tit a {font-size:1.2em;}
.tutSide {float:left; width:300px;}
.sidebar {float:right; width:160px;}
.tuCons {float:left; width:600px;}

.tut  {margin:5px;}
.tut .short {text-indent:15px;}
.tut .bb {color:#888; border-bottom:1px solid #333;}
	
.searchArea {margin: 10px 0; text-align:center; border-width:4px; border-style:solid; border-color:#0af #000; padding:5px 0;}
.searchArea input {padding-left:5px; background:#222; color:#ddd; border-color:#555;}
.searchArea select {background:#000; border-color:#555; color:#ddd;}
.searchArea optgroup {background:#333; color:#0af; text-indent:5px;}
.searchArea option {background:#000; color:#ddd;}

.goRigh {float:right; color:#aaa;}
</style>