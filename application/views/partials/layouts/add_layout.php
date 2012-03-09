<div id="add_layout">
	<div id="layout_form">
		<?php echo form_open_multipart('layouts/addlayout');?>
		<p>
			<label for="title">Layout Title::.</label>
			<input type="text" value="" name="title" />
		</p><p>
			<label for="userfile">Preview Image::.</label>
			<input type="file" name="userfile" value="" />
		</p><p>
			<label for="category">Layout Category::.</label>
			<select name="category">
				<?php foreach($categories as $cat):?><option value="<?php echo $cat['id']; ?>"><?php echo ucwords($cat['title']);?></option><?php endforeach;?>
			</select>
		</p><p>
			<label for="type">Layout Type::.</label>
			<select name="type">
				<?php foreach($types as $type):?><option value="<?php echo $type['id']; ?>"><?php echo $type['title'];?></option><?php endforeach;?>
			</select>
		</p><p>
			<label for="notes">Layout Notes::.</label>
			<textarea name="notes" class="layouts_ta"></textarea>
		</p><p>
			<label for="code">Layout Code::.</label>
			<textarea name="code" class="layouts_ta" /></textarea>
		</p><p>
			<label for="tos">I agree to the Skem9 terms of service::. </label>
			<input type="checkbox" value="1" name="tos" />
		</p><p>
			<input class="sub" type="submit" name="sub" value="Submit Layout" />
		</p><div id="errors"><?php if($errors):echo($errors);endif;?></div>
		<?php echo form_close();?>
	</div>
</div>
<style>
#add_layout{float:right; background:#333; width:650px; border:3px solid #222; margin:10px;}
#layout_form p{padding:5px; background:#222; border:3px solid #333;}
#layout_form label{font-weight:bold; color:#0af; vertical-align:top;}
#layout_form input, #layout_form select, #layout_form textarea{margin-left:20px;}
#layout_form input[type=text], input[type=file]{background:#666; border:1px solid #777; color:#fff;}
#layout_form select{background:#666; color:#fff; border:1px solid #777; width:150px;}
#layout_form select:focus{background:#333; color:#0af;}
#layout_form textarea{width:500px; height:80px; background:#666; border:1px solid #777; color:#fff; font-family:verdana;}
#errors p{font-weight:bold; color:red;}
</style>