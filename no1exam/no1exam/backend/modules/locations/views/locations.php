<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Locations List</h1>
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
			<a href="#addlocation" class="btn btn-info btn-sm"
				data-toggle="modal"><i class="fa fa-plus" aria-hidden="true"></i>
				Add </a>
		</div>
		<table id="locationsdatatable"
			class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Location Type</th>
					<th>Country</th>
					<th>State</th>
					<th>District</th>
					<th>City</th>
					<th>Mondal</th>
					<th>Village</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($locations)) {
    foreach ($locations as $arrLocation) {
        ?>
			        <tr>
					<td><?php echo $arrLocation['category_type']; ?></td>
					<td><?php echo $arrLocation['country_name']; ?></td>
					<td><?php echo $arrLocation['state_name']; ?></td>
					<td><?php echo $arrLocation['district_name']; ?></td>
					<td><?php echo $arrLocation['city_name']; ?></td>
					<td><?php echo $arrLocation['mandal_name']; ?></td>
					<td><?php echo $arrLocation['village_name']; ?></td>
					<td><?php echo $arrLocation['status']; ?></td>
					<td><a href="#edit-location" class="btn" data-toggle="modal"
						onclick="editLocation(<?php echo $arrLocation['id']; ?>)">Edit</a></td>
				</tr>
			        <?php
    }
    unset($locations);
}
?>
			</tbody>
		</table>

		<div id="addlocation" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Upload Locations</h4>
					</div>
					<div class="modal-body">
						<!-- Message :: START -->
						<div id="upload_message" class="text-success"></div>
						<!-- Message :: END -->
						<form class="form-horizontal" action="" method="post"
							enctype="multipart/form-data">
							<!-- Upload :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Upload Location Excel</label>
								<div class="col-sm-6">
									<input type="file" name="location_file" id="location_file"
										class="form-control" value="" />
									<div id="err_location_file" class="text-danger"></div>
								</div>
							</div>
							<!-- Upload :: END -->

							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary"
										name="upload_location_file" id="upload_location_file"
										value="Upload" onclick="uploadFile()" />
								</div>
							</div>
							<!-- Button :: END -->
						</form>
					</div>
				</div>

			</div>
		</div>

		<!-- Location Edit Poup :: START -->
		<div id="edit-location" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Locations</h4>
					</div>
					<?php
    echo $this->render('edit_location');
    ?>		
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

<script type="text/javascript">
  $(function () {
    $('#locationsdatatable').DataTable()
  });

  function uploadFile(){
	  var intError = 0;
	  var file_data = $('#location_file').prop('files')[0];
	    intError = validateFile();
	    if(1 == intError){
		    
	    var form_data = new FormData();                  
	    form_data.append('file', file_data);
	    $.ajax({
	        url: '<?php echo Yii::getAlias('@web').'/locations/locations/upload-locations';?>', 
	        dataType: 'text',
	        cache: false,
	        contentType: false,
	        processData: false,
	        data: form_data,                         
	        type: 'post',
	        success: function(response){
	            makeEmpty();
	            response = $.parseJSON(response);
	            $("#upload_message").html(response.message);
	            setTimeout(function(){location.reload();},5000);
	        }
	     });
	    }
	   	     return true;
	  }

  function makeEmpty(){
	  $("#upload_message").empty();
	  $("#err_location_file").empty();
	  $("#location_file").val("");
	  return true;
	  }

  function editLocation(location_id){
	  
	  }

  function validateFile(){
	  var intError = 0;
	  var strFileName = '';
	  strFileName = $("#location_file").val();
	  if(undefined != strFileName && '' != strFileName){
		  intError = 1;
		  }else{
			  $("#err_location_file").html("File is required");
			  }
	  return intError;
	  }
</script>