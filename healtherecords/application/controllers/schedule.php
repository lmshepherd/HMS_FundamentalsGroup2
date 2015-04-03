<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller 
{
	
	public function change_schedule()
	{
		$this->load->view('schedule_view');
	}
	
	public function set_schedule()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('sunstart','Sunday Start Time','callback_check_times');
		/*$this->form_validation->set_rules('monstart','Monsday Start Time','less_than[monend]');
		$this->form_validation->set_rules('tuestart','Tuesday Start Time','less_than[tueend]');
		$this->form_validation->set_rules('wedstart','Wednesday Start Time','less_than[wedend]');
		$this->form_validation->set_rules('thustart','Thursday Start Time','less_than[thuend]');
		$this->form_validation->set_rules('fristart','Friday Start Time','less_than[friend]');
		$this->form_validation->set_rules('satstart','Saturday Start Time','less_than[satend]');*/
		
		if ($this->form_validation->run())
		{
			$this->load->view('homepage_view');
		}
		else $this->load->view('schedule_view');
	}
	
	public function check_times()
	{
		if ($this->input->post('sunstart') >= $this->input->post('sunend') &&
			$this->input->post('monstart') >= $this->input->post('monend') &&
			$this->input->post('tuestart') >= $this->input->post('tueend') &&
			$this->input->post('wedstart') >= $this->input->post('wedend') &&
			$this->input->post('thustart') >= $this->input->post('thuend') &&
			$this->input->post('fristart') >= $this->input->post('friend') &&
			$this->input->post('satstart') >= $this->input->post('satend'))
		{
			return false;
		}
		else return true;
	}
	
	
}