<div class="row">
	<div class="col-xs-12">
		<div class="box">		   
		    <div class="box-body">
		    	<fieldset>
				    <div id="legend">
				      <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend>
				    </div>
				    <?php if($app['act'] != 'view') { ?>
				    	<form id="form-addgroup" action="<?php echo vendor_app_util::url(["ctl"=>"logs", "act"=>$app['act'] == 'delete'?$app['act']."/".$this->record['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data">
				    <?php } ?>
				    	<?php if(isset(($this->errors['database']))) { ?>
				    		<div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
				    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
				    			<h4>Oh snap! You got an error!</h4> 
				    			<p><?=$this->errors['database'];?></p> 
				    		</div>
				    	<?php } ?>

						    <div class="form-group row">
						      <!-- First Name -->
						      <label class="control-label col-md-3" for="name">Time</label>
						      <div class="controls col-md-7">
						        <input disabled type="text"  class="form-control" value="<?php if(isset($this->record['time'])) echo $this->record['time']; ?>">
						        <?php if( isset($this->errors['time'])) { ?>
						        	<p class="text-danger"><?=$this->errors['time']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

							<div class="form-group row">
							    <label class="col-md-3 control-label">User</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".$this->record['users_firstname']." ".$this->record['users_lastname']."'":""; ?>>
							    </div>
							</div>

							<div class="form-group row">
							    <label class="col-md-3 control-label">Event</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".$this->record['event']."'":""; ?>>
							    </div>
							</div>

							<div class="form-group row">
							    <label class="col-md-3 control-label">Status</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".log_model::$status[$this->record['status']]."'":""; ?>>
							    </div>
							</div>

							<div class="form-group row">
							    <label class="col-md-3 control-label">IP</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".$this->record['ip']."'":""; ?>>
							    </div>
							</div>

							<div class="form-group row">
							    <label class="col-md-3 control-label">Location</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".$this->record['location']."'":""; ?>>
							    </div>
							</div>

							<div class="form-group row">
							    <label class="col-md-3 control-label">Browser</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".$this->record['browser']."'":""; ?>>
							    </div>
							</div>

							<div class="form-group row">
							    <label class="col-md-3 control-label">OS</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".$this->record['os']."'":""; ?>>
							    </div>
							</div>

							<div class="form-group row">
							    <label class="col-md-3 control-label">Agent</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".$this->record['agent']."'":""; ?>>
							    </div>
							</div>		

							<div class="form-group row">
							    <label class="col-md-3 control-label">Latitude</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".$this->record['latitude']."'":""; ?>>
							    </div>
							</div>
							
							<div class="form-group row">
							    <label class="col-md-3 control-label">Longitude</label>
							    <div class="col-md-7">
							      <input disabled class="form-control" <?php echo (isset($this->record))? "value='".$this->record['longitude']."'":""; ?>>
							    </div>
							</div>

							<div class="form-group row">
								<label class="col-md-3 control-label">Note</label>
								<div class="col-md-7">
									<?php if(isset($this->record)){
										if ( $this->record['event']==log_model::$type['add_report']['name']
											|| $this->record['event']==log_model::$type['edit_report']['name']
										)
										echo	 "<a href='".RootREL."admin/reports/view/".$this->record['note']."'".'>Go to page</a>';
										else if ( $this->record['event']==log_model::$type['add_request']['name']
										)
										echo	 "<a href='".RootREL."admin/requests/view/".$this->record['note']."'".'>Go to page</a>';
										else echo	 "<input disabled class='form-control' value='".$this->record['note']."'>";
									} else {
										echo '<input disabled class="form-control" value="">';
									}
									?>
								</div>
							</div>


						    <?php if($app['act'] !='view'){ ?>
							    <div class="form-group row">
							      <div class="controls col-md-10">
							        <input class="btn btn-success pull-right" type="submit" name="btn_submit" value="<?php echo ucfirst($app['act']) ?>">
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
