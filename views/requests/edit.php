<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Requests <small>management</small>', [
    [
      'title' =>  'Index Requests',
      'urlp'=>['ctl'=>$app['ctl']]
    ],
    ['urlp'  =>  ['ctl'=>$app['ctl'], 'act'=>$app['act']]]
]); ?>

<section class="content">
	<?php include_once 'views/'.$this->controller.'/_form.php';?>
</section>

<!-- /.box -->
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>