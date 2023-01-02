<script type="text/javascript">
$(document).ready(function() {
	var flag = 0;

	//fires when save button is clicked - checks for flag status to detect any error and for NULL fields
	$("#create").click(function(event) {

	if($("#min_entry_age").val()=='' || $("#max_entry_age").val()=='')
	{
		$("#err_main").html('Check For Compulsory  Fields <br>');
		$("#min_entry_age").focus();
	}

	else
	{	
		$("#err_main").html('');

		if(flag==0)
		{
			$("#set_age").submit();
		}
		else
		{	
			$("#err_main").html('Check For Error');
		}
	}
		
	});


	//checking for error in minimum entry age field
	$("#min_entry_age").blur(function(event) {

		if($("#min_entry_age").val()=='')
		{
			$("#min_entry_age").focus();
			if(flag < 1)
			{
				$("#min_entry_age").parent().append('<span class="err_msg" id="err_min_entry_age">Minimum Entry Age Cannot be left blank</span>');
			}
			else
			{
				$("#err_min_entry_age").html('Minimum Entry Age Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_min_entry_age").remove();
			flag = 0;

			if(isNaN($("#min_entry_age").val()))
			{
				$("#min_entry_age").focus();
				if(flag < 1)
				{
					$("#min_entry_age").parent().append('<span class="err_msg" id="err_min_entry_age">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_min_entry_age").remove();
				flag = 0;
			}
		}
	});

	//checking for error in maximum entry age field
	$("#max_entry_age").blur(function(event) {

		if($("#max_entry_age").val()=='')
		{
			$("#max_entry_age").focus();
			if(flag < 1)
			{
				$("#max_entry_age").parent().append('<span class="err_msg" id="err_max_entry_age">Maximum Entry Age Cannot be left blank</span>');
			}
			else
			{
				$("#err_max_entry_age").html('Maximum Entry Age Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_max_entry_age").remove();
			flag = 0;

			if(isNaN($("#max_entry_age").val()))
			{
				$("#max_entry_age").focus();
				if(flag < 1)
				{
					$("#max_entry_age").parent().append('<span class="err_msg" id="err_max_entry_age">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				var max_age = parseInt($("#max_entry_age").val());
				var min_age = parseInt($("#min_entry_age").val());

				if(max_age < min_age || max_age == min_age)		//checking whether max_entry age is greater than min entry age or not
				{
					$("#max_entry_age").focus();
					if(flag < 1)
					{
						$("#max_entry_age").parent().append('<span class="err_msg" id="err_max_entry_age">Maximum Entry Age Must Be Greater than Minimum Entery Age</span>');
					}
					flag = 1;
				}
				else
				{
					$("#err_max_entry_age").remove();
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

					<form method="POST" action="" id="set_age" name="set_age" >
						<fieldset>
							<legend><?php echo($type == 'policy-rider') ? 'Policy Rider Age' : 'Secondary Insured Age'; ?></legend>
							<li>
						<li>Policy Name : <?=$policy['policy_name']; ?></li>
						<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
						<input type="hidden" id="type" name="type" value="<?=$type; ?>">
					</li>

					<li>
						Minimum Entry Age <span class="req">*</span> : 
						<input type="text" name="min_entry_age" id="min_entry_age" value="<?=$age['min_entry_age']; ?>" size="1" maxlength="2"/> yrs.
					</li>

					<li>
						Maximum Entry Age <span class="req">*</span> : 
						<input type="text" name="max_entry_age" id="max_entry_age" value="<?=$age['max_entry_age']; ?>" size="1" maxlength="2"/> yrs.
					</li>
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

