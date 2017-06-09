<div id="wrapper">
	<?php require 'sidenav.php';?>

	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">			
				<h1 class="page-header">Add User</h1>
			</div>
		</div>
		<div id="msg" class="bg-info padd20 text-center"></div>
		<form role="form">
		<div class="row">
            <div class="col-lg-12">
            	<div class="col-lg-4 form-group">
                    <label>Select User</label>
                    <select class="form-control" id="userType" onchange="getSelectedList(this.value)" name="userType">
                    	<option value="" class="form-control">Select</option>
                        <?php
                        	foreach ($userType as $rowType) {
                        		echo "<option class='form-control' value='".$rowType->users_group_id."'>".$rowType->users_group_name."</option>";
                        	}
                        ?>
                    </select>
                </div>
            	<div class="col-lg-4 form-group" id="mapWithUser"></div>
            </div>
        </div>
        <div class="row">
        	<div class="col-lg-12">
        		<div class="col-lg-4 form-group">
            		<label>Enter Name</label>
            		<input type="text" name="name" id="name" placeholder="Enter name" class="form-control">
            	</div>
            	<div class="col-lg-4 form-group">
            		<label>Enter Email</label>
            		<input type="text" name="email" id="email" placeholder="Enter email" class="form-control">
            	</div>
	        	<div class="col-lg-4 form-group">
	        		<label>Enter Password</label>
	        		<input type="password" name="pwd" id="pwd" placeholder="Enter password" class="form-control">
	        	</div>
	        </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
            	<div class="form-group col-lg-offset-5">
            		<button id="createUser" class="btn btn-success">Add User</button>
            	</div>
            </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="<?php echo $this->config->item('base_url');?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#createUser").on("click", function(e){
			e.preventDefault();
			var userType = $("#userType option:selected").val();
			var superVisor = $("#mapUser option:selected").val();
			var name = $("#name").val();
			var email = $("#email").val();
			var pwd = $("#pwd").val();
			$.ajax({ 
				url: '<?php echo base_url("users/addUserRecord");?>',
	         	data: {userType: userType, superVisor: superVisor, name: name, email: email, pwd: pwd},
	         	type: 'POST',
	         	success: function(output) {
	         		//alert(output);
	                $("#msg").html(output);
	                $("#userType").val("");
	                $("#name").val("");
	                $("#email").val("");
	                $("#pwd").val("");
	            }
			});
		})
	})
	function getSelectedList(str){
		if(str == "" || str ==" " || str == "2"){
			$("#mapWithUser").html("");
		}
		else{
			$.ajax({ 
				url: '<?php echo base_url("users/getUserForMap");?>',
	         	data: {id: str},
	         	type: 'POST',
	         	success: function(output) {
	         		//alert(output);
	                $("#mapWithUser").html(output);
	            }
			});
		}
	}
</script>