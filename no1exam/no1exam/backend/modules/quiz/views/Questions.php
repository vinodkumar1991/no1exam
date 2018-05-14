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
		Questions List
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
			<a href="<?php echo Yii::getAlias('@web').'/create-question';?>"
				class="btn btn-info btn-sm" data-toggle="modal" target="_blank"><i
				class="fa fa-plus" aria-hidden="true"></i> Create Question </a>
		</div>
		<table id="questions" class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>State</th>
					<th>Board</th>
					<th>Level</th>
					<th>Stream</th>
					<th>Group</th>
					<th>Year</th>
					<th>Semester</th>
					<th>Subject</th>
					<th>Question</th>
					<th>Question Type / Level</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($questions)) {
    foreach ($questions as $arrQuestion) {
        ?>
        <tr>
					<td><?php echo $arrQuestion['state_name'];?></td>
					<td><?php echo $arrQuestion['board_category'].'-'.$arrQuestion['board_name'];?></td>
					<td><?php echo $arrQuestion['education_level'];?></td>
					<td><?php echo $arrQuestion['stream_name'];?></td>
					<td><?php echo $arrQuestion['group_name'];?></td>
					<td><?php echo $arrQuestion['year'];?></td>
					<td><?php echo $arrQuestion['sem'];?></td>
					<td><?php echo $arrQuestion['subject_name'];?></td>
					<td><?php echo $arrQuestion['question'];?></td>
					<td><?php echo $arrQuestion['question_type'].' / '.$arrQuestion['question_level'];?></td>
					<td><a href="" data-toggle="modal" data-target="#viewanswers"
						class="btn btn-warning"
						onclick="getAnswers(<?php echo $arrQuestion['id']?>,'<?php echo $arrQuestion['question']?>','<?php echo $arrQuestion['group_name']?>','<?php echo $arrQuestion['year']?>','<?php echo $arrQuestion['sem']?>','<?php echo $arrQuestion['subject_name']?>')">Answers</a>
						<a
						href="<?php echo Yii::getAlias('@web').'/quiz/quiz/edit-question?question_id='.$arrQuestion['id']; ?>"
						target="_blank">Edit</a> <!-- Modal -->
						<div class="modal fade" id="viewanswers" role="dialog">
							<div class="modal-dialog modal-lg">
								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<h4 class="modal-title" id="set_header"></h4>
									</div>
									<div class="modal-body">
										<div class="row">
											<div class="col-md-12">
												<div class="panel panel-default">
													<div class="panel-heading">
														<h4 id="question_tag"></h4>
													</div>
													<div class="panel-body">
														<div class="list-group" id="q-answers"></div>
													</div>
													<!--/panel-body-->
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
    unset($questions);
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
    $('#questions').DataTable()
  })  
  
  function getAnswers(question_id,question,group,year,sem,subject){
	  makeEmpty();
	  $("#question_tag").html(question);
	  $("#set_header").html("Group : "+group+" Year : "+year+" Semester : "+sem+" Subject : "+subject);
	  var objQuestion = {};
	  objQuestion = {
           question_id : question_id
			  };
    $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/get-answers'; ?>',objQuestion,function(response){
        $("#q-answers").html("");
        $("#q-answers").html(response);
        });
	  
	    return true;
	  }

  function makeEmpty(){
	  $("#set_header").html("");
	  $("#question_tag").html("");
	  return true;
	  }
</script>