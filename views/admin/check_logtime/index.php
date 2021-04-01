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

<?php vendor_html_helper::contentheader('Users <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row" id="records-header">
		    			<div class="col-sm-8 col-xs-6">
			      			<h2 class="box-title">Users</h2>
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
			    							<th style="width: 150px;">User</th>
			    							<th class="webShow" style="width: 200px;">Độ trễ</th>
											<th class="webShow" style="width: 200px;">Note</th>
											<th class="webShow" style="width: 200px;">Log Time</th>
			    							<th class="tabletShow" style="width: 100px;"> 
            									<label class="cbx-label text-success" for="statusCheckboxTop">
            										<input id="statusCheckboxTop"class="statusCheckbox" type="checkbox" <?=(isset($app['prs']['status']) && $app['prs']['status'])? 'checked': '';?> value="<?=$checkboxVal;?>">
            										<span>Xin Phép</span>
            									</label>
            								</th>
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
						                  
						                  <td id="<?php echo("id".$record['id']);?>">
						                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"user/".$record['id']]));?>" id="viewUserReport<?=$record['id'];?>">
						                  		<?=$record['users_firstname'].' '.$record['users_lastname']; ?>	
						                  	</a>	
						                  </td>
						                  <td class="tabletShow" id="<?php echo("lever_time".$record['id']);?>">
										  	<?php  if(($record['lever_time'])==1){ 
												  echo $record['lever_time']." - ( -50k )";
											  }else if(($record['lever_time'])==2){ 
												echo $record['lever_time']." - ( -100k )";
											  }else if(($record['lever_time'])==3){ 
												echo $record['lever_time']." - ( -4h )";
											  }else{
												echo $record['lever_time'];
											  }
											   ?> 
						                  </td>
						                  <td class="webShow" id="<?php echo("avata".$record['id']);?>">
										  	<?php echo $record['note']; ?> 
						                  </td>
						                  <td class="tabletShow" id="<?php echo("role".$record['id']);?>">
						                  	<?php echo $record['created']; ?>
						                  </td>
						                  <td class="tabletShow" id="<?php echo("status".$record['id']);?>">
						                  	<input id="toggle-two" data-on="Có" data-off="Không" class="change-status toggle-two" <?=$record['status']? '': "checked";?> type="checkbox" data-toggle="toggle" data-size="small" alt="<?php echo $record['id'].'&'.$record['status']; ?>" value="ahihi">
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
										<th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th>
			    							<th style="width: 150px;">User</th>
			    							<th class="webShow" style="width: 200px;">Độ trễ</th>
											<th class="webShow" style="width: 200px;">Note</th>
											<th class="webShow" style="width: 200px;">Log Time</th>
			    							<th class="tabletShow" style="width: 100px;"> 
            									<label class="cbx-label text-success" for="statusCheckboxTop">
            										<input id="statusCheckboxTop"class="statusCheckbox" type="checkbox" <?=(isset($app['prs']['status']) && $app['prs']['status'])? 'checked': '';?> value="<?=$checkboxVal;?>">
            										<span>Xin Phép</span>
            									</label>
            								</th>
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
<!-- <script src="<?php echo RootREL; ?>media/admin/js/records_table.js"></script> -->
<script src="<?php echo RootREL; ?>media/admin/js/users_table.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap-toggle.min.js"></script>
<!-- /.box -->
<script>
$(document).ready(function () {
		// click status
		$('tbody.records input.change-status').change(function() {
			idAct = $(this).attr('alt');
			idAct = idAct.split('&');
			changeStatus(idAct[0], "trash",idAct[1]);
			// alert('ahihi')
		});

		function changeStatus(id, act, status) { 
			urlTrash = rootUrl+"admin/check_logtime/changestatus/"+ id;
			$.ajax({
				url: urlTrash,
				type: 'POST',
				data: {status: status},
				success: function (data) {
					if(data != 'error') {
						
					}
				}
			
			});
		}

		$('#toggle-two').bootstrapToggle({
			on: 'a',
			off: 'v'
		});
})

</script>

<script>
  $(function() {

  })
</script>


<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
