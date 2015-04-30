<!DOCTYPE html>
<html lang="en">
<head>



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?= base_url();?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?= base_url();?>bootstrap/css/generic.css" rel="stylesheet">
	<script src="<?= base_url();?>bootstrap/js/bootstrap.min.js"></script>
	<meta charset="utf-8">
	<title>Health E-Records</title>
</head>
<body>
<header id="header"><h1>Health E-Records: Email Sent!</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-2", id="left">
        	<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-10", id="center">
        	<p>A link to complete registration has been sent to your email address!</p>
			<a href = '<?php 
				echo base_url(),"index.php/main"
			?>'>Back to Login</a>
		</div>
	</div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>