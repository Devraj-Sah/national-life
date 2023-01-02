<style type="text/css">
/* TABLES */ 
table {border-collapse:collapse;border-spacing:0;width:100%;display:table;}
table,th,td {border:none;}
table thead th {font-size: 16px;font-weight: 600;}
table.w3-bordered tr {border-bottom:1px solid #d0d0d0;}
table.w3-striped tbody tr:nth-child(odd) {background-color:#f2f2f2;}
table.w3-hoverable tbody tr {transition:background-color .25s ease;}
table.w3-hoverable tbody tr:hover {background-color:#f2f2f2;}
table.w3-centered tr th,table.w3-centered tr td {text-align:center;}
thead.w3-bordered {border-bottom:1px solid #d0d0d0;}
table.w3-table td,th {padding:6px 8px;display:table-cell;text-align:left;vertical-align:top;}
table.w3-table th:first-child,table.w3-table td:first-child {padding-left:16px;}
</style>

<script type="text/javascript">
$(document).ready(function() {
	var flag = 0;
	var cond_count = parseInt($("#cond_count").val());


	//fires when Add More button is clicked -Adds new row of input fields at last position
	$("#add_more").click(function(event) {
		$("#err_main").html('');
		if($("#rebate_rate-"+cond_count).val() == '' || $("#min_amt-"+cond_count).val() == '' || $("#max_amt-"+cond_count).val() == '')
		{	
			$("#err_main").html('Cannot Add More Fill all the Current Empty Fields <br>');
			$("#rebate_rate-"+cond_count).focus();
		}

		else
		{
			if($("#max_amt-"+cond_count).val() != 0 && flag != 1)
			{
				cond_count +=1;
				$("#cond_count").val(cond_count);
				$("tbody").append
				(
					'<tr id="'+cond_count+'">'+
						'<td>#</td>'+
						'<td><input type="text" class="rebate_rate" name="rebate_rate-'+cond_count+'" id="rebate_rate-'+cond_count+'" value="" size="5" placeholder="Rebate Rate"/></td>'+
						'<td><input type="text" class="min_amt" name="min_amt-'+cond_count+'" id="min_amt-'+cond_count+'" value="" size="7" placeholder="Min Amount"/></td>'+
						'<td><input type="text" class="max_amt" name="max_amt-'+cond_count+'" id="max_amt-'+cond_count+'" value="" size="7" placeholder="Max Amount"/></td>'+
					'</tr>'
				);
			}
			else
			{
				if(flag == 1)
				{
					$("#err_main").html('Check For Any Error <br>');	
				}
				else
				{
					$("#err_main").html('Cannot Add More Max Amount is set to Null <br>');	
				}
			}
		}
	});

	//fires when Remove button is clicked - Removes last row of fields
	$("#remove").click(function(event) {
		
		if(cond_count != 1)
		{
			$('#'+cond_count).remove();
			cond_count -=1;
			$("#cond_count").val(cond_count);
		}
		else
			{$("#err_main").html('Cannot Remove this row <br>');}
		
	});


	//fires when save button is clicked - checks for flag status to detect any error and for NULL fields
	$("#create").click(function(event) {

		$("#err_main").html('');
		if($("#rebate_rate-"+cond_count).val() == '' || $("#min_amt-"+cond_count).val() == '' || $("#max_amt-"+cond_count).val() == '')
		{	
			$("#err_main").html('Cannot Save Fill all the Current Empty Fields <br>');
			$("#rebate_rate-"+cond_count).focus();
		}
		else
		{	
			$("#err_main").html('');
			if(flag==0)
			{
				$("#set_rebate").submit();
			}
			else
			{	
				$("#err_main").html('Check For Any Error');
			}
		}
		
	});


	//checking for error in rate fields
	$( document ).on( 'blur', '.rebate_rate', function(event){
		if($(this).val()=='')
		{
			$(this).focus();
			if(flag < 1)
			{
				$(this).parent().append('<div class="err_msg" id="err">Rate Cannot be left blank</div>');
			}
			else
			{
				$("#err").html('Rate Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err").remove();
			flag = 0;

			if(isNaN($(this).val()))
			{
				$(this).focus();
				if(flag < 1)
				{
					$(this).parent().append('<div class="err_msg" id="err">Please Enter Numeric Value</div>');
				}	
				flag = 1;
			}
			else
			{	
				$("#err").remove();
				flag = 0;
			}
		}
	});


	//checking for error in min amt fields
	$( document ).on( 'blur', '.min_amt', function(event){
		if($(this).val()=='')
		{
			$(this).focus();
			if(flag < 1)
			{
				$(this).parent().append('<div class="err_msg" id="err">Min Amount Cannot be left blank</div>');
			}
			else
			{
				$("#err").html('Min Amount Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err").remove();
			flag = 0;

			if(isNaN($(this).val()))
			{
				$(this).focus();
				if(flag < 1)
				{
					$(this).parent().append('<div class="err_msg" id="err">Please Enter Numeric Value</div>');
				}	
				flag = 1;
			}
			else
			{	
				

				var count = $(this).attr('id');
				count = count.split('-');

				if(count[1]==1)
				{
					var min_sum_ins = parseInt($("#min_sum").val());
					var amt_curr = parseInt($(this).val());

					if(amt_curr < min_sum_ins)
					{
						$(this).focus();
						if(flag < 1)
						{
							$(this).parent().append('<div class="err_msg" id="err">Amount Should not be less than Minimum Sum Insured Rs.'+min_sum_ins+'</div>');
						}	
						flag = 1;
					}
				}

				else
				{
					count_pre = count[1]-1;

					if($("#max_amt-"+count_pre).length)
					{
						var min_amt_curr = parseInt($(this).val());
						var max_amt_pre = parseInt($("#max_amt-"+count_pre).val());
					
						if(min_amt_curr != max_amt_pre)
						{
							$(this).focus();
							if(flag < 1)
							{
								$(this).parent().append('<div class="err_msg" id="err">Min Amount Should be Equal to Previous Max Amount</div>');
							}	
							flag = 1;
						}

						else
						{
							$("#err").remove();
							flag = 0;
						}
					}
				}
			}
		}
	});


	//checking for error in max amt fields
	$( document ).on( 'blur', '.max_amt', function(event){
		if($(this).val()=='')
		{
			$(this).focus();
			if(flag < 1)
			{
				$(this).parent().append('<div class="err_msg" id="err">Max Amount Cannot be left blank</div>');
			}
			else
			{
				$("#err").html('Max Amount Cannot be left blank');
			}
			flag = 1;
		}
		else
		{
			$("#err").remove();
			flag = 0;

			if(isNaN($(this).val()))
			{
				$(this).focus();
				if(flag < 1)
				{
					$(this).parent().append('<div class="err_msg" id="err">Please Enter Numeric Value</div>');
				}	
				flag = 1;
			}
			else
			{	
				var count = $(this).attr('id');
				count = count.split('-');
				var min_amt = parseInt($('#min_amt-'+count[1]).val());
				var max_amt = parseInt($(this).val());

				if(max_amt <= min_amt && max_amt != 0)
				{
					$(this).focus();
					if(flag < 1)
					{
						$(this).parent().append('<div class="err_msg" id="err">Max Amount Should be greater than Min Amount</div>');
					}	
					flag = 1;
					
				}
				else
				{
					$("#err").remove();
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
					<div class="special_msg">[<span class="req">*</span> Fields are Compulsory]</div>
					<div class="special_msg">[Enter zero '0' for NULL]</div> <br>

					<form method="POST" action="" id="set_rebate" name="set_rebate" >
						
						<fieldset>
							<legend>Rebate Conditions</legend>
							<li>
								Policy Name : <?=$policy['policy_name']; ?>
								<input type="hidden" id="policy_id" name="policy_id" value="<?=$policy['policy_id']; ?>">
								<input type="hidden" id="min_sum" name="min_sum" value="<?=$sum_insured['min_sum']; ?>">
								<input type="hidden" id="cond_count" name="cond_count" value="<?=$cond_count; ?>">
							</li>
							<li>
								<table class="w3-table w3-bordered w3-striped">
									<thead>
										<tr>
											<th></th>
											<th>Rebate Rate</th>
											<th>Min Amount</th>
											<th>Max Amount</th>
										</tr>
									</thead>
									<tbody>
									<?php 
										$n = 1;
										foreach ($rebate_rate as $rate): 
									?>
										<tr id="<?=$n; ?>">
											<td><?php if($n == 1){ echo '<span class="req">*</span>';} ?> #</td>
											<td><input type="text" class="rebate_rate"  name="rebate_rate-<?=$n; ?>" id="rebate_rate-<?=$n; ?>" value="<?=$rate['rebate_rate']; ?>" size="5" placeholder="Rebate Rate"/></td>
											<td>
												<input type="text" class="min_amt" name="min_amt-<?=$n; ?>" id="min_amt-<?=$n; ?>" value="<?=$rate['min_amt']; ?>" size="7" />
											</td>
											<td><input type="text" class="max_amt" name="max_amt-<?=$n; ?>" id="max_amt-<?=$n; ?>" value="<?=$rate['max_amt']; ?>" size="7" placeholder="Max Amount"/></td>
										</tr>
									<?php 
										$n++;
										endforeach; 
									?>
									</tbody>	
								</table>
							</li>
							<li>
								<br><input type="button" id="add_more" name="add_more" value=" Add More " class="button_i"/> 
								<input type="button" id="remove" name="remove" value=" Remove " class="button_i"/> 
								<input type="button" id="create" name="create" value=" Save " class="button_i"/> 
							</li>
						</fieldset>
						
					</form>
				</ul>
			</div>
		</div><!--content div -->
		<div style="clear:both"></div>

	</div>
</div>


