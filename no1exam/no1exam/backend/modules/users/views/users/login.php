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
              <style type="text/css">
                  .login-page, .register-page{
                        background: #008257;
                    }
                    .login-logo img{
                        width: 140px;
                    }
                    .btn-primary.focus, .btn-primary:focus {
                        color: #fff !important;
                        background-color: #000000 !important; 
                        border-color: #000 !important;
                    }
              </style>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="login-box-body">
                <div class="login-logo"><img src="<?= Yii::getAlias('@asset') . '/dist/img/logo.png'; ?>"></div>
                <!-- <p class="login-box-msg">Sign in to start your session</p> -->
                <form action="" method="post">
                    <!-- Phone :: START -->
                    <div class="form-group has-feedback">
                        <input type="text" class="form-control" name="phone" id="phone"
                               placeholder="Enter Your Phone Number" maxlength="10"
                               autocomplete="off"
                               value="<?php echo isset($fields['phone']) ? $fields['phone'] : NULL; ?>" />
                        <span class="fa fa-mobile form-control-feedback fa-2x"></span>
                        <div class="text-danger"><?php echo isset($errors['phone'][0]) ? $errors['phone'][0] : NULL; ?></div>
                    </div>
                    <!-- Phone :: END -->
                    <!-- Password :: START -->
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" name="password"
                               id="password" placeholder="Enter Your Password" maxlength="6" /> <span
                               class="glyphicon glyphicon-lock form-control-feedback"></span>
                        <div class="text-danger"><?php echo isset($errors['password'][0]) ? $errors['password'][0] : NULL; ?></div>
                    </div>
                    <!-- Password :: END -->
                    <div class="row">
                        <!-- Forgot Password :: START -->
                        <a href="<?php echo Yii::getAlias('@web') . '/forgot-password'; ?>">Forgot Password?</a>
                        <!-- Forgot Password :: END -->
                        <!-- Button :: START -->
                        <div class="col-xs-4">
                            <input type="submit" class="btn btn-primary btn-block btn-flat"
                                   name="do_login" id="do_login" value="Login" />
                        </div>
                        <!-- Button :: END -->
                    </div>
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
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
            });
        </script>
    </body>
</html>
