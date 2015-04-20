<?php

class Search extends CI_Model
{
	
	public function doctors_by_specialization($specialization)
	{
		//search doctors table for all matches to specialty
		$this->db->from('doctors');
		$this->db->where('specialization',$specialization);
		$query = $this->db->get();	 
		return $query;
	}
	
	public function check_time($hour)
	{
		//get session data for doctor and date
		$aptdate = $this->session->userdata('aptdate');
		//$docid = $this->session->userdata('selected_doctor');
		//setup table name to search
		//$table_name = $docid.'_appts';
		
		//get all appts for that doctor on that date
		$this->db->from('appts');
		$this->db->where('date',$aptdate);
		$query = $this->db->get();
		
		//cycle through appts to see if time is already taken
		foreach ($query->result() as $row)
		{
			if($hour==$row->hour)
				return false;	
		}
		//no match found, time available
		return true;
	}
	
	public function get_appts()
	{
		$username = $this->session->userdata('username');
		//get user id
		$this->db->where('username',$username);
		$query = $this->db->get('userinfo');
		$row = $query->row();
		$id = $row->id;
		if ($row->role=='patient')
			$this->get_appts_patient($id);
		else if ($row->role=='doctor'){
			$this->get_appts_doctor($id);
		}
	}
	
	public function get_appts_patient($id)
	{	
		//check appts where this user is the patient
		$this->db->where('patient_id',$id);
		$query = $this->db->get('appts');
		$row = $query->row();
		
		//check that there is at least one result
		if ($query->num_rows()>0)
		{
			//create table heading
			$this->table->set_heading('Date','Time','Doctor');
			 
			//cycle through doctors of matching specialty
			foreach ($query->result() as $row)
			{
				//get name from userinfo db
				$this->db->from('userinfo');
				$this->db->where('id',$row->doctor_id);
				$query2 = $this->db->get();
				$row2 = $query2->row();
		
				$time = $row->hour;
				if ($time<12)
					$ampm = 'am';
				else $ampm = 'pm';
				$time = $time%12;
				if ($time==0)
					$time=12;
				
				//add doctor to table
				$this->table->add_row($row->date,
						$time.' '.$ampm,
						'Dr. '.$row2->firstname.' '.$row2->lastname,
						//add a button to select appt
						'<input id="'.$row->appt_id.'" type="button" value="Change Time" onclick="change_time(this)" />',
						'<input id="'.$row->appt_id.'" type="button" value="Cancel Appointment" onclick="cancel_appt(this)" />');
			}
			//generate the table
			echo $this->table->generate();
		}
		else echo '<p>No appointments currently scheduled.</p>';
	}
	
	public function get_appts_doctor($id)
	{
		/*
		$username = $this->session->userdata('username');
		//get user id
		$this->db->where('username',$username);
		$query = $this->db->get('userinfo');
		$row = $query->row();
		$id = $row->id;*/
	
		//check appts where this user is the doctor
		$this->db->where('doctor_id',$id);
		$query = $this->db->get('appts');
		$row = $query->row();
	
		//check that there is at least one result
		if ($query->num_rows()>0)
		{
			//create table heading
			$this->table->set_heading('Date','Time','Patient','','','','Appointment Complete');
			
			//cycle through doctors of matching specialty
			foreach ($query->result() as $row)
			{
				
				if($row->patient_id==$this->session->currPatient_id){
				
				//get name from userinfo db
				$this->db->from('userinfo');
				$this->db->where('id',$row->patient_id);
				$query2 = $this->db->get();
				$row2 = $query2->row();
	
				$time = $row->hour;
				if ($time<12)
					$ampm = 'am';
				else $ampm = 'pm';
				$time = $time%12;
				if ($time==0)
					$time=12;
				echo form_open('appointment/doctor_viewPatientRecord');
				//add doctor to table
				$this->table->add_row($row->date,
						$time.' '.$ampm,
						$row2->firstname.' '.$row2->lastname,
						'<p>'.form_open('appointment/doctor_viewPatientRecord').form_submit('view_patient_info', 'View Patient Information').form_close().'</p>',
						'<input id="'.$row->appt_id.'" type="button" value="Change Time" onclick="change_time(this)" />',
						'<input id="'.$row->appt_id.'" type="button" value="Cancel Appointment" onclick="cancel_appt(this)" />',
						'<input id="'.$row->appt_id.'" type="button" name="apointmentCompmlete" value="done" class="check" onclick="checkChecks(this)"/>'
						);
						//add a button to select doctor
						//'<input id="'.$row->appt_id.'" type="button" value="View Patient Information" onclick="" />');
				echo form_close();
				}
			}
				
			//generate the table
			echo $this->table->generate();
		}
		else echo '<p>No appointments currently scheduled.</p>';
	}
	
	//generate drop down for doctor's view_appointments to include only patients that he sees
	public function patients_by_doctor()
	{    	
    	$username=$this->session->userdata('username');
    	
    	//get id from userinfo db
    	$this->db->from('userinfo');
    	$this->db->where('username',$username);
    	$query = $this->db->get();
    	$row = $query->row();
    	$id=$row->id;
    	
    	//search doctors table for all matches to specialty
		$this->db->from('appts');
		$this->db->where('doctor_id',$id);
		$query2 = $this->db->get();
    	$patients=[];
    	array_push($patients, "Select a patient");
    	if($query2->num_rows()>0){
    		foreach($query2->result() as $row){
    				$patient=$row->patient_id;
    				$this->db->from('userinfo');
    				$this->db->where('id',$patient);
    				$query3 = $this->db->get();
    				$row3 = $query3->row();
    				//array_push($patients,$row->patient_id);
    				array_push($patients, $row3->firstname.' '.$row3->lastname);
    		}
    	}
    	return $patients;
	}
	
	public function patientid_by_name($specialization)
	{
		//search doctors table for all matches to specialty
		$this->db->from('doctors');
		$this->db->where('specialization',$specialization);
		$query = $this->db->get();
		return $query;
	}
}