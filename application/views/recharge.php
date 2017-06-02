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
                        		<?php echo form_open('recharge/preview');?>
                        			<div class="form-group" id="layoutPanel"></div>
                        		<?php echo form_close();?>
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
		$("#mobTab").on("click", function(){
			rcgPanelLayout('mobile');
		})
		$("#dthTab").on("click", function(){
			rcgPanelLayout('dth');
		})
		$("#layoutPanel").on("click", function(){
			//alert($("input[name=dataCardType]:checked").val());
		})
       /* $("#submitMobBtn").on("click", function(){
            submitForm();
        })*/

        //submit button
	})
    $(window).on("load", function(){
        rcgPanelLayout('mobile');
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
    function submitForm(){
        var mobVal = $("#mobileNo").val();
        var rcgAmt = $("#rechargeAmt").val();
        var rcgType = $(("input[name=dataCardType]:checked")).val();
        var oprVal = $("#rechargeComp").val();
        console.log("mobVal "+mobVal);
        console.log("rcgAmt "+rcgAmt);
        console.log("rcgType "+rcgType);
        console.log("oprVal "+oprVal);

        if(mobVal == " " || mobVal == ""){
            $("#mobileNo").css("border","1px solid red");
        }
        else if(mobVal.length < 10 || mobVal.length > 10){
            $("#mobileNo").css("border","1px solid red");
        }
        else{
            $("#mobileNo").css("border","1px solid #ccc");   
        }
        if(rcgAmt == " " || rcgAmt == ""){
            $("#rechargeAmt").css("border","1px solid red");
        }
        else{
            $("#rechargeAmt").css("border","1px solid #ccc");   
        }
        if(oprVal == 0){
            $("#rechargeComp").css("border","1px solid red");
        }
        else{
            $("#rechargeComp").css("border","1px solid #ccc");   
        }
        return false;
    }
</script>