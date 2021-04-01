<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<?php  
	
?>
<section class="content-header">
  <h1>
    Quản lý ngày kỷ niệm
    <!-- <small>Control panel</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
    <li class="active">Chung</li>
  </ol>
</section>

<section class="content">
	<?php 
		include_once 'views/admin/holidays/_form.php';
	?>
</section>


  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>