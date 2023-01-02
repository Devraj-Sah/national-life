

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo (isset($title)) ? $title: 'Premium Calculator' ?></title>
		<!--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">-->
		<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/admin.css">

		<script type="text/javascript">
			function confirm_delete(query)
			{
				if(confirm("Are you sure you want to delete this Policy ?"))
				{
					window.location = query;
				}
			}
		</script>
	</head>
<body>


	<?php
	if (isset($this->session->userdata['loggedin'])) 
	{
	?>
	<div class="userinfo">
		<div>
			Welcome 
			<a href="<?=base_url(); ?>admin.html"><span style="font-weight:600;color:#CC0000"><?=strtoupper($this->session->userdata['loggedin']['username']);?></span></a> 
			| Email :- <?=$this->session->userdata['loggedin']['email'];?> 
			| <a href="<?=base_url(); ?>admin-logout.html">Logout</a>
			| <a href="<?=base_url(); ?>change-password">Change Password</a>
			| <a href="<?=base_url(); ?>change-email">Change Email</a> 
		</div>
	</div>
	<?php } ?>
	