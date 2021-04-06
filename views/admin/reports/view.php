<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Quản lý báo cáo công việc', [
    [
      'title' =>  'Index Reports',
      'urlp'=>['ctl'=>$app['ctl']]
    ],
    ['urlp'  =>  ['ctl'=>$app['ctl'], 'act'=>$app['act']]]
]); ?>

<section class="content">
	<?php 
		include_once 'views/admin/'.$this->controller.'/_form.php';
	?>

</section>


  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>