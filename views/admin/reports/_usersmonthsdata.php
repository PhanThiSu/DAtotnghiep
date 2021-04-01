<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
		<div class="row">
			<div class="col-sm-12 table-responsive">
				<table id="table_reports" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info" controller="reports" >
					<thead>
						<tr role="row">
							<th style="width: 200px;">User</th>
		                <?php for($i=0;$i<12;$i++) { ?>
							<th style="width: 60px;">
								 <a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"usersreport/year=".$this->time.'/month='.($i+1)])) ?>"> <?=$app['months'][$i]; ?></a> 
							</th>
		                <?php } ?>
							<th style="width: 100px;">Actions</th>
						</tr>
					</thead>
					<tbody id="tbody-reports">
					<?php if(count($this->records['data'])) { ?>
						<?php global $app; ?>
						<!-- rowDATA -->
						<?php foreach ($this->records['data'] as $record) { ?>
						<tr role="row" id="row<?=$record['user_id'];?>">
		                  <td id="<?php echo("id".$record['user_id']);?>">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['user_id']])) ?>" id="<?php echo("view".$record['user_id']);?>">
		                  		<?=$record['users_firstname']." ".$record['users_lastname']; ?>
		                  	</a>	
		                  </td>
		                <?php for($i=0;$i<12;$i++) { ?>
		                  <td id="total<?=$app['months'][$i].$record['user_id'];?>">
		                  	<?=$record[$app['months'][$i]]; ?>
		                  </td>
		                <?php } ?>
		                  <td  class="btn-act" class="pull-right">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"usermonths/".$record['user_id']])) ?>" id="usermonths<?=$record['user_id'];?>" type="button" class="btn btn-success view-record">
		                  		<i class="fa fa-user" aria-hidden="true"></i>
		                  	</a>
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"userreports/".$record['user_id']])) ?>" id="view<?=$record['user_id'];?>" type="button" class="btn btn-success view-record">
		                  		<i class="fa fa-list" aria-hidden="true"></i>
		                  	</a>
		                  </td>
		                </tr>
		                <?php } ?>
		                <!-- rowDATA -->
					<?php } else { ?>
						<tr role="row"><td colspan="4"><h3 class="text-danger text-center"> No data </h3></td></tr>
		            <?php } ?>
					</tbody>
					<tfoot>
	                	<tr>
							<th style="width: 200px;">User</th>
		                <?php for($i=0;$i<12;$i++) { ?>
							<th style="width: 60px;">
								<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"usersreport/".$this->time.'/'.($i+1)])) ?>"> <?=$app['months'][$i]; ?></a> 
							</th>
		                <?php } ?>
							<th style="width: 100px;">Actions</th>
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
