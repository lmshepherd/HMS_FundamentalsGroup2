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
    
    public function doctor_availability()
    {
    	//$this->load->library('calendar');
    	
    	//echo 'test';
    	$id = $this->input->post('id');
    	$this->db->from('userinfo');
    	$this->db->where('id',$id);
    	$query = $this->db->get();
    	$row = $query->row();
    	//echo '<p>Availability for '.$row->firstname.' '.$row->lastname.':</p>';
    	echo "Appointment Date:"; 
    	//echo '<input type="text" name="appointment" id="datepicker"><br>';
    	//echo $this->calendar->generate();
    }
	
}