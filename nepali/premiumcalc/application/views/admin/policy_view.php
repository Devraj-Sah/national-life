<script type="text/javascript">

$(document).ready(function() {
	var err_flag = 0;

	//checking all the data necessary for a policy has been saved/created , if not then set err_flag to 1 i.e. "error"
	if($("#policy_rate_btn").length && $("#policy_rate_btn").attr('data-avail'))
	{
		err_flag = 1;
	}

	if($("#policy_rider_rate_btn").length && $("#policy_rider_rate_btn").attr('data-avail'))
	{
		err_flag = 1;
	}

	if($("#term_life_add_benefit_rate_btn").length && $("#term_life_add_benefit_rate_btn").attr('data-avail'))
	{
		err_flag = 1;
	}


	if($("#policy_term_fixed_btn").length && $("#policy_term_fixed_btn").attr('data-avail'))
	{
		err_flag = 1;
	}


	if($("#policy_term_range_btn").length && $("#policy_term_range_btn").attr('data-avail'))
	{
		err_flag = 1;
	}


	if($("#wop_btn").length && $("#wop_btn").attr('data-avail'))
	{
		err_flag = 1;
	}


	if($("#adb_btn").length && $("#adb_btn").attr('data-avail'))
	{
		err_flag = 1;
	}


	if($("#rebate_btn").length && $("#rebate_btn").attr('data-avail'))
	{
		err_flag = 1;
	}

	if($("#total_perm_dis_btn").length && $("#total_perm_dis_btn").attr('data-avail'))
	{
		err_flag = 1;
	}


	if($("#policy_rider_age_btn").length && $("#policy_rider_age_btn").attr('data-avail'))
	{
		err_flag = 1;
	}


	if($("#sec_ins_age_btn").length && $("#sec_ins_age_btn").attr('data-avail'))
	{
		err_flag = 1;
	}


	if($("#payment_int_opt_btn").length && $("#payment_int_opt_btn").attr('data-avail'))
	{
		err_flag = 1;
	}

	if($("#payment_int_rate_btn").length && $("#payment_int_rate_btn").attr('data-avail'))
	{
		err_flag = 1;
	}



	//checking for err_flag status to see error (0-no error 1-error)
	if(err_flag == 1)
	{
		$('#activate').bind('click', false);//binding click event to activate link/btn and setting it to false
	}

	else if(err_flag == 0)
	{
		$('#activate').unbind('click', false);//un-binding click event to activate link/btn which was set to false earlier
	}

});
</script>

