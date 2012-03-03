<?php 
$form_open = form_open('signup/process');

$username = form_input(array(
	'name'=>'username',
	'value'=>'',
	'class'=>'signup_input',
	'id'=>'username',
));

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

$password_conf = form_password(array(
	'name'=>'password_conf',
	'value'=>'',
	'class'=>'signup_input',
	'id'=>'password_conf',	
));

//2002-03-01
$month = form_dropdown('month',array(
	'01'=>'January',
	'02'=>'February',
	'03'=>'March',
	'04'=>'April',
	'05'=>'May',
	'06'=>'June',
	'07'=>'July',
	'08'=>'August',
	'09'=>'September',
	'10'=>'October',
	'11'=>'November',
	'12'=>'December',
));

$day = form_input(array(
	'name'=>'day',
	'placeholder'=>'DD',
	'class'=>'signup_input',
	'id'=>'input_day',
	'style'=>'width:30px;'
));

$year = form_input(array(
	'name'=>'year',
	'placeholder'=>'YYYY',
	'class'=>'signup_input',
	'id'=>'input_year',
	'style'=>'width:50px;',
));

$gender = form_dropdown('gender',array(
	'male'=>'Male',
	'female'=>'Female',
));

$tos = form_checkbox(array(
	'name'=>'tos',
	'id'=>'tos',
	'value'=>'accept',
));

$submit = form_submit(array(
	'name'=>'submit',
	'value'=>'Submit',
));

$birthday = $month.$day.$year;
$form_close = form_close();

$fields = array($username, $email, $password, $password_conf, $birthday, $gender, $tos, $submit);
?>
<div id="the_form">
<h1>Joining Skem9.com</h1>
<ul class="left">
	<li><label for="username">Display Name::.</label></li>
	<li><label for="email">Email::.</label></li>
	<li><label for="password">Password::.</label></li>
	<li><label for="password_conf">Password (confirm)::.</label></li>
	<li><label for="month">Birthday::.</label></li>
	<li><label for="gender">Gender::.</label></li>
	<li><label for="tos">I agree to the <a href="<?php echo site_url('signup/tos');?>">TOS</a>::.</label></li>
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