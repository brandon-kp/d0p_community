<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $template['title']; ?></title>
		<?php echo $template['metadata']; ?>
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui-1.8.17.custom.min.js')?>"></script>
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/reset.css')?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/960.css')?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-ui-1.8.17.custom.css')?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css')?>" />
		
	</head>
	<body>
		<div id="wrap">
			<div id="header">
				<ul id="top_menu">
					<li><a href="<?php echo site_url('login');?>">Login</a></li>
					<li><a href="<?php echo site_url('signup');?>">Register</a></li>
					<li><a href="http://web.archive.org/web/20081207180706/http://www.skem9.com/layouts/index.php?action=forgot">Forgot Password</a></li>
					<li>182,368 Layouts</li>
				</ul>
				
				<div id="search">
					<form method="post" name="searchform" id="searchform" action="http://web.archive.org/web/20081211033154/http://www.skem9.com/search.php">
						<p><input type="hidden" name="what" value="what" id="what" />
						<span class="searchWhat" id="Slayouts" onclick="changeSelect(this);">Layouts</span>.^.<span onclick="changeSelect(this);" id="Simages" class="searchWhat">Images</span>.^.<span onclick="changeSelect(this);" id="Speople" class="searchWhat">People</span>.^.<span onclick="changeSelect(this);" id="Sforum" class="searchWhat">Forum</span>
						<select name="wh" id="wh" style="display:none;">
							<option value="0">Search for..</option>
							<option value="layouts">Layouts</option>
							<option value="images">Images</option>
							<option value="people">People</option>
							<option value="forums">Forum</option>
						</select><br />
						<span class="field"><input type="text" name="s" id="s" /></span>
						<span class="submit"><input type="submit" id="searchsubmit" value="search" /></span></p>
					</form>
			
					<div id="search-results"></div>
				</div>				
			</div>
		<div id="main_nav">
			<ul>
				<li class="current"><a href="<?php echo site_url();?>"><b>Home</b></a></li>
				<li><a href="http://web.archive.org/web/20081211033154/http://www.skem9.com/gens/index.php"><b>Generators</b></a></li>
				<li><a href="<?php echo site_url('layouts');?>"><b>Layouts</b></a></li>
				<li><a href="http://web.archive.org/web/20081211033154/http://www.skem9.com/videos/index.php"><b>Videos</b></a></li>
				<li><a href="http://web.archive.org/web/20081211033154/http://www.skem9.com/tutorials/index.php"><b>Tutorials</b></a></li>
				<li><a href="http://web.archive.org/web/20081211033154/http://www.skem9.com/image_fun/index.php"><b>Image Fun</b></a></li>
				<li><a href="http://web.archive.org/web/20081211033154/http://www.skem9.com/forum/index.php"><b>Forum</b></a></li>
			</ul>
		</div>			
			<?php echo $template['body']; ?>
			
			<div class="clear"></div>
			<div id="foot">
				<a href="http://web.archive.org/web/20081207180706/http://www.skem9.com/layouts/help.php">How to Customize Myspace</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://web.archive.org/web/20081207180706/http://www.skem9.com/index.php?page=support">Promote / Support</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://web.archive.org/web/20081207180706/http://www.skem9.com/index.php?page=sitemap">Site Map</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://web.archive.org/web/20081207180706/http://www.skem9.com/index.php?page=contact">Contact</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://web.archive.org/web/20081207180706/http://www.skem9.com/index.php?page=about">About</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://web.archive.org/web/20081207180706/http://www.skem9.com/html/faq">FAQ</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://web.archive.org/web/20081207180706/http://www.skem9.com/layouts/index.php?action=TOS">Terms Of Service</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://web.archive.org/web/20081207180706/http://www.skem9.com/layouts/index.php?action=TOS#PP">Privacy</a><br />
				
				Many thanks to <a href="http://web.archive.org/web/20081207180706/http://profile.myspace.com/index.cfm?fuseaction=user.viewprofile&friendid=5446191" style="text-decoration:underline;">Willian</a> for creating the awesome smilies on the site!!<br />
				Skem9.com is not affiliated with myspace.com or vampirefreaks.com, <br />nor does Skem9.com take credit for creating the images within the site's layouts.<br />
				<br />&copy; 2005-2008 Skem9.com &reg;
			</div>			
		</div>
	</body>
</html>
