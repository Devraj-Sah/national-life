<script type="text/javascript" src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	var flag = 0;

	if($("#rider_sec_pre_status").val() != 1)
	{
		$("#prop_sum_insur_cont").hide();
		$("#prop_percent_sum_insur_cont").hide();
	}

	

	//fires when save button is clicked - checks for flag status to detect any error and for NULL fields
	$("#create").click(function(event) {

		if($("#policy_name").val()=='' || $("#min_sum_ass").val()=='' || $("#max_sum_ass").val()=='' || $("#min_entry_age").val()=='' || $("#max_entry_age").val()=='' )
		{
			$("#err_main").html('Check For Compulsory  Fields <br>');
			$("#policy_name").focus();
		}
		else
		{	
			$("#err_main").html('');

			//reseting value for proposer sum assured fields if proposer not available
			if($("#policy_rider_sec_ins").val() != 1)
			{
				$("#proposer_max_sum_ass").val("");
				$("#proposer_sum_ass_type").val("");
			}

			if(flag==0)
			{
				$("#edit_policy").submit();
			}
			else
			{	
				$("#err_main").html('Check For Error');
			}
		}
	});


	//checking for error in max sum assured field  for Additional Term Life
	$("#term_life_additional_benefit_max_sum_ass").blur(function(event){
		if($("#term_life_additional_benefit_max_sum_ass").val()=='')
		{
			if(flag < 1)
			{
				$("#term_life_additional_benefit_max_sum_ass").parent().append('<div class="err_msg" id="err_term_life_additional_benefit_max_sum_ass">Cannot be left blank</div>');
			}
			else
			{
				$("#err_term_life_additional_benefit_max_sum_ass").html('Cannot be left blank'); 
			}
			flag = 1;
		}
		else
		{
			$("#err_term_life_additional_benefit_max_sum_ass").remove();
			flag = 0;

			if(isNaN($("#term_life_additional_benefit_max_sum_ass").val()))	//checking for numeric value
			{
				if(flag < 1)
				{
					$("#term_life_additional_benefit_max_sum_ass").parent().append('<div class="err_msg" id="err_term_life_additional_benefit_max_sum_ass">Please Enter Numeric Value</div>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_term_life_additional_benefit_max_sum_ass").remove();
				flag = 0;
			}
		}
	});


	//Toggling proposer sum assured fields if proposer not available
	$("#policy_rider_sec_ins").change(function(event) {
		if($("#policy_rider_sec_ins").val() == 1)
		{
			$("#prop_sum_insur_cont").show();
			$("#prop_percent_sum_insur_cont").show();
		}
		else
		{
			$("#prop_sum_insur_cont").hide();
			$("#prop_percent_sum_insur_cont").hide();
		}
	});


	//checking for error in proposer sum assured field if proposer exist
	$("#proposer_max_sum_ass").blur(function(event){
		if($("#proposer_max_sum_ass").val()=='')
		{
			if(flag < 1)
			{
				$("#proposer_max_sum_ass").parent().append('<div class="err_msg" id="err_proposer_max_sum_ass">Cannot be left blank</div>');
			}
			else
			{
				$("#err_proposer_max_sum_ass").html('Cannot be left blank'); 
			}
			flag = 1;
		}
		else
		{
			$("#err_proposer_max_sum_ass").remove();
			flag = 0;

			if(isNaN($("#proposer_max_sum_ass").val()))	//checking for numeric value
			{
				if(flag < 1)
				{
					$("#proposer_max_sum_ass").parent().append('<div class="err_msg" id="err_proposer_max_sum_ass">Please Enter Numeric Value</div>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_proposer_max_sum_ass").remove();
				flag = 0;
			}
		}
	});


	//checking for error in proposer sum assured percent field if proposer exist
	$("#proposer_percent_sum_ass").blur(function(event){
		if($("#proposer_percent_sum_ass").val()=='')
		{
			if(flag < 1)
			{
				$("#proposer_percent_sum_ass").parent().append('<div class="err_msg" id="err_proposer_percent_sum_ass">Cannot be left blank</div>');
			}
			else
			{
				$("#err_proposer_percent_sum_ass").html('Cannot be left blank'); 
			}
			flag = 1;
		}
		else
		{
			$("#err_proposer_percent_sum_ass").remove();
			flag = 0;

			if(isNaN($("#proposer_percent_sum_ass").val()))	//checking for numeric value
			{
				if(flag < 1)
				{
					$("#proposer_percent_sum_ass").parent().append('<div class="err_msg" id="err_proposer_percent_sum_ass">Please Enter Numeric Value</div>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_proposer_percent_sum_ass").remove();
				flag = 0;
			}
		}
	});

	
	//checking for empty policy name
	$("#policy_name").blur(function(event) {
		if($("#policy_name").val()=='') 	//checking for empty policy name
		{
			$("#policy_name").focus();
			if(flag < 1)	//checking for flag status
			{
				$("#policy_name").parent().append('<div class="err_msg" id="err_pname">Policy Name Cannot be Left Blank</div>');
			}

			flag = 1;
		}
		else
		{
			$("#err_pname").remove(); //clearing error messages from error divs
			flag = 0;
		}
	});

	//toggling policy term field and third party field
	/*$("#premium_payment").change(function(event) {
			
			if($("#premium_payment").val()==2)
			{
				$("#third_party_cont").hide();
			}
			else
			{
				$("#third_party_cont").show();
			}
			
	});*/

	//checking for error in minimum sum insured field
	$("#min_sum_ass").blur(function(event) {
		if($("#min_sum_ass").val()=='')
		{
			$("#min_sum_ass").focus();
			if(flag < 1)
			{
				$("#min_sum_ass").parent().append('<span class="err_msg" id="err_min_sum_ass">Minimum Sum Insured Cannot be left blank</span>');
			}
			else
			{
				$("#err_min_sum_ass").html('Minimum Sum Insured Cannot be left blank'); 
			}
			flag = 1;
		}
		else
		{
			$("#err_min_sum_ass").remove();
			flag = 0;

			if(isNaN($("#min_sum_ass").val()))	//checking for numeric value
			{
				$("#min_sum_ass").focus();
				if(flag < 1)
				{
					$("#min_sum_ass").parent().append('<span class="err_msg" id="err_min_sum_ass">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_min_sum_ass").remove();
				flag = 0;
			}
		}
	});


	//checking for error in maximum sum insured field 
	$("#max_sum_ass").blur(function(event) {


		if($("#max_sum_ass").val()=='') 	//checking for empty value and Disabled attribute is removed or not
		{
			$("#max_sum_ass").focus();
			if(flag < 1)
			{
				$("#max_sum_ass").parent().append('<span class="err_msg" id="err_max_sum_ass">Maximum Sum Insured Cannot be left blank</span>');
			}	
			else
			{
				$("#err_max_sum_ass").html('Maximum Sum Insured Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_max_sum_ass").remove();
			flag = 0;

			if(isNaN($("#max_sum_ass").val()))	//checking for numeric value and Disabled attribute is removed or not
			{
				$("#max_sum_ass").focus();
				if(flag < 1)
				{
					$("#max_sum_ass").parent().append('<span class="err_msg" id="err_max_sum_ass">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}
			else
			{
				var max_sum = parseInt($("#max_sum_ass").val());
				var min_sum = parseInt($("#min_sum_ass").val());

				if((max_sum < min_sum) && (max_sum != 0))	//checking whether max sum is equal or greater than min sum or not
				{
					$("#max_sum_ass").focus();
					if(flag < 1)
					{
						$("#max_sum_ass").parent().append('<span class="err_msg" id="err_max_sum_ass">Maximum Sum Insured Must Be Equal or Greater than Minimum Sum Insured</span>');
					}
					flag = 1;
				}
				else
				{
					$("#err_max_sum_ass").remove();
					flag = 0;
				}
			}
		}
	});

	//checking for error in max_sum_multiple_value field 
	$("#max_sum_multiple_value").blur(function(event) {
		if($("#max_sum_multiple_value").val()=='')
		{
			$("#max_sum_multiple_value").focus();
			if(flag < 1)
			{
				$("#max_sum_multiple_value").parent().append('<span class="err_msg" id="err_max_sum_multiple_values">Cannot be left blank</span>');
			}
			else
			{
				$("#err_max_sum_multiple_value").html('Cannot be left blank'); 
			}
			flag = 1;
		}
		else
		{
			$("#err_max_sum_multiple_value").remove();
			flag = 0;

			if(isNaN($("#max_sum_multiple_value").val()))	//checking for numeric value
			{
				$("#max_sum_multiple_value").focus();
				if(flag < 1)
				{
					$("#max_sum_multiple_value").parent().append('<span class="err_msg" id="err_max_sum_multiple_value">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_max_sum_multiple_value").remove();
				flag = 0;
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


	//checking for error in minimum entry age field
	$("#max_mature_age").blur(function(event) {

		if($("#max_mature_age").val()=='')
		{
			$("#max_mature_age").focus();
			if(flag < 1)
			{
				$("#max_mature_age").parent().append('<span class="err_msg" id="err_max_mature_age">Maximum Maturity Age Cannot be left blank</span>');
			}
			else
			{
				$("#err_max_mature_age").html('Maximum Maturity Age Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_max_mature_age").remove();
			flag = 0;

			if(isNaN($("#max_mature_age").val()))
			{
				$("#max_mature_age").focus();
				if(flag < 1)
				{
					$("#max_mature_age").parent().append('<span class="err_msg" id="err_max_mature_age">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_max_mature_age").remove();
				flag = 0;
			}
		}
	});


});

</script>

<style type="text/css">
	.content ul li,fieldset{
		margin-bottom: 25px;
	}
</style>

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

					<form method="POST" action="" id="edit_policy" name="edit_policy" >

						<fieldset>
							<legend>Policy Detail</legend><br>
							<li id="policy_name_cont">
								<label>Policy Name <span class="req">*</span> : </label>
								<br><br><input type="text" name="policy_name" id="policy_name" value="<?=$policy['policy_name']; ?>" size="72"/>
								<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
							</li>

							<li id="policy_desc_cont">
								<label>Policy Description : </label><br><br>
								<textarea name="policy_desc" id="policy_desc" ><?=$policy['policy_desc'];?></textarea>
								<script>
									CKEDITOR.replace( 'policy_desc',{ 
									height: '200px',
									enterMode :CKEDITOR.ENTER_BR 
									});
								</script>
							</li>
						</fieldset>

						<fieldset>
							<legend>Additional Benefits</legend>
							<li id="wop_cont">
								<label>WOP : </label>
								<select id="wop" name="wop">
									<option value="0" <?php echo($policy['wop_check']==0) ? 'selected="selected"': ''; ?> >No</option>
									<option value="1" <?php echo($policy['wop_check']==1) ? 'selected="selected"': ''; ?> >Yes</option>
								</select> 
								<input type="hidden" id="wop_pre_status" name="wop_pre_status" value="<?=$policy['wop_check']; ?>">
							</li>
							<li id="adb_cont">
								<label>ADB : </label>
								<select id="adb" name="adb">
									<option value="0" <?php echo($policy['adb_check']==0) ? 'selected="selected"': ''; ?> >No</option>
									<option value="1" <?php echo($policy['adb_check']==1) ? 'selected="selected"': ''; ?> >Yes</option>
								</select> 
								<input type="hidden" id="adb_pre_status" name="adb_pre_status" value="<?=$policy['adb_check']; ?>">
							</li>
							<li id="rebate_cont">
								<label>Rebate : </label>
								<select id="rebate" name="rebate">
									<option value="0" <?php echo($policy['rebate_check']==0) ? 'selected="selected"': ''; ?> >No</option>
									<option value="1" <?php echo($policy['rebate_check']==1) ? 'selected="selected"': ''; ?> >Yes</option>
								</select> 
								<input type="hidden" id="rebate_pre_status" name="rebate_pre_status" value="<?=$policy['rebate_check']; ?>">
							</li>

							<li id="total_perm_disable_cont">
								<label>Total Permanent Disablement : </label>
								<select id="total_perm_disable" name="total_perm_disable">
									<option value="0" <?php echo($policy['total_perm_disable_check']==0) ? 'selected="selected"': ''; ?> >No</option>
									<option value="1" <?php echo($policy['total_perm_disable_check']==1) ? 'selected="selected"': ''; ?> >Yes</option>
								</select> 
								<input type="hidden" id="total_perm_disable_pre_status" name="total_perm_disable_pre_status" value="<?=$policy['total_perm_disable_check']; ?>">
							</li>
						</fieldset>

						<fieldset>
							<legend>Additional Term Life</legend>
							<li id="term_life_additional_benefit_cont">
								<label>Term Life Applicable : </label>
								<select id="term_life_additional_benefit" name="term_life_additional_benefit">
									<option value="0" <?php echo($policy['term_life_additional_benefit_check']==0) ? 'selected="selected"': ''; ?> >No</option>
									<option value="1" <?php echo($policy['term_life_additional_benefit_check']==1) ? 'selected="selected"': ''; ?> >Yes</option>
								</select> 
								<input type="hidden" id="term_life_additional_benefit_pre_status" name="term_life_additional_benefit_pre_status" value="<?=$policy['term_life_additional_benefit_check']; ?>">
							</li>
							<li id="add_term_life_sum_insur_cont">
								<label>For Additional Term Life (Max Sum Insured) : </label><br><br>
								Rs. <input type="text" name="term_life_additional_benefit_max_sum_ass" id="term_life_additional_benefit_max_sum_ass" value="<?=$policy['term_life_additional_benefit_max_sum_ass']; ?>" placeholder="Max Sum Insured" size="25"/>
								<div class="special_msg">[Enter zero '0' for NULL]</div>
							</li>
						</fieldset>

						<fieldset>
							<legend>Premium Payment Type</legend>
							<li id="prem_pay_type">
								<label>Premium Payment : </label>
								<select id="premium_payment" name="premium_payment">
									<option value="1" <?php echo($policy['premium_paymnt_type']==1) ? 'selected="selected"': ''; ?> >Multiple</option>
									<option value="2" <?php echo($policy['premium_paymnt_type']==2) ? 'selected="selected"': ''; ?> >Single</option>
								</select> 
								<input type="hidden" id="perm_pay_pre_status" name="perm_pay_pre_status" value="<?=$policy['premium_paymnt_type']; ?>">
							</li>
						</fieldset>

						<fieldset>
							<legend>Proposer/Secondary Insured</legend>
							<li id="third_party_cont">
								<label>Third Party : </label>
								<select id="policy_rider_sec_ins" name="policy_rider_sec_ins">
									<option value="0" <?php echo($policy['policy_rider_secondary_insured_check']==0) ? 'selected="selected"': ''; ?> >None</option>
									<option value="1" <?php echo($policy['policy_rider_secondary_insured_check']==1) ? 'selected="selected"': ''; ?> >Policy Rider</option>
									<option value="2" <?php echo($policy['policy_rider_secondary_insured_check']==2) ? 'selected="selected"': ''; ?> >Secondary Insured</option>
								</select>
								<input type="hidden" id="rider_sec_pre_status" name="rider_sec_pre_status" value="<?=$policy['policy_rider_secondary_insured_check']; ?>" /> 
							</li>

							<li id="prop_sum_insur_cont">
								<label>For Proposer (Max Sum Insured) : </label>
								 <input type="text" name="proposer_max_sum_ass" id="proposer_max_sum_ass" value="<?=$policy['proposer_max_sum_ass']; ?>" placeholder="Max Sum Insured" size="10"/>
								<select name="proposer_sum_ass_type" id="proposer_sum_ass_type" >
									<option value="Fixed" <?php echo ($policy['proposer_sum_ass_type']=='Fixed') ? 'selected="selected"' :'' ; ?> >Fixed</option>
									<option value="Percentage" <?php echo ($policy['proposer_sum_ass_type']=='Percentage') ? 'selected="selected"' :'' ; ?> >Percentage</option>
								</select>
								<div class="special_msg">[Enter zero '0' for NULL]</div> 
							</li>
						</fieldset>

						<fieldset>
							<legend>Policy Term</legend>
							<li id="policy_term_cont">
								<label>Policy Term : </label>
								<select id="policy_term" name="policy_term">
									<option value="1" <?php echo($policy['policy_term_check']==1) ? 'selected="selected"': ''; ?> >Fixed</option>
									<option value="2" <?php echo($policy['policy_term_check']==2) ? 'selected="selected"': ''; ?> >Range</option>
								</select>
								<input type="hidden" id="policy_term_pre_status" name="policy_term_pre_status" value="<?=$policy['policy_term_check']; ?>"> 
							</li>
						</fieldset>

						<fieldset>
							<legend>Min Sum Insured</legend>
							<li id="min_sum_cont">
								<label>Minimum Sum Insured <span class="req">*</span> : </label>
								Rs. <input type="text" name="min_sum_ass" id="min_sum_ass" value="<?=$policy['min_sum']; ?>" size="25"/>
								<input type="hidden" id="min_sum_pre_status" name="min_sum_pre_status" value="<?=$policy['min_sum']; ?>">
							</li>
						</fieldset>

						<fieldset>
							<legend>Max Sum Insured</legend>
							<li id="max_sum_cont">
								<label>Amount <span class="req">*</span> : </label>Rs. 
								<input type="text" name="max_sum_ass" id="max_sum_ass" value="<?=$policy['max_sum']; ?>" size="25" />
								<input type="hidden" id="max_sum_pre_status" name="max_sum_pre_status" value="<?=$policy['max_sum']; ?>">
								<div class="special_msg">[Enter zero '0' for NULL or As Per Income]</div> 
							</li>

							<li id="max_sum_multiple_cont">
								<label>Or Multiple Of  <span class="req">*</span> : </label> 
								<input type="text" name="max_sum_multiple_value" id="max_sum_multiple_value" value="<?=$policy['max_sum_multiple_value']; ?>" size="25" />
								<input type="hidden" id="max_sum_multiple_value_pre_status" name="max_sum_multiple_value_pre_status" value="<?=$policy['max_sum_multiple_value']; ?>">
								<div class="special_msg">[If Max Sum Insured is Multiple of a value] <br><br> [Enter zero '0' for NULL]</div> 
							</li>
						</fieldset>

						<fieldset>
							<legend>Entry Ages</legend>
							<li id="min_age_cont">
								<label>Minimum Entry Age <span class="req">*</span> : </label>
								<input type="text" name="min_entry_age" id="min_entry_age" value="<?=$policy['min_entry_age']; ?>" size="1" maxlength="2"/> yrs.
								<input type="hidden" id="min_entry_age_pre_status" name="min_entry_age_pre_status" value="<?=$policy['min_entry_age']; ?>">
							</li>

							<li id="max_age_cont">
								<label>Maximum Entry Age <span class="req">*</span> : </label>
								<input type="text" name="max_entry_age" id="max_entry_age" value="<?=$policy['max_entry_age']; ?>" size="1" maxlength="2"/> yrs.
								<input type="hidden" id="max_entry_age_pre_status" name="max_entry_age_pre_status" value="<?=$policy['max_entry_age']; ?>">
							</li>
							<li id="max_age_cont">
								<label>Maximum Maturity Age <span class="req">*</span> : </label>
								<input type="text" name="max_mature_age" id="max_mature_age" value="<?=$policy['maturity_age']; ?>" size="1" maxlength="2"/> yrs.
								<div class="special_msg">[Enter zero '0' for NULL]</div>
							</li>
						</fieldset>

						<br>
						<li>
							<input type="button" id="create" name="create" value=" Save " class="button_i"/> 
						</li>
					</form>
				</ul>
				
			</div>
		</div><!--content div -->
		<div style="clear:both"></div>

	</div>
</div>

<!--
<pre>
<?php print_r($policy); ?>
</pre>
-->