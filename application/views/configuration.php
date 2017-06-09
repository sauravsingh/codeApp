<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h1 class="page-header">Configure the panel</h1>
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                        	<div class="col-lg-6">
                                <div class="col-lg-6">
                                    <div class="well">
                                      <h4 class="text-primary"><a href="<?php echo base_url('configuration/operatorConfig');?>">Mobile Operator </a></h4>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="well">
                                      <h4 class="text-primary"><a href="<?php echo base_url('configuration/addCommission');?>">Add Commision </a></h4>
                                    </div>
                                </div>
                        	</div> 
                        	<!--offer display here-->
                        	<div class="col-lg-6">
	                        	
                        	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		
	})
</script>