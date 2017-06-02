<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h1 class="page-header">Mobile Operator Configuration</h1>
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                        	<div class="col-lg-12">
                                <div class="col-lg-12">
                                    <table class="table table-border">
                                    <?php
                                        if(count($serviceList) > 0){
                                            echo "<tr><th>Name</th><th>Current Status</th><th></th></tr>";
                                        
                                            foreach ($serviceList  as $rowServiceList) {
                                                echo form_open();
                                                $name_array = array(
                                                    'type'  => 'text',
                                                    'name' => 'operatorName',
                                                    'class' => 'form-control readonly',
                                                    'value' => $rowServiceList->services_name,
                                                    'readonly' => 'readonly'
                                                    );
                                                $id_array = array(
                                                    'type'  => 'hidden',
                                                    'name' => 'operatorId',
                                                    'class' => 'form-control',
                                                    'value' => $rowServiceList->services_id
                                                    );
                                                $status = $rowServiceList->status == 1 ? "Active" : "Not Active";
                                                echo "<tr><td>".form_input($name_array)."</td>";
                                                echo "<td>".$status."</td>";
                                                echo "<td><span onclick='editRecord(".$rowServiceList->services_id.")' class='fa fa-pencil-square fa-fw curPointer'></td>";
                                                echo "</tr>";
                                                echo form_close();
                                            }
                                        }
                                        else{
                                            echo "<center>No record found.</center>";
                                        }
                                    ?>
                                    </table>
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
    function editRecord(val){
       console.log($(this).parent().parent().find("td").html());//attr("readonly","false");
       //$(this).parent().find("input[name=operatorName]").removeClass("readonly");
    }
</script>