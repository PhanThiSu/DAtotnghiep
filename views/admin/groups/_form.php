<link rel="stylesheet" href="<?php echo RootREL; ?>media/select2/select2.min.css">
<style>
.select2-container--default .select2-selection--multiple .select2-selection__choice {
	color: black;
}
</style>

<div class="row">
	<div class="col-xs-12">
		<div class="box">		   
		    <div class="box-body">
		    	<fieldset>
				    <div id="legend">
				      <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend>
				    </div>
				    <?php if($app['act'] != 'view') { ?>
				    	<form id="form-addgroup" action="<?php echo vendor_app_util::url(["ctl"=>"groups", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->record['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data">
				    <?php } ?>
				    	<?php //if(property_exists(get_class($this),'errors')) { ?>
				    	<?php if(isset($this->errors['database'])) { ?>
				    		<div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
				    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
				    			<h4>Lỗi!</h4> 
				    			<p><?=$this->errors['database'];?></p> 
				    		</div>
				    	<?php } ?>

						    <div class="form-group row">
						      <!-- First Name -->
						      <label class="control-label col-md-3" for="name">Name</label>
						      <div class="controls col-md-7">
						        <input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="name" name="name" placeholder="" class="form-control" value="<?php if(isset($this->record['name'])) echo $this->record['name']; ?>">
						        <?php if( isset($this->errors['name'])) { ?>
						        	<p class="text-danger"><?=$this->errors['name']; ?></p>
						        <?php } ?>
						      </div>
						    </div>


								<div class="form-group row user">
						      <!-- User -->
						      <label class="control-label col-md-3" for="leader_id">Leader </label>
						      <div class="controls col-md-7">
						      	<?php if($app['act']=='view') { ?>
						        	<input disabled type="text" id="leader_id" name="leader_id" placeholder="" class="form-control" <?php echo (isset($this->leader))? "value='".$this->leader['firstname'].' '.$this->leader['lastname']."'":""; ?>>
						        <?php } else { ?>
						        	<select class="form-control select2" name="leader_id" id="leader_id" class="form-control">
											<option value="">Select group leader</option>
						          <?php foreach($this->users as $user) { ?>
								    <option <?=(isset($this->record['leader_id']) && $this->record['leader_id']==$user['id'])? 'selected="selected"':"" ?> 
								    	value="<?=$user['id'];?>"><?=$user['firstname'].' '.$user['lastname'];?></option>
						          <?php } ?>
								</select>
						        <?php } ?>
						        <?php if( isset($this->errors['leader_id'])) { ?>
						        	<p class="text-danger"><?=$this->errors['leader_id']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

							<div class="form-group row">
						      	<!-- First Name -->
						      	<label class="control-label col-md-3" for="name">Members</label>
						      	<div class="controls col-md-7">
									<select name="member_id" id="member_id" <?php if($app['act']=='view') echo "disabled"; ?> <?php if($app['act'] =='view') { ?> multiple data-placeholder="No members for group." <?php } else { ?> multiple data-placeholder="Add members for group." <?php } ?> class="form-control select2" >
										<?php 
										foreach ($this->users as $user) { 
											$check = true;
											foreach ($this->usersJoined as $userjoin) { 
												if ($userjoin['user_id']==$user['id']) {
													$check = false;
										?>
										 			<option selected="selected" value="<?=$user['id'];?>" ><?=$user['firstname'].' '.$user['lastname'];?></option>
											
										<?php   }
											} 
											if ($check) { ?>
												<option value="<?=$user['id'];?>" ><?=$user['firstname'].' '.$user['lastname'];?></option>
							
											<?php } 
										} ?>
		
				      				</select>
							        <?php if( isset($this->errors['member_id'])) { ?>
							        	<p class="text-danger"><?=$this->errors['member_id']; ?></p>
							        <?php } ?>
						    	</div>
						    </div>

							<div class="form-group row">
							    <label for="start_day" class="col-md-3 control-label">Start Date</label>
							    <div class="col-md-7">
							      <input <?php if($app['act']=='view') echo "disabled"; ?> name="start_day" type="date" class="form-control" id="start_day" required <?php echo (isset($this->record))? "value='".$this->record['start_day']."'":""; ?>>
						          <?php if( isset($this->errors['start_day'])) { ?>
						        	<p class="text-danger"><?=$this->errors['start_day']; ?></p>
						          <?php } ?>
							    </div>
							</div>

							<div class="form-group row">
							    <label for="end_day" class="col-md-3 control-label">End Date</label>
							    <div class="col-md-7">
							      <input <?php if($app['act']=='view') echo "disabled"; ?> name="end_day" type="date" class="form-control" id="end_day" required <?php echo (isset($this->record))? "value='".$this->record['end_day']."'":""; ?>>
						          <?php if( isset($this->errors['end_day'])) { ?>
						        	<p class="text-danger"><?=$this->errors['end_day']; ?></p>
						          <?php } ?>
							    </div>
							</div>
							
						    <div class="form-group row">
						      <!-- E-mail -->
						      <label class="control-label col-md-3" for="description">Description:</label>
						      <div class="controls col-md-7">
						        <textarea <?php if($app['act']=='view') echo "disabled"; ?> id="description" name="description" placeholder="Description..." class="form-control" value="<?php if(isset($this->record['description'])) echo($this->record['description']); ?>"><?php echo (isset($this->record))? " ".$this->record['description']." ":""; ?></textarea>
						        <?php if( isset($this->errors['description'])) { ?>
						        	<p class="text-danger"><?=$this->errors['description']; ?></p>
						        <?php } ?>
						      </div>
						    </div>
							
							<?php if($app['act'] != 'add') { ?>
								<div class="form-group row">
								<!-- First Name -->
								<label class="control-label col-md-3" for="user_created">User created</label>
								<div class="controls col-md-7">
									<input disabled type="text" id="user_created" name="user_created" placeholder="" class="form-control" 
										value="<?php 
											if($app['act']=='view') {
												if(isset($this->record['firstname'])) echo $this->record['firstname']; ?> <?php if(isset($this->record['lastname'])) echo $this->record['lastname']; 
											} else {
												if(isset($this->record['users_firstname'])) echo $this->record['users_firstname']; ?> <?php if(isset($this->record['users_lastname'])) echo $this->record['users_lastname']; 
											}
										?>" readonly>
										<?php if( isset($this->errors['user_created_id'])) { ?>
										<p class="text-danger"><?=$this->errors['user_created_id']; ?></p>
									<?php } ?>
								</div>
								</div>
							<?php }?>

						    <div class="form-group row">
						      <!-- Status -->
						      <label class="control-label col-md-3" for="status">Status</label>
						      <div class="controls col-md-7">
						      	<?php if($app['act'] !='view'){ ?>
							      	<select name="status" id="input-status" class="form-control">
							      		<?php foreach (group_model::$status as $k => $v) { ?>
											<option value="<?=$k;?>" <?=(!isset($this->record['status']) && 1==$k)? 'selected':'';?> <?=(isset($this->record['status']) && $this->record['status']==$k)? 'selected="selected"':'';?>
											><?=$v;?>
											</option>
										<?php } ?>
									</select>
								<?php } else { ?>
									<input disabled type="text" id="status" name="status"  class="form-control" value="<?php if(isset($this->record['status'])) echo group_model::$status[$this->record['status']]; ?>">
								<?php } ?>
						        <?php if( isset($this->errors['status'])) { ?>
						        	<p class="text-danger"><?=$this->errors['status']; ?></p>
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
<script> 
	$(document).ready(function() {
		$(".select2").select2();
	});

	jQuery('#form-addgroup').submit(function(e) {
			e.preventDefault();
			var action = "<?php echo $app['act'] ?>"; 
			var group_id = "<?php echo $this->record['id'] ?>"; 
			
			var data = jQuery(this).serializeArray();
			var objData = {
					members: []
			};
			for (var i =0; i < data.length; i++) {
					if (data[i].name == 'member_id') {
							objData.members.push(data[i].value);
					} else if (data[i].value) {
							objData[data[i].name] = data[i].value;
					}
			}

			if (!objData.members.length) {
					delete objData.members;
			} else {
					objData.members = objData.members.join('-');
			}
			
			if (!objData.name) {
				confirm("Please enter group name!");
			}	else {

					if (!objData.members){
						objData.members = null;
					};
					
					if (!objData.description){
						objData.description = "";
					};

					$.ajax({
						type:"POST",
						url: action == 'add' ? rootUrl+'admin/groups/add' : rootUrl+'admin/groups/edit/'+ group_id,
						data: objData,
						success: function(res){
							var resObject = JSON.parse(res);
							if( resObject.status == 1) {
									location.replace(rootUrl+'admin/groups')
							} else {
									confirm(resObject.message);
							}
						}
				});
			}
	});

</script>
