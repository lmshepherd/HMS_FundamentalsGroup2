<?php 
$appt_id = $this->session->userdata('appt_id');
$this->db->where('appt_id', $appt_id);
$query = $this->db->get('appts');
$row=$query->row();

$patient_id = $row->patient_id;
$this->db->where('id',$patient_id);
$query2=$this->db->get('userinfo');
$row2=$query2->row();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
	<script src="<?= base_url();?>bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>

<body>
<header id="header"><h1>Health E-Records Patient Treatments</h1></header>
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
        <?php 
			echo "<p>";
			echo "Patient Name: ";
			echo $row2->firstname.' '.$row2->lastname;
			echo "</p>";
			
			echo "<p>";
			echo "Current Treatment: ";
			echo $row->treatment;
			echo "</p>";
			
			echo form_open('appointment/update_treaments');
			echo "<p>";
			echo form_input('treatments');
			echo "</p>";
			echo "<p>";
			echo form_submit('treatment_submit', 'Update Treatment');
			echo "</p>";
				
			echo form_close();
			?>
			
			<a href = '<?php 
				echo base_url(),"index.php/main/home"
			?>'>Back to Home</a>
			
			<a href = '<?php 
				echo base_url(),"index.php/main/logout"
			?>'>Logout</a>
	</div>
      </div>

</div>

</body>
</html>
