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
		$query = $this->db->get('temp_users');
		
		if ($query)
		{
			//store row corresponding to link value
			$row = $query->row();
			//store row values in array
			/*$userinfo = array(
					'username' => $row->username,
					'password' => $row->password,
					'email' => $row->email,
					'role' => $row->role);
			//insert user from temp_users table into userinfo table
			$user_added = $this->db->insert('userinfo',$userinfo);*/
			
			//save session data in an array
			$sessiondata = array('username' => $row->username, 'role' => $row->role, 'link' => $link, 'is_logged_in' => 1);
			//create session with session data
			$this->session->set_userdata($sessiondata);
			return true;
		}
		else return false;	
	}
	
	
	//user clicks complete registration button on registration page
	public function complete_new_user()
	{
		$this->db->where('link',$this->session->userdata('link'));
		$query = $this->db->get('temp_users');
		
		if ($query)
		{
			//store row corresponding to link value
			$row = $query->row();
			//store row values in array
			$userinfo = array(
			'username' => $row->username,
					'password' => $row->password,
					'email' => $row->email,
					'role' => $row->role);
			//insert user from temp_users table into userinfo table
			$user_added = $this->db->insert('userinfo',$userinfo);
		}
		
		$username = $this->session->userdata("username");
		$role = $this->session->userdata('role');
		
		//store common form data as an array to pass to userinfo table
		$temp = array('firstname' => $this->input->post('firstname'),
				'lastname' => $this->input->post('lastname'),
				'dob' => $this->input->post('dob'),
				'homephone' => $this->input->post('homephone'),
				'workphone' => $this->input->post('workphone'));
		//insert data into db
		$this->db->where('username',$username);
		$query = $this->db->update('userinfo',$temp);
		
		//get corresponding user id number
		$this->db->select('id');
		$this->db->where('username',$username);
		$query = $this->db->get('userinfo');
		$row = $query->row();
		$id = $row->id;
		
		//test if patient and load patient data
		if($role=='patient')
		{
			$temp = array(
					'id' => $id,
					'gender' => $this->input->post('gender'),
					'maritalstatus' => $this->input->post('maritalstatus'),
					'addressline1' => $this->input->post('addressline1'),
					'addressline2' => $this->input->post('addressline2'),
					'city' => $this->input->post('city'),
					'zipcode' => $this->input->post('zipcode'),
					'ecname' => $this->input->post('ecname'),
					'ecphone' => $this->input->post('ecphone'),
					'insurancestart' => $this->input->post('insurancestart'),
					'insuranceend' => $this->input->post('insuranceend'),
					'insuranceprovider' => $this->input->post('insuranceprovider'),
					'record' => $this->input->post('record'),
					'treatments' => $this->input->post('treatments'),
					'allergies' => $this->input->post('allergies'));
			//insert info into patients database
			$query = $this->db->insert('patients',$temp);
		}
		else if($role=='nurse')
		{
			$temp = array(
					'id' => $id,
					'specialization' => $this->input->post('specialization'),
					'availability' => $this->input->post('availability'),
					'department' => $this->input->post('department'));
			//insert info into patients database
			$query = $this->db->insert('nurses',$temp);
		}
		else if($role=='doctor')
		{
			$temp = array(
					'id' => $id,
					'specialization' => $this->input->post('specialization'),
					'availability' => $this->input->post('availability'),
					'experience' => $this->input->post('experience'));
			//insert info into patients database
			$query = $this->db->insert('doctors',$temp);
		}
		
		if($query){
			return true;	
		}
		else return false;
		
	}
	
	public function reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('firstname','First Name','required|trim');
		$this->form_validation->set_rules('lastname','Last Name','required|trim');
		$this->form_validation->set_rules('dob','Date of Birth','required|trim|regex_match[/^[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
		$this->form_validation->set_rules('homephone','Home Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
		$this->form_validation->set_rules('workphone','Work Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
	
		if($this->form_validation->run())
			return true;
		else return false;
	
	}
	
	public function patient_reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('gender','Gender','required|trim');
		$this->form_validation->set_rules('maritalstatus','Marital Status','required|trim');
		$this->form_validation->set_rules('addressline1','Address Line 1','required|trim');
		$this->form_validation->set_rules('addressline2','Address Line 2','required|trim');
		$this->form_validation->set_rules('city','City','required|trim');
		$this->form_validation->set_rules('zipcode','Zipcode','required|trim');
		$this->form_validation->set_rules('ecname','Emergency Contact Name','required|trim');
		$this->form_validation->set_rules('ecphone','Emergency Contact Phone','required|trim|regex_match[/^[0-9]{3}-[0-9]{3}-[0-9]{4}/]');
		$this->form_validation->set_rules('insurancestart','Insurance Start','required|trim|regex_match[/^[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
		$this->form_validation->set_rules('insuranceend','Insurance End','required|trim|regex_match[/^[0-9]{4}-[0-9]{2}-[0-9]{2}/]');
		$this->form_validation->set_rules('insuranceprovider','Insurance Provider','required|trim');
		$this->form_validation->set_rules('record','Medical Record','required|trim');
		$this->form_validation->set_rules('treatments','Treatments','required|trim');
		$this->form_validation->set_rules('allergies','Allergies','required|trim');
	
		if($this->form_validation->run())
			return true;
		else return false;
	}
	
	public function doctor_reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('specialization','Specialization','required|trim');
		$this->form_validation->set_rules('experience','Experience','required|trim');
		$this->form_validation->set_rules('availability','Availability','required|trim');
	
		if($this->form_validation->run())
			return true;
		else return false;
	}
	
	public function nurse_reg_validation()
	{
		//load form validation functions
		$this->load->library('form_validation');
		$this->form_validation->set_rules('specialization','Specialization','required|trim');
		$this->form_validation->set_rules('department','Department','required|trim');
		$this->form_validation->set_rules('availability','Availability','required|trim');
	
		if($this->form_validation->run())
			return true;
		else return false;
	}
	/*
	public function check_if_phone($number)
	{
		if(preg_match('/^[0-9]{3}-[0-9]{3}-[0-9]{4}/',$number))
		{
			return true;
		}
		else return false;
	}*/
}