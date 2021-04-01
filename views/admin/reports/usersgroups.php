<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css"><link rel="stylesheet" href="<?php echo RootREL; ?>media/select2/select2.min.css">
<script> var data = [], labels=[];  </script>
<?php vendor_html_helper::contentheader('reports <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border row id="reports-header">
					<div class="col-sm-6">
						<?php 
							$spn="";
							foreach ($this->groups as $group) { 
								if ($this->group_id==$group['id']) {
									$spn = $group['name'];
								}
							} 
						?>
						<h3 class="box-title">
							Users report in <a href="<?php echo vendor_app_util::url(['ctl'=>'groups','act'=>'view/'.$this->group['id']]); ?>"><?=$spn?> </a> group
						</h3>
					</div>
					<div class="col-sm-6">
						<h3 class="box-title text-info pull-right text-right">In <a href="<?php echo vendor_app_util::url(['ctl'=>'groups','act'=>'view/'.$this->group['id']]); ?>"><?=$spn;?></a> have total work time is <strong class="text-danger"><?=($this->group['group_time'])?$this->group['group_time']:0;?></strong> hour(s)</h3>
					</div>
			    </div>
			    <div class="box-body row">
	    			<div class="col-sm-9 col-xs-9">
		      			<form id="form-report" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>'usersgroups']); ?>" method="post" enctype="multipart/form-data" class="form-inline">
							<div class="form-group">
							    <label class="sr-only" for="exampleInputAmount">Select group: </label>
							    <div class="input-group">
							      	<div class="input-group-addon mobileHide">Select group: </div>
								      	<select name="group_id" id="group_id" class="form-control select2">
								      		<?php foreach ($this->groups as $group) { ?>
												<option value="<?=$group['id'];?>" <?=($this->group_id==$group['id'])? 'selected="selected"':'';?>><?=$group['name'];?></option>
											<?php } ?>
										</select>
		      						</select>
		      					</div>
		      				</div>
							<button type="submit" class="btn btn-info" name="btn_submit">Submit</button>
		      			</form>
	    			</div>

	    			<div class="col-sm-3 col-xs-3">
	    				
	    				<a href="<?php echo vendor_app_util::url(['ctl'=>'reports','act'=>'add']); ?>" id="add-report" type = "button" class="btn btn-primary pull-right" >
	    					<i class="fa fa-plus"></i>
	    				</a>	
	    			</div>
	    		</div>
		    	<!-- /.box-header -->

			    <div class="box-body">
					<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
						<div class="row">
							<div class="col-sm-6">
								<canvas id="myChart" width="100%" height="100%"></canvas>
							</div>
							<div class="col-sm-6">
								<table id="table_reports" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby="example1_info" controller="reports" >
									<thead>
										<tr role="row">
											<th>Fullname</th>
											<th>Total Time</th>
											<th>Percent</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="tbody-reports">
									
									<?php if($this->records && $this->records->num_rows) { ?>
										<?php $i=1; ?>
						                <?php foreach($this->records as $record) { ?>
						                	<tr>
												<td><?=$record['users_firstname'].' '.$record['users_lastname']; ?></td>
												<td><?=$record['total']; ?></td>
												<td><?=100*round(($record['total']/$this->group['group_time']), 4); ?></td>
												<td>
													<a type="button" class="btn btn-success view-record month" href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'usergroup/id_group='.$this->group['id'].'/id_user='.$record['user_id'])); ?>"><i class="fa fa-eye" aria-hidden="true"></i>
													</a>
												</td>
												<script> 
													data.push(<?=$record['total'];?>);
													labels.push("<?=$record['users_firstname'].' '.$record['users_lastname']; ?>");
												</script>
						                	</tr>
											<?php $i++; ?>
						                <?php } ?>
						            <?php } else { ?>
										<tr role="row"><td colspan="3"><h3 class="text-danger text-center"> No data </h3></td></tr>
						            <?php } ?>
									</tbody>
									<tfoot>
					                	<tr>
											<th>Fullname</th>
											<th>Total Time</th>
											<th>Percent</th>
											<th>Action</th>
					                	</tr>
					                </tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo RootREL; ?>media/select2/select2.full.min.js"></script>
<script src="<?php echo RootREL; ?>media/chartjs/Chart.min.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/usersgroups.js"></script>
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
