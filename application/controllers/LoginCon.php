<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set("Asia/Kolkata");
class LoginCon extends CI_Controller 
{
	private $username;
	private $password;
	private $current_time;
	public function index()
	{
		if($this->session->has_userdata('username'))
		{
			redirect("SuperAdminCon/dashboard");
		}
		else
		{
			$this->load->view('loginView');	
		}
		
	}
	public function CheckLogin()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('txtEmail', 'Username', 'required');
		$this->form_validation->set_rules('txtPassword', 'Password', 'required');
		if($this->form_validation->run())
		{
			$this->username = $this->input->post('txtEmail');
			$this->password = $this->input->post('txtPassword');
			$this->load->model('Login_model');
			$this->load->model('Common_model');
			$status = $this->Login_model->authentication($this->username,$this->password);
			if(isset($status[0]['type']) && $status[0]['type'] =='superadmin')
			{

				$current_time = date("Y-m-d H:i:s");
				$this->Common_model->loginInfo($this->username,$current_time);
				$this->session->set_userdata('username',$this->username);
				$this->session->set_userdata('usertype',$status[0]['type']);
				redirect("SuperAdminCon/dashboard");
			}
			elseif(isset($status[0]['type']) && ($status[0]['type'] =='schooladmin' || $status[0]['type'] =='teacher'))
			{
				$current_time = date("Y-m-d H:i:s");
				$this->Common_model->loginInfo($this->username,$current_time);
				$this->session->set_userdata('username',$this->username);
				$this->session->set_userdata('usertype',$status[0]['type']);
				redirect("CommonDashboardCon/dashboard");	
			}
			else
			{
				$this->session->set_flashdata('AuthErr', 'Please enter valid Email or Password..!!');
				redirect(base_url('LoginCon/index'));		
			}
		}
		else
		{
			$this->session->set_flashdata('validationErr', 'All fields are required..!!');
			redirect(base_url('LoginCon/index'));
		}
		
	}
}
