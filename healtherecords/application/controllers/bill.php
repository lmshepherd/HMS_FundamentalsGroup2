<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
	
		//$this->load->helper('form');
		$this->load->model('search');
	}
	
	public function view_bill()
	{
		$this->load->view('bill_view');
	}
	
	public function pay_bill()
	{
		
	}
}