<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/admin/css/three-state-radio-buttons.css">
<script type="text/javascript">
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);
</script>

<?php vendor_html_helper::contentheader('Requests <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row" id="requests-header">
		    			<div class="col-sm-10 col-xs-10">
		    				<div class="row">
								<div class="btn-group btn-toggle col-md-4"> 
								    <button class="btn btn-danger active">Month</button>
								    <button class="btn btn-default ">Week</button>
								</div>

				      			<form id="form-request-month" action="<?php echo vendor_app_util::url(["ctl"=>"requests", "act"=>'user/'.$this->user_id]); ?>" method="post" enctype="multipart/form-data" class="form-inline form-request col-md-8">
									<div class="form-group">
									    <label class="sr-only" for="exampleInputAmount">Select month: </label>
									    <div class="input-group user-input-group">
									      	<div class="input-group-addon mobileHide">Select month: </div>
				      						<input type="month" name="month" class="form-control" id="month" placeholder="Month..." <?=(isset($this->time) && $this->timetype=='month')? 'value="'.$this->time.'"':'';?>>
				      					</div>
				      				</div>
									<button type="submit" class="btn btn-info">Submit</button>
				      			</form>

				                <form id="form-request-week" action="<?php echo vendor_app_util::url(["ctl"=>"requests", "act"=>'user/'.$this->user_id]); ?>" method="post" enctype="multipart/form-data" class="form-inline form-request col-md-8 hide">
				                  	<div class="form-group">
					                    <label class="sr-only" for="exampleInputAmount">Select week: </label>
					                    <div class="input-group user-input-group">
					                      	<div class="input-group-addon mobileHide">Select week: </div>
					                      	<input type="week" name="week" class="form-control" id="week" placeholder="Week..." <?=(isset($this->time) && $this->timetype=='week')? 'value="'.$this->time.'"':'';?>>
					                    </div>
				                  	</div>
				                  	<button type="submit" class="btn btn-info">Submit</button>
				                </form>
				            </div>
		    			</div>

		    			<div class="col-sm-2 col-xs-2">
		    				<button id="delete-records" class="btn btn-danger pull-right">
		    					<i class="fa fa-remove"></i>
		    				</button>
		    				<a href="<?php echo vendor_app_util::url(['ctl'=>'requests','act'=>'add']); ?>" id="add-request" type = "button" class="btn btn-primary pull-right" >
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
</section>

<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
