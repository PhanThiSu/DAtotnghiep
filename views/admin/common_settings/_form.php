<div class="row">
	<div class="col-xs-12">
		<div class="box">		   
		    <div class="box-body">
		    	<fieldset>
				    <div id="legend">
				      <legend class=""><?php echo ucwords($app['act'].' '.$app['ctl']); ?></legend>
				    </div>
				    <?php if($app['act'] != 'view') { ?>
				    	<form id="form-adduser" action="<?php echo vendor_app_util::url(["ctl"=>"common_settings", "act"=>$app['act'] == 'edit'?$app['act']."/".$this->record['id']:$app['act']]); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
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
						      <!-- Status -->
						      <label class="control-label col-md-3" for="status">First Saturday Of Year</label>
						      <div class="controls col-md-7">
							      	<select name="common_settings[fisrt_saturday_of_year]" id="fisrt_saturday_of_year" class="form-control">
                                      <option value="1"  <?php echo $this->record['fisrt_saturday_of_year']==1?'selected':'' ?> >Yes</option>
                                      <option value="0" <?php echo $this->record['fisrt_saturday_of_year']==1?'':'selected' ?> >No</option>
									</select>
						      </div>
						    </div>

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
        $('#fisrt_saturday_of_year').change(function(){
            if($(this).val()==1){
                if(confirm("Do you want change first saturday of year")){
                    ajax($(this).val())
                    return 0;
                }else{
                    $(this).val('0')
                }
            }else{
                if(confirm("Do you want change first saturday of year")){
                    ajax($(this).val())
                }else{
                    $(this).val('1')
                }
            }
            function ajax(val){
                let urlAdd = rootUrl+"/admin/common_settings/edit";
                $.ajax({
                    url: urlAdd,
                    method: "POST",
                    dataType: 'json',
                    data:{'common_settings[fisrt_saturday_of_year]':val}
                }).always(function(data) {
                    console.log("success")
                }); 
            }
            // confirm("Do you want to start work now")
            // alert('ahihi')
        })
    })
            
</script>
