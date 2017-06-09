<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h1 class="page-header">Error</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="text-center"><?php echo $errorMsg;?></div>
			</div>
		</div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/jquery.min.js"></script>