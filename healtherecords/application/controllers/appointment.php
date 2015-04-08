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
    /*
    public function select_date()
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
    }*/
    
    
    public function doctor_availability()
    {	
    	$this->load->helper('date');
    	
    	$year = $this->input->post('year')-100;
    	$month = $this->input->post('month')+1;
    	$day = $this->input->post('day');
    	$date = $year.'-'.$month.'-'.$day;
    	echo $date.' ';
    	
    	$dayOfWeek = $this->input->post('dayOfWeek');
    	echo $dayOfWeek;
    	
    	
    	//echo 'test';
    	$id = $this->session->userdata('selected_doctor');
    	$this->db->from('schedule');
    	$this->db->where('id',$id);
    	$query = $this->db->get();
    	$row = $query->row();
    	echo '<p>Availability for start sunday: </p>';
    	
    	$options = array();
    	
    	//HARDCODED RIGHT NOW. EVENTUALLY GET THIS NUMBER FROM DATEPICKER USER INPUT
    	$day=4;
    	
    	if($day==0){
    		$start=$row->sunstart;
    		$end=$row->sunend;
    	}
    	else if($day==1){
    		$start=$row->monstart;
    		$end=$row->monend;
    	}
    	else if($day==2){
    		$start=$row->tuestart;
    		$end=$row->tueend;
    	}
    	else if($day==3){
    		$start=$row->wedstart;
    		$end=$row->wedend;
    	}
    	else if($day==4){
    		$start=$row->thustart;
    		$end=$row->thuend;
    	}
    	else if($day==5){
    		$start=$row->fristart;
    		$end=$row->friend;
    	}
    	else if($day==6){
    		$start=$row->satstart;
    		$end=$row->satend;
    	}
    	
    	for($hours=$start; $hours<$end; $hours++) // the interval for hours is '1'
    		array_push($options,str_pad($hours,2,'0',STR_PAD_LEFT).':00');
    	
    	echo form_dropdown('hours', $options);
    	//echo "Appointment Date:<br>";
    	
    	//echo '<input type="text" name="appointment" id="datepicker"><br>';
    	//echo $this->calendar->generate();
    }
	
}