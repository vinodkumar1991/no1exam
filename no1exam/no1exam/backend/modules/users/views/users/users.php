<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Users List
		<!-- <small>it all starts here</small> -->
	</h1>
	<!-- Need To Implement :: START -->
	<ol class="breadcrumb">
		<li><a href="<?php ?>"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Examples</a></li>
		<li class="active">Blank page</li>
	</ol>
	<!-- Need To Implement :: END -->
</section>
<section class="content">
	<div class="tab-content">
		<div class="rght-btn">
			<a href="#adduser" class="btn btn-info btn-sm" data-toggle="modal"><i
				class="fa fa-plus" aria-hidden="true"></i> Add </a>
		</div>
		<!-- 		<div class="position-form-div"> -->
		<!-- 			<form class="form-inline" action=""> -->
		<!-- 				<div class="form-group"> -->
		<!-- 					<label for="email">Upload:</label> <input type="file" -->
		<!-- 						class="form-control" id="" name=""> -->
		<!-- 				</div> -->
		<!-- 				<button type="submit" class="btn btn-default">Upload</button> -->
		<!-- 			</form> -->
		<!-- 		</div> -->
		<table id="users" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Fullname</th>
					<th>Primary Role</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($users)) {
    foreach ($users as $arrUser) {
        ?>
        <tr>
					<td><?php echo $arrUser['fullname'];?></td>
					<td><?php echo $arrUser['role_name'];?></td>
					<td><?php echo $arrUser['email'];?></td>
					<td><?php echo $arrUser['phone'];?></td>
					<td><?php echo $arrUser['status'];?></td>
					<td><a href="#edituser" class="btn" data-toggle="modal"
						onclick="setUser(<?php echo $arrUser['id']; ?>)">Edit</a></td>
				</tr>
        <?php
    }
    unset($users);
}
?>
				
			</tbody>
		</table>


		<div id="adduser" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create User</h4>
					</div>
					<div class="modal-body">
						<!-- Message :: START -->
						<div id="user_message" class="text-success"></div>
						<!-- Message :: END -->
						<form class="form-horizontal" action="" method="post">
							<!-- Role :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Role</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="role_name"
										id="role_name">
										<option value="">-- Select Role--</option>
										<?php
        if (! empty($roles)) {
            foreach ($roles as $arrRole) {
                ?>
                <option value="<?php echo $arrRole['name']; ?>"><?php echo $arrRole['name']; ?></option>
										        <?php
            }
        }
        ?>
									</select>
									<div id="err_role_name" class="text-danger"></div>
								</div>

							</div>
							<!-- Role :: END -->
							<!-- Country :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Country</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="country_name"
										id="country_name" onchange="getStates(this.value,'')">
										<option value="">-- Select Country--</option>
										<?php
        if (! empty($countries)) {
            foreach ($countries as $arrCountry) {
                ?>
                <option
											value="<?php echo $arrCountry['country_name']; ?>"><?php echo $arrCountry['country_name']; ?></option>
										        <?php
            }
        }
        ?>
									</select>
									<div id="err_country_name" class="text-danger"></div>
								</div>

							</div>
							<!-- Country :: END -->
							<!-- State :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">State</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="state_name"
										id="state_name" onchange="getCities(this.value,'')">
										<option value="">-- Select State--</option>
									</select>
									<div id="err_state_name" class="text-danger"></div>
								</div>

							</div>
							<!-- State :: END -->
							<!-- City :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">City</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="city_name"
										id="city_name">
										<option value="">-- Select City--</option>
									</select>
									<div id="err_city_name" class="text-danger"></div>
								</div>

							</div>
							<!-- City :: END -->
							<!-- Full Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Full Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="fullname"
										name="fullname" placeholder="Enter Full Name"
										autocomplete="off" />
									<div id="err_full_name" class="text-danger"></div>
								</div>
							</div>
							<!-- Full Name :: END -->
							<!-- Email :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Email</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="email" name="email"
										placeholder="Enter Email" autocomplete="off" maxlength="40" />
									<div id="err_email" class="text-danger"></div>
								</div>
							</div>
							<!-- Email :: END -->
							<!-- Phone :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Phone</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="phone" name="phone"
										placeholder="Enter Phone" autocomplete="off" maxlength="10" />
									<input type="hidden" name="status" id="status" value="active" />
									<div id="err_phone" class="text-danger"></div>
								</div>

							</div>
							<!-- Phone :: END -->
							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary" name="create_user"
										id="create_user" value="Create" />
								</div>
							</div>
							<!-- Button :: END -->
						</form>
					</div>
				</div>

			</div>
		</div>

		<div id="edituser" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit User</h4>
					</div>
					<div class="modal-body">
						<!-- Message :: START -->
						<div id="edit_user_message" class="text-success"></div>
						<!-- Message :: END -->
						<form class="form-horizontal" action="" method="post">
							<!-- Role :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Role</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="edit_role_name"
										id="edit_role_name">
										<option value="">-- Select Role--</option>
										<?php
        if (! empty($roles)) {
            foreach ($roles as $arrRole) {
                ?>
                <option value="<?php echo $arrRole['name']; ?>"><?php echo $arrRole['name']; ?></option>
										        <?php
            }
            unset($roles);
        }
        ?>
									</select> <input type="hidden" name="role_permission_id"
										id="role_permission_id" value="" />
									<div id="edit_err_role_name" class="text-danger"></div>
								</div>

							</div>
							<!-- Role :: END -->
							<!-- Country :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Country</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="edit_country_name"
										id="edit_country_name" onchange="getStates(this.value,'')">
										<option value="">-- Select Country--</option>
										<?php
        if (! empty($countries)) {
            foreach ($countries as $arrCountry) {
                ?>
                <option
											value="<?php echo $arrCountry['country_name']; ?>"><?php echo $arrCountry['country_name']; ?></option>
										        <?php
            }
        }
        ?>
									</select> <input type="hidden" name="location_id"
										id="location_id" value="" />
									<div id="edit_err_country_name" class="text-danger"></div>
								</div>

							</div>
							<!-- Country :: END -->
							<!-- State :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">State</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="edit_state_name"
										id="edit_state_name" onchange="getCities(this.value,'')">
										<option value="">-- Select State--</option>
									</select>
									<div id="edit_err_state_name" class="text-danger"></div>
								</div>

							</div>
							<!-- State :: END -->
							<!-- City :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">City</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="edit_city_name"
										id="edit_city_name">
										<option value="">-- Select City--</option>
									</select>
									<div id="edit_err_city_name" class="text-danger"></div>
								</div>

							</div>
							<!-- City :: END -->
							<!-- Full Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Full Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="edit_fullname"
										name="edit_fullname" placeholder="Enter Full Name"
										autocomplete="off" />
									<div id="edit_err_full_name" class="text-danger"></div>
								</div>
							</div>
							<!-- Full Name :: END -->
							<!-- Email :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Email</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="edit_email"
										name="edit_email" placeholder="Enter Email" autocomplete="off"
										maxlength="40" />
									<div id="edit_err_email" class="text-danger"></div>
								</div>
							</div>
							<!-- Email :: END -->
							<!-- Phone :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Phone</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="edit_phone"
										name="edit_phone" placeholder="Enter Phone" autocomplete="off"
										maxlength="10" />
									<div id="edit_err_phone" class="text-danger"></div>
								</div>
							</div>
							<!-- Phone :: END -->
							<!-- Status :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Status</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="edit_status"
										id="edit_status">
										<option value="">-- Select Status--</option>
										<?php
        
        if (! empty($statuses)) {
            foreach ($statuses as $strKey => $strValue) {
                ?>
                <option value="<?php echo $strKey; ?>"><?php echo $strValue; ?></option>
                <?php
            }
            unset($statuses);
        }
        ?>
									</select>
									<div id="edit_err_status" class="text-danger"></div>
									<input type="hidden" name="edit_user_id" id="edit_user_id"
										value="" />
								</div>
							</div>
							<!-- Status :: END -->
							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary" name="edit_user"
										id="edit_user" value="Update" />
								</div>
							</div>
							<!-- Button :: END -->
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
</section>

