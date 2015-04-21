<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
	
		//$this->load->helper('form');
		$this->load->model('admin_search');
	
	}
	
	public function select_patient()
	{
		//get specialization from post
		$chosenPatientID = $this->input->post('patient');
		$this->session->set_userdata('patient', $chosenPatientID);
		$this->load->model('admin_search');
		$this->admin_search->get_appts($chosenPatientID);
	
	}
	
	public function view_processed_payments(){
		$this->load->view('admin_view_payments');
	}
	
	public function doctor_schedules()
	{
		$this->load->model('admin_search');
		$this->load->view('admin_view_doctors');
		
	}
	
	public function nurse_schedules(){
		$this->load->model('admin_search');
		$this->load->view('admin_view_nurses');
	}

	public function view_patients(){
		$this->load->model('admin_search');
		$this->load->view('admin_view_patients');
	}
	
	public function view_appointments(){
		$this->load->model('admin_search');
		$this->load->view('admin_view_appts');
	}
}

