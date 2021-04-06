<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<script type="text/javascript">
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);
</script>

<?php vendor_html_helper::contentheader('Quản lý bao cáo công việc', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border row" id="reports-header">
					<div class="col-sm-6">
						<h3 class="box-title">
							<?php if( isset($this->OT_time) && $this->OT_time = 'OT_time') { ?>
								<?php if ($this->timetype=='all') echo 'All reports OT '; else echo 'Report OT '.$this->time; ?> of <?=vendor_html_helper::link($this->fullname, ["ctl"=>"users", "act"=>"view/".$this->user_id])?>
							<?php } else { ?>
								<?php if ($this->timetype=='all') echo 'All reports '; else echo 'Report '.$this->time; ?> of <?=vendor_html_helper::link($this->fullname, ["ctl"=>"users", "act"=>"view/".$this->user_id])?>
							<?php } ?>
						</h3>
					</div>
					<div class="col-sm-6">
						<h3 class="box-title text-info pull-right text-right">
							<?php if($this->timetype!='all') echo 'This '.$this->timetype.', '; ?> <?=vendor_html_helper::link($this->fullname, ["ctl"=>"users", "act"=>"view/".$this->user_id])?> have <?php if( isset($this->OT_time) && $this->OT_time = 'OT_time') echo "OT"; else echo "worked" ?> <strong class="text-danger"><?=$this->timetotal;?></strong> hour(s) </h3>
					</div>
			    </div>
			    <div class="box-body row">
	    			<div class="col-sm-10 col-xs-10">
	    				<div class="row">
							<div class="btn-group btn-toggle col-md-4"> 
								<button type="submit" form="form-report-all" value="Submit" class="btn <?=($this->timetype=='all')? 'btn-danger active':'btn-default';?>">All</button>
							    <button class="btn <?=($this->timetype=='month')? 'btn-danger active':'btn-default';?>">Month</button>
							    <button class="btn <?=($this->timetype=='week')? 'btn-danger active':'btn-default ';?>">Week</button>
							    <button class="btn <?=($this->timetype=='date')? 'btn-danger active':'btn-default ';?>">Date</button>
							</div>


							<form id="form-report-all" 
							    action="<?php if( isset($this->OT_time) && $this->OT_time = 'OT_time') echo vendor_app_util::url(["ctl"=>"reports", "act"=>'user/'.$this->user_id."/OT_time"]); else  echo vendor_app_util::url(["ctl"=>"reports", "act"=>'user/'.$this->user_id]); ?>"
	                             method="post" enctype="multipart/form-data" class="form-inline form-report col-md-8 <?=($this->timetype=='all')? '':'hide';?>">
								<div class="form-group">
			      				</div>
			      			</form>


							  <form id="form-report-month" 
							  		action="<?php if( isset($this->OT_time) && $this->OT_time = 'OT_time') echo vendor_app_util::url(["ctl"=>"reports", "act"=>'user/'.$this->user_id."/OT_time"]); else  echo vendor_app_util::url(["ctl"=>"reports", "act"=>'user/'.$this->user_id]); ?>"
									method="post" enctype="multipart/form-data" class="form-inline form-report col-md-8 <?=($this->timetype=='month')? '':'hide';?>">
								<div class="form-group">
								    <label class="sr-only" for="exampleInputAmount">Select month: </label>
								    <div class="input-group user-input-group">
								      	<div class="input-group-addon mobileHide">Select month: </div>
			      						<input type="month" name="month" class="form-control" id="month" placeholder="Month..." <?=(isset($this->time) && $this->timetype=='month')? 'value="'.$this->time.'"':'';?>>
			      					</div>
			      				</div>
								<button type="submit" class="btn btn-info">Submit</button>
			      			</form>

							<form id="form-report-week" 
								  action="<?php if( isset($this->OT_time) && $this->OT_time = 'OT_time') echo vendor_app_util::url(["ctl"=>"reports", "act"=>'user/'.$this->user_id."/OT_time"]); else  echo vendor_app_util::url(["ctl"=>"reports", "act"=>'user/'.$this->user_id]); ?>"
								  method="post" enctype="multipart/form-data" class="form-inline form-report col-md-8 <?=($this->timetype=='week')? '':'hide';?>">
			                  	<div class="form-group">
				                    <label class="sr-only" for="exampleInputAmount">Select week: </label>
				                    <div class="input-group user-input-group">
				                      	<div class="input-group-addon mobileHide">Select week: </div>
				                      	<input type="week" name="week" class="form-control" id="week" placeholder="Week..." <?=(isset($this->time) && $this->timetype=='week')? 'value="'.$this->time.'"':'';?>>
				                    </div>
			                  	</div>
			                  	<button type="submit" class="btn btn-info">Submit</button>
			                </form>

							  <form id="form-report-date" 
							  		action="<?php if( isset($this->OT_time) && $this->OT_time = 'OT_time') echo vendor_app_util::url(["ctl"=>"reports", "act"=>'user/'.$this->user_id."/OT_time"]); else  echo vendor_app_util::url(["ctl"=>"reports", "act"=>'user/'.$this->user_id]); ?>"
									method="post" enctype="multipart/form-data" class="form-inline form-report col-md-8 <?=($this->timetype=='date')? '':'hide';?>">
								<div class="form-group">
								    <label class="sr-only" for="exampleInputAmount">Select date: </label>
								    <div class="input-group user-input-group">
								      	<div class="input-group-addon mobileHide">Select date: </div>
			      						<input type="date" name="date" class="form-control" id="date" placeholder="Month..." <?=(isset($this->time) && $this->timetype=='date')? 'value="'.$this->time.'"':'';?>>
			      					</div>
			      				</div>
								<button type="submit" class="btn btn-info">Submit</button>
			      			</form>			                
			            </div>
	    			</div>

	    			<div class="col-sm-2 col-xs-2">
	    				<button id="delete-reports" class="btn btn-danger pull-right">
	    					<i class="fa fa-remove"></i>
	    				</button>
	    				<a href="<?php echo vendor_app_util::url(['ctl'=>'reports','act'=>'add']); ?>" id="add-report" type = "button" class="btn btn-primary pull-right" >
	    					<i class="fa fa-plus"></i>
	    				</a>	
	    			</div>
			    </div>
			    <!-- /.box-header -->
			    
				<?php include_once 'views/admin/'.$this->controller.'/_datatable.php';	?>
			    </div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo RootREL; ?>media/admin/js/reports_table.js"></script>
<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>