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

<?php vendor_html_helper::contentheader('Quản lý <small>người dùng</small>', [['urlp'=>['ctl'=>"", 'act'=>"Danh sách người dùng"]]]); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row" id="records-header">
		    			<div class="col-sm-8 col-xs-6">
			      			<!-- <h2 class="box-title">Users</h2> -->
		    			</div>

		    			<div class="col-sm-4 col-xs-6">
							<button id="delete-records" class="btn btn-danger pull-right"> 
									<i class="fa fa-remove"></i>
								</button>
		    				<a href="#" id="add-record" type = "button" class="btn btn-primary pull-right" >
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
			    				<table controller="users" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th style="width: 20px;">ID</th>
			    							<th style="width: 150px;">Tên người dùng</th>
			    							<th class="tabletShow" style="width: 200px;">Email - Số điện thoại</th>
			    							<th class="webShow" style="width: 200px;">Ảnh đại diện</th>
			    							<th class="tabletShow" style="width: 100px;">Quyền</th>
			    							<th class="tabletShow" style="width: 120px;"> 
            									<label class="cbx-label text-success" for="statusCheckboxTop">
            										<input id="statusCheckboxTop"class="statusCheckbox" type="checkbox" <?=(isset($app['prs']['status']) && $app['prs']['status'])? 'checked': '';?> value="<?=$checkboxVal;?>">
            										<span>Trạng thái</span>
            									</label>
            								</th>
			    							<th style="width: 180px;">Hoạt động</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-users" class="records">
									<?php if(count($this->records['data'])) { ?>
			    						<!-- rowDATA -->
			    						<?php foreach ($this->records['data'] as $record) { ?>
			    						<tr role="row" id="row<?=$record['id'];?>">
						                  <td id="<?php echo("checkbox".$record['id']);?>" class="checkboxRecord">
						                  	<input type="checkbox" name="" alt="<?=$record['id'];?>">
						                  </td>
						                  <td id="<?php echo("fullname".$record['id']);?>">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['id']])) ?>" id="viewUser<?=$record['id'];?>">
						                  		<?php echo $record['id']; ?>	
						                  	</a>	
						                  </td>
						                  <td id="<?php echo("id".$record['id']);?>">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['id']]));?>" id="viewUserReport<?=$record['id'];?>">
						                  		<?=$record['firstname'].' '.$record['lastname']; ?>	
						                  	</a>	
						                  </td>
						                  <td class="tabletShow" id="<?php echo("email".$record['id']);?>">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['id']])) ?>" id="viewUserRequest<?=$record['id'];?>">
						                  		Email: <?php echo $record['email']; ?> 
						                  	</a>
						                  	<br>
						                  	Số điện thoại: <?php echo $record['phone']; ?>
						                  </td>
						                  <td class="webShow" id="<?php echo("avata".$record['id']);?>">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['id']])) ?>" id="avataViewUser<?=$record['id'];?>">
						                  		<img style="width:150px" src="<?=UploadURI.$app['ctl'].'/'.(($record['avata'])? $record['avata']: 'no_picture.png'); ?>">
						                  	</a>
						                  </td>
						                  <td class="tabletShow" id="<?php echo("role".$record['id']);?>">
						                  	<?php echo $app['roles'][$record['role']]; ?>
						                  </td>
						                  <td class="tabletShow" id="<?php echo("status".$record['id']);?>">
						                  	<input id="trash<?php echo $record['id']; ?>" class="change-status" <?=$record['status']? 'checked': "";?> type="checkbox" data-toggle="toggle" data-size="small" alt="<?php echo $record['id'].'&'.$record['status']; ?>">
						                  </td>
						                  <td  class="btn-act" class="pull-right">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"edit/".$record['id']])) ?>" id="<?php echo("edit".$record['id']);?>" type="button" class="btn btn-primary edit-record">
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
					                		<th>Tên người dùng</th>
					                		<th class="tabletShow">Email - Số điện thoại</th>
					                		<th class="webShow">Ảnh địa diện</th>
					                		<th class="tabletShow" >Quyền</th>
					                		<th class="tabletShow" >
            									<label class="cbx-label text-success" for="statusCheckboxBottom">
            										<input id="statusCheckboxBottom"class="statusCheckbox" type="checkbox" <?=(isset($app['prs']['status']) && $app['prs']['status'])? 'checked': '';?> value="<?=$checkboxVal;?>">
            										<span>Trạng thái</span>
            									</label>
            								 </th>
					                		<th rowspan="1" colspan="1">Hoạt động</th>
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
<script src="<?php echo RootREL; ?>media/admin/js/users_table.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap-toggle.min.js"></script>
<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
