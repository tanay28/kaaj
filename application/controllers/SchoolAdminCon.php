<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set("Asia/Kolkata");
	
	class SchoolAdminCon extends CI_Controller
	{
		private $username;

		public function index()
		{
			if($this->session->has_userdata('username'))
			{
				$Arr = array();
				$Arr = $this->getUsername($this->session->userdata('username'));
				$this->load->view('common/headerView.php',$Arr);
				$this->load->view('common/leftSideBar.php',$Arr);
				$this->load->view('schooladmin/dashboard.php',$Arr);
				$this->load->view('common/footerView.php',$Arr);
			}
			else
			{
				redirect('LoginCon/index');
			}
		}
		private function getUsername($username)
		{
			$this->load->model('Superadmin_model');
			$name = $this->Superadmin_model->getUsername($username);
			$arr_details = $this->getSchoolsAdmin($username);
			if(isset($name[0]['name']) && $name[0]['name'] !='') return array('name'=>$name[0]['name'],'schoolAdmin_details'=>$arr_details);
		}
		public function Create_new_schoolAdmin()
		{
			$Arr = array();
			$Arr = $this->getUsername($this->session->userdata('username'));
			$this->load->view('common/headerView.php',$Arr);
			$this->load->view('common/leftSideBar.php',$Arr);
			$this->load->view('schooladmin/new/createSchoolAdmin',$Arr);
			$this->load->view('common/footerView.php',$Arr);
		}
		public function createSchoolAdmin()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtSchoolAdminName', 'School AdminName', 'required');
			$this->form_validation->set_rules('txtAddress', 'Address', 'required');
			$this->form_validation->set_rules('txtContactNo', 'Contact Number', 'required|numeric');
			$this->form_validation->set_rules('txtEmailId', 'Affiliations', 'required');
			if($this->form_validation->run())
			{
				$arr = array(

					'schoolAdmin_name'    => $this->input->post('txtSchoolAdminName'),
					'schoolAdmin_address' => $this->input->post('txtAddress'),
					'contact_no'          => $this->input->post('txtContactNo'),
					'admin_id'            => $this->session->userdata('username'),
					'email_id'            => $this->input->post('txtEmailId'),
					'created_on'          => date('Y-m-d')
				);
				$this->load->model('SchoolAdmin_model');
				$status = $this->SchoolAdmin_model->is_schholAdmin_exists($this->input->post('txtEmailId'));
				if(isset($status[0]['ct']) && $status[0]['ct'] == 0)
				{
					$this->SchoolAdmin_model->insertSchoolAdminDetails($arr);
					$this->session->set_flashdata('school_created', 'School admin successfully created..!!');
					redirect(base_url('SchoolAdminCon/index'));	
				}
				else
				{
					$this->session->set_flashdata('school_exists', 'School Admin Already Exists..!!');
					redirect(base_url('SchoolAdminCon/index'));	
				}
				
			}
			else
			{
				$this->session->set_flashdata('validationErr', 'Please enter all fields..!!');
				redirect(base_url('SchoolAdminCon/index'));
			}
		}
		public function getSchoolsAdmin($username)
		{
			$this->load->model('SchoolAdmin_model');
			$rs = $this->SchoolAdmin_model->getAllSchoolsAdmin($username);
			$arr = array();
			if(isset($rs) && count($rs)>0)
			{
				foreach ($rs as $ikey => $ivalue)
				{
					$arr[] = array(
						'schoolAdmin_id'      => $ivalue['id'],
						'schoolAdmin_name'    => $ivalue['schoolAdmin_name'],
						'schoolAdmin_address' => $ivalue['schoolAdmin_address'],
						'contact_no'          => $ivalue['contact_no'],
						'email_id'            => $ivalue['email_id']
					);
				}
			}
			return $arr;
		}
		public function edit_schoolAdmin()
		{
			$schoolAdmin_id = $this->uri->segment(3);
			/*var_dump($school_name);
			die;*/
			if($schoolAdmin_id != '')
			{
				$id = $this->session->userdata('username');
				$this->load->model('SchoolAdmin_model');
				$rs = $this->SchoolAdmin_model->getAllSchoolsAdmin($id,$schoolAdmin_id);
				$arr['edit'] = 1;
				$arr['name'] = $id;
				if(isset($rs) && count($rs)>0)
				{
					$arr1 = array();
					foreach ($rs as $ikey => $ivalue)
					{
						$arr1['schoolAdmin_id'] = $ivalue['id'];
						$arr1['schoolAdmin_name'] = $ivalue['schoolAdmin_name'];
						$arr1['schoolAdmin_address'] = $ivalue['schoolAdmin_address'];
						$arr1['contact_no'] = $ivalue['contact_no'];
						$arr1['email_id'] = $ivalue['email_id'];
					}
				}
				$arr['schoolAdmin_details'] = $arr1;
				$this->load->view('common/headerView.php',$arr);
				$this->load->view('common/leftSideBar.php',$arr);
				$this->load->view('schooladmin/new/createSchoolAdmin',$arr);
				$this->load->view('common/footerView.php',$arr);
				
			}
		}
		public function editSchoolAdmin()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtSchoolAdminId', 'School Admin Id', 'required');
			$this->form_validation->set_rules('txtSchoolAdminName', 'School Name', 'required');
			$this->form_validation->set_rules('txtAddress', 'Address', 'required');
			$this->form_validation->set_rules('txtContactNo', 'Contact Number', 'required|numeric');
			$this->form_validation->set_rules('txtEmailId', 'Affiliations', 'required');
			if($this->form_validation->run())
			{
				$arr = array(

					'schoolAdmin_id'      => $this->input->post('txtSchoolAdminId'),
					'schoolAdmin_name'    => $this->input->post('txtSchoolAdminName'),
					'schoolAdmin_address' => $this->input->post('txtAddress'),
					'contact_no'          => $this->input->post('txtContactNo'),
					'email_id'            => $this->input->post('txtEmailId'),
					'admin_id'            => $this->session->userdata('username')
				);
				$this->load->model('SchoolAdmin_model');
				$status = $this->SchoolAdmin_model->changeSchoolAdminDetails($arr);
				if($status != 0)
				{
					$this->session->set_flashdata('edit_success', 'School admin edited successfully.');
					redirect(base_url('SchoolAdminCon/index'));		
				}
				else
				{
					$this->session->set_flashdata('edit_failed', 'Internal error..!!');
					redirect(base_url('SchoolAdminCon/index'));	
				}
				
			}
			else
			{
				$this->session->set_flashdata('validationErr', 'Please enter all fields..!!');
				redirect(base_url('SchoolAdminCon/index'));
			}
		}
		public function del_schoolAdmin()
		{
			$schoolAdmin_id = $this->uri->segment(3);
			
			if($schoolAdmin_id != '')
			{
				$admin_id = $this->session->userdata('username');
				$this->load->model('SchoolAdmin_model');
				$this->SchoolAdmin_model->Delete_schoolAdmin($admin_id,$schoolAdmin_id);
				$this->session->set_flashdata('del_success', 'School admin deleted successfully.');
				redirect(base_url('SchoolAdminCon/index'));
			}
			else
			{
				$this->session->set_flashdata('del_failed', 'Error...!! Please try again.');
				redirect(base_url('SchoolAdminCon/index'));	
			}
		}
		
	}
?>