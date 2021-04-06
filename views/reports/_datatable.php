<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
		<div class="row">
			<div class="col-sm-12">
				<table id="table_reports" class="table table-bordered table-striped dataTableFonend" role = "grid" aria-describedby = "example1_info" controller="reports" >
					<thead>
						<tr role="row">
							<th id="checAllTop" class="checkAll" style="width: 10px;">
								<input type="checkbox" name="">
							</th>
							<th style="width: 170px;">Bắt đầu-Kết thúc</th>
							<th style="width: 120px;">Thời gian làm việc</th>
							<th class="webShow" style="width: 200px;">Công việc</th>
							<th class="webShow" style="width: 150px;">Nhóm</th>
							<th class="webShow" style="width: 150px;">Ngày báo cáo</th>
							<th style="width: 200px;">Hoạt động</th>
						</tr>
					</thead>
					<tbody id="tbody-reports" class="records">
					<?php if(count($this->records['data'])) { ?>
						<!-- rowDATA -->
						<?php foreach ($this->records['data'] as $record) { ?>
						<tr role="row" id="row<?=$record['id'];?>">
		                  <td id="<?php echo("checkbox".$record['id']);?>" class="checkboxreport">
		                  	<input type="checkbox" name="" alt="<?=$record['id'];?>">
		                  </td>
		                  <td id="<?php echo("time_start".$record['id']);?>">
		                  	<?php echo $record['time_start']; ?> <br>
		                  	<?php echo $record['time_end']; ?>
		                  </td>
		                  <td id="<?php echo("work_time".$record['id']);?>">
		                  	<?php echo $record['work_time']; ?>
		                  </td>
		                  <td class="webShow" id="<?php echo("job".$record['id']);?>">
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
		                  <?php $d = new DateTime($record['time_start']); ?>
										
											<?php if($d->format('Y-m-d') == date('Y-m-d')) { ?>
															<a href="<?php echo (vendor_app_util::url(["ctl"=>"reports", "act"=>"edit/".$record['id']])) ?>" id="<?php echo("edit".$record['id']);?>" type="button" class="btn btn-primary edit-record">
																<i class="fa fa-edit"></i>
															</a>
														<button id="del<?php echo $record['id']; ?>" type="button" class="btn btn-danger del-record" alt="<?php echo $record['id']; ?>"><i class="fa fa-remove"></i></button>
											<?php } ?>
		                  </td>
		                </tr>
		                <?php } ?>
					<?php } else { ?>
						<tr role="row"><td colspan="9"><h3 class="text-danger text-center"> Rỗng !!! </h3></td></tr>
		            <?php } ?>
		                <!-- rowDATA -->
					</tbody>
					<tfoot>
					<tr role="row">
						<th id="checAllTop" class="checkAll" style="width: 10px;">
								<input type="checkbox" name="">
							</th>
							<th style="width: 170px;">Bắt đầu-Kết thúc</th>
							<th style="width: 120px;">Thời gian làm việc</th>
							<th class="webShow" style="width: 200px;">Công việc</th>
							<th class="webShow" style="width: 150px;">Nhóm</th>
							<th class="webShow" style="width: 150px;">Ngày báo cáo</th>
							<th style="width: 200px;">Hoạt động</th>
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

<script src="<?php echo RootREL; ?>media/js/records_table.js"></script>
<!-- /.box -->