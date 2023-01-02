<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Admin_Model extends CI_Model
{
	public function loadPolicyList(){
		$query = $this->db->select('id, policy_name, active_status')
						  ->order_by("policy_name", "asc")
				          ->get('policy_list');

		return $query->result_array();
	}

	public function getPolicyById($id)
	{
		$query = $this->db->select('*')
						->from('policy_list')
						->join('age_primary_insured','age_primary_insured.policy_id=policy_list.id','left')
						->join('sum_insured','sum_insured.policy_id=policy_list.id','left')
						->where('policy_list.id',$id)
						->get();
		return $query->row_array();
	}	

	public function getPolicyByIdFull($id)
	{
		$query = $this->db->select('*')
						->from('policy_list')
						->join('age_primary_insured','age_primary_insured.policy_id=policy_list.id','left')
						->join('sum_insured','sum_insured.policy_id=policy_list.id','left')
						->where('policy_list.id',$id)
						->get();
		$result['policy'] = $query->row_array();

		$id = $result['policy']['id'];

		if($result['policy']['wop_check'] == 1 )
		{
			$query = $this->db->get_where('wop_benefit',array('policy_id'=>$id));
			if($query->num_rows() == 1)
			{ $result['wop_avail_check'] = 1; }
			else
			{ $result['wop_avail_check'] = 0; }
		}

		if($result['policy']['adb_check'] == 1 )
		{
			$query = $this->db->get_where('adb_benefit',array('policy_id'=>$id));
			if($query->num_rows() == 1)
			{ $result['adb_avail_check'] = 1; }
			else
			{ $result['adb_avail_check'] = 0; }
		}

		if($result['policy']['rebate_check'] == 1 )
		{
			$query = $this->db->get_where('rebate_benefit',array('policy_id'=>$id));
			if($query->num_rows() >= 1)
			{ $result['rebate_avail_check'] = 1; }
			else
			{ $result['rebate_avail_check'] = 0; }
		}

		if($result['policy']['total_perm_disable_check'] == 1 )
		{
			$query = $this->db->get_where('total_perm_disable_benefit',array('policy_id'=>$id));
			if($query->num_rows() >= 1)
			{ $result['total_perm_disable_avail_check'] = 1; }
			else
			{ $result['total_perm_disable_avail_check'] = 0; }
		}
		
		if($result['policy']['total_perm_disable_check'] == 1 )
		{
			$query = $this->db->get_where('policy_rates_term_life_additional',array('policy_id'=>$id));
			if($query->num_rows() >= 1)
			{ $result['term_life_additional_avail_check'] = 1; }
			else
			{ $result['term_life_additional_avail_check'] = 0; }
		}

		if($result['policy']['premium_paymnt_type'] == 1 )
		{
			$query = $this->db->get_where('payment_interval_option',array('policy_id'=>$id));
			if($query->num_rows() == 1)
			{ $result['pay_int_opt_avail_check'] = 1; }
			else
			{ $result['pay_int_opt_avail_check'] = 0; }

			$query = $this->db->get_where('payment_interval_rate',array('policy_id'=>$id));
			if($query->num_rows() == 1)
			{ $result['pay_int_rate_avail_check'] = 1; }
			else
			{ $result['pay_int_rate_avail_check'] = 0; }
		}

		if($result['policy']['policy_rider_secondary_insured_check'] == 1 )
		{
			$query = $this->db->get_where('age_policy_rider',array('policy_id'=>$id));
			if($query->num_rows() == 1)
			{ $result['policy_rider_age_avail_check'] = 1; }
			else
			{ $result['policy_rider_age_avail_check'] = 0; }

			$query = $this->db->get_where('policy_rates_proposer',array('policy_id'=>$id));
			if($query->num_rows() > 1)
			{ $result['policy_rider_rate_avail_check'] = 1; }
			else
			{ $result['policy_rider_rate_avail_check'] = 0; }
		}

		if($result['policy']['policy_rider_secondary_insured_check'] == 2 )
		{
			$query = $this->db->get_where('age_secondary_insured',array('policy_id'=>$id));
			if($query->num_rows() == 1)
			{ $result['sec_insu_age_avail_check'] = 1; }
			else
			{ $result['sec_insu_age_avail_check'] = 0; }
		}

		if($result['policy']['policy_term_check'] == 1 )
		{
			$query = $this->db->get_where('policy_term_fixed',array('policy_id'=>$id));
			if($query->num_rows() == 1)
			{ $result['term_avail_check'] = 1; }
			else
			{ $result['term_avail_check'] = 0; }
		}

		if($result['policy']['policy_term_check'] == 2 )
		{
			$query = $this->db->get_where('policy_term_range',array('policy_id'=>$id));
			if($query->num_rows() == 1)
			{ $result['term_avail_check'] = 1; }
			else
			{ $result['term_avail_check'] = 0; }
		}
		
		$query = $this->db->get_where('policy_rates_primary',array('policy_id'=>$id));
		if($query->num_rows() > 1)
		{ $result['policy_rate_avail_check'] = 1; }
		else
		{ $result['policy_rate_avail_check'] = 0; }


		return $result;
	}

	public function savePolicy($policy_list_data, $sum_insured, $primary_entry_age)
	{

		$result = $this->db->insert('policy_list',$policy_list_data);

		if($result)
		{
			$id = $this->db->insert_id();

			$sum_insured['policy_id'] = $id;
			$primary_entry_age['policy_id'] = $id;


			$result1 = $this->db->insert('sum_insured',$sum_insured);			
			$result2 = $this->db->insert('age_primary_insured',$primary_entry_age);

			if($result1 && $result2)
			{ return $id; }
		}
		else
		{ return false ;}
	}

	public function editPolicy($id, $change, $policy_list_data_pre, $policy_list_data_curr, $sum_insured_curr, $primary_age_curr)
	{
		if($change['min_sum'] == 1 || $change['max_sum'] == 1 || $change['max_sum_multiple_value'] = 1)
		{
			$this->db->update('sum_insured', $sum_insured_curr, array('policy_id'=>$id));

			$this->db->delete('rebate_benefit', array('policy_id'=>$id));	
		}

		if($change['min_entry_age'] == 1 || $change['max_entry_age'] == 1)
		{
			$this->db->update('age_primary_insured', $primary_age_curr, array('policy_id'=>$id));

			$this->db->delete('policy_rates_primary', array('policy_id'=>$id));	
		}

		if($change['policy_term'] == 1)
		{
			if($policy_list_data_pre['policy_term_check'] == 1) 
			{
				$this->db->delete('policy_term_fixed', array('policy_id'=>$id));		
			}
			elseif($policy_list_data_pre['policy_term_check'] == 2) 
			{
				$this->db->delete('policy_term_range', array('policy_id'=>$id));		
			}

			$this->db->delete('policy_rates_primary', array('policy_id'=>$id));

			if($policy_list_data_pre['policy_rider_secondary_insured_check'] == 1) 
			{
				$this->db->delete('policy_rates_proposer', array('policy_id'=>$id));		
			}
		}

		if($change['rider_sec'] == 1)
		{
			if($policy_list_data_pre['policy_rider_secondary_insured_check'] == 1) 
			{
				$this->db->delete('age_policy_rider', array('policy_id'=>$id));		
				$this->db->delete('policy_rates_proposer', array('policy_id'=>$id));		
			}
			elseif($policy_list_data_pre['policy_rider_secondary_insured_check'] == 2) 
			{
				$this->db->delete('age_secondary_insured', array('policy_id'=>$id));		
			}
		}

		if($change['premium_paymt'] == 1)
		{
			if($policy_list_data_pre['premium_paymnt_type'] == 1) 
			{
				$this->db->delete('payment_interval_option', array('policy_id'=>$id));		
				$this->db->delete('payment_interval_rate', array('policy_id'=>$id));		
				$this->db->delete('age_policy_rider', array('policy_id'=>$id));		
				$this->db->delete('policy_rates_proposer', array('policy_id'=>$id));
				$this->db->delete('age_secondary_insured', array('policy_id'=>$id));				
			}
			elseif($policy_list_data_pre['premium_paymnt_type'] == 2) 
			{
				
			}
		}
		
		if($change['term_life_additional_benefit'] == 1)
		{
			$this->db->delete('policy_rates_term_life_additional', array('policy_id'=>$id));			
		}

		if($change['total_perm_disable'] == 1)
		{
			$this->db->delete('total_perm_disable_benefit', array('policy_id'=>$id));			
		}

		if($change['rebate'] == 1)
		{
			$this->db->delete('rebate_benefit', array('policy_id'=>$id));			
		}

		if($change['adb'] == 1)
		{
			$this->db->delete('adb_benefit', array('policy_id'=>$id));			
		}

		if($change['wop'] == 1)
		{
			$this->db->delete('wop_benefit', array('policy_id'=>$id));			
		}

		$result = $this->db->update('policy_list', $policy_list_data_curr, array('id'=>$id));

		if($result)
			{return $result;}
		else
			{return false;}
	}

	public function saveTotalPermDisRate($data)
	{
		$query = $this->db->get_where('total_perm_disable_benefit',array('policy_id'=>$data['policy_id']));
		
		if($query->num_rows() == 1)
		{
			$id = $data['policy_id'];
			$data = array('total_perm_disable_rate' => $data['total_perm_disable_rate'], 'min_age_criteria_total_perm_disable' => $_POST['min_age_criteria_total_perm_disable'] );
			$result = $this->db->where('policy_id',$id)
							   ->update('total_perm_disable_benefit',$data);
			return $result;
		}

		else
		{
			$result = $this->db->insert('total_perm_disable_benefit',$data);
			return $result;
		}
	}

	public function getTotalPermDisRateById($id)
	{
		$query = $this->db->get_where('total_perm_disable_benefit',array('policy_id'=>$id));

		if($query->num_rows() == 1)
		{ return $query->row_array(); }
		else
			{	return false; }
	}

	public function saveWOP($data)
	{
		$query = $this->db->get_where('wop_benefit',array('policy_id'=>$data['policy_id']));
		
		if($query->num_rows() == 1)
		{
			$id = $data['policy_id'];
			$data = array('wop_rate' => $data['wop_rate'], 'min_age_criteria_wop' => $_POST['min_age_criteria_wop'], 'max_age_criteria_wop' => $_POST['max_age_criteria_wop'] );
			$result = $this->db->where('policy_id',$id)
							   ->update('wop_benefit',$data);
			return $result;
		}

		else
		{
			$result = $this->db->insert('wop_benefit',$data);
			return $result;
		}
	}

	public function getWOPById($id)
	{
		$query = $this->db->get_where('wop_benefit',array('policy_id'=>$id));

		if($query->num_rows() == 1)
		{ return $query->row_array(); }
		else
			{	return false; }
	}


	public function saveADB($data)
	{
		$query = $this->db->get_where('adb_benefit',array('policy_id'=>$data['policy_id']));
		
		if($query->num_rows() == 1)
		{
			$id = $data['policy_id'];

			$data = array('adb_rate' => $data['adb_rate'],'min_age_criteria_adb' => $_POST['min_age_criteria_adb'],'max_age_criteria_adb' => $_POST['max_age_criteria_adb'], 'max_sum_covered' => $_POST['max_sum_covered'], 'sum_covered_type' => $_POST['sum_covered_type'] );
			$result = $this->db->where('policy_id',$id)
							   ->update('adb_benefit',$data);
			return $result;
		}

		else
		{
			$result = $this->db->insert('adb_benefit',$data);
			return $result;
		}
	}

	public function getADBById($id)
	{
		$query = $this->db->get_where('adb_benefit',array('policy_id'=>$id));

		if($query->num_rows() == 1)
		{ return $query->row_array(); }
		else
			{	return false; }
	}


	public function savePaymentIntervalOption($data)
	{
		$query = $this->db->get_where('payment_interval_option',array('policy_id'=>$data['policy_id']));
		
		if($query->num_rows() == 1)
		{
			$id = $data['policy_id'];
			unset($data['policy_id']);
			$result = $this->db->where('policy_id',$id)
							   ->update('payment_interval_option',$data);

			$query = $this->db->get_where('payment_interval_rate',array('policy_id'=>$id));
			if($query->num_rows() == 1)
			{
				if($data['yearly_check']==0)
				{
					$data1['yearly_rate'] = NULL;
					$data1['type_yearly'] = NULL;
					$this->db->update('payment_interval_rate', $data1, array('policy_id' => $id));
				}
				if($data['half_yearly_check']==0) 
				{
					$data1['half_yearly_rate'] = NULL;
					$data1['type_half_yearly'] = NULL;
					$this->db->update('payment_interval_rate', $data1, array('policy_id' => $id));
				}
				if($data['quarterly_check']==0) 
				{
					$data1['quarterly_rate'] = NULL;
					$data1['type_quarterly'] = NULL;
					$this->db->update('payment_interval_rate', $data1, array('policy_id' => $id));
				}
				if($data['monthly_check']==0) 
				{
					$data1['monthly_rate'] = NULL;
					$data1['type_monthly'] = NULL;
					$this->db->update('payment_interval_rate', $data1, array('policy_id' => $id));
				}
			}

			return $result;
		}
		else
		{
			$result = $this->db->insert('payment_interval_option',$data);
			return $result;
		}
	}

	public function getPaymentIntervalOptionById($id)
	{
		$query = $this->db->get_where('payment_interval_option',array('policy_id'=>$id));

		if($query->num_rows() == 1)
		{ return $query->row_array(); }
		else
			{	return false; }
	}

    public function savePaymentIntervalRate($data)
    {
        $query = $this->db->get_where('payment_interval_rate',array('policy_id'=>$data['policy_id']));
        
        if($query->num_rows() == 1)
        {
            $id = $data['policy_id'];
            unset($data['policy_id']);
            $result = $this->db->where('policy_id',$id)
                               ->update('payment_interval_rate',$data);
            return $result;
        }
        else
        {
            $result = $this->db->insert('payment_interval_rate',$data);
            return $result;
        }
    }

    public function getPaymentIntervalRateById($id)
    {
        $query = $this->db->get_where('payment_interval_rate',array('policy_id'=>$id));

        if($query->num_rows() == 1)
        { return $query->row_array(); }
        else
            {   return false; }
    }

    public function saveRebateRate($data)
    {
        $query = $this->db->get_where('rebate_benefit',array('policy_id'=>$data[1]['policy_id']));
        echo $query->num_rows();

        
        if($query->num_rows() > 0)
        {
            $result = $this->db->delete('rebate_benefit',array('policy_id'=>$data[1]['policy_id']));
            if($result)
            {
            	$result = $this->db->insert_batch('rebate_benefit',$data);
            	return $result;
            }
        }
        else
        {
            $result = $this->db->insert_batch('rebate_benefit',$data);
            return $result;
        }
    }

    public function getRebateById($id)
    {
    	$query = $this->db->get_where('rebate_benefit',array('policy_id'=>$id));

    	if($query->num_rows() >= 1)
        { return $query->result_array(); }
        else
        {   return false; }
    }

    public function saveOtherAge($data)
    {
    	if($data['type'] == 'policy-rider')
    		{$table_name = 'age_policy_rider';}

    	elseif ($data['type'] == 'sec-insured')
    		{$table_name = 'age_secondary_insured';}

    	unset($data['type']);

    	$query = $this->db->get_where($table_name, array('policy_id'=>$data['policy_id']));
        
        if($query->num_rows() == 1)
        {
            $data_pre = $query->row_array();
            $id = $data['policy_id'];
            unset($data['policy_id']);

            if($data['min_entry_age'] != $data_pre['min_entry_age'] || $data['max_entry_age'] != $data_pre['max_entry_age'])
            {
            	if($table_name == 'age_policy_rider')
            	{
            		$this->db->delete('policy_rates_proposer', array('policy_id' => $id));		
            	}

 	           	//only when new feature of having separate policy rate for secondary insured is implemented
 	           	/*elseif($table_name == 'age_secondary_insured')
            	{
            		$this->db->delete('policy_rates_primary', array('policy_id' => $id));		
            	}*/
            }

            $result = $this->db->where('policy_id',$id)
                               ->update($table_name,$data);
            if($result)
            {
            	return $result;
            } 
            else
            {
            	return false;
            }
        }
        else
        {
            $result = $this->db->insert($table_name,$data);
            if($result)
            {
            	return $result;
            } 
            else
            {
            	return false;
            }
        }
    }

    public function getOtherAge($type, $id)
    {
    	if($type == 'policy-rider')
    		{$table_name = 'age_policy_rider';}
    	elseif ($type == 'sec-insured')
    		{$table_name = 'age_secondary_insured';}

    	$query = $this->db->get_where($table_name,array('policy_id'=>$id));

    	if($query->num_rows() == 1)
        { return $query->row_array(); }
        else
        {   return false; }
    }

    public function savePolicyTerm($data)
    {
    	if($data['type'] == 'fixed')
    		{$table_name = 'policy_term_fixed';}

    	elseif ($data['type'] == 'range')
    		{$table_name = 'policy_term_range';}

    	unset($data['type']);

    	$query = $this->db->get_where($table_name, array('policy_id'=>$data['policy_id']));

    	if($query->num_rows() == 1)
        {
            $data_pre = $query->row_array();
            $id = $data['policy_id'];
            unset($data['policy_id']);
           
            if($data['policy_term'] != $data_pre['policy_term'])
            {
            	$this->db->delete('policy_rates_primary', array('policy_id' => $id));		
            }

            $result = $this->db->where('policy_id',$id)
                               ->update($table_name,$data);
			if($result)
            {
            	return $result;
            } 
            else
            {
            	return false;
            }                               
        }

        else
        {
            $result = $this->db->insert($table_name,$data);
            if($result)
            {
            	return $result;
            } 
            else
            {
            	return false;
            }
        }
    }


    public function getPolicyTerm($type, $id)
    {
    	if($type == 'fixed')
    		{$table_name = 'policy_term_fixed';}
    	elseif ($type == 'range')
    		{$table_name = 'policy_term_range';}

    	$query = $this->db->get_where($table_name,array('policy_id'=>$id));

    	if($query->num_rows() == 1)
        { return $query->row_array(); }
        else
        {   return false; }
    }
    
    public function getSumInsuredById($id)
    {
    	$query = $this->db->get_where('sum_insured',array('policy_id'=>$id));

    	if($query->num_rows() == 1)
        { return $query->row_array(); }
        else
        {   return false; }
    }

    public function savePolicyRate($data,$id)
    {
    	$query = $this->db->delete('policy_rates_primary', array('policy_id' => $id));

    	if($query)
    	{
    		$query = $this->db->insert_batch('policy_rates_primary',$data);

    		if($query)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	} 
    }


    public function getPolicyRate($id)
    {
    	$query = $this->db->get_where('policy_rates_primary',array('policy_id' => $id));

    	if($query->num_rows() > 1)
    	{
    		return $query->result_array();
    	}
    	else
    	{
    		return false;
    	}
    }


    public function savePolicyRiderRate($data,$id)
    {
    	$query = $this->db->delete('policy_rates_proposer', array('policy_id' => $id));

    	if($query)
    	{
    		$query = $this->db->insert_batch('policy_rates_proposer',$data);

    		if($query)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	} 
    }

    public function getPolicyRiderRate($id)
    {
    	$query = $this->db->get_where('policy_rates_proposer',array('policy_id' => $id));

    	if($query->num_rows() > 5)
    	{
    		return $query->result_array();
    	}
    	else
    	{
    		return false;
    	}
    }
	
	public function savePolicyRateTermLifeAdd($data,$id)
    {
    	$query = $this->db->delete('policy_rates_term_life_additional', array('policy_id' => $id));

    	if($query)
    	{
    		$query = $this->db->insert_batch('policy_rates_term_life_additional',$data);

    		if($query)
    		{
    			return true;
    		}
    		else
    		{
    			return false;
    		}
    	} 
    }

    public function getPolicyRateTermLifeAdd($id)
    {
    	$query = $this->db->get_where('policy_rates_term_life_additional',array('policy_id' => $id));

    	if($query->num_rows() > 5)
    	{
    		return $query->result_array();
    	}
    	else
    	{
    		return false;
    	}
    }

    public function changePolicyState($data)
    {
    	$id = $data['id'];
    	unset($data['id']);

    	$result = $this->db->update('policy_list', $data, array('id' => $id));

    	return $result;
    }

    public function deletePolicy($id)
    {
    	$this->db->delete('adb_benefit', array('policy_id' => $id));
		
    	$this->db->delete('total_perm_disable_benefit', array('policy_id' => $id));
		
    	$this->db->delete('policy_rates_term_life_additional', array('policy_id' => $id));

    	$this->db->delete('age_policy_rider', array('policy_id' => $id));

    	$this->db->delete('age_primary_insured', array('policy_id' => $id));

    	$this->db->delete('age_secondary_insured', array('policy_id' => $id));

    	$this->db->delete('payment_interval_option', array('policy_id' => $id));

    	$this->db->delete('payment_interval_rate', array('policy_id' => $id));

    	$this->db->delete('policy_rates_primary', array('policy_id' => $id));

    	$this->db->delete('policy_rates_proposer', array('policy_id' => $id));

    	$this->db->delete('policy_term_fixed', array('policy_id' => $id));

    	$this->db->delete('policy_term_range', array('policy_id' => $id));

    	$this->db->delete('rebate_benefit', array('policy_id' => $id));

    	$this->db->delete('sum_insured', array('policy_id' => $id));

    	$this->db->delete('wop_benefit', array('policy_id' => $id));

    	$result = $this->db->delete('policy_list', array('id' => $id));

    	if($result)
    		{return $result;}
    	else
    		{return false;}
    }

}