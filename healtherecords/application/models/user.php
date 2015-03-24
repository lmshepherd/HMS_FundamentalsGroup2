<?php

class User extends CI_Model
{
	public function login()
	{
		//find matching user in dabase and check password
		$this->db->where('Username',$this->input->post('username'));
		$this->db->where('Password',md5($this->input->post('password')));
		
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
	
	
	//store sign up data temporarily
	public function add_temp($link)
	{
		//store form data as an array to pass to db
		$temp = array('username' => $this->input->post('username'),
				//use md5 hash to store password
				'password' => md5($this->input->post('password')),
				'email' => $this->input->post('email'),
				'link' => $link,
				'role' => $this->input->post('role'));
		//insert data into db
		$query = $this->db->insert('temp_users',$temp);
		//check if a problem was encountered trying to insert temp user data
		if ($query)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	
	//check link sent to new user's email
	public function valid_link($link)
	{
		//access temp_users table and look for link value
		$this->db->where('link',$link);
		$query = $this->db->get('temp_users');
		
		//check if a match was found
		if ($query->num_rows()==1)
		{
			return true;
		}
		else return false;
	}
	
	
	//make a temp user a permanent user
	public function new_user($link)
	{
		//find link value in temp_users table
		$this->db->where('link',$link);
		$temp = $this->db->get('temp_users');
		
		if ($temp)
		{
			//store row corresponding to link value
			$row = $temp->row();
			//store row values in array
			$userinfo = array(
					'username' => $row->username,
					'password' => $row->password,
					'email' => $row->email,
					'role' => $row->role);
			//insert user from temp_users table into userinfo table
			$user_added = $this->db->insert('userinfo',$userinfo);
			
			//save session data in an array
			$sessiondata = array('username' => $row->username, 'role' => $row->role, 'is_logged_in' => 1);
			//create session with session data
			$this->session->set_userdata($sessiondata);
		}
		
		//check if successfully added
		if ($user_added)
		{
			//delete corresponding entry from temp_users table
			/*$this->db->where('link',$link);
			$this->db->delete('temp_users');*/
			return true;
		}
		else return false;
	}
	
	
}