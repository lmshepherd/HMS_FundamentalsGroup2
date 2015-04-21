<?php 
$username = $this->session->userdata('username');

$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();
$role = $row->role;
?>

<?php $this->load->view('commonViews/header');?>

<body>
<header id="header"><h1>Welcome to Health E-Records</h1></header>
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
			echo '<p>'; 
			if ($row->role=='patient')
				echo 'Patient';
			else if ($row->role=='nurse')
				echo 'Nurse';
			else if ($row->role=='doctor')
				echo 'Doctor';
			else echo 'Admin';
			echo ' Information: </p>';
			
			echo '<p>Name: ';
			echo $row->firstname;
			echo ' ';
			echo $row->lastname;
			echo '</p>';
			
			echo '<p>Email: ';
			echo $row->email;
			echo '</p>';
			
			echo '<p>Date of Birth: ';
			echo $row->dob;
			echo '</p>';
			
			echo '<p>Home Phone: ';
			echo $row->homephone;
			echo '</p>';
			
			echo '<p>Work Phone: ';
			echo $row->workphone;
			echo '</p>';
			
			if($role=='patient')
				$this->load->view('patienthomepage_view');
			else if($role=='nurse')
				$this->load->view('nursehomepage_view');
			else if($role=='doctor')
				$this->load->view('doctorhomepage_view');
			else if($role=='admin')
				$this->load->view('adminhomepage_view');
			
			?>
			
			<a href = '<?php 
				echo base_url(),"index.php/main/logout"
			?>'>Logout</a>
	</div>
      </div>

</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
