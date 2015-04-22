<?php
$this->load->view('commonViews/header');?>

<body>
<header id="header"><h1>Health E-Records: Patients</h1></header>
<div id="container">
      <div class="row">
        <div class="col-lg-3", id="left">
        	<?php $this->load->view('commonViews/links');?>
		</div>
        <div class="col-lg-9", id="center">
        	<?php $this->load->model('admin_search');
        	$this->admin_search->load_patients() ?>
        	
        	<?php $this->load->view('commonViews/backLinks');?>
        	
		</div>
	</div>
</div>
<?php $this->load->view('commonViews/footer');?>
</body>
</html>