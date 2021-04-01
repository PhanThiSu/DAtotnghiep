<div class="row">
	<div class="col-xs-12">
		<div class="box">		   
		    <div class="box-body">
		    	<fieldset>
				    <div id="legend">
				      <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend>
				    </div>
				    <?php if($app['act'] != 'view') { ?>
				    	<form id="form-addservice_category" action="<?php echo vendor_app_util::url(["ctl"=>"service_categories", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->service_category['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data">
				    <?php } ?>
				    	<?php //if(property_exists(get_class($this),'errors')) { ?>
				    	<?php if(isset(($this->errors['database']))) { ?>
				    		<div class="alert alert-error alert-dismissible fade in" role="alert"> 
				    		<div class="alert alert-danger alert-dismissible fade in" role="alert"> 
				    			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
				    			<h4>Oh snap! You got an error!</h4> 
				    			<p><?=$this->errors['database'];?></p> 
				    		</div>
				    	<?php } ?>

						    <div class="form-group row">
						      <!-- Name -->
						      <label class="control-label col-md-3" style="text-align: right;" for="name">Name</label>
						      <div class="controls col-md-7">
						        <input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="name" name="service_category[name]" placeholder="" class="form-control" value="<?php if(isset($this->service_category['name'])) echo $this->service_category['name']; ?>">
						        <?php if( isset($this->errors['name'])) { ?>
						        	<p class="text-danger"><?=$this->errors['name']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						    <div class="form-group row">
						      <!-- Alias / Slug -->
						      <label class="control-label col-md-3" style="text-align: right;" for="slug">Slug</label>
						      <div class="controls col-md-7">
						        <input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="slug" name="service_category[slug]" placeholder="" class="form-control" value="<?php if(isset($this->service_category['slug'])) echo($this->service_category['slug']); ?>">
						        <?php if( isset($this->errors['slug'])) { ?>
						        	<p class="text-danger"><?=$this->errors['slug']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						 	<div class="form-group row">
						      <!-- Image -->
						      <label class="control-label col-md-3" style="text-align: right;" for="image">Image</label>
						      <div class="controls col-md-7">
						      	<?php if($app['act'] !='add'){ ?>
						      		<?php if(isset($this->service_category['image'])) { ?>
						      			<img src="<?php echo UploadURI.$app['ctl'].'/'.$this->service_category['image']; ?>">
						      		<?php } ?>
						      	<?php } ?>
						      	<?php if($app['act'] !='view'){ ?>
						        	<input type="file" id="image" name="image" placeholder="" class="form-control">
						        <?php } ?>
						        <?php if( isset($this->errors['image'])) { ?>
						        	<p class="text-danger"><?=$this->errors['image']; ?></p>
						        <?php } ?>
						      </div>
						    </div>

						    <div class="form-group row">
						      <!-- Status -->
						      <label class="control-label col-md-3" style="text-align: right;" for="status">Status</label>
						      <div class="controls col-md-7">
						      	<?php if($app['act'] !='view'){ ?>
							      	<select name="service_category[status]" id="input-status" class="form-control">
							      		<?php foreach (service_category_model::$status as $k => $v) { ?>
											<option value="<?=$k;?>" <?=(isset($this->service_category['status']) && $this->service_category['status']==$k)? 'selected="selected"':'';?>><?=$v;?></option>
										<?php } ?>
									</select>
								<?php } else { ?>
									<input disabled type="text" id="status" name="service_category[status]"  class="form-control" value="<?php if(isset($this->service_category['status'])) echo service_category_model::$status[$this->service_category['status']]; ?>">
								<?php } ?>
						        <?php if( isset($this->errors['status'])) { ?>
						        	<p class="text-danger"><?=$this->errors['status']; ?></p>
						        <?php } ?>
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

<script src="<?php echo RootREL; ?>media/libs/js/slugify.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/form-slug.js"></script>
