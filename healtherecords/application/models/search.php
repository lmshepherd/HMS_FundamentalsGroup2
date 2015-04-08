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
}