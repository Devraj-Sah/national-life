<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Authenticate extends CI_Controller
{
	public function __construct() {
		parent::__construct();

		$this->load->library('encrypt');
		$this->load->model('admin_auth_model');
	}
	
	public function adminLogin()
	{
		if(isset($this->session->userdata['loggedin']))
		{
			redirect (base_url().'admin.html');	
		}
		
		if(isset($_POST['username']))
		{
			$data['username'] = $_POST['username'];
			$data['psswrd'] = $_POST['psswrd'];

			$result = $this->admin_auth_model->checkAdmin($data);

			if($result == TRUE)
			{
				$userdata = $this->admin_auth_model->getAdminDetail($data['username']);

				if($userdata != FALSE)
				{
					$session_data = array('username' => $userdata['username'], 'email' => $userdata['email']);
					$this->session->set_userdata('loggedin',$session_data);
					$msg = 'Successfully Logged In';
					$this->session->set_userdata('flash_msg_succ', $msg);
					redirect (base_url().'admin.html');	
				}
			}
			else
			{
				$msg = 'Invalid Username or Password';
				$this->session->set_userdata('flash_msg_err_login', $msg);
				redirect (base_url().'admin-login.html');	
			}
		}

		else
		{
			$hdata['title'] = 'Login';
			$this->load->view('elements/header_back',$hdata);
			$this->load->view('admin/login_form');
			$this->load->view('elements/footer');
		}
	}

	public function adminLogout()
	{
		$this->session->unset_userdata('loggedin');
		$msg = 'Successfully Logged Out';
		$this->session->set_userdata('flash_msg_logout', $msg);
		redirect (base_url().'admin-login.html');
	}

	/*public function registerAdmin()
	{
		if(isset($_POST['usrname']))
		{
			$data = array(
						'username' => $_POST['usrname'], 
						'pass' => $this->encrypt->encode($_POST['psswrd']), 
						'email' => $_POST['email'], 
						'created_date' => date('Y-m-d'), 
						);

			$result = $this->admin_auth_model->saveAdmin($data);

			if($result == false)
			{
				$msg = 'Username Already Exists';
				$this->session->set_userdata('flash_msg_err_reg', $msg);
				redirect (base_url().'admin-reg.html');	
			}

			else
			{
				echo 'SUCCESSFULLY created';
			}
			//redirect(base_url().'admin-login.html');
		}
		else
		{
			$hdata['title'] = 'Register Admin';
			$this->load->view('elements/header_back',$hdata);
			$this->load->view('admin/registration_form');
			$this->load->view('elements/footer');
		}	
	}*/

	public function changePassword()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		if(isset($_POST['curr_psswrd']))
		{
			$data['username'] = $this->session->userdata['loggedin']['username'];
			$data['psswrd'] = $_POST['curr_psswrd'];

			$result = $this->admin_auth_model->checkAdmin($data);

			if($result == TRUE)
			{
				$data2['username'] = $this->session->userdata['loggedin']['username'];
				$data2['pass'] = $this->encrypt->encode($_POST['new_psswrd']);
				$result = $this->admin_auth_model->savePassword($data2);

				if($result)
				{
					$this->session->unset_userdata('loggedin');
					$msg = 'Successfully Changed Password. Please Login Again !!';
					$this->session->set_userdata('flash_msg_logout', $msg);
					redirect (base_url().'admin-login.html');
				}
				else
				{
					$msg = 'Failed Updation Due Server Error';
					$this->session->set_userdata('flash_msg_err', $msg);
					redirect (base_url().'admin.html');	
				}
			}

			else
			{
				$msg = 'Check Current Password';
				$this->session->set_userdata('flash_msg_err_pass', $msg);
				redirect (base_url().'change-password');	
			}
		}
		else
		{
			$hdata['title'] = 'Change Password';
			$this->load->view('elements/header_back',$hdata);
			$this->load->view('admin/change_pass_form');
			$this->load->view('elements/footer');
		}	
	}

	public function changeEmail()
	{
		if(! isset($this->session->userdata['loggedin']))
		{redirect(base_url().'admin-login.html');}

		if(isset($_POST['new_email']))
		{
			$data['username'] = $this->session->userdata['loggedin']['username'];
			$data['psswrd'] = $_POST['curr_psswrd'];

			$result = $this->admin_auth_model->checkAdmin($data);

			if($result == TRUE)
			{
				$data2['username'] = $this->session->userdata['loggedin']['username'];
				$data2['email'] = $_POST['new_email'];
				$result = $this->admin_auth_model->saveEmail($data2);

				if($result)
				{
					$this->session->unset_userdata('loggedin');
					$msg = 'Successfully Updated Email. Please Login Again !!';
					$this->session->set_userdata('flash_msg_logout', $msg);
					redirect (base_url().'admin-login.html');
				}
				else
				{
					$msg = 'Failed Updation Due Server Error';
					$this->session->set_userdata('flash_msg_err', $msg);
					redirect (base_url().'admin.html');	
				}
			}

			else
			{
				$msg = 'Check Current Password';
				$this->session->set_userdata('flash_msg_err_pass', $msg);
				redirect (base_url().'change-email');	
			}
		}
		else
		{
			$hdata['title'] = 'Change Password';
			$this->load->view('elements/header_back',$hdata);
			$this->load->view('admin/change_email_form');
			$this->load->view('elements/footer');
		}	
	}

	public function recoverPass()
	{
		
		$config['protocol'] = 'mail';
		$config['mailtype'] = 'html';

		$this->load->library('email',$config);
		$this->load->helper('email');
		
		
		$username = 'admin';
		$result = $this->admin_auth_model->getAdminDetail($username);

		if (valid_email($result['email']))
		{
    		$pass = $this->encrypt->decode($result['pass']);

    		$msg = 'Successfully Recovered Your Username and Password <br><br> Username = '.$result['username'].'<br>Password = '.$pass;

    		$this->email->from('PremiumCalculator@gmail.com');
    		$this->email->to($result['email']);
    		$this->email->subject('Password Recovery'); 
    		$this->email->message($msg);
    		$result = $this->email->send();

    		if($result)
    		{
				$msg = 'Successfully Recovered Password <br>Please Check Your Mail !!';
				$this->session->set_userdata('flash_msg_logout', $msg);
				redirect (base_url().'admin-login.html');
    		}
    		else
    		{
    			$msg = 'Failed Due To Server Error';
				$this->session->set_userdata('flash_msg_err_login', $msg);
				redirect (base_url().'admin-login.html');	
    		}
		}
		else
		{
    		$msg = 'Email Address Provided By You is Invalid';
			$this->session->set_userdata('flash_msg_err_login', $msg);
			redirect (base_url().'admin-login.html');	
		}
	}


}

