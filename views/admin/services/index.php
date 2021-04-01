<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<script type="text/javascript">	
	var norecords 	= parseInt(<?php echo $this->services['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->services['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->services['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->services['nopp']; ?>);
</script>

<?php vendor_html_helper::contentheader('Services <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row">
		    			<div class="col-sm-8">
			      			<h2 class="box-title">List of services</h2>
		    			</div>

		    			<div class="col-sm-4">
		    				<button id="delete-services" class="btn btn-danger pull-right">
		    					<i class="fa fa-trash-o"></i>
		    				</button>
		    				<a href="<?php echo vendor_app_util::url(['ctl'=>'services','act'=>'add']); ?>" id="add-service" type = "button" class="btn btn-primary pull-right" >
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
			    				<table id="table_services" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th style="width: 50px;">Name</th>
			    							<th style="width: 100px;">Image</th>
			    							<th style="width: 100px;">Category</th>
			    							<th style="width: 50px;">Status</th>
			    							<th style="width: 50px;">Date Create</th>
			    							<th style="width: 50px;">Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-services">
			    						<!-- rowDATA -->
			    						<?php foreach ($this->services['data'] as $service) { ?>
			    						<tr role="row" id="row<?=$service['id'];?>">
						                  <td id="<?php echo("checkbox".$service['id']);?>" class="checkboxService">
						                  	<input type="checkbox" name="" alt="<?=$service['id'];?>">
						                  </td>
						                  <td id="<?php echo("name".$service['id']);?>">
						                  	<?php echo $service['name']; ?><br/>
						                  	<i><?php echo $service['slug']; ?></i>
						                  </td>
						                  <td id="<?php echo("image".$service['id']);?>">
						                  	<img style="width:150px" src="<?=UploadURI.$app['ctl'].'/'.(($service['image'])? $service['image']: 'no_picture.png'); ?>">
						                  </td>
						                  <td id="<?php echo("category".$service['id']);?>">
						                  	<?php echo $service['service_categories_name']; ?>
						                  </td>
						                  <td id="<?php echo("status".$service['id']);?>">
						                  	<?php echo service_model::$status[$service['status']]; ?>
						                  </td>
						                  <td id="<?php echo("created".$service['id']);?>">
						                  	<?php echo $service['created']; ?>
						                  </td>
						                  <td  class="btn-act" class="pull-right">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"services", "act"=>"view/".$service['id']])) ?>" id="<?php echo("view".$service['id']);?>" type="button" class="btn btn-success view-service">
						                  		<i class="fa fa-search-plus" aria-hidden="true"></i>
						                  	</a>
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"services", "act"=>"edit/".$service['id']])) ?>" id="<?php echo("edit".$service['id']);?>" type="button" class="btn btn-primary edit-service">
						                  		<i class="fa fa-pencil"></i>
						                  	</a>
						                  	<button id="<?php echo("dele".$service['id']);?>" type="button" class="btn btn-danger dele-service" alt="<?=$service['id'];?>">
						                  		<i class="fa fa-trash-o"></i>
						                  	</button>
						                  </td>
						                </tr>
						                <?php } ?>
						                <!-- rowDATA -->
			    					</tbody>
			    					<tfoot>
					                	<tr>
					                		<th rowspan="1" colspan="1" id="checkAllBottom" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
					                		<th rowspan="1" colspan="1">Name</th>
					                		<th rowspan="1" colspan="1">Image</th>
			    							<th rowspan="1" colspan="1">Category</th>
					                		<th rowspan="1" colspan="1">Status</th>
					                		<th rowspan="1" colspan="1">Date created</th>
					                		<th rowspan="1" colspan="1">Action</th>
					                	</tr>
					                </tfoot>
			    				</table>
			    			</div>
			    		</div>

			    		<div class="row">
			    			<?php vendor_html_helper::pagination($this->services['norecords'], $this->services['nocurp'], $this->services['curp'], $this->services['nopp']); ?>
			    		</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo RootREL; ?>media/admin/js/services_table.js"></script>
<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
