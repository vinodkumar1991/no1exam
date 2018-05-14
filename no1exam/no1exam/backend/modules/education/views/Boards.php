<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Boards List
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
			<a href="#addboard" class="btn btn-info btn-sm" data-toggle="modal"><i
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
		<table id="boards" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>State</th>
					<th>Board Category</th>
					<th>Board</th>
					<!-- <th>Certificate</th> -->
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($boards)) {
    foreach ($boards as $arrBoard) {
        ?>
        <tr>
					<td><?php echo $arrBoard['state_name'];?></td>
					<td><?php echo $arrBoard['category'];?></td>
					<td><?php echo $arrBoard['name'];?></td>
					<!-- <td><?php //echo $arrBoard['certificate'];?></td> -->
					<td><?php echo $arrBoard['status'];?></td>
					<td><a href="#editboard" class="btn" data-toggle="modal"
						onclick="setBoard(<?php echo $arrBoard['id']; ?>)">Edit</a></td>
				</tr>
        <?php
    }
    unset($boards);
}
?>
				
			</tbody>
		</table>


		<div id="addboard" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create Board</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="" method="post">
							<!-- Message :: START -->
							<div id="board_message" class="text-success"></div>
							<!-- Message :: END -->
							<!-- State :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">State</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="state_name"
										id="state_name">
										<option value="">-- Select State--</option>
										<?php
        if (! empty($states)) {
            foreach ($states as $arrState) {
                ?>
                <option value="<?php echo $arrState['state_name']; ?>"><?php echo $arrState['state_name']; ?></option>
										        <?php
            }
        }
        ?>
									</select>
									<div id="err_state_name" class="text-danger"></div>
								</div>
								
							</div>
							<!-- State :: END -->
							<!-- Category :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Board Category</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="category"
										id="category">
										<option value="">-- Select Board Category--</option>
										<?php
        if (! empty($board_categories)) {
            foreach ($board_categories as $key => $value) {
                ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php
            }
        }
        ?>
									</select>
									<div id="err_category" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Category :: END -->
							<!-- Board Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Board Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="name" name="name"
										placeholder="Enter Board Name" />
										<div id="err_board_name" class="text-danger"></div>
										<input type="hidden" name="status" id="status" value="active" />
								</div>
								
							</div>
							<!-- Board Name :: END -->
							<!-- Certificate :: START -->
							<!-- 							<div class="form-group"> -->
							<!-- 								<label class="control-label col-sm-2">Certificate</label> -->
							<!-- 								<div class="col-sm-10"> -->
							<!-- 									<input type="text" class="form-control" id="certificate" -->
							<!-- 										name="certificate" placeholder="Enter Board Certificate Name" /> -->
							<!-- 								</div> -->
							
							<!-- 								<div id="err_certificate"></div> -->
							<!-- 							</div> -->
							<!-- Certificate :: END -->

							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary" name="create_board" id="create_board" value="Create" />
								</div>
							</div>
							<!-- Button :: END -->
						</form>
					</div>
				</div>

			</div>
		</div>


		<div id="editboard" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Board</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="" method="post">
							<!-- Message :: START -->
							<div id="edit_board_message" class="text-success"></div>
							<!-- Message :: END -->
							<!-- State :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">State</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="edit_state_name"
										id="edit_state_name">
										<option value="">-- Select State--</option>
										<?php
        if (! empty($states)) {
            foreach ($states as $arrState) {
                ?>
                <option value="<?php echo $arrState['state_name']; ?>"><?php echo $arrState['state_name']; ?></option>
										        <?php
            }
            unset($states);
        }
        ?>
									</select>
									<div id="edit_err_state_name" class="text-danger"></div>
								</div>
								
							</div>
							<!-- State :: END -->
							<!-- Category :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Board Category</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="edit_category"
										id="edit_category">
										<option value="">-- Select Board Category--</option>
										<?php
        if (! empty($board_categories)) {
            foreach ($board_categories as $key => $value) {
                ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php
            }
            unset($board_categories);
        }
        ?>
									</select>
									<div id="edit_err_category" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Category :: END -->
							<!-- Board Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Board Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="edit_name"
										name="edit_name" value="" />
										<div id="edit_err_board_name" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Board Name :: END -->
							<!-- Certificate :: START -->
							<!-- 							<div class="form-group"> -->
							<!-- 								<label class="control-label col-sm-2">Certificate</label> -->
							<!-- 								<div class="col-sm-10"> -->
							<!-- 									<input type="text" class="form-control" id="edit_certificate" -->
							<!-- 										name="edit_certificate" value="" /> -->
							<!-- 								</div> -->
							<!-- 								<div id="edit_err_certificate"></div> -->
							<!-- 							</div> -->
							<!-- Certificate :: END -->
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
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php
            }
            unset($statuses);
        }
        ?>
									</select> <input type="hidden" id="edit_board_id"
										name="edit_board_id" value="" />
										<div id="edit_err_status" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Status :: END -->

							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary" name="update_board" id="update_board" value="Update" />
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
    $('#boards').DataTable()
  })
  function getStreams(education_level){
	  var objInputs = {};
	  objInputs = {
			  category : education_level
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/education/education/get-streams'?>',objInputs,function(response){
		  $("#stream_id").html(response);
		  return true;
		  });
	  }

  $("#create_board").on("click", function(){
	  var objInputs = {};
	  objInputs = {
			  id : '',
			  state_name : $("#state_name").val(),
			  category : $("#category").val(),
			  name : $("#name").val(),
			  certificate : $("#certificate").val(),
			  status : $("#status").val()
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/education/education/create-board'?>',objInputs,function(response){
		  makeEmpty();
	         var response = $.parseJSON(response);
	          if(response.hasOwnProperty('errors')){
	              //State
	        	  if(undefined != response.errors.state_name && response.errors.state_name.length > 0){
	        		   $("#err_state_name").html(response.errors.state_name);
	        		   }
	        	//Board Category
	        	  if(undefined != response.errors.category && response.errors.category.length > 0){
	        		   $("#err_category").html(response.errors.category);
	        		   }
	        	//Board Name
	        	  if(undefined != response.errors.name && response.errors.name.length > 0){
	        		   $("#err_board_name").html(response.errors.name);
	        		   } 
	        	//Board Certificate
	        	  if(undefined != response.errors.certificate && response.errors.certificate.length > 0){
	        		   $("#err_certificate").html(response.errors.certificate);
	        		   }
	   		   return false;
	              }else{
	                 makeFieldsEmpty();
	                $("#board_message").html(response.message);
	                setTimeout(function(){location.reload()},3000);
	                return true;         
	                  }
		  });
  });
	         		  function makeEmpty(){
	        			  $("#err_state_name").empty();
	        			  $("#err_category").empty();
	        			  $("#err_board_name").empty();
	        			  $("#err_certificate").empty();
	        			  $("#board_message").empty();
	        			  return true;
	            		  }

	         		 function makeEditEmpty(){
	        			  $("#edit_err_state_name").empty();
	        			  $("#edit_err_category").empty();
	        			  $("#edit_err_board_name").empty();
	        			  $("#edit_err_certificate").empty();
	        			  $("#edit_board_message").empty();
	        			  return true;
	            		  }

	        		  function makeFieldsEmpty(){
	        			  $("#state_name").val("");
	        			  $("#category").val("");
	        			  $("#name").val("");
	        			  $("#certificate").val("");
	        			  return true;
	            		  }
            		  function setBoard(board_id){
            			  makeEditEmpty();
                		  var objBoard = {};
                		  objBoard = {
                        		  board_id : board_id
                        		  };
                		  $.post('<?php echo Yii::getAlias('@web').'/education/education/get-boards'; ?>',objBoard,function(response){
                			  var response = $.parseJSON(response);
                			  if(response){
                    			  $("#edit_state_name").val(response.state_name);
                    			  $("#edit_category").val(response.category);
                    			  $("#edit_name").val(response.name);
                    			  $("#edit_certificate").val(response.certificate);
                    			  $("#edit_status").val(response.status);
                    			  $("#edit_board_id").val(response.id);
                			  } 
                    		  });
                        		  return true;
            		  }
            		  $("#update_board").on("click", function(){
            			  var objInputs = {};
            			  objInputs = {
            					  id : $("#edit_board_id").val(),
            					  state_name : $("#edit_state_name").val(),
            					  category : $("#edit_category").val(),
            					  name : $("#edit_name").val(),
            					  certificate : $("#edit_certificate").val(),
            					  status : $("#edit_status").val()
            					  };
            			  $.post('<?php echo Yii::getAlias('@web').'/education/education/create-board'?>',objInputs,function(response){
            				  makeEditEmpty();
            			         var response = $.parseJSON(response);
            			          if(response.hasOwnProperty('errors')){
            			              //State
            			        	  if(undefined != response.errors.state_name && response.errors.state_name.length > 0){
            			        		   $("#edit_err_state_name").html(response.errors.state_name);
            			        		   }
            			        	//Board Category
            			        	  if(undefined != response.errors.category && response.errors.category.length > 0){
            			        		   $("#edit_err_category").html(response.errors.category);
            			        		   }
            			        	//Board Name
            			        	  if(undefined != response.errors.name && response.errors.name.length > 0){
            			        		   $("#edit_err_board_name").html(response.errors.name);
            			        		   } 
            			        	//Board Certificate
            			        	  if(undefined != response.errors.certificate && response.errors.certificate.length > 0){
            			        		   $("#edit_err_certificate").html(response.errors.certificate);
            			        		   }
            			        	//Status
            			        	  if(undefined != response.errors.status && response.errors.status.length > 0){
            			        		   $("#edit_err_status").html(response.errors.status);
            			        		   }
            			   		   return false;
            			              }else{
            			                $("#edit_board_message").html(response.message);
            			                setTimeout(function(){location.reload()},3000);
            			                return true;         
            			                  }
            				  });       		  
                		  });
</script>