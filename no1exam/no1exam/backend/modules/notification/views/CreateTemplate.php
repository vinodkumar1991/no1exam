<style>
.ck-editor__editable {
    min-height: 400px;
}
</style>
<link rel="stylesheet" href="<?php echo Yii::getAlias('@asset').'/plugins/select2/css/select2.css'; ?>">
<section class="content-header">
	<h1>Create Notification</h1>
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
		<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label col-sm-4">Notification</label>
				<div class="col-sm-4">
					<select class="select2">
						<option>---- Select ----</option>
						<option>Email</option>
						<option>FCM</option>
						<option>SMS</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Notification Type</label>
				<div class="col-sm-4">
					<select class="select2">
						<option>---- Select ----</option>
						<option>Promotionals</option>
						<option>Transactional</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4">Template Types</label>
				<div class="col-sm-4">
					<select class="select2">
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
				<div class="col-sm-4">
					<select class="select2">
						<option>---- Select ----</option>
						<option>Active</option>
						<option>In Active</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12 text-center">
					<input type="button" class="btn btn-primary" name="" id="" value="Create" />
				</div>
			</div>
			<!-- Button :: END -->
		</form>
	</div>
</section>

<script type="text/javascript" src="<?php echo Yii::getAlias('@asset').'/plugins/select2/js/select2.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo Yii::getAlias('@asset').'/plugins/ck-editor/ckeditor.js'; ?>"></script>
<script type="text/javascript">
	//Select2 jQuery :: START
	$(document).ready(function(){
		$(".select2").select2();
	
	//Select2 jQuery :: END

	//CK Editor Jquery
	ClassicEditor
    .create( document.querySelector( '#editor' ));

    });
</script>