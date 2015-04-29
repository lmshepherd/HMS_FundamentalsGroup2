<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('update_info');
	}
	
	public function update_medicalRecord(){
		$this->load->view('update_medical_view');
	}
	
	public function verify_password($str)
	{
		if (preg_match('#[0-9]#', $str) && preg_match('#[a-zA-Z]#', $str) && strlen($str)>5) {
			return TRUE;
		}
		$this->form_validation->set_message('verify_password','Your password must have a length of at least 6, and contain at least one number');
		return false;
	}
	
	public function password_recovery(){
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		//$this->form_validation->set_rules('username','Username','required|trim|');
		//check password field
		$this->form_validation->set_rules('password','Password','required|trim|callback_verify_password');
		//check cpassword field and make sure it matches password
		$this->form_validation->set_rules('cpassword','Confirm_Password','required|trim|matches[password]');
		//check email field
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		
		$this->form_validation->set_rules('homephone','Home Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
		
		if($this->form_validation->run()){
			if($this->update_info->password_change()){
				$this->load->view('login_view');
			}
			else{
				echo "Could not change password, your information provided did not match anything in our database";
			}
		}
		else{
			$this->load->view('password_change_view');
		}
	}
	
	public function change_password(){
		$this->load->view('password_change_view');
	}
	
	public function update_admin_info(){
		$this->load->view('admin_update_information');
	}
	
	public function change_height(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('height','Height','required|trim');
		
		if ($this->form_validation->run())
		{
			if($this->update_info->height_change()){
				
				$this->load->view('update_medical_view');
			}
			else{
				echo "Could not change height";
			}
		}
		else{
			$this->load->view('update_medical_view');
		}
		
	}
	
	public function change_weight(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('weight','weight','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->weight_change()){
	
				$this->load->view('update_medical_view');
			}
			else{
				echo "Could not change weight";
			}
		}
		else{
			$this->load->view('update_medical_view');
		}
	
	}
	
	public function change_surgery(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('surgery','Surgery','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->surgery_change()){
	
				$this->load->view('update_medical_view');
			}
			else{
				echo "Could not change surgery history";
			}
		}
		else{
			$this->load->view('update_medical_view');
		}
	
	}
	
	public function change_family(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('family','Family','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->family_change()){
	
				$this->load->view('update_medical_view');
			}
			else{
				echo "Could not change family history";
			}
		}
		else{
			$this->load->view('update_medical_view');
		}
	
	}
	
	public function change_religion(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('religion','Religion','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->religion_change()){
	
				$this->load->view('update_medical_view');
			}
			else{
				echo "Could not change religion";
			}
		}
		else{
			$this->load->view('update_medical_view');
		}
	
	}
	
	public function change_career(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('career','Career','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->career_change()){
	
				$this->load->view('update_medical_view');
			}
			else{
				echo "Could not change career";
			}
		}
		else{
			$this->load->view('update_medical_view');
		}
	
	}
	//
	public function change_alcohol(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('alcohol','Alcohol','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->alcohol_change()){
	
				$this->load->view('update_medical_view');
			}
			else{
				echo "Could not change alcohol use";
			}
		}
		else{
			$this->load->view('update_medical_view');
		}
	
	}
	public function change_smoking(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('smoker','Smoker','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->smoking_change()){
	
				$this->load->view('update_medical_view');
			}
			else{
				echo "Could not change smoking use";
			}
		}
		else{
			$this->load->view('update_medical_view');
		}
	
	}
	public function change_other(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('other','Other','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->other_change()){
	
				$this->load->view('update_medical_view');
			}
			else{
				echo "Could not change other notes";
			}
		}
		else{
			$this->load->view('update_medical_view');
		}
	
	}
	
	
	public function change_username_admin(){
	
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[userinfo.username]');
	
		//change message shown when username is already taken
		$this->form_validation->set_message('is_unique','That username is already in use.');
		if ($this->form_validation->run())
		{
			if($this->update_info->username_change()){
				$newuser = $this->input->post('username');
				$this->session->set_userdata('username', $newuser);
				$this->load->view('admin_update_information');
			}
			else{
				echo "Could not change username";
			}
		}
		else{
			$this->load->view('admin_update_information');
		}
	}
	
	public function change_email_admin(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->email_change()){
				$this->load->view('admin_update_information');
			}
			else{
				echo "Could not change email";
			}
		}
		else{
			$this->load->view('admin_update_information');
		}
	}
	
	
	public function change_homephone_admin(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('homephone','Home Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->homephone_change()){
				$this->load->view('admin_update_information');
			}
			else{
				echo "Could not change homephone";
			}
		}
		else{
			$this->load->view('admin_update_information');
		}
	}
	
	public function change_workphone_admin(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('workphone','Work Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->workphone_change()){
				$this->load->view('admin_update_information');
			}
			else{
				echo "Could not change homephone";
			}
		}
		else{
			$this->load->view('admin_update_information');
		}
	}
	
	public function update_doctor_info(){
		$this->load->view('doctor_update_information');
	}
	
	public function change_experience_doctor(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('experience','Experience','required|trim');
		
		//change message shown when username is already taken
		$this->form_validation->set_message('is_unique','That username is already in use.');
		if ($this->form_validation->run())
		{
			if($this->update_info->experience_change()){
				$this->load->view('doctor_update_information');
			}
			else{
				echo "Could not change expereience";
			}
		}
		else{
			$this->load->view('doctor_update_information');
		}
	}
	
	public function change_username_doctor(){
	
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[userinfo.username]');
	
		//change message shown when username is already taken
		$this->form_validation->set_message('is_unique','That username is already in use.');
		if ($this->form_validation->run())
		{
			if($this->update_info->username_change()){
				$newuser = $this->input->post('username');
				$this->session->set_userdata('username', $newuser);
				$this->load->view('doctor_update_information');
			}
			else{
				echo "Could not change username";
			}
		}
		else{
			$this->load->view('doctor_update_information');
		}
	}
	
	public function change_email_doctor(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->email_change()){
				$this->load->view('doctor_update_information');
			}
			else{
				echo "Could not change email";
			}
		}
		else{
			$this->load->view('doctor_update_information');
		}
	}
	
	
	public function change_homephone_doctor(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('homephone','Home Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->homephone_change()){
				$this->load->view('doctor_update_information');
			}
			else{
				echo "Could not change homephone";
			}
		}
		else{
			$this->load->view('doctor_update_information');
		}
	}
	
	public function change_workphone_doctor(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('workphone','Work Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->workphone_change()){
				$this->load->view('doctor_update_information');
			}
			else{
				echo "Could not change homephone";
			}
		}
		else{
			$this->load->view('doctor_update_information');
		}
	}
	
	public function update_nurse_info(){
		$this->load->view('nurse_update_information');
	}
	
	public function change_username_nurse(){
	
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[userinfo.username]');
	
		//change message shown when username is already taken
		$this->form_validation->set_message('is_unique','That username is already in use.');
		if ($this->form_validation->run())
		{
			if($this->update_info->username_change()){
				$newuser = $this->input->post('username');
				$this->session->set_userdata('username', $newuser);
				$this->load->view('nurse_update_information');
			}
			else{
				echo "Could not change username";
			}
		}
		else{
			$this->load->view('nurse_update_information');
		}
	}
	
	public function change_email_nurse(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->email_change()){
				$this->load->view('nurse_update_information');
			}
			else{
				echo "Could not change email";
			}
		}
		else{
			$this->load->view('nurse_update_information');
		}
	}
	
	
	public function change_homephone_nurse(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('homephone','Home Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->homephone_change()){
				$this->load->view('nurse_update_information');
			}
			else{
				echo "Could not change homephone";
			}
		}
		else{
			$this->load->view('nurse_update_information');
		}
	}
	
	public function change_workphone_nurse(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('workphone','Work Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->workphone_change()){
				$this->load->view('nurse_update_information');
			}
			else{
				echo "Could not change homephone";
			}
		}
		else{
			$this->load->view('nurse_update_information');
		}
	}
	
	public function update_patient_info(){
		$this->load->view('patient_update_information');
	}
	
	public function change_username(){
		
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[userinfo.username]');

		//change message shown when username is already taken
		$this->form_validation->set_message('is_unique','That username is already in use.');
		if ($this->form_validation->run())
		{
			if($this->update_info->username_change()){
				$newuser = $this->input->post('username');
				$this->session->set_userdata('username', $newuser);
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change username";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_email(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		
		if ($this->form_validation->run())
		{
			if($this->update_info->email_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change email";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}

	
	public function change_homephone(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('homephone','Home Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->homephone_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change homephone";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_workphone(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('workphone','Work Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->workphone_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change homephone";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_gender(){
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('gender','Gender','required|trim');
		
		if ($this->form_validation->run())
		{
			if($this->update_info->gender_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change gender";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_marriage()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('maritalstatus','Marital Status','required|trim');
		
		
		if ($this->form_validation->run())
		{
			if($this->update_info->marriage_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change marital status";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_al1()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('addressline1','Address Line 1','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->al1_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change address line 1";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_al2()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('addressline2','Address Line 2','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->al2_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change address line 2";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_city()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('city','City','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->city_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change city";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_zip()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('zipcode','Zipcode','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->zip_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change zipcode";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_ecname()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('ecname','Emergency Contact Name','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->ecname_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change emergency contact name";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_ecphone()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('ecphone','Emergency Contact Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->ecphone_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change emergency contact phone";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_insurancestart()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('insurancestart','Insurance Start','required|trim|regex_match[/^[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
		
		if ($this->form_validation->run())
		{
			if($this->update_info->insurancestart_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change insurance start date";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_insuranceend()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		//check email field
		$this->form_validation->set_rules('insuranceend','Insurance End','required|trim|regex_match[/^[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->insuranceend_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change insurance end date";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_insurancepolicy()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('insuranceprovider','Insurance Provider','required|trim');
	
		if ($this->form_validation->run())
		{
			if($this->update_info->insurancepolicy_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change insurance policy";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
	
	public function change_allergies()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('allergies','Allergies','required|trim');
		
	
		if ($this->form_validation->run())
		{
			if($this->update_info->allergies_change()){
				$this->load->view('patient_update_information');
			}
			else{
				echo "Could not change allergies";
			}
		}
		else{
			$this->load->view('patient_update_information');
		}
	}
}