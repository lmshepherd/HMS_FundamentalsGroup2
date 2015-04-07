<?php
//require_once dirname(__FILE__).'/Model.php';

class Post// extends MY_CI_Model{
{	
	function _construct(){
		parent::_construct();
	}
	
	public function getAll(){
		$query = $this->db->get('posts');
		$posts = array();
		
		foreach ($query->result_array() as $row){
			$posts[] = $row;
		}
		
		return $posts;
	}
	/*
	//store sign up data temporarily
	public function addTemp($data)
	{
		//store form data as an array to pass to db
		$temp = array('username' => $data->get('username'),
				//use md5 hash to store password
				'password' => md5( $data->get('password')),
				'email' =>  $data->get('email'),
				'link' =>  $data->get('link'),
				'role' =>  $data->get('patient'));
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
	}*/
	
}
?>