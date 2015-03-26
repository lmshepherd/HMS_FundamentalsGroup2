<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation extends CI_Controller 
{
	public function reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('firstname','First Name','required|trim');
		$this->form_validation->set_rules('lastname','Last Name','required|trim');
		$this->form_validation->set_rules('dob','Date of Birth','required|trim');
		$this->form_validation->set_rules('homephone','Home Phone','required|trim');
		$this->form_validation->set_rules('workphone','Work Phone','required|trim');
		
		if($this->form_validation->run())
			return true;
		else return false;
		
	}
	
	public function patient_reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('gender','Gender','required|trim');
		$this->form_validation->set_rules('maritalstatus','Marital Status','required|trim');
		$this->form_validation->set_rules('addressline1','Address Line 1','required|trim');
		$this->form_validation->set_rules('addressline2','Address Line 2','required|trim');
		$this->form_validation->set_rules('city','City','required|trim');
		$this->form_validation->set_rules('zipcode','Zipcode','required|trim');
		$this->form_validation->set_rules('ecname','Emergency Contact Name','required|trim');
		$this->form_validation->set_rules('ecphone','Emergency Contact Phone','required|trim');
		$this->form_validation->set_rules('insurancestart','Insurance Start','required|trim');
		$this->form_validation->set_rules('insuranceend','Insurance End','required|trim');
		$this->form_validation->set_rules('insuranceprovider','Insurance Provider','required|trim');
		$this->form_validation->set_rules('record','Medical Record','required|trim');
		$this->form_validation->set_rules('treatments','Treatments','required|trim');
		$this->form_validation->set_rules('allergies','Allergies','required|trim');
	
		if($this->form_validation->run())
			return true;
		else return false;
	
	}
	
	public function doctor_reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('specialization','Specialization','required|trim');
		$this->form_validation->set_rules('experience','Experience','required|trim');
		$this->form_validation->set_rules('availability','Availability','required|trim');
		
		if($this->form_validation->run())
			return true;
		else return false;
	
	}
	
	public function nurse_reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('specialization','Specialization','required|trim');
		$this->form_validation->set_rules('department','Department','required|trim');
		$this->form_validation->set_rules('availability','Availability','required|trim');
		
		if($this->form_validation->run())
			return true;
		else return false;
	
	}
	
}