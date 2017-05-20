<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h1 class="page-header">Recharge</h1>
			</div>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                        	<div class="col-lg-6">                        		
                				<div class="form-group form-style">
                					<label class="drinkcard-cc mobile" for="mobile" id="mobTab"></label>
                				</div>
                				<div class="form-group form-style">
                					<label class="drinkcard-cc dth" for="dth" id="dthTab"></label>
                				</div>
                        		<?php echo form_open('recharge/rcgProceed');?>
                        			<div class="form-group" id="layoutPanel"></div>
                        		<?php echo form_close();?>
                        		<!-- <div class="form-group">                        			
                        			<select class="form-control" id="categoryId" onchange="changeCategory()">
                        				<option value="0">Select</option>
	                            		<?php //foreach ($services as $rowSerices) {
	                            			//echo "<option value='".$rowSerices->category_id."'>".$rowSerices->category_name."</option>";
	                            		//};?>
                                    </select>                                    
                                </div>
                                <div class="form-group" id="subCate"></div>
                                <div class="form-group" id="allFields"></div>
                                <div class="form-group" id="submitBtn">
                                	<input type="submit" id="makeRecharge" name="makeRecharge" value="Proceed to Recharge" class="btn btn-success">
                                </div> -->
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
	/*function changeCategory(){
		var cateId = $("#categoryId").val();
		if (cateId > 0) {
			$.ajax({ 
				url: '<?php //echo base_url("recharge/serviceList");?>',
	         	data: {id: cateId},
	         	type: 'POST',
	         	success: function(output) {
	                var html = '<select class="form-control" id="subCategoryId" onchange="changeSubCategory()"><option value="0">Select Operator</option>'+output+'</select>';
	                $("#subCate").html(html);
	            }
			});
		}
		else{
			$("#subCate").html("");
		}
	}*/
	/*function changeSubCategory(){
		var cateId = $("#categoryId").val();
		var subCatId = $("#subCategoryId").val();
		if(subCatId > 0){
			$.ajax({ 
				url: '<?php //echo base_url("recharge/fieldLayout");?>',
	         	data: {id: cateId},
	         	type: 'POST',
	         	success: function(output) {
	                $("#allFields").html(output);
	            }
			});
		}
		else{
			$("#allFields").html("");
		}
	}*/
	$( document ).ready(function() {
		$("#mobTab").on("click", function(){
			rcgPanelLayout('mobile');
		})
		$("#dthTab").on("click", function(){
			rcgPanelLayout('dth');
		})
		$("#layoutPanel").on("click", function(){
			//alert($("input[name=dataCardType]:checked").val());
		})
	})
	function rcgPanelLayout(str){
		$.ajax({ 
			url: '<?php echo base_url("recharge/fieldLayout");?>',
         	data: {id: str},
         	type: 'POST',
         	success: function(output) {
                $("#layoutPanel").html(output);
            }
		});
	}
	/*$(window).ready(function(){
		$("#makeRecharge").prop('disabled', true);
		$("input[name='rechargeAmt']").keyup(function(){
			alert();
			var amtField = $("#rechargeAmt").val();
			alert(amtField);
		})
	})*/
</script>