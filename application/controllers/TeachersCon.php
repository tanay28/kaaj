<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set("Asia/Kolkata");
	
	class TeachersCon extends CI_Controller
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
				$this->load->view('teachers/dashboard.php',$Arr);
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
			$arr_details = $this->getTeachers($username);
			if(isset($name[0]['name']) && $name[0]['name'] !='') return array('name'=>$name[0]['name'],'teacher_details'=>$arr_details);
		}
		public function Create_new_teacher()
		{
			$Arr = array();
			$Arr = $this->getUsername($this->session->userdata('username'));
			$this->load->view('common/headerView.php',$Arr);
			$this->load->view('common/leftSideBar.php',$Arr);
			$this->load->view('teachers/new/createTeacher',$Arr);
			$this->load->view('common/footerView.php',$Arr);
		}
		public function createTeacher()
		{
			$experience =  0;
			if($this->input->post('txtExperience')) $experience = $this->input->post('txtExperience'); 

			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtTeacherName', 'Teacher Name', 'required');
			$this->form_validation->set_rules('txtAddress', 'Address', 'required');
			$this->form_validation->set_rules('txtContactNo', 'Contact Number', 'required|numeric');
			$this->form_validation->set_rules('txtEmailId', 'Email Id', 'valid_email|required');
			$this->form_validation->set_rules('RdoSex', 'Sex', 'required');
			$this->form_validation->set_rules('txtAge', 'Age', 'required|numeric');
			$this->form_validation->set_rules('txtEducation', 'Educational Qualification', 'required');
			$this->form_validation->set_rules('txtSubject', 'Subject Tought', 'required');
			if($this->form_validation->run())
			{
				$arr = array(

					'teacher_name' => strtoupper($this->input->post('txtTeacherName')),
					'address'      => $this->input->post('txtAddress'),
					'contact_no'   => $this->input->post('txtContactNo'),
					'email_id'     => $this->input->post('txtEmailId'),
					'admin_id'     => $this->session->userdata('username'),
					'sex'          => $this->input->post('RdoSex'),
					'age'  		   => $this->input->post('txtAge'),
					'education'    => strtoupper($this->input->post('txtEducation')),
					'subject'      => $this->input->post('txtSubject'),
					'experience'   => $experience,
					'enrolled_on'   => date('Y-m-d')
				);
				$this->load->model('Teacher_model');
				$status = $this->Teacher_model->is_teacher_exists($this->input->post('txtEmailId'));
				if(isset($status[0]['ct']) && $status[0]['ct'] == 0)
				{
					$this->Teacher_model->insertTeacherDetails($arr);
					$this->session->set_flashdata('school_created', 'Teacher Enrolled Successfully..!!');
					redirect(base_url('TeachersCon/index'));	
				}
				else
				{
					$this->session->set_flashdata('school_exists', 'Teacher Already Exists..!!(Duplicate Email)');
					redirect(base_url('TeachersCon/index'));	
				}
				
			}
			else
			{
				/*echo validation_errors();
				die;*/
				$this->session->set_flashdata('validationErr', 'Please enter all required fields..!!');
				redirect(base_url('TeachersCon/index'));
			}
		}
		public function getTeachers($username)
		{
			$this->load->model('Teacher_model');
			$rs = $this->Teacher_model->getAllTeachers($username);
			$arr = array();
			if(isset($rs) && count($rs)>0)
			{
				foreach ($rs as $ikey => $ivalue)
				{
					$arr[] = array(
						'teacher_id'   => $ivalue['id'],
						'teacher_name' => $ivalue['teacher_name'],
						'address'      => $ivalue['address'],
						'contact_no'   => $ivalue['contact_no'],
						'email_id'     => $ivalue['email_id'],
						'sex'      	   => $ivalue['sex'],
						'age'    	   => $ivalue['age'],
						'education'    => $ivalue['education'],
						'subject'      => $ivalue['subject'],
						'experience'   => $ivalue['experience'],
						'enrolled_on'  => $ivalue['enrolled_on']
					);
				}
			}
			return $arr;
		}
		public function edit_teacher()
		{
			$teacher_id = $this->uri->segment(3);
			/*var_dump($school_name);
			die;*/
			if($teacher_id != '')
			{
				$id = $this->session->userdata('username');
				$this->load->model('Teacher_model');
				$rs = $this->Teacher_model->getAllTeachers($id,$teacher_id);
				$arr['edit'] = 1;
				$arr['name'] = $id;
				if(isset($rs) && count($rs)>0)
				{
					$arr1 = array();
					foreach ($rs as $ikey => $ivalue)
					{
						$arr1['teacher_id'] = $ivalue['id'];
						$arr1['teacher_name'] = $ivalue['teacher_name'];
						$arr1['address'] = $ivalue['address'];
						$arr1['contact_no'] = $ivalue['contact_no'];
						$arr1['email_id'] = $ivalue['email_id'];
						$arr1['sex'] = $ivalue['sex'];
						$arr1['age'] = $ivalue['age'];
						$arr1['address'] = $ivalue['address'];
						$arr1['education'] = $ivalue['education'];
						$arr1['subject'] = $ivalue['subject'];
						$arr1['experience'] = $ivalue['experience'];
						$arr1['enrolled_on'] = $ivalue['enrolled_on'];
					}
				}
				$arr['teacher_details'] = $arr1;
				/*echo "<pre>";
				var_dump($arr);
				die;*/
				$this->load->view('common/headerView.php',$arr);
				$this->load->view('common/leftSideBar.php',$arr);
				$this->load->view('teachers/new/createTeacher',$arr);
				$this->load->view('common/footerView.php',$arr);
				
			}
		}
		public function editTeacher()
		{
			$experience = ($this->input->post('txtExperience') != '') ? $this->input->post('txtExperience') : 0;
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtTeacherName', 'Teacher Name', 'required');
			$this->form_validation->set_rules('txtAddress', 'Address', 'required');
			$this->form_validation->set_rules('txtContactNo', 'Contact Number', 'required|numeric');
			$this->form_validation->set_rules('txtEmailId', 'Email Id', 'required');
			$this->form_validation->set_rules('RdoSex', 'Sex', 'required');
			$this->form_validation->set_rules('txtAge', 'Age', 'required|numeric');
			$this->form_validation->set_rules('txtEducation', 'Educational Qualification', 'required');
			$this->form_validation->set_rules('txtSubject', 'Subject Tought', 'required');
			if($this->form_validation->run())
			{
				$arr = array(

					'teacher_id'      => $this->input->post('txtTeacherId'),
					'teacher_name'    => $this->input->post('txtTeacherName'),
					'address'         => $this->input->post('txtAddress'),
					'contact_no'      => $this->input->post('txtContactNo'),
					'admin_id'        => $this->session->userdata('username'),
					'sex'             => $this->input->post('RdoSex'),
					'age'             => $this->input->post('txtAge'),
					'education'       => $this->input->post('txtEducation'),
					'subject'         => $this->input->post('txtSubject'),
					'experience'      => $experience
				);
				/*echo "<pre>";
				var_dump($arr);
				die;*/
				$this->load->model('Teacher_model');
				$status = $this->Teacher_model->changeTeacherDetails($arr);
				if($status != 0)
				{
					$this->session->set_flashdata('edit_success', 'Teacher details edited successfully.');
					redirect(base_url('TeachersCon/index'));		
				}
				else
				{
					$this->session->set_flashdata('edit_failed', 'Internal error..!!');
					redirect(base_url('TeachersCon/index'));	
				}
				
			}
			else
			{
				$this->session->set_flashdata('validationErr', 'Please enter all required fields..!!');
				redirect(base_url('TeachersCon/index'));
			}
		}
		public function del_teacher()
		{
			$teacher_id = $this->uri->segment(3);
			
			if($teacher_id != '')
			{
				$admin_id = $this->session->userdata('username');
				$this->load->model('Teacher_model');
				$this->SchoolAdmin_model->Delete_teacher($admin_id,$teacher_id);
				$this->session->set_flashdata('del_success', 'Teacher deleted successfully.');
				redirect(base_url('TeachersCon/index'));
			}
			else
			{
				$this->session->set_flashdata('del_failed', 'Error...!! Please try again.');
				redirect(base_url('TeachersCon/index'));	
			}
		}

	}
?>