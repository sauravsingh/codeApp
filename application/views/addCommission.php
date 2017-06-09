<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-10">			
				<h1 class="page-header">Add Commission</h1>
			</div>
            <?php echo $this->main->goBack();?>
		</div>
		<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                        	<div class="col-lg-12">
                                
                                <div class="col-lg-6">
                                    <div class="col-lg-6">
                                        <input type="text" id="id" name="id" class="form-control" placeholder="Search by id" />
                                        <p class="errMsg"></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <button id="search" class="btn btn-primary">Look up</button>
                                    </div>
                                </div>
                                
                        	</div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="msg"></div>
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
		$("#search").on("click", function(e){
            e.preventDefault();
            var id = $("#id").val();
            if(id == "" || id == "0" || id ==" "){
                $(".errMsg").html("Invalid entry");
            }
            else{
                $.ajax({ 
                    url: '<?php echo base_url("configuration/setCommission");?>',
                    data: {id: id},
                    type: 'POST',
                    dataType: 'JSON',
                    success: function(callback, status) {
                        $(".msg").html(callback);
                    }
                });
            }            
        })
	})
</script>