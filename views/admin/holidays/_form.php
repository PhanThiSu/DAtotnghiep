<div class="row">
	<div class="col-xs-12">
		<div class="box">		   
		    <div class="box-body">
		    	<fieldset>
				    <div id="legend">
				      <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend>
				    </div>
				    <?php if($app['act'] != 'view') { ?>
				    	<form id="form-adduser" action="<?php echo vendor_app_util::url(["ctl"=>"holidays", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->record['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				    <?php } ?>
				    	<?php //if(property_exists(get_class($this),'errors')) { ?>
				    	<?php if(isset($this->errors['database'])) { ?>
				    		<div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
				    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
				    			<h4>Oh snap! You got an error!</h4> 
				    			<p><?=$this->errors['database'];?></p> 
				    		</div>
				    	<?php } ?>
						 	
							<div class="form-group row">
							    <label for="unitPrice" class="col-md-3 control-label">Date</label>
							    <div class="col-md-7">
							      <input name="holidays[day]" type="date" class="form-control" id="day" required <?php echo (isset($this->record))? "value='".$this->record['day']."'":""; ?>>
						          <?php if( isset($this->errors['day'])) { ?>
						        	<p class="text-danger"><?=$this->errors['day']; ?></p>
						          <?php } ?>
							    </div>
							</div>

							<div class="form-group row">
						      <!-- First Name -->
						      <label class="control-label col-md-3" for="note">Note</label>
						      <div class="controls col-md-7">
						        <input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="note" name="holidays[note]" placeholder="" class="form-control" value="<?php if(isset($this->record['note'])) echo $this->record['note']; ?>">
						        <?php if( isset($this->errors['note'])) { ?>
						        	<p class="text-danger"><?=$this->errors['note']; ?></p>
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
