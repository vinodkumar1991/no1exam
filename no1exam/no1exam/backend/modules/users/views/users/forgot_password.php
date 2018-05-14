<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>No1Exam :: Login</title>
<!-- Tell the browser to be responsive to screen width -->
<meta
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
	name="viewport">
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet"
	href="<?= Yii::getAlias('@asset') . '/plugins/bootstrap/dist/css/bootstrap.min.css'; ?>">
<!-- Font Awesome -->
<link rel="stylesheet"
	href="<?= Yii::getAlias('@asset') . '/plugins/font-awesome/css/font-awesome.min.css'; ?>">

<!-- Theme style -->
<link rel="stylesheet"
	href="<?= Yii::getAlias('@asset') . '/dist/css/AdminLTE.min.css'; ?>">
<!-- iCheck -->
<link rel="stylesheet"
	href="<?= Yii::getAlias('@asset') . '/plugins/iCheck/square/blue.css' ?>">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->

<!-- Google Font -->
<link rel="stylesheet"
	href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">Forgot Password</div>
		<!-- /.login-logo -->
		<div class="login-box-body">
			<div id="fg_success" class="text-success"></div>
			<form action="" method="post">
				<!-- Phone :: START -->
				<div class="form-group has-feedback" id="div_phone">
					<input type="text" class="form-control" name="phone" id="phone"
						placeholder="Enter Your Phone Number" maxlength="10"
						autocomplete="off" value="" /> <span
						class="fa fa-mobile form-control-feedback fa-2x"></span> <span
						id="err_phone" class="text-danger"></span>
				</div>

				<!-- Phone :: END -->
				<div class="form-group has-feedback" id="div_send_otp_btn">
					<!-- Button :: START -->
					<input type="button" class="btn btn-primary btn-block btn-flat"
						name="send_otp" id="send_otp" value="Send OTP" onclick="sendOTP()" />
					<!-- Button :: END -->
				</div>
				<!-- OTP Input :: START -->
				<div class="form-group has-feedback" id="div_otp">
					<input type="hidden" name="user_id" id="user_id" value="" /> <input
						type="text" class="form-control" name="otp" id="otp"
						placeholder="Enter OTP" maxlength="6" /> <span
						class="glyphicon glyphicon-lock form-control-feedback"></span> <span
						id="err_otp" class="text-danger"></span>
				</div>
				<!-- OTP Input :: END -->

				<!-- Password :: START -->
				<div class="form-group has-feedback" id="div_new_password">
					<input type="password" class="form-control" name="new_password"
						id="new_password" placeholder="Enter New Password" maxlength="6" />
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					<span id="err_new_password" class="text-danger"></span>
				</div>
				<!-- Password :: END -->
				<!-- Confirm Password :: START -->
				<div class="form-group has-feedback" id="div_confirm_password">
					<input type="password" class="form-control" name="confirm_password"
						id="confirm_password" placeholder="Confirm Your Password"
						maxlength="6" /> <span
						class="glyphicon glyphicon-lock form-control-feedback"></span> <span
						id="err_confirm_password" class="text-danger"></span>
				</div>
				<!-- Confirm Password :: END -->
				<!-- Change Password button :: START -->
				<div class="form-group has-feedback" id="div_change_password">
					<input type="button" class="btn btn-primary btn-block btn-flat"
						name="change_password" id="change_password"
						value="Change Password" onclick="changePassword()" />
				</div>
				<!-- Change Password button :: END -->

			</form>
		</div>
		<!-- /.login-box-body -->
	</div>
	<!-- /.login-box -->

	<!-- jQuery 3 -->
	<script
		src="<?= Yii::getAlias('@asset') . '/plugins/jquery/dist/jquery.min.js' ?>"></script>
	<!-- Bootstrap 3.3.7 -->
	<script
		src="<?= Yii::getAlias('@asset') . '/plugins/bootstrap/dist/js/bootstrap.min.js' ?>"></script>
	<!-- iCheck -->
	<script
		src="<?= Yii::getAlias('@asset') . '/plugins/iCheck/icheck.min.js' ?>"></script>
	<script>
	enableDefaults();
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });

            function sendOTP(){
                makeEmpty();
                var objPhone = {
                        phone : $("#phone").val() 
                        };
                $.post('<?php echo Yii::getAlias('@web').'/users/users/send-otp';?>',objPhone,function(response){
                	var response = $.parseJSON(response);
			          if(response.hasOwnProperty('errors')){
			              //State
			        	  if(undefined != response.errors.phone && response.errors.phone.length > 0){
			        		   $("#err_phone").html(response.errors.phone);
			        		   }
			   		   return false;
                    }else{
                       $("#fg_success").html(response.message);
                       makeFieldsEmpty();
                       $("#user_id").val(response.user_id);
                       setTimeout(enableFields, 5000);
                       return true;                        
                    }
                        	                    
                });
            }

            function enableDefaults(){
            	$("#div_otp").hide();
                $("#div_new_password").hide();
                $("#div_confirm_password").hide();
                $("#div_change_password").hide();
                return true;
            }

            function makeEmpty(){
                $("#err_phone").empty();
                $("#err_otp").empty();
                $("#err_new_password").empty();
                $("#err_confirm_password").empty();
                $("#fg_success").html();
                return true;
                }

            function enableFields(){
                $("#fg_success").html("");
                $("#div_phone").hide();
                $("#div_send_otp_btn").hide();
                $("#div_otp").show();
                $("#div_new_password").show();
                $("#div_confirm_password").show();
                $("#div_change_password").show();
                return true;
            }

            function makeFieldsEmpty(){
                $("#phone").val("");
                $("#otp").val("");
                $("#new_password").val("");
                $("#confirm_password").val("");
                return true;
                }

            function changePassword(){
                makeEmpty();
                var objInputs = {};
                objInputs = {
                        id :$("#user_id").val(), 
                        new_password : $("#new_password").val(),
	                    confirm_password : $("#confirm_password").val(),
		                otp : $("#otp").val()
                 };
                $.post('<?php echo Yii::getAlias('@web').'/users/users/change-password';?>',objInputs,function(response){
                	var response = $.parseJSON(response);
			          if(response.hasOwnProperty('errors')){
			              //OTP
			        	  if(undefined != response.errors.otp && response.errors.otp.length > 0){
			        		   $("#err_otp").html(response.errors.otp);
			        		   }
			        	//New Password
			        	  if(undefined != response.errors.new_password && response.errors.new_password.length > 0){
			        		   $("#err_new_password").html(response.errors.new_password);
			        		   }
			        	//Confirm Password
			        	  if(undefined != response.errors.confirm_password && response.errors.confirm_password.length > 0){
			        		   $("#err_confirm_password").html(response.errors.confirm_password);
			        		   }
			   		   return false;
                  }else{
                     $("#fg_success").html(response.message);
                     makeFieldsEmpty()
                     setTimeout(function(){window.location.href="<?php echo Yii::getAlias('@web').'/login';?>";}, 5000);
                     return true;                        
                  }      
                    });
                }
        </script>
</body>
</html>
