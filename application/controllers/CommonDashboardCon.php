<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	date_default_timezone_set("Asia/Kolkata");
	class CommonDashboardCon extends CI_Controller
	{
		private $username;
		private $Oldpassword;
		public function dashboard()
		{
			if($this->session->has_userdata('username'))
			{	
				$Arr = array();
				$Arr = $this->getUsername($this->session->userdata('username'));
				/*var_dump($Arr);
				die;*/
				$this->load->view('common/headerView.php',$Arr);
				$this->load->view('common/leftSideBar.php',$Arr);
				$this->load->view('commonadmin/dashboard.php',$Arr);
				$this->load->view('common/footerView.php',$Arr);
			}
			else
			{
				redirect('LoginCon/index');
			}
		}
		private function getStudentCount($id)
		{
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->get_no_of_students($id);
			if(isset($rs[0]['ct'])) return $rs[0]['ct'];
		}
		private function getUsername($username)
		{
			$this->load->model('CommonAdmin_model');
			$name = $this->CommonAdmin_model->getUsername($username);
			$student_count = $this->getStudentCount($username);
			$schoolAdmin_count = $this->getSchoolAdminCount($username);
			$teacher_count = $this->getTeacherCount($username);
			$affiliation_count = $this->getAffiliationCount($username);
			$mappCount = $this->getMappingCount($username);
			if(isset($name[0]['name']) && $name[0]['name'] !='') return array('name'=>$name[0]['name'],'no_of_student'=>$student_count,'no_of_schoolAdmin'=>$schoolAdmin_count,'no_of_teacher'=>$teacher_count,'No_of_affiliation'=>$affiliation_count,'no_of_mapped_school'=>$mappCount);
		}
		private function getSchoolCount($id)
		{
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->get_no_of_students($id);
			if(isset($rs[0]['ct'])) return $rs[0]['ct'];
		}
		private function getSchoolAdminCount($id)
		{
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->get_no_of_schoolAdmins($id);
			
			if(isset($rs[0]['ct'])) return $rs[0]['ct'];
		}
		private function getTeacherCount($id)
		{
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->get_no_of_teachers($id);
			
			if(isset($rs[0]['ct'])) return $rs[0]['ct'];
		}
		private function getAffiliationCount($id)
		{
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->get_no_of_affiliations($id);
			
			if(isset($rs[0]['ct'])) return $rs[0]['ct'];
		}
		private function getMappingCount($id)
		{
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->get_no_of_mapped_school($id);
			
			if(isset($rs[0]['ct'])) return $rs[0]['ct'];
		}
		public function changePassword()
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('txtOld', 'Old Password', 'required');
			$this->form_validation->set_rules('txtNew', 'New Password', 'required|matches[txtConfirm]');
			$this->form_validation->set_rules('txtConfirm', 'Confirm Password', 'required');
			if($this->form_validation->run())
			{
				$this->load->model('CommonAdmin_model');
				$this->Oldpassword = $this->input->post('txtOld');
				if($this->session->has_userdata('username'))
				{
					$this->username = $this->session->userdata('username');
					$status = $this->CommonAdmin_model->CheckPassword($this->username,$this->Oldpassword);
					/*var_dump($status);
					die;*/
					if(isset($status[0]['ct']) && $status[0]['ct']>0)
					{
						$newPass = $this->input->post('txtNew');
						$this->CommonAdmin_model->UpdatePassword($this->username,$newPass);
						$this->session->set_flashdata('updatePassSuccess', 'Password Changed');
						redirect(base_url('CommonDashboardCon/dashboard'));
					}
					else
					{
						$this->session->set_flashdata('incorrectOld', 'Your Old password is Incorrect..!!');
						redirect(base_url('CommonDashboardCon/dashboard'));	
					}
				}
			}
			else
			{
				$this->session->set_flashdata('updatePassFailed', 'Mismatch Password');
				redirect(base_url('CommonDashboardCon/dashboard'));
			}
		}
		public function SignOut()
		{
			if($this->session->has_userdata('username'))
			{
				$this->load->model('Common_model');
				$this->username = $this->session->userdata('username');
				$this->load->model('CommonAdmin_model');
				$rs = $this->Common_model->getLoginTime($this->username);
				$loginTime = isset($rs[0]['login_at']) ? $rs[0]['login_at'] : '0000-00-00 00:00:00';
				$current_time = date("Y-m-d H:i:s");
				$dateDiff = strtotime($current_time)-strtotime($loginTime);
				$minutes = $dateDiff%60;
				$this->Common_model->UpdateSignOutTime($this->username,$current_time,$loginTime,$minutes);
				$this->session->sess_destroy();
				redirect(base_url('LoginCon/index'));
			}
		}
		public function getSchools($username)
		{
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->getAllSchool($username);
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
						'registered_on'  => $ivalue['registered_on']
 					);
				}
			}
			return $arr;
		}
		public function getSchoolsAdmin($username)
		{
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->getAllSchoolsAdmin($username);
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
		public function getTeachers($username)
		{
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->getAllTeachers($username);
			$arr = array();
			if(isset($rs) && count($rs)>0)
			{
				foreach ($rs as $ikey => $ivalue)
				{
					$name = 'Mr. '.$ivalue['teacher_name'];
					if(isset($ivalue['sex']) && $ivalue['sex'] == 'FEMALE') $name = 'Ms. '.$ivalue['teacher_name'];
					$arr[] = array(
						'teacher_id'   => $ivalue['id'],
						'teacher_name' => $name,
						'address' 	   => $ivalue['address'],
						'contact_no'   => $ivalue['contact_no'],
						'email_id'     => $ivalue['email_id'],
						'age'          => $ivalue['age'],
						'education'    => $ivalue['education'],
						'subject'      => $ivalue['subject'],
						'experience'   => $ivalue['experience'],
						'enrolled_on'   => $ivalue['enrolled_on']
 					);
				}
			}
			return $arr;
		}
		public function viewschoolMapping()
		{
			$user = ($this->session->has_userdata('username')) ? $this->session->userdata('username') : ''; 
			$FinalArr = array();
			$FinalArr = array(
				'name'                 => $user,
				'school_admin_details' => $this->getSchoolsAdmin($user),
				'school_details'       => $this->getSchools($user),
				'teacher_details'      => $this->getTeachers($user),
			);
			$this->load->view('common/headerView.php',$FinalArr);
			$this->load->view('common/leftSideBar.php',$FinalArr);
			$this->load->view('school_mapping/mappSchool',$FinalArr);
			$this->load->view('common/footerView.php',$FinalArr);
		}
		public function Mapping_exists($school_id,$school_admin_id,$teacher_id)
		{
			$check = false;
			$this->load->model('CommonAdmin_model');
			$rs = $this->CommonAdmin_model->school_mapping_exists($school_id,$school_admin_id,$teacher_id);
			if(isset($rs[0]['id'])) $check = true;
			return $check;
		}
		public function createSchoolMap()
		{
			$user = ($this->session->has_userdata('username')) ? $this->session->userdata('username') : '';
			$this->load->library('form_validation');
			$this->form_validation->set_rules('cmbSchool', 'School', 'required');
			$this->form_validation->set_rules('cmbSchoolAdmin', 'School Admin', 'required');
			$this->form_validation->set_rules('cmbTeacher', 'Teacher', 'required');
			if($this->form_validation->run())
			{
				$school_id = $this->input->post('cmbSchool');
				$school_admin_id = $this->input->post('cmbSchoolAdmin');
				$teacher_id = $this->input->post('cmbTeacher');
				$check = $this->Mapping_exists($school_id,$school_admin_id,$teacher_id);
				if(!$check)
				{
					$this->load->model('CommonAdmin_model');
					$arr = array(
						'school_id'       => $school_id, 
						'school_admin_id' => $school_admin_id,
						'teacher_id'      => $teacher_id,
						'super_admin_id'  => $user
					);
					$this->CommonAdmin_model->Insert_school_mapping($arr);
					$this->session->set_flashdata('updatePassSuccess', 'Sucessfully assigned..!!');
					redirect(base_url('CommonDashboardCon/dashboard'));
				}
				else
				{
					$this->session->set_flashdata('updatePassFailed', 'This school already assigned..!!');
					redirect(base_url('CommonDashboardCon/viewschoolMapping'));
				}
			}
			else
			{
				$this->session->set_flashdata('updatePassFailed', 'Please select all the details below..!!');
				redirect(base_url('CommonDashboardCon/viewschoolMapping'));
			}
		}
	}
?>