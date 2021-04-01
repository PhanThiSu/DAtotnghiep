<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">

		<div class="row">
			<div class="col-sm-12">
				<table id="table_requests" class="table table-bordered table-striped dataTableFonend dataTable" role = "grid" aria-describedby = "example1_info" controller="requests" >
					<thead>
						<tr role="row">
							<th id="checAllTop" class="checkAll" style="width: 10px;">
								<input type="checkbox" name="">
							</th>
							<th style="width: 20px;">ID</th>
							<th style="width: 150px;">Fullname</th>
							<th style="width: 200px;">Start time</th>
							<th style="width: 200px;">End time</th>
							<th class="webShow" style="width: 200px;">Reason</th>
							<th class="webShow" style="width: 200px;">Date request</th>
							<!-- <th style="width: 140px;">Status</th> -->
							<th style="width: 200px;">Action</th>
						</tr>
					</thead>
					<tbody id="tbody-requests" class="records">
					<?php if(count($this->records['data'])) { ?>
						<!-- rowDATA -->
						<?php foreach ($this->records['data'] as $record) { ?>
						<tr role="row" id="row<?=$record['id'];?>">
		                  <td id="<?php echo("checkbox".$record['id']);?>" class="checkboxRecord">
		                  	<input type="checkbox" name="" alt="<?=$record['id'];?>">
		                  </td>
		                  <td id="<?php echo("id".$record['id']);?>">
		                  		<?php echo $record['id']; ?>
		                  </td>
		                  <td id="<?php echo("fullname".$record['id']);?>">
		                  		<?php echo $record['users_firstname']." ".$record['users_lastname']; ?> 
		                  </td>
		                  <td id="<?php echo("datetime_start".$record['id']);?>">
		                  	<?php echo $record['datetime_start']; ?>
		                  </td>
		                  <td id="<?php echo("datetime_end".$record['id']);?>">
		                  	<?php echo $record['datetime_end']; ?>
		                  </td>
		                  <td class="webShow" id="<?php echo("reason".$record['id']);?>">
		                  	<?php echo $record['reason']; ?>
		                  </td>
		                  <td class="webShow" id="<?php echo("dateRequest".$record['id']);?>">
		                  	<?php echo $record['created']; ?>
		                  </td>

		                  <td  class="btn-act" class="pull-right">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"requests", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>" type="button" class="btn btn-success view-record">
		                  		<i class="fa fa-eye" aria-hidden="true"></i>
		                  	</a>
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
							<th style="width: 200px;">Fullname</th>
							<th style="width: 120px;">Start time</th>
							<th style="width: 120px;">End time</th>
							<th class="webShow" style="width: 300px;">Reason</th>
							<th class="webShow" style="width: 120px;">Date request</th>
							<!-- <th style="width: 140px;">Status</th> -->
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

<div class="modal modal-success fade" id="modal-success">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Success!</h4>
      </div>
      <div class="modal-body">
        <p>Update status success!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal modal-danger fade" id="modal-danger">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Error</h4>
      </div>
      <div class="modal-body">
        <p>Can't update status!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-outline">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script src="<?=RootREL; ?>media/admin/js/records_table.js"></script>
<script src="<?php echo RootREL; ?>media/js/records_table.js"></script>
<!-- <script src="<?php //echo RootREL; ?>media/admin/js/requests_table.js"></script> -->