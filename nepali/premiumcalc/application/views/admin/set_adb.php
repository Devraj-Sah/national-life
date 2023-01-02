<script type="text/javascript">
$(document).ready(function() {
	var flag = 0;

	//fires when save button is clicked - checks for flag status to detect any error and for NULL fields
	$("#create").click(function(event) {

	if($("#adb_rate").val()=='')
	{
		$("#err_main").html('Check For Compulsory  Fields <br>');
		$("#adb_rate").focus();
	}

	if($("#max_sum_covered").val()=='')
	{
		$("#err_main").html('Check For Compulsory  Fields <br>');
		$("#max_sum_covered").focus();
	}

	else
	{	
		$("#err_main").html('');

		if(flag==0)
		{
			$("#set_adb").submit();
		}
		else
		{	
			$("#err_main").html('Check For Error');
		}
	}
		
	});


	//checking for error in ADB Rate field
	$("#adb_rate").blur(function(event) {

		if($("#adb_rate").val()=='')
		{
			$("#adb_rate").focus();
			if(flag < 1)
			{
				$("#adb_rate").parent().append('<span class="err_msg" id="err_adb_rate">ABD Rate Cannot be left blank</span>');
			}
			else
			{
				$("#err_adb_rate").html('ADB Rate Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_adb_rate").remove();
			flag = 0;

			if(isNaN($("#adb_rate").val()))
			{
				$("#adb_rate").focus();
				if(flag < 1)
				{
					$("#adb_rate").parent().append('<span class="err_msg" id="err_adb_rate">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				
				$("#err_adb_rate").remove();
				flag = 0;
			}
		}
	});
	
	
	//checking for error in min_age_criteria field
	$("#min_age_criteria_adb").blur(function(event) {

		if($("#min_age_criteria_adb").val()=='')
		{
			$("#min_age_criteria_adb").focus();
			if(flag < 1)
			{
				$("#min_age_criteria_adb").parent().append('<span class="err_msg" id="err_min_age_criteria_adb">Cannot be left blank</span>');
			}
			else
			{
				$("#err_min_age_criteria_adb").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_min_age_criteria_adb").remove();
			flag = 0;

			if(isNaN($("#min_age_criteria_adb").val()))
			{
				$("#min_age_criteria_adb").focus();
				if(flag < 1)
				{
					$("#min_age_criteria_adb").parent().append('<span class="err_msg" id="err_min_age_criteria_adb">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				
				$("#err_min_age_criteria_adb").remove();
				flag = 0;
			}
		}
	});

	//checking for error in max_age_criteria field
	$("#max_age_criteria_adb").blur(function(event) {

		if($("#max_age_criteria_adb").val()=='')
		{
			$("#max_age_criteria_adb").focus();
			if(flag < 1)
			{
				$("#max_age_criteria_adb").parent().append('<span class="err_msg" id="err_max_age_criteria_adb">Cannot be left blank</span>');
			}
			else
			{
				$("#err_max_age_criteria_adb").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_max_age_criteria_adb").remove();
			flag = 0;

			if(isNaN($("#max_age_criteria_adb").val()))
			{
				$("#max_age_criteria_adb").focus();
				if(flag < 1)
				{
					$("#max_age_criteria_adb").parent().append('<span class="err_msg" id="err_max_age_criteria_adb">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				
				$("#err_max_age_criteria_adb").remove();
				flag = 0;
			}
		}
	});

	//checking for error in min_age_criteria field
	$("#max_sum_covered").blur(function(event) {

		if($("#max_sum_covered").val()=='')
		{
			$("#max_sum_covered").focus();
			if(flag < 1)
			{
				$("#max_sum_covered").parent().append('<span class="err_msg" id="err_max_sum_covered">Cannot be left blank</span>');
			}
			else
			{
				$("#err_max_sum_covered").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_max_sum_covered").remove();
			flag = 0;

			if(isNaN($("#max_sum_covered").val()))
			{
				$("#max_sum_covered").focus();
				if(flag < 1)
				{
					$("#max_sum_covered").parent().append('<span class="err_msg" id="err_max_sum_covered">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				
				$("#err_max_sum_covered").remove();
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
					<div class="special_msg">[<span class="req">*</span> Fields are Compulsory]</div><br>

					<form method="POST" action="" id="set_adb" name="set_wop" >
						<fieldset>
							<legend>Accidental Death Benefit</legend><br>
							<li>
								<label>Policy Name : </label><span class="field_value small"><?=$policy['policy_name']; ?></span>
								<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
							</li>	
							<li>
								<label>ADB Rate <span class="req">*</span> : </label><input type="text" name="adb_rate" id="adb_rate" value="<?=$adb_rate; ?>" size="5"/>
							</li>
							<li>
								<label>Min Age Criteria  <span class="req">*</span> : </label><input type="text" name="min_age_criteria_adb" id="min_age_criteria_adb" value="<?=$min_age_criteria_adb; ?>" size="5"/>
							</li>
							<li>
								<label>Max Age Criteria  <span class="req">*</span> : </label><input type="text" name="max_age_criteria_adb" id="max_age_criteria_adb" value="<?=$max_age_criteria_adb; ?>" size="5"/>
							</li>
							<li>
								<label>Max Sum Covered  <span class="req">*</span> : </label>
								<input type="text" name="max_sum_covered" id="max_sum_covered" value="<?=$max_sum_covered; ?>" size="10"/>
								<select name="sum_covered_type" id="sum_covered_type" >
									<option value="Fixed" <?php echo ($sum_covered_type=='Fixed') ? 'selected="selected"' :'' ; ?> >Fixed</option>
									<option value="Percentage" <?php echo ($sum_covered_type=='Percentage') ? 'selected="selected"' :'' ; ?> >Percentage</option>
								</select>
								<div class="special_msg">[Enter zero '0' for NULL]</div> 
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

