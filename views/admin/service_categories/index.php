<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<script type="text/javascript">	
	var norecords 	= parseInt(<?php echo $this->service_categories['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->service_categories['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->service_categories['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->service_categories['nopp']; ?>);
</script>

<?php vendor_html_helper::contentheader('Service Categories <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row">
		    			<div class="col-sm-8">
			      			<h2 class="box-title">List of service_categories</h2>
		    			</div>

		    			<div class="col-sm-4">
		    				<button id="delete-service_categories" class="btn btn-danger pull-right">
		    					<i class="fa fa-trash-o"></i>
		    				</button>
		    				<a href="<?php echo vendor_app_util::url(['ctl'=>'service_categories','act'=>'add']); ?>" id="add-service_category" type = "button" class="btn btn-primary pull-right" >
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
			    				<table id="table_service_categories" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th style="width: 50px;">Name</th>
			    							<th style="width: 100px;">Image</th>
			    							<th style="width: 50px;">Status</th>
			    							<th style="width: 50px;">Date Create</th>
			    							<th style="width: 50px;">Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-service_categories">
			    						<!-- rowDATA -->
			    						<?php foreach ($this->service_categories['data'] as $service_category) { ?>
			    						<tr role="row" id="row<?=$service_category['id'];?>">
						                  <td id="<?php echo("checkbox".$service_category['id']);?>" class="checkboxServiceCategory">
						                  	<input type="checkbox" name="" alt="<?=$service_category['id'];?>">
						                  </td>
						                  <td id="<?php echo("name".$service_category['id']);?>">
						                  	<a href="<?php echo vendor_app_util::url([
						                  		'ctl'=>'services', 
						                  		'act'=>'incategory', 
						                  		'params'=>['category_id'=>$service_category['id']]]); ?>"
						                  	>
								              	<?php echo $service_category['name']; ?><br/>
								              	<i><?php echo $service_category['slug']; ?></i>
								            </a>
						                  </td>
						                  <td id="<?php echo("image".$service_category['id']);?>">
						                  	<img style="width:150px" src="<?=UploadURI.$app['ctl'].'/'.(($service_category['image'])? $service_category['image']: 'no_picture.png'); ?>">
						                  </td>
						                  <td id="<?php echo("status".$service_category['id']);?>">
						                  	<?php echo service_category_model::$status[$service_category['status']]; ?>
						                  </td>
						                  <td id="<?php echo("created".$service_category['id']);?>">
						                  	<?php echo $service_category['created']; ?>
						                  </td>
						                  <td  class="btn-act" class="pull-right">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"service_categories", "act"=>"view/".$service_category['id']])) ?>" id="<?php echo("view".$service_category['id']);?>" type="button" class="btn btn-success view-service_category">
						                  		<i class="fa fa-search-plus" aria-hidden="true"></i>
						                  	</a>
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"service_categories", "act"=>"edit/".$service_category['id']])) ?>" id="<?php echo("edit".$service_category['id']);?>" type="button" class="btn btn-primary edit-service_category">
						                  		<i class="fa fa-pencil"></i>
						                  	</a>
						                  	<button id="<?php echo("dele".$service_category['id']);?>" type="button" class="btn btn-danger dele-service_category" alt="<?=$service_category['id'];?>">
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
					                		<th rowspan="1" colspan="1">Status</th>
					                		<th rowspan="1" colspan="1">Date created</th>
					                		<th rowspan="1" colspan="1">Action</th>
					                	</tr>
					                </tfoot>
			    				</table>
			    			</div>
			    		</div>

			    		<div class="row">
			    			<?php vendor_html_helper::pagination($this->service_categories['norecords'], $this->service_categories['nocurp'], $this->service_categories['curp'], $this->service_categories['nopp']); ?>
			    		</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</section>

<script src="<?php echo RootREL; ?>media/admin/js/service_categories_table.js"></script>
<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
