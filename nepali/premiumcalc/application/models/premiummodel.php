<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PremiumModel extends CI_Model{
	
	public function loadAllPolicy(){
		$query = $this->db->order_by("policy_name", "asc")
						->get_where('policy_list', array('active_status'=> 1));
		return $query->result_array();
	}


	public function getPolicyById($id)
	{
		$query = $this->db->select('*,
				sum_insured.min_sum,
				sum_insured.max_sum,
				sum_insured.max_sum_multiple_value,
				age_primary_insured.min_entry_age,
				age_primary_insured.max_entry_age,
				age_secondary_insured.min_entry_age as asi_min_age,
				age_secondary_insured.max_entry_age as asi_max_age,
				age_policy_rider.min_entry_age as apr_min_age,
				age_policy_rider.max_entry_age as apr_max_age')
						->from('policy_list')
						->join('age_primary_insured','age_primary_insured.policy_id=policy_list.id','left')
						->join('sum_insured','sum_insured.policy_id=policy_list.id','left')
						->join('age_secondary_insured','age_secondary_insured.policy_id=policy_list.id','left')
						->join('age_policy_rider','age_policy_rider.policy_id=policy_list.id','left')
						->where('policy_list.id',$id)
						->get();
		return $query->row_array();
	}	

	public function selectPolicyById($id, $table)
	{
		$this->db->select('*');
		$this->db->from('policy_list');
		$this->db->join('age_primary_insured','age_primary_insured.policy_id=policy_list.id','left');
		$this->db->join('sum_insured','sum_insured.policy_id=policy_list.id','left');
		$this->db->where('policy_list.id',$id);
		$query = $this->db->get();
		
		$data = $query->row_array();

		if($table['age_policy_rider'] == 1)
		{
			$this->db->select('min_entry_age AS `pr_min_entry_age` , max_entry_age AS `pr_max_entry_age`');
			$query = $this->db->get_where('age_policy_rider', array('policy_id' => $id));
			$data_temp = $query->row_array();
			$data = array_merge($data,$data_temp);
		}

		if($table['age_secondary_insured'] == 1)
		{
			
			$this->db->select('min_entry_age AS `si_min_entry_age` , max_entry_age AS `si_max_entry_age`');
			$query = $this->db->get_where('age_secondary_insured', array('policy_id' => $id));
			$data_temp = $query->row_array();
			$data = array_merge($data,$data_temp);

			//$this->db->join('age_secondary_insured','age_secondary_insured.policy_id=policy_list.id','left');
		}

		if($table['payment_interval_option'] == 1)
		{
			$this->db->select('*');
			$query = $this->db->get_where('payment_interval_option', array('policy_id' => $id));
			$data_temp = $query->row_array();
			$data = array_merge($data,$data_temp);

			//$this->db->join('payment_interval_option','payment_interval_option.policy_id=policy_list.id','left');	
		}

		if($table['policy_term_fixed'] == 1)
		{
			$this->db->select('*');
			$query = $this->db->get_where('policy_term_fixed', array('policy_id' => $id));
			$data_temp = $query->row_array();
			$data = array_merge($data,$data_temp);
			//$this->db->join('policy_term_fixed','policy_term_fixed.policy_id=policy_list.id','left');	
		}

		if($table['policy_term_range'] == 1)
		{
			$this->db->select('*');
			$query = $this->db->get_where('policy_term_range', array('policy_id' => $id));
			$data_temp = $query->row_array();
			$data = array_merge($data,$data_temp);
			//$this->db->join('policy_term_range','policy_term_range.policy_id=policy_list.id','left');	
		}
		
		if($table['wop_benefit'] == 1)
		{
			$this->db->select('*');
			$query = $this->db->get_where('wop_benefit', array('policy_id' => $id));
			$data_temp = $query->row_array();
			$data = array_merge($data,$data_temp);
			//$this->db->join('policy_term_range','policy_term_range.policy_id=policy_list.id','left');	
		}
		
		if($table['adb_benefit'] == 1)
		{
			$this->db->select('*');
			$query = $this->db->get_where('adb_benefit', array('policy_id' => $id));
			$data_temp = $query->row_array();
			$data = array_merge($data,$data_temp);
			//$this->db->join('policy_term_range','policy_term_range.policy_id=policy_list.id','left');	
		}
		
		if($table['total_perm_disable_benefit'] == 1)
		{
			$this->db->select('*');
			$query = $this->db->get_where('total_perm_disable_benefit', array('policy_id' => $id));
			$data_temp = $query->row_array();
			$data = array_merge($data,$data_temp);
			//$this->db->join('policy_term_range','policy_term_range.policy_id=policy_list.id','left');	
		}

		//$this->db->where('policy_list.id',$id);
		//$query = $this->db->get();

		return $data;
	}	


	public function getRatePrimary($data)
	{
		$query = $this->db->where($data)
						   ->get('policy_rates_primary');
		
		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}
	
	public function getRateTermLifeAdd($data)
	{
		$query = $this->db->where($data)
						   ->get('policy_rates_term_life_additional');
		
		if($query->num_rows() == 1)
		{
			$result = $query->row_array();
			
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function getRebateRate($ins_amt,$id)
	{
		$query = $this->db->where('policy_id',$id)
						  ->order_by("id", "asc")
						  ->get('rebate_benefit');

		if($query->num_rows() >= 1)
		{
			$rate = 0;
			$result = $query->result_array();

			foreach ($result as $res) 
			{
				if($res['max_amt']==0)
				{
					if($ins_amt >= $res['min_amt'])
					{
						$rate = $res['rebate_rate'];
						break;
					}
				}
				else
				{
					if($ins_amt >= $res['min_amt'] && $ins_amt < $res['max_amt'])
					{
						$rate = $res['rebate_rate'];
						break;
					}
				}
			}
			return $rate;
		}
		else
		{
			return false;
		}
	}

	public function getTotalPermDisRate($id)
	{
		$query = $this->db->where('policy_id',$id)
						  ->get('total_perm_disable_benefit');

		if($query->num_rows() == 1)
		{
			$result = $query->row_array();
			return $result;
		}
		else
		{
			return false;
		}
	}
	
	public function getWOPRate($id)
	{
		$query = $this->db->where('policy_id',$id)
						  ->get('wop_benefit');

		if($query->num_rows() == 1)
		{
			$result = $query->row_array();
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function getADBRate($id)
	{
		$query = $this->db->where('policy_id',$id)
						  ->get('adb_benefit');

		if($query->num_rows() == 1)
		{
			$result = $query->row_array();
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function getPRRate($id, $pr_sec_ins_age, $policy_term)
	{
		$query = $this->db->where('policy_id',$id)
						  ->where('entry_age',$pr_sec_ins_age)
						  ->where('policy_term', $policy_term)
						  ->get('policy_rates_proposer');

		if($query->num_rows() == 1)
		{
			$result = $query->row_array();
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function getPaymentIntRate($id, $policy_int_opt)
	{
		$query = $this->db->where('policy_id',$id)
						  ->get('payment_interval_rate');

		if($query->num_rows() == 1)
		{
			$result = $query->row_array();

			if($policy_int_opt == 'yearly')
			{
				$data['rate'] = $result['yearly_rate'];
				$data['type'] = $result['type_yearly'];
			}

			if($policy_int_opt == 'hlf-yrly')
			{
				$data['rate'] = $result['half_yearly_rate'];
				$data['type'] = $result['type_half_yearly'];
			}

			if($policy_int_opt == 'qtrly')
			{
				$data['rate'] = $result['quarterly_rate'];
				$data['type'] = $result['type_quarterly'];
			}

			if($policy_int_opt == 'monthly')
			{
				$data['rate'] = $result['monthly_rate'];
				$data['type'] = $result['type_monthly'];
			}

			return $data;
		}
		else
		{
			return false;
		}
	}

	public function getAgeDiffValue($diff)
	{
		$query = $this->db->where('age_diff',$diff)
						  ->get('age_diff_formula');

		if($query->num_rows() == 1)
		{
			$result = $query->row_array();
			$value = $result['value_add'];
			return $value;
		}
		else
		{
			return false;
		}
	}
	

}