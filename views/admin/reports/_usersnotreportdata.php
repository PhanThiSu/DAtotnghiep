<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
		<div class="row">
			<div class="col-sm-12">
				<table id="table_reports" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info" controller="reports" >
					<thead>
						<tr role="row">
							<th style="width: 20px;">User ID</th>
							<th style="width: 200px;">Fullname</th>
						</tr>
					</thead>
					<tbody id="tbody-reports">
					<?php if(count($this->records['data'])) { ?>
						<!-- rowDATA -->
						<?php foreach ($this->records['data'] as $record) { ?>
						<tr role="row" id="row<?=$record['id'];?>">
		                  <td id="<?php echo("id".$record['id']);?>">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>">
		                  		<?php echo $record['id']; ?>
		                  	</a>	
		                  </td>
		                  <td id="<?php echo("fullname".$record['id']);?>">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"user/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>">
		                  		<?php echo $record['firstname']." ".$record['lastname']; ?> 
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
							<th style="width: 20px;">User ID</th>
							<th style="width: 200px;">Fullname</th>
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