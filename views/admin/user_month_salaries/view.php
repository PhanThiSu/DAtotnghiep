<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-toggle.min.css">
<?php 
global $app;
?>
<script type="text/javascript">	
	var norecords 	= parseInt(<?php echo $this->records['norecords']; ?>);
	var nocurp 		= parseInt(<?php echo $this->records['nocurp']; ?>);
	var curp 		= parseInt(<?php echo $this->records['curp']; ?>);
	var nopp 		= parseInt(<?php echo $this->records['nopp']; ?>);
	var month       =parseInt(<?php  echo $this->month; ?>);
	var year        =parseInt(<?php	 echo $this->year; ?>);
</script>

<?php vendor_html_helper::contentheader('User Month Salaries <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row" id="records-header">
		    			<div class="col-sm-8 col-xs-6">
                            <?php 
                                $monthName = date('F', mktime(0, 0, 0, $this->month, 10));
                            ?>
			      			<h2 class="box-title">List Salaries in <?= $monthName?> <?= $this->year ?> of Employees</h2>
		    			</div>

		    			<!-- <div class="col-sm-4 col-xs-6">
		    				<button id="delete-records" class="btn btn-danger pull-right">
		    					<i class="fa fa-remove"></i>
		    				</button>
		    				<a href="<?php echo vendor_app_util::url(['ctl'=>'user_level_salaries','act'=>'add']); ?>" id="add-record" type = "button" class="btn btn-primary pull-right" >
		    					<i class="fa fa-plus"></i>
		    				</a>	
		    			</div> -->
		    		</div>
			    </div>
			    <!-- /.box-header -->
			    
			    <div class="box-body">
			    	<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
			    		<div class="row">
			    			<div class="col-sm-12">
			    				<table controller="user_month_salaries" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby = "example1_info">
			    					<thead>
			    						<tr role="row">
			    							<!-- <th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th> -->
			    							<th style="width: 10px;">STT</th>
			    							<th class="tabletShow" style="width: 200px;">Informations</th>
			    							<th class="" style="width: 300px;">Work Time VP <?php echo $this->time_required; ?>h</th>
											<th class="" style="width: 300px;">Work Time OT </th>
											<th class="" style="width: 200px;">Check Time</th>
			    							<th class="tabletShow" style="width: 200px;">Basic Salary</th>
			    							<th class="webShow" style="width: 150px;">Bonus</th>
			    							<th class="webShow" style="width: 150px;">Salary</th>
			    							<!-- <th class="webShow" style="width: 150px;">Status</th> -->
											<th class="tabletShow" style="width: 100px;"> 
            									<label class="cbx-label text-success" for="statusCheckboxTop">
													<?php 
														$setting_id = isset($this->records['data'][0]['user_month_settings_id'])?$this->records['data'][0]['user_month_settings_id']:0;
														$checked = ($this->isPaidAll)?"checked":"";
													?>
            										<input id="checkboxPayedTop"class="statusCheckbox" <?=$checked?> type="checkbox" alt="<?=$setting_id?>">
            										<span>Paid All</span>
            									</label>
            								</th>
			    							<th style="width: 200px;">Action</th>
			    						</tr>
			    					</thead>
			    					<tbody id="tbody-user_month_salaries" class="records">
									<?php if(count($this->records['data'])) { ?>
			    						<!-- rowDATA -->
                                        <?php
                                            $index = 0; 
                                            foreach ($this->records['data'] as $record) { $index++;?>
			    						<tr role="row" id="row<?=$record['id'];?>">
						                  	<td id="stt-<?=$index?>">
						                  		<p><?=$index?></p>
						                  	</td>
						                  	<td class="tabletShow" id="<?php echo("email".$record['id']);?>">
											  	FullName: <br>
												  	<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"view/".$record['id']])) ?>" id="viewUser<?=$record['id'];?>">
													  &nbsp;&nbsp;&nbsp;&nbsp;<?=$record['firstname'].' '.$record['lastname']; ?>
						                  			</a>
						                  		<br>
						                  		Email: <br>
												  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $record['email']; ?> 
						                  		<br>
						                  		Phone: <br> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $record['phone']; ?>
						                 	</td>
											<td class="" id="<?php echo("work_time".$record['user_id']);?>">
												VP: <?=$record['work_time'];?>(h) <br>
												Lunch: <?=$record['lunch'];?>(vnd) <br>
												<span class="text-danger">
													total: <?=number_format($record['salary_VP'],0);?>(vnd) 
												</span>
											</td>
											<td class="" id="<?php echo("work_time".$record['user_id']);?>">
												<span class="text-danger">
													HS: <?=$record['coefficientOT'];?> <br>
												</span>
												OT: <?=$record['timeOT'];?>(h) <br>
												OTNN: <?=$record['timeOTNN'];?>(h) <br>
												<span class="text-danger">
													total: <?= number_format($record['salaryOT'],0);?>(vnd) 
												</span>
											</td>
											<td class="" id="<?php echo("work_time".$record['user_id']);?>">
												lv1: <?=$record['lvTime2'];?> (-50k) <br>
												lv2: <?=$record['lvTime3'];?> (-100k) <br>
												lv3: <?=$record['lvTime4'];?> (-4h)  <br>
												<span class="text-danger">
													total: -<?=number_format($record['checkTime'],0);?>(vnd)
												</span>
											</td>
											<td class="tabletShow" id="<?php echo("basic_salary".$record['user_id']);?>">
												<?= number_format($record['basic_salary']);?> VND
											</td>
											<td class="webShow" id="<?php echo("bonus".$record['user_id']);?>">
												<!-- <?= number_format($record['bonus']); ?> VND -->
												<button type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="<?=$record['bonus_description']?>"><?= number_format($record['bonus']); ?> VND</button>
											</td>
											<td class="webShow" id="<?php echo("salary".$record['user_id']);?>">
												<span class="text-danger">
													<strong><?= number_format($record['salaryTotal']); ?> VND</strong>
												</span>
											</td>
											<td class="tabletShow" id="<?php echo("status".$record['user_month_salary_id']);?>">
						                  		<input id="trash<?php echo $record['user_month_salary_id']; ?>" class="change-status" <?=$record['status_payment']? 'checked': "";?> type="checkbox" data-toggle="toggle" data-size="small" data-on="Paid" data-off="Unpaid" alt="<?php echo $record['user_month_salary_id'].'&'.$record['status_payment']; ?>">
						                  	</td>
											<td  class="btn-act" class="pull-right">
												<a href="<?php echo (vendor_app_util::url(["ctl"=>"user_month_salaries", "act"=>"edit/".$record['user_month_salary_id']])) ?>" id="<?php echo("edit".$record['id']);?>" type="button" class="btn btn-primary edit-record">
													<i class="fa fa-edit"></i>
												</a>
												<!-- <button id="del<?php echo $record['id']; ?>" type="button" class="btn btn-danger del-record" alt="<?php echo $record['id']; ?>"><i class="fa fa-remove"></i></button> -->
						                  	</td>
						                </tr>
						                <?php } ?>
						                <!-- rowDATA -->
									<?php } else { ?>
										<tr role="row"><td colspan="8"><h3 class="text-danger text-center"> No data </h3></td></tr>
						            <?php } ?>
			    					</tbody>
			    					<tfoot>
									<tr role="row">
			    							<!-- <th id="checAllTop" class="checkAll" style="width: 10px;">
			    								<input type="checkbox" name="">
			    							</th> -->
			    							<th style="width: 10px;">STT</th>
			    							<th class="tabletShow" style="width: 250px;">Informations</th>
			    							<th class="" style="width: 200px;">Work Time</th>
			    							<th class="tabletShow" style="width: 200px;">Basic Salary</th>
			    							<th class="webShow" style="width: 150px;">Bonus</th>
			    							<th class="webShow" style="width: 150px;">Salary</th>
			    							<!-- <th class="webShow" style="width: 150px;">Status</th> -->
											<th class="tabletShow" style="width: 100px;"> 
            									<label class="cbx-label text-success" for="statusCheckboxTop">
													<?php 
														$setting_id = isset($this->records['data'][0]['user_month_settings_id'])?$this->records['data'][0]['user_month_settings_id']:0;
														$checked = ($this->isPaidAll)?"checked":"";
													?>
            										<input id="checkboxPayedTop"class="statusCheckbox" <?=$checked?> type="checkbox" alt="<?=$setting_id?>">
            										<span>Paid All</span>
            									</label>
            								</th>
			    							<th style="width: 200px;">Action</th>
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
			</div>
		</div>
	</div>
</section>



<script src="<?php echo RootREL; ?>media/bootstrap/js/checkbox-x.min.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/records_table.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/month_salaries.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap-toggle.min.js"></script>
<!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
