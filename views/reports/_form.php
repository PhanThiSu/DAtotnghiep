<link rel="stylesheet" href="<?php echo RootREL; ?>media/select2/select2.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap-timepicker.min.css">
<div class="row">
  <div class="col-xs-12">
    <div class="box">      
        <div class="box-body">
          <fieldset>
            <div id="legend">
              <!-- <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend> -->
              <legend class="">
              <?php  
                if(ucwords($app['act'])==="Add")echo "Thêm báo cáo";
                else if(ucwords($app['act'])==="Edit") echo "Sửa báo cáo";
                else if(ucwords($app['act'])==="View") echo "Xem chi tiết";
               ?>
              
              </legend>
            </div>
            <?php if($app['act'] != 'view') { ?>
              <form id="form-record" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->record['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
            <?php } ?>
              <?php if(isset($this->errors) && $this->errors) { ?>
                <!-- <div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                  <h4>Oh snap! You got an error!</h4> 
                  <p><?=$this->errors['message'];?></p>
                </div> -->
              <?php } ?>
                <div class="form-group row group">
                  <!-- Status -->
                  <label class="control-label col-md-3 col-lg-3" for="status">Nhóm(*)</label>
                  <div class="controls col-md-9 col-lg-7">
                    <?php if($app['act']=='view') { ?>
                      <input disabled type="text" id="input_group_id" name="report[group_id]" placeholder="" class="form-control" <?php echo (isset($this->record))? "value='".$this->record['groups_name']."'":""; ?>>
                    <?php } else { ?>
                      <?php $apsp = true; 
                      ?>
                      <select <?php if($app['act']=='view') echo "disabled" ?> name="report[group_id]" id="group_id" class="form-control select2">
                          <option value="">Chọn nhóm</option>
                        <?php foreach ($this->records['data'] as $group) { ?>
                          <?php if ($apsp && !$group['status']) { ?>
                            <option disabled="disabled"> (*) Suggestion groups</option>
                            <?php $apsp = false; ?>
                          <?php } ?>
                          <option value="<?=$group['id'];?>" <?=(isset($this->record['group_id']) && $this->record['group_id']==$group['id'])? 'selected="selected"':'';?>><?=$group['name'];?></option>
                        <?php } ?>
                      </select>
                    <?php } ?>
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

                <div class="form-group row">
                  <label class="control-label col-md-3 col-lg-3" for="time_start">Thời gian bắt đầu</label>
                  <div class="controls col-md-9 col-lg-7 bootstrap-timepicker timepicker">
                    <input type="text" <?php if($app['act']=='view') echo "disabled"; ?> id="time_start" name="report[time_start]" placeholder="" class="form-control timepicker" <?php echo (isset($this->record))? "value='".date("H:i", strtotime($this->record['time_start']))."'":""; ?>>
                    <?php if( isset($this->errors['inputForm']['time_start'])) { ?>
                      <p class="text-danger"><?=$this->errors['inputForm']['time_start']; ?></p>
                    <?php } ?>
                  </div>
                </div>

                <div class="form-group row">
                  <!-- Last Name -->
                  <label class="control-label col-md-3 col-lg-3" for="work_time">Thời gian làm việc</label>
                  <div class="controls col-md-9 col-lg-7">
                    <input <?php if($app['act']=='view') echo "disabled"; ?> type="number" min="0.5" max="14" step="0.5" id="work_time" name="report[work_time]" placeholder="" class="form-control" <?php echo (isset($this->record))? "value='".str_replace(" ", "T", $this->record['work_time'])."'":""; ?>>
                    <?php if( isset($this->errors['inputForm']['work_time'])) { ?>
                      <p class="text-danger"><?=$this->errors['inputForm']['work_time']; ?></p>
                    <?php } ?>
                  </div>
                </div>
             
                <div class="form-group row">
                  <!-- First Name -->
                  <label class="control-label col-md-3 col-lg-3" for="time_end">Thời gian kết thúc</label>
                  <div class="controls col-md-9 col-lg-7 bootstrap-timepicker timepicker">
                    <input type="text" <?php if($app['act']=='view') echo "disabled"; ?> id="time_end" name="report[time_end]" placeholder="" class="form-control timepicker" <?php echo (isset($this->record))? "value='".date("H:i", strtotime($this->record['time_end']))."'":""; ?>>
                    <?php if( isset($this->errors['inputForm']['time_end'])) { ?>
                      <p class="text-danger"><?=$this->errors['inputForm']['time_end']; ?></p>
                    <?php } ?>
                  </div>
                </div>
                
                <div class="form-group row">
                  <!-- E-mail -->
                  <label class="control-label col-md-3 col-lg-3" for="job">Công việc(*)</label>
                  <div class="controls col-md-9 col-lg-7">
                    <textarea <?php if($app['act']=='view') echo "disabled"; ?> id="job" name="report[job]" placeholder="Job..." class="form-control" value="<?php if(isset($this->record['job'])) echo($this->record['job']); ?>"><?php echo (isset($this->record))? " ".$this->record['job']." ":""; ?></textarea>
                    <?php if( isset($this->errors['inputForm']['job'])) { ?>
                      <p class="text-danger"><?=$this->errors['inputForm']['job']; ?></p>
                    <?php } ?>
                  </div>
                </div>

                <div class="form-group row">
						      <!-- Status -->
						      <label class="control-label col-md-3" for="role">Trạng thái</label>
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
                  <label class="control-label col-md-3 col-lg-3" for="notes">Ghi chú:</label>
                  <div class="controls col-md-9 col-lg-7">
                    <textarea <?php if($app['act']=='view') echo "disabled"; ?> id="notes" name="report[notes]" placeholder="Notes..." class="form-control" value="<?php if(isset($this->record['notes'])) echo($this->record['notes']); ?>"><?php echo (isset($this->record))? " ".$this->record['notes']." ":""; ?></textarea>
                    <?php if( isset($this->errors['inputForm']['notes'])) { ?>
                      <p class="text-danger"><?=$this->errors['inputForm']['notes']; ?></p>
                    <?php } ?>
                  </div>
                </div>

                <?php if($app['act'] !='view'){ ?>
                  <div class="form-group row">
                    <div class="controls col-md-10">
                      <a href="<?php echo vendor_app_util::url(["ctl"=>"reports"]); ?>" class="btn btn-info cancelBtt pull-right">Hủy</a>
                      <input class="btn btn-success pull-right" id="btn_add" type="submit" name="btn_submit"  value="Thêm"> <!--value="<?php echo ucfirst($app['act']) ?>"-->
                    </div>
                  </div>
                <?php } else { ?>
                    <div class="form-group row">
                    <div class="controls col-md-10">
                      <a href="<?php echo vendor_app_util::url(["ctl"=>"reports"]); ?>" class="btn btn-info cancelBtt pull-right">Đóng</a>
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
<script>

$(document).ready(function () {
  
  $('.box-body').on('submit', '#form-record', function(){
    $("#btn_add").css("pointer-events"," none");
  });
      
});

</script>
<script src="<?php echo RootREL; ?>media/select2/select2.full.min.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/record_form.js"></script>