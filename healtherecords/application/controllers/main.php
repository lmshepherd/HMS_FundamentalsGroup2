<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller 
{
	//default page
	public function index()
	{	
		$this->load->view('login_view');
	}
	
	
	//verify correct login form input format
	public function verify_login()
	{
		//set form rules to ensure login fields are not empty
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username','Username','required|callback_verify_userinfo');
		$this->form_validation->set_rules('password','Password','required');
		
		//if login form entries pass validation test
		if ($this->form_validation->run())
		{
			//save session data in an array
			$sessiondata = array('username' => $this->input->post('username'), 'is_logged_in' => 1);
			//create session with session data
			$this->session->set_userdata($sessiondata);
			
			$role=$this->session->userdata('role');
			
			//run homepage function of main controller
			redirect('main/home');
		}
		else 
		{
			//reload login page
			$this->load->view('login_view');
		}
	}
	
	
	//calls user function to check username and password in database
	public function verify_userinfo()
	{
		//load the user model
		$this->load->model('user');
		//call login function of user model
		if ($this->user->login())
		{
			return true;
		}
		else return false;
	}
	
	
	//attempt to access user homepage
	public function home()
	{
		$this->load->view('homepage_view');
	}
	
	
	//user clicks a logout button
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('main');
	}
	
	
	//user clicked new user button from login
	public function new_user()
	{
		$this->load->view('signup_view');
	}
	
	
	//verify signup form information
	public function verify_signup()
	{
		//load form validation functions
		$this->load->library('form_validation');
		//check username field and ensure uniqueness in database
		$this->form_validation->set_rules('username','Username','required|trim|is_unique[userinfo.username]');
		//check password field
		$this->form_validation->set_rules('password','Password','required|trim');
		//check cpassword field and make sure it matches password
		$this->form_validation->set_rules('cpassword','Confirm_Password','required|trim|matches[password]');
		//check email field 
		$this->form_validation->set_rules('email','Email','required|trim|valid_email');
		
		//change message shown when username is already taken
		$this->form_validation->set_message('is_unique','That username is already in use.');
		
		//check if form has valid entries
		if ($this->form_validation->run())
		{
			//generate a random new user key to send as a link
			$link = md5(uniqid());
			
			//set up email address for healtherecords20@gmail.com account
			$config=Array(
					'protocol' => 'smtp',
    				'smtp_host' => 'ssl://smtp.googlemail.com',
    				'smtp_port' => 465,
    				'smtp_user' => 'healtherecords20',
    				'smtp_pass' => 'team2team2',
    				'mailtype'  => 'html', 
    				'charset'   => 'iso-8859-1'
					);
			//load email library
			$this->load->library('email',$config);
			$this->email->set_newline("\r\n");
			//set up email to be sent
			$this->email->from('admin@healtherecords.com','Chuck');
			$this->email->to($this->input->post('email'));
			$this->email->subject('Confirm your Health E-Records account!');
			
			//set up contents of email message
			$msg="<p>Follow the link to confirm registration: </p>";
			//when user navigates to the link, the user_confirmation function is called
			$msg.="<p><a href='".base_url()."index.php/main/user_confirmation/$link'>Click Here!</a></p>";
			$this->email->message($msg);
			
			//load user model to add new user to temp db table
			$this->load->model('user');
			
			//add user key to temp db
			if ($this->user->add_temp($link))
			{
				//send the email
				if ($this->email->send())
				{
					$this->load->view('email_sent_view');
				}
				else echo 'Email could not be sent.';
			}
			else echo 'User could not be created.';
			
		}
		else //form validation failed
		{
			//reload signup page
			$this->load->view('signup_view');
		}
	}
	
	
	//user visits confirmation link
	public function user_confirmation($link)
	{
		//load user model
		$this->load->model('user');
		
		//send link to valid_link user function
		if ($this->user->valid_link($link))
		{
			//link is valid, try creating new user
			if($this->user->new_user($link))
			{
				//user created, send to registration completion page to enter info
				$this->load->view('registration_view');
			}
			else echo 'Error creating new user.';
		}
		else echo 'Invalid link.';
	}
	
	//user clicks complete registration button on registration page
	public function complete_registration()
	{
		//TODO: form validation for registration page
		
		//load user model
		$this->load->model('user');
		//if db was updated
		if($this->user->complete_new_user()){
			$this->load->view('homepage_view');
		}else echo 'Uh-Oh, we could not submit your data.';
	}
}
