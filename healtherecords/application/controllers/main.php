
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
		$this->form_validation->set_rules('username','Username','required|callback_check_credentials');
		$this->form_validation->set_rules('password','Password','required');
		
		//if login form entries pass validation test
		if ($this->form_validation->run())
		{
			//save session data in an array
			$sessiondata = array('username' => $this->input->post('username'), 'is_logged_in' => 1);
			//create session with session data
			$this->session->set_userdata($sessiondata);
			//run members function of main controller
			redirect('main/home');
		}
		else 
		{
			//reload login page
			$this->load->view('login_view');
		}
	}
	
	//calls user function to check username and password in database
	public function check_credentials()
	{
		//load the user model
		$this->load->model('user');
		//call login function of user model
		if ($this->user->login())
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	//attempt to access user homepage
	public function home()
	{
		$this->load->view('homepage_view');
	}
	
}
