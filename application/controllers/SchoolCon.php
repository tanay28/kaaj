<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set("Asia/Kolkata");
	
	class SchoolCon extends CI_Controller
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
				$this->load->view('schools/dashboard.php',$Arr);
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
			$arr = $this->getAffiliations($username);
			$arr_details = $this->getSchools($username);
			if(isset($name[0]['name']) && $name[0]['name'] !='') return array('name'=>$name[0]['name'],'affiliations'=>$arr,'school_details'=>$arr_details);
		}
		private function getAffiliations($id)
		{
			$arr = array();
			$this->load->model('School_model');
			$rs = $this->School_model->getAllAffiliations($id);
			if(isset($rs) && count($rs)>0)
			{
				foreach ($rs as $ikey => $ivalue)
				{
					$arr[] = $ivalue['affiliation_code'];
				}
			}
			return $arr;
		}
		public function Create_new_school()
		{
			$Arr = array();
			$Arr = $this->getUsername($this->session->userdata('username'));
			$this->load->view('common/headerView.php',$Arr);
			$this->load->view('common/leftSideBar.php',$Arr);
			$this->load->view('schools/new/createSchool',$Arr);
			$this->load->view('common/footerView.php',$Arr);
		}
		public function createSchool()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtSchoolName', 'School Name', 'required');
			$this->form_validation->set_rules('txtAddress', 'Address', 'required');
			$this->form_validation->set_rules('txtContactNo', 'Contact Number', 'required|numeric');
			$this->form_validation->set_rules('cmbAffiliation', 'Affiliations', 'required');
			$this->form_validation->set_rules('txtRegisteredOn', 'Affiliations', 'required');
			if($this->form_validation->run())
			{
				$arr = array(

					'school_name'    => $this->input->post('txtSchoolName'),
					'school_address' => $this->input->post('txtAddress'),
					'contact_no'     => $this->input->post('txtContactNo'),
					'affiliated_to'  => $this->input->post('cmbAffiliation'),
					'admin_id'       => $this->session->userdata('username'),
					'registered_on'  => $this->input->post('txtRegisteredOn')
				);
				$this->load->model('School_model');
				$status = $this->School_model->is_schhol_exists($this->input->post('txtSchoolName'));
				if(isset($status[0]['ct']) && $status[0]['ct'] == 0)
				{
					$this->School_model->insertSchoolDetails($arr);
					$this->session->set_flashdata('school_created', 'School successfully created..!!');
					redirect(base_url('SchoolCon/index'));	
				}
				else
				{
					$this->session->set_flashdata('school_exists', 'School Already Exists..!!');
					redirect(base_url('SchoolCon/index'));	
				}
				
			}
			else
			{
				$this->session->set_flashdata('validationErr', 'Please enter all fields..!!');
				redirect(base_url('SchoolCon/index'));
			}
		}
		public function getSchools($username)
		{
			$this->load->model('School_model');
			$rs = $this->School_model->getAllSchools($username);
			$arr = array();
			if(isset($rs) && count($rs)>0)
			{
				foreach ($rs as $ikey => $ivalue)
				{
					$arr[] = array(
						'school_id'      => $ivalue['id'],
						'school_name'    => $ivalue['school_name'],
						'school_address' => $ivalue['school_address'],
						'contact_no'     => $ivalue['contact_no'],
						'affiliated_to'  => $ivalue['affiliated_to'],
						'registered_on'  => $ivalue['registered_on'],
					);
				}
			}
			return $arr;
		}
		public function edit_school()
		{
			$school_id = $this->uri->segment(3);
			/*var_dump($school_name);
			die;*/
			if($school_id != '')
			{
				$id = $this->session->userdata('username');
				$this->load->model('School_model');
				$rs = $this->School_model->getAllSchools($id,$school_id);
				$arrAff = $this->getAffiliations($id);
				$arr['edit'] = 1;
				$arr['name'] = $id;
				$arr['affiliations'] = $arrAff; 
				if(isset($rs) && count($rs)>0)
				{
					$arr1 = array();
					foreach ($rs as $ikey => $ivalue)
					{
						$arr1['school_id'] = $ivalue['id'];
						$arr1['school_name'] = $ivalue['school_name'];
						$arr1['school_address'] = $ivalue['school_address'];
						$arr1['contact_no'] = $ivalue['contact_no'];
						$arr1['affiliated_to'] = $ivalue['affiliated_to'];
						$arr1['registered_on'] = $ivalue['registered_on'];
					}
				}
				$arr['school_details'] = $arr1;
				$this->load->view('common/headerView.php',$arr);
				$this->load->view('common/leftSideBar.php',$arr);
				$this->load->view('schools/new/createSchool',$arr);
				$this->load->view('common/footerView.php',$arr);
				
			}
		}
		public function editSchool()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtSchoolId', 'School Id', 'required');
			$this->form_validation->set_rules('txtSchoolName', 'School Name', 'required');
			$this->form_validation->set_rules('txtAddress', 'Address', 'required');
			$this->form_validation->set_rules('txtContactNo', 'Contact Number', 'required|numeric');
			$this->form_validation->set_rules('cmbAffiliation', 'Affiliations', 'required');
			$this->form_validation->set_rules('txtRegisteredOn', 'Affiliations', 'required');
			if($this->form_validation->run())
			{
				$arr = array(

					'school_id'      => $this->input->post('txtSchoolId'),
					'school_name'    => $this->input->post('txtSchoolName'),
					'school_address' => $this->input->post('txtAddress'),
					'contact_no'     => $this->input->post('txtContactNo'),
					'affiliated_to'  => $this->input->post('cmbAffiliation'),
					'registered_on'  => $this->input->post('txtRegisteredOn'),
					'admin_id'       => $this->session->userdata('username')
				);
				$this->load->model('School_model');
				$status = $this->School_model->changeSchoolDetails($arr);
				if($status != 0)
				{
					$this->session->set_flashdata('edit_success', 'School edited successfully.');
					redirect(base_url('SchoolCon/index'));		
				}
				else
				{
					$this->session->set_flashdata('edit_failed', 'Internal error..!!');
					redirect(base_url('SchoolCon/index'));	
				}
				
			}
			else
			{
				$this->session->set_flashdata('validationErr', 'Please enter all fields..!!');
				redirect(base_url('SchoolCon/index'));
			}
		}
		public function del_school()
		{
			$school_id = $this->uri->segment(3);
			
			if($school_id != '')
			{
				$admin_id = $this->session->userdata('username');
				$this->load->model('School_model');
				$this->School_model->Delete_school($admin_id,$school_id);
				$this->session->set_flashdata('del_success', 'School deleted successfully.');
				redirect(base_url('SchoolCon/index'));
			}
			else
			{
				$this->session->set_flashdata('del_failed', 'Error...!! Please try again.');
				redirect(base_url('SchoolCon/index'));	
			}
		}

	}
?>