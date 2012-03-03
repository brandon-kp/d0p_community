	<div class="proInfoTable">
		<table>
			<tr><td class="proL">Age</td><td><?php echo age($profiledata['birthday'], time());?></td></tr>
			<tr><td class="proL">Gender</td><td><?php echo $profiledata['gender'];?></td></tr>
			<tr><td class="proL">Location</td><td><?php echo $profiledata['location'];?></td></tr>
			<tr><td class="proL">Signed Up</td><td><?php echo unix_to_human($profiledata['signed_up']);?></td></tr>
			<tr><td class="proL">Last Login</td><td><?php echo unix_to_human($profiledata['last_login']);?></td></tr>
			<?php if($profiledata['account_type'] >= 2):?><tr><td colspan="2" class="highAccount"><img src="<?php echo base_url('assets/images/'.$profiledata['account_type']);?>" alt="Admin Account" /></td></tr><?php endif;?>
		</table>
	</div>