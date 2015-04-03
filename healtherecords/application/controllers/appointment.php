<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Appointment extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('form');
        $this->load->model('search');
    
    }
    
    public function make_appointment()
    {
    	$this->load->view('appointment_view');
    }
    
    public function select_specialization()
    {
    	$specialization = $this->input->post('specialization');
    	$query = $this->search->doctors_by_specialization($specialization);

    	$this->table->set_heading('First Name','Last Name','Gender','Experience');
    	
    	foreach ($query->result() as $row)
    	{
    		$this->db->from('userinfo');
    		$this->db->where('id',$row->id);
    		$query2 = $this->db->get();
    		$row2 = $query2->row();
    		
    		$this->table->add_row($row2->firstname,$row2->lastname,$row->gender,$row->experience);
    	}
    	
    	echo $this->table->generate();
    }
	
}