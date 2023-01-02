<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin extends CI_Controller
{
	public function __construct() {
		parent::__construct();

		$this->load->model('admin_model');
		
	}
	
	public function index()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}
		
		else
		{
			$data['policy_list'] = $this->admin_model->loadPolicyList();

			$hdata['title'] = 'Admin Panel';
			$this->load->view('elements/header_back',$hdata);
			$this->load->view('admin/admin_page',$data);
			$this->load->view('elements/footer_back');
		}
	}	

	public function createPolicy()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		if(isset($_POST['policy_name']))
		{
			$policy_list_data = array(
							'policy_name' => $_POST['policy_name'] , 
							'policy_desc' => $_POST['policy_desc'] , 
							'wop_check' => $_POST['wop'] , 
							'adb_check' => $_POST['adb'] , 
							'rebate_check' => $_POST['rebate'] ,
							'total_perm_disable_check' => $_POST['total_perm_disable'] , 
							'term_life_additional_benefit_check' => $_POST['term_life_additional_benefit'] , 
							'term_life_additional_benefit_max_sum_ass' => $_POST['term_life_additional_benefit_max_sum_ass'] , 
							'premium_paymnt_type' => $_POST['premium_payment'] , 
							'policy_rider_secondary_insured_check' => $_POST['policy_rider_sec_ins'],
							'proposer_max_sum_ass' => $_POST['proposer_max_sum_ass'],
							'proposer_sum_ass_type' => $_POST['proposer_sum_ass_type'],
							'policy_term_check' => $_POST['policy_term'],
							'maturity_age' => $_POST['max_mature_age'] , 
						 );
		
			/*if($_POST['premium_payment'] == 1 )
			{	
				$policy_list_data['policy_rider_secondary_insured_check'] = $_POST['policy_rider_sec_ins'];
			}
			elseif ($_POST['premium_payment'] == 2 ) {
				$policy_list_data['policy_rider_secondary_insured_check'] = 3;
			}*/


			$sum_insured = array('min_sum' => $_POST['min_sum_ass'], 'max_sum' => $_POST['max_sum_ass'], 'max_sum_multiple_value' => $_POST['max_sum_multiple_value']);
			$primary_entry_age = array('min_entry_age' => $_POST['min_entry_age'], 'max_entry_age' => $_POST['max_entry_age']);

			$id = $this->admin_model->savePolicy($policy_list_data, $sum_insured, $primary_entry_age);

			if($id != '')
			{
				$msg = 'Successfully Created New Policy';
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$id);
			}

			else
			{
				$msg = 'Failed Creation of New Policy Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('admin.html');
			}
		}

		else
		{	

			$hdata['title'] = 'Create Policy';
			$this->load->view('elements/header_back',$hdata);
			$this->load->view('admin/create_policy');
			$this->load->view('elements/footer_back');
		}
	}


	public function viewPolicyById()
	{	
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$type = $this->uri->segment(2);
		$id = $this->uri->segment(3);
		
		$result = $this->admin_model->getPolicyByIdFUll($id);
		$data['policy'] = $result['policy'];
		unset($result['policy']);
		$data['check'] = $result;

		$hdata['title'] = 'Policy Details';
		$this->load->view('elements/header_back',$hdata);
		$this->load->view('admin/policy_view',$data);
		$this->load->view('elements/footer_back');
	}

	public function editPolicyById()
	{	
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$id = $this->uri->segment(3);

		if(isset($_POST['policy_id']))
		{
			$id = $_POST['policy_id'];

			$change = array('policy_id' => $_POST['policy_id'], 'wop' => 0, 'adb' => 0, 'rebate' => 0, 'premium_paymt' => 0, 'rider_sec' => 0, 'policy_term' => 0, 'min_sum' => 0, 'max_sum' => 0, 'min_entry_age' => 0, 'max_entry_age' => 0, 'term_life_additional_benefit'=>0, 'total_perm_disable'=>0);

			if($_POST['wop']!=$_POST['wop_pre_status'])
			{
				$change['wop'] = 1;
			}

			if($_POST['adb']!=$_POST['adb_pre_status'])
			{
				$change['adb'] = 1;
			}

			if($_POST['rebate']!=$_POST['rebate_pre_status'])
			{
				$change['rebate'] = 1;
			}

			if($_POST['premium_payment']!=$_POST['perm_pay_pre_status'])
			{
				$change['premium_paymt'] = 1;
			}

			if($_POST['policy_rider_sec_ins']!=$_POST['rider_sec_pre_status'])
			{
				$change['rider_sec'] = 1;
			}

			if($_POST['policy_term']!=$_POST['policy_term_pre_status'])
			{
				$change['policy_term'] = 1;
			}

			if($_POST['min_sum_ass']!=$_POST['min_sum_pre_status'])
			{
				$change['min_sum'] = 1;
			}

			if($_POST['max_sum_ass']!=$_POST['max_sum_pre_status'])
			{
				$change['max_sum'] = 1;
			}

			if($_POST['max_sum_multiple_value']!=$_POST['max_sum_multiple_value_pre_status'])
			{
				$change['max_sum_multiple_value'] = 1;
			}

			if($_POST['min_entry_age']!=$_POST['min_entry_age_pre_status'])
			{
				$change['min_entry_age'] = 1;
			}

			if($_POST['max_entry_age']!=$_POST['max_entry_age_pre_status'])
			{
				$change['max_entry_age'] = 1;
			}

			if($_POST['total_perm_disable']!=$_POST['total_perm_disable_pre_status'])
			{
				$change['total_perm_disable'] = 1;
			}
			
			if($_POST['term_life_additional_benefit']!=$_POST['term_life_additional_benefit_pre_status'])
			{
				$change['term_life_additional_benefit'] = 1;
			}

			$policy_list_data_pre = array(
							'total_perm_disable_check' => $_POST['total_perm_disable_pre_status'], 
							'premium_paymnt_type' => $_POST['perm_pay_pre_status'], 
							'policy_rider_secondary_insured_check' => $_POST['rider_sec_pre_status'],
							'policy_term_check' => $_POST['policy_term_pre_status'],
							);

			$policy_list_data_curr = array(
							'policy_name' => $_POST['policy_name'] , 
							'policy_desc' => $_POST['policy_desc'] , 
							'wop_check' => $_POST['wop'] , 
							'adb_check' => $_POST['adb'] , 
							'rebate_check' => $_POST['rebate'] , 
							'total_perm_disable_check' => $_POST['total_perm_disable'] , 
							'term_life_additional_benefit_check' => $_POST['term_life_additional_benefit'] , 
							'term_life_additional_benefit_max_sum_ass' => $_POST['term_life_additional_benefit_max_sum_ass'] , 
							'premium_paymnt_type' => $_POST['premium_payment'] , 
							'policy_rider_secondary_insured_check' => $_POST['policy_rider_sec_ins'],
							'proposer_max_sum_ass' => $_POST['proposer_max_sum_ass'],
							'proposer_sum_ass_type' => $_POST['proposer_sum_ass_type'],
							'policy_term_check' => $_POST['policy_term'],
							'maturity_age' => $_POST['max_mature_age'] , 
						 );
		
			/*if($_POST['premium_payment'] == 1 )
			{	
				$policy_list_data_curr['policy_rider_secondary_insured_check'] = $_POST['policy_rider_sec_ins'];
			}
			elseif ($_POST['premium_payment'] == 2 ) 
			{
				$policy_list_data_curr['policy_rider_secondary_insured_check'] = 3;
			}*/

			$sum_insured_curr = array('min_sum' => $_POST['min_sum_ass'], 'max_sum' => $_POST['max_sum_ass'], 'max_sum_multiple_value' => $_POST['max_sum_multiple_value']);
			$primary_age_curr = array('min_entry_age' => $_POST['min_entry_age'], 'max_entry_age' => $_POST['max_entry_age']);

			$result = $this->admin_model->editPolicy($id, $change, $policy_list_data_pre, $policy_list_data_curr, $sum_insured_curr, $primary_age_curr);

			if($result)
			{
				$msg = 'Successfully Updated Policy';
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$id);
			}
			else
			{
				$msg = 'Failed Updation Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('view/policy-view/'.$id);
			}
		}

		else
		{
			$type = $this->uri->segment(2);
		
			$result = $this->admin_model->getPolicyByIdFUll($id);
			$data['policy'] = $result['policy'];
			unset($result['policy']);
			$data['check'] = $result;

			$hdata['title'] = 'Edit Policy';
			$this->load->view('elements/header_back',$hdata);
			$this->load->view('admin/edit_policy',$data);
			$this->load->view('elements/footer_back');
		}
	}

	public function setTotalPermDis()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$id = $this->uri->segment(2);
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if($data['policy']['total_perm_disable_check'] == 0)
		{
			$msg = 'Total Permanent Disablement Benefit is not applicable for this policy';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}

		if(isset($_POST['total_perm_disable_rate']))
		{
			$data_ins = array('policy_id' => $_POST['policy_id'] , 'total_perm_disable_rate' => $_POST['total_perm_disable_rate'] , 'min_age_criteria_total_perm_disable' => $_POST['min_age_criteria_total_perm_disable']);
			$result = $this->admin_model->saveTotalPermDisRate($data_ins);

			if($result==true)
			{
				$msg = 'Successfully Updated Total Permanent Disablement Rate';
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$msg = 'Failed Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
		}

		else
		{	
			$result = $this->admin_model->getTotalPermDisRateById($id);
			
			if($result != false)
				{	
					$data['total_perm_disable_rate'] = $result['total_perm_disable_rate']; 
					$data['min_age_criteria_total_perm_disable'] = $result['min_age_criteria_total_perm_disable']; 
				}
			else
				{	
					$data['total_perm_disable_rate'] = '';
					$data['min_age_criteria_total_perm_disable'] = '';
				}

			$headerdata['title'] = 'Edit Total Permanent Disablement';
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/set_total_perm_disablement',$data);
			$this->load->view('elements/footer_back');
		}
	}

	public function setWOP()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$id = $this->uri->segment(2);
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if($data['policy']['wop_check'] == 0)
		{
			$msg = 'WOP is not applicable for this policy';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}

		if(isset($_POST['wop_rate']))
		{
			$data_ins = array('policy_id' => $_POST['policy_id'] , 'wop_rate' => $_POST['wop_rate'] , 'min_age_criteria_wop' => $_POST['min_age_criteria_wop'], 'max_age_criteria_wop' => $_POST['max_age_criteria_wop'] );
			$result = $this->admin_model->saveWOP($data_ins);

			if($result==true)
			{
				$msg = 'Successfully Updated WOP Rate';
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$msg = 'Failed Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
		}

		else
		{	
			$result = $this->admin_model->getWOPById($id);
			
			if($result != false)
				{	
					$data['wop_rate'] = $result['wop_rate']; 
					$data['min_age_criteria_wop'] = $result['min_age_criteria_wop']; 
					$data['max_age_criteria_wop'] = $result['max_age_criteria_wop']; 
				}
			else
				{	
					$data['wop_rate'] = '';
					$data['min_age_criteria_wop'] = '';
					$data['max_age_criteria_wop'] = '';
				}

			$headerdata['title'] = 'Edit WOP';
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/set_wop',$data);
			$this->load->view('elements/footer_back');
		}
	}

	public function setADB()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$id = $this->uri->segment(2);
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if($data['policy']['adb_check'] == 0)
		{
			$msg = 'ADB is not applicable for this policy';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}

		if(isset($_POST['adb_rate']))
		{
			$data_ins = array('policy_id' => $_POST['policy_id'] , 'adb_rate' => $_POST['adb_rate'] , 'min_age_criteria_adb' => $_POST['min_age_criteria_adb'],'max_age_criteria_adb' => $_POST['max_age_criteria_adb'], 'max_sum_covered' => $_POST['max_sum_covered'], 'sum_covered_type' => $_POST['sum_covered_type']);
			$result = $this->admin_model->saveADB($data_ins);

			if($result==true)
			{
				$msg = 'Successfully Updated ADB Rate';
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$msg = 'Failed Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
		}

		else
		{	
			$result = $this->admin_model->getADBById($id);

			if($result != false)
				{	
					$data['adb_rate'] = $result['adb_rate']; 
					$data['min_age_criteria_adb'] = $result['min_age_criteria_adb']; 
					$data['max_age_criteria_adb'] = $result['max_age_criteria_adb']; 
					$data['max_sum_covered'] = $result['max_sum_covered']; 
					$data['sum_covered_type'] = $result['sum_covered_type']; 

				}
			else
				{	
					$data['adb_rate'] = '';
					$data['min_age_criteria_adb'] = '';
					$data['max_age_criteria_adb'] = '';
					$data['max_sum_covered'] = ''; 
					$data['sum_covered_type'] = ''; 

				}

			$headerdata['title'] = 'Edit ADB';
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/set_adb',$data);
			$this->load->view('elements/footer_back');
		}
	}


	public function setPaymentIntervalOption()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		//$mode = $this->uri->segment(3);

		$id = $this->uri->segment(2);
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if($data['policy']['premium_paymnt_type'] != 1)
		{
			$msg = 'Payment Interval Option is not applicable for this policy';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}

		if(isset($_POST['policy_id']))
		{
			$data_ins = array('policy_id' => $_POST['policy_id'], 'yearly_check' => $_POST['type_yr'], 'half_yearly_check' => $_POST['type_hlfyr'], 'quarterly_check' => $_POST['type_qrt'], 'monthly_check' => $_POST['type_mnth']);

			$result = $this->admin_model->savePaymentIntervalOption($data_ins);

			if($result != false)
			{
				$msg = 'Successfully Updated Payment Interval Option';
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}

			else
			{
				$msg = 'Failed Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
		}

		else
		{
			$result = $this->admin_model->getPaymentIntervalOptionById($id);

			if($result != false)
				{	$data['payment_interval_option'] = $result; }
			else
			{	
				$data['payment_interval_option']['yearly_check'] = '';
				$data['payment_interval_option']['half_yearly_check'] = '';
				$data['payment_interval_option']['quarterly_check'] = '';
				$data['payment_interval_option']['monthly_check'] = '';
			}

			$headerdata['title'] = 'Edit Payment Interval Option';
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/set_p_interval_option',$data);
			$this->load->view('elements/footer_back');
		}
	}



	public function setPaymentIntervalRate()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$id = $this->uri->segment(2);
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if($data['policy']['premium_paymnt_type'] != 1)
		{
			$msg = 'Payment Interval Rate is not applicable for this policy';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}

		if(isset($_POST['policy_id']))
		{
			$data_ins['policy_id'] = $_POST['policy_id'];

			if(isset($_POST['yr_rate']))
			{
				$data_ins['yearly_rate'] = $_POST['yr_rate'];
				$data_ins['type_yearly'] = $_POST['type_yr'];
			}

			if(isset($_POST['hlfyr_rate']))
			{
				$data_ins['half_yearly_rate'] = $_POST['hlfyr_rate'];
				$data_ins['type_half_yearly'] = $_POST['type_hlfyr'];
			}

			if(isset($_POST['qrt_rate']))
			{
				$data_ins['quarterly_rate'] = $_POST['qrt_rate'];
				$data_ins['type_quarterly'] = $_POST['type_qrt'];
			}

			if(isset($_POST['mnth_rate']))
			{
				$data_ins['monthly_rate'] = $_POST['mnth_rate'];
				$data_ins['type_monthly'] = $_POST['type_mnth'];
			}


			
			$result = $this->admin_model->savePaymentIntervalRate($data_ins);
			if($result != false)
			{
				$msg = 'Successfully Updated Payment Interval Rates';
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$msg = 'Failed Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
		}

		else
		{
			$result1 = $this->admin_model->getPaymentIntervalRateById($id);
			$result2 = $this->admin_model->getPaymentIntervalOptionById($id);

			if($result1 != false)
			{	$data['payment_interval_rate'] = $result1; }
			else
			{
				$data['payment_interval_rate']['yearly_rate'] = '';
				$data['payment_interval_rate']['type_yearly'] = '';
				$data['payment_interval_rate']['half_yearly_rate'] = '';
				$data['payment_interval_rate']['type_half_yearly'] = '';
				$data['payment_interval_rate']['quarterly_rate'] = '';
				$data['payment_interval_rate']['type_quarterly'] = '';
				$data['payment_interval_rate']['monthly_rate'] = '';
				$data['payment_interval_rate']['type_monthly'] = '';
			}
			
			if($result2 != false)
			{	
				$data['payment_interval_option'] = $result2;
				$data['payment_interval_option']['check_available'] = 1;
			}
			else
			{
				$data['payment_interval_option']['check_available'] = 0;
				$data['payment_interval_option']['yearly_check'] = '';
				$data['payment_interval_option']['half_yearly_check'] = '';
				$data['payment_interval_option']['quarterly_check'] = '';
				$data['payment_interval_option']['monthly_check'] = '';	
			}

			$headerdata['title'] = 'Edit Payment Interval Rate';
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/set_p_interval_rate',$data);
			$this->load->view('elements/footer_back');
		}
	}

	public function setRebate()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$id = $this->uri->segment(2);
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if($data['policy']['rebate_check'] == 0)
		{
			$msg = 'Rebate is not applicable for this policy';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}

		if(isset($_POST['policy_id']))
		{
			$count = $_POST['cond_count'];
			$data_ins = array();
			for($i = 1; $i <= $count; $i++)
			{
				$data_ins[$i]['policy_id'] = $_POST['policy_id'] ;
				$data_ins[$i]['rebate_rate'] = $_POST['rebate_rate-'.$i] ;
				$data_ins[$i]['min_amt'] = $_POST['min_amt-'.$i] ;
				$data_ins[$i]['max_amt'] = $_POST['max_amt-'.$i] ;
			}

			$result = $this->admin_model->saveRebateRate($data_ins);

			if($result != false)
			{
				$msg = 'Successfully Updated Rebate Rates and Condition';
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$msg = 'Failed Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}	
		}

		else
		{	
			$result = $this->admin_model->getRebateById($id);
			$data['sum_insured'] = $this->admin_model->getSumInsuredById($id);

			if($result != false)
			{	
				$data['rebate_rate'] = $result;
				$data['cond_count'] = count($result);
			}
			else
			{	
				$data['cond_count'] = 1;
				$data['rebate_rate'][0]['id'] = '';
				$data['rebate_rate'][0]['policy_id'] = '';
				$data['rebate_rate'][0]['rebate_rate'] = '';
				$data['rebate_rate'][0]['min_amt'] = '';
				$data['rebate_rate'][0]['max_amt'] = '';
			}

			$headerdata['title'] = 'Edit Rebate Condition';
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/set_rebate',$data);
			$this->load->view('elements/footer_back');
		}
	}


	public function setAgeOther()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$type = $this->uri->segment(2);
		$id = $this->uri->segment(3);	
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if($data['policy']['policy_rider_secondary_insured_check'] == 0 || $data['policy']['policy_rider_secondary_insured_check'] == 3)
		{
			$msg = 'This feature is not applicable for this policy';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}

		if(isset($_POST['policy_id']))
		{
			$data_ins = array('type' => $_POST['type'], 'policy_id' => $_POST['policy_id'], 'min_entry_age' => $_POST['min_entry_age'], 'max_entry_age' => $_POST['max_entry_age']);
			$result = $this->admin_model->saveOtherAge($data_ins);

			if($_POST['type'] == 'policy-rider')
			{
				$type = 'Policy Rider Age';	
			}

			elseif ($_POST['type'] == 'sec-insured') {
				$type = 'Secondary Insured Age';	
			}

			if($result != false)
			{
				$msg = 'Successfully Updated '.$type;
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$msg = 'Failed Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}	
		}

		else
		{
			$result = $this->admin_model->getOtherAge($type, $id);
			$data['type'] = $type;

			if($result != false)
			{	
				$data['age'] = $result;
			}
			else
			{	
				$data['age']['min_entry_age'] = '';
				$data['age']['max_entry_age'] = '';
			}


			if($type == 'policy-rider')
			{
				$headerdata['title'] = 'Edit Policy Rider Age';	
			}

			elseif ($type == 'sec-insured') {
				$headerdata['title'] = 'Edit Secondary Insured Age';	
			}

			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/set_age_other',$data);
			$this->load->view('elements/footer_back');
		}
	}

	public function setPolicyTerm()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$type = $this->uri->segment(2);
		$id = $this->uri->segment(3);
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if(isset($_POST['policy_id']))
		{
			if($_POST['type'] == 'fixed')
			{
				$data_ins = array('type' => 'fixed' ,'policy_id' => $_POST['policy_id'], 'policy_term' => $_POST['policy_term']); 	
			}
			elseif($_POST['type'] == 'range')
			{
				$data_ins = array('type' => 'range', 'policy_id' => $_POST['policy_id'], 'policy_term' => $_POST['policy_term_min'].'/'.$_POST['policy_term_max']);
			}

			$result = $this->admin_model->savePolicyTerm($data_ins);

			if($result != false)
			{
				$msg = 'Successfully Updated Policy Term';
				$this->session->set_userdata('flash_msg_succ', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$msg = 'Failed Due to Some Error!!';
				$this->session->set_userdata('flash_msg_err', $msg);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}	
			
		}

		else
		{
			$result = $this->admin_model->getPolicyTerm($type, $id);
			$data['type'] = $type;

			if($result != false)
			{	
				if($type == 'fixed')
				{
					$data['term'] = $result;		
				}
				elseif($type == 'range')
				{
					$term_range = explode('/', $result['policy_term']);
					$data['min_term'] = $term_range[0];
					$data['max_term'] = $term_range[1];
				}
			}
			else
			{	
				if($type == 'fixed')
				{
					$data['term']['policy_term'] = '';		
				}
				elseif($type == 'range')
				{
					$data['min_term'] = '';
					$data['max_term'] = '';
				}
			}


			if ($type == 'fixed') {
				$headerdata['title'] = 'Edit Policy Term Fixed';	
			}
			elseif($type == 'range')
			{
				$headerdata['title'] = 'Edit Policy Term Range';	
			}
			
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/set_policy_term',$data);
			$this->load->view('elements/footer_back');
		}
	}




	public function uploadRate()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$id = $this->uri->segment(2);

		if(isset($_POST['policy_id']))
		{
			$config['upload_path'] = './sysfiles/policy_rates/';
			$config['allowed_types'] = 'csv';
			$config['file_name'] = 'policy_rate_'.$id;
			$config['overwrite'] = TRUE;
			$config['max_size']	= '0';
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());

				$this->session->set_userdata('flash_msg_err', $error['error']);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$data1 = array('upload_data' => $this->upload->data());

				$filename = base_url().'sysfiles/policy_rates/'.$data1['upload_data']['file_name'];

				$file = fopen($filename,"r");
			
				$n = 0;
				$err_flag = 0;
				$err_msg = '';
				while(! feof($file))
  				{
			  		$rate = (fgetcsv($file));

			  		if($n != 0)	//escaping first row 
			  		{
			  			if($rate['0'] !='' && $rate['1'] !='' && $rate['2'] !='')
			  			{	
			  				if(is_numeric($rate['0']) && is_numeric($rate['1']) && is_numeric($rate['2']))
			  				{
			  					if($err_flag==0) // checking for null at previous row 
			  					{
			  						$data_ins[$n]['policy_id'] = $id;
			  						$data_ins[$n]['entry_age'] = $rate['0'];
			  						$data_ins[$n]['policy_term'] = $rate['1'];
			  						$data_ins[$n]['rate'] = $rate['2'];
			  						$data_ins[$n]['rate_per'] = $_POST['rate_per'];
			  					}
			  					else
			  					{
			  						$err_msg = 'Null Data At Row '.($n).' Please Check !!';
			  						break;
			  					}
			  				}
			  				else
			  				{
			  					$err_flag=1;
			  					$err_msg = 'Check At Row '.($n+1).' For Non Numeric Values or Blank Spaces !!';
			  					break;
			  				}
			  			}
			  			else
			  			{
			  				$err_flag=1;
			  			}
			  		}
			  		$n++;	
  				}

  				fclose($file);

  				if($err_flag==1)
  				{
					$this->session->set_userdata('flash_msg_err', $err_msg);
					redirect('view/policy-view/'.$_POST['policy_id']);
  				}
  				else
  				{
  					$result = $this->admin_model->savePolicyRate($data_ins,$id);

  					if($result)
  					{  						
  						$succ = 'Successfully Uploaded New Rate';
						$this->session->set_userdata('flash_msg_succ', $succ);
						redirect('view/policy-view/'.$_POST['policy_id']);
  					}
  					else
  					{  						
  						$msg = 'Failed Uploading New Rate';
						$this->session->set_userdata('flash_msg_err', $msg);
						redirect('view/policy-view/'.$_POST['policy_id']);
  					}
  				}
			}
		}

		else
		{
			$data['policy'] = $this->admin_model->getPolicyById($id);

			$data['policy_rate'] = $this->admin_model->getPolicyRate($id);

			$headerdata['title'] = 'Upload Policy Rate';	
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/upload_rate',$data);
			$this->load->view('elements/footer_back');
		}
	}


	public function uploadPolicyRiderRate()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$id = $this->uri->segment(2);
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if($data['policy']['policy_rider_secondary_insured_check'] != 1)
		{
			$msg = 'Policy Rider Rate is not applicable for this policy';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}

		if(isset($_POST['policy_id']))
		{
			$config['upload_path'] = './sysfiles/policy_rider_rates/';
			$config['allowed_types'] = 'csv';
			$config['file_name'] = 'policy_rider_rate_'.$id;
			$config['overwrite'] = TRUE;
			$config['max_size']	= '0';
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());

				$this->session->set_userdata('flash_msg_err', $error['error']);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$data1 = array('upload_data' => $this->upload->data());

				$filename = base_url().'sysfiles/policy_rider_rates/'.$data1['upload_data']['file_name'];

				$file = fopen($filename,"r");
			
				$n = 0;
				$err_flag = 0;
				$err_msg = '';
				while(! feof($file))
  				{
			  		$rate = (fgetcsv($file));

			  		if($n != 0)	//escaping first row 
			  		{
			  			if($rate['0'] !='' && $rate['1'] !='' && $rate['2'] !='')
			  			{	
			  				if(is_numeric($rate['0']) && is_numeric($rate['1']) && is_numeric($rate['2']))
			  				{
			  					if($err_flag==0) // checking for null at previous row 
			  					{
			  						$data_ins[$n]['policy_id'] = $id;
			  						$data_ins[$n]['entry_age'] = $rate['0'];
			  						$data_ins[$n]['policy_term'] = $rate['1'];
			  						$data_ins[$n]['rate'] = $rate['2'];
			  						$data_ins[$n]['rate_per'] = $_POST['rate_per'];
			  					}
			  					else
			  					{
			  						$err_msg = 'Null Data At Row '.($n).' Please Check !!';
			  						break;
			  					}
			  				}
			  				else
			  				{
			  					$err_flag=1;
			  					$err_msg = 'Check At Row '.($n+1).' For Non Numeric Values or Blank Spaces !!';
			  					break;
			  				}
			  			}
			  			else
			  			{
			  				$err_flag=1;
			  			}
			  		}
			  		$n++;	
  				}

  				fclose($file);

  				if($err_flag==1)
  				{
					$this->session->set_userdata('flash_msg_err', $err_msg);
					redirect('view/policy-view/'.$_POST['policy_id']);
  				}
  				else
  				{
  					$result = $this->admin_model->savePolicyRiderRate($data_ins,$id);

  					if($result)
  					{
  						$succ = 'Successfully Uploaded New Policy Rider Rate';
						$this->session->set_userdata('flash_msg_succ', $succ);
						redirect('view/policy-view/'.$_POST['policy_id']);
  					}
  					else
  					{
  						$msg = 'Failed Uploading New Policy Rider Rate Due to Server Error';
						$this->session->set_userdata('flash_msg_err', $msg);
						redirect('view/policy-view/'.$_POST['policy_id']);
  					}
  				}
			}
		}

		else
		{
			$data['policy_rate'] = $this->admin_model->getPolicyRiderRate($id);

			$headerdata['title'] = 'Upload Policy Rider Rate';	
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/upload_policy_rider_rate',$data);
			$this->load->view('elements/footer_back');
		}
	}
	
	public function uploadPolicyRateTermLifeAdditional()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$id = $this->uri->segment(2);
		$data['policy'] = $this->admin_model->getPolicyById($id);

		if($data['policy']['term_life_additional_benefit_check'] != 1)
		{
			$msg = 'Policy Rate For Term Life Additional is not applicable for this policy';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}

		if(isset($_POST['policy_id']))
		{
			$config['upload_path'] = './sysfiles/policy_rates_term_life_additional/';
			$config['allowed_types'] = 'csv';
			$config['file_name'] = 'policy_rate_term_life_additional_'.$id;
			$config['overwrite'] = TRUE;
			$config['max_size']	= '0';
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload())
			{
				$error = array('error' => $this->upload->display_errors());

				$this->session->set_userdata('flash_msg_err', $error['error']);
				redirect('view/policy-view/'.$_POST['policy_id']);
			}
			else
			{
				$data1 = array('upload_data' => $this->upload->data());

				$filename = base_url().'sysfiles/policy_rates_term_life_additional/'.$data1['upload_data']['file_name'];

				$file = fopen($filename,"r");
			
				$n = 0;
				$err_flag = 0;
				$err_msg = '';
				while(! feof($file))
  				{
			  		$rate = (fgetcsv($file));

			  		if($n != 0)	//escaping first row 
			  		{
			  			if($rate['0'] !='' && $rate['1'] !='' && $rate['2'] !='')
			  			{	
			  				if(is_numeric($rate['0']) && is_numeric($rate['1']) && is_numeric($rate['2']))
			  				{
			  					if($err_flag==0) // checking for null at previous row 
			  					{
			  						$data_ins[$n]['policy_id'] = $id;
			  						$data_ins[$n]['entry_age'] = $rate['0'];
			  						$data_ins[$n]['policy_term'] = $rate['1'];
			  						$data_ins[$n]['rate'] = $rate['2'];
			  						$data_ins[$n]['rate_per'] = $_POST['rate_per'];
			  					}
			  					else
			  					{
			  						$err_msg = 'Null Data At Row '.($n).' Please Check !!';
			  						break;
			  					}
			  				}
			  				else
			  				{
			  					$err_flag=1;
			  					$err_msg = 'Check At Row '.($n+1).' For Non Numeric Values or Blank Spaces !!';
			  					break;
			  				}
			  			}
			  			else
			  			{
			  				$err_flag=1;
			  			}
			  		}
			  		$n++;	
  				}

  				fclose($file);

  				if($err_flag==1)
  				{
					$this->session->set_userdata('flash_msg_err', $err_msg);
					redirect('view/policy-view/'.$_POST['policy_id']);
  				}
  				else
  				{
  					$result = $this->admin_model->savePolicyRateTermLifeAdd($data_ins,$id);

  					if($result)
  					{
  						$succ = 'Successfully Uploaded New Policy Rate For Term Life Additional Benefits';
						$this->session->set_userdata('flash_msg_succ', $succ);
						redirect('view/policy-view/'.$_POST['policy_id']);
  					}
  					else
  					{
  						$msg = 'Failed Uploading New Policy Rate For Term Life Additional Benefits Due to Server Error';
						$this->session->set_userdata('flash_msg_err', $msg);
						redirect('view/policy-view/'.$_POST['policy_id']);
  					}
  				}
			}
		}

		else
		{
			$data['policy_rate'] = $this->admin_model->getPolicyRateTermLifeAdd($id);

			$headerdata['title'] = 'Upload Policy Rate For Term Life Additional Benefits';	
			$this->load->view('elements/header_back',$headerdata);
			$this->load->view('admin/upload_policy_rates_term_life_additional',$data);
			$this->load->view('elements/footer_back');
		}
	}


	public function activatePolicy()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		$action = $this->uri->segment(1);
		$id = $this->uri->segment(2);

		if($action == 'activate-policy')
		{
			$data_ins = array('id' => $id, 'active_status' => 1 );
		}
		elseif($action == 'deactivate-policy')
		{
			$data_ins = array('id' => $id, 'active_status' => 0 );
		}

		$result = $this->admin_model->changePolicyState($data_ins);

		if($result)
		{
			if($action == 'activate-policy')
			{
				$succ = 'Policy Activated Successfully';
			}
			elseif($action == 'deactivate-policy')
			{
				$succ = 'Policy De-Activated Successfully';
			}
			$this->session->set_userdata('flash_msg_succ', $succ);
			redirect('view/policy-view/'.$id);
		}
		else
		{
			$msg = 'Failed Due to Server Error';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect('view/policy-view/'.$id);
		}
	}


	public function deletePolicy()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}
		
		$id = $this->uri->segment(2);
		//$data['policy'] = $this->admin_model->getPolicyById($id);

		$result = $this->admin_model->deletePolicy($id);
		if($result)
		{	
			$filenames ='sysfiles/policy_rates/policy_rate_'.$id.'.csv';
			$filenamed = 'sysfiles/policy_rider_rates/policy_rider_rate_'.$id.'.csv';
		
			if (file_exists($filenames))
			{
				unlink($filenames);
			}

			if (file_exists($filenamed))
			{
				unlink($filenamed);
			}
			
			
						
			$succ = "Policy Deleted Successfully";

			$this->session->set_userdata('flash_msg_succ', $succ);
			redirect(base_url().'admin.html');
		}
		else
		{
			$msg = 'Failed Deletion Due to Server Error';
			$this->session->set_userdata('flash_msg_err', $msg);
			redirect(base_url().'admin.html');
		}
	}

	
}