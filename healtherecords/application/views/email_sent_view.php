<?php $this->load->view('commonViews/header');?>

<body>
<header id="header"><h1>Health E-Records: Email Sent!</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-4">
        	<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-8">
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