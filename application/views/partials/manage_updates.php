<?php 
$location_input = form_dropdown('location',array(
	'home_page'=>'Home Page',
	'account_page'=>'Account Page',
));

$text_input = form_textarea(array(
	'name'=>'text',
	'class'=>'textarea'
));
?>

<div id="tabs">

	<ul>
		<li><a href="#tabs-1">Publish Update</a></li>
		<li><a href="#tabs-2">Modify Updates</a></li>
		<li><a href="#tabs-3">Third</a></li>
	</ul>
	<div id="tabs-1">
		<div id="publish_update">
			<h2>Publish Update</h2>
			<?php echo form_open('updates/process');?>
			<?php echo $template['partials']['errors']; ?>
			<ul id="publish">
				<li>
					<label for="location">Publish On::.</label> <?php echo $location_input;?>
				</li>
				<li>
					<label for="text">Update Text::.</label> <?php echo $text_input;?>
				</li>
				<li>
					<label for="submit">Done::.</label> <input type="submit" name="submit" value="Submit" />
				</li>
			</ul>
			<?php echo form_close();?>
		</div>
	</div>
	<div id="tabs-2">
		<div id="modify_updates">
			<h2>Modify Updates</h2>
			<ul id="read_updates">
			<?php foreach($list_updates as $update):?>
				<li>[ <a href="#"><?php echo $update['date'];?></a> ] [ Mod | Del ]</li>
			<?php endforeach;?>
			</ul>
		</div>
	</div>

	<div id="tabs-3">Nam dui erat, auctor a, dignissim quis, sollicitudin eu, felis. Pellentesque nisi urna, interdum eget, sagittis et, consequat vestibulum, lacus. Mauris porttitor ullamcorper augue.</div>
</div>

<script>
$(function(){
	$('#tabs').tabs();
});
</script>