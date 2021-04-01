<div class="row">
	<div class="col-xs-12">
		<div class="box">		   
		    <div class="box-body">
				<fieldset>
					<div id="legend">
					  <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend>
					</div>
					<!--form id="form-notificactions-edit"-->
					<form id="form-notificactions-edit" action="<?php echo vendor_app_util::url(["ctl"=>"notifications", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->record['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
						<?php if(isset(($this->errors['database']))) { ?>
							<div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
								<h4>Oh snap! You got an error!</h4> 
								<p><?=$this->errors['database'];?></p> 
							</div>
						<?php } ?>

						<div class="form-group row">
						  <label class="control-label col-md-3" for="firstname">Title</label>
						  <div class="controls col-md-7">
							<input <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="title" name="notification[title]" placeholder="" class="form-control" value="<?php if(isset($this->record['title'])) echo $this->record['title']; ?>">
							<?php if( isset($this->errors['title'])) { ?>
								<p class="text-danger"><?=$this->errors['title']; ?></p>
							<?php } ?>
						  </div>
						</div>

						<?php if($app['act'] =='view'){ ?>
							<div class="form-group row">
							<label class="control-label col-md-3" for="firstname">Content</label>
								<script>
									{
										let result = '<?php $this->errors['content']; ?>';
										$('.controls.content').html(resilt);
										console.log(result);
									}
								</script>
							<div class="controls content col-md-7">
								
							</div>
							</div>
						<?php }else{ ?>

							<div class="form-group row">
							<label class="control-label col-md-3" for="title_slug">Content</label>
							<div class="controls col-md-9">
								<textarea <?php if($app['act']=='view') echo "disabled"; ?> type="text" id="editor1" name="notification[content]" placeholder="" class="form-control" value="<?php if(isset($this->record['content'])) echo $this->record['content']; ?>"></textarea>
								<?php if( isset($this->errors['content'])) { ?>
									<p class="text-danger"><?=$this->errors['content']; ?></p>
								<?php } ?>
							</div>
							</div>
						<?php }?>




						<?php if($app['act'] !='view'){ ?>
							<div class="form-group row">
							  <div class="controls col-md-9 col-md-offset-3">
								<input class="btn btn-success pull-left" type="submit" name="btn_submit" value="<?php echo ucfirst($app['act']) ?>">
							  </div>
							</div>
						<?php } ?>
					</form>
				</fieldset>
		    </div>
		</div>
	</div>
</div>