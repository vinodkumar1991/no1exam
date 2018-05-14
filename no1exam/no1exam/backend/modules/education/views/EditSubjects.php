<link rel="stylesheet"
	href="<?php echo Yii::getAlias('@asset').'/plugins/select2/css/select2.css'; ?>">

<section class="content-header">
	<h1>Create Subjects</h1>
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
		<div id="subject_success_message"></div>
		<form method="post" action="" class="form-horizontal">
			<div id="addSubjectFields">
				<div class="form-group">
					<label class="control-label col-md-4">Board</label>
					<div class="col-md-6">
						<select name="board_id" id="board_id" class="select2">
							<option value="">--Select Multiple Boards--</option>
								<?php
        
        if (! empty($boards)) {
            foreach ($boards as $arrBoard) {
                if (isset($basic['board_id']) && ($basic['board_id'] == $arrBoard['id'])) {
                    ?>
                    <option value="<?php echo $arrBoard['id']; ?>"
								selected><?php echo $arrBoard['name']; ?></option>
                    <?php
                } else {
                    ?>
                    <option value="<?php echo $arrBoard['id']; ?>"><?php echo $arrBoard['name']; ?></option>
                    <?php
                }
            }
            unset($boards);
        }
        ?>
						</select>
						<div id="err_board_id" class="text-danger"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Education Level</label>
					<div class="col-md-6">
						<select name="level" id="level" class="select2"
							onchange="getStreams(this.value,'')">
							<option value="">--Select Education Level--</option>
									<?php
        if (! empty($education_levels)) {
            foreach ($education_levels as $key => $value) {
                if (isset($basic['group_details']['education_level']) && ($basic['group_details']['education_level'] == $key)) {
                    ?>
                    <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                    <?php
                } else {
                    ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php
                }
            }
            unset($education_levels);
        }
        ?>
						</select>
						<div id="err_level"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Stream</label>
					<div class="col-md-6">
						<select name="stream" id="stream" class="select2"
							onchange="getGroups(this.value,'')">
							<option value="">--Select Stream--</option>
							<?php
    
    if (isset($basic['group_details']['stream_id'])) {
        
        ?>
        <option
								value="<?php echo $basic['group_details']['stream_id']; ?>"
								selected><?php $basic['group_details']['stream_name']; ?></option>
        <?php
    }
    ?>
						</select>
						<div id="err_stream"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Group</label>
					<div class="col-md-6">
						<select name="group_id" id="group_id" class="select2">
							<option value="">--Select Group--</option>
						</select>
						<div id="err_group_id"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Year</label>
					<div class="col-md-6">
						<select name="year" id="year" class="select2">
							<option value="">--Select Year--</option>
							<?php
    
    if (! empty($years)) {
        foreach ($years as $key => $value) {
            if (isset($basic['year']) && ($basic['year'] == $key)) {
                ?>
            <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
            <?php
            } else {
                ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php
            }
        }
        unset($years);
    }
    ?>
						</select>
						<div id="err_year"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-4">Semster</label>
					<div class="col-md-6">
						<select name="sem" id="sem" class="select2">
							<option value="">--Select Semster--</option>
							<?php
    
    if (! empty($sems)) {
        foreach ($sems as $key => $value) {
            if (isset($basic['sem']) && ($basic['sem'] == $key)) {
                ?>
                <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                <?php
            } else {
                ?>
                <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php
            }
        }
        unset($sems);
    }
    ?>
						</select>
						<div id="err_sem"></div>
					</div>
				</div>
				<div class="form-group">
				<?php
    
    if (! empty($subject_details)) {
        $intI = 1;
        foreach ($subject_details as $arrSubject) {
            ?>
            <label for="subject" class="control-label col-md-4">Subject</label>
					<div class="col-md-6">
						<input type="text" class="code form-control"
							id="subject<?php echo $intI; ?>" name="subject[]"
							value="<?php echo $arrSubject['name'];?>"
							placeholder="Enter Subject Name" maxlength="75" /> <input
							type="hidden" id="h_subject<?php echo $intI; ?>"
							name="h_subject[]"
							value="<?php echo $arrSubject['subject_id'];?>" /><?php echo '('.$arrSubject['status'].')';?> <span
							id="err_subject<?php echo $intI; ?>"></span>
					</div>
					
            <?php
            $intI ++;
        }
    }
    ?>			
    <div class="col-md-2">
						<a href="javascript:void(0);" class="addSubject btn btn-warning"
							title="Add Multiple Subjects"><i class="fa fa-plus"
							aria-hidden="true"></i></a>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-md-12 text-center">
					<input type="button" name="update_subject" id="update_subject"
						value="Update" class="btn btn-primary" onclick="updateSubject()" />
				</div>
			</div>
		</form>
	</div>
</section>

<script type="text/javascript"
	src="<?php echo Yii::getAlias('@asset').'/plugins/select2/js/select2.min.js'; ?>"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$(".select2").select2();
	});
