<script type="text/javascript">
$(document).ready(function() {
	var flag = 1;

	//fires when save button is clicked - checks for flag status to detect any error and for NULL fields
	$("#create").click(function(event) {

	$("#err_main").html("");

	if($("#type_yr").val()=='1' || $("#type_hlfyr").val()=='1' || $("#type_qrt").val()=='1' || $("#type_mnth").val()=='1' )
	{
		flag = 0;
	}

	else
	{	
		$("#err_main").html("At least one field should be set to 'YES'<br>");

	}

	if(flag==0)
	{
		$("#set_payment_interval_option").submit();
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

					<form method="POST" action="" id="set_payment_interval_option" name="set_payment_interval_option" >
						<fieldset>
							<legend>Payment Frequency/Interval Option</legend><br>
							<li>
								<label>Policy Name : </label><span class="field_value small"><?=$policy['policy_name']; ?></span>
								<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
							</li>
							<li>
								<label>Yearly : </label>
								<select id="type_yr" name="type_yr">
									<option value="1" <?php if($payment_interval_option['yearly_check']==1) { echo 'selected="selected"';} ?> >Yes</option>
									<option value="0" <?php if($payment_interval_option['yearly_check']==0 || $payment_interval_option['yearly_check']=='') { echo 'selected="selected"';} ?>>No</option>
								</select> 
							</li>
							<li>
								<label>Half Yearly : </label>
								<select id="type_hlfyr" name="type_hlfyr">
									<option value="1" <?php if($payment_interval_option['half_yearly_check']==1) { echo 'selected="selected"';} ?> >Yes</option>
									<option value="0" <?php if($payment_interval_option['half_yearly_check']==0 || $payment_interval_option['half_yearly_check']=='') { echo 'selected="selected"';} ?>>No</option>
								</select> 
							</li>
							<li>
								<label>Quarterly : </label>
								<select id="type_qrt" name="type_qrt">
									<option value="1" <?php if($payment_interval_option['quarterly_check']==1) { echo 'selected="selected"';} ?> >Yes</option>
									<option value="0" <?php if($payment_interval_option['quarterly_check']==0 || $payment_interval_option['quarterly_check']=='') { echo 'selected="selected"';} ?>>No</option>
								</select> 
							</li>
							<li>
								<label>Monthly : </label>
								<select id="type_mnth" name="type_mnth">
									<option value="1" <?php if($payment_interval_option['monthly_check']==1) { echo 'selected="selected"';} ?> >Yes</option>
									<option value="0" <?php if($payment_interval_option['monthly_check']==0 || $payment_interval_option['monthly_check']=='') { echo 'selected="selected"';} ?>>No</option>
							
								</select> 
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