<!-- DataTables JS -->
<script
	src="<?php echo Yii::getAlias('@asset').'/plugins/datatables/js/jquery.dataTables.min.js';?>"></script>
<script
	src="<?php echo Yii::getAlias('@asset').'/plugins/datatables/js/dataTables.bootstrap.min.js';?>"></script>

<script>
  $(function () {
    $('#users').DataTable()
  })
  function getStates(country_name,state_name){
	  var objInputs = {};
	  objInputs = {
			  category_type : 'state',
			  country_name : country_name,
			  selected_state_name : state_name
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/users/users/get-locations'?>',objInputs,function(response){
		  $("#state_name").html("");
		  $("#edit_state_name").html("");
		  $("#state_name").html(response);
		  $("#edit_state_name").html(response);
		  return true;
		  });
	  }


  function getCities(state_name,city_name){
	  var objInputs = {};
	  objInputs = {
			  category_type : 'city',
			  state_name : state_name,
			  selected_city_name : city_name
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/users/users/get-locations'?>',objInputs,function(response){
		  $("#city_name").html();
		  $("#edit_city_name").html();
		  $("#city_name").html(response);
		  $("#edit_city_name").html(response);
		  return true;
		  });
	  }

  $("#create_user").on("click", function(){
	  var objInputs = {};
	  objInputs = {
			  id : '',
			  role : $("#role_name").val(),
			  country_name : $("#country_name").val(),
			  state_name : $("#state_name").val(),
			  city_name : $("#city_name").val(),
			  fullname : $("#fullname").val(),
			  email : $("#email").val(),
			  phone : $("#phone").val(),
			  status : $("#status").val()
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/users/users/create-user'?>',objInputs,function(response){
		  makeEmpty();
	         var response = $.parseJSON(response);
	          if(response.hasOwnProperty('errors')){
	              //Role
	        	  if(undefined != response.errors.role && response.errors.role.length > 0){
	        		   $("#err_role_name").html(response.errors.role);
	        		   }
	        	//Country Name
	        	  if(undefined != response.errors.country_name && response.errors.country_name.length > 0){
	        		   $("#err_country_name").html(response.errors.country_name);
	        		   }
	        	//Fullname
	        	  if(undefined != response.errors.fullname && response.errors.fullname.length > 0){
	        		   $("#err_full_name").html(response.errors.fullname);
	        		   } 
	        	//Phone
	        	  if(undefined != response.errors.phone && response.errors.phone.length > 0){
	        		   $("#err_phone").html(response.errors.phone);
	        		   }
	        	//Email
	        	  if(undefined != response.errors.email && response.errors.email.length > 0){
	        		   $("#err_email").html(response.errors.email);
	        		   }
	        	//Status
	        	  if(undefined != response.errors.status && response.errors.status.length > 0){
	        		   $("#err_status").html(response.errors.status);
	        		   }
	   		   return false;
	              }else{
	                 makeFieldsEmpty();
	                $("#user_message").html(response.message);
	                setTimeout(function(){location.reload()},3000);
	                return true;         
	                  }
		  });
  });
	         		  function makeEmpty(){
		         		  $("#err_role_name").empty();
	        			  $("#err_country_name").empty();
	        			  $("#err_state_name").empty();
	        			  $("#err_city_name").empty();
	        			  $("#err_full_name").empty();
	        			  $("#err_email").empty();
	        			  $("#err_phone").empty();
	        			  $("#user_message").empty();
	        			  return true;
	            		  }

	         		 function makeEditEmpty(){
	         			$("#edit_err_role_name").empty();
	        			  $("#edit_err_country_name").empty();
	        			  $("#edit_err_state_name").empty();
	        			  $("#edit_err_city_name").empty();
	        			  $("#edit_err_full_name").empty();
	        			  $("#edit_err_email").empty();
	        			  $("#edit_err_phone").empty();
	        			  $("#edit_user_message").empty();
	        			  $("#edit_err_status").empty();
	        			  return true;
	            		  }

	        		  function makeFieldsEmpty(){
	        			  $("#role_name").val(""),
	        			  $("#country_name").val(""),
	        			  $("#state_name").val(""),
	        			  $("#city_name").val(""),
	        			  $("#fullname").val(""),
	        			  $("#email").val(""),
	        			  $("#phone").val(""),
	        			  $("#status").val("")
	        			  return true;
	            		  }
            		  function setUser(user_id){
            			  makeEditEmpty();
                		  var objUser = {};
                		  objUser = {
                        		  user_id : user_id
                        		  };
                		  $.post('<?php echo Yii::getAlias('@web').'/users/users/get-user'; ?>',objUser,function(response){
                			  var response = $.parseJSON(response);
                			  if(response){
                				  getStates(response.country_name,response.state_name);
                				  getCities(response.state_name,response.city_name);
                    			  $("#edit_role_name").val(response.role_name);
                    			  $("#edit_fullname").val(response.fullname);
                    			  $("#edit_email").val(response.email);
                    			  $("#edit_phone").val(response.phone);
                    			  $("#edit_status").val(response.status);
                    			  $("#edit_user_id").val(response.id);
                    			  $("#edit_country_name").val(response.country_name);
                    			  $("#location_id").val(response.location_id);
                    			  $("#role_permission_id").val(response.role_permission_id);
                			  } 
                    		  });
                        		  return true;
            		  }
            		  $("#edit_user").on("click", function(){
            			  var objInputs = {};
            			  objInputs = {
            					  id : $("#edit_user_id").val(),
            					  role : $("#edit_role_name").val(),
            					  country_name : $("#edit_country_name").val(),
            					  state_name : $("#edit_state_name").val(),
            					  city_name : $("#edit_city_name").val(),
            					  fullname : $("#edit_fullname").val(),
            					  email : $("#edit_email").val(),
            					  phone : $("#edit_phone").val(),
            					  status : $("#edit_status").val(),
            					  location_id : $("#location_id").val(),
            					  role_permission_id : $("#role_permission_id").val()
            					  };
            			  $.post('<?php echo Yii::getAlias('@web').'/users/users/create-user'?>',objInputs,function(response){
            				  makeEditEmpty();
            			         var response = $.parseJSON(response);
            			          if(response.hasOwnProperty('errors')){
            			              //Email
            			        	  if(undefined != response.errors.email && response.errors.email.length > 0){
            			        		   $("#edit_err_email").html(response.errors.email);
            			        		   }
            			        	//Phone
            			        	  if(undefined != response.errors.phone && response.errors.phone.length > 0){
            			        		   $("#edit_err_phone").html(response.errors.phone);
            			        		   }
            			        	//Status
            			        	  if(undefined != response.errors.status && response.errors.status.length > 0){
            			        		   $("#edit_err_status").html(response.errors.status);
            			        		   } 
            			        	//Fullname
            			        	  if(undefined != response.errors.fullname && response.errors.fullname.length > 0){
            			        		   $("#edit_err_full_name").html(response.errors.fullname);
            			        		   }
            			        	//Role
            			        	  if(undefined != response.errors.role && response.errors.role.length > 0){
            			        		   $("#edit_err_role_name").html(response.errors.role);
            			        		   }
            			        	//Country
            			        	  if(undefined != response.errors.country_name && response.errors.country_name.length > 0){
            			        		   $("#edit_err_country_name").html(response.errors.country_name);
            			        		   }
            			        	//State
            			        	  if(undefined != response.errors.state_name && response.errors.state_name.length > 0){
            			        		   $("#edit_err_state_name").html(response.errors.state_name);
            			        		   }
            			        	//City
            			        	  if(undefined != response.errors.city_name && response.errors.city_name.length > 0){
            			        		   $("#edit_err_city_name").html(response.errors.city_name);
            			        		   }
            			   		   return false;
            			              }else{
            			                $("#edit_user_message").html(response.message);
            			                setTimeout(function(){location.reload()},3000);
            			                return true;         
            			                  }
            				  });       		  
                		  });
</script>