<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="row" id="records-header">
					<div class="col-sm-8 col-xs-6">
						<?php 
							$monthName = date('F', mktime(0, 0, 0, $this->month, 10));
						?>
						<h2 class="box-title">Settings Time Required in <?= $monthName?> <?= $this->year ?> of Employees</h2>
					</div>
				</div>
			</div>		   
		    <div class="box-body">
		    	<fieldset>
					<form id="form-calculate" action="<?php echo vendor_app_util::url(["ctl"=>"user_month_salaries", "act"=>'month_setting']); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group row user">
							<!-- Ngay -->
							<label class="control-label col-md-3" for="user_id">Day Off (Ngày) :</label>
							<div class="controls col-md-7">
								<select class="form-control select2" name="data[day_off]" id="day_off" >
									<?php 
										for ($i=0; $i <=31 ; $i++) {
											$selected = "";
											if($this->record['day_off']==$i){
												$selected = "selected";
											} 
									?>
									<option <?=$selected?> value="<?= $i?>" ><?= $i?> Ngày</option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<!-- First Name -->
							<label class="control-label col-md-3" for="firstname">Time Riquired (Giờ):</label>
							<div class="controls col-md-7">
								<input readonly id="time_required" type="text" name="data[time_required]" class="form-control" value="<?php if(isset($this->record['time_required'])) echo $this->record['time_required']; ?>">
							</div>
						</div>
						<input type="hidden" id="month" name="data[month]" class="form-control" value="<?php if(isset($this->month)) echo $this->month; ?>">
						<input id="year" type="hidden" name="data[year]" class="form-control" value="<?php if(isset($this->year)) echo $this->year; ?>">
						<div class="form-group row">
							<div class="controls col-md-10 calculate_salary">
								<!-- <input class="btn btn-success pull-right" id="btn_add" type="submit" name="btn_submit" value="<?php echo ucfirst($app['act']) ?>"> -->
								
								<button <?php if(!$this->is_calculate || $this->check) echo "disabled"?> id="calculate_salary" name="btn_submit" id="btn_submit" type="submit" class="btn btn-warning pull-right">
									<i class="fa fa-usd" aria-hidden="true"></i>
									Calculate Salary
								</button>
							</div>
						</div>
				    
					</form>
				</fieldset>
		    </div>
		</div>
	</div>
</div>
<script src="<?php echo RootREL; ?>media/admin/js/month_settings.js"></script>
