<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo vendor_app_util::url(['ctl'=>'dashboard']); ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>A</b>LT</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>TPM User </b></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu dropdown-user">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <span class="hidden-xs"><?=user_model::getFullnameLogined();?></span><i class="fa fa-sort-desc" aria-hidden="true"></i>
          </a>
          <ul class="dropdown-menu">
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-xs-12 text-left dropdown-body">
                  <a href="#"></i>Thông tin cá nhân</a>
                </div>
                <div class="col-xs-12 text-left dropdown-body">
                  <a href="#"></i>Thay đổi mật khẩu</a>
                </div>
                <hr>
                <div class="col-xs-12 text-left">
                  <a href="#" class="btn btn-default btn-flat">Đăng xuất</a>
                </div>
              </div>
              <!-- /.row -->
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
