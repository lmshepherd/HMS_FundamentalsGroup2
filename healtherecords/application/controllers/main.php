
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller 
{

	//default
	public function index()
	{
		$this->load->view('login_view');
	}
	
	//verify correct login form input format
	public function verify()
	{
		//set form rules to ensure login fields are not empty
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required|md5');
		
		//if login form entries pass validation test
		if ($this->form_validation->run())
		{
			//run members function of main controller
			redirect('main/home');
		}
		else 
		{
			//reload login page
			$this->load->view('login_view');
		}
		
		echo $this->input->post('username');
	}
	
	//attempt to access user homepage
	public function home()
	{
		//$this->load->view('homepage_view');
	}
	
}
