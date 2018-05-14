<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<style type="text/css">
.modal-content .breadcrumb {
	padding: 0;
	margin-bottom: 0;
	list-style: none;
	background-color: inherit;
	border-radius: 0;
}

.panel-heading {
	padding: 4px 15px;
}

.lst-of-subjects-wrapper ul {
	padding-left: 15px;
	padding-right: 15px;
	display: inline-block;
	width: 100%;
}

.lst-of-subjects-wrapper ul li {
	float: left;
	min-height: 20px;
	margin: 5px 0px;
	width: 175px;
}
</style>
<section class="content-header">
	<h1>
		Subjects List
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
			<a href="<?php echo Yii::getAlias('@web').'/create-subject';?>"
				class="btn btn-info btn-sm" data-toggle="modal" target="_blank"><i
				class="fa fa-plus" aria-hidden="true"></i> Add </a>
		</div>
		<table id="subjects" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Level</th>
					<th>Stream</th>
					<th>Group</th>
					<!-- 					<th>Year</th> -->
					<!-- 					<th>Semester</th> -->
					<th>Subjects</th>
					<!-- 					<th>Action</th> -->
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($groups)) {
    foreach ($groups as $arrGroup) {
        ?>
        <tr>
					<td><?php echo $arrGroup['education_level'];?></td>
					<td><?php echo $arrGroup['stream_name'];?></td>
					<td><?php echo $arrGroup['name'];?></td>
					<!-- <td><?php //echo $arrGroup['year'];?></td> -->
					<!-- <td><?php //echo $arrGroup['sem'];?></td> -->
					<td><a href="" data-toggle="modal" data-target="#viwpsubjects"
						class="btn btn-warning"
						onclick="setLevel('<?php echo $arrGroup['education_level'];?>','<?php echo $arrGroup['stream_name'];?>','<?php echo $arrGroup['name'];?>','<?php echo $arrGroup['id'];?>')">Subjects</a>
						<!-- Modal -->
						<div class="modal fade" id="viwpsubjects" role="dialog">
							<div class="modal-dialog modal-lg">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" id="set_level"></h4>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-4">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4>Board / University</h4>
													</div>
													<div class="panel-body">
														<div class="list-group">
														<?php
        
        if (! empty($boards)) {
            foreach ($boards as $arrBoard) {
                ?>
														        <a href="#<?php echo $arrBoard['id']; ?>"
																class="list-group-item"
																id="board_<?php echo $arrBoard['id']; ?>"
																onclick="getSubjects(<?php echo $arrBoard['id']; ?>)"><?php echo $arrBoard['name']; ?></a>
														        <?php
            }
        }
        ?>
															
															
														</div>
													</div>
													<!--/panel-body-->
												</div>
											</div>
											<div class="col-md-8">
												<div class="form-group">
													<label class="control-label col-md-4">Year</label>
													<div class="col-md-6">
														<select name="year" id="year" class="select2"
															onchange="getYearSemSubjects()">
															<!-- 							<option value="">--Select Year--</option> -->
							<?php
        
        if (! empty($years)) {
            foreach ($years as $key => $value) {
                ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php
            }
            // unset($years);
        }
        ?>
						</select>
														<div id="err_year"></div>
													</div>
												</div>
												<div class="form-group">
													<label class="control-label col-md-4">Semster</label>
													<div class="col-md-6">
														<select name="sem" id="sem" class="select2"
															onchange="getYearSemSubjects()">
															<!-- 							<option value="">--Select Semster--</option> -->
							<?php
        
        if (! empty($sems)) {
            foreach ($sems as $key => $value) {
                ?>
							        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
							        <?php
            }
            // unset($sems);
        }
        ?>
						</select>
														<div id="err_sem"></div>
													</div>
												</div>
												<a href="#" onclick="redirectToEditSubjects()"
													style="display: none;" id="edit_tag" name="edit_tag">Edit</a>
												<div id="update_subject_message"></div>
												<div class="panel-heading">
													<h4>Subjects List</h4>
												</div>
												<div class="lst-of-subjects-wrapper">
													<ul class="list-unstyled" id="check_subject_list">
													</ul>
												</div>
											</div>
										</div>
										<div class="modal-footer"></div>
									</div>
								</div>
							</div>
							<!-- END :: Modal --></td>
					<!-- 					<td><a href="#editsubject" class="btn">Edit</a></td> -->
				</tr>
        <?php
    }
    unset($groups);
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
  var h_group_id,s_board_id;
  $(function () {
    $('#subjects').DataTable()
  })
  
  function setLevel(level,stream,group,group_id){
	  $("#set_level").html("");
	  $("#set_level").val("");
	  $("#set_level").html(level+' / '+stream+' / '+group);
	  $("#set_level").val(level+' / '+stream+' / '+group);
	  h_group_id = group_id;
	  getSubjects(1);
	  return true;
	  }

  function getSubjects(board_id){
	  makeEmpty();
	  $("#edit_tag").css("display","none");
	  s_board_id = board_id;
	  $(".list-group-item.active").removeClass("active");
	  $("#board_"+board_id).addClass("list-group-item active");
	  var objInputs = {};
	  objInputs = {
			  level_name : $("#set_level").val(),
			  board_id : board_id,
			  year : $("#year").val(),
			  sem : $("#sem").val(),
			  group_id : h_group_id
			  };
	  $.post('<?php echo Yii::getAlias('@web').'/education/education/get-subjects';?>',objInputs,function(response){
		  var response = $.parseJSON(response);
		 $("#check_subject_list").html("");
		 $("#check_subject_list").html(response.response);
		 if("Subjects are not available" != response.response && response.sign > 0){
		   $("#edit_tag").css("display","block");	  
			 }
		  });
	return true;  	  
  }

  function getYearSemSubjects(){
	  getSubjects(s_board_id);
	  return true;
	  }

  function saveOneMoreSubject(input){
	  var isChecked = 0;
		  if($('#subject_'+input). prop("checked") == true){
			  isChecked = 1;
		  }
		  var objInputs = {};
		  objInputs = {
				  id : input,
				  is_checked : isChecked
				  };
		  $.post('<?php echo Yii::getAlias('@web').'/education/education/update-subject';?>',objInputs,function(response){
		           var response = $.parseJSON(response);
		           $("#update_subject_message").html(response.message);	     
			  });
	  return true;
	  }

  function redirectToEditSubjects(){
	     var query_string = "";
	     query_string = "?board_id="+s_board_id+"&group_id="+h_group_id+"&year="+$("#year").val()+"&sem="+$("#sem").val();
	     var url = "<?php echo Yii::getAlias('@web').'/education/education/edit-subjects'; ?>"+query_string;
	     $(this).attr('target', '_blank');
	     window.location.href=url;	
	     return true;
	  }

  function makeEmpty(){
	  $("#update_subject_message").html("");
      return true;
}
  
</script>