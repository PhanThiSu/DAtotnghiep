<div class="row">
	<div class="col-xs-12">
		<div class="box">		   
		    <div class="box-body">
		    	<fieldset>
				    <div id="legend">
				      <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend>
				    </div>
				    <?php if($app['act'] != 'view') { ?>
				    	<form id="form-addLevelSalary" action="<?php echo vendor_app_util::url(["ctl"=>"user_level_salaries", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->record['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
				    <?php } ?>
				    	<?php //if(property_exists(get_class($this),'errors')) { ?>
				    	<?php if(isset($this->errors['database'])) { ?>
				    		<div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
				    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
				    			<h4>Oh snap! You got an error!</h4> 
				    			<p><?=$this->errors['database'];?></p> 
				    		</div>
				    	<?php } ?>

						<?php
							if($app['act']!='add'){
						?>
						    <div class="form-group row">
						      <!-- First Name -->
						      <label class="control-label col-md-3" for="firstname">First Name</label>
						      <div class="controls col-md-7">
						        <input <?php if($app['act']=='view' || $app['act']=='edit') echo "disabled"; ?> type="text" id="firstname" name="user[firstname]" placeholder="" class="form-control" value="<?php if(isset($this->record['firstname'])) echo $this->record['firstname']; ?>">
						        <?php if( isset($this->errors['firstname'])) { ?>
						        	<p class="text-danger"><?=$this->errors['firstname']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						    <div class="form-group row">
						      <!-- Last Name -->
						      <label class="control-label col-md-3" for="lastname">Last Name</label>
						      <div class="controls col-md-7">
						        <input <?php if($app['act']=='view'|| $app['act']=='edit') echo "disabled"; ?> type="text" id="lastname" name="user[lastname]" placeholder="" class="form-control" value="<?php if(isset($this->record['lastname'])) echo($this->record['lastname']); ?>">
						        <?php if( isset($this->errors['lastname'])) { ?>
						        	<p class="text-danger"><?=$this->errors['lastname']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						 	<div class="form-group row">
						      <!-- Avata -->
						      <label class="control-label col-md-3" for="avata">Avata</label>
						      <div class="controls col-md-7">
						      	<?php if($app['act'] !='add'){ ?>
						      		<?php if(isset($this->record['avata'])) { ?>
						      			<img src="<?php echo UploadURI.'users/'.$this->record['avata']; ?>">
						      		<?php } ?>
						      	<?php } ?>
						      	<?php if($app['act'] !='view' && $app['act'] !='edit'){ ?>
						        	<input type="file" id="avata" name="image" placeholder="" class="form-control">
						        <?php } ?>
						        <?php if( isset($this->errors['avata'])) { ?>
						        	<p class="text-danger"><?=$this->errors['avata']; ?></p>
						        <?php } ?>
						      </div>
						    </div>
						<?php } ?>
						
						<?php
							if($app['act']=='add'){
						?>
							<div class="form-group row user">
						      <!-- User -->
						      <label class="control-label col-md-3" for="user_id">User :</label>
						      <div class="controls col-md-7">
						      	<?php if($app['act']=='view') { ?>
						        	<input disabled type="text" id="user_id" name="user_level_salary[user_id]" placeholder="" class="form-control" <?php echo (isset($this->record))? "value='".$this->record['users_firstname'].' '.$this->record['users_lastname']."'":""; ?>>
						        <?php } else { ?>
						        	<select class="form-control select2" name="user_level_salary[user_id]" id="user_id" class="form-control">
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
						<?php }?>

							<div class="form-group row">
						      <!-- Basic Salary -->
						      <label class="control-label col-md-3" for="basic_salary">Basic Salary</label>
						      <div class="controls col-md-7">
						        <input <?php if($app['act']=='view') echo "disabled"; ?> type="number" min="0" step="100000" id="basic_salary" name="user_level_salary[basic_salary]" placeholder="" class="form-control" value="<?php if(isset($this->record['basic_salary'])) echo($this->record['basic_salary']); ?>">
						        <?php if( isset($this->errors['basic_salary'])) { ?>
						        	<p class="text-danger"><?=$this->errors['basic_salary']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

							<div class="form-group row">
								<!-- Start  -->
							    <label for="start" class="col-md-3 control-label">Date Start</label>
							    <div class="col-md-7">
							      <input <?php if($app['act']=='view') echo "disabled"; ?> name="user_level_salary[start]" type="date" class="form-control" id="start"  <?php echo (isset($this->record))? "value='".$this->record['start']."'":""; ?>>
						          <?php if( isset($this->errors['start'])) { ?>
						        	<p class="text-danger"><?=$this->errors['start']; ?></p>
						          <?php } ?>
							    </div>
							</div>

							<div class="form-group row">
									<!-- End -->
							    <label for="end" class="col-md-3 control-label">Date End</label>
							    <div class="col-md-7">
							      <input <?php if($app['act']=='view') echo "disabled"; ?> name="user_level_salary[end]" type="date" class="form-control" id="end"  <?php echo (isset($this->record))? "value='".$this->record['end']."'":""; ?>>
						          <?php if( isset($this->errors['end'])) { ?>
						        	<p class="text-danger"><?=$this->errors['end']; ?></p>
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
