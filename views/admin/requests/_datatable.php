<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
		<!--div class="row">
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
		</div-->

		<div class="row">
			<div class="col-sm-12">
				<table id="table_requests" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info" controller="requests" >
					<thead>
						<tr role="row">
							<th id="checAllTop" class="checkAll smallMobileHide" style="width: 10px;">
								<input type="checkbox" name="">
							</th>
							<th class="mobileHide">ID</th>
							<th><span class="mobileHide">Full</span>Name</th>
							<th class="mobileHide">Start time</th>
							<th class="mobileHide">End time</th>
							<th class="mobileShow">Off time</th>
							<th class="webShow">Reason</th>
							<th class="webShow">Date request</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody id="tbody-requests" class="records">
					<?php if(count($this->records['data'])) { ?>
						<!-- rowDATA -->
						<?php foreach ($this->records['data'] as $record) { ?>
						<tr role="row" id="row<?=$record['id'];?>">
		                  <td id="<?php echo("checkbox".$record['id']);?>" class="checkboxRecord smallMobileHide">
		                  	<input type="checkbox" name="" alt="<?=$record['id'];?>">
		                  </td>
		                  <td id="<?php echo("id".$record['id']);?>" class="mobileHide">
		                  	<a href="<?=(vendor_app_util::url(["ctl"=>"requests", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>">
		                  		<?=$record['id']; ?>
		                  	</a>	
		                  </td>
		                  <td id="<?php echo("fullname".$record['id']);?>">
		                  	<a href="<?=(vendor_app_util::url(["ctl"=>"requests", "act"=>"user/".$record['user_id']])) ?>" id="<?php echo("view".$record['id']);?>">
		                  		<?=$record['users_firstname']." ".$record['users_lastname']; ?> 
		                  	</a>
		                  </td>
		                  <td class="mobileHide" id="<?php echo("datetime_start".$record['id']);?>">
		                  	<?=$record['datetime_start']; ?>
		                  </td>
		                  <td class="mobileHide" id="<?php echo("datetime_end".$record['id']);?>">
		                  	<?=$record['datetime_end']; ?>
		                  </td>
		                  <td class="mobileShow" id="<?php echo("offtime".$record['id']);?>">
		                  	<?=$record['datetime_start']; ?> <br>
		                  	<strong class="text-danger"> to </strong><?=$record['datetime_end']; ?> 
		                  </td>
		                  <td class="webShow" id="<?php echo("reason".$record['id']);?>">
		                  	<?=$record['reason']; ?>
		                  </td>
		                  <td class="webShow" id="<?php echo("dateRequest".$record['id']);?>">
		                  	<?=$record['created']; ?>
		                  </td>
		                  <td id="<?php echo("status".$record['id']);?>">
		                  	<?php 
		                  	$arrChecks = ['','',''];
		                  	$arrChecks[$record['status']] = 'checked="checked"';
		                  	?>
		                  	<div class="radio-wrapper" recordid="<?=$record['id'];?>">
							  <label for="yes_radio_<?=$record['id'];?>" class="yes-lbl" id="yes-lbl-<?=$record['id'];?>">Y</label>
							  <input type="radio" value="" name="choice_radio_<?=$record['id'];?>" class="yes_radio" id="yes_radio_<?=$record['id'];?>" <?=$arrChecks[1]; ?> >

							  <label for="maybe_radio_<?=$record['id'];?>" class="maybe-lbl" id="maybe-lbl-<?=$record['id'];?>" class="disabled" disabled>?</label>
							  <input type="radio" value="" name="choice_radio_<?=$record['id'];?>" id="maybe_radio_<?=$record['id'];?>" <?=$arrChecks[0]; ?> disabled>

							  <label for="no_radio_<?=$record['id'];?>" class="no-lbl" id="no-lbl-<?=$record['id'];?>">N</label>
							  <input type="radio" value="" name="choice_radio_<?=$record['id'];?>" class="no_radio" id="no_radio_<?=$record['id'];?>" <?=$arrChecks[2]; ?>>
							  <div class="status-toggle"></div>
							</div>
		                  </td>
		                  <td  class="btn-act" class="pull-right">
		                  	<a href="<?=(vendor_app_util::url(["ctl"=>"requests", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>" type="button" class="btn btn-success view-record">
		                  		<i class="fa fa-eye" aria-hidden="true"></i>
		                  	</a>
					        
		                  	<a href="<?=(vendor_app_util::url(["ctl"=>"requests", "act"=>"edit/".$record['id']])) ?>" id="<?php echo("edit".$record['id']);?>" type="button" class="btn btn-primary edit-record">
		                  		<i class="fa fa-edit"></i>
		                  	</a>

					        <button id="del<?=$record['id']; ?>" type="button" class="btn btn-danger del-record" alt="<?=$record['id']; ?>"><i class="fa fa-remove"></i></button>
		                  </td>
		                </tr>
		                <?php } ?>
		                <!-- rowDATA -->
					<?php } else { ?>
						<tr role="row"><td colspan="9"><h3 class="text-danger text-center"> No data </h3></td></tr>
		            <?php } ?>
					</tbody>
					<tfoot>
	                	<tr>
	                		<th rowspan="1" colspan="1" id="checkAllBottom" class="checkAll smallMobileHide" style="width: 10px;">
								<input type="checkbox" name="">
							</th>
	                		<th class="mobileHide">ID</th>
							<th><span class="mobileHide">Full</span>Name</th>
							<th class="mobileHide">Start time</th>
							<th class="mobileHide">End time</th>
							<th class="mobileShow">Off time</th>
							<th class="webShow">Reason</th>
							<th class="webShow">Date request</th>
							<th>Status</th>
	                		<th>Action</th>
	                	</tr>
	                </tfoot>
				</table>
			</div>
		</div>

		<div class="row">
			<?php vendor_html_helper::pagination($this->records['norecords'], $this->records['nocurp'], $this->records['curp'], $this->records['nopp']); 
			?>
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
<script src="<?=RootREL; ?>media/admin/js/requests_table.js"></script>