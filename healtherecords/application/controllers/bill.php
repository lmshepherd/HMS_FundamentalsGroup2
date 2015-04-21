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
		$username = $this->session->userdata('username');
		
		$this->db->where('username', $username);
		$query2= $this->db->get('userinfo');
		$row2 = $query2->row();
		
		$patient_id = $row2->id;
		
		$this->db->where('patient_id', $patient_id);
		$query = $this->db->get('appts');
		
		foreach($query->result() as $row){
			$doc = $row->doctor_finish;
			$admin = $row->admin_process;
			$paid = $row->paid;
			if( ($doc==1) &&($admin==1) && ($paid == 0)){
				$this->db->where('appt_id',$row->appt_id);
				$temp=array('paid' => 1);
				$this->db->update('appts', $temp);
			}
		}
		
		echo "Bill payed!";
		
	}
}