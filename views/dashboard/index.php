
<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Trang chủ
    <!-- <small>Control panel</small> -->
  </h1>
  <!-- <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">Chung</li>
  </ol> -->
</section>

<!-- Main content -->
<section class="content dashboard">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-4 .col-sm-4 ">
      <!-- small box -->
      <div class="small-box bg-aqua small-dashboard">
        <div class="inner">
          <h3 class="smallMobileHide"><a class="daily" alt="today" href="<?=vendor_app_util::url(array('ctl'=>'reports')); ?>"> <?=$this->thisWeekReports;?> Báo cáo trong tuần</a></h3>

          <!-- <p><a class="daily" alt="yesterday" href="<?=vendor_app_util::url(array('ctl'=>'reports')); ?>"><?=$this->noUsersTodayReports;?> Báo cáo hôm nay</a></p> -->
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo vendor_app_util::url(array('ctl'=>'reports')); ?>" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 .col-sm-4 ">
      <!-- small box -->
      <div class="small-box bg-green small-dashboard">
        <div class="inner">
          <h3 class="smallMobileHide"><a  class="daily" alt="today" href="#"><?=$this->noUnprocessRequestsWeek;?> Phép trong tuần</a></h3>
          <!-- <?=vendor_app_util::url(['ctl'=>'requests', 'act'=>'week']); ?> -->
          <!-- <p><a  class="daily" alt="today" href="<?=vendor_app_util::url(['ctl'=>'requests', 'act'=>'week']); ?>"><?=$this->noUnprocessRequests;?> unprocess today</a> & <a class="daily" alt="yesterday" href="<?=vendor_app_util::url(['ctl'=>'requests', 'act'=>'weeks']); ?>"><?=$this->noUnprocessRequestsYesterday;?> unprocess yesterday</a></p> -->
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
        <!-- <?php echo vendor_app_util::url(array('ctl'=>'requests')); ?> -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 .col-sm-4 ">
      <!-- small box -->
      <!-- <div class="small-box bg-red small-dashboard">
        <div class="inner">
          <h3 class="smallMobileHide"><a  class="daily" alt="today" href="<?=vendor_app_util::url(['ctl'=>'users', 'act'=>'profile']); ?>"><?=$this->lastnameUser;?> <?=$this->firstnameUser;?> </a></h3>

          <p><a class="email" alt="email" href="<?=vendor_app_util::url(['ctl'=>'users', 'act'=>'profile']); ?>"><?=$this->emailUser;?></a></p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?php echo vendor_app_util::url(array('ctl'=>'users', 'act'=>'profile')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div> -->
    </div>
    <!-- ./col -->
    <div class="col-lg-4 .col-sm-4 ">
      <!-- small box -->
      <div class="small-box bg-blue small-dashboard">
        <div class="inner">
          <h3 class="smallMobileHide"><a class="daily" alt="today" href="#"> <?=$this->thisWeekNotifications;?> Thông báo trong tuần</a></h3>
          <!-- <?=vendor_app_util::url(array('ctl'=>'notifications')); ?> -->
          <!-- <p><a class="daily" alt="yesterday" href="<?=vendor_app_util::url(array('ctl'=>'notifications')); ?>"><?=$this->noTodayNotifications;?> Thông báo trong ngày</a></p> -->
          
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">Xem chi tiết <i class="fa fa-arrow-circle-right"></i></a>
        <!-- <?php echo vendor_app_util::url(array('ctl'=>'notifications')); ?> -->
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-4 .col-sm-4 ">
      <!-- small box -->
      <!-- <div class="small-box bg-yellow small-dashboard">
        <div class="inner">
          <h3 class="smallMobileHide"><a class="daily" alt="today" href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'month')); ?>">  <?=  number_format((float) $this->timeTotalMonth , 1, '.', ''); ?>(h) Time Of Month</a></h3>

          <p><a class="daily" alt="yesterday" href="<?=vendor_app_util::url(array('ctl'=>'reports')); ?>"><?=  number_format((float) $this->timeTotalWeek , 1, '.', ''); ?>(h) Time Of Week </a></p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo vendor_app_util::url(array('ctl'=>'reports', 'act'=>'week')); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div> -->
    </div>
    <!-- ./col -->
  </div>
  <!-- /.row -->
</section>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
