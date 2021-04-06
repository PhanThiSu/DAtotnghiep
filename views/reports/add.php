<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Báo cáo công việc', [
    [
      'title' =>  'Index Reports',
      'urlp'=>['ctl'=>"Thêm báo cáo"]
    ],
    ['urlp'  =>  ['ctl'=>"Thêm báo cáo", 'act'=>""]]
]); ?>

<section class="content">
	<?php	include_once 'views/'.$this->controller.'/_form.php';	?>
</section>


  <!-- /.box -->
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>