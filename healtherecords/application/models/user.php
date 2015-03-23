<?php

class User extends CI_Model
{
	function login()
	{
		//find matching user in dabase and check password
		$this->db->where('Username',$this->input->post('username'));
		$this->db->where('Password',$this->input->post('password'));
		
		//store result of database query
		$query = $this->db->get('userinfo');
		
		//if a match was found
		if($query->num_rows()==1)
		{
			//return that there is a matching user
			return $query->result();
		}
		//no match found in database
		else 
		{
			return false;
		}
	}
}