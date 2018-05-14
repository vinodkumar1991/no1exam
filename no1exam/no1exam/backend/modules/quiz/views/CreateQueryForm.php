<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/select2/css/select2.css'; ?>">
<section class="content-header">
	<h1>Create Question</h1>
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
		<div id="question_message"></div>
		<form class="form-horizontal" action="" method="post"
			enctype="multipart/form-data">
			<div class="form-group">
				<div class="col-md-3">
					Question Type <select class="select2" id="question_type"
						name="question_type" onchange="getQuestionType(this.value)">
						<option value="">--Select Question Type--</option>
						<?php
    if (! empty($question_types)) {
        foreach ($question_types as $key => $value) {
            ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php
        }
    }
    ?>
					</select> <span id="err_question_type"></span>
				</div>
				<div class="col-md-3">
					Education Level <select class="select2" name="education_level"
						id="education_level" onchange="getStreams(this.value)">
						<option value="">--Select Education Level--</option>
						<?php
    
    if (! empty($education_levels)) {
        foreach ($education_levels as $key => $value) {
            ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php
        }
    }
    ?>
					</select> <span id="err_education_level"></span>
				</div>
				<div class="col-md-3">
					Stream <select class="select2" id="stream" name="stream"
						onchange="getGroups(this.value)">
						<option value="">--Select Stream--</option>
					</select> <span id="err_stream"></span>
				</div>

				<div class="col-md-3">
					Board <select class="select2" id="board_id" name="board_id"
						onchange="getSubjects()">
						<option value="">--Select Board--</option>
						<?php
    
    if (! empty($boards)) {
        foreach ($boards as $arrBoard) {
            ?>
            <option value="<?php echo $arrBoard['id']; ?>"><?php echo $arrBoard['state_name'].' - '.$arrBoard['name']?></option>
						        <?php
        }
    }
    ?>
					</select> <span id="err_board_id"></span>
				</div>
				<div class="col-md-3">
					Group <select class="select2" id="group" name="group"
						onchange="getSubjects()">
						<option value="">--Select Group--</option>
					</select> <span id="err_group"></span>
				</div>
				<div class="col-md-3">
					Year <select class="select2" id="year" name="year"
						onchange="getSubjects()">
						<option value="">--Select Year--</option>
						<?php
    if (! empty($years)) {
        foreach ($years as $key => $value) {
            ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php
        }
    }
    ?>
					</select> <span id="err_year"></span>
				</div>
				<div class="col-md-3">
					Semester <select class="select2" id="sem" name="sem"
						onchange="getSubjects()">
						<option value="">--Select Semester--</option>
    					<?php
        
        if (! empty($sems)) {
            foreach ($sems as $key => $value) {
                ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php
            }
        }
        ?> 
					</select> <span id="err_sem"></span>
				</div>
				<div class="col-md-3">
					Subject <select class="select2" name="subject_id" id="subject_id">
						<option value="">--Select Subject--</option>
					</select><span id="err_subject_id"></span>
				</div>
				<div class="col-md-3">
					Question Level <select class="select2" id="question_level"
						name="question_level">
						<option value="">--Select Question Level--</option>
				<?php
    
    if ($question_levels) {
        foreach ($question_levels as $key => $value) {
            ?>
            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php
        }
    }
    ?>
					</select><span id="err_question_level"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12">
					Question <input type="text" class="form-control" id="question"
						name="question" placeholder="Enter Question" autocomplete="off" />
				</div>
				<span id="err_question"></span>
			</div>
			<div class="form-group" id="div_file">
				<div class="col-md-12">
					File <input type="file" class="form-control" id="img-preview"
						name="">
					<div class="text-center img-preview">
						<img id="dflt-img" src="#" alt="Your image" width="200" />
					</div>
					<span id="err_img-preview"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					Answer 1<input type="text" placeholder="Enter Answer"
						class="form-control" id="answer_1" name="answer_1" value=""
						autocomplete="off" /> <label class="checkbox-inline"><input
						type="checkbox" value="" id="chk_answer_1" name="chk_answer_1" />Correct
						Answer</label> <span id="err_answer_1"></span>
				</div>
				<div class="col-md-6">
					Answer 2<input type="text" placeholder="Enter Answer"
						class="form-control" id="answer_2" name="answer_2" value=""
						autocomplete="off" /> <label class="checkbox-inline"><input
						type="checkbox" value="" id="chk_answer_2" name="chk_answer_2" />Correct
						Answer</label> <span id="err_answer_2"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-6">
					Answer 3<input type="text" placeholder="Enter Answer"
						class="form-control" id="answer_3" name="answer_3" value=""
						autocomplete="off" /> <label class="checkbox-inline"><input
						type="checkbox" value="" id="chk_answer_3" name="chk_answer_3" />Correct
						Answer</label> <span id="err_answer_3"></span>
				</div>
				<div class="col-md-6">
					Answer 4<input type="text" placeholder="Enter Answer"
						class="form-control" id="answer_4" name="answer_4" value=""
						autocomplete="off" /> <label class="checkbox-inline"><input
						type="checkbox" value="" id="chk_answer_4" name="chk_answer_4" />Correct
						Answer</label> <span id="err_answer_4"></span>
				</div>
			</div>
			<div class="form-group">
				<div class="text-center">
					<input type="hidden" name="status" id="status" value="active" />
					<button type="button" class="btn btn-primary"
						name="create_question" id="create_question"
						onclick="saveQuestion()">Create</button>
				</div>
			</div>
		</form>
	</div>
