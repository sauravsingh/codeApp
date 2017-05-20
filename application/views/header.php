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
				<div class="col-md-7">

				</div>
				<div class="col-md-1 rightSide">
					<?php echo anchor($this->config->item('base_url').'logout', 'Logout', array('title' => 'logout'));?>
				</div>
			</div>
		</div>
	</div>
</header>
