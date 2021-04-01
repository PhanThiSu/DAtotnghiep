<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Common Settings <small>management</small>', [
    [
      'title' =>  'Index Common Settings',
      'urlp'=>['ctl'=>'Common Settings']
    ],
    ['urlp'  =>  ['ctl'=>'Common Settings', 'act'=>$app['act']]]
]); ?>

<section class="content">
	<?php 
		include_once 'views/admin/common_settings/_form.php';
	?>

</section>


  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>