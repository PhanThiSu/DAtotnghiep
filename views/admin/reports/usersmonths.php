<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">

<?php vendor_html_helper::contentheader('reports <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header">
		    		<div class="row" id="reports-header">
		    			<div class="col-sm-9 col-xs-9">
			      			<form id="form-report" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>'usersmonths']); ?>" method="post" enctype="multipart/form-data" class="form-inline">
								<div class="form-group">
								    <label class="sr-only" for="exampleInputAmount">Select year: </label>
								    <div class="input-group">
								      	<div class="input-group-addon mobileHide">Select year: </div>
								      	<?php $crry = date('Y');?>
			      						<select name="year" class="form-control selectInput" id="year">
			      						<?php for ($i=$crry; $i>2009; $i--): ?>
			      							<option <?=($this->time==$i)? 'selected':''; ?> value="<?=$i;?>"><?=$i;?></option>
			      						<?php endfor; ?>
			      						</select>
			      					</div>
			      				</div>
								<button type="submit" class="btn btn-info">Submit</button>
			      			</form>
		    			</div>

		    			<div class="col-sm-3 col-xs-3">
		    				
		    				<a href="<?php echo vendor_app_util::url(['ctl'=>'reports','act'=>'add']); ?>" id="add-report" type = "button" class="btn btn-primary pull-right" >
		    					<i class="fa fa-plus"></i>
		    				</a>	
		    			</div>
		    		</div>
			    </div>
			    <!-- /.box-header -->
			    
				<?php include_once 'views/admin/'.$this->controller.'/_usersmonthsdata.php';	?>
			</div>
		</div>
	</div>
</section>

<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
