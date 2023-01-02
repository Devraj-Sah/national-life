<script type="text/javascript">
$(document).ready(function() {
	var flag = 0;

	//fires when save button is clicked - checks for flag status to detect any error and for NULL fields
	$("#create").click(function(event) {

	if($("#total_perm_disable_rate").val()=='')
	{
		$("#err_main").html('Check For Compulsory  Fields <br>');
		$("#total_perm_disable_rate").focus();
	}
	else
	{	
		$("#err_main").html('');

		if(flag==0)
		{
			$("#set_total_disable_perm").submit();
		}
		else
		{	
			$("#err_main").html('Check For Error');
		}
	}
		
	});


	//checking for error in WOP Rate field
	$("#total_perm_disable_rate").blur(function(event) {

		if($("#total_perm_disable_rate").val()=='')
		{
			$("#total_perm_disable_rate").focus();
			if(flag < 1)
			{
				$("#total_perm_disable_rate").parent().append('<span class="err_msg" id="err_total_perm_disable_rate">Cannot be left blank</span>');
			}
			else
			{
				$("#err_total_perm_disable_rate").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_total_perm_disable_rate").remove();
			flag = 0;

			if(isNaN($("#total_perm_disable_rate").val()))
			{
				$("#total_perm_disable_rate").focus();
				if(flag < 1)
				{
					$("#total_perm_disable_rate").parent().append('<span class="err_msg" id="err_total_perm_disable_rate">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{	
				$("#err_total_perm_disable_rate").remove();
				flag = 0;
			}
		}
	});
	
	
	//checking for error in min_age_criteria_total_perm_disable field
	$("#min_age_criteria_total_perm_disable").blur(function(event) {

		if($("#min_age_criteria_total_perm_disable").val()=='')
		{
			$("#min_age_criteria_total_perm_disable").focus();
			if(flag < 1)
			{
				$("#min_age_criteria_total_perm_disable").parent().append('<span class="err_msg" id="err_min_age_criteria_total_perm_disable">Cannot be left blank</span>');
			}
			else
			{
				$("#err_min_age_criteria_total_perm_disable").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_min_age_criteria_total_perm_disable").remove();
			flag = 0;

			if(isNaN($("#min_age_criteria_total_perm_disable").val()))
			{
				$("#min_age_criteria_total_perm_disable").focus();
				if(flag < 1)
				{
					$("#min_age_criteria_total_perm_disable").parent().append('<span class="err_msg" id="err_min_age_criteria_total_perm_disable">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{	
				$("#err_min_age_criteria_total_perm_disable").remove();
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

					<form method="POST" action="" id="set_total_disable_perm" name="set_total_disable_perm" >
						<fieldset>
							<legend>Total Permanent Disablement</legend><br>
							<li>
								<label>Policy Name : </label><span class="field_value small"><?=$policy['policy_name']; ?></span>
								<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
							</li>
							<li>
								<label>Total Permanent Disable Rate <span class="req">*</span> : </label><input type="text" name="total_perm_disable_rate" id="total_perm_disable_rate" value="<?=$total_perm_disable_rate; ?>" size="5"/>
							</li>
							<li>
								<label>Min Age Criteria  <span class="req">*</span> : </label><input type="text" name="min_age_criteria_total_perm_disable" id="min_age_criteria_total_perm_disable" value="<?=$min_age_criteria_total_perm_disable; ?>" size="5"/>
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

