<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="row" id="records-header">
					<div class="col-sm-8 col-xs-6">
						<?php 
							$monthName = date('F', mktime(0, 0, 0, $this->month, 10));
						?>
						<h2 class="box-title">Add bonus in <?= $monthName?> <?= $this->year ?> for <?=$this->fullname?></h2>
					</div>
				</div>
			</div>		   
		    <div class="box-body">
		    	<fieldset>
					<form id="form-calculate" action="<?php echo vendor_app_util::url(["ctl"=>"user_month_salaries", "act"=>'edit/'.$this->record['id']]); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
						
						<div class="form-group row">
							<!-- Bonus -->
							<label class="control-label col-md-3" for="bonus">Bonus (VND):</label>
							<div class="controls col-md-7">
								<input <?php if($app['act']=='view') echo "disabled"; ?> id="bonus" type="number" min="0" step="50000" pattern="(d{3})([.])(d{2})" name="data[bonus]" class="form-control" value="<?php if(isset($this->record['bonus'])) echo $this->record['bonus']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<!-- Bonus -->
							<label class="control-label col-md-3" for="bonus">HS OT:</label>
							<div class="controls col-md-7">
								<input <?php if($app['act']=='view') echo "disabled"; ?> id="bonus" type="number" min="0" step="0.1" max="2" pattern="(d{3})([.])(d{2})" name="data[coefficientOT]" class="form-control" value="<?php if(isset($this->record['coefficientOT'])) echo $this->record['bonus']; ?>">
							</div>
						</div>
						<div class="form-group row">
							<!-- Description -->
							<label class="control-label col-md-3" for="bonus_description">Description:</label>
							<div class="controls col-md-7">
								<textarea <?php if($app['act']=='view') echo "disabled"; ?> id="job" name="data[bonus_description]" placeholder="Bonus Description.." class="form-control" ><?php if(isset($this->record['bonus_description'])) echo($this->record['bonus_description']); ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="controls col-md-10 calculate_salary">
								<button id="add_bonus"" name="btn_submit" id="btn_submit" type="submit" class="btn btn-success pull-right">
									<!-- <i class="fa fa-usd" aria-hidden="true"></i> -->
									Add Bonus
								</button>
							</div>
						</div>
				    
					</form>
				</fieldset>
		    </div>
		</div>
	</div>
</div>

