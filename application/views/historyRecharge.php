<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h1 class="page-header">Recharge History</h1>
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                        	<div class="col-lg-12">                                
                                <?php if (count($historyRcg) > 0) {
                                    echo '<table class="table table-border" id="table1">';
                                    echo "<tr><th>Description</th><th>Status</th><th>Price</th><th>Order Id</th></tr>";
                                    foreach ($historyRcg as $rowHistoryRcg) {
                                       $status = $rowHistoryRcg->rcg_status == "" ? ($rowHistoryRcg->status == "success" ? "Processing" : $rowHistoryRcg->status) : $rowHistoryRcg->rcg_status;
                                        $description = "<p class='font-tiny'>Recharge of ".$this->main->getSingleRecord('services_subcategory','services_name' , 'services_code', $rowHistoryRcg->operator)." ".$rowHistoryRcg->mobile."<br>".dateFormatConvert($rowHistoryRcg->rcg_on)."</p>";
                                        echo "<tr><td><p class='font-tiny'>".$description."</p></td><td>".ucfirst($status)."</td><td>".$rowHistoryRcg->amount."</td><td>".$rowHistoryRcg->order_id."</td></tr>";
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
</script>