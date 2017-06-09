<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h1 class="page-header">Wallet Passbook</h1>
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                        	<div class="col-lg-12">                                
                                
                                <?php if (count($historywallet) > 0) {
                                    echo '<table class="table table-border" id="table1">';
                                    echo "<thead><tr><th>Credit</th><th>Debit</th><th>Closing Balance</th><th>Date</th></tr></thead>";
                                    foreach ($historywallet as $rowHistoryWlt) {
                                       
                                        echo "<tbody><tr><td><p class='font-tiny'>".ifBlankData($rowHistoryWlt->in_amt)."</p></td><td><p class='font-tiny'>".ifBlankData($rowHistoryWlt->out_amt)."</p></td><td><p class='font-tiny'>".$rowHistoryWlt->remaining_amt."</p></td><td>".dateFormatConvert($rowHistoryWlt->created_on)."</td></tr></tbody>";
                                    }
                                    echo "</table>";
                                }
                                else{
                                    echo "<div class='text-center'>No record found!!</div>";
                                    }?>
                        	</div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/jquery-ui"></script>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/jquery.table.hpaging.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
        $("#table1").hpaging({
            limit : 7,
            activePage: 1,
            parentID: '',
            navBar: null,
        });
	})
    $(window).ready(function(){
        
    })
</script>