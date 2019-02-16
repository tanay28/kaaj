<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set("Asia/Kolkata");
	
	class AffiliationCon extends CI_Controller
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
				$this->load->view('affiliations/dashboard.php',$Arr);
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
			$arr_details = $this->getAffiliation($username);
			if(isset($name[0]['name']) && $name[0]['name'] !='') return array('name'=>$name[0]['name'],'affiliation_details'=>$arr_details);
		}
		public function Create_new_affiliation()
		{
			$Arr = array();
			$Arr = $this->getUsername($this->session->userdata('username'));
			$this->load->view('common/headerView.php',$Arr);
			$this->load->view('common/leftSideBar.php',$Arr);
			$this->load->view('affiliations/new/createAffiliation',$Arr);
			$this->load->view('common/footerView.php',$Arr);
		}
		public function createAffiliation()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtAffiliationName', 'Affiliation Name', 'required');
			$this->form_validation->set_rules('txtCode', 'Affiliation Code', 'required');
			if($this->form_validation->run())
			{
				$arr = array(

					'affiliation_name'    => $this->input->post('txtAffiliationName'),
					'affiliation_code'    => $this->input->post('txtCode'),
					'admin_id'            => $this->session->userdata('username'),
					'created_on'          => date('Y-m-d')
				);
				$this->load->model('Affiliation_model');
				$status = $this->Affiliation_model->is_affiliation_exists($this->input->post('txtCode'));
				if(isset($status[0]['ct']) && $status[0]['ct'] == 0)
				{
					$this->Affiliation_model->insertAffiliationDetails($arr);
					$this->session->set_flashdata('school_created', 'Affiliation successfully created..!!');
					redirect(base_url('AffiliationCon/index'));	
				}
				else
				{
					$this->session->set_flashdata('school_exists', 'Affiliation Already Exists..!!');
					redirect(base_url('AffiliationCon/index'));	
				}
				
			}
			else
			{
				$this->session->set_flashdata('validationErr', 'Please enter all fields..!!');
				redirect(base_url('AffiliationCon/index'));
			}
		}
		public function getAffiliation($username)
		{
			$this->load->model('Affiliation_model');
			$rs = $this->Affiliation_model->getAllAffiliations($username);
			$arr = array();
			if(isset($rs) && count($rs)>0)
			{
				foreach ($rs as $ikey => $ivalue)
				{
					$arr[] = array(
						'affiliation_id'      => $ivalue['id'],
						'affiliation_name'    => $ivalue['affiliation_name'],
						'affiliation_code'    => $ivalue['affiliation_code']
					);
				}
			}
			return $arr;
		}
		public function edit_affiliation()
		{
			$affiliation_id = $this->uri->segment(3);
			/*var_dump($school_name);
			die;*/
			if($affiliation_id != '')
			{
				$id = $this->session->userdata('username');
				$this->load->model('Affiliation_model');
				$rs = $this->Affiliation_model->getAllAffiliations($id,$affiliation_id);
				$arr['edit'] = 1;
				$arr['name'] = $id;
				if(isset($rs) && count($rs)>0)
				{
					$arr1 = array();
					foreach ($rs as $ikey => $ivalue)
					{
						$arr1['affiliation_id'] = $ivalue['id'];
						$arr1['affiliation_name'] = $ivalue['affiliation_name'];
						$arr1['affiliation_code'] = $ivalue['affiliation_code'];
					}
				}
				$arr['affiliation_details'] = $arr1;
				$this->load->view('common/headerView.php',$arr);
				$this->load->view('common/leftSideBar.php',$arr);
				$this->load->view('affiliations/new/createAffiliation',$arr);
				$this->load->view('common/footerView.php',$arr);
				
			}
		}
		public function editAffiliation()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtAffiliationName', 'Affiliation Name', 'required');
			$this->form_validation->set_rules('txtCode', 'Affiliation Code', 'required');
			if($this->form_validation->run())
			{
				$arr = array(

					'affiliation_id'      => $this->input->post('txtAffiliationId'),
					'affiliation_name'    => $this->input->post('txtAffiliationName'),
					'affiliation_code'    => $this->input->post('txtCode'),
					'admin_id'            => $this->session->userdata('username')
				);
				$this->load->model('Affiliation_model');
				$status = $this->Affiliation_model->changeAffiliationDetails($arr);
				if($status != 0)
				{
					$this->session->set_flashdata('edit_success', 'Affiliation edited successfully.');
					redirect(base_url('AffiliationCon/index'));		
				}
				else
				{
					$this->session->set_flashdata('edit_failed', 'Internal error..!!');
					redirect(base_url('AffiliationCon/index'));	
				}
				
			}
			else
			{
				$this->session->set_flashdata('validationErr', 'Please enter all fields..!!');
				redirect(base_url('AffiliationCon/index'));
			}
		}
		public function del_affiliation()
		{
			$affiliation_id = $this->uri->segment(3);
			
			if($affiliation_id != '')
			{
				$admin_id = $this->session->userdata('username');
				$this->load->model('Affiliation_model');
				$this->Affiliation_model->Delete_affiliation($admin_id,$affiliation_id);
				$this->session->set_flashdata('del_success', 'Affiliation deleted successfully.');
				redirect(base_url('AffiliationCon/index'));
			}
			else
			{
				$this->session->set_flashdata('del_failed', 'Error...!! Please try again.');
				redirect(base_url('AffiliationCon/index'));	
			}
		}

	}
?>