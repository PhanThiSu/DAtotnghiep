<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TPM Admin Template | Log in</title>
  	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap.min.css">
    <!--link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-theme.min.css"-->
    <link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/AdminLTE.min.css">
  	<!-- Google Font -->
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="<?php echo RootREL; ?>media/libs/css/blue.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0);"><b>TPM</b>Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">ĐĂNG NHẬP</p>

    <form method="post" action="<?php echo vendor_app_util::url(
		array('area'=>'admin',
			  'ctl'=>'login',
			  'act'=>$this->action
	)); ?>">
    <?php if(isset($this->errors['input'])) { ?>
      <div class="alert alert-danger  alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4>Lỗi!</h4>
        <p><?=$this->errors['input'];?></p>
      </div>
    <?php } ?>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" name="user[email]" placeholder="Email" id="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="user[password]" placeholder="Password" id="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label class="" style="margin-left:20px;">
                <input name="remember" id="remember" type="checkbox" >
              Ghi nhớ mật khẩu
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn_submit">Đăng nhập</button>
        </div>
        <!-- /.col -->
      </div>

    </form>

  </div>
  <!-- /.login-box-body -->
</div>

<!--script src="<?php echo RootREL; ?>media/js/jquery.min.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap.min.js"></script-->
</body>
</html>

