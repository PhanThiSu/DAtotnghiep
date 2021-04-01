<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/checkbox-x.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-toggle.min.css">
<?php 
global $app;
if(isset($app['prs']['status'])) {
	if($app['prs']['status'])
		$checkboxVal = 1;
	else
		$checkboxVal = NULL;
} else 	$checkboxVal = 0;
?>
<script type="text/javascript">	
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);

	var getDisable  = <?=(isset($app['prs']['status']) && ($app['prs']['status']==='0'))? 1:0;?>
</script>

<?php vendor_html_helper::contentheader('Holidays <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row" id="records-header">
		    			<div class="col-sm-8 col-xs-6">
			      			<h2 class="box-title">Holidays</h2>
		    			</div>

		    			<div class="col-sm-4 col-xs-6">
							<button id="delete-records" class="btn btn-danger pull-right">
									<i class="fa fa-remove"></i>
								</button>
		    				<a href="<?php echo vendor_app_util::url(['ctl'=>'holidays','act'=>'add']); ?>" id="add-record" type = "button" class="btn btn-primary pull-right" >
		    					<i class="fa fa-plus"></i>
		    				</a>	
		    			</div>
		    		</div>
			    </div>
			    <!-- /.box-header -->
			    
			    <div class="box-body">
			    	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
			    		<div class="row">
			    			<div class="col-sm-12">
			    				<table controller="holidays" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th style="width: 20px;">Stt</th>
			    							<th class="" style="width:200px"  >Day</th>
											<th class="" style="width:auto" >Note</th>
			    							<th style="width: 200px;">Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-Holidays" class="records">
									<?php if(count($this->records['data'])) { ?>
			    						<!-- rowDATA -->
			    						<?php foreach ($this->records['data'] as $key => $record) { ?>
			    						<tr role="row" id="row<?=$record['id'];?>">
						                  <td id="<?php echo("checkbox".$record['id']);?>" class="checkboxRecord">
						                  	<input type="checkbox" name="" alt="<?=$record['id'];?>">
						                  </td>
						                  <td id="<?php echo("fullname".$record['id']);?>">
												  <?php echo $key+1; ?>	
						                  </td>
						                  <td id="<?php echo("id".$record['id']);?>">
						                  		<?=$record['day'] ?>	
						                  </td>
										  <td id="<?php echo("id".$record['id']);?>">
						                  		<?=$record['note'] ?>	
						                  </td>
						                 
						                  <td  class="btn-act" class="pull-right">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"holidays	", "act"=>"edit/".$record['id']])) ?>" id="<?php echo("edit".$record['id']);?>" type="button" class="btn btn-primary edit-record">
						                  		<i class="fa fa-edit"></i>
						                  	</a>
									        <button id="del<?php echo $record['id']; ?>" type="button" class="btn btn-danger del-record" alt="<?php echo $record['id']; ?>"><i class="fa fa-remove"></i></button>
						                  </td>
						                </tr>
						                <?php } ?>
						                <!-- rowDATA -->
									<?php } else { ?>
										<tr role="row"><td colspan="8"><h3 class="text-danger text-center"> No data </h3></td></tr>
						            <?php } ?>
			    					</tbody>
			    					<tfoot>
					                	<tr>
					                		<th rowspan="1" colspan="1" id="checkAllBottom" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
					                		<th>Stt</th>
					                		<th>Day</th>
					                		<th >Note</th>
					                		<th rowspan="1" colspan="1">Action</th>
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

<script src="<?php echo RootREL; ?>media/bootstrap/js/checkbox-x.min.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/records_table.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/Holidays_table.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap-toggle.min.js"></script>
<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
