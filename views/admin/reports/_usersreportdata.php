<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
		<div class="row">
			<div class="col-sm-12">
				<table id="table_reports" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info" controller="reports" >
					<thead>
						<tr role="row">
							<th style="width: 20px;">User ID</th>
							<th style="width: 200px;">Fullname</th>
							<th style="width: 120px;">Work Time</th>
							<th style="width: 150px;">Actions</th>
						</tr>
					</thead>
					<tbody id="tbody-reports">
					<?php if(count($this->records['data'])) { ?>
						<!-- rowDATA -->
						<?php foreach ($this->records['data'] as $record) { ?>
						<tr role="row" id="row<?=$record['user_id'];?>">
						  <td id="<?php echo("id".$record['user_id']);?>">
							<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['user_id']])) ?>" id="<?php echo("view".$record['user_id']);?>">
								<?php echo $record['user_id']; ?>
							</a>
		                  </td>
						  <td id="<?php echo("fullname".$record['user_id']);?>">
						  	<?php if ($app['act'] == "usersOTreport") { ?>
								<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"user/".$record['user_id']."/OT_time"])) ?>" id="<?php echo("view".$record['user_id']);?>">
									<?php echo $record['users_firstname']." ".$record['users_lastname']; ?> 
								</a>
							<?php } else { ?>
								<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"user/".$record['user_id']])) ?>" id="<?php echo("view".$record['user_id']);?>">
									<?php echo $record['users_firstname']." ".$record['users_lastname']; ?> 
								</a>
							<?php } ?>
		                  </td>
		                  <td id="<?php echo("total".$record['user_id']);?>">
		                  	<?php echo $record['total']; ?>
		                  </td>
		                  <td  class="btn-act" class="pull-right">
		                  	<?php if($this->timetype=='week') { ?>
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"userdays/".$record['user_id']])) ?>" id="userdays<?=$record['user_id'];?>" type="button" class="btn btn-success view-user-times">
		                  		<i class="fa fa-user" aria-hidden="true"></i>
		                  	</a>
		                  	<?php } elseif ( $this->timetype == 'date') { ?>
							
							<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"userreports/".$record['user_id'].'/date='.$this->time ])) ?>" type="button" class="btn btn-success view-user-times">
		                  		<i class="fa fa-user" aria-hidden="true"></i>
		                  	</a>

							  <?php } elseif ($app['act'] == "usersOTreport") { ?>
								<a href="<?php echo (vendor_app_util::url(["ctl"=>"calendar/time=".$this->time."/user_id=".$record['user_id']."/OT_time"])) ?>" id="<?php echo("view".$record['user_id']);?>" type="button" class="btn btn-success view-record">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</a>
							<?php } else { ?>
								<a href="<?php echo (vendor_app_util::url(["ctl"=>"calendar/time=".$this->time."/user_id=".$record['user_id']])) ?>" id="<?php echo("view".$record['user_id']);?>" type="button" class="btn btn-success view-record">
									<i class="fa fa-calendar" aria-hidden="true"></i>
								</a>
		                  	<?php } ?>
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
							<th style="width: 20px;">User ID</th>
							<th style="width: 200px;">Fullname</th>
							<th style="width: 120px;">Work Time</th>
							<th style="width: 150px;">Actions</th>
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

<script src="<?php echo RootREL; ?>media/admin/js/usersreport.js"></script>