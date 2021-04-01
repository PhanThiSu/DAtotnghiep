<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
		<div class="row">
			<div class="col-sm-12 table-responsive">
				<table id="table_reports" class="table_week table-responsive table table-bordered table-striped dataTable " role = "grid" aria-describedby = "example1_info" controller="reports" >
					<thead>
						<tr role="row">
							<th style="width: 200px;">User</th>
		                <?php for($i=0;$i<7;$i++) { ?>
							<th style="width: 100px;">
								<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"usersreport/dayofweek=".$this->time."-".($i+1)])) ?>"> <?=$app['weekdays'][$i]; ?></a>
							</th>
						<?php } ?>
							<th style="width: 100px;">ToTal</th>
							<th style="width: 100px;">Actions</th>
						</tr>
					</thead>
					<tbody id="tbody-reports">
					<?php if(count($this->records['data'])) { ?>
						<?php global $app; ?>
						  
						  <!-- rowDATA -->
						<?php foreach ($this->records['data'] as $record) { ?>
						<tr role="row" id="">
						<td id="<?php echo("id".$record['user_id']);?>">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['user_id']])) ?>" id="<?php echo("view".$record['user_id']);?>">
		                  		<?=$record['users_firstname']." ".$record['users_lastname']; ?>
		                  	</a>	
		                  </td>
							<td class="center" >
								<?php echo $record['Monday']; ?>
							</td>
							<td class="center">
								<?php echo $record['Tuesday']; ?>
							</td>
							<td class="center" >
								<?php echo $record['Wednesday']; ?>
							</td>
							<td class="center" >
								<?php echo $record['Thursday']; ?>
							</td>
							<td class="center" >
								<?php echo $record['Friday']; ?>
							</td>
							<td class="center"> 
								<?php echo $record['Saturday']; ?>
							</td>
							<td class="center" >
								<?php echo $record['Sunday']; ?>
							</td>
							<td class="center total" >
								<?php echo $record['Total']; ?>
							</td>
							<td  class="btn-act" class="pull-right">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"userdays/".$record['user_id']])) ?>" id="userdays<?=$record['user_id'];?>" type="button" class="btn btn-success view-user-times">
		                  		<i class="fa fa-user" aria-hidden="true"></i>
		                  	</a>
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"userreports/".$record['user_id']])) ?>" id="view<?=$record['user_id'];?>" type="button" class="btn btn-success view-record">
		                  		<i class="fa fa-list" aria-hidden="true"></i>
		                  	</a>
		                  </td>
							</tr>
							<?php } ?>
					<?php } else { ?>
						<tr role="row"><td colspan="9"><h3 class="text-danger text-center"> No data </h3></td></tr>
		            <?php } ?>
						<!-- rowDATA -->

					</tbody>
					<tfoot>
						<tr role="row">
						
						<th class="center" ><h3>All Groups</h3></th>
						<th class="center" ><?= $this->recordTotal['Monday'] ?></th>
						<th class="center" ><?= $this->recordTotal['Tuesday'] ?></th>
						<th class="center" ><?= $this->recordTotal['Wednesday'] ?></th>
						<th class="center" ><?= $this->recordTotal['Thursday'] ?></th>
						<th class="center" ><?= $this->recordTotal['Friday'] ?></th>
						<th class="center" ><?= $this->recordTotal['Saturday'] ?></th>
						<th class="center" ><?= $this->recordTotal['Sunday'] ?></th>
						<th class="center" ><?= $this->recordTotal['Total'] ?>(h)</th>
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

<script src="<?php echo RootREL; ?>media/admin/js/usersdays.js"></script>