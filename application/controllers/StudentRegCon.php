<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set("Asia/Kolkata");
	class StudentRegCon extends CI_Controller
	{
		private $username;

		public function index()
		{
			$this->username = ($this->session->has_userdata('username')) ? $this->session->userdata('username') : '';
			$Arr = array('name'=>$this->username,'student_details'=>$this->GetAllStudents());
			$this->load->view('common/headerView.php',$Arr);
			$this->load->view('common/leftSideBar.php',$Arr);
			$this->load->view('commonadmin/student/dashboard.php',$Arr);
			$this->load->view('common/footerView.php',$Arr);
		}
		private function GetAllStudents()
		{
			$arr = array();
			$this->load->model('StudentReg_model');
			$rs = $this->StudentReg_model->getAllStudents();
			if(isset($rs) && count($rs)>0)
			{
				foreach ($rs as $ikey => $ivalue)
				{
					$arr[] = array(
						'student_id'        => $ivalue['student_id'],
						'student_name'      => $ivalue['student_name'],
						'age'               => $ivalue['age'],
						'sex'               => $ivalue['sex'],
						'father_name'       => $ivalue['father_name'],
						'mother_name'       => $ivalue['mother_name'],
						'father_occupation' => $ivalue['father_occupation'],
						'mother_occupation' => $ivalue['mother_occupation'],
						'guardian_name'     => $ivalue['guardian_name'],
						'contact_no'        => $ivalue['contact_no'],
						'student_address'   => $ivalue['student_address'],
						'class'             => $ivalue['class'],
						'section'           => $ivalue['section'],
						'registered_on'     => $ivalue['registered_on']
					);
				}
			}
			return $arr;
		}
		public function Create_new_student()
		{
			$this->username = ($this->session->has_userdata('username')) ? $this->session->userdata('username') : '';
			$Arr = array('name'=>$this->username,'reg_no'=>$this->generateRegNo());
			$this->load->view('common/headerView.php',$Arr);
			$this->load->view('common/leftSideBar.php',$Arr);
			$this->load->view('commonadmin/student/new/createStudent.php',$Arr);
			$this->load->view('common/footerView.php',$Arr);
		}
		private function get_last_id()
		{
			$last = '001';
			$this->load->model('StudentReg_model');
			$rs = $this->StudentReg_model->getLastId();
			if(isset($rs[0]['student_id']))
			{
				$ex = explode('R', $rs[0]['student_id']);
				$last = $ex + 1;
			}
			return $last;
		}
		public function generateRegNo()
		{
			$last = $this->get_last_id();
			$yr = date('y');
			$reg_no = $yr."R".$last;
			return $reg_no;
		}
		public function createStudent()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtStudentId', 'Reg No', 'required');
			$this->form_validation->set_rules('txtStudentName', 'Student Name', 'required');
			$this->form_validation->set_rules('txtAge', 'Age', 'required');
			$this->form_validation->set_rules('cmbSex', 'Sex', 'required');
			$this->form_validation->set_rules('txtFatherName', 'Father Name', 'required');
			$this->form_validation->set_rules('txtMotherName', 'Mother Name', 'required');
			$this->form_validation->set_rules('txtFatherOccupation', 'Father Occupation', 'required');
			$this->form_validation->set_rules('txtMotherOccupation', 'Reg No', 'required');
			$this->form_validation->set_rules('txtGuardianName', 'Reg No', 'required');
			$this->form_validation->set_rules('txtContactNo', 'Reg No', 'required');
			$this->form_validation->set_rules('txtAddress', 'Reg No', 'required');
			$this->form_validation->set_rules('cmbSection', 'Reg No', 'required');
			$this->form_validation->set_rules('txtRegisteredOn', 'Reg No', 'required');
			$this->form_validation->set_rules('cmbClass', 'Reg No', 'required');
			if($this->form_validation->run())
			{
				$this->load->model('StudentReg_model');
				$arr = array(
					'student_id'        => $this->input->post('txtStudentId'),
					'student_name'      => $this->input->post('txtStudentName'),
					'age'               => $this->input->post('txtAge'),
					'sex'               => $this->input->post('cmbSex'),
					'father_name'       => $this->input->post('txtFatherName'),
					'mother_name'       => $this->input->post('txtMotherName'),
					'father_occupation' => $this->input->post('txtFatherOccupation'),
					'mother_occupation' => $this->input->post('txtMotherOccupation'),
					'guardian_name'     => $this->input->post('txtGuardianName'),
					'contact_no'        => $this->input->post('txtContactNo'),
					'student_address'   => $this->input->post('txtAddress'),
					'section'           => $this->input->post('cmbSection'),
					'registered_on'     => $this->input->post('txtRegisteredOn'),
					'class'             => $this->input->post('cmbClass'),
					'admin_id'          => $this->session->userdata('username')
				);
				$this->StudentReg_model->insert_student_details($arr);
				$this->session->set_flashdata('updatePassSuccess','Student Successfully Registered');
				redirect('CommonDashboardCon/dashboard');
			}
		}
		public function edit_student()
		{
			$id = $this->uri->segment(3);
			var_dump($id);
		}
	}

?>