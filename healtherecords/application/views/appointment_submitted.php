<?php $this->load->view('commonViews/header');?>

<body>
<header id="header"><h1>Health E-Records Appointment Confirmation</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-2", id="left">
			<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-10" id="center">
        	<br>
		    <p>Your appointment has been made!</p>
			<p>Appointment information: </p>
		
			<?php 
			$hour = $this->input->post('hours');
			$aptdate = $this->session->userdata('aptdate');
			$docid = $this->session->userdata('selected_doctor');
			$this->db->from('userinfo');
			$this->db->where('id',$docid);
			//$this->db->where('hour',$hour);
			$query = $this->db->get();
			$row = $query->row();
			
			
			if ($hour>12)
			{
				$hour12 = $hour%12;
				$ampm = 'pm';
			}
			else
			{
				$hour12 = $hour;
				$ampm = 'am';
			}
			if ($hour12==0)
				$hour12 = $hour12 + 12;
			//echo 'Appointment confirmed for: '.$aptdate;
			echo '20'.$aptdate.' at '.$hour12.' '.$ampm.' with Dr. '.$row->lastname;
			?>
		
			<br><p></p>
			<?php $this->load->view('commonViews/backLinks');?><p></p>
	</div>
	<br>
      </div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>


	