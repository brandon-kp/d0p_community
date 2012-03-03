<div id="account_col">
        <div id="toolbar">
                <?php echo $template['partials']['toolbar'];?>
        </div>
</div>

<?php echo form_open('myaccount/managebuddies_process', array('class'=>'control'));?>
<div id="pending_buddies">
        <?php if(count($pending_buddies)<1): ?>No buddy requests at the moment. :[<?php else: foreach($pending_buddies as $pending):?>
        <div class="buddy_box">
                <div class="user">
                        <a href="<?php echo site_url('userprofile/index/~'.$pending['user_1']);?>"><?php echo $pending['name'];?>
                        <br />
                        <img src="<?php echo site_url().'/'.$pending['photo'];?>" alt="" />
                        </a>
                </div>
                <div class="controls">
                        <p class="message"><?php echo $pending['buddy_msg'];?></p>
                        <p>
                        	<label for="action">Approve::.</label><input type="radio" name="approve" value="<?php echo $pending['user_1']?>" />
                        	<label for="action">Deny::.</label><input type="radio" name="deny" value="<?php echo $pending['user_1']?>" />
                        </p>
                </div>
                <div class="clear"></div>
        </div>  
        <?php endforeach; endif;?>
</div>
<?php echo form_close(); ?>

<script>
$('input[type=radio]').click(function(){
	var data = $('.control').serialize();
	alert(data);
	$(this).parent().slideUp("slow",function(){
		$(this).html('<p class="success">Done!</p>');
		$(this).slideDown("slow");
	});

	$.ajax({
		  type: 'POST',
		  url: "<?php echo site_url('myaccount/managebuddies_process');?>",
		  data: data
		}).done(function( response ) {
			
		});
});
</script>