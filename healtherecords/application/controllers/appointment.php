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
    
    public function make_appointment()
    {
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
    			$this->table->set_heading('Name','Gender','Experience', '');
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
		    		
		    		//add doctor to table
		    		$this->table->add_row($row2->firstname . ' ' . $row2->lastname,
		    				$gender,
		    				$row->experience.' years',
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
    	
    	for($hours=$start; $hours<$end; $hours++) // the interval for hours is '1'
    	{
    		$options[$hours] = str_pad($hours,2,'0',STR_PAD_LEFT).':00';
    		//array_push($options,$hours => str_pad($hours,2,'0',STR_PAD_LEFT).':00');
    	}
    	
    	
    	echo form_open('appointment/appointment_submit');
    	echo "<p>";
    	echo form_dropdown('hours', $options);
    	echo "</p>";
    	echo "<p>";
    	echo form_submit('appointment_submit', 'Complete Appointment!');
    	echo "</p>";
    	echo "<p>";
    	echo form_close();
    	echo "</p>";
    	
    	
    	
    	//echo "Appointment Date:<br>";
    	
    	//echo '<input type="text" name="appointment" id="datepicker"><br>';
    	//echo $this->calendar->generate();
    }
	
    public function appointment_submit(){
   		$this->load->model('user');
    	if($this->user->apt_toDatabase()){
    		$this->load->view('appointment_submitted');
    	}
    	else{
    		echo 'Appointment could not be submitted!';
    	}
    }
    
    
}