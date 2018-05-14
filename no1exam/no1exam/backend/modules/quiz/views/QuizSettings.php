<link rel="stylesheet" href="<?php echo Yii::getAlias('@asset').'/plugins/select2/css/select2.css'; ?>">

<section class="content-header">
	<h1>Quiz Settings</h1>
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
		<div id="settings_message" class="bg-success"></div>
			<form method="post" class="form-horizontal">
				<div class="form-group">
					<label class="control-label col-md-4">Competitive Types</label>
					<div class="col-md-6">
						<select id="compitative_type_name" name="compitative_type_name" onchange="getMethods(this.value)" class="select2">
							<option value="">--Select Competitive Type--</option>
					   		<?php
							if (! empty($competitive_types)) {
							    foreach ($competitive_types as $arrCompetitiveType) {
							        ?>
							        <option value="<?php echo $arrCompetitiveType['name']; ?>"><?php echo $arrCompetitiveType['name']; ?></option>
								<?php
							    }
					    	unset($competitive_types);
						}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Competitive Methods</label>
					<div class="col-md-6">
						<select id="name" name="name" class="select2" multiple>
							<option value="">--Select Competitive Method--</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Questions Per Round</label>
					<div class="col-md-6">
						<input type="text" name="questions_count" id="questions_count" value="" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Total Levels</label>
					<div class="col-md-6">
						<input type="text" name="total_levels" id="total_levels" value="" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Correct Answer Value</label>
					<div class="col-md-6">
						<input type="text" name="correct_answer_value" id="correct_answer_value" value="" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Negative Answer Value</label>
					<div class="col-md-6">
						<input type="text" name="negative_answer_value" id="negative_answer_value" value="" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Total Players</label>
					<div class="col-md-6">
						<input type="text" name="total_players" id="total_players" value="" class="form-control" />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Total Duration</label>
					<div class="col-md-6">
						<div class="row">
							<div class="col-md-6">
								<select class="select2">
									<option value="0">---- Choose Hour</option>
									<option value="0">01</option>
									<option value="0">02</option>
								</select>
							</div>
							<div class="col-md-6">
								<select class="select2">
									<option value="0">---- Choose Minute</option>
									<option value="0">00</option>
									<option value="0">15</option>
									<option value="0">30</option>
									<option value="0">45</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Skip</label>
					<div class="col-md-6">
						<select id="is_skip" name="is_skip" class="select2">
							<option value="">--Skip A Question--</option>
							<?php
						if ($skip_options) {
						    foreach ($skip_options as $key => $value) {
						        ?>
							        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
							        <?php
						    }
						    unset($skip_options);
						}
						?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Status</label>
					<div class="col-md-6">
						<select id="status" name="status" class="select2">
								<option value="">--Select Status--</option>
							   <?php

							if ($statuses) {
							    foreach ($statuses as $strKey => $strValue) {
							        ?>
							           <option value="<?php echo $strKey; ?>"><?php echo $strKey; ?></option>
							           <?php
							    }
							    unset($statuses);
							}
							?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-12 text-center">
						<input type="button" value="Save Settings" name="save_settings" id="save_settings" onclick="saveSettings()" class="btn btn-primary" />
					</div>
				</div>
			</form>
		</div>
</section>
<script type="text/javascript" src="<?php echo Yii::getAlias('@asset').'/plugins/select2/js/select2.min.js'; ?>"></script>
<script type="text/javascript">
	//Select2 Jquery :: START
	$(document).ready(function(){
		$(".select2").select2();
	});
	//Select2 Jquery :: END
function saveSettings(){
  var objSettings = {};
  objSettings = {
       compitative_type_name : $("#compitative_type_name").val(),
       name : $("#name").val(),
       questions_count : $("#questions_count").val(),
       total_levels : $("#total_levels").val(),
       correct_answer_value : $("#correct_answer_value").val(),
       negative_answer_value : $("#negative_answer_value").val(),
       total_players : $("#total_players").val(),
       total_duration : $("#total_duration").val(),
       is_skip : $("#is_skip").val(),
       status : $("#status").val()              
		  };
   $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/save-settings';?>',objSettings,function(response){
	   makeEmpty();
	         var response = $.parseJSON(response);
	   $("#settings_message").html(response.message);
	   return false;
	   });	
}

function getMethods(compitative_type_name){
    var objCompitativeName = {};
    objCompitativeName = {
    		compitative_type_name : compitative_type_name
    	    };
 $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/get-methods';?>',objCompitativeName,function(response){
	 $("#name").html();
	 $("#name").html(response);
	 });
	 return true;
    
}

function makeEmpty(){
	$("#settings_message").html("");
	return true;
}


</script>

















