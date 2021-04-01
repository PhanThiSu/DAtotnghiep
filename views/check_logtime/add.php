<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Check Log Time <small>management</small>', [

    ['urlp'  =>  ['ctl'=>'Check Log Time', 'act'=>'Time']]
]); ?>

<section class="content">
	<?php	include_once 'views/'.$this->controller.'/_form.php';	?>
</section>


  <!-- /.box -->
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>