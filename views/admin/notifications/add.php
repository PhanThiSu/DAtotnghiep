<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<?php  
	
?>
<?php vendor_html_helper::contentheader('Notification <small>management</small>', [
    [
      'title' =>  'Index Notifications',
      'urlp'=>['ctl'=>$app['ctl']]
    ],
    ['urlp'  =>  ['ctl'=>$app['ctl'], 'act'=>$app['act']]]
]); ?>

<section class="content">
	<?php 
		include_once 'views/admin/notifications/_form.php';
	?>
</section>

<script type="text/javascript" src="<?php echo RootREL; ?>media/libs/ckeditor_v4_full/ckeditor.js"></script>
<script>
	CKEDITOR.replace( 'editor1', {} );
	CKEDITOR.config.baseFloatZIndex = 100001;
    // send only item in 1 request
	$(document).ready(function() {
		$('#btnAdd').on('click',function(){
			$(this).css('display', 'none')
		})
	});

</script>
<script type="text/javascript" src="<?php echo RootREL; ?>media/admin/js/notifications.js"></script>


  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>