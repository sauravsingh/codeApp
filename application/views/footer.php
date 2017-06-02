<script type="text/javascript">
	$( document ).ready(function() {
		function getWalletBal(){
			$("#walletBal").html("<?php echo "Avl Bal ".$this->main->getWalletBalById($_SESSION['userId'])?>");
		}
		setInterval(getWalletBal,1000);
	})
	
</script>
<?php echo $this->main->insufficientBar();?>

<!-- <script type="text/javascript" src="<?php //echo $this->config->item('base_url');?>assets/js/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/sidenav.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/metisMenu.js"></script>
</body>
</html>