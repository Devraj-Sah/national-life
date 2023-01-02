

	
<div class="wrapper">
	<header>
		National Life Premium Calculator
	</header>
	<div id="loading_img"><img src="<?=base_url(); ?>assets/img/load_img.gif"  alt="Loading Please Wait"/></div>
	<div class="container">
		<div class="err_msg" id="err_main"></div>
		<div class="special_msg">[<span class="req">*</span> Fields are Compulsory]</div><br>


		<form action="" id="premium_calculator">
			
			
			
			<div class="">
				<label>Select Insurance Policy</label>
				<select name="policy_id" id="policy_id"  required style="width:95%">
					<option value="">--Select Insurance Policy--</option>
					<?php foreach($policies as $policy): ?>
					<option value="<?=$policy['id']; ?>"><?=$policy['policy_name']; ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<br><br>
			<div id="desc-box" class="cont-box">
				<label>Policy Description</label>
				<div class="cont-box-inner" id="policy_desc">
				</div>
			</div>

			<br>
			<div class="" id="plan-term-box"></div>

			
			<div class="" id="age-box"><label>Enter Age (Primary Insured) <span class="req">*</span></label> <br><input type="text" id="age_primary" name="age_primary" style="width:250px"  placeholder="Age of Insured Person" maxlength="2"/> (in yrs.)</div>

			<br>
			<div class="" id="insured-amt-box"><label>Enter Insured Amount <span class="req">*</span></label><br><input type="number" id="insured_amount" name="insured_amount" placeholder="Insured Amount"/> (in NRs.)</div>

			<br>
			<div class="" id="policy-rider-sec-ins-age"><label id="pr_sec_ins_label"></label><br><input type="text" name="policy_rider_sec_ins_age" id="policy_rider_sec_ins_age" style="width:270px;" maxlength="2"/></div>

			<br>
			<div class="" id="payment-interval-box"></div>

			<div class="cont-box" >
				<label>Additional Benefits</label>
				<div class="cont-box-inner">
					<div class="" id="adb-box"></div><br>
					<div class="" id="wop-box"></div>
					<div class="" id="total-perm-disable-box"></div>
					<div class="" id="term-life-add-benefit-box"></div>
				</div>
			</div>

			<br>
			<div class="" id=""><input type="button" id="calc-btn" value=" Calculate " disabled><br></div>

			<br>
			<div class="cont-box" >
				<label>Total Premium Payable</label>
				<div class="cont-box-inner" id="premium-box">
				
				</div>
			</div>

			<div style="clear:both;"></div>

		</form>
	</div>

</div>
