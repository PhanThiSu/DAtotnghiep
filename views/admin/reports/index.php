<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/admin/css/three-state-radio-buttons.css">
<script type="text/javascript">
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);
</script>

<?php vendor_html_helper::contentheader('Quản lý báo cáo công việc', [['urlp'=>['ctl'=>"", 'act'=>"Danh sách báo cáo"]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border">
		    		<div class="row" id="reports-header">
		    			<div class="col-sm-8 col-xs-6">
			      			<!-- <h2 class="box-title">All reports</h2> -->
		    			</div>

		    			<div class="col-sm-4 col-xs-6">
							<button id="delete-records" class="btn btn-danger pull-right">
									<i class="fa fa-remove"></i>
								</button>
		    				<a href="<?php echo vendor_app_util::url(['ctl'=>'reports','act'=>'add']); ?>" id="add-report" class="btn btn-primary pull-right" >
		    					<i class="fa fa-plus"></i>
		    				</a>	
		    			</div>
		    		</div>
			    </div>
			    <!-- /.box-header -->
			    
				<?php include_once 'views/admin/'.$this->controller.'/_datatable.php';	?>
			    </div>
			</div>
		</div>
	</div>
</section>

<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
