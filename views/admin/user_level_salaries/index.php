<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-toggle.min.css">
<?php 
global $app;
?>
<script type="text/javascript">	
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);
</script>

<?php vendor_html_helper::contentheader('User Level Salaries <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row" id="records-header">
		    			<div class="col-sm-8 col-xs-6">
			      			<h2 class="box-title">User Level Salaries</h2>
		    			</div>

		    			<div class="col-sm-4 col-xs-6">
		    				<button id="delete-records" class="btn btn-danger pull-right">
		    					<i class="fa fa-remove"></i>
		    				</button>
		    				<a href="<?php echo vendor_app_util::url(['ctl'=>'user_level_salaries','act'=>'add']); ?>" id="add-record" type = "button" class="btn btn-primary pull-right" >
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
			    				<table controller="user_level_salaries" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th style="width: 20px;">STT</th>
			    							<th class="tabletShow" style="width: 250px;">Informations</th>
			    							<th class="webShow" style="width: 150px;">Avata</th>
			    							<th class="tabletShow" style="width: 100px;">Date Start</th>
			    							<th class="tabletShow" style="width: 100px;">Date End</th>
			    							<th class="tabletShow" style="width: 150px;">Basic Salary</th>
			    							<th style="width: 200px;">Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-user_level_salaries" class="records">
									<?php if(count($this->records['data'])) { ?>
			    						<!-- rowDATA -->
										<?php 
										$index = 0;
										foreach ($this->records['data'] as $record) { $index++;?>
			    						<tr role="row" id="row<?=$record['id'];?>">
											<td id="<?php echo("checkbox".$record['id']);?>" class="checkboxRecord">
												<input type="checkbox" name="" alt="<?=$record['id'];?>">
											</td>
											<td id="stt-<?=$index?>">
												<p><?=$index?></p>
											</td>
											<td class="tabletShow" id="<?php echo("email".$record['id']);?>">
											  	FullName: 
												  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"user_level_salaries", "act"=>"view/".$record['id']])) ?>" id="viewUser<?=$record['id'];?>">
						                  		 		<?=$record['users_firstname'].' '.$record['users_lastname']; ?>
						                  			</a>
						                  		<br>
						                  		Email: <?php echo $record['users_email']; ?> 
						                  		<br>
						                  		Phone: <?php echo $record['users_phone']; ?>
						                 	</td>
											<td class="webShow" id="<?php echo("avata".$record['user_id']);?>">
												<a href="<?php echo (vendor_app_util::url(["ctl"=>"user_level_salaries", "act"=>"view/".$record['id']])) ?>" id="avataViewUser<?=$record['id'];?>">
													<img style="width:150px" src="<?=UploadURI.'users'.'/'.(($record['users_avata'])? $record['users_avata']: 'no_picture.png'); ?>">
												</a>
											</td>
											<td><?= date('d-m-Y',strtotime($record['start']))?></td>
											<td><?= date('d-m-Y',strtotime($record['end']))?></td>
											<td class="webShow" id="<?php echo("avata".$record['user_id']);?>">
												<span class="text-danger">
													<strong><?=number_format($record['basic_salary']); ?> VND</strong>
												</span>
											</td>
											<td  class="btn-act" class="pull-right">
												<a href="<?php echo (vendor_app_util::url(["ctl"=>"user_level_salaries", "act"=>"edit/".$record['id']])) ?>" id="<?php echo("edit".$record['id']);?>" type="button" class="btn btn-primary edit-record">
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
					                		<th>ID</th>
					                		<th class="tabletShow">Informations</th>
					                		<th class="webShow">Avata</th>
			    							<th class="tabletShow" >Date Start</th>
			    							<th class="tabletShow" >Date End</th>
                                            <th class="tabletShow" >Basic Salary</th>

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
<!-- <script src="<?php echo RootREL; ?>media/admin/js/users_table.js"></script> -->
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap-toggle.min.js"></script>
<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
