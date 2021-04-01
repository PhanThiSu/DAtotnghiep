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
              <legend class="">Check Log Time</legend>
            </div>
            <?php if($app['act'] != 'view') { ?>
              <form id="formLogTime"  class="form-horizontal" action="/check_logtime/add" method="post">
            <?php } ?>
              <?php if(isset($this->errors) && $this->errors) { ?>
                <div class="alert alert-danger  alert-dismissible fade in" role="alert"> 
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> 
                  <h4>Oh snap! You got an error!</h4> 
                  <p><?=$this->errors['message'];?></p>
                </div>
              <?php } ?>


                <?php if(empty($this->none) && empty($this->record)){ ?>
                  <div class="form-group row">
                  <!-- E-mail -->
                  <label class="control-label col-md-3 col-lg-3" for="notes">Note:</label>
                  <div class="controls col-md-9 col-lg-7">
                    <textarea  id="notes" name="check_logtime[note]" placeholder="Notes..." class="form-control" ></textarea>
                   
                  </div>
                </div>

            
                  <div class="form-group row">
                    <div class="controls col-md-10">
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="controls col-md-10 flex-end">
                    <button id="startLogTime" type="submit" name="btn_submit" class="btn btn-success">Start</button>
                    </div>
                  </div>
                <?php }?>
                <?php if(!empty($this->record)){ ?>
                  <div class="alert alert-success " style="font-size:30px" role="alert">You have already started work at <?= $this->time ;?></div>
                <?php }?>

               
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

<script src="<?php echo RootREL; ?>media/bootstrap/js/checkbox-x.min.js"></script>
<script src="<?php echo RootREL; ?>media/select2/select2.full.min.js"></script>
<script src="<?php echo RootREL; ?>media/bootstrap/js/bootstrap-timepicker.min.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/record_form.js"></script>
<script src="<?php echo RootREL; ?>media/js/jquery.countup.js"></script>