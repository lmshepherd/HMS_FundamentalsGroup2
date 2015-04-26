<?php 
$username = $this->session->userdata('username');

$this->db->where('username',$username);
$query = $this->db->get('userinfo');
$row = $query->row();
$role = $row->role;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url();?>bootstrap/css/generic.css" rel="stylesheet">
	<script src="<?= base_url();?>bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Health E-Records</title>

  
  		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.1.min.js"></script>
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/jquery-ui.min.js"></script>
		<link href="http://ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/themes/Cupertino/jquery-ui.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="css/Lab8Stylesheet.css">
  
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
</head>
<body>
<header id="header"><h1>Welcome to Health E-Records</h1></header>
<div id="container">
	      <div class="row">
        <div class="col-lg-2", id="left">
     	    <?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-10", id="center">
        <div id="tabs">
  <ul>
    <li><a href="#tabs-1">User Info</a></li>
    <li><a href="#tabs-2">Other Info</a></li>
    <li><a href="#tabs-3">Useful Links</a></li>
  </ul>
  <div id="tabs-1">
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
			
			?>  
  </div>
  <div id="tabs-2">
  	<?php 
  				if($role=='patient')
				$this->load->view('homepage_tabViews/patienthomepage_view');
			else if($role=='nurse')
				$this->load->view('homepage_tabViews/nursehomepage_view');
			else if($role=='doctor')
				$this->load->view('homepage_tabViews/doctorhomepage_view');
			else if($role=='admin')
				$this->load->view('homepage_tabViews/adminhomepage_view');
		?>  
  </div>
  <div id="tabs-3">
    		<?php 
    		if($role=='patient')
				$this->load->view('homepage_tabViews/patient_links');
			else if($role=='nurse')
				$this->load->view('homepage_tabViews/nurse_links');
			else if($role=='doctor')
				$this->load->view('homepage_tabViews/doctor_links');
			else if($role=='admin')
				$this->load->view('homepage_tabViews/admin_links');  
			?>
  </div>
</div>

			
			<a href = '<?php 
				echo base_url(),"index.php/main/logout"
			?>'>Logout</a>
	</div>
      </div>

</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>
