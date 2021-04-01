<link rel="stylesheet" href="<?php echo RootREL; ?>media/select2/select2.min.css">
<div class="row">
  <div class="col-xs-12">
    <div class="box">      
        <div class="box-body">
          <fieldset>
            <div id="legend">
              <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend>
            </div>
              <form class="form-horizontal" method="post" enctype="multipart/form-data" action="">
                <div class="form-group">
                  <label for="unitPrice" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-9">
                    <input type="text" name="data[<?php echo $this->controller; ?>][email]" class="form-control" id="email" required <?php echo (isset($this->record))? "value='".$this->record['email']."'":""; ?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="unitPrice" class="col-sm-3 control-label">First Name</label>
                  <div class="col-sm-9">
                    <input name="data[<?php echo $this->controller; ?>][firstname]" type="text" class="form-control" id="firstname" required <?php echo (isset($this->record))? "value='".$this->record['firstname']."'":""; ?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="unitPrice" class="col-sm-3 control-label">Last Name</label>
                  <div class="col-sm-9">
                    <input name="data[<?php echo $this->controller; ?>][lastname]" type="text" class="form-control" id="lastname" required <?php echo (isset($this->record))? "value='".$this->record['lastname']."'":""; ?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="unitPrice" class="col-sm-3 control-label">Phone</label>
                  <div class="col-sm-9">
                    <input name="data[<?php echo $this->controller; ?>][phone]" type="text" class="form-control" id="phone" required <?php echo (isset($this->record))? "value='".$this->record['phone']."'":""; ?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="unitPrice" class="col-sm-3 control-label">Address</label>
                  <div class="col-sm-9">
                    <input name="data[<?php echo $this->controller; ?>][address]" type="text" class="form-control" id="address" <?php echo (isset($this->record))? "value='".$this->record['address']."'":""; ?>>
                  </div>
                </div>
                <div class="form-group">
                  <label for="unitPrice" class="col-sm-3 control-label">Date Birth</label>
                  <div class="col-sm-9">
                    <input name="data[<?php echo $this->controller; ?>][datebirth]" type="date" class="form-control" id="datebirth" required value="<?php echo date('Y-m-d',strtotime($this->record['datebirth'])) ?>">
                  </div>
                </div>
                <div class="form-group">
                  <!-- Avata -->
                  <label class="control-label col-md-3" for="avata">Avata</label>
                  <div class="controls col-md-9">
                    <?php if($app['act'] !='add'){ ?>
                      <?php if(isset($this->user['avata'])) { ?>
                        <img src="<?php echo UploadURI.$app['ctl'].'/'.$this->user['avata']; ?>">
                      <?php } ?>
                    <?php } ?>
                    <?php if($app['act'] !='view'){ ?>
                      <input type="file" id="avata" name="image" placeholder="" class="form-control">
                    <?php } ?>
                    <?php if( isset($this->errors['avata'])) { ?>
                      <p class="text-danger"><?=$this->errors['avata']; ?></p>
                    <?php } ?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    <button name="btn_submit" type="submit" class="btn btn_submit btn-success"><?php echo ucwords($this->action); ?>
                    </button>
                  </div>
                </div>
              </form>
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
</script>