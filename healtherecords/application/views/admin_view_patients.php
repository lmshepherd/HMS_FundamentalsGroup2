<?php
$this->load->view('header');?>

<body>
<header id="header"><h1>Health E-Records: Patients</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-4">
        		        	<h3>Patient Links</h3>
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
        	<?php $this->load->model('admin_search');
        	$this->admin_search->load_patients() ?>
        	
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