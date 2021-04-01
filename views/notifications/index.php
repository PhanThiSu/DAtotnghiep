<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/admin/css/three-state-radio-buttons.css">
<script type="text/javascript">
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);
</script>



<?php vendor_html_helper::contentheader('Notifications <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

	<div class="row content">
		<div class="col-xs-12 col-lg-12">
			<div class="box dataTables_wrapper">
			    <div class="box-header">
		    		<div class="row" id="records-header">
		    			<div class="col-sm-8 col-xs-6">
			      			<h2 class="box-title">Notifications</h2>
		    			</div>
		    	
		    			<div class="col-sm-8 col-xs-6">
		    			</div>
		    		</div>
			    </div>
			    
				<!-- datatable  -->
				<?php include_once 'views/'.$this->controller.'/_datatable.php';	?>
			    
			</div>
		</div>
	</div>
</div>
<script src="<?php echo RootREL; ?>media/bootstrap/js/checkbox-x.min.js"></script>

<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
