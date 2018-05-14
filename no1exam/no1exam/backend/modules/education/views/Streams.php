<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Streams List
		<!-- <small>it all starts here</small> -->
	</h1>
	<!-- Need To Implement :: START -->
	<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li><a href="#">Examples</a></li>
		<li class="active">Blank page</li>
	</ol>
	<!-- Need To Implement :: END -->
</section>
<section class="content">
	<div class="tab-content">
		<div class="rght-btn">
			<a href="#addstream" class="btn btn-info btn-sm" data-toggle="modal"><i
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
		<table id="streams" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Level</th>
					<th>Stream</th>
					<th>Short Name</th>
					<!-- <th>Stream Duration ( In Years )</th> -->
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($streams)) {
    foreach ($streams as $arrStream) {
        ?>
        <tr>
					<td><?php echo $arrStream['category'];?></td>
					<td><?php echo $arrStream['name'];?></td>
					<td><?php echo $arrStream['short_name'];?></td>
					<!--<td><?php //echo $arrStream['years'];?></td>-->
					<td><?php echo $arrStream['status'];?></td>
					<td><a href="#editstream" class="btn" data-toggle="modal"
						onclick="setStream(<?php echo $arrStream['id']; ?>)">Edit</a></td>
				</tr>
        <?php
    }
    unset($streams);
}
?>
				
			</tbody>
		</table>

		<!-- Modal -->
		<div id="addstream" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Create Stream</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="" method="post">
							<!-- Message :: START -->
							<div id="stream_message" class="text-success"></div>
							<!-- Message :: END -->
							<!-- Education Level :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Education Level</label>
								<div class="col-sm-6">
									<select class="form-control select2" id="category"
										name="category">
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
									<div id="err_category" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Education Level :: END -->
							<!-- Stream :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Stream</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="name" name="name"
										placeholder="Enter Stream Name" />
									<div id="err_name" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Stream :: END -->
							<!-- Stream Short Name:: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Short Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="short_name"
										name="short_name" placeholder="Enter Stream Short Name" />
										<div id="err_short_name" class="text-danger"></div>
										<!-- Status :: START -->
										<input type="hidden" name="status" id="status" value="active" />
										<!-- Status :: END -->
								</div>
								
							</div>
							<!-- Stream Short Name:: END -->
							<!-- Stream Duration :: START -->
<!-- 							<div class="form-group"> -->
<!-- 								<label class="control-label col-sm-2">Stream Duration ( In Years -->
<!-- 									)</label> -->
<!-- 								<div class="col-sm-10"> -->
<!-- 									<input type="text" class="form-control" id="years" name="years" -->
<!-- 										placeholder="Enter Stream Duration" /> -->
									
<!-- 								</div> -->
<!-- 								<div id="err_years"></div> -->
<!-- 							</div> -->
							<!-- Stream Duration :: END -->
							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary" name="create_stream" id="create_stream" value="Create" />
								</div>
							</div>
							<!-- Button :: END -->
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- Modal -->
		<div id="editstream" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Stream</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" action="" method="post">
							<!-- Message :: START -->
							<div id="edit_stream_message" class="text-success"></div>
							<!-- Message :: END -->
							<!-- Education Level :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Education Level</label>
								<div class="col-sm-6">
									<select class="form-control select2" id="edit_category"
										name="edit_category">
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
									<div id="edit_err_category" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Education Level :: END -->
							<!-- Stream :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Stream</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="edit_name"
										name="edit_name" value="" />
									<div id="edit_err_name" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Stream :: END -->
							<!-- Stream Short Name:: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Short Name</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="edit_short_name"
										name="edit_short_name" value="" />
									<div id="edit_err_short_name" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Stream Short Name:: END -->
							<!-- Stream Duration :: START -->
