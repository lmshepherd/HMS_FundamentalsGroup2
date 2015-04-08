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

		
		if ($this->form_validation->run())
		{
			$username = $this->session->userdata('username');
			//get id from userinfo table
			$this->db->where('username',$username);
			$query = $this->db->get('userinfo');
			$row = $query->row();
			
			$temp = array(
					'sunstart' => $this->input->post('sunstart'),'sunend' => $this->input->post('sunend'),
					'monstart' => $this->input->post('monstart'),'monend' => $this->input->post('monend'),
					'tuestart' => $this->input->post('tuestart'),'tueend' => $this->input->post('tueend'),
					'wedstart' => $this->input->post('wedstart'),'wedend' => $this->input->post('wedend'),
					'thustart' => $this->input->post('thustart'),'thuend' => $this->input->post('thuend'),
					'fristart' => $this->input->post('fristart'),'friend' => $this->input->post('friend'),
					'satstart' => $this->input->post('satstart'),'satend' => $this->input->post('satend'));
			$this->db->where('id',$row->id);
			$query = $this->db->update('schedule',$temp);
			
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