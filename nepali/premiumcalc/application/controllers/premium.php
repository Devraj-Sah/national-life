<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Premium extends CI_Controller{

	public function __construct() {
		parent::__construct();
		
		//load premium model
		$this->load->model('premiummodel');

	}
	
	public function index()
	{
		$data['policies']=$this->premiummodel->loadAllPolicy();

		$data['title'] = 'Premium Calculator';
		$this->load->view('elements/header.php',$data);
		$this->load->view("default/premium_calculator",$data);
		$this->load->view("elements/footer");
	}

	public function selectPolicyById()
	{	
		if (isset($_POST['id'])) 
		{
			$id = $_POST['id'];
		
			$result = $this->premiummodel->getPolicyById($id);
			$data['policy'] = $result;
			
			$table = array(
					'wop_benefit' => 0,
					'adb_benefit' => 0,
					'total_perm_disable_benefit' => 0,
					'age_policy_rider' => 0,
					'age_secondary_insured' => 0,
					'payment_interval_option' => 0,
					'policy_term_fixed' => 0,
					'policy_term_range' => 0,
				);

			if($data['policy']['premium_paymnt_type'] == 1)
			{
				$table['payment_interval_option'] = 1;
			}
			if($data['policy']['policy_rider_secondary_insured_check'] == 1)
			{
				$table['age_policy_rider'] = 1;
			}
			if($data['policy']['policy_rider_secondary_insured_check'] == 2)
			{
				$table['age_secondary_insured'] = 1;
			}
			if($data['policy']['policy_term_check'] == 1)
			{
				$table['policy_term_fixed'] = 1;
			}
			if($data['policy']['policy_term_check'] == 2)
			{
				$table['policy_term_range'] = 1;
			}
			if($data['policy']['wop_check'] == 1)
			{
				$table['wop_benefit'] = 1;
			}
			if($data['policy']['adb_check'] == 1)
			{
				$table['adb_benefit'] = 1;
			}
			if($data['policy']['total_perm_disable_check'] == 1)
			{
				$table['total_perm_disable_benefit'] = 1;
			}

			$result = $this->premiummodel->selectPolicyById($id, $table);
			$data['policy'] = $result;
			
			echo json_encode($data['policy']);
		}
	}

	public function calculatePremium()
	{
		if(isset($_POST['id']))
		{
			$annual_premium = 0;
			$premium = 0;
			$id = $_POST['id'];
			$age_primary = $_POST['age_primary'];
			$policy_term = $_POST['policy_term'];
			$ins_amt = $_POST['ins_amt'];
			$pr_sec_ins_age = $_POST['pr_sec_ins_age'];
			$policy_int_opt = $_POST['policy_int_opt'];
			$adb = $_POST['adb'];
			$wop = $_POST['wop'];
			$total_perm_disable = $_POST['total_perm_disable'];
			$term_life_add_benefit = $_POST['term_life_add_benefit'];

			$data = $this->premiummodel->getPolicyById($id);
			
			//echo json_encode($data); //for checking purpose only
			// return;
			
			if($ins_amt < $data['min_sum'] || ($ins_amt > $data['max_sum'] && $data['max_sum'] != 0)){
				echo '<span style="font-size:14px;">This Policy is Not Applicable for the Insured amount you entered<span>';
				return;
			}

			if($age_primary < $data['min_entry_age'] || $age_primary > $data['max_entry_age']){
				echo '<span style="font-size:14px;">This Policy is Not Applicable for the age you entered for Primary Insured<span>';
				return;
			}
			

			if($data['policy_rider_secondary_insured_check'] == 2 && ($age_primary != $pr_sec_ins_age))
			{
				if($pr_sec_ins_age < $data['asi_min_age'] || $pr_sec_ins_age > $data['asi_max_age']){
					echo '<span style="font-size:14px;">This Policy is Not Applicable for the age you entered for Secondary Insured<span>';
					return;
				}
				$diff = 0;
				$age = 0;
				if($age_primary > $pr_sec_ins_age)
				{	
					$diff = $age_primary - $pr_sec_ins_age; 
					$value = $this->premiummodel->getAgeDiffValue($diff);
					$age = $pr_sec_ins_age + $value; 
				}
				if($age_primary < $pr_sec_ins_age)
				{	
					$diff = $pr_sec_ins_age - $age_primary ; 
					$value = $this->premiummodel->getAgeDiffValue($diff);
					$age = $age_primary + $value; 
				}

				if($diff > 20){
					echo '<span style="font-size:14px;">Age difference between Primary Insured and Secondary Insured cannot be greater than 20 years<span>';
					return;
				}
				
				$data1 = array('policy_id' => $id , 'entry_age' => $age , 'policy_term' => $policy_term);
			}
			else
			{
				$data1 = array('policy_id' => $id , 'entry_age' => $age_primary , 'policy_term' => $policy_term);
			}

			$result = $this->premiummodel->getRatePrimary($data1);


			if($result != false)
			{
				$rate = $result['rate'];

				$annual_premium = ($rate * $ins_amt)/$result['rate_per'];	

				if($data['rebate_check'] == 1) //for rebate benefit checking is it applicable or getting rate for premium calculation
				{
					$rebate_rate = $this->premiummodel->getRebateRate($ins_amt,$id);

					$rebateAmt = ($rebate_rate * $ins_amt)/1000;
					$annual_premium -= $rebateAmt;
				}
				
				if($data['premium_paymnt_type'] == 1) //for multiple payment type if Discount
				{
					$result = $this->premiummodel->getPaymentIntRate($id, $policy_int_opt);

					$paymentIntDis = ($result['rate'] * $annual_premium)/100;

					if($result['type'] == 'dis')
					{
						$annual_premium -= $paymentIntDis;
					}
				}

				if($data['total_perm_disable_check'] == 1 && $total_perm_disable == 'yes') //for waiver of premium benefit checking is it applicable or not and whether it is checked or not
				{	
					$result = $this->premiummodel->getTotalPermDisRate($id);

					$totalPermDisAmt = ($result['total_perm_disable_rate'] * $ins_amt)/1000;
					$annual_premium += $totalPermDisAmt;
				}


				if($data['adb_check'] == 1 && $adb == 'yes') //for accidental death benefit checking is it applicable or not and whether it is checked or not
				{
					$result = $this->premiummodel->getADBRate($id);

					if($age_primary < $result['min_age_criteria_adb'] || $age_primary > $result['max_age_criteria_adb']){
						echo '<span style="font-size:14px;">ADB Benefit is not available for the Age you entered<span>';
						return;
					}
					else
					{
						$adb_rate = $result['adb_rate'];
						$abdAmt = 0;

						if($data['premium_paymnt_type'] == 2) //for single payment type
						{
							$applicable_term_adb = $policy_term;
							if (($age_primary+$policy_term) > $result['max_age_criteria_adb']) {
								$applicable_term_adb = $result['max_age_criteria_adb'] - $age_primary+1;
							}
							$adb_rate = $adb_rate * $applicable_term_adb;
						}

						if($result['max_sum_covered']==0)
						{
							$abdAmt = ($adb_rate * $ins_amt)/1000;
						}
						else
						{
							if($result['sum_covered_type']=='Fixed')
							{
								if($ins_amt < $result['max_sum_covered'])
								{
									$abdAmt = ($adb_rate * $ins_amt)/1000;
								}
								else
								{
									$abdAmt = ($adb_rate * $result['max_sum_covered'])/1000;
								}
							}
							else
							{
								$maxSumCovered = ($ins_amt * $result['max_sum_covered'])/100;
								$abdAmt = ($adb_rate * $maxSumCovered)/1000;
							}
						}

						$annual_premium += $abdAmt;
					}
				}


				if($data['wop_check'] == 1 && $wop == 'yes') //for waiver of premium benefit checking is it applicable or not and whether it is checked or not
				{	
					$result = $this->premiummodel->getWOPRate($id);

					if($age_primary < $result['min_age_criteria_wop'] || $age_primary > $result['max_age_criteria_wop']){
						echo '<span style="font-size:14px;">WOP Benefit is not available for the Age you entered<span>';
						return;
					}
					else
					{
						$wop_rate = $result['wop_rate'];
						$wopAmt = 0;

						if($data['premium_paymnt_type'] == 2) //for single payment type
						{
							$applicable_term_wop = $policy_term;
							if (($age_primary+$policy_term) > $result['max_age_criteria_wop']) {
								$applicable_term_wop = $result['max_age_criteria_wop'] - $age_primary+1;
							}
							$wop_rate = $wop_rate * $applicable_term_wop;
						}

						$wopAmt = ($wop_rate * $ins_amt)/1000;
						$annual_premium += $wopAmt;
					}
				}


				
				if($data['term_life_additional_benefit_check'] == 1 && $term_life_add_benefit == 'yes')	//for policy rider getting rate and calculation premium
				{
					$policy_rate_term_life_add = $this->premiummodel->getRateTermLifeAdd($data1);

					$max_amt = $data['term_life_additional_benefit_max_sum_ass'] ;

					$amt = $ins_amt;

					if($ins_amt > $max_amt)
					{
						$amt = $max_amt;
					}

					$extra_premium_term_life = ($policy_rate_term_life_add['rate'] * $amt)/$policy_rate_term_life_add['rate_per'];

					$annual_premium += $extra_premium_term_life ;
				}

				if($data['policy_rider_secondary_insured_check'] == 1)	//for policy rider getting rate and calculation premium
				{
					if($pr_sec_ins_age < $data['apr_min_age'] || $pr_sec_ins_age > $data['apr_max_age']){
						echo '<span style="font-size:14px;">This Policy is Not Applicable for the age you entered for Policy Rider<span>';
						return;
					}

					$policy_rider_rate = $this->premiummodel->getPRRate($id, $pr_sec_ins_age,$policy_term);

					$proposerAmt = 0;

					if($data['proposer_max_sum_ass']==0)
					{
						$proposerAmt = ($policy_rider_rate['rate'] * $ins_amt)/$policy_rider_rate['rate_per'];
					}
					else
					{
						if($data['proposer_sum_ass_type']=='Fixed')
						{
							if($ins_amt < $data['proposer_max_sum_ass'])
							{
								$proposerAmt = ($policy_rider_rate['rate'] * $ins_amt)/$policy_rider_rate['rate_per'];
							}
							else
							{
								$proposerAmt = ($policy_rider_rate['rate'] * $data['proposer_max_sum_ass'])/$policy_rider_rate['rate_per'];
							}
						}
						else
						{
							$maxSumCovered = ($ins_amt * $data['proposer_max_sum_ass'])/100;
							$proposerAmt = ($policy_rider_rate['rate'] * $maxSumCovered)/$policy_rider_rate['rate_per'];
						}
					}

					$annual_premium +=  $proposerAmt ;
				}

				
				if($data['premium_paymnt_type'] == 1) //for multiple payment type if Loading
				{
					$result = $this->premiummodel->getPaymentIntRate($id, $policy_int_opt);

					$paymentIntChg = ($result['rate'] * $annual_premium)/100;

					if($result['type'] == 'chg')
					{
						$annual_premium = $annual_premium + $paymentIntChg;
					}
				}

				
				if($data['premium_paymnt_type'] == 1) //for multiple payment type if loading charge
				{

					if($policy_int_opt == 'yearly')
					{
						$premium = $annual_premium;
					}

					if($policy_int_opt == 'hlf-yrly')
					{
						$premium = $annual_premium/2;
					}

					if($policy_int_opt == 'qtrly')
					{
						$premium = $annual_premium/4;
					}

					if($policy_int_opt == 'monthly')
					{
						$premium = $annual_premium/12;
					}
				}

				if($data['premium_paymnt_type'] == 2) //for single payment type
				{
					$premium = $annual_premium;
				}

				echo 'Rs. '.$premium.'/-';
			}
			else
			{
				echo '<span style="font-size:14px;">This Policy is Not Applicable for the Age and Term you Selected<span>';
			}
		}
	}

}