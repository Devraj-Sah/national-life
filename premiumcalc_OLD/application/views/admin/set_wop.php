<script type="text/javascript">
$(document).ready(function() {
	var flag = 0;

	//fires when save button is clicked - checks for flag status to detect any error and for NULL fields
	$("#create").click(function(event) {

	if($("#wop_rate").val()=='')
	{
		$("#err_main").html('Check For Compulsory  Fields <br>');
		$("#wop_rate").focus();

	}

	else
	{	
		$("#err_main").html('');

		if(flag==0)
		{
			$("#set_wop").submit();
		}
		else
		{	
			$("#err_main").html('Check For Error');
		}
	}
		
	});


	//checking for error in WOP Rate field
	$("#wop_rate").blur(function(event) {

		if($("#wop_rate").val()=='')
		{
			$("#wop_rate").focus();
			if(flag < 1)
			{
				$("#wop_rate").parent().append('<span class="err_msg" id="err_wop_rate">WOP Rate Cannot be left blank</span>');
			}
			else
			{
				$("#err_wop_rate").html('WOP Rate Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_wop_rate").remove();
			flag = 0;

			if(isNaN($("#wop_rate").val()))
			{
				$("#wop_rate").focus();
				if(flag < 1)
				{
					$("#wop_rate").parent().append('<span class="err_msg" id="err_wop_rate">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{	
				$("#err_wop_rate").remove();
				flag = 0;
			}
		}
	});
	
	
	//checking for error in min_age_criteria_wop field
	$("#min_age_criteria_wop").blur(function(event) {

		if($("#min_age_criteria_wop").val()=='')
		{
			$("#min_age_criteria_wop").focus();
			if(flag < 1)
			{
				$("#min_age_criteria_wop").parent().append('<span class="err_msg" id="err_min_age_criteria_wop">Cannot be left blank</span>');
			}
			else
			{
				$("#err_min_age_criteria_wop").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_min_age_criteria_wop").remove();
			flag = 0;

			if(isNaN($("#min_age_criteria_wop").val()))
			{
				$("#min_age_criteria_wop").focus();
				if(flag < 1)
				{
					$("#min_age_criteria_wop").parent().append('<span class="err_msg" id="err_min_age_criteria_wop">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				
				$("#err_min_age_criteria_wop").remove();
				flag = 0;
			}
		}
	});


	//checking for error in max_age_criteria_wop field
	$("#max_age_criteria_wop").blur(function(event) {

		if($("#max_age_criteria_wop").val()=='')
		{
			$("#max_age_criteria_wop").focus();
			if(flag < 1)
			{
				$("#max_age_criteria_wop").parent().append('<span class="err_msg" id="err_max_age_criteria_wop">Cannot be left blank</span>');
			}
			else
			{
				$("#err_max_age_criteria_wop").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_max_age_criteria_wop").remove();
			flag = 0;

			if(isNaN($("#max_age_criteria_wop").val()))
			{
				$("#max_age_criteria_wop").focus();
				if(flag < 1)
				{
					$("#max_age_criteria_wop").parent().append('<span class="err_msg" id="err_max_age_criteria_wop">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				
				$("#err_max_age_criteria_wop").remove();
				flag = 0;
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
					<div class="special_msg">[<span class="req">*</span> Fields are Compulsory]</div> <br>

					<form method="POST" action="" id="set_wop" name="set_wop" >
						<fieldset>
							<legend>Waiver Of Premium</legend><br>
							<li>
								<label>Policy Name : </label><span class="field_value small"><?=$policy['policy_name']; ?></span>
								<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
							</li>
							<li>
								<label>WOP Rate <span class="req">*</span> : </label><input type="text" name="wop_rate" id="wop_rate" value="<?=$wop_rate; ?>" size="5"/>
							</li>
							<li>
								<label>Min Age Criteria  <span class="req">*</span> : </label><input type="text" name="min_age_criteria_wop" id="min_age_criteria_wop" value="<?=$min_age_criteria_wop; ?>" size="5"/>
							</li>
							<li>
								<label>Max Age Criteria  <span class="req">*</span> : </label><input type="text" name="max_age_criteria_wop" id="max_age_criteria_wop" value="<?=$max_age_criteria_wop; ?>" size="5"/>
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

