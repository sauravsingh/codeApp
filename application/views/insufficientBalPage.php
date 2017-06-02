<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default text-center">
                	<h3>You have insufficient balance in your wallet, kindly recharge your account.</h3><br>
                	<button class="btn btn-success" onclick="addAmount()">Add Amount</button><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
	function addAmount() {
		window.location.href = "<?php echo base_url('wallet/requestBalance')?>";
	}
</script>