<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	
	public function bill_patients(){
		$appt_id = $this->input->post('id');
		$temp = array('admin_process'=> 1);
		$this->db->where('appt_id',$appt_id);
		$query = $this->db->update('appts',$temp);
		if($query){
			echo "Patient has been billed";
		}
		else{
			echo "failure";
		}
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

