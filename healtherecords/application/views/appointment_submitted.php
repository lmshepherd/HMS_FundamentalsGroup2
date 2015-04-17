<?php $this->load->view('header');?>

<body>
<header id="header"><h1>Health E-Records Appointment Confirmation</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-4">
     	    <ul>
			    <li><a href="http://projectsgeek.com/2013/08/hospital-management-system-mini-project-2.html">HMS Info</a></li>
			    <li><a href="#">Link 2</a></li>
			    <li><a href="#">Link 3</a></li>
			    <li><a href="#">Link 4</a></li>
			    <li><a href="#">Link 5</a></li>
		    </ul>
		    <h3>Doctor Links</h3>
		    <ul>
			    <li><a href="#">Link 1</a></li>
			    <li><a href="#">Link 2</a></li>
		    	<li><a href="#">Link 3</a></li>
			    <li><a href="#">Link 4</a></li>
			    <li><a href="#">Link 5</a></li>
			</ul>
		</div>
        <div class="col-lg-8">
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
			echo $aptdate.' at '.$hour12.' '.$ampm.' with Dr. '.$row->lastname;
			?>
		
			<br>
			<a href = '<?php 
				echo base_url(),"index.php/main/home"
				?>'>Back to Home</a>
			<a href = '<?php
				echo base_url(),"index.php/main"
			?>'>Back to Login</a>
	</div>
      </div>
</div>
</body>
</html>


	