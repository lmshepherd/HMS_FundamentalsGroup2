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
			if ($row->role != 'patient')
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
						$exp_pay = 50*($doc_row->experience+150)/200;
						
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
	
	
	
}