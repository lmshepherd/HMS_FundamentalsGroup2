<?php

class Notify extends CI_Model
{
	public function appt_change_notification($appt)
	{
		//get appt info from db
		$this->db->where('appt_id',$appt);
		$query = $this->db->get('appts');
		$row = $query->row();
		$date = $row->date;
		$time = $row->hour;
		if ($time<12)
			$ampm = 'am';
		else $ampm = 'pm';
		$time = $time%12;
		if ($time==0)
			$time=12;
		
		//get patient, doctor, and nurse info from userinfo table
		$this->db->where('id',$row->patient_id);
		$query = $this->db->get('userinfo');
		$row2 = $query->row();
		$patient = $row2->firstname.' '.$row2->lastname;
		$pemail = $row2->email;
		
		$this->db->where('id',$row->doctor_id);
		$query = $this->db->get('userinfo');
		$row2 = $query->row();
		$doctor = $row2->firstname.' '.$row2->lastname;
		$demail = $row2->email;
		
		$this->db->where('id',$row->nurse_id);
		$query = $this->db->get('userinfo');
		$row2 = $query->row();
		$nurse = $row2->firstname.' '.$row2->lastname;
		$nemail = $row2->email;
		
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
		$this->email->from('admin@healtherecords.com','Appointment Change Notificaiton');
		$this->email->to($pemail);
		$this->email->subject('Appointment Time Change!');	
		//set up contents of email message
		$msg='<p>Your appointment time with Dr. '.$doctor.' has changed!</p>'; 
		$msg.='<p>New Date: '.$date.'</p>';
		$msg.='<p>New Time: '.$time.' '.$ampm.'</p>';
		$this->email->message($msg);
		$this->email->send();

		$this->email->set_newline("\r\n");
		//set up email to be sent
		$this->email->from('admin@healtherecords.com','Appointment Change Notificaiton');
		$this->email->to($demail);
		$this->email->subject('Appointment Time Change!');
		//set up contents of email message
		$msg='<p>Your appointment time with  '.$patient.' has changed!</p>';
		$msg.='<p>New Date: '.$date.'</p>';
		$msg.='<p>New Time: '.$time.' '.$ampm.'</p>';
		$this->email->message($msg);
		$this->email->send();
		
		$this->email->set_newline("\r\n");
		//set up email to be sent
		$this->email->from('admin@healtherecords.com','Appointment Change Notificaiton');
		$this->email->to($nemail);
		$this->email->subject('Appointment Time Change!');
		//set up contents of email message
		$msg='<p>Your appointment time with '.$patient.' for Dr. '.$doctor.' has changed!</p>';
		$msg.='<p>New Date: '.$date.'</p>';
		$msg.='<p>New Time: '.$time.' '.$ampm.'</p>';
		$this->email->message($msg);
		$this->email->send();
	}
	
}