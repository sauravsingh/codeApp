<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h2>Requested Balance List</h2>
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default text-center"><br>
                <div id="msg"></div>
                	<br>
                	<table class="table table-border">
                		<tr>
                			<th>Name</th>
                			<th>Amount(INR)</th>
                			<th>User Group</th>
                			<th>Status</th>
                			<th></th>
                		</tr>
                		<?php
                			if(count($requestedList) > 0){
                				foreach ($requestedList as $rowRequested) {
	                				$statusMsg = $rowRequested->status==0 ? "Requested" : "Approved";
	                				echo "<tr><td>".$this->main->getDetailById($rowRequested->user_id, 'name')."</td>";
	                				echo "<td>".$rowRequested->amount."</td>";
	                				echo "<td>".$this->main->getUserTypeById($rowRequested->user_id,'users_group_name')."</td>";
	                				echo "<td>".$statusMsg."</td>";
	                				echo "<td><span onclick='approveAmt(".$rowRequested->wallet_temp_id.")' class='fa fa-check-circle-o fa-fw curPointer'></span></td></tr>";
	                			}
                			}
                			else{
                				echo "<tr><td colspan='5'><center>No record found!!!</center></td></tr>";
                			}
                		?>
                	</table>
                	<br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		
	});
	function approveAmt(id){
		$.ajax({ 
			url: '<?php echo base_url("wallet/approvedAmtAjax");?>',
         	data: {id: id},
         	type: 'POST',
         	success: function(output) {
                $("#flashMsg").html(<?php $this->session->flashdata('msg')?>);
                location.reload();
            }
		});
	}
</script>