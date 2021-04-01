<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">
        <img src="<?=user_model::getAvataUrl();?>" style="float: left;width: 30px;height: 30px;border-radius: 50%;margin-right: 10px;margin-top: -2px;" alt="">
        <span class="hidden-xs"><?=user_model::getFullnameLogined();?></span>
      </li>
      <li class="active">
        <a href="<?php echo vendor_app_util::url(['ctl'=>'dashboard']); ?>">
          <i class="fa fa-home"></i> <span>Chung</span>
        </a>
      </li>
      <li class="treeview <?=($app['ctl']=='reports')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>Báo cáo công việc</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='reports' && $app['act']=='index')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'reports')); ?>"><i class="fa fa-list"></i> Danh sách báo cáo</a></li>
          <li <?=($app['ctl']=='reports' && $app['act']=='add')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'reports', 'act'=>'add')); ?>"><i class="fa fa-user-plus"></i> Thêm báo cáo</a></li>
          <li <?=($app['ctl']=='reports' && $app['act']=='month')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'reports', 'act'=>'month')); ?>"><i class="fa fa-list"></i> Báo cáo trong tháng</a></li>
          <!-- <li <?=($app['ctl']=='reports' && $app['act']=='week')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'reports', 'act'=>'week')); ?>"><i class="fa fa-list"></i> Reports per Week</a></li>
          <li <?=($app['ctl']=='reports' && $app['act']=='usermonths')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'usermonths')); ?>"><i class="fa fa-list"></i> Reports months in year</a></li>
          <li <?=($app['ctl']=='reports' && $app['act']=='userdays')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'userdays')); ?>"><i class="fa fa-list"></i> Reports days in week</a></li> -->
        </ul>
      </li>
      <!-- <li class="treeview <?=($app['ctl']=='check_logtime')? ' active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-clock-o"></i>
          <span>Log time</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='check_logtime' && $app['act']=='add')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'check_logtime', 'act'=>'add')); ?>"><i class="fa fa-check-square-o"></i> Check Logtime</a></li>
        </ul>
      </li> -->
      <li class="treeview <?=($app['ctl']=='requests')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-clock-o"></i> <span>Phép</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='requests' && $app['act']=='index')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'requests')); ?>"><i class="fa fa-list"></i> Danh sách xin nghỉ</a></li>
          <li <?=($app['ctl']=='requests' && $app['act']=='add')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'requests', 'act'=>'add')); ?>"><i class="fa fa-user-plus"></i>Thêm phép </a></li>
          <li <?=($app['ctl']=='requests' && $app['act']=='month')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'requests', 'act'=>'month')); ?>"><i class="fa fa-list"></i> Phép trong tháng</a></li>
          <!-- <li <?=($app['ctl']=='requests' && $app['act']=='week')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'requests', 'act'=>'week')); ?>"><i class="fa fa-list"></i> Request per Week</a></li> -->
        </ul>
      </li>

      <li class="treeview <?=($app['ctl']=='leader_groups')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-book"></i> <span>Nhóm</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='leader_groups' && $app['act']=='index')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'leader_groups']); ?>"><i class="fa fa-list"></i> Danh sách nhóm</a></li>
        </ul>
      </li>
      <?php if(1==2){ ?>
        <li class="treeview <?=($app['ctl']=='salaries')? 'active menu-open':'';?>">
          <a href="#">
          <i class="fa fa-usd"></i><span>Salaries</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li <?=($app['ctl']=='salaries' && $app['act']=='currentMonth')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'salaries', 'act'=>'currentMonth')); ?>"><i class="fa fa-list"></i>Salaries current month</a></li>
            <li <?=($app['ctl']=='salaries' && $app['act']=='months')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'salaries', 'act'=>'months')); ?>"><i class="fa fa-list"></i> Salaries per month</a></li>
            <li <?=($app['ctl']=='salaries' && $app['act']=='years')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'salaries', 'act'=>'years')); ?>"><i class="fa fa-list"></i> Salaries per year</a></li>
          </ul>
        </li>
      <?php }?>
      <li class="treeview <?=($app['ctl']=='notifications')? 'active menu-open':'';?>">
        <a href="#">
        <i class="fa fa-envelope"></i><span>Thông báo</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='notifications' && $app['act']=='index')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'notifications')); ?>"><i class="fa fa-list"></i> Danh sách thông báo</a></li>
          <!-- <li <?=($app['ctl']=='notifications' && $app['act']=='week')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'notifications', 'act'=>'week')); ?>"><i class="fa fa-list"></i> notifications per Week</a></li>
          <li <?=($app['ctl']=='notifications' && $app['act']=='month')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'notifications', 'act'=>'month')); ?>"><i class="fa fa-list"></i> notifications per month</a></li> -->
        </ul>
      </li>
      <li class="treeview <?=($app['ctl']=='users')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-lock"></i>
          <span>Quản lý thông tin cá nhân</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='users' && $app['act']=='profile')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'users', 'act'=>'profile')); ?>"><i class="fa fa-male"></i>Thông tin cá nhân</a></li>
          <li <?=($app['ctl']=='users' && $app['act']=='changepass')? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'users', 'act'=>'changepass')); ?>"><i class="fa fa-key"></i>Thay đổi mật khẩu</a></li>
          <li><a href="<?php echo vendor_app_util::url(array('ctl'=>'users','act'=>'logout')); ?>"><i class="fa fa-sign-in"></i>Đăng xuất</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
