<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Log Time <small>management</small>', [

    ['urlp'  =>  ['ctl'=>'tracking', 'act'=>'Time']]
]); ?>

<section class="content">
	<?php	include_once 'views/'.$this->controller.'/_form.php';	?>
</section>


  <!-- /.box -->
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>