<?php
class Payroll extends CI_Model
{
	public function view_payroll()
	{
		echo '<br>';
		
		$this->db->from('userinfo');
		$this->db->order_by('lastname','asc');
		$query_all = $this->db->get();
		$year = $this->input->post('year');
		$month = $this->input->post('month');
		
		foreach ($query_all->result() as $row)
		{
			if ($row->role != 'patient' && $row->id != 0)
			{
				//check if paycheck for current month/year already exists
				$this->db->from('paychecks');
				$this->db->where('employee_id',$row->id);
				$this->db->where('year',$year);
				$this->db->where('month',$month);
				$exists_query = $this->db->get();
				//create new paycheck in paychecks table if it does not yet exist
				if ($exists_query->num_rows()==0)
				{
					$data = array(
							'employee_id' => $row->id ,
							'amount' => '0' ,
							'year' => $year,
							'month' => $month,
							'sent' => false
					);
					$this->db->insert('paychecks', $data);
				}
				
				//get current year/month paychecks that need to be sent
				$this->db->from('paychecks');
				$this->db->where('employee_id',$row->id);
				$this->db->where('year',$year);
				$this->db->where('month',$month);
				$query2 = $this->db->get();
				$row2 = $query2->row();
				
				$total=0;
				$count=0;
				$paycheck_id = $row2->paycheck_id;
				
				if (!$row2->sent)
				{	
					echo '<div class="panel panel-default">
				  		<div class="panel-heading">'.$row->firstname.' '.$row->lastname.'</div>
				  		<div class="panel-body"> <p>Base Salary: ';
					if($row->role=='doctor')
						$total += 8500;
					else if($row->role=='nurse')
						$total += 5000;
					else 
						$total += 3500;
					echo number_format($total,2).'</p>';
					
					if ($row->role!='admin')
						echo 'Appointments:';
					
					$this->table->set_heading('Date','Patient','Pay');
					$table_config = array ( 'table_open'  => '<table class="table">',
							'table_close' => '</table>');
					$this->table->set_template($table_config);
					
					if ($row->role=='doctor')
					{
						$this->db->from('doctors');
						$this->db->where('id',$row->id);
						$doc_query = $this->db->get();
						$doc_row = $doc_query->row();
						if ($doc_row->specialization == 'cardiologist')
							$specialization_mult = 3;
						else if ($doc_row->specialization == 'endocrinologist')
							$specialization_mult = 1.9;
						else if ($doc_row->specialization == 'general')
							$specialization_mult = 1.5;
						else if ($doc_row->specialization == 'immunologist')
							$specialization_mult = 2;
						else 
							$specialization_mult = 2.4;
						$exp_pay = 30*($doc_row->experience+150)/200;
						$exp_pay = $exp_pay * $specialization_mult;
						
						$this->db->from('appts');
						$this->db->where('doctor_id',$row->id);
						$query3 = $this->db->get();
						
						foreach ($query3->result() as $row3)
						{
							//check that appointment falls within period
							if(intval(substr($row3->date,0,2))==$year-2000 &&
							  (intval(substr($row3->date,3,1))==$month ||
							   intval(substr($row3->date,3,2))==$month) &&
								$row3->doctor_finish)
							{
								$this->db->from('userinfo');
								$this->db->where('id',$row3->patient_id);
								$query4 = $this->db->get();
								$row4 = $query4->row();
								
								$this->table->add_row('20'.$row3->date,$row4->firstname.' '.$row4->lastname,number_format($exp_pay,2));
								$total += $exp_pay;
								$count += 1;
							}
						}
						
					}
					else if ($row->role=='nurse')
					{
						$extra_pay = 25;
						
						$this->db->from('appts');
						$this->db->where('nurse_id',$row->id);
						$query3 = $this->db->get();
						
						foreach ($query3->result() as $row3)
						{
							//check that appointment falls within period
							if(intval(substr($row3->date,0,2))==$year-2000 &&
							  (intval(substr($row3->date,3,1))==$month ||
							   intval(substr($row3->date,3,2))==$month) &&
								$row3->doctor_finish)
							{
								$this->db->from('userinfo');
								$this->db->where('id',$row3->patient_id);
								$query4 = $this->db->get();
								$row4 = $query4->row();
								
								$this->table->add_row('20'.$row3->date,$row4->firstname.' '.$row4->lastname,number_format($extra_pay,2));
								$total += $extra_pay;
								$count += 1;
							}
						}
					}
					if ($count>0)
						echo $this->table->generate();
					else if ($row->role!='admin')
						echo '<p>None during this period.</p>';

					echo 'Total Pay: $'.number_format($total,2);
					echo '</div>
						<div class="panel-footer">
							<input id='.$paycheck_id.' type="button" value="Distribute Paycheck" onclick="send_paycheck(this)" />
						</div>
						</div>';
					
					$data = array('amount' => $total);
					$this->db->where('paycheck_id',$paycheck_id);
					$this->db->update('paychecks',$data);
					
				}
			}
		}
	}
	
