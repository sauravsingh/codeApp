<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h2>Request Balance</h2>
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default text-center"><br>
                <div id="msg"></div>
                	<br>
                	<?php //echo form_open('wallet/request','class=form-inline');?>
                	<div class="form-inline">
	                	<label class="sr-only" for="amt">Amount</label>
					  	<div class="input-group mb-2 mr-sm-2 mb-sm-0">
					    	<div class="input-group-addon">INR</div>
					    	<input type="text" name="requestedAmt" class="form-control" id="amt" placeholder="Amount">
					  	</div>
					  	<button type="submit" class="btn btn-primary" id="submitForm">Request</button>
					</div>
                	<?php //echo form_close();?>
                	<br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		$("#submitForm").on("click", function(){
			var reqAmt = $("#amt").val();
			if(reqAmt == "" || reqAmt == " " || reqAmt == "0"){
				$("#amt").css("border","1px solid red");
			}
			else{
				$("#amt").css("border","1px solid #ccc");
				$.ajax({ 
					url: '<?php echo base_url("wallet/requestAmt");?>',
		         	data: {amt: reqAmt},
		         	type: 'POST',
		         	success: function(output) {
		                $("#msg").html(output);
		                $("#amt").val('');
		            }
				});
			}
			return false;
		})
	});
</script>