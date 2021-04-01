<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<script type="text/javascript">	
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);
</script>

<?php vendor_html_helper::contentheader('Groups <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border">
		    		<div class="row" id="groups-header">
		    			<div class="col-sm-8 col-xs-6">
			      			<h2 class="box-title">There are <?=$this->noSuggestionGroups;?> suggestion groups, <?=($this->noGroups-$this->noUseGroups);?> unuse group in <?=$this->noGroups;?> groups</h2>
		    			</div>

		    			<div class="col-sm-4 col-xs-6">
		    				<button id="delete-groups" class="btn btn-danger pull-right">
		    					<i class="fa fa-remove"></i>
		    				</button>
		    				<a href="<?php echo vendor_app_util::url(['ctl'=>'groups','act'=>'add']); ?>" id="add-group" type = "button" class="btn btn-primary pull-right" >
		    					<i class="fa fa-plus"></i>
		    				</a>	
		    			</div>
		    		</div>
			    </div>
			    <!-- /.box-header -->
			    
			    <div class="box-body">
			    	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
			    		<div class="row">
			    			<div class="col-sm-6">
			    				<div class="dataTables_length" id="example1_length">
			    					<label>
			    						Show
			    						<select name="example1_length" aria-controls = "example1" class="form-control input-sm">
			    							<option value="5">5</option>
			    							<option value="10">10</option>
			    							<option value="25">25</option>
			    							<option value="50">50</option>
			    							<option value="100">100</option>
			    						</select>
			    						entries
			    					</label>
			    				</div>
			    			</div>
			    			<div class="col-sm-6">
			    				<div id="table_filter" class="pull-right">
			    					<label>Search:
			    						<div class="input-group">
										    <input type="text" class="form-control input-sm" aria-controls="example1" placeholder="Search">
										    <div class="input-group-btn">
										      <button id="submit-search" class="btn btn-default btn-sm">
										        <i class="glyphicon glyphicon-search"></i>
										      </button>
										    </div>
										</div>
			    					</label>
			    				</div>
			    			</div>
			    		</div>

			    		<div class="row">
			    			<div class="col-sm-12">
			    				<table id="table_groups" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th style="width: 20px;">ID</th>
			    							<th style="width: 150px;">Name</th>
			    							<th class="webShow" style="width: 100px;">Start date</th>
			    							<th class="webShow" style="width: 100px;">End date</th>
			    							<th style="width: 100px;">Status</th>
											<th style="width: 100px;">User created</th>
			    							<th style="width: 120px;">Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-groups" class="records">
									<?php if(count($this->records['data'])) { ?>
			    						<!-- rowDATA -->
			    						<?php foreach ($this->records['data'] as $record) { ?>
			    						<tr role="row" id="row<?=$record['id'];?>">
						                  <td id="<?php echo("checkbox".$record['id']);?>" class="checkboxGroup">
						                  	<input type="checkbox" name="" alt="<?=$record['id'];?>">
						                  </td>

						                  <td id="<?php echo("id".$record['id']);?>">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"groups", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>">
						                  		<?php echo $record['id']; ?>	
						                  	</a>	
						                  </td>

						                  <td id="<?php echo("name".$record['id']);?>">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"groups", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>">
						                  		<?php echo $record['name']; ?> 
						                  	</a>
						                  </td>

						                  <td id="<?php echo("start_day".$record['id']);?>">
						                  	<?php echo $record['start_day']; ?>
						                  </td>

						                  <td id="<?php echo("end_day".$record['id']);?>">
						                  	<?php echo $record['end_day']; ?>
						                  </td>

						                  <td id="<?php echo("status".$record['id']);?>">
						                  	<?php echo group_model::$status[$record['status']]; ?>
						                  </td>
										  <td id="<?php echo("status".$record['id']);?>">
										  	   <?php echo $record['users_firstname']; ?> <?php echo $record['users_lastname']; ?>
						                  </td>
						                  <td  class="btn-act" class="pull-right">
						                  	<a href="<?php echo vendor_app_util::url(['ctl'=>'groups', 'act'=>'view', 'params'=>[$record['id']]]) ?>" id="<?php echo("view".$record['id']);?>" type="button" class="btn btn-success view-group">
						                  		<i class="fa fa-eye" aria-hidden="true"></i>
						                  	</a>
									        
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"groups", "act"=>"edit/".$record['id']])) ?>" id="<?php echo("edit".$record['id']);?>" type="button" class="btn btn-primary edit-group">
						                  		<i class="fa fa-edit"></i>
						                  	</a>

									        <button id="del<?php echo $record['id']; ?>" type="button" class="btn btn-danger del-group" alt="<?php echo $record['id']; ?>"><i class="fa fa-remove"></i></button>
						                  </td>
						                </tr>
						                <?php } ?>
						                <!-- rowDATA -->
									<?php } else { ?>
										<tr role="row"><td colspan="7"><h3 class="text-danger text-center"> No data </h3></td></tr>
						            <?php } ?>
			    					</tbody>
			    					<tfoot>
					                	<tr>
					                		<th rowspan="1" colspan="1" id="checkAllBottom" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
					                		<th>ID</th>
					                		<th>Name</th>
			    							<th class="webShow" style="width: 100px;">Start date</th>
			    							<th class="webShow" style="width: 100px;">End date</th>
					                		<th>Status</th>
											<th style="width: 100px;">User created</th>
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

<script src="<?php echo RootREL; ?>media/admin/js/groups_table.js"></script>
<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
