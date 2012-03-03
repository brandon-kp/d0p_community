<?php 
$form_open = form_open('login/process');

$email = form_input(array(
	'name'=>'email',
	'value'=>'',
	'class'=>'signup_input',
	'id'=>'email',	
));

$password = form_password(array(
	'name'=>'password',
	'value'=>'',
	'class'=>'signup_input',
	'id'=>'password',	
));

$submit = form_submit(array(
	'name'=>'submit',
	'value'=>'Submit',
));

$form_close = form_close();

$fields = array($email, $password, $submit);
?>
<div id="the_form">
<h1>Log In to Skem9.com</h1>
<ul class="left">
	<li><label for="email">Email::.</label></li>
	<li><label for="password">Password::.</label></li>
	<li><label for="submit">Done?</label></li>
</ul>
<ul class="right">
<?php 
	echo $form_open;
	foreach($fields as $field):
?>
	<li><?php echo $field;?></li>
<?php 
	endforeach;
	echo $form_close;
?>
</ul>
<div class="clear"></div>
<?php echo $template['partials']['errors']; ?>
</div>

<div id="site_info">
	<h1>Not Currently a Member?</h1>
	<p>
	Current features that all members have access to of the site::<br />
	Having your own personal profile on the site, being able to comment on other members profiles, layouts, and the news thats posted on the front page of the site. All members are allowed to submit their own layouts they've created and then if they like any layouts they can always add them to their favorites so they can always find them again. Once you're a member you DO NOT have to submit any layouts you've made. Skem9.com will not be upset if you dont submit any.
	</p><p>
	Skem9 will not spam your email account, and actually since the site started its member section at the end of January 2006, we havent emailed any kind of news letters to any of the members. Your email adderess will not be sold, lended, or given away to anyone. I (John, Skem9.com owner) hate spam, and I will not be spamming you for any reason once you're signed up. 
	</p>
</div>
<div class="clear"></div>