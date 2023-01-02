<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo (isset($title)) ? $title: 'Premium Calculator' ?></title>
		<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
       <?php /* ?> <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><?php */ ?>
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/front.css">
	</head>

<script type="text/javascript">
$(document).ready(function() {
	var flag = 0;
	var rider_status = 0;
	var policy;
	$('#loading_img').hide();
	$("#policy-rider-sec-ins-age").hide();

	//fires when Calculate button is clicked - checks for flag status to detect any error and for NULL fields
	$("#calc-btn").click(function(event) {
		
		flag = 0;
			
		//reseting error messages
		$('#err_main').html('');
	
		//reseting premium-value messages
		$( "#premium-box" ).html('');
	
		if(rider_status==1)
		{
			if($("#policy_rider_sec_ins_age").val()==''|| $("#insured_amount").val()=='' || $("#age_primary").val()=='')
			{
				flag = 1;
			}	
		}

		if($("#policy_term").val()=='')
		{
			flag = 1;
		}	

		if(rider_status==0)
		{
			if($("#insured_amount").val()=='' || $("#age_primary").val()=='')
			{
				flag = 1;
			}	
		}

		if(flag==1)
		{
			$("#err_main").html('Check For Compulsory  Fields <br>');
			$("#policy_id").focus();
		}
		
		else
		{	
			$("#err_main").html('');

			if(flag==0)
			{
				//$("#set_adb").submit();
				var policy_id = $("#policy_id").val();
				var policy_term = $("#policy_term").val();
				var age_primary = $("#age_primary").val();
				var ins_amt = $("#insured_amount").val();
				var pr_sec_ins_age = $("#policy_rider_sec_ins_age").val();
				var policy_int_opt = '';
				var wop = '';
				var adb = '';
				var total_perm_disable = '';
				var term_life_add_benefit = '';

				if($("#wop").is(':checked')){ wop = $("#wop").val(); }
				if($("#adb").is(':checked')){ adb = $("#adb").val(); }
				if($("#total_perm_disable").is(':checked')){ total_perm_disable = $("#total_perm_disable").val(); }
				if($("#term_life_add_benefit").is(':checked')){ term_life_add_benefit = $("#term_life_add_benefit").val(); }

				if($("#policy_pre_int_opt").length)
				{
					policy_int_opt = $("#policy_pre_int_opt").val();
				}
				
				var position = $("#calc-btn").position();
				position = position.top - 150;
				$('#loading_img').css('top', position+'px');
				$('#loading_img').show();

				$.ajax({
				url: '<?php echo base_url(); ?>calculate',
				type: 'POST',
				data: 
					{
						id: policy_id,
						age_primary: age_primary,
						policy_term: policy_term,
						ins_amt: ins_amt,
						pr_sec_ins_age : pr_sec_ins_age,
						policy_int_opt: policy_int_opt,
						adb: adb ,
						wop: wop,
						total_perm_disable: total_perm_disable,
						term_life_add_benefit: term_life_add_benefit
					},
				success:function(data)
					{
						//policy = jQuery.parseJSON(data);
						//alert(data);	//for checking purpose only
						$( "#premium-box" ).html('<div style="margin-top:5px;">'+data+'</div>');				
					},
				complete: function()
					{
					$('#loading_img').hide();
					}
				});
			}
			else
			{	
				$("#err_main").html('Check For Error');
			}
		}
	});
	

  	$("#policy_id").change(function(event) {

  		//reseting check variables
  		flag = 0;
  		rider_status = 0;

  		//reseting error messages
		$('#err_main').html('');

		//reseting premium-value messages
		$( "#premium-box" ).html('');

  		//resetting all box to null
  		$( "#plan-term-box" ).html('');
  		$( "#age_primary" ).val('');
  		$( "#policy_rider_sec_ins_age" ).val('');
  		$("#policy-rider-sec-ins-age").hide();
  		$( "#insured_amount" ).val('');
  		$( "#payment-interval-box" ).html('');
  		$( "#adb-box" ).html('');
  		$( "#wop-box" ).html('');
  		$( "#total-perm-disable-box" ).html('');
  		$( "#term-life-add-benefit-box" ).html('');
  		$( "#policy_desc" ).html('');
  		$( "#premium-box" ).html('');
  		

  		var policy_id = $("#policy_id").val();

  		if(policy_id != '')
  		{
  			$("#calc-btn").removeAttr('disabled');

  			var position = $("#policy_id").position();
  			position = position.top + 100;
  			$('#loading_img').css('top', position+'px');
  			$('#loading_img').show();

  			$.ajax({
				url: '<?php echo base_url(); ?>policy-detail',
				type: 'POST',
				data: {id: policy_id},
				success:function(data)
				{
					//alert(data);//only for data check purpose
					policy = jQuery.parseJSON(data);

					//alert(data);//only for data check purpose

					//showing description box and inserting data
					$("#policy_desc").show();
					if(policy.policy_desc == '')
					{$("#policy_desc").html("Not Available");}
					else
					{$("#policy_desc").html(policy.policy_desc);}
					

					
					//setting terms for the policy
					if(policy.policy_term_check == 1)//for fixed terms
					{
						var str = policy.policy_term;
		  				var term = str.split(",");
		  				var len =  term.length;

		  				$("#plan-term-box").html('<label>Select Policy Term <span class="req">*</span></label><br><select name="policy_term" id="policy_term" class="" required style="width:200px"><option value="">Select Policy Term</option>');

		  				for(i=0; i<len; i++)
		  				{
		  					$("#plan-term-box select").append('<option value="'+term[i]+'">'+term[i]+'</option>');
		  				}

		  				$("#plan-term-box").append('</select> (in yrs.)<br><br>');
					}
					if(policy.policy_term_check == 2)//for range terms
					{
						var str = policy.policy_term;
		  				var term = str.split("/");
		  				term[0] = parseInt(term[0]);
		  				term[1] = parseInt(term[1]);


		  				$("#plan-term-box").html('<label>Select Policy Term <span class="req">*</span></label><br><select name="policy_term" id="policy_term" class="" required style="width:200px"><option value="">Select Policy Term</option>');

		  				for(i=term[0]; i<=term[1]; i++)
		  				{
		  					$("#plan-term-box select").append('<option value="'+ i +'">'+ i +'</option>');
		  				}
		  				$("#plan-term-box").append('</select> (in yrs.)<br><br>');
					}
					//end for policy terms


					//checking condition for policy rider option
					if(policy.policy_rider_secondary_insured_check == 1)
					{
		  				$("#policy-rider-sec-ins-age").show();
		  				$("#pr_sec_ins_label")
		  				.html(
		  				  	'Policy Proposer Age <span class="req">*</span>'
		  				);
		  				$("#policy_rider_sec_ins_age").attr('placeholder', 'Policy Rider Age');
		  				rider_status = 1;
					}

					//checking condition for Secondary rider option
					if(policy.policy_rider_secondary_insured_check == 2)
					{
		  				$("#policy-rider-sec-ins-age").show();
		  				$("#pr_sec_ins_label")
		  				.html(
		  				  	"Enter Age (Secondary Insured)"+'<span class="req">*</span>' 
		  				);
		  				$("#policy_rider_sec_ins_age").attr('placeholder', "Wife's Age or Husband's Age" );
		  				rider_status = 1;
					}

					//checking condition for premium payment interval option
					if(policy.premium_paymnt_type == 1)
					{
		  				$("#payment-interval-box").html('<label>Select Payment Interval <span class="req">*</span></label><br><select name="policy_pre_int_opt" id="policy_pre_int_opt" class="" required style="width:220px">');
		  				
		  				if(policy.yearly_check == 1)
		  				{
		  					$("#payment-interval-box select").append('<option value="yearly">Yearly</option>');
		  				}	
		  				if(policy.half_yearly_check == 1)
		  				{
		  					$("#payment-interval-box select").append('<option value="hlf-yrly">Half-Yearly</option>');
		  				}	
		  				if(policy.quarterly_check == 1)
		  				{
		  					$("#payment-interval-box select").append('<option value="qtrly">Quarterly</option>');
		  				}	
		  				if(policy.monthly_check == 1)
		  				{
		  					$("#payment-interval-box select").append('<option value="monthly">monthly</option>');
		  				}	
		  					
		  				$("#payment-interval-box").append('</select> <br><br>');
					}

					//checking condition for wop option
					if(policy.wop_check == 1)
					{
		  				$("#wop-box")
		  				.html( 
		  					'<input type="checkbox" name="wop" id="wop" value="yes">'+
							'Waiver Of Premium  '
		  				);
					}

					//checking condition for adb option
					if(policy.adb_check == 1)
					{
		  				$("#adb-box")
		  				.html( 
		  				  	'<input type="checkbox" name="adb" id="adb" value="yes" >'+
						  	'Accidental Death Benefit'
		  				);
					}

					//checking condition for total permanent disablement option
					if(policy.total_perm_disable_check == 1)
					{
		  				$("#total-perm-disable-box")
		  				.html( 
		  				  	'<input type="checkbox" name="total_perm_disable" id="total_perm_disable" value="yes" >'+
						  	'Total Permanent Disablement Benefit'
		  				);
					}
					
					//checking condition for additional term Life benefits option
					if(policy.term_life_additional_benefit_check == 1)
					{
		  				$("#term-life-add-benefit-box")
		  				.html( 
		  				  	'<input type="checkbox" name="term_life_add_benefit" id="term_life_add_benefit" value="yes" >'+
						  	'Additional Term Life Benefit'
		  				);
					}
				},
			complete: function()
				{
					$('#loading_img').hide();
				}
			});
  		}

  		//checking insurance plan field for empty
		else 
		{
			//enabling and disabling calculate button
		  	$("#calc-btn").attr('disabled', 'disabled');;
		}

  	});//main change event of select policy field

	
	

	//checking for error in age field
	$("#age_primary").blur(function(event) {

		$("#adb-box").show();
		$("#wop-box").show();

		if($("#age_primary").val()=='')
		{
			$("#age_primary").focus();
			if(flag < 1)
			{
				$("#age_primary").parent().append('<div class="err_msg" id="err_age_primary">Cannot be left blank</div>');
			}
			else
			{
				$("#err_age_primary").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_age_primary").remove();
			flag = 0;

			if(isNaN($("#age_primary").val()))
			{
				$("#age_primary").focus();
				if(flag < 1)
				{
					$("#age_primary").parent().append('<div class="err_msg" id="err_age_primary">Please Enter Numeric Value</div>');
				}	
				flag = 1;
			}
			else
			{
				var age = parseInt($("#age_primary").val()); 

				if(age < policy.min_entry_age || age > policy.max_entry_age)
				{
					$("#age_primary").focus();
					if(flag < 1)
					{
						$("#age_primary").parent().append('<div class="err_msg" id="err_age_primary">Please Enter Age between ('+policy.min_entry_age+' - '+policy.max_entry_age+') yrs.</div>');
					}	
					flag = 1;
				}
				else
				{
					$("#err_age_primary").remove();
					flag = 0;

					//hiding additional benefits when age of primary insured is less than mentioned criteria
					if(age < policy.min_age_criteria_adb || age > policy.max_age_criteria_adb)
					{
						$("#adb").removeAttr('checked');
						$("#adb-box").hide();

					}
					if(age < policy.min_age_criteria_wop || age > policy.max_age_criteria_wop)
					{
						$("#wop").removeAttr('checked');
						$("#wop-box").hide();
					}
					if(age < policy.min_age_criteria_total_perm_disable)
					{
						$("#total_perm_disable").removeAttr('checked');
						$("#total-perm-disable-box").hide();
					}
				}			
			}
		}
	});


	//checking for error in sum insured field
	$("#insured_amount").blur(function(event) {

		if($("#insured_amount").val()=='')
		{
			$("#insured_amount").focus();
			if(flag < 1)
			{
				$("#insured_amount").parent().append('<div class="err_msg" id="err_insured_amount">Cannot be left blank</div>');
			}
			else
			{
				$("#err_insured_amount").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_insured_amount").remove();
			flag = 0;

			if(isNaN($("#insured_amount").val()))
			{
				$("#insured_amount").focus();
				if(flag < 1)
				{
					$("#insured_amount").parent().append('<div class="err_msg" id="err_insured_amount">Please Enter Numeric Value</div>');
				}	
				flag = 1;
			}
			else
			{
				var sum_ins = parseInt($("#insured_amount").val()); 

				if(policy.max_sum == 0)
				{
					if(sum_ins < policy.min_sum)
					{
						$("#insured_amount").focus();
						if(flag < 1)
						{
							$("#insured_amount").parent().append('<div class="err_msg" id="err_insured_amount">Please Enter Sum Above Rs. '+policy.min_sum+' </div>');
						}	
						flag = 1;
					}
					else
					{
						if((policy.max_sum_multiple_value != 0) && (sum_ins % policy.max_sum_multiple_value != 0))
						{
							$("#insured_amount").focus();
							if(flag < 1)
							{
								$("#insured_amount").parent().append('<div class="err_msg" id="err_insured_amount">Please Enter Sum in Multiple of Rs. '+policy.max_sum_multiple_value+' </div>');
							}	
							flag = 1;
						}
						else
						{
							$("#err_insured_amount").remove();
							flag = 0;
						}
					}	
				}
				else
				{
					if(sum_ins < policy.min_sum || sum_ins > policy.max_sum)
					{
						$("#insured_amount").focus();
						if(flag < 1)
						{
							$("#insured_amount").parent().append('<div class="err_msg" id="err_insured_amount">Please Enter Sum between Rs. '+policy.min_sum+' - Rs. '+policy.max_sum+' </div>');
						}	
						flag = 1;
					}
					else
					{
						if((policy.max_sum_multiple_value != 0) && (sum_ins % policy.max_sum_multiple_value != 0))
						{
							$("#insured_amount").focus();
							if(flag < 1)
							{
								$("#insured_amount").parent().append('<div class="err_msg" id="err_insured_amount">Please Enter Sum in Multiple of Rs. '+policy.max_sum_multiple_value+' </div>');
							}	
							flag = 1;
						}
						else
						{
							$("#err_insured_amount").remove();
							flag = 0;
						}
					}	
				}			
			}
		}
	});


	//checking for error in policy rider age or secondary insured field
	$("#policy_rider_sec_ins_age").blur(function(event) {

		if($("#policy_rider_sec_ins_age").val()=='')
		{
			$("#policy_rider_sec_ins_age").focus();
			if(flag < 1)
			{
				$("#policy_rider_sec_ins_age").parent().append('<div class="err_msg" id="err_policy_rider_sec_ins_age">Cannot be left blank</div>');
			}
			else
			{
				$("#err_policy_rider_sec_ins_age").html('Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err_policy_rider_sec_ins_age").remove();
			flag = 0;

			if(isNaN($("#policy_rider_sec_ins_age").val()))
			{
				$("#policy_rider_sec_ins_age").focus();
				if(flag < 1)
				{
					$("#policy_rider_sec_ins_age").parent().append('<div class="err_msg" id="err_policy_rider_sec_ins_age">Please Enter Numeric Value</div>');
				}	
				flag = 1;
			}
			else
			{
				var age = parseInt($("#policy_rider_sec_ins_age").val());
				var age_primary = parseInt($("#age_primary").val());

				if(policy.policy_rider_secondary_insured_check == 1) 
				{
					if(age < policy.pr_min_entry_age || age > policy.pr_max_entry_age)
					{
						$("#policy_rider_sec_ins_age").focus();
						if(flag < 1)
						{
							$("#policy_rider_sec_ins_age").parent().append('<div class="err_msg" id="err_policy_rider_sec_ins_age">Please Enter Age between ('+policy.pr_min_entry_age+' - '+policy.pr_max_entry_age+') yrs.</div>');
						}	
						flag = 1;
					}
					else
					{
						$("#err_policy_rider_sec_ins_age").remove();
						flag = 0;
					}	
				}

				else if(policy.policy_rider_secondary_insured_check == 2)
				{
					if(age < policy.si_min_entry_age || age > policy.si_max_entry_age)
					{
						$("#policy_rider_sec_ins_age").focus();
						if(flag < 1)
						{
							$("#policy_rider_sec_ins_age").parent().append('<div class="err_msg" id="err_policy_rider_sec_ins_age">Please Enter Age between ('+policy.si_min_entry_age+' - '+policy.si_max_entry_age+') yrs.</div>');
						}	
						flag = 1;
					}
					else
					{
						if((age_primary - age) > 20 )
						{
							$("#policy_rider_sec_ins_age").focus();
							if(flag < 1)
							{
								$("#policy_rider_sec_ins_age").parent().append('<div class="err_msg" id="err_policy_rider_sec_ins_age">Difference of Age between Husband Age And Wife Age Cannot be greater than 20 yrs.</div>');
							}	
							flag = 1;
						}
						else
						{
							$("#err_policy_rider_sec_ins_age").remove();
							flag = 0;
						}
					}	
				}			
			}
		}
	});

});//end main-document ready function

</script>

<style type="text/css">
body{
	background-image: url('<?php echo base_url(); ?>/assets/img/logo.jpg');
}

</style>

<body>