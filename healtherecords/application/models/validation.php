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
		$this->form_validation->set_rules('gender','First Name','required|trim');
		$this->form_validation->set_rules('maritalstatus','Last Name','required|trim');
		$this->form_validation->set_rules('addressline1','Date of Birth','required|trim');
		$this->form_validation->set_rules('addressline2','Home Phone','required|trim');
		$this->form_validation->set_rules('city','Work Phone','required|trim');
		$this->form_validation->set_rules('zipcode','Last Name','required|trim');
		$this->form_validation->set_rules('ecname','Date of Birth','required|trim');
		$this->form_validation->set_rules('ecphone','Home Phone','required|trim');
		$this->form_validation->set_rules('insurancestart','Work Phone','required|trim');
		$this->form_validation->set_rules('insuranceend','Work Phone','required|trim');
		$this->form_validation->set_rules('insuranceprovider','Last Name','required|trim');
		$this->form_validation->set_rules('record','Date of Birth','required|trim');
		$this->form_validation->set_rules('treatments','Home Phone','required|trim');
		$this->form_validation->set_rules('allergies','Work Phone','required|trim');
	
		if($this->form_validation->run())
			return true;
		else return false;
	
	}
	
	public function doctor_reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('specialization','First Name','required|trim');
		$this->form_validation->set_rules('experience','Last Name','required|trim');
		$this->form_validation->set_rules('availability','Date of Birth','required|trim');
		
		if($this->form_validation->run())
			return true;
		else return false;
	
	}
	
	public function nurse_reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('specialization','First Name','required|trim');
		$this->form_validation->set_rules('department','Last Name','required|trim');
		$this->form_validation->set_rules('availability','Date of Birth','required|trim');
		
		if($this->form_validation->run())
			return true;
		else return false;
	
	}
	
}