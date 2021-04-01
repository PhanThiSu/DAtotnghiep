<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<script type="text/javascript">	
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);
</script>

<?php vendor_html_helper::contentheader('Logs <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border">
		    		<div class="row" id="logs-header">
						<div class="col-sm-8 col-xs-6">
			      			<h2 class="box-title">There are <b><?=$this->noLogs;?></b> logs: <b><?=($this->noSuccessLogs);?></b>  logs success, <b><?=$this->noUnsuccessLogs;?></b> logs unsuccess.</h2>
		    			</div>
		    			<div class="col-sm-4 col-xs-6">
		    				<button id="delete-logs" class="btn btn-danger pull-right">
		    					<i class="fa fa-remove"></i>
		    				</button>	
		    			</div>
		    		</div>
			    </div>
			    <!-- /.box-header -->
			    
			    <div class="box-body">
			    	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
			    		<div class="row">
			    			<div class="col-sm-12">
			    				<table id="table_logs" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th style="width: 30px;">ID</th>
			    							<th style="width: 130px;">Time</th>
			    							<th class="webShow" style="width: 130px;">User</th>
			    							<th class="webShow" style="width: 100px;">Event</th>
			    							<th style="width: 50px;">Status</th>
			    							<th style="width: 100px;">Note</th>
			    							<th style="width: 200px;" class="text-center">Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-logs" class="records">
									<?php if(count($this->records['data'])) { ?>
			    						<!-- rowDATA -->
			    						<?php foreach ($this->records['data'] as $record) { ?>
			    						<tr role="row" id="row<?=$record['id'];?>">
						                  <td id="<?php echo("checkbox".$record['id']);?>" class="checkboxLog">
						                  	<input type="checkbox" name="" alt="<?=$record['id'];?>">
						                  </td>

						                  <td id="<?php echo("id".$record['id']);?>">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"logs", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>">
						                  		<?php echo $record['id']; ?>	
						                  	</a>	
						                  </td>

						                  <td id="<?php echo("name".$record['id']);?>">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"logs", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>">
						                  		<?php echo $record['time']; ?> 
						                  	</a>
						                  </td>

						                  <td id="<?php echo("user_id".$record['id']);?>">
											<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['user_id']])) ?>" id="<?php echo("view".$record['user_id']);?>">
												<?php echo $record['users_firstname']." ".$record['users_lastname']; ?>
						                  	</a>
						                  </td>

						                  <td id="<?php echo("event".$record['id']);?>">
						                  	<?php echo $record['event']; ?>
						                  </td>

						                  <td id="<?php echo("status".$record['id']);?>">
						                  	<?php echo log_model::$status[$record['status']]; ?>
						                  </td>
										  <td>
										  	<?php if(isset($record)){
												if ( $record['event']==log_model::$type['add_report']['name']
													|| $record['event']==log_model::$type['edit_report']['name']
												)
												echo	 "<a href='".RootREL."admin/reports/view/".$record['note']."'".'>Go to page</a>';
												else if ( $record['event']==log_model::$type['add_request']['name']
												)
												echo	 "<a href='".RootREL."admin/requests/view/".$record['note']."'".'>Go to page</a>';
												else if ( $record['event']==log_model::$type['delete_report']['name']
												)
												echo 'User deleted report with id='.$record['note'];
												else echo $record['note'];
											} else {
												echo "";
											}
											?>
										  </td>
						                  <td  class="btn-act text-center" class="pull-right">
						                  	<a href="<?php echo vendor_app_util::url(['ctl'=>'logs', 'act'=>'view', 'params'=>[$record['id']]]) ?>" id="<?php echo("view".$record['id']);?>" type="button" class="btn btn-success view-log">
						                  		<i class="fa fa-eye" aria-hidden="true"></i>
						                  	</a>
									        <button id="del<?php echo $record['id']; ?>" type="button" class="btn btn-danger del-log" alt="<?php echo $record['id']; ?>"><i class="fa fa-remove"></i></button>
						                  </td>
						                </tr>
						                <?php } ?>
						                <!-- rowDATA -->
									<?php } else { ?>
										<tr role="row"><td colspan="7"><h3 class="text-danger text-center"> No data </h3></td></tr>
						            <?php } ?>
			    					</tbody>
			    					<tfoot>
			    						<tr role="row">
			    							<th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th style="width: 30px;">ID</th>
			    							<th style="width: 130px;">Time</th>
			    							<th class="webShow" style="width: 130px;">User</th>
			    							<th class="webShow" style="width: 100px;">Event</th>
			    							<th style="width: 50px;">Status</th>
											<th style="width: 100px;">Note</th>
			    							<th style="width: 200px;" class="text-center">Action</th>
			    						</tr>
					                </tfoot>
			    				</table>
			    			</div>
			    		</div>
			    		<div class="row">
			    			<?php vendor_html_helper::pagination($this->records['norecords'], $this->records['nocurp'], $this->records['curp'], $this->records['nopp']); ?>
			    		</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo RootREL; ?>media/admin/js/logs_table.js"></script>
<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
