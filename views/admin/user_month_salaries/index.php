<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<?php 
global $app;
?>
<?php vendor_html_helper::contentheader('User Month Salaries <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border row id="reports-header">
					<div class="col-sm-6">
						<h3 class="box-title">
							List salaries in <?=$this->year?> of Employees
						</h3>
					</div>
					<div class="col-sm-6">
						<!-- <h3 class="box-title text-info pull-right text-right">In <?=$this->year;?>, <?=vendor_html_helper::link($this->fullname, ["ctl"=>"users", "act"=>"profile"])?> have worked <strong class="text-danger"><?=$this->record['total'];?></strong> hour(s)</h3> -->
					</div>
			    </div>
			    <div class="box-body row">
	    			<div class="col-sm-9 col-xs-9">
		      			<form id="form-report" action="<?php echo vendor_app_util::url(["ctl"=>"user_month_salaries", "act"=>'index']); ?>" method="post" enctype="multipart/form-data" class="form-inline">
							<div class="form-group">
							    <label class="sr-only" for="exampleInputAmount">Select year: </label>
							    <div class="input-group">
							      	<div class="input-group-addon mobileHide">Select year: </div>
							      	<?php $crry = date('Y');?>
		      						<select name="year" class="form-control selectInput" id="year">
		      						<?php for ($i=$crry; $i>=2019; $i--): ?>
		      							<option <?=($this->year==$i)? 'selected':''; ?> value="<?=$i;?>"><?=$i;?></option>
		      						<?php endfor; ?>
		      						</select>
		      					</div>
		      				</div>
							<button type="submit" class="btn btn-info">Submit</button>
		      			</form>
	    			</div>

	    			<!-- <div class="col-sm-3 col-xs-3">
	    				<button id="delete-reports" class="btn btn-danger pull-right">
	    					<i class="fa fa-remove"></i>
	    				</button>
	    				<a href="<?php echo vendor_app_util::url(['ctl'=>'reports','act'=>'add']); ?>" id="add-report" type = "button" class="btn btn-primary pull-right" >
	    					<i class="fa fa-plus"></i>
	    				</a>	
	    			</div> -->
	    		</div>
		    	<!-- /.box-header -->
		    
			    <div class="box-body">
					<div class="row">
					<?php 
						$crrMonth = date('n');
						$crrYear = date('Y');
						$action = "View";
						for ($i=1; $i<=12; $i++): 
							$style = ($this->year==$crrYear && $i>$crrMonth)?("style='display:none'"):"";
							$check_month = in_array($i, $this->list_month_payed);
							$background = "";
							if(in_array($i, $this->list_month_payed)){
								$background = "bg-aqua";
							}else{
								$background = "bg-red";
							}
							if($i == intval($crrMonth-1) && $this->year== intval($crrYear)){
								$action = "Edit";
							}
					?>
							<div class="col-lg-2 .col-md-2 .col-sm-12" <?=$style?>>
								<!-- small box -->
								<div class="small-box <?=$background?> small-dashboard">
									<div class="inner">
										<h3 class="smallMobileHide"><a style="color:white" href="<?=vendor_app_util::url(['ctl'=>'user_month_salaries','act'=>'view?month='.$i.'&year='.$this->year]); ?>">Tháng <?= $i?> </a></h3>
									</div>
									<div class="icon">
									<i class="ion ion-pie-graph"></i>
									</div>
									<a href="<?=vendor_app_util::url(['ctl'=>'user_month_salaries','act'=>'month_setting?month='.$i.'&year='.$this->year]); ?>" class="small-box-footer"><?=$action ?> Settings <i class="fa fa-arrow-circle-right"></i></a>
									<!-- <a href="" class="small-box-footer" data-toggle="modal" data-target="#myModal"> Settings <i class="fa fa-arrow-circle-right"></i></a> -->
								</div>
							</div>
						<?php endfor; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>
