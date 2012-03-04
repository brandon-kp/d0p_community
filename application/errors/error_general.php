<!DOCTYPE html>
<html lang="en">
<head>
<title>Error</title>
<style type="text/css">
::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #000;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #ddd;
}

a {
	color: #6e9dd4;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #6e9dd4;
	background-color: transparent;
	border-bottom: 1px solid #0ae;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px auto;
	border: 1px solid #0af;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
background:#333;
width:780px;
}

p {
	margin: 12px 15px 12px 15px;
}

#footer{text-align:center;}
</style>
</head>
<body>
	<div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
		<p><a href="javascript:history.go(-1);">Click here to go back.</a></p>
		<div id="footer">
			[
			<a href="<?php echo site_url();?>">Home</a> |
			<a href="<?php echo site_url('/myaccount');?>">My Account</a>
			]
		</div>
	</div>
</body>
</html>