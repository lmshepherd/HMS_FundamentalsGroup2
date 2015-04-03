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
	
}