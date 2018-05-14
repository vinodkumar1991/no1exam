<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/two-side-multi-select/css/style.css'; ?>" />

<section class="content-header">
	<h1>Roles &amp; Permissions</h1>
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
		<div id="rp_message"></div>
		<div class="row">
			<div class="form-group">
				<div class="text-right">
					<label class="col-md-3 control-label">Role</label>
				</div>
				<div class="col-md-3">
					<select class="form-control" id="role" name="role">
						<option value="">--Select Role--</option>
						<?php
    
    if (! empty($roles)) {
        foreach ($roles as $arrRole) {
            ?>
            <option value="<?php echo $arrRole['name']; ?>"><?php echo $arrRole['name']; ?></option>
						        <?php
        }
        unset($roles);
    }
    ?>
					</select>
				</div>
				<span id="err_role"></span>
			</div>
		</div>
		<div class="row">
			<div class="two-side-select-wrapper">
				<div class="col-xs-5">Rejected
					<select name="from[]" id="undo_redo" class="form-control" size="13"
						multiple="multiple">
						<?php
    
    if (! empty($permissions)) {
        foreach ($permissions as $arrPermission) {
            ?>
						    <option value="<?php echo $arrPermission['name']; ?>"><?php echo $arrPermission['name']; ?></option>
						    <?php
        }
        unset($permissions);
    }
    ?>
					</select>
				</div>
				<div class="col-xs-2">
					<button type="button" id="undo_redo_undo"
						class="btn btn-primary btn-block">undo</button>
					<button type="button" id="undo_redo_rightAll"
						class="btn btn-default btn-block">
						<i class="glyphicon glyphicon-forward"></i>
					</button>
					<button type="button" id="undo_redo_rightSelected"
						class="btn btn-default btn-block">
						<i class="glyphicon glyphicon-chevron-right"></i>
					</button>
					<button type="button" id="undo_redo_leftSelected"
						class="btn btn-default btn-block">
						<i class="glyphicon glyphicon-chevron-left"></i>
					</button>
					<button type="button" id="undo_redo_leftAll"
						class="btn btn-default btn-block">
						<i class="glyphicon glyphicon-backward"></i>
					</button>
					<button type="button" id="undo_redo_redo"
						class="btn btn-warning btn-block">redo</button>
				</div>

				<div class="col-xs-5">Assigned
					<select name="to[]" id="undo_redo_to" class="form-control"
						size="13" multiple="multiple"></select>
				</div>

				<div class="col-xs-12 text-center mrg-top-20">
					<input type="button" name="save_role_permissions"
						id="save_role_permissions" value="Save" class="btn btn-primary"
						onclick="saveRolePermissions()" />
				</div>
				<span id="err_permission"></span>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript"
	src="<?php echo Yii::getAlias('@asset').'/plugins/two-side-multi-select/dist/js/multiselect.min.js'; ?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    // make code pretty
    window.prettyPrint && prettyPrint();

    $('#undo_redo').multiselect();
});

function saveRolePermissions(){
	makeEmpty();
    var objPermissions = {};
    gatherPermissions();
    objPermissions = {
    	    role : $("#role").val(),
    	    permissions : gatherPermissions()
    	    };
    $.post('<?php echo Yii::getAlias('@web').'/users/users/save-role-permissions'; ?>',objPermissions,function(response){
    	var response = $.parseJSON(response);
        if(response.hasOwnProperty('errors')){
      	var arrErrors = response.errors;
      	$.each(arrErrors, function(key, arrValue) {
      	//Role
      	  if(undefined != arrValue.role && arrValue.role.length > 0){
      		   $("#err_role").html(arrValue.role);
      		   }
      	//Permission
      	  if(undefined != arrValue.permission && arrValue.permission.length > 0){
      		   $("#err_permission").html(arrValue.permission);
      		   }
      	});
 		   return false;
            }else{
                makeFieldsEmpty();
            	$("#rp_message").html(response.message);
            	setTimeout(function(){location.reload();},3000);
              return true;         
                }
        });	
}

function gatherPermissions(){
	var arrPermissions = [];
	$('#undo_redo_to option').each(function() {
		arrPermissions.push($(this).val());
	});
	return arrPermissions;
}

function makeEmpty(){
	$("#err_role").empty();
	$("#err_permission").empty();
	$("#rp_message").empty();
	return true;
}

function makeFieldsEmpty(){
    $("#role").val("");
    $("#undo_redo_to option").val("");
	return true;
}

</script>