<div class="wrapper">
	<div class="header teal">
		Admin Panel
	</div>

	<div class="container">

		<div class="nav">
			<div>
				<div class="nav-title">MAIN NAVIGATION</div>
				<ul>
					<li><div class="button"><a href="<?=base_url(); ?>admin.html">View All Plans</a></div></li>
					<li><div class="button"><a href="<?=base_url(); ?>edit/edit-policy/<?=$policy['id']; ?>">Edit</a></div></li>
					<li><div class="button"><a href="javascript:void(0);" onclick="confirm_delete('<?=base_url(); ?>delete-policy/<?=$policy['id']; ?>');">Delete</a></div></li>
				</ul>
			</div>

			<br><br>
			<div>
				<div class="nav-title">SUB NAVIGATION</div>
				<ul>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>upload-rate/<?=$policy['id']; ?>" <?php if($check['policy_rate_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="policy_rate_btn">
								Upload Policy Rate
							</a>
						</div>
					</li>

					<?php if($policy['policy_rider_secondary_insured_check']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>upload-policy-rider-rate/<?=$policy['id']; ?>" <?php if($check['policy_rider_rate_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="policy_rider_rate_btn">
								Upload Policy Rider Rate
							</a>
						</div>
					</li>
					<?php } ?>

					<?php if($policy['term_life_additional_benefit_check']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>upload-policy-rate-term-life-additional/<?=$policy['id']; ?>" <?php if($check['term_life_additional_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="term_life_add_benefit_rate_btn">
								Upload Rate For Additional Term Life
							</a>
						</div>
					</li>
					<?php } ?>

					<?php if($policy['policy_term_check']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>set-policy-term/fixed/<?=$policy['id']; ?>" <?php if($check['term_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="policy_term_fixed_btn">
								Policy Term Fixed
							</a>
						</div>
					</li>
					<?php } ?>

					<?php if($policy['policy_term_check']==2){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>set-policy-term/range/<?=$policy['id']; ?>" <?php if($check['term_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="policy_term_range_btn">
								Policy Term Range
							</a>
						</div>
					</li>
					<?php } ?>


					<?php if($policy['wop_check']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>wop/<?=$policy['id']; ?>" <?php if($check['wop_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="wop_btn">
								WOP Rate
							</a>
						</div>
					</li>
					<?php } ?>

					<?php if($policy['adb_check']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>adb/<?=$policy['id']; ?>" <?php if($check['adb_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="adb_btn">
								ADB Rate
							</a>
						</div>
					</li>
					<?php } ?>

					<?php if($policy['rebate_check']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>rebate/<?=$policy['id']; ?>" <?php if($check['rebate_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="rebate_btn">
								Rebate Rate
							</a>
						</div>
					</li>
					<?php } ?>


					<?php if($policy['total_perm_disable_check']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>total-perm-dis-rate/<?=$policy['id']; ?>" <?php if($check['total_perm_disable_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="total_perm_dis_btn">
								Total Permanent Disablement Rate
							</a>
						</div>
					</li>
					<?php } ?>


					<?php if($policy['policy_rider_secondary_insured_check']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>set-age-other/policy-rider/<?=$policy['id']; ?>" <?php if($check['policy_rider_age_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="policy_rider_age_btn">
								Policy Rider Age
							</a>
						</div>
					</li>
					<?php } ?>

					<?php if($policy['policy_rider_secondary_insured_check']==2){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>set-age-other/sec-insured/<?=$policy['id']; ?>" <?php if($check['sec_insu_age_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="sec_ins_age_btn">
								Secondary Insured Age
							</a>
						</div>
					</li>
					<?php } ?>
					

					<?php if($policy['premium_paymnt_type']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>payment-interval-option/<?php echo $policy['id']; if($check['pay_int_opt_avail_check']==1) echo '/edit'?>" <?php if($check['pay_int_opt_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="payment_int_opt_btn">
								Payment Interval Options
							</a>
						</div>
					</li>
					<?php } ?>

					<?php if($policy['premium_paymnt_type']==1){ ?>
					<li>
						<div class="button">
							<a href="<?=base_url(); ?>payment-interval-rate/<?=$policy['id']; ?>" <?php if($check['pay_int_rate_avail_check']==0){echo 'style="background-color:#CC0000"'.' data-avail="no"';}?> id="payment_int_rate_btn">
								Payment Interval Rate
							</a>
						</div>
					</li>
					<?php } ?>

					<li>
						<div class="button">
							<a href="<?php echo($policy['active_status'] == 0)? base_url().'activate-policy/'.$policy['id'] : base_url().'deactivate-policy/'.$policy['id']; ?>" <?php if($policy['active_status']==0){echo 'style="background-color:#CC0000"';}?> id="activate">
								<?php echo ($policy['active_status']==1) ? 'Deactivate': 'Activate' ; ?>
							</a>
						</div>
					</li>
				</ul>
			</div>
		</div>




		<div class="content">
			<div class="policy_view">
				<?php 

					if($this->session->userdata('flash_msg_err')!='')
					{
						echo '<div class="flash_msg_err">'.$this->session->userdata('flash_msg_err').'</div>';
						$this->session->unset_userdata('flash_msg_err');
					}

					elseif($this->session->userdata('flash_msg_succ')!='')
					{
						echo '<div class="flash_msg_succ">'.$this->session->userdata('flash_msg_succ').'</div>';
						$this->session->unset_userdata('flash_msg_succ');
					}
					
				?>
				<ul class="policy_view">
					<fieldset>
						<legend>Policy Detail</legend><br>
					<li><label>Policy Name : </label><div class="space"></div><div class="field_value"><?=$policy['policy_name']; ?></div></li>
					<li><label>Policy Description : </label><div class="space"></div><div class="field_value"><?=$policy['policy_desc']; ?></div></li>
					<li><label>WOP : </label><span class="field_value small"><?php echo($policy['wop_check']==1) ? 'Yes': 'No'; ?></span></li>
					<li><label>ADB : </label><span class="field_value small"><?php echo($policy['adb_check']==1) ? 'Yes': 'No'; ?></span></li>
					<li><label>Rebate : </label><span class="field_value small"><?php echo($policy['rebate_check']==1) ? 'Yes': 'No'; ?></span></li>
					<li><label>Total Permanent Disablement : </label><span class="field_value small"><?php echo($policy['total_perm_disable_check']==1) ? 'Yes': 'No'; ?></span></li>

					<li><label>Additional Term Life Benefit : </label><span class="field_value small"><?php echo($policy['term_life_additional_benefit_check']==1) ? 'Yes': 'No'; ?></span></li>
					<li><label>Max Sum For Additional Term Life Benefit : </label><span class="field_value small">Rs. <?php echo $policy['term_life_additional_benefit_max_sum_ass']; ?></span></li>

					<li><label>Premiums Payments : </label><span class="field_value small"><?php echo($policy['premium_paymnt_type']==1) ? 'Multiple': 'Single'; ?></span></li>

					<?php if($policy['policy_rider_secondary_insured_check'] !=3) { ?>
					<li>
						<label>Third Party : </label>
						<span class="field_value small">
						<?php 
							if($policy['policy_rider_secondary_insured_check']==0)
							{echo 'None';} 
							else if($policy['policy_rider_secondary_insured_check']==1)
							{echo 'Policy Rider';} 
							else if($policy['policy_rider_secondary_insured_check']==2)
							{echo 'Secondary Insured';} 
						?>
						</span>
					</li>
					<?php } ?>
					
					<?php if($policy['policy_rider_secondary_insured_check']==1){ ?>
					<li>
						<label>For Proposer (Max Sum Insured) : </label><span class="field_value small"> Rs. <?=$policy['proposer_max_sum_ass']; ?> (<?=$policy['proposer_sum_ass_type']; ?>) </span>
					</li>
				
					<?php } ?>

					<li>
						<label>Policy Term : </label>
						<span class="field_value small">
						<?php 
							if($policy['policy_term_check']==1)
							{echo 'FIXED'; }
							elseif($policy['policy_term_check']==2) 
							{echo 'RANGE';} 
						?>
						</span>
					</li>
					
					<li><label>Minimum Sum Insured : </label><span class="field_value small">Rs. <?php echo $policy['min_sum']; ?></span></li>
					<li><label>Maximum Sum Insured : </label><span class="field_value small"><?php if($policy['max_sum'] == 0) {echo 'As Per Income';} else{ echo 'Rs. '.$policy['max_sum'];} ?></span></li>
					<li><label>Or Maximum Sum Insured Multiple Of: </label><span class="field_value small">Rs. <?=$policy['max_sum_multiple_value']; ?></span></li>
					<li><label>Minimum Entry Age : </label><span class="field_value small"><?php echo $policy['min_entry_age']; ?> yrs.</span></li>
					<li><label>Maximum Entry Age : </label><span class="field_value small"><?php echo $policy['max_entry_age']; ?> yrs.</span></li>
					<li><label>Maximum Maturity Age : </label><span class="field_value small"><?php echo $policy['maturity_age']; ?> yrs.</span></li>
					<li><label>Active State : </label><span class="field_value small"><?php echo($policy['active_status']==1) ? 'Active': 'Inactive'; ?></span></li>
					</fieldset>
				</ul>
			</div>
		</div><!--content div -->

		<div style="clear:both"></div>

	</div>
</div>



<pre>
	<?php //print_r($check); ?>
	<?php //print_r($policy); ?>
</pre>



