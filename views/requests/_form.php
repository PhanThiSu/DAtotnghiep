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
				    	<form id="form-record" action="<?php echo vendor_app_util::url(["ctl"=>"requests", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->record['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				    <?php } ?>
		              	<?php if(isset($this->errors) && $this->errors) { ?>
			                <div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
			                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
			                  <h4>Oh snap! You got an error!</h4> 
			                  <p><?=$this->errors['message'];?></p>
			                </div>
		              	<?php } ?>

						    <div class="form-group row">
						      <!-- Date Time Start -->
						      <label class="control-label col-md-3" for="datetime_start">Date Time Start :</label>
						      <div class="controls controlsDisplay col-md-7 datetimepicker">
						      	<div>
							        <input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="datetime_start" name="request[datetime_start]" placeholder="" class="form-control datetimepicker" <?php echo (isset($this->record))? "value='".str_replace(" ", "T", $this->record['datetime_start'])."'":""; ?>>
									<span class="input-group-addon datetimepicker-addon">
									    <span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
						        <?php if( isset($this->errors['inputForm']['datetime_start'])) { ?>
						        	<p class="text-danger"><?=$this->errors['inputForm']['datetime_start']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						    <div class="form-group row">
						      <!-- Date Time End -->
						      <label class="control-label col-md-3" for="datetime_end">Date Time End</label>
						      <div class="controls controlsDisplay col-md-7 datetimepicker">
						      	<div>
							        <input <?php if($app['act']=='view') echo "disabled"; ?>  type="text" id="datetime_end" name="request[datetime_end]" placeholder="" class="form-control datetimepicker" <?php echo (isset($this->record))? "value='".str_replace(" ", "T", $this->record['datetime_end'])."'":""; ?>>
									<span class="input-group-addon datetimepicker-addon">
									    <span class="glyphicon glyphicon-calendar"></span>
									 </span>
								</div>
						        <?php if( isset($this->errors['inputForm']['datetime_end'])) { ?>
						        	<p class="text-danger"><?=$this->errors['inputForm']['datetime_end']; ?></p>
						        <?php } ?>
						      </div>
						    </div>
						 
						    <div class="form-group row">
						      <!-- E-mail -->
						      <label class="control-label col-md-3" for="reason">Reason:</label>
						      <div class="controls col-md-7">
						        <textarea <?php if($app['act']=='view') echo "disabled"; ?> id="reason" name="request[reason]" placeholder="Reason..." class="form-control" value="<?php if(isset($this->record['reason'])) echo($this->record['reason']); ?>"><?php echo (isset($this->record))? " ".$this->record['reason']." ":""; ?></textarea>
						        <?php if( isset($this->errors['inputForm']['reason'])) { ?>
						        	<p class="text-danger"><?=$this->errors['inputForm']['reason']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						    <?php if($app['act'] !='view'){ ?>
							    <div class="form-group row">
							      <div class="controls col-md-10">
			                      <a href="<?php echo vendor_app_util::url(["ctl"=>"requests"]); ?>" class="btn btn-info cancelBtt pull-right">Cancel</a>
							        <input class="btn btn-success pull-right" id="btn_add" type="submit" name="btn_submit" value="<?php echo ucfirst($app['act']) ?>">
							      </div>
							    </div>
						    <?php } else { ?>
			                    <div class="form-group row">
			                    <div class="controls col-md-10">
			                      <a href="<?php echo vendor_app_util::url(["ctl"=>"requests"]); ?>" class="btn btn-info cancelBtt pull-right">Cancel</a>
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
		yd.setDate(yd.getDate() - 1);
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