getStreams('<?php echo $basic['group_details']['education_level']?>','<?php echo $basic['group_details']['stream_id']?>');
getGroups('<?php echo $basic['group_details']['stream_id']?>','<?php echo $basic['group_details']['id']?>');
var max_rows = 10;
var x = <?php echo count($subject_details); ?>;
$(document).ready(function(){
	$(".addSubject").click(function(e){
		e.preventDefault();
        if(x < max_rows){
            x++;
		$("#addSubjectFields").append('<div class="form-group"><label class="control-label col-md-4">&nbsp;</label><div class="col-md-6"><input type="text" class="code form-control" id="subject'+x+'" name="subject[]" value="" placeholder="Enter Subject Name" maxlength="75"/> <span id="err_subject'+x+'"></span></div><div class="col-md-2"><a href="javascript:void(0);" class="removeSubject btn btn-danger" title="Remove Subject"><i class="fa fa-times" aria-hidden="true"></i></a></div>');
        }
	});
    $("#addSubjectFields").on('click','.removeSubject',function(){
        $(this).parent().parent().remove();
    });
});

function getStreams(level,stream_id){
	var objLevel = {
			category : level,
			selected_stream_id : stream_id
			};
	$.post('<?php echo Yii::getAlias('@web').'/education/education/get-streams';?>',objLevel,function(response){
		$('#stream').empty();
		$("#stream").html(response);
		if(stream_id){
			$('#stream').val(stream_id).trigger('change');
			}
		});
		return true;
}

function getGroups(stream_id,group_id){
	var objStream = {
			stream_id : stream_id,
			selected_group_id : group_id
			};
	$.post('<?php echo Yii::getAlias('@web').'/education/education/get-groups-list';?>',objStream,function(response){
        $("#group_id").html("");
		$("#group_id").html(response);
		if(group_id){
			
			$('#group_id').val(group_id).trigger('change');
			}
		});
		return true;
}

function updateSubject(){
	var objSubjects =  gatherSubjects();
	var objSubjIds = gatherSubjectIds();
	var objSubject = {
			   board_id : $("#board_id").val(),
			   level : $("#level").val(),
			   stream : $("#stream").val(),
			   group_id : ("" != $("#group_id").val()) ? $("#group_id").val() :  <?php echo $basic['group_details']['id']?>,
			   year : $("#year").val(),
			   sem : $("#sem").val(),
               subject_names : objSubjects,
               subject_ids : objSubjIds         
			};
	$.post('<?php echo Yii::getAlias('@web').'/education/education/update-subjects';?>',objSubject,function(response){
		makeEmpty();
	         var response = $.parseJSON(response);
	         if(response.hasOwnProperty('errors')){
	           	var errLength = $(".code").length;
	           	var arrErrors = response.errors;
	           	$.each(arrErrors, function(key, arrValue) {
	           	//Board
	           	  if(undefined != arrValue.board_id && arrValue.board_id.length > 0){
	           		   $("#err_board_id").html(arrValue.board_id);
	           		   }
	           	 //Education Level
	           	  if(undefined != arrValue.level && arrValue.level.length > 0){
	           		   $("#err_level").html(arrValue.level);
	           		   }
	           	//Stream
	           	  if(undefined != arrValue.stream && arrValue.stream.length > 0){
	           		   $("#err_stream").html(arrValue.stream);
	           		   }
	           	//Group
	           	  if(undefined != arrValue.group_id && arrValue.group_id.length > 0){
	           		   $("#err_group_id").html(arrValue.group_id);
	           		   }
	           	//Year
	           	  if(undefined != arrValue.year && arrValue.year.length > 0){
	           		   $("#err_year").html(arrValue.year);
	           		   }
	           	//Semster
	           	  if(undefined != arrValue.sem && arrValue.sem.length > 0){
	           		   $("#err_sem").html(arrValue.sem);
	           		   }      	
	           	for(j=1;j<=errLength;j++){
	           	//Subject Name
	           	  if(undefined != arrValue.name && arrValue.name.length > 0){
	           		   $("#err_subject"+key).html(arrValue.name);
	           		   }
	               	}
	           	});
	      		   return false;
	                 }else{
	                   $("#subject_success_message").html(response.message);
	                   setTimeout(function(){window.location='<?php echo Yii::getAlias('@web').'/subjects';?>';},5000);
	                   return true;         
	                     }	
		});



	
};
function makeEmpty(){
   	var z = $(".code").length;
   	$("#subject_success_message").empty();
   	$("#err_board_id").html("");
   	$("#err_level").html("");
   	$("#err_stream").html("");
   	$("#err_group_id").html("");
   	$("#err_year").html("");
   	$("#err_sem").html("");
   	$("#err_subject1").html("");
   	for(i=1;i<=z;i++){
   		$("#err_subject"+i).html("");
   	}
   	return true;
   }

   function makeEmptyFields(){
   	var z = $(".code").length;
   	$("#board_id").select2("val","");
   	$("#level").select2("val","");
   	$("#stream").select2("val","");
   	$("#group_id").select2("val","");
   	$("#year").select2("val","");
   	$("#sem").select2("val","");
   	for(i=1;i<=z;i++){
   		$("#subject"+i).val("");
   	}
   	return true;
   }
function gatherSubjects(){
	var response = [];
	var z = $('.code').length;
		for(i=1;i<=z;i++){
			response.push($("#subject"+i).val());
		}
		return response;
}

function gatherSubjectIds(){
	var response = [];
	var z = $('.code').length;
		for(i=1;i<=z;i++){
			if(undefined != $("#h_subject"+i).val()){
			    response.push($("#h_subject"+i).val());
			}
		}
		return response;
}
</script>