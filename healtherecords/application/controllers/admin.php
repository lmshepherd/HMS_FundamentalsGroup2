<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	
	public function doctor_schedules()
	{
		$this->load->model('admin_search');
		$this->admin_search->get_doctors();
		
	}
	
	public function nurse_schedules(){
		$this->load->model('admin_search');
		$this->admin_search->get_nurses();
	}
}
