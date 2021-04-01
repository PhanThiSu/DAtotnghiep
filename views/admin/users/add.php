<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Quản lý <small>người dùng</small>', [
    [
      'title' =>  'Quản lý người dùng',
      'urlp'=>['ctl'=>"Thêm người dùng"]
    ],
    ['urlp'  =>  ['ctl'=>"Thêm người dùng", 'act'=>""]]
]); ?>

<section class="content">
	<?php 
		include_once 'views/admin/users/_form.php';
	?>

</section>


  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>