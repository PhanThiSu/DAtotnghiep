<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="<?php echo RootREL; ?>media/admin/css/three-state-radio-buttons.css">

<?php vendor_html_helper::contentheader('Profile <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row" id="requests-header">
		    			<div class="col-sm-8 col-xs-6">
			      			<h2 class="box-title">Profile</h2>
		    			</div>

		    			<div class="col-sm-4 col-xs-6">
		    				<a href="<?php echo (vendor_app_util::url(["ctl"=>"users", "act"=>"editProfile"])) ?>" id="<?php echo("edit".$this->user['id']);?>" type="button" class="btn btn-primary edit-record  pull-right">
		                  		<i class="fa fa-edit"></i>
		                  	</a>
		    			</div>
		    		</div>
			    </div>
			    <!-- /.box-header -->
			    
				<div class="row">
					<div class="col-md-8 col-sm-12 col-xs-12">	   
					    <div class="box-body profile-body">
					    	<fieldset>
					    		<table class="profile-table">
					    			<tr>
					    				<td class="title">Full name :</td>
					    				<td><?php echo $this->user['firstname']; ?> <?php echo $this->user['lastname']; ?></td>
					    			</tr>
					    			<tr>
					    				<td class="title">Email :</td>
					    				<td><?php echo $this->user['email']; ?></td>
					    			</tr>
					    			<tr>
					    				<td class="title">Phone :</td>
					    				<td><?php echo $this->user['phone']; ?></td>
					    			</tr>
					    			<tr>
					    				<td class="title">Address :</td>
					    				<td><?php echo $this->user['address']; ?></td>
					    			</tr>
					    			<tr>
					    				<td class="title">Date Of Birth :</td>
					    				<td><?php echo $this->user['datebirth']; ?></td>
					    			</tr>
					    		</table>
					    	</fieldset>
					    </div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12 text-center">	
                        <div class="img-profile">
                        	<img src="<?php echo UploadURI.$app['ctl'].'/'.$this->user['avata']; ?>">
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>