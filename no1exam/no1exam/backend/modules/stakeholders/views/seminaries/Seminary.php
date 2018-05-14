<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Seminaries List
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
			<a href="#addlocation" class="btn btn-info btn-sm"
				data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i>
				Add </a>
		</div>
		<div class="position-form-div">
			<form class="form-inline" action="">
				<div class="form-group">
					<label for="email">Upload:</label> <input type="file"
						class="form-control" id="" name="">
				</div>
				<button type="submit" class="btn btn-default">Upload</button>
			</form>
		</div>
		<table id="streams" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Seminary Name</th>
					<th>Seminary Type</th>
					<th>Board</th>
					<th>Address</th>
					<th>Education Type</th>
					<th>Delivery Type</th>
					<th>Contact Details</th>
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
					<td><?php echo $arrStream['years'];?></td>
					<td><?php echo $arrStream['status'];?></td>
					<td><a href="" class="btn">Edit</a></td>
				</tr>
        <?php
    }
    unset($streams);
}
?>
				
			</tbody>
		</table>

		<!-- Modal -->
		<div id="addlocation" class="modal fade" role="dialog">
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
							<div id="stream_message"></div>
							<!-- Message :: END -->
							<!-- Education Level :: START -->
							<div class="form-group">
								<label class="control-label col-sm-2">Education Level</label>
								<div class="col-sm-10">
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
            unset($levels);
        }
        ?>
									</select>
								</div>
								<div id="err_category"></div>
							</div>
							<!-- Education Level :: END -->
							<!-- Stream :: START -->
							<div class="form-group">
								<label class="control-label col-sm-2">Stream</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="name" name="name"
										placeholder="Enter Stream Name" />
								</div>
								<div id="err_name"></div>
							</div>
							<!-- Stream :: END -->
							<!-- Stream Short Name:: START -->
							<div class="form-group">
								<label class="control-label col-sm-2">Short Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="short_name"
										name="short_name" placeholder="Enter Stream Short Name" />
								</div>
								<div id="err_short_name"></div>
							</div>
							<!-- Stream Short Name:: END -->
							<!-- Stream Duration :: START -->
							<div class="form-group">
								<label class="control-label col-sm-2">Stream Duration ( In Years
									)</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="years" name="years"
										placeholder="Enter Stream Duration" />
									<!-- Status :: START -->
									<input type="hidden" name="status" id="status" value="active" />
									<!-- Status :: END -->
								</div>
								<div id="err_years"></div>
							</div>
							<!-- Stream Duration :: END -->
							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<input type="button" class="btn btn-default"
										name="create_stream" id="create_stream" value="Create" />
								</div>
							</div>
							<!-- Button :: END -->
						</form>
					</div>
					<!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div> -->
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


            		   
</script>