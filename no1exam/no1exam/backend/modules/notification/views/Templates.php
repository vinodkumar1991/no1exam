<style>
.ck-editor__editable {
    min-height: 250px;
}
</style>
<link rel="stylesheet" href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
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
			<a href="<?php echo Yii::getAlias('@web').'/create-template'; ?>" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-plus" aria-hidden="true"></i>	Add</a>
		</div>
		<table id="notification_tbl" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Notification</th>
					<th>Notification Type</th>
					<th>Template Type</th>
					<th>Template</th>
					<th>Action</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Email</td>
					<td>Promotional</td>
					<td>Password Reset</td>
					<td><a href="" title="View Template" class="btn"><i class="fa fa-eye" aria-hidden="true"></i></a></td>
					<td>
						<a href="#update_notification" class="btn" title="Edit" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<a href="" class="btn" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</td>
					<td>Active</td>
				</tr>
			</tbody>
		</table>
	</div>
</section>
<!-- Edit Notification :: START -->
<div id="update_notification" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Update Notification</h4>
			</div>
			<div class="modal-body">
				<!-- Message :: START -->
				<div class="text-success"></div>
				<!-- Message :: END -->
				<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label col-sm-4">Notification</label>
						<div class="col-sm-6">
							<select class="form-control">
								<option>---- Select ----</option>
								<option>Email</option>
								<option>FCM</option>
								<option>SMS</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Notification Type</label>
						<div class="col-sm-6">
							<select class="form-control">
								<option>---- Select ----</option>
								<option>Promotionals</option>
								<option>Transactional</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Template Types</label>
						<div class="col-sm-6">
							<select class="form-control">
								<option>---- Select ----</option>
								<option>Password Reset</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Template</label>
						<div class="col-sm-8">
							<textarea name="content" id="editor"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-4">Status</label>
						<div class="col-sm-6">
							<select class="form-control">
								<option>---- Select ----</option>
								<option>Active</option>
								<option>In Active</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-center">
							<input type="button" class="btn btn-primary" name="" id="" value="update" />
						</div>
					</div>
					<!-- Button :: END -->
				</form>
			</div>
		</div>

	</div>
</div>
<!-- Edit Notification :: END -->

<!-- DataTables JS -->
<script	src="<?php echo Yii::getAlias('@asset').'/plugins/datatables/js/jquery.dataTables.min.js';?>"></script>
<script	src="<?php echo Yii::getAlias('@asset').'/plugins/datatables/js/dataTables.bootstrap.min.js';?>"></script>
<script type="text/javascript" src="<?php echo Yii::getAlias('@asset').'/plugins/ck-editor/ckeditor.js'; ?>"></script>
<script type="text/javascript">
  $(function () {
    $('#notification_tbl').DataTable();
    //CK Editor Jquery
	ClassicEditor
    .create( document.querySelector( '#editor' ));
  });
 </script>