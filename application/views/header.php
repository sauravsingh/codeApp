<!Doctype>
<html>
<head>
	<title>
		<?php echo isset($title) ? $title : 'Default Title' ; ?>
	</title>
</head>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/css/custom.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/css/bootstrap.min.css"/>
<link href="<?php echo $this->config->item('base_url');?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo $this->config->item('base_url');?>assets/css/metisMenu.css">
<body>
<header class="navbar navbar-default navbar-fixed-top">	
	<div class="container">		
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-4">
					<h2>AASANPAY</h2>
				</div>
				<div class="col-md-5">

				</div>
				<div class="col-md-3 rightSide">
					<?php echo $this->main->getDetailById($_SESSION['userId'],'name');?>
					<?php echo anchor($this->config->item('base_url').'logout', 'Logout', array('title' => 'logout'));?><br>
					<div id="walletBal"></div>
				</div>
			</div>
		</div>
	</div>
</header>
<div id="flashMsg"><?php echo $this->session->flashdata('msg')?></div>
