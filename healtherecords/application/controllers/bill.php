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
	
	public function bill_patients(){
		$appt_id = $this->input->post('id');
		$temp = array('admin_process'=> 1);
		$this->db->where('appt_id',$appt_id);
		$query = $this->db->update('appts',$temp);
		$chosenPatientID = $this->session->userdata('patient');
		$this->load->model('admin_search');
		$this->admin_search->get_appts($chosenPatientID);
		if($query){
			echo "<p> Patient has been billed</p>";
		}
		else{
			echo "Failure to bill";
		}
	}
	
	
	public function doctor_bill_flag()
	{
				//remove appt from database
		$appt_id = $this->input->post('apptID');
		//$this->db->from('appts');
		$this->db->where('appt_id',$appt_id);
		$temp = array('doctor_finish' => 1
		);
		$query = $this->db->update('appts',$temp);
		$chosenPatientID = $this->session->userdata('patient');
		$this->load->model('search');
    	$this->search->get_doctor_appts($chosenPatientID);
		//send notification emails
		//$this->load->view('bill_view');
		//$this->load->library('../controllers/appointment');
		//$this->appointment->select_patient();
	}
	
	public function view_bill()
	{
		$this->load->view('bill_view');
	}
	
	public function pay_bill()
	{
		echo '<br><p>';
		if ($this->input->post('amount')==$this->input->post('total_cost'))
		{
			$username = $this->session->userdata('username');
			
			$this->db->where('username', $username);
			$query2= $this->db->get('userinfo');
			$row2 = $query2->row();
			
			$patient_id = $row2->id;
			
			$this->db->where('patient_id', $patient_id);
			$query = $this->db->get('appts');
			
			foreach($query->result() as $row){
				$doc = $row->doctor_finish;
				$admin = $row->admin_process;
				$paid = $row->paid;
				if( ($doc==1) &&($admin==1) && ($paid == 0)){
					$this->db->where('appt_id',$row->appt_id);
					$temp=array('paid' => 1);
					$this->db->update('appts', $temp);
				}
			}
			
			echo "Bill payed!";
		}
		else echo "Payment amount does not match payment owed.";
		
		echo '</p>';
		//$this->load->view('bill_view');
		
	}
	
	public function load_bill_view()
	{
		echo '<br>';
		$username = $this->session->userdata('username');
		$this->db->where('username',$username);
		$query = $this->db->get('userinfo');
		$row = $query->row();
		
		$id = $row->id;
		$this->db->where('patient_id',$id);
		$query = $this->db->get('appts');
		
		//get insurance info
		$this->db->where('id',$id);
		$ins_query = $this->db->get('patients');
		$ins_row = $ins_query->row();
		
		echo '<div class="col-lg-12", id="center">';
		//configure table options
		$table_config = array ( 'table_open'  => '<table class="table" style="width:auto;">',
				'table_close' => '</table>');
		$this->table->set_template($table_config);
		
		//table for health e-records info
		$this->table->set_heading('Health E-Records');
		$this->table->add_row('University of Iowa');
		$this->table->add_row('Iowa City, IA');
		$this->table->add_row('319-335-3500');
		echo $this->table->generate();
		echo '<br>';
		
		
		//table for patient info
		$this->table->set_heading('Patient Name','Patient ID','Billing Date');
		//$this->load->helper('date');
		$this->table->add_row($row->firstname.' '.$row->lastname,$row->id,'20'.date('y-m-d'));
		echo $this->table->generate();
		echo '<br>';
		
		//table for insurance info
		$this->table->set_heading('Insurance Provider','Start date','End date');
		$this->table->add_row($ins_row->insuranceprovider,$ins_row->insurancestart,$ins_row->insuranceend);
		echo $this->table->generate();
		echo '<br>';
		
		//table for appointment info
		$table_config = array ( 'table_open'  => '<table class="table table-hover table-bordered">',
				'table_close' => '</table>');
		$this->table->set_template($table_config);
		$this->table->set_heading('Date ','Time ','Doctor ','Nurse','Duration','Treatment ','Prescription ','Covered ','Bill ');
		//billing variables
		$count = 0;
		$base_cost = 50;
		$cost = 0;
		$total_cost = 0;
		$covered = 'no';
		//
		foreach ($query->result() as $row)
		{
			$this->db->from('userinfo');
			$this->db->where('id',$row->doctor_id);
			$query2 = $this->db->get();
			$row2 = $query2->row();
		
			//get doctor information
			$this->db->from('doctors');
			$this->db->where('id',$row->doctor_id);
			$query3 = $this->db->get();
			$row3 = $query3->row();
			
			$this->db->from('userinfo');
			$this->db->where('id',$row->nurse_id);
			$query4 = $this->db->get();
			$row4 = $query4->row();
		
			//format time
			$time = $row->hour;
			if ($time<12)
				$ampm = 'am';
			else $ampm = 'pm';
			$time = $time%12;
			if ($time==0)
				$time=12;
		
			
			
			//admin_process check should not be negative check, but needed some things to show up since no admin approval yet
			if (($row->admin_process == 1) &&($row->doctor_finish==1) &&($row->paid != 1))
			{
				$count++;
				//calculate cost based off of experience
				$cost = $base_cost*((100+$row3->experience))/100;
					
				//check if appt covered by insurance
				//echo '<p>'.'20'.$row->date.' '.$ins_row->insurancestart.' '.$ins_row->insuranceend.'</p>';
				if (strtotime('20'.$row->date)>=strtotime($ins_row->insurancestart) &&
						strtotime($row->date)<=strtotime($ins_row->insuranceend))
				{
					//50% deductable?
					$cost = $cost/2;
					$covered = 'yes';
				}
				else
					$covered = 'no';
					
				//keep track of total cost
				$total_cost += $cost;
				//populate table
				$this->table->add_row(
						$row->date,
						$time.' '.$ampm,
						$row2->firstname . ' ' . $row2->lastname,
						$row4->firstname . ' ' . $row4->lastname,
						'1 hour',
						$row->treatment,
						$row->prescription,
						$covered,
						'$'.number_format($cost,2)
				);
			}
		}
		
		
		///
		//check if an appt is found
		if ($count>0)
		{
			//fasldfljn
			$this->table->add_row('','','','','','','','Total Cost: ','$'.number_format($total_cost,2));
			$this->table->add_row('','','','','','','','Confirm Payment: ','<input id="amount" type="text" />');
			$this->table->add_row('','','','','','','','','<input id='.$total_cost.' type="button" value="Pay Bill" onclick="pay_bill(this)" />');
			//$this->table->add_row('','','','','','',form_input('payment', ''));
			//$this->table->add_row('','','','','','',form_submit('pay_submit', 'Pay Bill'));
			//echo form_open('bill/pay_bill/'.$total_cost);
			echo "<p>";
			echo $this->table->generate();
			echo "</p>";
			//echo form_close();
		}
		//no appts ready to be paid
		else
			echo '<p>No payments currently due.</p>';
		
		
		
		//echo '</div>';
	}
}