<!-- 							<div class="form-group"> -->
<!-- 								<label class="control-label col-sm-2">Stream Duration ( In Years -->
<!-- 									)</label> -->
<!-- 								<div class="col-sm-10"> -->
<!-- 									<input type="text" class="form-control" id="edit_years" -->
<!-- 										name="edit_years" value="" /> -->
<!-- 								</div> -->
<!-- 								<div id="edit_err_years"></div> -->
<!-- 							</div> -->
							<!-- Stream Duration :: END -->
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
									</select> <input type="hidden" name="edit_stream_id"
										id="edit_stream_id" value="" />
										<div id="edit_err_status" class="text-danger"></div>
								</div>
								
							</div>
							<!-- Status :: END -->
							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary" name="update_stream" id="update_stream" value="Update" />
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
    $('#streams').DataTable()
  })
  
  $("#create_stream").on("click", function(){
	  var objStream = {};
    objStream = {
    	    id : '',
        category : $("#category").val(),
        name : $("#name").val(),
        short_name : $("#short_name").val(),
        years : $("#years").val(),
        status : $("#status").val()
    	    };
    $.post('<?php echo Yii::getAlias('@web'),'/education/education/create-stream';?>',objStream,function(response){
        makeEmpty();
         var response = $.parseJSON(response);
          if(response.hasOwnProperty('errors')){
              //Category
        	  if(undefined != response.errors.category && response.errors.category.length > 0){
        		   $("#err_category").html(response.errors.category);
        		   }
        	//Stream Name
        	  if(undefined != response.errors.name && response.errors.name.length > 0){
        		   $("#err_name").html(response.errors.name);
        		   } 
        	//Stream Short Name
        	  if(undefined != response.errors.short_name && response.errors.short_name.length > 0){
        		   $("#err_short_name").html(response.errors.short_name);
        		   } 
        	//Stream Duration
        	  if(undefined != response.errors.years && response.errors.years.length > 0){
        		   $("#err_years").html(response.errors.years);
        		   }
   		   return false;
              }else{
                  makeFieldsEmpty();
                $("#stream_message").html(response.message);
                setTimeout(function(){location.reload()},3000);
                return true;         
                  }
        });
});

        		  function makeEmpty(){
        			  $("#err_category").empty();
        			  $("#err_name").empty();
        			  $("#err_short_name").empty();
        			  $("#err_years").empty();
        			  $("#message").empty();
        			  return true;
            		  }

        		  function makeFieldsEmpty(){
        			  $("#category").val("");
        			  $("#name").val("");
        			  $("#short_name").val("");
        			  $("#years").val("");
        			  return true;
            		  }

        		  function makeEditEmpty(){
        			  $("#edit_err_category").empty();
        			  $("#edit_err_name").empty();
        			  $("#edit_err_short_name").empty();
        			  $("#edit_err_years").empty();
        			  $("#edit_err_status").empty();
        			  $("#edit_message").empty();
        			  return true;
            		  }

        		  function setStream(stream_id){
        			  makeEditEmpty();
            		  var objStream = {};
            		  objStream = {
                    		  stream_id : stream_id
                    		  };
            		  $.post('<?php echo Yii::getAlias('@web').'/education/education/get-stream'; ?>',objStream,function(response){
            			  var response = $.parseJSON(response);
            			  if(response){
                			  $("#edit_category").val(response.category);
                			  $("#edit_name").val(response.name);
                			  $("#edit_short_name").val(response.short_name);
                			  $("#edit_years").val(response.years);
                			  $("#edit_status").val(response.status);
                			  $("#edit_stream_id").val(response.id);
            			  } 
                		  });
                    		  return true;
        		  }

        		  $("#update_stream").on("click", function(){
        			  var objStream = {};
        		    objStream = {
        		    	    id : $("#edit_stream_id").val(),
        		        category : $("#edit_category").val(),
        		        name : $("#edit_name").val(),
        		        short_name : $("#edit_short_name").val(),
        		        years : $("#edit_years").val(),
        		        status : $("#edit_status").val()
        		    	    };
        		    $.post('<?php echo Yii::getAlias('@web'),'/education/education/create-stream';?>',objStream,function(response){
        		        makeEditEmpty();
        		         var response = $.parseJSON(response);
        		          if(response.hasOwnProperty('errors')){
        		              //Category
        		        	  if(undefined != response.errors.category && response.errors.category.length > 0){
        		        		   $("#edit_err_category").html(response.errors.category);
        		        		   }
        		        	//Stream Name
        		        	  if(undefined != response.errors.name && response.errors.name.length > 0){
        		        		   $("#edit_err_name").html(response.errors.name);
        		        		   } 
        		        	//Stream Short Name
        		        	  if(undefined != response.errors.short_name && response.errors.short_name.length > 0){
        		        		   $("#edit_err_short_name").html(response.errors.short_name);
        		        		   } 
        		        	//Stream Duration
        		        	  if(undefined != response.errors.years && response.errors.years.length > 0){
        		        		   $("#edit_err_years").html(response.errors.years);
        		        		   }
        		        	//Status
        		        	  if(undefined != response.errors.status && response.errors.status.length > 0){
        		        		   $("#edit_err_status").html(response.errors.status);
        		        		   }
        		   		   return false;
        		              }else{
        		                $("#edit_stream_message").html(response.message);
        		                setTimeout(function(){location.reload()},3000);
        		                return true;         
        		                  }
        		        });
        		});
            		   
</script>