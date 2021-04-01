<link rel="stylesheet" href="<?php echo RootREL; ?>media/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-timepicker.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/css/jquery.countup.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/checkbox-x.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-toggle.min.css">
<div class="row">
  <div class="col-xs-12">
    <div class="box">      
        <div class="box-body">
          <fieldset>
            <div id="legend">
              <legend class="">Time Tracking</legend>
            </div>
            <?php if($app['act'] != 'view') { ?>
              <form id="formLogTime"  class="form-horizontal">
            <?php } ?>
              <?php if(isset($this->errors) && $this->errors) { ?>
                <div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                  <h4>Oh snap! You got an error!</h4> 
                  <p><?=$this->errors['message'];?></p>
                </div>
              <?php } ?>

                <div id="countdown">
                  <?php if(!empty($_SESSION['textLogtime'])) echo "<p class='textLogTime'>".$_SESSION['textLogtime']."</p>";?>
                </div>
                    <div class="form-group row group">
                        <label class="control-label col-md-3 col-lg-3" for="status">Group</label>
                        <div class="controls col-md-9 col-lg-7">
                            <select <?php if($app['act']=='view') echo "disabled" ?> name="report[group_id]" id="group_id" class="form-control select2">
                                <option value="">Select group</option>
                                <?php foreach ($this->records['data'] as $group) { ?>
                                <option value="<?=$group['id'];?>" <?=(isset($this->record['group_id']) && $this->record['group_id']==$group['id'])? 'selected="selected"':'';?>><?=$group['name'];?></option>
                                <?php } ?>
                            </select>
                            <?php if( isset($this->errors['inputForm']['group_id'])) { ?>
                            <p class="text-danger"><?=$this->errors['inputForm']['group_id']; ?></p>
                            <?php } ?>
                        </div>

                        <div id="group_suggest_group" class="checkbox fade in col-md-9 col-lg-7 col-md-offset-3 <?=(isset($this->record['group_id']) && $this->record['group_id']==1)? '':'hide';?>"> 
                            <label class="text-success">
                            <input id="cb_group_suggest" type="checkbox" name="group_suggestion" <?=(isset($this->group_suggestion))? "checked": "";?>>Suggest a new group?
                            </label> 
                            <div class="group_name_container">
                            <input type="text" <?=(isset($this->group_suggestion))? "": "disabled";?> id="group_suggest" name="group[name]" placeholder="Group suggestion ..." value="<?php if(isset($this->group['name'])) echo $this->group['name']; ?>">
                            </div>
                            <?php if( isset($this->errors['inputSuggest']['name'])) { ?>
                            <p class="text-danger"><?=$this->errors['inputSuggest']['name']; ?></p>
                            
                            <?php } ?><p class="text-danger" id='err_group_name'></p>
                        </div>
                    </div>

                    <div class="form-group row group">
                        <label class="control-label col-md-3 col-lg-3" for="status">Job</label>
                        <div class="controls col-md-9 col-lg-7">
                            <?php $apsp = true; 
                            ?>

                            <div class="existingJob">
                              <select disabled  name="id_report" id="id_report" class="form-control select2 ">
                                  <option value="">Select jobs</option>
                              </select>
                            </div>

                            <div class="newJob">
                              <textarea <?php if($app['act']=='view') echo "disabled"; ?> id="job" name="report[job]" placeholder="Job..." class="form-control" value="<?php if(isset($this->record['job'])) echo($this->record['job']); ?>"><?php echo (isset($this->record))? " ".$this->record['job']." ":""; ?></textarea>
                            </div>
                            <div class="optionJob">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="0" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                  New job
                                </label>
                              </div>
                                <div class="form-check form-check-existing">
                                  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="1">
                                  <label class="form-check-label" for="exampleRadios2">
                                    Existing job
                                  </label>
                                </div>
                            </div>
                            <?php if( isset($this->errors['inputForm']['group_id'])) { ?>
                            <p class="text-danger"><?=$this->errors['inputForm']['group_id']; ?></p>
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

                <div class="form-group row">
                  <!-- E-mail -->
                  <label class="control-label col-md-3 col-lg-3" for="notes">Note:</label>
                  <div class="controls col-md-9 col-lg-7">
                    <textarea  id="notes" name="report[notes]" placeholder="Notes..." class="form-control" value="<?php if(isset($this->record['notes'])) echo($this->record['notes']); ?>"><?php echo (isset($this->record))? " ".$this->record['notes']." ":""; ?></textarea>
                   
                  </div>
                </div>

            
                  <div class="form-group row">
                    <div class="controls col-md-10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="controls col-md-10 flex-end">
                    <button id="startLogTime" type="button" class="btn btn-success">Start</button>
                    <button id="stopLogTime" type="button" class="btn btn-danger" disabled>Stop</button>
                    </div>
                  </div>
              </form>
        </fieldset>
        </div>
    </div>
  </div>
</div>


<!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->
  <!-- Modal -->
  <div class="modal modal-timeTracking fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Time Tracking</h4>
        </div>
        <div class="modal-body">
          <p>Do you want to continue my work.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-popug-no" data-dismiss="modal">No</button>
          <button type="button" class="btn btn-info btn-popug-yes" data-dismiss="modal">Yes</button>
        </div>
      </div>
      
    </div>
  </div>

<script>
  var check_reportId = `<?php echo isset($_SESSION['report_id'])? $_SESSION['report_id'] : 'null'?>`
</script>

<script src="<?php echo RootREL; ?>media/js/logtime.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/checkbox-x.min.js"></script>
<script src="<?php echo RootREL; ?>media/select2/select2.full.min.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/record_form.js"></script>
<script src="<?php echo RootREL; ?>media/js/jquery.countup.js"></script>