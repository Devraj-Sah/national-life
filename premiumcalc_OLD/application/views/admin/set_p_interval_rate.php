<script type="text/javascript">
$(document).ready(function() {
	var flag = 0;

	//fires when save button is clicked - checks for flag status to detect any error and for NULL fields
	$("#create").click(function(event) {
		$("#err_main").html('');

	if($("#yr_rate").val()=='' || $("#hlfyr_rate").val()=='' || $("#qrt_rate").val()=='' || $("#mnth_rate").val()=='')
	{
		$("#err_main").html('Check For Compulsory  Fields <br>');
		$("#yr_rate").focus();
		flag = 1;
	}
	else
	{	
		$("#err_main").html('');
		if(flag==0)
		{
			$("#set_p_int_rate").submit();
		}
		else
		{	
			$("#err_main").html('Check For Error');
		}
	}
		
	});


	//checking for error in Yearly Rate field
	$("#yr_rate").blur(function(event) {

		if($("#yr_rate").val()=='')
		{
			$("#yr_rate").focus();
			if(flag < 1)
			{
				$("#yr_rate").parent().append('<span class="err_msg" id="err_yr_rate">Rate For Yearly Cannot be left blank</span>');
			}
			else
			{
				$("#err_yr_rate").html('Rate For Yearly Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_yr_rate").remove();
			flag = 0;

			if(isNaN($("#yr_rate").val()))
			{
				$("#yr_rate").focus();
				if(flag < 1)
				{
					$("#yr_rate").parent().append('<span class="err_msg" id="err_yr_rate">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}

			else
			{
				$("#err_yr_rate").remove();
				flag = 0;
			}
		}
	});

	//checking for error in Half Yearly Rate field
	$("#hlfyr_rate").blur(function(event) {

		if($("#hlfyr_rate").val()=='')
		{
			$("#hlfyr_rate").focus();
			if(flag < 1)
			{
				$("#hlfyr_rate").parent().append('<span class="err_msg" id="err_hlfyr_rate">Rate For Half Yearly Cannot be left blank</span>');
			}
			else
			{
				$("#err_hlfyr_rate").html('Rate For Half Yearly Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_hlfyr_rate").remove();
			flag = 0;

			if(isNaN($("#hlfyr_rate").val()))
			{
				$("#hlfyr_rate").focus();
				if(flag < 1)
				{
					$("#hlfyr_rate").parent().append('<span class="err_msg" id="err_hlfyr_rate">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_hlfyr_rate").remove();
				flag = 0;
			}
		}
	});

	//checking for error in Quarterly Rate field
	$("#qrt_rate").blur(function(event) {

		if($("#qrt_rate").val()=='')
		{
			$("#qrt_rate").focus();
			if(flag < 1)
			{
				$("#qrt_rate").parent().append('<span class="err_msg" id="err_qrt_rate">Rate For Quarterly Cannot be left blank</span>');
			}
			else
			{
				$("#err_qrt_rate").html('Rate For Quarterly Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_qrt_rate").remove();
			flag = 0;

			if(isNaN($("#qrt_rate").val()))
			{
				$("#qrt_rate").focus();
				if(flag < 1)
				{
					$("#qrt_rate").parent().append('<span class="err_msg" id="err_qrt_rate">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_qrt_rate").remove();
				flag = 0;
			}
		}
	});

	//checking for error in Monthly Rate field
	$("#mnth_rate").blur(function(event) {

		if($("#mnth_rate").val()=='')
		{
			$("#mnth_rate").focus();
			if(flag < 1)
			{
				$("#mnth_rate").parent().append('<span class="err_msg" id="err_mnth_rate">Rate For Monthly Cannot be left blank</span>');
			}
			else
			{
				$("#err_mnth_rate").html('Rate For Monthly Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_mnth_rate").remove();
			flag = 0;

			if(isNaN($("#mnth_rate").val()))
			{
				$("#mnth_rate").focus();
				if(flag < 1)
				{
					$("#mnth_rate").parent().append('<span class="err_msg" id="err_mnth_rate">Please Enter Numeric Value</span>');
				}	
				flag = 1;
			}
			else
			{
				$("#err_mnth_rate").remove();
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
					<div class="special_msg">[<span class="req">*</span> Fields are Compulsory]</div> 
					<div class="special_msg">[Enter zero '0' for No Charge/Discount]</div><br>
					<form method="POST" action="" id="set_p_int_rate" name="set_p_int_rate" >
						<fieldset>
							<legend>Charges/Discount For Payment Intervals</legend><br>
							<li>
								<label>Policy Name : </label><span class="field_value small"><?=$policy['policy_name']; ?></span>
								<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
							</li>
							<?php if($payment_interval_option['check_available']==1) { ?>
							<li>
								<?php if($payment_interval_option['yearly_check']==1) { ?>
								<label>Rate For Yearly <span class="req">*</span> : </label><input type="text" name="yr_rate" id="yr_rate" value="<?=$payment_interval_rate['yearly_rate'] ;?>" size="5"/>
								<select id="type_yr" name="type_yr">
									<option value="dis" <?php if($payment_interval_rate['type_yearly']=='dis') {echo 'selected="selected"';} ?> >Discount</option>
									<option value="chg" <?php if($payment_interval_rate['type_yearly']=='chg') {echo 'selected="selected"';} ?>>Charge</option>
								</select> 
								<?php } ?>
							</li>
							<li>
								<?php if($payment_interval_option['half_yearly_check']==1) { ?>
								<label>Rate For Half Yearly <span class="req">*</span> : </label><input type="text" name="hlfyr_rate" id="hlfyr_rate" value="<?=$payment_interval_rate['half_yearly_rate'] ;?>" size="5"/>
								<select id="type_hlfyr" name="type_hlfyr">
									<option value="dis" <?php if($payment_interval_rate['type_half_yearly']=='dis') {echo 'selected="selected"';} ?> >Discount</option>
									<option value="chg" <?php if($payment_interval_rate['type_half_yearly']=='chg') {echo 'selected="selected"';} ?>>Charge</option>
								</select> 
								<?php } ?>
							</li>
							<li>
								<?php if($payment_interval_option['quarterly_check']==1) { ?>
								<label>Rate For Quarterly <span class="req">*</span> : </label><input type="text" name="qrt_rate" id="qrt_rate" value="<?=$payment_interval_rate['quarterly_rate'] ;?>" size="5"/>
								<select id="type_qrt" name="type_qrt">
									<option value="chg" <?php if($payment_interval_rate['type_quarterly']=='chg') {echo 'selected="selected"';} ?>>Charge</option>
									<option value="dis" <?php if($payment_interval_rate['type_quarterly']=='dis') {echo 'selected="selected"';} ?> >Discount</option>
								</select> 
								<?php } ?>
							</li>
							<li>
								<?php if($payment_interval_option['monthly_check']==1) { ?>
								<label>Rate For Monthly <span class="req">*</span> : </label><input type="text" name="mnth_rate" id="mnth_rate" value="<?=$payment_interval_rate['monthly_rate'] ;?>" size="5"/>
								<select id="type_mnth" name="type_mnth">
									<option value="chg" <?php if($payment_interval_rate['type_monthly']=='chg') {echo 'selected="selected"';} ?>>Charge</option>
									<option value="dis" <?php if($payment_interval_rate['type_monthly']=='dis') {echo 'selected="selected"';} ?> >Discount</option>
								</select> 
								<?php } ?>
							</li>
							<li>
								<br><input type="button" id="create" name="create" value=" Save " class="button_i"/> 
							</li>
							<?php } ?>

							<?php if($payment_interval_option['check_available']==0){ echo '<div class="err_msg" style="font-size:16px;">Please Set Payment Interval Options</div>';} ?>
						</fieldset>
					</form>
				</ul>
			</div>
		</div><!--content div -->
		<div style="clear:both"></div>
	</div>
</div>

