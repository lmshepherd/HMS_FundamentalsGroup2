<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        
        //$this->load->helper('form');
        $this->load->model('search');
    
    }
    
    public function view_patient_appointments()
    {
    	$this->session->set_userdata('make_or_change_appt','change');
    	$this->load->view('see_patient_appts_view');
    }
    
    public function view_appointments()
    {
    	$this->session->set_userdata('make_or_change_appt','change');
    	$this->load->view('see_appts_view');
    
    }
    
    public function nurse_view_patients(){
    	$this->load->view('see_nurseAppts_view');
    }
    
    public function make_appointment()
    {
    	$this->session->set_userdata('make_or_change_appt','make');
    	$this->load->view('appointment_view');
    }
    
    public function select_specialization()
    {
    	//get specialization from post
    	$specialization = $this->input->post('specialization');
    	//pass specializtion to database query in search model
    	$query = $this->search->doctors_by_specialization($specialization);
		
    	//check if a specialization is selected in the box
    	if ($specialization!='')
    	{
    		//check that there is at least one result
    		if ($query->num_rows()>0)
    		{
    			//create table heading
    			$this->table->set_heading('Name ','Gender ','Experience ', 'Age ', 'Availability ');
    			//gender placeholder in case missing from database
    			$gender='';
    			
    			//cycle through doctors of matching specialty
		    	foreach ($query->result() as $row)
		    	{
		    		//get name from userinfo db
		    		$this->db->from('userinfo');
		    		$this->db->where('id',$row->id);
		    		$query2 = $this->db->get();
		    		$row2 = $query2->row();
		    		
		    		if ($row->gender=='m')
		    			$gender='Male';
		    		else if($row->gender=='f')
		    			$gender='Female';
    		
		    		$birthday=$row2->dob;
		    		$birthYear=substr($birthday,0,4);
		    		$dayAndMonth=substr($birthday,5);
		    		$birthMonth=substr($dayAndMonth,0,2);
		    		$birthDay=substr($dayAndMonth,3);
		    		
		    		$dob=date_create($birthday);
		    		$today=new DateTime('today');
		    		$now=$today->format('Y-m-d H:i:s');
		    		
		    		$nowYear=substr($now,0,4);
		    		$nowDayAndMonth=substr($now,5);
		    		$nowMonth=substr($nowDayAndMonth,0,2);
		    		$nowDay=substr($nowDayAndMonth,3);
		    		
		    		if($nowMonth>$birthMonth){
		    			$age=$nowYear-$birthYear;
		    		}
		    		else if($nowMonth==$birthMonth){
		    			if($birthDay<$nowDay){
		    				$age=$nowYear-$birthYear-1;
		    			}
		    			else{
		    				$age=$nowYear-$birthYear;
		    			}
		    		}
		    		else{
		    			$age=$nowYear-$birthYear-1;
		    		}
		    		
		    		//get schedule from schedule db
		    		$this->db->from('schedule');
		    		$this->db->where('id',$row->id);
		    		$query3 = $this->db->get();
		    		$row3 = $query3->row();
		    		
		    		$days=[];
		    		if($row3->sunstart!=-1){
		    			array_push($days, "Su");
		    		}
		    		if($row3->monstart!=-1){
		    			array_push($days, "M");
		    		}
		    		if($row3->tuestart!=-1){
		    			array_push($days, "Tu");
		    		}
		    		if($row3->thustart!=-1){
		    			array_push($days, "W");
		    		}
		    		if($row3->fristart!=-1){
		    			array_push($days, "Th");
		    		}
		    		if($row3->satstart!=-1){
		    			array_push($days, "S");
		    		}
		    		
		    		//add doctor to table
		    		$this->table->add_row($row2->firstname . ' ' . $row2->lastname,
		    				$gender,
		    				$row->experience.' years', $age, implode($days),
							//add a button to select doctor
		    				'<input id="'.$row->id.'" type="button" value="Select" onclick="select_doctor(this)" />');
		    	}
	    		//generate the table
	    		echo $this->table->generate();
    		}
    		else echo '<p>No doctors with that specialty available.</p>';
    	}
    }
    
    public function select_doctor()
    {
    	//get doctor id from post
    	$id = $this->input->post('id');
    	//store id of selected doctor in session data
    	$this->session->set_userdata('selected_doctor', $id);
    	//$this->session->set_userdata('make_or_change_appt', 'make');
    }
    
    public function doctor_availability()
    {	
    	//$this->load->helper('date');
    	
    	$year = $this->input->post('year')-100;
    	$month = $this->input->post('month')+1;
    	$day = $this->input->post('day');
    	$date = $year.'-'.$month.'-'.$day;
    	
    	$this->session->set_userdata('aptdate', $date);
    	
    	$dayOfWeek = $this->input->post('dayOfWeek');
    	
    	$id = $this->session->userdata('selected_doctor');
    	$this->db->from('schedule');
    	$this->db->where('id',$id);
    	$query = $this->db->get();
    	$row = $query->row();
    	
    	$options = array();
    		
    	if($dayOfWeek==0){
    		echo '<p>Availability for Sunday: </p>';
    		$start=$row->sunstart;
    		$end=$row->sunend;
    	}
    	else if($dayOfWeek==1){
    		echo '<p>Availability for Monday: </p>';
    		$start=$row->monstart;
    		$end=$row->monend;
    	}
    	else if($dayOfWeek==2){
    		echo '<p>Availability for Tuesday: </p>';
    		$start=$row->tuestart;
    		$end=$row->tueend;
    	}
    	else if($dayOfWeek==3){
    		echo '<p>Availability for Wednesday: </p>';
    		$start=$row->wedstart;
    		$end=$row->wedend;
    	}
    	else if($dayOfWeek==4){
    		echo '<p>Availability for Thursday: </p>';
    		$start=$row->thustart;
    		$end=$row->thuend;
    	}
    	else if($dayOfWeek==5){
    		echo '<p>Availability for Friday: </p>';
    		$start=$row->fristart;
    		$end=$row->friend;
    	}
    	else if($dayOfWeek==6){
    		echo '<p>Availability for Saturday: </p>';
    		$start=$row->satstart;
    		$end=$row->satend;
    	}
    	
    	//check if day off
    	if($start!=-1)
    	{
	    	$this->load->model('search');
	    	for($hours=$start; $hours<$end; $hours++) // the interval for hours is '1'
	    	{
	    		if ($hours>11)
	    		{
	    			$hours12 = $hours%12;
					$ampm = 'pm';
	    		}
	    		else 
	    		{
	    			$hours12 = $hours;
	    			$ampm = 'am';
	    		}
	    		if ($hours12==0)
	    			$hours12 = $hours12 + 12;
	    		
	    		if($this->search->check_time($hours))
	    			$options[$hours] = str_pad($hours12,2,'0',STR_PAD_LEFT).':00 '.$ampm;
	    		//array_push($options,$hours => str_pad($hours,2,'0',STR_PAD_LEFT).':00');
	    	}
    	}
    	
    	if(!empty($options))
    	{
    		if ($this->session->userdata('make_or_change_appt')=='make')
	    		echo form_open('appointment/appointment_submit');
    		else if ($this->session->userdata('make_or_change_appt')=='change')
    			echo form_open('appointment/change_appt_submit');
	    	echo "<p>";
	    	echo form_dropdown('hours', $options);
	    	echo "</p>";
	    	echo "<p>";
	    	echo form_submit('appointment_submit', 'Complete Appointment!');
	    	echo "</p>";
	    	echo "<p>";
	    	echo form_close();
	    	echo "</p>";
    	}
    	else echo 'No appointment times available for this date.';
    	
    	
    	
    	//echo "Appointment Date:<br>";
    	
    	//echo '<input type="text" name="appointment" id="datepicker"><br>';
    	//echo $this->calendar->generate();
    }
	
    public function appointment_submit()
    {
   		$this->load->model('user');
    	if($this->user->apt_toDatabase()){
    		$this->load->view('appointment_submitted');
    	}
    	else{
    		echo 'Appointment could not be submitted!';
    	}
    	
    	//clear date and doctor id from session data
    	$this->session->set_userdata('aptdate','');
    	$this->session->set_userdata('selected_doctor','');
    }
    
    public function doctor_viewPatientRecord(){
    	$this->load->view('doctor_patientRecordView');
    }
    
    
    public function nurse_viewPatientRecord(){
    	$this->load->view('nurse_patientRecordView');
    }
    
    public function change_appt_time()
    {
    	//get doctor id from post
    	$appt_id = $this->input->post('id');
    	$this->db->where('appt_id',$appt_id);
    	$query = $this->db->get('appts');
    	$row = $query->row();
    	$docid = $row->doctor_id;
    	//store id of selected doctor in session data
    	$this->session->set_userdata('selected_doctor', $docid);
    	$this->session->set_userdata('appt_id', $appt_id);
    	//$this->session->set_userdata('make_or_change_appt', 'change');
    }
    
    /*public function set_doctor_finish()
    {
    	//get doctor id from post
    	$appt_id = $this->input->post('id');
    	$this->db->where('appt_id',$appt_id);
    	$query = $this->db->get('appts');
    	$row = $query->row();
    	$docid = $row->doctor_id;
    	//store id of selected doctor in session data
    	$this->session->set_userdata('selected_doctor', $docid);
    	$this->session->set_userdata('appt_id', $appt_id);
    	//$this->session->set_userdata('make_or_change_appt', 'change');
    }*/
    
    public function change_appt_submit()
    {
    	$appt = $this->session->userdata('appt_id');
    	//$date = $this->session->userdata('aptdate');
    	
    	$this->db->from('appts');
    	$this->db->where('appt_id',$appt);
    	$appt_query = $this->db->get();
    	$appt_row = $appt_query->row();
    	
    	$this->db->from('nurses');
    	$this->db->where('id',$appt_row->nurse_id);
    	$nurse_query = $this->db->get();
    	$nurse_row = $nurse_query->row();
    	$department = $nurse_row->department;
    	
    	$this->load->model('user');
    	$temp = array('date' => $this->session->userdata('aptdate'),
    			'hour' => $this->input->post('hours'),
    			'nurse_id' => $this->user->assign_nurse($department,$this->session->userdata('aptdate'),$this->input->post('hours')));
    	
    	$this->db->where('appt_id',$appt);	
    	$this->db->update('appts', $temp);
    	
    	//send notification emails
    	$this->load->model('notify');
    	$this->notify->appt_change_notification($appt);
    	
    	$this->load->view('appointment_submitted');
    	
    	//clear date and doctor id from session data
    	$this->session->unset_userdata('aptdate');
    	$this->session->unset_userdata('selected_doctor');
    	$this->session->unset_userdata('appt_id');
    }
    
    
    public function cancel_appt()
    {
    	//remove appt from database
    	$appt_id = $this->input->post('id');
    	$this->db->where('appt_id',$appt_id);
    	$this->db->delete('appts');
    	//send notification emails
    	$this->load->model('notify');
    	$this->notify->appt_cancelled_notification($appt_id);
    }   
    
    public function select_patient()
    {
    	//get specialization from post
    	$chosenPatientID = $this->input->post('patient');
    	$this->session->set_userdata('patient', $chosenPatientID);
    	$this->load->model('search');
    	$this->search->get_doctor_appts($chosenPatientID);
    	 
    }
    
    public function load_treatments(){
    	//Test to see if button works
    	//$appt_id = $this->input->post('id');
    	//$temp=array('treatment'=>'lalala');
    	//$this->db->where('appt_id',$appt_id);
    	//$query = $this->db->update('appts',$temp);
    	$this->session->set_userdata('appt_id', $this->input->post('id'));
    	$this->load->view('doctor_view_treatments');
    }
    
    public function update_treatments(){
    	$treatment =$this->input->post('treatment');
    	$appt_id = $this->input->post('id');
    	
    	$this->db->where('appt_id', $appt_id);
    	$temp=array('treatment'=>$treatment);
    	$query=$this->db->update('appts',$temp);
    	$this->load->view('doctor_view_treatments');
    }
    
    public function load_prescriptions()
    {
    	$this->session->set_userdata('appt_id', $this->input->post('id'));
    	$this->load->view('doctor_view_prescriptions');
    }
    
    public function update_prescriptions(){
    	$prescription =$this->input->post('prescription');
    	$appt_id = $this->input->post('id');
    	 
    	$this->db->where('appt_id', $appt_id);
    	$temp=array('prescription'=>$prescription);
    	$query=$this->db->update('appts',$temp);
    	$this->load->view('doctor_view_prescriptions');
    }
}
