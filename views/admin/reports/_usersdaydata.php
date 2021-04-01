<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
		<div class="row">
			<div class="col-sm-12">
				<table id="table_reports" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info" controller="reports" >
					<thead>
						<tr role="row">
							<th style="width: 200px;">User</th>
							<th style="width: 100px;"><?=$this->time; ?></th>
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
		                  <td id="total<?=$record['user_id'];?>">
		                  	<?=$record['d']; ?>
		                  </td>
		                  <td  class="btn-act" class="pull-right">
		                  	<!-- <a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"userdays/".$record['user_id']])) ?>" id="userdays<?=$record['user_id'];?>" type="button" class="btn btn-success view-user-times">
		                  		<i class="fa fa-user" aria-hidden="true"></i>
		                  	</a> -->
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"userreports/".$record['user_id'].'/date='.$this->time ])) ?>" id="view<?=$record['user_id'];?>" type="button" class="btn btn-success view-record">
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
							<th style="width: 100px;"><?=$this->time; ?></th>
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

<script src="<?php echo RootREL; ?>media/admin/js/usersdays.js"></script>