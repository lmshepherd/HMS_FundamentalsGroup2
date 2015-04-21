<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	
		//$this->load->helper('form');
		$this->load->model('search');
	}
	
	public function bill_patients(){
		$appt_id = $this->input->post('id');
		$temp = array('admin_process'=> 1);
		$this->db->where('appt_id',$appt_id);
		$query = $this->db->update('appts',$temp);
		$chosenPatientID = $this->session->userdata('patient');
		$this->load->model('admin_search');
		$this->admin_search->get_appts($chosenPatientID);
		if($query){
			echo "Patient has been billed";
		}
		else{
			echo "Failure to bill";
		}
	}
	
	
	public function doctor_bill_flag()
	{
				//remove appt from database
		$appt_id = $this->input->post('apptID');
		//$this->db->from('appts');
		$this->db->where('appt_id',$appt_id);
		$temp = array('doctor_finish' => 1
		);
		$query = $this->db->update('appts',$temp);
		$chosenPatientID = $this->session->userdata('patient');
		$this->load->model('search');
    	$this->search->get_doctor_appts($chosenPatientID);
		//send notification emails
		//$this->load->view('bill_view');
		//$this->load->library('../controllers/appointment');
		//$this->appointment->select_patient();
	}
	
	public function view_bill()
	{
		$this->load->view('bill_view');
	}
	
	public function pay_bill()
	{
		
	}
}