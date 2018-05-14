<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		SenderIds List
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
			<!-- 			<a href="#addboard" class="btn btn-info btn-sm" data-toggle="modal"><i -->
			<!-- 				class="fa fa-plus" aria-hidden="true"></i> Add </a> -->
		</div>
		<table id="sender_ids" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Message Type</th>
					<th>Category Type</th>
					<th>SenderId</th>
					<th>Route</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($sender_ids)) {
    foreach ($sender_ids as $arrSender) {
        ?>
        <tr>
					<td><?php echo $arrSender['message_type'];?></td>
					<td><?php echo $arrSender['category_type'];?></td>
					<td><?php echo $arrSender['subject'];?></td>
					<td><?php echo $arrSender['route'];?></td>
					<td><?php echo $arrSender['status'];?></td>
				</tr>
        <?php
    }
    unset($sender_ids);
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
    $('#sender_ids').DataTable()
  })
</script>