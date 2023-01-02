<script type="text/javascript">
$(document).ready(function() {
	var flag = 0;



	//fires when save button is clicked - checks for flag status to detect any error and for NULL fields
	$("#create").click(function(event) {

	if($("#policy_term_max").length && $("#policy_term_min").length)
	{
		if($("#policy_term_min").val()=='' || $("#policy_term_min").val()=='')
		{
			$("#err_main").html('Check For Compulsory  Fields <br>');
			$("#policy_term_min").focus();
		}
		else
		{
			$("#err_main").html('');

			if(flag==0)
			{
				$("#set_term").submit();
			}
			else
			{	
				$("#err_main").html('Check For Error');
			}
		}
	}
	

	else
	{	
		if($("#policy_term").val()=='')
		{
			$("#err_main").html('Check For Compulsory  Fields <br>');
			$("#policy_term").focus();
		}
		else
		{
			$("#err_main").html('');

			if(flag==0)
			{
				$("#set_term").submit();
			}
			else
			{	
				$("#err_main").html('Check For Error');
			}
		}
	}
		
	});


	//checking for error in policy term field for fixed term policy
	$("#policy_term").blur(function(event) {

		$("#err_policy_term").remove();
		flag = 0;

		if($("#policy_term").val()=='')
		{
			$("#policy_term").focus();
			if(flag < 1)
			{
				$("#policy_term").parent().append('<span class="err_msg" id="err_policy_term">Policy Term Cannot be left blank</span>');
			}
			else
			{
				$("#err_policy_term").html('Policy Term Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_policy_term").remove();
			flag = 0;

			var term = $("#policy_term").val();
			term = term.split(',');
			var len = term.length - 1;
			
			for(i=0; i<=len;i++)
			{
				term[i] = parseInt(term[i]);
			}

			for(i=0; i<=len;i++)
			{
				if(isNaN(term[i]))
				{
					if(flag < 1)
					{
						$("#policy_term").parent().append('<span class="err_msg" id="err_policy_term"> Please Enter Numeric Value </span>');
					}	
					flag = 1;
				}

				else
				{
					if(term[i] == 0)
					{
						if(flag < 1)
						{
							$("#policy_term").parent().append('<span class="err_msg" id="err_policy_term" > Cannot Input Zero "0" </span>');
						}	
						flag = 1;
					}
				}
			}

			if(flag == 1)
			{
				$("#policy_term").focus();
			}

			else
			{
				for(i=0; i<len;i++)
				{
					if(term[i] > term[i+1] || term[i] == term[i+1])
					{
						if(flag < 1)
						{
							$("#policy_term").parent().append('<span class="err_msg" id="err_policy_term">Invalid Data !! Term Plan Should in Ascending order </span>');
						}	
						flag = 1;
					}
				}

				if(flag == 1)
				{
					$("#policy_term").focus();
				}
				else
				{
					$("#err_policy_term").remove();
					flag = 0;
				}	
			}
		}
	});



	//checking for error in minimum term field for range term policy
	$("#policy_term_min").blur(function(event) {

		if($("#policy_term_min").val()=='')
		{
			$("#policy_term_min").focus();
			if(flag < 1)
			{
				$("#policy_term_min").parent().append('<span class="err_msg" id="err_policy_term_min">Minimum Term Cannot be left blank</span>');
			}
			else
			{
				$("#err_policy_term_min").html('Minimum Term Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_policy_term_min").remove();
			flag = 0;

			if(isNaN($("#policy_term_min").val()))
			{
				$("#policy_term_min").focus();
				if(flag < 1)
				{
					$("#policy_term_min").parent().append('<span class="err_msg" id="err_policy_term_min">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				var min_term = parseInt($("#policy_term_min").val());
				if(min_term == 0)
				{
					$("#policy_term_min").focus();
					if(flag < 1)
					{
						$("#policy_term_min").parent().append('<span class="err_msg" id="err_policy_term_min">Minimum Term Cannot be zero "0"</span>');
					}	
					flag = 1;	
				}
				else
				{
					$("#err_policy_term_min").remove();
					flag = 0;
				}
			}
		}
	});


	//checking for error in maximum term field for range term policy
	$("#policy_term_max").blur(function(event) {

		if($("#policy_term_max").val()=='')
		{
			$("#policy_term_max").focus();
			if(flag < 1)
			{
				$("#policy_term_max").parent().append('<span class="err_msg" id="err_policy_term_max">Minimum Term Cannot be left blank</span>');
			}
			else
			{
				$("#err_policy_term_max").html('Minimum Term Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_policy_term_max").remove();
			flag = 0;

			if(isNaN($("#policy_term_max").val()))
			{
				$("#policy_term_max").focus();
				if(flag < 1)
				{
					$("#policy_term_max").parent().append('<span class="err_msg" id="err_policy_term_max">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				
				var min_term = parseInt($("#policy_term_min").val());
				var max_term = parseInt($("#policy_term_max").val());

				if(max_term < min_term)
				{
					$("#policy_term_max").focus();
					if(flag < 1)
					{
						$("#policy_term_max").parent().append('<span class="err_msg" id="err_policy_term_max">Maximum Term must be greater than Minimum Term</span>');
					}	
					flag = 1;	
				}
				else
				{
					$("#err_policy_term_max").remove();
					flag = 0;
				}
			}
		}
	});

});

</script>

<div class="wrapper">
	<div class="header teal">
		Admin Panel
	</div>

	<div class="container">

		<div class="nav">
			<ul>
				<li><div class="button"><a href="<?=base_url(); ?>view/policy-view/<?=$policy['id']; ?>">Cancel</a></div></li>
			</ul>
		</div>

		
		<div class="content">
			<div class="edit-policy" style="border:0px solid #000;">
				<ul>
					<div class="err_msg" id="err_main"></div>
					<div class="special_msg">[<span class="req">*</span> Fields are Compulsory]</div><br>
					
					<form method="POST" action="" id="set_term" name="set_term" >
						<fieldset>
							<legend><?php echo($type == 'fixed') ? 'Policy Term Fixed' : 'Policy Term Range'; ?></legend>
							<li>
						<li>Policy Name : <?=$policy['policy_name']; ?></li>
						<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
						<input type="hidden" id="type" name="type" value="<?=$type; ?>">
					</li>

					<?php if($type == 'fixed') {?>
					<li>
						Policy Term <span class="req">*</span> : 
						<input type="text" name="policy_term" id="policy_term" value="<?=$term['policy_term']; ?>" size="20"/>
					</li>
					<div class="special_msg">[Value Should be Comma Separated eg:- 5,10,15,20,25 ]</div><br>
					<?php } ?>

					<?php 
					if($type == 'range') {	?>
					<li>
						Term Minimum <span class="req">*</span> : 
						<input type="text" name="policy_term_min" id="policy_term_min" value="<?=$min_term; ?>" size="1" maxlength="2"/>
					</li>
					<li>
						Term Maximum <span class="req">*</span> : 
						<input type="text" name="policy_term_max" id="policy_term_max" value="<?=$max_term; ?>" size="1" maxlength="2"/>
					</li>
					<?php } ?>

					
					<li>
						<br><input type="button" id="create" name="create" value=" Save " class="button_i"/> 
					</li>
					</fieldset>
				</form>
				</ul>
				
			</div>
		</div><!--content div -->
		<div style="clear:both"></div>

	</div>
</div>