	public function salary_history()
	{
		$username = $this->session->userdata('username');
		
		$this->db->where('username',$username);
		$query = $this->db->get('userinfo');
		$row = $query->row();
		$role = $row->role;
		$id = $row->id;
		
		$this->db->from('paychecks');
		$this->db->where('employee_id',$row->id);
		$this->db->order_by('year','desc');
		$this->db->order_by('month','desc');
		$query2 = $this->db->get();
		//$row2 = $query2->row();
		
		foreach ($query2->result() as $row2)
		{
			$total=0;
			$count=0;
			
			if ($row2->sent)
			{
				echo '<div class="panel panel-default">
					  		<div class="panel-heading">'.$row2->month.'/'.$row2->year.'</div>
					  		<div class="panel-body"> <p>Base Salary: ';
				if($row->role=='doctor')
					$total += 8500;
				else if($row->role=='nurse')
					$total += 5000;
				else
					$total += 3500;
				echo number_format($total,2).'</p>';
					
				if ($row->role!='admin')
					echo 'Appointments:';
					
				$this->table->set_heading('Date','Patient','Pay');
				$table_config = array ( 'table_open'  => '<table class="table">',
						'table_close' => '</table>');
				$this->table->set_template($table_config);
				
				$year = $row2->year;
				$month = $row2->month;
					
				if ($row->role=='doctor')
				{
					$this->db->from('doctors');
					$this->db->where('id',$row->id);
					$doc_query = $this->db->get();
					$doc_row = $doc_query->row();
					if ($doc_row->specialization == 'cardiologist')
							$specialization_mult = 3;
						else if ($doc_row->specialization == 'endocrinologist')
							$specialization_mult = 1.9;
						else if ($doc_row->specialization == 'general')
							$specialization_mult = 1.5;
						else if ($doc_row->specialization == 'immunologist')
							$specialization_mult = 2;
						else 
							$specialization_mult = 2.4;
						$exp_pay = 30*($doc_row->experience+150)/200;
						$exp_pay = $exp_pay * $specialization_mult;
			
					$this->db->from('appts');
					$this->db->where('doctor_id',$row->id);
					$query3 = $this->db->get();
			
					foreach ($query3->result() as $row3)
					{
						//check that appointment falls within period
						if(intval(substr($row3->date,0,2))==$year-2000 &&
								(intval(substr($row3->date,3,1))==$month ||
										intval(substr($row3->date,3,2))==$month) &&
								$row3->doctor_finish)
						{
							$this->db->from('userinfo');
							$this->db->where('id',$row3->patient_id);
							$query4 = $this->db->get();
							$row4 = $query4->row();
			
							$this->table->add_row('20'.$row3->date,$row4->firstname.' '.$row4->lastname,number_format($exp_pay,2));
							$total += $exp_pay;
							$count += 1;
						}
					}
			
				}
				else if ($row->role=='nurse')
				{
					$extra_pay = 25;
			
					$this->db->from('appts');
					$this->db->where('nurse_id',$row->id);
					$query3 = $this->db->get();
			
					foreach ($query3->result() as $row3)
					{
						//check that appointment falls within period
						if(intval(substr($row3->date,0,2))==$year-2000 &&
								(intval(substr($row3->date,3,1))==$month ||
										intval(substr($row3->date,3,2))==$month) &&
								$row3->doctor_finish)
						{
							$this->db->from('userinfo');
							$this->db->where('id',$row3->patient_id);
							$query4 = $this->db->get();
							$row4 = $query4->row();
			
							$this->table->add_row('20'.$row3->date,$row4->firstname.' '.$row4->lastname,number_format($extra_pay,2));
							$total += $extra_pay;
							$count += 1;
						}
					}
				}
				if ($count>0)
					echo $this->table->generate();
				else if ($row->role!='admin')
					echo '<p>None during this period.</p>';
			
				echo 'Total Pay: $'.number_format($total,2);
				echo '</div>';
				echo '<div class="panel-footer">';
					//$attributes = array('paycheck_id' => $row2->paycheck_id);
					$hidden = array('paycheck_id' => $row2->paycheck_id);
					echo form_open('salary/load_paycheck_view','', $hidden).form_submit('view_invoice', 'View Invoice').form_close();
					//echo form_submit($row2->paycheck_id,'View Invoice');
					//<input id='.$row2->paycheck_id.' type="button" value="View Invoice" onclick="view_invoice(this)" />
				echo '</div>';
				echo '</div>';
					
				
			}
		}
	}
	
	
	public function load_paycheck_invoice($paycheck_id)
	{
		$username = $this->session->userdata('username');
		$this->db->where('username',$username);
		$query = $this->db->get('userinfo');
		$row = $query->row();
		
		$this->db->from('paychecks');
		$this->db->where('paycheck_id',$paycheck_id);
		$query2 = $this->db->get();
		$row2 = $query2->row();
		
		
		echo '<div class="col-lg-12", id="center">';
		echo '<br>';
		//echo 'paycheck '.$paycheck_id;
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
		//echo '<br>';
		
		
		//table for patient info
		$this->table->set_heading('Name','ID','Invoice Period');
		//$this->load->helper('date');
		$this->table->add_row($row->firstname.' '.$row->lastname, $row->id,$row2->month.'/'.$row2->year);
		echo $this->table->generate();
		echo '<br>';
		
		$total=0;
		$count=0;
			
		
		echo '<div class="panel panel-default">
				  		<div class="panel-heading">Salary</div>
				  		<div class="panel-body"> <p>Base Salary: ';
		if($row->role=='doctor')
			$total += 8500;
		else if($row->role=='nurse')
			$total += 5000;
		else
			$total += 3500;
		echo number_format($total,2).'</p>';
			
		if ($row->role!='admin')
			echo 'Appointments:';
			
		$this->table->set_heading('Date','Patient','Pay');
		$table_config = array ( 'table_open'  => '<table class="table">',
				'table_close' => '</table>');
		$this->table->set_template($table_config);
	
		$year = $row2->year;
		$month = $row2->month;
			
		if ($row->role=='doctor')
		{
			$this->db->from('doctors');
			$this->db->where('id',$row->id);
			$doc_query = $this->db->get();
			$doc_row = $doc_query->row();
			if ($doc_row->specialization == 'cardiologist')
				$specialization_mult = 3;
			else if ($doc_row->specialization == 'endocrinologist')
				$specialization_mult = 1.9;
			else if ($doc_row->specialization == 'general')
				$specialization_mult = 1.5;
			else if ($doc_row->specialization == 'immunologist')
				$specialization_mult = 2;
			else
				$specialization_mult = 2.4;
			$exp_pay = 30*($doc_row->experience+150)/200;
			$exp_pay = $exp_pay * $specialization_mult;
				
			$this->db->from('appts');
			$this->db->where('doctor_id',$row->id);
			$query3 = $this->db->get();
				
			foreach ($query3->result() as $row3)
			{
				//check that appointment falls within period
				if(intval(substr($row3->date,0,2))==$year-2000 &&
						(intval(substr($row3->date,3,1))==$month ||
								intval(substr($row3->date,3,2))==$month) &&
						$row3->doctor_finish)
				{
					$this->db->from('userinfo');
					$this->db->where('id',$row3->patient_id);
					$query4 = $this->db->get();
					$row4 = $query4->row();
						
					$this->table->add_row('20'.$row3->date,$row4->firstname.' '.$row4->lastname,number_format($exp_pay,2));
					$total += $exp_pay;
					$count += 1;
				}
			}
				
		}
		else if ($row->role=='nurse')
		{
			$extra_pay = 25;
				
			$this->db->from('appts');
			$this->db->where('nurse_id',$row->id);
			$query3 = $this->db->get();
				
			foreach ($query3->result() as $row3)
			{
				//check that appointment falls within period
				if(intval(substr($row3->date,0,2))==$year-2000 &&
						(intval(substr($row3->date,3,1))==$month ||
								intval(substr($row3->date,3,2))==$month) &&
						$row3->doctor_finish)
				{
					$this->db->from('userinfo');
					$this->db->where('id',$row3->patient_id);
					$query4 = $this->db->get();
					$row4 = $query4->row();
						
					$this->table->add_row('20'.$row3->date,$row4->firstname.' '.$row4->lastname,number_format($extra_pay,2));
					$total += $extra_pay;
					$count += 1;
				}
			}
		}
		if ($count>0)
			echo $this->table->generate();
		else if ($row->role!='admin')
			echo '<p>None during this period.</p>';
			
		echo 'Total Pay: $'.number_format($total,2);
		echo '</div>';
		
		
	}
	
}