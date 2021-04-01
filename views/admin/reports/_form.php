<link rel="stylesheet" href="<?php echo RootREL; ?>media/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-datetimepicker.min.css">
<div class="row">
	<div class="col-xs-12">
		<div class="box">		   
		    <div class="box-body">
		    	<fieldset>
				    <div id="legend">
				      <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend>
				    </div>
				    <?php if($app['act'] != 'view') { ?>
				    	<form id="form-record" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->record['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				    <?php } ?>
				    	<?php //if(property_exists(get_class($this),'errors')) { ?>
				    	<?php if(isset($this->errors['database'])) { ?>
				    		<div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
				    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
				    			<h4>Oh snap! You got an error!</h4> 
				    			<p><?=$this->errors['database'];?></p> 
				    		</div>
				    	<?php } ?>

						    <div class="form-group row user">
						      <!-- User -->
						      <label class="control-label col-md-3" for="user_id">User :</label>
						      <div class="controls col-md-7">
						      	<?php if($app['act']=='view') { ?>
						        	<input disabled type="text" id="user_id" name="report[user_id]" placeholder="" class="form-control" <?php echo (isset($this->record))? "value='".$this->record['users_firstname'].' '.$this->record['users_lastname']."'":""; ?>>
						        <?php } else { ?>
						        	<select class="form-control select2" name="report[user_id]" id="user_id" class="form-control">
						          <?php foreach($this->users as $user) { ?>
								    <option <?=(isset($this->record['user_id']) && $this->record['user_id']==$user['id'])? 'selected="selected"':"" ?> 
								    	value="<?=$user['id'];?>"><?=$user['firstname'].' '.$user['lastname'];?></option>
						          <?php } ?>
								</select>
						        <?php } ?>
						        <?php if( isset($this->errors['user_id'])) { ?>
						        	<p class="text-danger"><?=$this->errors['user_id']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						    <div class="form-group row group">
						      <!-- Status -->
						      <label class="control-label col-md-3" for="status">Group</label>
						      <div class="controls col-md-7">
						      	<?php if($app['act']=='view') { ?>
						        	<input disabled type="text" id="group_id" name="report[group_id]" placeholder="" class="form-control" <?php echo (isset($this->record))? "value='".$this->record['groups_name']."'":""; ?>>
						        <?php } else { ?>
							      	<select <?php if($app['act']=='view') echo "disabled" ?> name="report[group_id]" id="input-group_id" class="form-control select2">
                      					<?php $apsp = true; ?>
                          				<option value="">Select group</option>
							      		<?php foreach ($this->groups as $group) { ?>
				                          	<?php if ($apsp && !$group['status']) { ?>
				                            	<option disabled="disabled"> (*) Suggestion groups</option>
				                            	<?php $apsp = false; ?>
				                          	<?php } ?>
											<option value="<?=$group['id'];?>" <?=(isset($this->record['group_id']) && $this->record['group_id']==$group['id'])? 'selected="selected"':'';?>><?=$group['name'];?></option>
										<?php } ?>
									</select>
						        <?php } ?>
						        <?php if( isset($this->errors['group_id'])) { ?>
						        	<p class="text-danger"><?=$this->errors['group_id']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

							 <div class="form-group row">
						      <!-- Date Time Start -->
						      <label class="control-label col-md-3" for="time_start">Date Time Start :</label>
						      <div class="controls controlsDisplay col-md-7">
						        <div>
						        	<input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="time_start" name="report[time_start]" placeholder="" class="form-control datetimepicker" <?php echo (isset($this->record))? "value='".str_replace(" ", "T", $this->record['time_start'])."'":""; ?>>
						        	<span class="input-group-addon datetimepicker-addon">
						        		<span class="glyphicon glyphicon-calendar"></span>
						        	</span>
						        </div>
						        <?php if( isset($this->errors['time_start'])) { ?>
						        	<p class="text-danger"><?=$this->errors['time_start']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						    <div class="form-group row">
						      <!-- Last Name -->
						      <label class="control-label col-md-3" for="work_time">Work Time</label>
						      <div class="controls col-md-7">
						        <input <?php if($app['act']=='view') echo "disabled"; ?> type="number" min="0.5" max="14" step="0.5" id="work_time" name="report[work_time]" placeholder="" class="form-control" <?php echo (isset($this->record))? "value='".str_replace(" ", "T", $this->record['work_time'])."'":""; ?>>
						        <?php if( isset($this->errors['work_time'])) { ?>
						        	<p class="text-danger"><?=$this->errors['work_time']; ?></p>
						        <?php } ?>
						      </div>
						    </div>
						 
						    <div class="form-group row">
						      <!-- Date Time End -->
						      <label class="control-label col-md-3" for="time_end">Date Time End :</label>
						      <div class="controls controlsDisplay col-md-7">
						        <div>
						        	<input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="time_end" name="report[time_end]" placeholder="" class="form-control datetimepicker" <?php echo (isset($this->record))? "value='".str_replace(" ", "T", $this->record['time_end'])."'":""; ?>>
						        	<span class="input-group-addon datetimepicker-addon">
									    <span class="glyphicon glyphicon-calendar"></span>
									</span>
						        </div>
						        <?php if( isset($this->errors['time_end'])) { ?>
						        	<p class="text-danger"><?=$this->errors['time_end']; ?></p>
						        <?php } ?>
						      </div>
						    </div>
						    
						    <div class="form-group row">
						      <!-- Job -->
						      <label class="control-label col-md-3" for="job">Job:</label>
						      <div class="controls col-md-7">
						        <textarea <?php if($app['act']=='view') echo "disabled"; ?> id="job" name="report[job]" placeholder="Job..." class="form-control" value="<?php if(isset($this->record['job'])) echo($this->record['job']); ?>"><?php echo (isset($this->record))? " ".$this->record['job']." ":""; ?></textarea>
						        <?php if( isset($this->errors['job'])) { ?>
						        	<p class="text-danger"><?=$this->errors['job']; ?></p>
						        <?php } ?>
						      </div>
						    </div>


								<div class="form-group row">
						      <!-- Status -->
						      <label class="control-label col-md-3" for="role">Status</label>
						      <div class="controls col-md-7">
						      	<?php if($app['act'] !='view'){ ?>
							      	<select name="report[status]" id="input-status" class="form-control">
							      		<?php foreach ($app['reportStatus'] as $k => $v) { ?>
											<option value="<?=$k;?>" <?=(isset($this->record['status']) && $this->record['status']==$k)? 'selected="selected"':'';?>><?=$v;?></option>
										<?php } ?>
									</select>
								<?php } else { ?>
									<input disabled type="text" id="status" name="report[status]"  class="form-control" value="<?php if(isset($this->record['status'])) echo $app['reportStatus'][$this->record['status']]; ?>">
								<?php } ?>
						        <?php if( isset($this->errors['status'])) { ?>
						        	<p class="text-danger"><?=$this->errors['status']; ?></p>
						        <?php } ?>
						      </div>
						    </div>
							
							<div class="form-group row group">
						      <!-- Status -->
						      <label class="control-label col-md-3" for="status">OT</label>
						      <div class="controls col-md-7">
						      	
							      	<select <?php if($app['act']=='view') echo "disabled" ?> name="report[checkOT]" id="input-group_id" class="form-control select2">
                      					<?php $apsp = true; ?>
                          				<option value="0"  >None  </option>
										  <option value="1" <?= $this->record['checkOT']==='1'? 'selected="selected"':''; ?> >OT</option>
										  <option value="2" <?= $this->record['checkOT']==='2'? 'selected="selected"':''; ?> >OTNN</option>
							      		
									</select>
						      </div>
						    </div>
							


						    <div class="form-group row">
						      <!-- E-mail -->
						      <label class="control-label col-md-3" for="notes">Note:</label>
						      <div class="controls col-md-7">
						        <textarea <?php if($app['act']=='view') echo "disabled"; ?> id="notes" name="report[notes]" placeholder="Notes..." class="form-control" value="<?php if(isset($this->record['notes'])) echo($this->record['notes']); ?>"><?php echo (isset($this->record))? " ".$this->record['notes']." ":""; ?></textarea>
						        <?php if( isset($this->errors['notes'])) { ?>
						        	<p class="text-danger"><?=$this->errors['notes']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						    <?php if($app['act'] !='view'){ ?>
							    <div class="form-group row">
							      <div class="controls col-md-10">
							        <input class="btn btn-success pull-right" id="btn_add" type="submit" name="btn_submit" value="<?php echo ucfirst($app['act']) ?>">
							      </div>
							    </div>
						    <?php } ?>
				    <?php if($app['act'] != 'view') { ?>
				    	</form>
				    <?php } ?>
				</fieldset>
		    </div>
		</div>
	</div>
</div>

<script src="<?php echo RootREL; ?>media/select2/select2.full.min.js"></script>
<script src="<?php echo RootREL; ?>media/js/moment.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
<script>
	$(document).ready(function() {
		$(".select2").select2();

		var yd = new Date();
		yd.setDate(yd.getDate() - 8);
		var maxDate = new Date();
		maxDate.setDate(yd.getDate()+30);

		$('.datetimepicker').datetimepicker({
			format: 'YYYY-MM-DD HH:mm',
			stepping: 15,
			minDate: yd,
			maxDate: maxDate
		});

		$('.datetimepicker-addon').on('click', function() {
			$(this).prev('input.datetimepicker').data('DateTimePicker').toggle();
		});

		$('.box-body').on('submit', '#form-record', function(){
			$("#btn_add").css("pointer-events"," none");
		});

  	});
</script>
