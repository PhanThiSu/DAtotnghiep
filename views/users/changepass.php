<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<div class="login-box">
  <div class="login-logo">
    <a href="javascript:void(0);"><b>TPM</b> Thay đổi mật khẩu</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php if($this->errors) { ?>
    <div class="alert alert-danger alert-dismissible error-change" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Lỗi!</strong> <?php echo $this->errors['message']; ?>
    </div>
    <?php } ?>
    <form  id="resetform" method="post" action="<?php echo vendor_app_util::url(array('ctl'=>'users','act'=> 'changepass' )); ?>">
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="new password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" id="repeatnewpassword" name="repeatnewpassword" placeholder="repeat new password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-5 col-xs-offset-7">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="btn_submit">Update</button>
        </div>
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>


