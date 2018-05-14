<link rel="stylesheet" href="<?php echo Yii::getAlias('@asset').'/plugins/datatables/css/dataTables.bootstrap.min.css'; ?>">
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
		<div class="rght-btn">
			<a href="<?php echo Yii::getAlias('@web').'/CreateQueryList';?>" class="btn btn-info btn-sm"><i
				class="fa fa-plus" aria-hidden="true"></i> Add </a>
		</div>
		<table id="subjects" class="table table-bordered table-striped">
	      <thead>
	        <tr>
	          <th>S.No.</th>
	          <th>Question Type</th>
	          <th>Education</th>
	          <th>Subject Name</th>
	          <th>Question Level</th>
	          <th>Question</th>
	          <th>View Answers</th>
	          <th>Actions</th>
	        </tr>
	      </thead>
	      <tbody>
	        <tr>
	          <td>1</td>
	          <td>Text</td>
	          <td>MBA</td>
	          <td>Computer</td>
	          <td>Medium</td>
	          <td>What is VB Script</td>
	          <td>
	            <a href="" data-toggle="modal" data-target="#viewanswer" class="btn btn-warning">View</a>
	          </td>
	          <td>
	            <a href="" class="btn btn-info">Edit</a>
	            <a href="" class="btn btn-info">Delete</a>
	          </td>
	        </tr>
	        <tr>
	          <td>1</td>
	          <td>Image</td>
	          <td>MBA</td>
	          <td>Computer</td>
	          <td>Medium</td>
	          <td><a href="" data-toggle="modal" data-target="#viewimgq"><img src="<?php echo Yii::getAlias('@asset').'/dist/img/img-dflt-icon.png'; ?>" width="24" /></a></td>
	          <td>
	            <a href="" data-toggle="modal" data-target="#viewanswer" class="btn btn-warning">View</a>
	          </td>
	          <td>
	            <a href="" class="btn btn-info">Edit</a>
	            <a href="" class="btn btn-info">Delete</a>
	          </td>
	        </tr>
	      </tbody>
	    </table>
	    <!-- Modal View Answers :: START-->
	        <div class="modal fade" id="viewanswer" role="dialog">
	          <div class="modal-dialog modal-lg">
	            <!-- Modal content-->
	            <div class="modal-content">
	              <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	                <h4 class="modal-title">View Answers</h4>
	              </div>
	              <div class="modal-body">
	                <div class="form-horizontal">
	                  <h5 class="bold"><strong>What is VB Script?</strong></h5>
	                    <div class="form-group">
	                      <div class="col-md-6">
	                        <label class="checkbox-inline"><input type="checkbox" value="" checked>Answers 1</label>
	                      </div>
	                      <div class="col-md-6">
	                        <label class="checkbox-inline"><input type="checkbox" value="">Answers 2</label>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <div class="col-md-6">
	                        <label class="checkbox-inline"><input type="checkbox" value="">Answers 3</label>
	                      </div>
	                      <div class="col-md-6">
	                        <label class="checkbox-inline"><input type="checkbox" value="">Answers 3</label>
	                      </div>
	                    </div>
	                    <div class="form-group">
	                      <div class="col-md-6">
	                        <label class="checkbox-inline"><input type="checkbox" value="">True</label>
	                      </div>
	                      <div class="col-md-6">
	                        <label class="checkbox-inline"><input type="checkbox" value="">False</label>
	                      </div>
	                    </div>
	                </div>
	              <!-- <div class="modal-footer"></div> -->
	            </div>                    
	          </div>
	          </div>
	      </div>
	      <!-- Modal View Answers :: END-->

	      <!-- Modal View Answers :: START-->
	        <div class="modal fade" id="viewimgq" role="dialog">
	          <div class="modal-dialog modal-lg">
	            <!-- Modal content-->
	            <div class="modal-content">
	              <div class="modal-header">
	                <button type="button" class="close" data-dismiss="modal">&times;</button>
	                <h4 class="modal-title">View Image</h4>
	              </div>
	              <div class="modal-body text-center">
	                <img src="<?php echo Yii::getAlias('@asset').'/dist/img/img-dflt-icon.png'; ?>" width="320"/>
	            </div>                    
	          </div>
	          </div>
	      </div>
	      <!-- Modal View Answers :: END-->
	</div>
</section>
<!-- DataTables JS -->
<script src="<?php echo Yii::getAlias('@asset').'/plugins/datatables/js/jquery.dataTables.min.js';?>"></script>
<script src="<?php echo Yii::getAlias('@asset').'/plugins/datatables/js/dataTables.bootstrap.min.js';?>"></script>

<script type="text/javascript">

	//Datatable jQuery :: START
	 $(function () {
	    $('#subjects').DataTable();
	  })
	//Datatable jQuery :: END

</script>