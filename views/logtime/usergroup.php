<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<script type="text/javascript">
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);
</script>

<?php vendor_html_helper::contentheader('Reports <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border row" id="reports-header">
					<div class="col-sm-6">
						<h3 class="box-title">
							<?php if($this->timetype!='all') echo 'Report '.$this->time; else echo 'All reports ';?> of <?= $this->fullname ?><?php
							if (isset($this->groupName)) echo ' in '.vendor_html_helper::link($this->groupName, ["ctl"=>"leader_groups", "act"=>"view/".$this->group_id]); ?>
						</h3>
					</div>
					<div class="col-sm-6">
						<h3 class="box-title text-info pull-right text-right"> <?php if($this->timetype=='all') echo 'All tasks, '; else echo 'This '.$this->timetype?> <?= $this->fullname ?> have worked <strong class="text-danger"><?=$this->timetotal;?></strong> hour(s)</h3>
					</div>
			    </div>
			    <div class="box-body row">
	    			<div class="col-sm-10 col-xs-10">
	    				<div class="row">

							<form id="form-report-all" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>'usergroup/id_group='.$this->group_id.'/id_user='.$this->user_id]); ?>" method="post" enctype="multipart/form-data" class="form-inline form-report col-md-8 <?=($this->timetype=='all')? '':'hide';?>">
								<div class="form-group">
			      				</div>
			      			</form>

							<form id="form-report-year" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>'usergroup/id_group='.$this->group_id.'/id_user='.$this->user_id]); ?>" method="post" enctype="multipart/form-data" class="form-inline form-report col-md-8 <?=($this->timetype=='year')? '':'hide';?>">
								<div class="form-group">
								    <label class="sr-only" for="exampleInputAmount">Select year: </label>
								    <div class="input-group user-input-group">
								      	<div class="input-group-addon mobileHide">Select year: </div>
			      						<input type="year" name="year" class="form-control" id="year" placeholder="<?=date("Y");?>" <?=(isset($this->time) && $this->timetype=='year')? 'value="'.$this->time.'"':'';?>>
			      					</div>
			      				</div>
								<button type="submit" class="btn btn-info">Submit</button>
			      			</form>

			      			<form id="form-report-month" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>'usergroup/id_group='.$this->group_id.'/id_user='.$this->user_id]); ?>" method="post" enctype="multipart/form-data" class="form-inline form-report col-md-8 <?=($this->timetype=='month')? '':'hide';?>">
								<div class="form-group">
								    <label class="sr-only" for="exampleInputAmount">Select month: </label>
								    <div class="input-group user-input-group">
								      	<div class="input-group-addon mobileHide">Select month: </div>
			      						<input type="month" name="month" class="form-control" id="month" placeholder="Month..." <?=(isset($this->time) && $this->timetype=='month')? 'value="'.$this->time.'"':'';?>>
			      					</div>
			      				</div>
								<button type="submit" class="btn btn-info">Submit</button>
			      			</form>

			                <form id="form-report-week" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>'usergroup/id_group='.$this->group_id.'/id_user='.$this->user_id]); ?>" method="post" enctype="multipart/form-data" class="form-inline form-report col-md-8 <?=($this->timetype=='week')? '':'hide';?>">
			                  	<div class="form-group">
				                    <label class="sr-only" for="exampleInputAmount">Select week: </label>
				                    <div class="input-group user-input-group">
				                      	<div class="input-group-addon mobileHide">Select week: </div>
				                      	<input type="week" name="week" class="form-control" id="week" placeholder="Week..." <?=(isset($this->time) && $this->timetype=='week')? 'value="'.$this->time.'"':'';?>>
				                    </div>
			                  	</div>
			                  	<button type="submit" class="btn btn-info">Submit</button>
			                </form>

			      			<form id="form-report-date" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>'usergroup/id_group='.$this->group_id.'/id_user='.$this->user_id]); ?>" method="post" enctype="multipart/form-data" class="form-inline form-report col-md-8 <?=($this->timetype=='date')? '':'hide';?>">
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

			    </div>
			    <!-- /.box-header -->
			    
				<?php include_once 'views/'.$this->controller.'/_datatable.php';	?>
			    </div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo RootREL; ?>media/admin/js/reports_table.js"></script>
<!-- /.box -->
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
