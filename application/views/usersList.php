<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h1 class="page-header">Users List</h1>
			</div>
		</div>
		<div>

			  <!-- Nav tabs -->
			  <ul class="nav nav-tabs" role="tablist" id="myTabs">
			    <li role="presentation" class="active"><a href="#admin" aria-controls="admin" role="tab" data-toggle="tab">Admin</a></li>
			    <li role="presentation"><a href="#areadealer" aria-controls="areadealer" role="tab" data-toggle="tab">Area Dealer</a></li>
			    <li role="presentation"><a href="#dealer" aria-controls="dealer" role="tab" data-toggle="tab">Dealer</a></li>
			    <li role="presentation"><a href="#retailer" aria-controls="retailer" role="tab" data-toggle="tab">Retailer</a></li>
			  </ul>

			  <!-- Tab panes -->
			  <div class="tab-content">
			    <div role="tabpanel" class="tab-pane active" id="admin">
			    	<!-- displayData(Admin); -->
			    </div>
			    <div role="tabpanel" class="tab-pane" id="areadealer">
			    	
			    </div>
			    <div role="tabpanel" class="tab-pane" id="dealer">
			    	Dealer
			    </div>
			    <div role="tabpanel" class="tab-pane" id="retailer">
			    	Retailer
			    </div>
			  </div>

		</div>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#myTabs a').click(function (e) {
		  e.preventDefault();
		  lowerText = $(this).text().toLowerCase().replace(" ","");
		  displayData(lowerText);
		});
	})
	$(window).ready(function(){
		displayData('admin');
	})
	function displayData(tabName){		
		//$("#"+tabName+"").text(tabName);
		$.ajax({ 
			url: '<?php echo base_url("users/listByType");?>',
         	data: {name: tabName},
         	type: 'POST',
         	success: function(output) {
                $("#"+tabName+"").html(output);
            }
		});
	}
</script>