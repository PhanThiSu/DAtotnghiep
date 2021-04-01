<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?=user_model::getAvataUrl();?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?=user_model::getFullnameLogined();?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN</li>
      <li class="active">
        <a href="<?=vendor_app_util::url(array('ctl'=>'dashboard')); ?>">
          <i class="fa fa-dashboard"></i> <span>Chung</span>
        </a>
      </li>
      <li class="treeview <?=($app['ctl']=='users')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-user"></i> <span>Users</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='users' )? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'users')); ?>"><i class="fa fa-users"></i> List User</a></li>
          <li <?=($app['ctl']=='users' && $app['act']=='add')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'users', 'act'=>'add')); ?>"><i class="fa fa-user-plus"></i> Add User</a></li>
        </ul>
      </li>

      <li class="treeview <?=($app['ctl']=='reports')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-pie-chart"></i>
          <span>Report time</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='reports' && $app['act']=='index')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'reports']); ?>"><i class="fa fa-list"></i> List reports</a></li>
          <li <?=($app['ctl']=='reports' && $app['act']=='add')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'reports', 'act'=>'add']); ?>" ><i class="fa fa-plus"></i> Add report</a></li>

          <li class="treeview <?=($app['ctl']=='reports' && ($app['act']=='usersmonths' || $app['act']=='usersdays'|| $app['act']=='usersdate'))? 'active menu-open':'';?>">
            <a href="#"><i class="fa fa-circle-o"></i> Users're time<span class="text-danger">s</span> in... 
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?=($app['ctl']=='reports' && $app['act']=='usersmonths')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'usersmonths')); ?>"><i class="fa fa-list"></i> Reports months in year</a></li>
              <li <?=($app['ctl']=='reports' && $app['act']=='usersdays')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'usersdays')); ?>"><i class="fa fa-list"></i> Reports days in week</a></li>
              <li <?=($app['ctl']=='reports' && $app['act']=='usersdate')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'usersdate')); ?>"><i class="fa fa-list"></i> Reports users in date</a></li>
            </ul>
          </li>

          <li <?=($app['ctl']=='reports' && $app['act']=='usersreport')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'reports', 'act'=>'usersreport']); ?>"><i class="fa fa-list"></i> Users're time in...</a></li>

          <li <?=($app['ctl']=='reports' && $app['act']=='usersOTreport')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'reports', 'act'=>'usersOTreport']); ?>"><i class="fa fa-list"></i> Users're OT time in...</a></li>

          <li class="treeview <?=($app['ctl']=='reports' && ($app['act']=='usersgroups' || $app['act']=='usergroups' || $app['act']=='userstimegroups' || $app['act']=='usertimegroups'))? 'active menu-open':'';?>">
            <a href="#"><i class="fa fa-circle-o"></i> Reports with groups
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?=($app['ctl']=='reports' && $app['act']=='usersgroups')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'usersgroups')); ?>"><i class="fa fa-list"></i> User's time per group</a></li>
              <li <?=($app['ctl']=='reports' && $app['act']=='userstimegroups')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'userstimegroups')); ?>"><i class="fa fa-list"></i>group time per in...</a></li>
            </ul>
          </li>

          <li <?=($app['ctl']=='reports' && $app['act']=='usertimegroups')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'usertimegroups')); ?>"><i class="fa fa-list"></i>Groups of user</a></li>

          <li class="treeview <?=($app['ctl']=='reports' && ($app['act']=='month' || $app['act']=='week' || $app['act']=='daily'))? 'active menu-open':'';?>">
            <a href="#"><i class="fa fa-circle-o"></i> Reports in ...
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?=($app['ctl']=='reports' && $app['act']=='month')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'month')); ?>"><i class="fa fa-list"></i> Reports per month</a></li>
              <li <?=($app['ctl']=='reports' && $app['act']=='week')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'week')); ?>"><i class="fa fa-list"></i> Reports per week</a></li>
              <li <?=($app['ctl']=='reports' && $app['act']=='daily')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'daily')); ?>"><i class="fa fa-list"></i> Reports per date</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="treeview <?=($app['ctl']=='requests')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-exclamation-triangle"></i> <span>Requests</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=vendor_app_util::url(['ctl'=>'requests']); ?>"><i class="fa fa-list"></i> List requests</a></li>
          <li><a href="<?=vendor_app_util::url(['ctl'=>'requests', 'act'=>'add']); ?>"><i class="fa fa-plus"></i> Add request</a></li>

          <li class="treeview">
            <a href="#"><i class="fa fa-circle-o"></i> Requests in ...
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?=($app['ctl']=='requests' && $app['act']=='index')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'requests', 'act'=>'index')); ?>"><i class="fa fa-list"></i> Requests per month</a></li>
              <li <?=($app['ctl']=='requests' && $app['act']=='week')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'requests', 'act'=>'week')); ?>"><i class="fa fa-list"></i> Requests per week</a></li>
              <li <?=($app['ctl']=='requests' && $app['act']=='daily')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'requests', 'act'=>'daily')); ?>"><i class="fa fa-list"></i> Requests per date</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class="treeview <?=($app['ctl']=='logtime')? ' active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-clock-o"></i>
          <span>Log time</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='check_logtime' )? 'class="active"':'';?>><a href="<?php echo vendor_app_util::url(array('ctl'=>'check_logtime' )); ?>"><i class="fa fa-list"></i> List Check Logtime</a></li>
        </ul>
      </li>
      <li class="treeview <?=($app['ctl']=='user_level_salaries')? 'active menu-open':'';?>">
        <a href="#">
        <i class="fa fa-level-up"></i><span>Level Salaries</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='user_level_salaries' && $app['act']=='index')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'user_level_salaries')); ?>"><i class="fa fa-list"></i> List Level Salaries</a></li>
        </ul>
      </li>
      <li class="treeview <?=($app['ctl']=='user_month_salaries')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-money"></i> <span>Month Salaries</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='user_month_salaries' && $app['act']=='index')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'user_month_salaries')); ?>"><i class="fa fa-list"></i> List Month Salaries</a></li>
        </ul>
      </li>
      <li class="treeview <?=($app['ctl']=='fund_salaries')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-bar-chart"></i> <span>Fund Salaries</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="treeview <?=($app['ctl']=='fund_salaries' && ($app['act']=='chartsMonth' || $app['act']=='chartsQuarter'|| $app['act']=='chartsYear' || $app['act']=='index'))? 'active menu-open':'';?>">
            <a href="#"><i class="fa fa-circle-o"></i> Charts Salaries
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?=($app['ctl']=='fund_salaries' )? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'fund_salaries']); ?>"><i class="fa fa-list"></i> Charts Salaries per month</a></li>
              <li <?=($app['ctl']=='fund_salaries' && $app['act']=='chartsQuarter')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'fund_salaries', 'act'=>'chartsQuarter']); ?>"><i class="fa fa-list"></i> Charts Salaries per quarter</a></li>
              <li <?=($app['ctl']=='fund_salaries' && $app['act']=='chartsYear')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'fund_salaries', 'act'=>'chartsYear']); ?>"><i class="fa fa-list"></i> Charts Salaries per year</a></li>
            </ul>
          </li>
          <li class="treeview <?=($app['ctl']=='fund_salaries' && ($app['act']=='listMonth' || $app['act']=='listQuarter'|| $app['act']=='listYear'))? 'active menu-open':'';?>">
            <a href="#"><i class="fa fa-circle-o"></i> Lists Salaries
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li <?=($app['ctl']=='fund_salaries' && $app['act']=='listMonth')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'fund_salaries', 'act'=>'listMonth']); ?>"><i class="fa fa-list"></i> List Salaries per month</a></li>
              <li <?=($app['ctl']=='fund_salaries' && $app['act']=='listQuarter')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'fund_salaries', 'act'=>'listQuarter']); ?>"><i class="fa fa-list"></i> List Salaries per quarter</a></li>
              <li <?=($app['ctl']=='fund_salaries' && $app['act']=='listYear')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'fund_salaries', 'act'=>'listYear']); ?>"><i class="fa fa-list"></i> List Salaries per year</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li >
      <li class="treeview <?=($app['ctl']=='groups')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-book"></i> <span>Groups</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='groups' && $app['act']=='index')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'groups']); ?>"><i class="fa fa-list"></i> List Groups</a></li>
          <li <?=($app['ctl']=='groups' && $app['act']=='suggested')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'groups', 'act'=>'suggested']); ?>"><i class="fa fa-list"></i> Suggested Groups</a></li>
          <li <?=($app['ctl']=='groups' && $app['act']=='add')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(['ctl'=>'groups', 'act'=>'add']); ?>"><i class="fa fa-plus-circle"></i> Add Group</a></li>
        </ul>
      </li>
      <li >
      <li class="treeview <?=($app['ctl']=='notifications')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-envelope"></i> <span>Notifications</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=($app['ctl']=='notifications' && $app['act']=='index')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'notifications')); ?>"><i class="fa fa-envelope-square"></i> List Notifications</a></li>
          <li <?=($app['ctl']=='notifications' && $app['act']=='add')? 'class="active"':'';?>><a href="<?=vendor_app_util::url(array('ctl'=>'notifications', 'act'=>'add')); ?>"><i class="fa fa-eyedropper"></i> Add Send Notification</a></li>
        </ul>
      </li><li>
          <a href="<?=vendor_app_util::url(array('ctl'=>'holidays')); ?>">
          <i class="fa fa-calendar"></i><span>Holidays</span>
          </a>
        </li>
      <li>
          <a href="<?=vendor_app_util::url(array('ctl'=>'common_settings')); ?>">
            <i class="fa fa-cog"></i><span>Common Settings</span>
          </a>
        </li>
        <li>
          <a href="<?=vendor_app_util::url(array('ctl'=>'logs')); ?>">
            <i class="fa fa-crosshairs"></i> <span>Log</span>
          </a>
        </li>
      <li class="treeview <?=($app['ctl']=='users' && $app['act']=='profile')? 'active menu-open':'';?>">
        <a href="#">
          <i class="fa fa-lock"></i>
          <span>Manage</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?=vendor_app_util::url(array('ctl'=>'users', 'act'=>'profile')); ?>"><i class="fa fa-male"></i> Profile</a></li>
          <li><a href="<?php echo RootURL; ?>admin/dashboard/backup" ><i class="fa fa-database"></i>Back up</a></li>
          <li><a href="<?php echo RootURL; ?>admin/dashboard/backup_zip_file" ><i class="fa fa-database"></i>Back up zip</a></li>
          <li><a href="#" data-target="#changePassword" data-toggle="modal"><i class="fa fa-key"></i>Change Password</a></li>
          <li><a href="<?=vendor_app_util::url(array('ctl'=>'login', 'act'=>'logout')); ?>"><i class="fa fa-sign-in"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
