<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	
	public function doctor_schedules()
	{
		$this->load->model('admin_search');
		$this->load->view('admin_view_doctors');
		
	}
	
	public function nurse_schedules(){
		$this->load->model('admin_search');
		$this->load->view('admin_view_nurses');
	}

	public function view_patients(){
		$this->load->model('admin_search');
		$this->load->view('admin_view_patients');
	}
}

