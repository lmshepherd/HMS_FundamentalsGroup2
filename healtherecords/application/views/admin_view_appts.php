
<?php
$this->load->view('commonViews/header');?>

<body>
<header id="header"><h1>Health E-Records: History</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-2", id="left">
        		<?php $this->load->view('commonViews/links');?>
			</div>
        <div class="col-lg-10", id="center">
        <br>
        	<?php $this->load->model('admin_search');
        	$this->admin_search->load_appointments() ?>
        	
        	<?php $this->load->view('commonViews/backLinks');?><p></p>
		</div>
	</div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>