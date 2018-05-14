<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Competitive Types List
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
			<a href="#add-competitive-type" class="btn btn-info btn-sm"
				data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i>
				Add </a>
		</div>
		<table id="competitive_types"
			class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Status</th>
					<th>Competitive Methods</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($competitive_types)) {
    foreach ($competitive_types as $arrCompetitiveType) {
        ?>
        <tr>
					<td><?php echo $arrCompetitiveType['name'];?></td>
					<td><?php echo $arrCompetitiveType['status'];?></td>
					<td><a href="" data-toggle="modal"
						onclick="setCompetitiveMethods('<?php echo $arrCompetitiveType['name']; ?>')"
						data-target="#viewmethods">View Methods</a> <!-- Modal -->
						<div class="modal fade" id="viewmethods" role="dialog">
							<div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" id="to_compitative_type"></h4>
										<!-- 										<h4 class="modal-title"id="to_compitative_type">Competitive Methods</h4> -->
									</div>
									<div class="modal-body">
										<div id="method_message"></div>
										<form class="form-inline">
											<div class="row" id="div_compitative_methods"></div>
										</form>
									</div>
								</div>
							</div>
						</div> <!-- END :: Modal --></td>
					<td><a href="#editcompetitivetype" class="btn" data-toggle="modal"
						onclick="setCompetitiveType(<?php echo $arrCompetitiveType['id']; ?>)">Edit</a></td>
				</tr>
        <?php
    }
    unset($competitive_types);
}
?>
				
			</tbody>
		</table>


		<div id="add-competitive-type" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create Competitive Type</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="" method="post">
							<!-- Message :: START -->
							<div id="competitive_success_message" class="text-success"></div>
							<!-- Message :: END -->
							<!-- Board Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Competitive Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="name" name="name"
										placeholder="Enter Competitive Name" maxlength="50"
										autocomplete="off" />
									<div id="err_competitive_name" class="text-danger"></div>
									<input type="hidden" name="status" id="status" value="active" />
								</div>
							</div>
							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary"
										name="create_competitive_name" id="create_competitive_name"
										value="Create" />
								</div>
							</div>
							<!-- Button :: END -->
						</form>
					</div>
				</div>

			</div>
		</div>


		<div id="editcompetitivetype" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Competitive Type</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="" method="post">
							<!-- Message :: START -->
							<div id="edit_competitive_success_message" class="text-success"></div>
							<!-- Message :: END -->
							<!-- Competitive Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Competitive Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="edit_name"
										name="edit_name" value="" maxlength="50" />
									<div id="edit_err_competitive_name" class="text-danger"></div>
								</div>

							</div>
							<!-- Competitive Name :: END -->
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
									</select> <input type="hidden" id="edit_competitive_id"
										name="edit_competitive_id" value="" />
									<div id="edit_err_status" class="text-danger"></div>
								</div>

							</div>
							<!-- Status :: END -->

							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary"
										name="update_competitive_type" id="update_competitive_type"
										value="Update" />
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
    $('#competitive_types').DataTable()
  })
  $("#create_competitive_name").on("click", function(){
	  var objInputs = {};
	  objInputs = {
			  id : '',
			  name : $("#name").val(),
			  status : $("#status").val()
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/save-competitive-type'?>',objInputs,function(response){
		  makeEmpty();
	         var response = $.parseJSON(response);
	          if(response.hasOwnProperty('errors')){
	              //Competitive Name
	        	  if(undefined != response.errors.name && response.errors.name.length > 0){
	        		   $("#err_competitive_name").html(response.errors.name);
	        		   }
	   		   return false;
	              }else{
	                 makeFieldsEmpty();
	                $("#competitive_success_message").html(response.message);
	                setTimeout(function(){location.reload()},3000);
	                return true;         
	                  }
		  });
  });
	         		  function makeEmpty(){
	        			  $("#err_competitive_name").empty();
	        			  $("#competitive_success_message").empty();
	        			  return true;
	            		  }

	         		 function makeEditEmpty(){
	        			  $("#edit_err_competitive_name").empty();
	        			  $("#edit_err_status").empty();
	        			  $("#edit_competitive_success_message").empty();
	        			  return true;
	            		  }

	        		  function makeFieldsEmpty(){
	        			  $("#name").val("");
	        			  return true;
	            		  }
            		  function setCompetitiveType(competitive_id){
            			  makeEditEmpty();
                		  var objCompetitiveType = {};
                		  objCompetitiveType = {
                        		  competitive_id : competitive_id
                        		  };
                		  $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/get-competitive-type'; ?>',objCompetitiveType,function(response){
                			  var response = $.parseJSON(response);
                			  if(response){
                    			  $("#edit_name").val(response.name);
                    			  $("#edit_status").val(response.status);
                    			  $("#edit_competitive_id").val(response.id);
                			  } 
                    		  });
                        		  return true;
            		  }
            		  $("#update_competitive_type").on("click", function(){
            			  var objInputs = {};
            			  objInputs = {
            					  id : $("#edit_competitive_id").val(),
            					  name : $("#edit_name").val(),
            					  status : $("#edit_status").val()
            					  };
            			  $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/save-competitive-type'?>',objInputs,function(response){
            				  makeEditEmpty();
            			         var response = $.parseJSON(response);
            			          if(response.hasOwnProperty('errors')){
            			              //Competitive Name
            			        	  if(undefined != response.errors.name && response.errors.name.length > 0){
            			        		   $("#edit_err_competitive_name").html(response.errors.name);
            			        		   }    			        	
            			        	//Status
            			        	  if(undefined != response.errors.status && response.errors.status.length > 0){
            			        		   $("#edit_err_status").html(response.errors.status);
            			        		   }
            			   		   return false;
            			              }else{
            			                $("#edit_competitive_success_message").html(response.message);
            			                setTimeout(function(){location.reload()},3000);
            			                return true;         
            			                  }
            				  });       		  
                		  });

         		                		  function setCompetitiveMethods(competitive_name){
         		                			 setTitle(competitive_name);
         		                			 makeEmpty();
             		                		  var objCompetitiveInputs = {};
             		                		 objCompetitiveInputs = {
                     		                		 compitative_type_name : competitive_name,
                     		                		status : 'active', 
                     		                		 };

             		                		 $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/get-compitative-methods';?>',objCompetitiveInputs,function(response){
             		                			$("#div_compitative_methods").html("");
                 		                		$("#div_compitative_methods").html(response);
                 		                		 });
                 		                		return true;
             		                		  }

         		                		  function setMethod(method_input){
             		                		  var objMethodInputs = {};
             		                		 var isChecked = 0;
             		              		  if($('#'+method_input). prop("checked") == true){
             		              			  isChecked = 1;
             		              		  }
             		                		  objMethodInputs ={
                                                      compitative_method : $("#"+method_input).val(),
                                                      status : 'active',
                                                      is_checked : isChecked
                     		                		  };
             		                		 $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/save-compitative-methods';?>',objMethodInputs,function(response){
             		          			         var response = $.parseJSON(response);
             		          			      makeEmpty();
                 		                		$("#method_message").html(response.message);
                 		                		setTimeout(function(){location.reload();},5000);
                 		                		 });
                 		                		return true;
             		                		  }
         		                		  function makeEmpty(){
         		                			 $("#method_message").html("");
                                             return true;
         		                			 }

       		                			 function setTitle(competitive_name){
       		                				$("#to_compitative_type").html("");
           		                		  $("#to_compitative_type").html('Competitive Methods/'+competitive_name);
           		                		  return true;
           		                			 }
</script>