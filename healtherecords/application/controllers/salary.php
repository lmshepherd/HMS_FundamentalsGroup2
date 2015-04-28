<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Salary extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('payroll');
	}
	
	
	public function view_payroll()
	{
		$this->payroll->view_payroll();
	}
	
	//function called when distribute paycheck button is clicked by admin
	public function send_paycheck()
	{
		$data = array('sent' => true);
		$this->db->where('paycheck_id',$this->input->post('paycheck_id'));
		$this->db->update('paychecks',$data);
		echo '<br><p>Paycheck sent!</p>';
	}
	
	public function view_salary()
	{
		$this->load->view('salary_view');
	}
}