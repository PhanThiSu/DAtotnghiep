<?php include_once 'views/admin/layout/' . $this->layout . 'top.php';?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Trang chủ
    <!-- <small>Control panel</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">Chung</li>
  </ol>
</section>

<!-- Main content -->
<section class="content dashboard">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-6 .col-md-6 .col-sm-12">
      <!-- small box -->
      <div class="small-box bg-aqua small-dashboard">
        <div class="inner">
          <h3 class="smallMobileHide"><a href="<?=vendor_app_util::url(array('ctl' => 'users'));?>"><?=$this->noUsers;?> users</a></h3>

          <p><?=$this->noNonAdminActiveUsers;?> acctive users in <?=$this->noNonAdminUsers;?> users (non admin)</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="<?=vendor_app_util::url(array('ctl' => 'users'));?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 .col-md-6 .col-sm-12">
      <!-- small box -->
      <div class="small-box bg-green  small-dashboard">
        <div class="inner">
          <h3 class="smallMobileHide"><a class="daily" alt="today" href="<?=vendor_app_util::url(array('ctl' => 'reports', 'act' => 'usersreport'));?>"> <?=$this->noUsersTodayReports;?> users reported today</a></h3>

          <p><a class="daily" alt="yesterday" href="<?=vendor_app_util::url(array('ctl' => 'reports', 'act' => 'usersreportyd'));?>"><?=$this->noUsersYesterdayReports;?> users reported yesterday</a> and <a class="daily" alt="yesterday" href="<?=vendor_app_util::url(array('ctl' => 'reports', 'act' => 'usersnotreportyd'));?>"><?=$this->noUsersYesterdayNotReports;?> users didn't report yesterday</a></p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?=vendor_app_util::url(['ctl' => 'reports']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 .col-md-6 .col-sm-12">
      <!-- small box -->
      <div class="small-box bg-yellow small-dashboard">
        <div class="inner">
          <h3 class="smallMobileHide"><a  class="daily" alt="today" href="<?=vendor_app_util::url(['ctl' => 'requests', 'act' => 'daily']);?>"><?=$this->noTodayRequests;?> user off today</a></h3>

           <p><a  class="daily" alt="today" href="<?=vendor_app_util::url(['ctl' => 'requests', 'act' => 'todayunprocess']);?>"><?=$this->noUnprocessRequestsToday;?> request unprocess today</a> & <a class="daily" alt="yesterday" href="<?=vendor_app_util::url(['ctl' => 'requests', 'act' => 'beforeunprocess']);?>">all <?=$this->noUnprocessRequestsBefore;?> request unprocess before </a></p>

        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="<?=vendor_app_util::url(array('ctl' => 'requests'));?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-6 .col-md-6 .col-sm-12">
      <!-- small box -->
      <div class="small-box bg-red small-dashboard">
        <div class="inner">
          <h3 class="smallMobileHide"><a href="<?=vendor_app_util::url(['ctl' => 'groups']);?>"><?=$this->noGroups;?> groups </a></h3>

          <p><a href="<?=vendor_app_util::url(['ctl' => 'groups', 'act' => 'suggested']);?>" class="small-box-footer"><?=$this->noSuggestionGroups;?> suggestion groups </a></p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?=vendor_app_util::url(['ctl' => 'groups']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
    <div class="col-lg-6 .col-md-6 .col-sm-12">
      <!-- small box -->
      <div class="small-box small-dashboard" style="background-color: #ab8ce4 ">
        <div class="inner">
        <?php
          $monthName = date('F', mktime(0, 0, 0, $this->preMonth, 10));
        ?>
          <h3 class="smallMobileHide"><a href="<?=vendor_app_util::url(['ctl' => 'user_month_salaries', 'act'=>'view?month='.$this->preMonth.'&year='.$this->year ]);?>">Salaries in <?= $monthName?> <?= $this->year ?></a></h3>

          <p><a href="<?=vendor_app_util::url(['ctl' => 'user_month_salaries', 'act'=>'view?month='.$this->preMonth.'&year='.$this->year ]);?>" class="small-box-footer"><?=$this->noUserPaidSalaries;?> users are paid salaries in <?=$this->noUserSalaries;?> users</a></p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?=vendor_app_util::url(['ctl' => 'user_month_salaries', 'act'=>'view?month='.$this->preMonth.'&year='.$this->year ]);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
</section>

<script src="<?php echo RootREL; ?>media/admin/js/dashboard.js"></script>

<?php include_once 'views/admin/layout/' . $this->layout . 'footer.php';?>
