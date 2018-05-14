<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>
		Competitive Methods List
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
		<table id="competitive_methods"
			class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Compitative Type Name</th>
					<th>Compitative Method</th>
					<th>Questions Count</th>
					<th>Total Levels</th>
					<th>Correct Answer Value</th>
					<th>Negavtive Answer Value</th>
					<th>Total Players</th>
					<th>Total Duration</th>
					<th>Skip A Question</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
			<?php

if (! empty($competitive_methods)) {
    foreach ($competitive_methods as $arrCompetitiveMethod) {
        ?>
        <tr>
					<td><?php echo $arrCompetitiveMethod['compitative_type_name'];?></td>
					<td><?php echo $arrCompetitiveMethod['name'];?></td>
					<td><?php echo $arrCompetitiveMethod['questions_count'];?></td>
					<td><?php echo $arrCompetitiveMethod['total_levels'];?></td>
					<td><?php echo $arrCompetitiveMethod['correct_answer_value'];?></td>
					<td><?php echo $arrCompetitiveMethod['negative_answer_value'];?></td>
					<td><?php echo $arrCompetitiveMethod['total_players'];?></td>
					<td><?php echo $arrCompetitiveMethod['total_duration'];?></td>
					<td><?php echo $arrCompetitiveMethod['is_skip'];?></td>
					<td><?php echo $arrCompetitiveMethod['status'];?></td>
					<td><a href="#edit-settings" class="btn" data-toggle="modal"
						onclick="setSettings(<?php echo $arrCompetitiveMethod['id']; ?>)">Edit</a>
					</td>
				</tr>
        <?php
    }
    unset($competitive_methods);
}
?>			
			</tbody>
		</table>

		<div id="edit-settings" class="modal fade" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Edit Settings</h4>
					</div>
					<div class="modal-body">
						<!-- Message :: START -->
						<div id="setting_message" class="text-success"></div>
						<!-- Message :: END -->
						<form class="form-horizontal" action="" method="post">
							<!-- Compitative Type Name :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Compitative Type Name</label>
								<div class="col-sm-6">
									<input type="text" name="compitative_type_name"
										id="compitative_type_name" class="form-control" value=""
										readonly />
								</div>
							</div>
							<!-- Compitative Type Name :: END -->
							<!-- Compitative Method :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Compitative Method</label>
								<div class="col-sm-6">
									<input type="text" name="name" id="name" class="form-control"
										value="" readonly />
								</div>
							</div>
							<!-- Compitative Method :: END -->
							<!-- Questions Count :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Questions Count</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="questions_count"
										name="questions_count" autocomplete="off" maxlength="3" />
									<div id="err_questions_count" class="text-danger"></div>
								</div>
							</div>
							<!-- Questions Count :: END -->
							<!-- Total Levels :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Total Levels</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="total_levels"
										name="total_levels" autocomplete="off" maxlength="3" />
									<div id="err_total_levels" class="text-danger"></div>
								</div>
							</div>
							<!-- Total Levels :: END -->
							<!-- Correct Answer Value :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Correct Answer Value</label>
								<div class="col-sm-6">
									<input type="text" class="form-control"
										id="correct_answer_value" name="correct_answer_value"
										autocomplete="off" maxlength="5" />
									<div id="err_correct_answer" class="text-danger"></div>
								</div>
							</div>
							<!-- Correct Answer Value :: END -->
							<!-- Negative Answer Value :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Negative Answer Value</label>
								<div class="col-sm-6">
									<input type="text" class="form-control"
										id="negative_answer_value" name="negative_answer_value"
										autocomplete="off" maxlength="5" />
									<div id="err_negative_answer" class="text-danger"></div>
								</div>
							</div>
							<!-- Negative Answer Value :: END -->
							<!--Total Players :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Total Players</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="total_players"
										name="total_players" autocomplete="off" maxlength="2" />
									<div id="err_total_players" class="text-danger"></div>
								</div>
							</div>
							<!-- Total Players :: END -->
							<!--Total Duration :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Total Duration</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="total_duration"
										name="total_duration" autocomplete="off" maxlength="5" />
									<div id="err_total_duration" class="text-danger"></div>
								</div>
							</div>
							<!-- Total Duration :: END -->
							<!-- Skip :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Skip A Question</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="is_skip"
										id="is_skip">
										<option value="">-- Skip A Question--</option>
										<?php
        
        if (! empty($skip_options)) {
            foreach ($skip_options as $strKey => $strValue) {
                ?>
                <option value="<?php echo $strKey; ?>"><?php echo $strValue; ?></option>
                <?php
            }
            unset($skip_options);
        }
        ?>
									</select>
									<div id="err_skip" class="text-danger"></div>
								</div>
							</div>
							<!-- Skip :: END -->
							<!-- Status :: START -->
							<div class="form-group">
								<label class="control-label col-sm-4">Status</label>
								<div class="col-sm-6">
									<select class="form-control select2" name="status" id="status">
										<option value="">-- Select Status--</option>
										<?php
        
        if (! empty($statuses)) {
            foreach ($statuses as $strKey => $strValue) {
                ?>
                <option value="<?php echo $strKey; ?>"><?php echo $strValue; ?></option>
                <?php
            }
            unset($statuses);
        }
        ?>
									</select>
									<div id="err_status" class="text-danger"></div>
									<input type="hidden" name="method_id" id="method_id" value="" />
								</div>
							</div>
							<!-- Status :: END -->
							<!-- Button :: START -->
							<div class="form-group">
								<div class="col-sm-12 text-center">
									<input type="button" class="btn btn-primary" name="edit_method"
										id="edit_method" value="Update" onclick="updateSettings()" />
								</div>
							</div>
							<!-- Button :: END -->
						</form>
					</div>
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
    $('#competitive_methods').DataTable()
  })
  function setSettings(method_id){
	  makeEmpty();
     var objMethod = {};
     objMethod = {
    	     method_id : method_id,
    	     sign : 1,
    	     };
     $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/get-methods';?>',objMethod,function(response){
          var response = $.parseJSON(response);
          if(response){
                  $("#compitative_type_name").val(response.compitative_type_name);
                  $("#name").val(response.name);
                  $("#questions_count").val(response.questions_count);
                  $("#total_levels").val(response.total_levels);
                  $("#correct_answer_value").val(response.correct_answer_value);
                  $("#negative_answer_value").val(response.negative_answer_value);
                  $("#total_players").val(response.total_players);
                  $("#total_duration").val(response.total_duration);
                  $("#is_skip").val(response.is_skip);
                  $("#status").val(response.status);
                  $("#method_id").val(response.id);     
              }
         });
     return true;
  }

  function updateSettings(){
	  makeEmpty();
	  var objInputs = {};
	  objInputs = {
			  compitative_type_name : $("#compitative_type_name").val(),
              name : $("#name").val(),
	          questions_count : $("#questions_count").val(),
	          total_levels : $("#total_levels").val(),
              correct_answer_value : $("#correct_answer_value").val(),
              negative_answer_value : $("#negative_answer_value").val(),
              total_players : $("#total_players").val(),
              total_duration : $("#total_duration").val(),
              is_skip : $("#is_skip").val(),
              status : $("#status").val(),
              id :  $("#method_id").val(),
	  };
	  var arrErrors = validate(objInputs);
	  if(arrErrors.length > 0){
		  appendErrors(arrErrors);
		  return false;
		  }else{
	  $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/update-settings';?>',objInputs, function(response){
		  //makeEmpty();
		    var response = $.parseJSON(response);
		    $("#setting_message").html(response.message);
		    setTimeout(function(){location.reload();},3000);   
		  });
		  }	  
	  return true;
	  }

   function makeEmpty(){
	   $("#setting_message").html("");
	   $("#err_questions_count").html("");
	   $("#err_total_levels").html("");
	   $("#err_correct_answer").html("");
	   $("#err_negative_answer").html("");
	   $("#err_total_players").html("");
	   $("#err_total_duration").html("");
	   $("#err_skip").html("");
	   $("#err_status").html("");
	    return true;
   }

   function validate(objInputs){
	   var arrErrors = [];
	   //Questions Count
       var numberValidation = /^[0-9]*$/;
       isValidQuestion = numberValidation.test(objInputs.questions_count);
       if(false == isValidQuestion || objInputs.questions_count.length <= 0){
           arrErrors.push({questions_count : 'Invalid Questions Count'});
           }
       //Total Levels
       isValidLevel = numberValidation.test(objInputs.total_levels);
       if(false == isValidLevel|| objInputs.total_levels.length <= 0){
           arrErrors.push({total_levels : 'Invalid Total Levels'});
           }
       //Correct Answer Value
       var doubleValidation = /^\d*\.?\d*$/;
       isValidCorrect = doubleValidation.test(objInputs.correct_answer_value);
       if(false == isValidCorrect || objInputs.correct_answer_value.length <= 0){
    	   arrErrors.push({correct_answer_value : 'Invalid Correct Answer Value'});
           }
       //Negative Answer Value
       isValidNegative = doubleValidation.test(objInputs.negative_answer_value);
       if(false == isValidCorrect || objInputs.negative_answer_value.length <= 0){
    	   arrErrors.push({negative_answer_value : 'Invalid Negative Answer Value'});
           }
     //Total Duration
       isValidDuration = doubleValidation.test(objInputs.total_duration);
       if(false == isValidDuration || objInputs.total_duration.length <= 0){
           arrErrors.push({total_duration : 'Invalid Total Duration'});
           }
       //Total Players
       isValidPlayer = numberValidation.test(objInputs.total_players);
       if(false == isValidPlayer || objInputs.total_players.length <= 0){
           arrErrors.push({total_players : 'Invalid Total Players'});
           }
       //Skip
       if(!objInputs.is_skip){
    	   arrErrors.push({is_skip : 'Choose Skip A Question'});
           }
       //Status
       if(!objInputs.status){
    	   arrErrors.push({status : 'Status Is Required'});
           }
       return arrErrors;
	}

	function appendErrors(arrErrors){
		$.each(arrErrors, (index, objError) => {
			//Questions Count
			if(undefined != objError.questions_count && objError.questions_count.length > 0){
     		   $("#err_questions_count").html(objError.questions_count);
     		   }
			//Total Levels
			if(undefined != objError.total_levels && objError.total_levels.length > 0){
     		   $("#err_total_levels").html(objError.total_levels);
     		   }
  		   //Correct Answer Value
			if(undefined != objError.correct_answer_value && objError.correct_answer_value.length > 0){
	     		   $("#err_correct_answer").html(objError.correct_answer_value);
	     		   }
			//Negative Answer Value
			if(undefined != objError.negative_answer_value && objError.negative_answer_value.length > 0){
	     		   $("#err_negative_answer").html(objError.negative_answer_value);
	     		   }
  		   //Total Players
			if(undefined != objError.total_players && objError.total_players.length > 0){
	     		   $("#err_total_players").html(objError.total_players);
	     		   }   
  		   //Total Duration
			if(undefined != objError.total_duration && objError.total_duration.length > 0){
	     		   $("#err_total_duration").html(objError.total_duration);
	     		   }
			//Skip
			if(undefined != objError.is_skip && objError.is_skip.length > 0){
	     		   $("#err_skip").html(objError.is_skip);
	     		   }
			//Status
			if(undefined != objError.status && objError.status.length > 0){
	     		   $("#err_status").html(objError.status);
	     		   }
		});
		return true;
		}
</script>