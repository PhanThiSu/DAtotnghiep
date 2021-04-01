<?php include_once 'views/layout/headerLogin.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <p><b>TPM</b> User Side</p>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body login-page">
    <p class="login-box-msg">Sign in to start your session</p>
    <?php if($this->errors) { ?>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Error!</strong> <?php echo $this->errors['message'];?>
    </div>
    <?php } ?>
    <form method="post" action="<?php echo vendor_app_util::url(array('ctl'=>'login','act'=>$this->action )); ?>">
      <div class="form-group has-feedback">
        <input type="email" id="email" class="form-control" name="user[email]" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="password" class="form-control" name="user[password]" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
          <label class="" style="margin-left:20px;">
                <input name="remember" id="remember" type="checkbox" >
              Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn_submit">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
        <a href="<?php echo vendor_app_util::url(array('ctl'=>'login','act'=> 'forgotPassWord' )); ?>">Forgot Password ?</a>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>

<script src="<?php echo RootREL; ?>media/js/jquery.min.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="<?php echo RootREL; ?>media/js/icheck.min.js"></script> -->
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%'
    });
  });
</script>

</body>
</html>

