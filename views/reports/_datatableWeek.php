<div class="box-body">
	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
		<div class="row">
			<div class="col-sm-12">
				<table id="table_reports" class=" table_week table-responsive table table-bordered table-striped dataTableFonend" role = "grid" aria-describedby = "example1_info" controller="reports" >
					<thead>
						<tr role="row">
							<th style="min-width: 200px"><p class="tb-week-name" > Groupt - Job</p> </th>
							<?php for ($i=1; $i<=7 ; $i++) { ?>
								<th style="">
									<div class="tb-week">
										<div class="left">
											<p><?= $this->weekDays['dayNumber'][$i]?></p>
										</div>
										<div class="right">
											<p><?= $this->weekDays['dayText'][$i] ?></p>
											<p><?= $this->weekDays['month'][$i]?></p>
										</div>
									
									</div>
								</th>
							<?php } ?>
							<th style="width: 100px;">
								<div class="tb-week-total"><p>Total</p></div>
							</th>
						</tr>
					</thead>
          <tbody id="tbody-reports" class="records">
					<?php if(count($this->records)) { ?>
						<!-- rowDATA -->
						<?php foreach ($this->records['data'] as $record) { ?>
						<tr role="row" id="">
              <td id="nameGroup-Job">
                <h3><?= $record['groups_name'] ?></h3>
                <h4><?= $record['job'] ?></h4>
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