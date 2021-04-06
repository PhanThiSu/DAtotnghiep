<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
		<div class="row">
			<!--div class="col-sm-6">
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
			</div-->
		</div>

		<div class="row">
			<div class="col-sm-12">
				<table id="table_reports" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info" controller="reports" >
					<thead>
						<tr role="row">
							<th id="checAllTop" class="checkAll" style="width: 10px;">
								<input type="checkbox" name="">
							</th>
							<th style="width: 20px;">ID</th>
							<th style="width: 200px;">Tên người dùng</th>
							<th class="mobileHide" style="width: 100px;">Bắt đầu - Kết thúc</th>
							<th style="width: 120px;">Thời gian làm việc</th>
							<th class="mobileHide" style="width: 150px;">Công việc</th>
							<th class="webShow" style="width: 150px;">Nhóm</th>
							<th class="webShow" style="width: 150px;">Ngày báo cáo</th>
							<th style="width: 210px;">Hành động</th>
						</tr>
					</thead>
					<tbody id="tbody-reports" class="records">
					<?php if(count($this->records['data'])) { ?>
						<!-- rowDATA -->
						<?php foreach ($this->records['data'] as $record) { ?>
						<tr role="row" id="row<?=$record['id'];?>">
		                  <td id="<?php echo("checkbox".$record['id']);?>" class="checkboxRecord">
		                  	<input type="checkbox" name="" alt="<?=$record['id'];?>">
		                  </td>
		                  <td id="<?php echo("id".$record['id']);?>">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>">
		                  		<?php echo $record['id']; ?>
		                  	</a>	
		                  </td>
		                  <td id="<?php echo("fullname".$record['id']);?>">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"user/".$record['user_id']])) ?>" id="<?php echo("view".$record['id']);?>">
		                  		<?php echo $record['users_firstname']." ".$record['users_lastname']; ?> 
		                  	</a>
		                  </td>
		                  <td class="mobileHide" id="<?php echo("time_start".$record['id']);?>">
		                  	<?php echo $record['time_start']; ?><br><br>
		                  	<?php echo $record['time_end']; ?>
		                  </td>
		                  <td id="<?php echo("work_time".$record['id']);?>">
		                  	<span class="mobileShow"><?php echo $record['time_start']; ?></span>
		                  	<span class="mobileShow">Duration: </span><?php echo $record['work_time']; ?> hour(s)
		                  </td>
		                  <td class="mobileHide" id="<?php echo("job".$record['id']);?>">
		                  	<?php echo $record['job']; ?>
		                  </td>
		                  <td class="webShow" id="<?php echo("group".$record['id']);?>">
		                  	<?php echo $record['groups_name']; ?>
		                  </td>
		                  <td class="webShow" id="<?php echo("date_report".$record['id']);?>">
		                  	<?php echo $record['date_report']; ?>
		                  </td>
		                  <td  class="btn-act" class="pull-right">
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"view/".$record['id']])) ?>" id="<?php echo("view".$record['id']);?>" type="button" class="btn btn-success view-record">
		                  		<i class="fa fa-eye" aria-hidden="true"></i>
		                  	</a>
					        
		                  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"edit/".$record['id']])) ?>" id="<?php echo("edit".$record['id']);?>" type="button" class="btn btn-primary edit-record">
		                  		<i class="fa fa-edit"></i>
		                  	</a>

					        <button id="del<?php echo $record['id']; ?>" type="button" class="btn btn-danger del-record" alt="<?php echo $record['id']; ?>"><i class="fa fa-remove"></i></button>
		                  </td>
		                </tr>
		                <?php } ?>
		                <!-- rowDATA -->
					<?php } else { ?>
						<tr role="row"><td colspan="9"><h3 class="text-danger text-center"> No data </h3></td></tr>
		            <?php } ?>
					</tbody>
					<tfoot>
					<tr role="row">
							<th id="checAllTop" class="checkAll" style="width: 10px;">
								<input type="checkbox" name="">
							</th>
							<th style="width: 20px;">ID</th>
							<th style="width: 200px;">Tên người dùng</th>
							<th class="mobileHide" style="width: 100px;">Bắt đầu-Kết thúc</th>
							<th style="width: 120px;">Thời gian làm việc</th>
							<th class="mobileHide" style="width: 150px;">Công việc</th>
							<th class="webShow" style="width: 150px;">Nhóm</th>
							<th class="webShow" style="width: 150px;">Ngày báo cáo</th>
							<th style="width: 210px;">Hành động</th>
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

<script src="<?php echo RootREL; ?>media/admin/js/records_table.js"></script>
<!-- /.box -->