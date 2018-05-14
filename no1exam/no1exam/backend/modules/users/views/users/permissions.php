<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Permissions List
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
		<table id="permissions" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Permission</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($permissions)) {
    foreach ($permissions as $arrPermission) {
        ?>
        <tr>
					<td><?php echo $arrPermission['name'];?></td>
					<td><?php echo $arrPermission['status'];?></td>
				</tr>
        <?php
    }
    unset($permissions);
}
?>
				
			</tbody>
		</table>
	</div>
</section>

<!-- DataTables JS -->
<script
	src="<?php echo Yii::getAlias('@asset').'/plugins/datatables/js/jquery.dataTables.min.js';?>"></script>
<script
	src="<?php echo Yii::getAlias('@asset').'/plugins/datatables/js/dataTables.bootstrap.min.js';?>"></script>

<script>
  $(function () {
    $('#permissions').DataTable()
  })
</script>