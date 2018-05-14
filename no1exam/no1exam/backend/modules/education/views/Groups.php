<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Groups List
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
			<a href="#addgroup" class="btn btn-info btn-sm" data-toggle="modal"><i
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
		<table id="groups" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Stream</th>
					<th>Group Name</th>
					<th>Short Name</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($groups)) {
    foreach ($groups as $arrGroup) {
        ?>
        <tr>
					<td><?php echo $arrGroup['stream_name'];?></td>
					<td><?php echo $arrGroup['name'];?></td>
					<td><?php echo $arrGroup['short_name'];?></td>
					<td><?php echo $arrGroup['status'];?></td>
					<td><a href="#editgroup" class="btn" data-toggle="modal"
						onclick="setGroup('<?php echo $arrGroup['id']; ?>','<?php echo $arrGroup['education_level']; ?>')">Edit</a></td>
				</tr>
        <?php
    }
    unset($groups);
}
?>
				
			</tbody>
		</table>

		<!-- Modal -->
		<div id="addgroup" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create Group</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="" method="post">
							<!-- Message :: START -->
							<div id="group_message" class="text-success"></div>
							<!-- Message :: END -->
							<!-- Education Level :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Education Level</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="education_level"
										id="education_level" onChange="getStreams(this.value,'')">
										<option value="">-- Select Education Level--</option>
										<?php
        if (! empty($levels)) {
            foreach ($levels as $key => $value) {
                ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
										        <?php
            }
        }
        ?>
									</select>
									<div id="err_group_education_level" class="text-danger"></div>
								</div>

							</div>
							<!-- Education Level :: END -->
							<!-- Stream :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Stream</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="stream_id"
										id="stream_id">
										<option value="">--Select Stream--</option>
									</select>
									<div id="err_group_stream" class="text-danger"></div>
								</div>

							</div>
							<!-- Stream :: END -->
							<!-- Group Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Group Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="name" name="name"
										placeholder="Enter Group Name" autocomplete="off" />
									<div id="err_group_name" class="text-danger"></div>
								</div>

							</div>
							<!-- Group Name :: END -->
							<!-- Group Short Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Group Short Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="short_name"
										name="short_name" placeholder="Enter Group Short Name"
										autocomplete="off" maxlength="7" /> <input type="hidden"
										name="status" id="status" value="active" />
									<div id="err_group_short_name" class="text-danger"></div>
								</div>

							</div>
							<!-- Group Short Name :: END -->

							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary"
										name="create_group" id="create_group" value="Create" />
								</div>
							</div>
							<!-- Button :: END -->
						</form>
					</div>
				</div>

			</div>
		</div>


		<div id="editgroup" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Group</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="" method="post">
							<!-- Message :: START -->
							<div id="edit_group_message" class="text-success"></div>
							<!-- Message :: END -->
							<!-- Education Level :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Education Level</label>
								<div class="col-sm-6">
									<select class="form-control select2"
										name="edit_education_level" id="edit_education_level"
										onChange="getStreams(this.value,'')">
										<option value="">-- Select Education Level--</option>
										<?php
        if (! empty($levels)) {
            foreach ($levels as $key => $value) {
                ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
										        <?php
            }
            unset($levels);
        }
        ?>
									</select>
									<div id="edit_err_group_education_level" class="text-danger"></div>
								</div>

							</div>
							<!-- Education Level :: END -->
							<!-- Stream :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Stream</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="edit_stream_id"
										id="edit_stream_id">
									</select>
								</div>
								<div id="edit_err_group_stream" class="text-danger"></div>
							</div>
							<!-- Stream :: END -->
							<!-- Group Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Group Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="edit_name"
										name="edit_name" value="" />
									<div id="edit_err_group_name" class="text-danger"></div>
								</div>

							</div>
							<!-- Group Name :: END -->
							<!-- Group Short Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Group Short Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="edit_short_name"
										name="edit_short_name" value="" maxlength="7" />
									<div id="edit_err_group_short_name" class="text-danger"></div>
								</div>

							</div>
							<!-- Group Short Name :: END -->

							<!-- Status :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Status</label>
								<div class="col-sm-6">
									<select class="form-control" id="edit_status"
										name="edit_status">
										<option value="">--Select Status--</option>
									<?php
        
        if (! empty($statuses)) {
            foreach ($statuses as $key => $value) {
                ?>
									    <option value="<?php echo $key; ?>"><?php echo $value;?></option>
									    <?php
            }
            unset($statuses);
        }
        ?>
									</select> <input type="hidden" name="edit_group_id"
										id="edit_group_id" value="" />
									<div id="edit_err_status" class="text-danger"></div>
								</div>

							</div>
							<!-- Status :: END -->

							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary"
										name="update_group" id="update_group" value="Update" />
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
    $('#groups').DataTable()
  })
  function getStreams(education_level,selected_stream_id){
	  var objInputs = {};
	  objInputs = {
			  category : education_level,
			  selected_stream_id : selected_stream_id
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/education/education/get-streams'?>',objInputs,function(response){
		  $("#stream_id").html();
		  $("#edit_stream_id").html();
		  $("#stream_id").html(response);
		  $("#edit_stream_id").html(response);
		  return true;
		  });
	  }

  $("#create_group").on("click", function(){
	  var objInputs = {};
	  objInputs = {
			  education_level : $("#education_level").val(),
			  stream_id : $("#stream_id").val(),
			  name : $("#name").val(),
			  short_name : $("#short_name").val(),
			  status : $("#status").val()
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/education/education/create-group'?>',objInputs,function(response){
		  makeEmpty();
	         var response = $.parseJSON(response);
	          if(response.hasOwnProperty('errors')){
	              //Education Level
	        	  if(undefined != response.errors.education_level && response.errors.education_level.length > 0){
	        		   $("#err_group_education_level").html(response.errors.education_level);
	        		   }
	        	//Stream
	        	  if(undefined != response.errors.stream_id && response.errors.stream_id.length > 0){
	        		   $("#err_group_stream").html(response.errors.stream_id);
	        		   }
	        	//Group Name
	        	  if(undefined != response.errors.name && response.errors.name.length > 0){
	        		   $("#err_group_name").html(response.errors.name);
	        		   } 
	        	//Group Short Name
	        	  if(undefined != response.errors.short_name && response.errors.short_name.length > 0){
	        		   $("#err_group_short_name").html(response.errors.short_name);
	        		   }
	   		   return false;
	              }else{
	                 makeFieldsEmpty();
	                $("#group_message").html(response.message);
	                setTimeout(function(){location.reload()},3000);
	                return true;         
	                  }
		  });
  });
	         		  function makeEmpty(){
	        			  $("#err_group_education_level").empty();
	        			  $("#err_group_stream").empty();
	        			  $("#err_group_name").empty();
	        			  $("#err_group_short_name").empty();
	        			  $("#group_message").empty();
	        			  return true;
	            		  }

	        		  function makeFieldsEmpty(){
	        			  $("#education_level").val("");
	        			  $("#stream_id").val("");
	        			  $("#name").val("");
	        			  $("#short_name").val("");
	        			  return true;
	            		  }

	        		  function makeEditEmpty(){
	        			  $("#edit_err_group_education_level").empty();
	        			  $("#edit_err_group_stream").empty();
	        			  $("#edit_err_group_name").empty();
	        			  $("#edit_err_group_short_name").empty();
	        			  $("#edit_err_status").empty();
	        			  $("#edit_group_message").empty();
	        			  return true;
	            		  }

	        		  function setGroup(group_id,education_level){
            			  makeEditEmpty();
                		  var objGroup = {};
                		  objGroup = {
                        		  group_id : group_id
                        		  };
                		  $.post('<?php echo Yii::getAlias('@web').'/education/education/get-groups'; ?>',objGroup,function(response){
                			  var response = $.parseJSON(response);
                			  if(response){
                				  getStreams(education_level,response.stream_id);
                				  //$("#edit_stream_id").val(response.stream_id);
                    			  $("#edit_education_level").val(response.education_level);
                    			  $("#edit_name").val(response.name);
                    			  $("#edit_short_name").val(response.short_name);
                    			  $("#edit_status").val(response.status);
                    			  $("#edit_group_id").val(response.id);
                			  }
                    		  });
                        		  return true;
            		  }
            		  
	        		  $("#update_group").on("click", function(){
	        			  var objInputs = {};
	        			  objInputs = {
	        					  education_level : $("#edit_education_level").val(),
	        					  stream_id : $("#edit_stream_id").val(),
	        					  name : $("#edit_name").val(),
	        					  short_name : $("#edit_short_name").val(),
	        					  status : $("#edit_status").val(),
	        					  id : $("#edit_group_id").val()
	        					  };
    					  console.log(objInputs);
	        			  $.post('<?php echo Yii::getAlias('@web').'/education/education/create-group'?>',objInputs,function(response){
	        				  makeEditEmpty();
	        			         var response = $.parseJSON(response);
	        			          if(response.hasOwnProperty('errors')){
	        			              //Education Level
	        			        	  if(undefined != response.errors.education_level && response.errors.education_level.length > 0){
	        			        		   $("#edit_err_group_education_level").html(response.errors.education_level);
	        			        		   }
	        			        	//Stream
	        			        	  if(undefined != response.errors.stream_id && response.errors.stream_id.length > 0){
	        			        		   $("#edit_err_group_stream").html(response.errors.stream_id);
	        			        		   }
	        			        	//Group Name
	        			        	  if(undefined != response.errors.name && response.errors.name.length > 0){
	        			        		   $("#edit_err_group_name").html(response.errors.name);
	        			        		   } 
	        			        	//Group Short Name
	        			        	  if(undefined != response.errors.short_name && response.errors.short_name.length > 0){
	        			        		   $("#edit_err_group_short_name").html(response.errors.short_name);
	        			        		   }
	        			        	//Status
	        			        	  if(undefined != response.errors.status && response.errors.status.length > 0){
	        			        		   $("#edit_err_status").html(response.errors.status);
	        			        		   }
	        			   		   return false;
	        			              }else{
	        			                $("#edit_group_message").html(response.message);
	        			                setTimeout(function(){location.reload()},3000);
	        			                return true;         
	        			                  }
});
	        		  });
</script>