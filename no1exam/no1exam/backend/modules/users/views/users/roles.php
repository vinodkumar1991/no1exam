<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Roles List
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
		<table id="roles" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Role</th>
					<th>Permissions</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($roles)) {
    foreach ($roles as $arrRole) {
        ?>
				        <tr>
					<td><?php echo $arrRole['name'];?></td>
					<td><a href="" data-toggle="modal"
						onclick="getPermissions('<?php echo $arrRole['name']; ?>')"
						data-target="#viwpermissions">View Permissions</a> <!-- Modal -->
						<div class="modal fade" id="viwpermissions" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title">Admin Permissions</h4>
									</div>
									<div class="modal-body">
										<div id="role_permission_message"></div>
										<form class="form-inline">
											<div class="row" id="div_permissions"></div>
										</form>
									</div>
									<!-- 									<div class="modal-footer"> -->
									<!-- 										<a href="">Click to View Last Permissions</a> -->
									<!-- 									</div> -->
								</div>
							</div>
						</div> <!-- END :: Modal --></td>
					<td><?php echo $arrRole['status'];?></td>
				</tr>
				        <?php
    }
    unset($roles);
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
    $('#roles').DataTable()
  })
  
  function getPermissions(role){
	  makeEmpty();
	  var objRole = {};
	  objRole = {
			  'role' : role,
			  'status' : 'active',
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/users/users/get-permissions';?>',objRole,function(response){
		  $("#div_permissions").html("");   
		     $("#div_permissions").html(response);				
		  });
	  return true;
	  }

  function setPermission(permission){
	  makeEmpty();
	      var isChecked = 0;
		  if($('#'+permission). prop("checked") == true){
			  isChecked = 1;
		  }
		  var objInputs = {};
		  objInputs ={
               permission : permission,
               is_checked : isChecked
				  };
		  $.post('<?php echo Yii::getAlias('@web').'/users/users/set-permission';?>',objInputs,function(response){
			  response = $.parseJSON(response);
                   $("#role_permission_message").html(response.message);
			  });     
     			  return true;
  }

  function makeEmpty(){
	  $("#role_permission_message").html();
	  return true;
	  }
</script>