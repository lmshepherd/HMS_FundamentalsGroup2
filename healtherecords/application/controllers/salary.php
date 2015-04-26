<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('update_info');
	}
	
	public function update_patient_info(){
		$this->load->view('patient_update_information');
	}
	
	public function viewSalary(){

	}
}