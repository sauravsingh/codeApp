<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h1 class="page-header">Recharge Output</h1>
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                        	<div class="col-lg-12">                        		
                				<?php echo $layout;?>
                        	</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="col-lg-6">
                                    <button id="againRecharge" class="btn btn-success">Make Another Recharge</button>
                                </div>
                                <div class="col-lg-6">
                                    <button id="rechargeHistory" class="btn btn-primary">History</button>
                                </div>
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
		$("#againRecharge").on("click", function(){
            window.location.href = "<?php echo base_url('recharge');?>";
        })
        $("#rechargeHistory").on("click", function(){
            window.location.href = "<?php echo base_url('history/recharge')?>";
        })
	})    
</script>