</section>
<script type="text/javascript"
	src="<?php echo Yii::getAlias('@asset').'/plugins/select2/js/select2.min.js'; ?>"></script>
<script type="text/javascript">
var question_file_name;
toggleFile(1);
	//Select2 jQuery :: START
	$(document).ready(function(){
		$(".select2").select2();
	});
	//Select2 jQuery :: END

	//Image Preview Jquery :: START
	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    reader.onload = function(e) {
	      $('#dflt-img').attr('src', e.target.result);
	    }
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("#img-preview").change(function() {
	  readURL(this);
	});
	//Image Preview Jquery :: END
	
	function toggleFile(sign){
		if(1 == sign){
		$("#div_file").hide();
		}else{
			$("#div_file").show();
			}
		return true;
		}

	function getQuestionType(question_type){
		if('text'!= question_type){
			toggleFile(2);
			}else{
				toggleFile(1);
				//Need to clear file tag value (file data)
				}
		return true;
		}
	

	function getStreams(level){
		var objLevel = {};
		objLevel = {
				category : level};
		$.post('<?php echo Yii::getAlias('@web').'/education/education/get-streams';?>',objLevel,function(response){
			$("#stream").html("");
			$("#stream").html(response);
			});
		return true;
		}

	function getGroups(stream){
		var objStream = {};
		objStream = {
				stream_id : stream};
		$.post('<?php echo Yii::getAlias('@web').'/education/education/get-groups-list';?>',objStream,function(response){
			$("#group").html("");
			$("#group").html(response);
			});
		return true;
		}

	function getSubjects(){
		var objSubject = {};
		if("" != $("#board_id").val() && "" != $("#group").val() && "" != $("#year").val() && "" != $("#sem").val()){
			objSubject = {
					group_id : $("#group").val(),
					board_id : $("#board_id").val(),
					year : $("#year").val(),
					sem : $("#sem").val()
					};
			   $.post('<?php echo Yii::getAlias('@web').'/education/education/get-subjects-list';?>',objSubject,function(response){
		                 $("#subject_id").html("");
		                 $("#subject_id").html(response);		   
				   });
			}
		return true;
		}

	function saveQuestion(){
          var objInputs = {};
          objInputs = {
                question_type : $("#question_type").val(),
                question_level : $("#question_level").val(),
                education_level : $("#education_level").val(),
                stream : $("#stream").val(),
                board_id : $("#board_id").val(),
                group : $("#group").val(),
                year : $("#year").val(),
                sem : $("#sem").val(),
                subject_id : $("#subject_id").val(),
                question : $("#question").val(),
                file_name : '',
                status : $("#status").val(),
                answer_1 : $('#answer_1'). val(),
                answer_2 : $('#answer_2'). val(),
                answer_3 : $('#answer_3'). val(),
                answer_4 : $('#answer_4'). val(),
                is_answer_1 : $('#chk_answer_1'). prop("checked"),
                is_answer_2 : $('#chk_answer_2'). prop("checked"),
                is_answer_3 : $('#chk_answer_3'). prop("checked"),
                is_answer_4 : $('#chk_answer_4'). prop("checked")
                  };
          $.post('<?php echo Yii::getAlias('@web').'/quiz/quiz/save-query';?>',objInputs,function(response){
              makeEmpty();
        	  var response = $.parseJSON(response);
	          if(response.hasOwnProperty('errors')){
	              //Question Type
	        	  if(undefined != response.errors.question_type && response.errors.question_type.length > 0){
	        		   $("#err_question_type").html(response.errors.question_type[0]);
	        		   }
	        	//Question Level
	        	  if(undefined != response.errors.question_level && response.errors.question_level.length > 0){
	        		   $("#err_question_level").html(response.errors.question_level[0]);
	        		   } 
	        	//Subject
	        	  if(undefined != response.errors.subject_id && response.errors.subject_id.length > 0){
	        		   $("#err_subject_id").html(response.errors.subject_id[0]);
	        		   } 
	        	//Question
	        	  if(undefined != response.errors.question && response.errors.question.length > 0){
	        		   $("#err_question").html(response.errors.question[0]);
	        		   }
	        	//Education Level
	        	  if(undefined != response.errors.education_level && response.errors.education_level.length > 0){
	        		   $("#err_education_level").html(response.errors.education_level[0]);
	        		   }
	        	//Stream
	        	  if(undefined != response.errors.stream && response.errors.stream.length > 0){
	        		   $("#err_stream").html(response.errors.stream[0]);
	        		   }
	        	//Board
	        	  if(undefined != response.errors.board_id && response.errors.board_id.length > 0){
	        		   $("#err_board_id").html(response.errors.board_id[0]);
	        		   }
	        	//Group
	        	  if(undefined != response.errors.group && response.errors.group.length > 0){
	        		   $("#err_group").html(response.errors.group[0]);
	        		   }
	        	//Year
	        	  if(undefined != response.errors.year && response.errors.year.length > 0){
	        		   $("#err_year").html(response.errors.year[0]);
	        		   }
	        	//Semester
	        	  if(undefined != response.errors.sem && response.errors.sem.length > 0){
	        		   $("#err_sem").html(response.errors.sem[0]);
	        		   }
	        	//Answer 1
	        	  if(undefined != response.errors.answer_1 && response.errors.answer_1.length > 0){
	        		   $("#err_answer_1").html(response.errors.answer_1[0]);
	        		   }
	        	//Answer 2
	        	  if(undefined != response.errors.answer_2 && response.errors.answer_2.length > 0){
	        		   $("#err_answer_2").html(response.errors.answer_2[0]);
	        		   }
	        	//Answer 3
	        	  if(undefined != response.errors.answer_3 && response.errors.answer_3.length > 0){
	        		   $("#err_answer_3").html(response.errors.answer_3[0]);
	        		   }
	        	//Answer 4
	        	  if(undefined != response.errors.answer_4 && response.errors.answer_4.length > 0){
	        		   $("#err_answer_4").html(response.errors.answer_4[0]);
	        		   }
	   		   return false;
	              }else{
	            	  if('image' == $("#question_type").val()){
	                      uploadFile(response.question_id);
	                      }
	                $("#question_message").html(response.message);
	                makeEmptyFields();
	                return true;         
	                  }
              });
		}

	function makeEmpty(){
		$("#err_question_type").html("");
		$("#err_question_level").html("");
		$("#err_subject_id").html("");
		$("#err_education_level").html("");
		$("#err_stream").html("");
		$("#err_board_id").html("");
		$("#err_group").html("");
		$("#err_year").html("");
		$("#err_sem").html("");
		$("#err_question").html("");
		$("#err_answer_1").html("");
		$("#err_answer_2").html("");
		$("#err_answer_3").html("");
		$("#err_answer_4").html("");
		$("#question_message").html("");
		return true;
		}

	function makeEmptyFields(){
		$("#question_type").select2("val", "");
		$("#question_level").select2("val", "");
		$("#subject_id").select2("val", "");
		$("#education_level").select2("val", "");
		$("#stream").select2("val", "");
		$("#board_id").select2("val", "");
		$("#group").select2("val", "");
		$("#year").select2("val", "");
		$("#sem").select2("val", "");
		$("#question").val("");
		$("#answer_1").val("");
		$("#answer_2").val("");
		$("#answer_3").val("");
		$("#answer_4").val("");
		$('#chk_answer_1').prop('checked', false);
		$('#chk_answer_2').prop('checked', false);
		$('#chk_answer_3').prop('checked', false);
		$('#chk_answer_4').prop('checked', false);
		$('#img-preview').val("");
		$('#dflt-img').attr('src','');
		return true;
		}

	function uploadFile(question_id){
		  var file_data = $('#img-preview').prop('files')[0];
		  var form_data = new FormData();                  
		    form_data.append('file', file_data);
		    form_data.append('question_id', question_id);
		    $.ajax({
		        url: '<?php echo Yii::getAlias('@web').'/quiz/quiz/upload-question-file';?>', 
		        dataType: 'text',
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: form_data,                         
		        type: 'post',
		        success: function(response){
			        var response = $.parseJSON(response);
		        	question_file_name = response.file_name;
		        }
		     });
				     return question_file_name;   
		}
	
</script>