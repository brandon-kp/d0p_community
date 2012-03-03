<div id="account_col">
	<div id="toolbar">
		<?php echo $template['partials']['toolbar'];?>
	</div>
</div>

<div id="edit_profile">
	<h2>Edit Profile</h2>
	<?php echo $template['partials']['errors'];
	echo form_open('myaccount/editprofile_process'); ?>
	<div id="top_form">
		<ul class="left">
			<li><label for="name">Display Name::.</label></li>
			<li><label for="location">Location::.</label></li>
			<li><label for="signature">Signature::.</label></li>
		</ul>
		<ul class="right">
			<li><input type="text" name="name" value="<?php echo $account_info['name'];?>" /></li>
			<li><input type="text" name="location" value="<?php echo $account_info['location'];?>" /></li>
			<li><input type="text" name="signature" value="<?php echo $account_info['signature'];?>" /></li>
		</ul>
	</div>
	<div id="side_table">
		<p>
			<input type="text" name="side_title" placeholder="Side Table Title" value="<?php echo $account_info['side_title'];?>" />
			<textarea name="side_table" placeholder="Side Table"><?php echo $account_info['side_table'];?></textarea>
		</p>
	</div>
	<div id="main_table">
		<label for="main_table">Main Table::.</label>
		<textarea name="main_table"><?php echo $account_info['main_table'];?></textarea>
	</div>
	<div id="extra_table1">
		<p>
			<input type="text" name="extra_title1" placeholder="Extra Table Title #1" value="<?php echo $account_info['extra_title1'];?>" />
			<textarea name="extra_table1" placeholder="Extra Table"><?php echo $account_info['extra_table1'];?></textarea>
		</p>
	</div>
	<div id="extra_table2">
		<p>
			<input type="text" name="extra_title2" placeholder="Extra Table Title #2" value="<?php echo $account_info['extra_title2'];?>" />
			<textarea name="extra_table2" placeholder="Extra Table"><?php echo $account_info['extra_table2'];?></textarea>
		</p>
	</div>
	<div id="submit">
		<input type="submit" name="submit" value="Update Profile" />
	</div>
	</form>
</div>

<script type="text/javascript">
$(function() {
	$('#toolbar').accordion();
});
</script>