<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Auth_Model extends CI_Model
{
	/*public function saveAdmin($data)
	{
		$query = $this->db->where('username',$data['username'])
				 		  ->get('admin');

		if($query->num_rows() == 1)
		{
			return false;
		}
		else
		{		
			$result = $this->db->insert('admin',$data);

			if($result)
				{return $result;}
			else
				{return false;}
		}
	}*/

	public function checkAdmin($data)
	{
		$this->db->select('*');
		$this->db->from('admin');
		$this->db->where('username', $data['username']);
		$query = $this->db->get();

		if($query->num_rows() == 1)
		{
			$result = $query->row_array();
			$pass = $this->encrypt->decode($result['pass']);
			if($pass === $data['psswrd'])
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}

	public function getAdminDetail($username)
	{
		$query = $this->db->where('username',$username)
				 		  ->get('admin');

		if($query->num_rows() == 1)
		{
			return $query->row_array();
		}
		else
		{
			return false;
		}
	}

	public function savePassword($data)
	{
		$query = $this->db->where('username',$data['username'])
				 		  ->get('admin');

		
		if($query->num_rows() == 1)
		{
			$username = $data['username'];
			unset($data['username']);

			$result = $this->db->update('admin', $data, array('username' => $username));

			if($result)
			{return $result;}
			else
			{return false;}	
		}
		else
		{
			return false;
		}

	}

	public function saveEmail($data)
	{
		$query = $this->db->where('username',$data['username'])
				 		  ->get('admin');

		
		if($query->num_rows() == 1)
		{
			$username = $data['username'];
			unset($data['username']);

			$result = $this->db->update('admin', $data, array('username' => $username));

			if($result)
			{return $result;}
			else
			{return false;}	
		}
		else
		{
			return false;
		}

	}
	
	
}