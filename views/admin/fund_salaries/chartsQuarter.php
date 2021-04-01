<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css"><link rel="stylesheet" href="<?php echo RootREL; ?>media/select2/select2.min.css">
<script> var data = [], labels=[];  </script>
<?php vendor_html_helper::contentheader('Charts Salaries <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]);?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border row id="reports-header">
					<div class="col-sm-6">
						<h3 class="box-title">
                            Charts salaries per quarter in <?=$this->year?> <?= !empty($this->quarter) ? ", quarter (".$this->quarter.")":"" ?>  </a>
						</h3>
					</div>
					<div class="col-sm-6">
						<h3 class="box-title text-info pull-right text-right">In <?=$this->year;?> total salaries year<?= !empty($this->quarter) ? ", quarter (".$this->quarter.")":"" ?>  is <strong class="text-danger"><?= number_format($this->record['total']);?></strong> (vnd)</h3>
					</div>
			    </div>
			    <div class="box-body row">
					<!-- <div class="col-sm-12 col-xs-12"> -->
					<div class="col-sm-9 col-xs-9">
		      			<form id="form-report" action="<?php echo vendor_app_util::url(["ctl"=>"fund_salaries", "act"=>'chartsQuarter']); ?>" method="post" enctype="multipart/form-data" class="form-inline">
							<div class="form-group mr-1">
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

					<div class="col-sm-12">

						<?php if(!empty($this->record['total'])){?>
							<canvas id="bar-chart" width="100%" height="40px"></canvas>
						<?php } else{?>
							<tr role="row"><td colspan="3"><h3 class="text-danger text-center"> No data</h3></td></tr>
						<?php }?>
						<script>
							var dataPointsSalaryLabel = <?= json_encode($this->pointsLabel) ?>;
							var dataPointsSalary = <?= json_encode($this->pointsData) ?>;
						</script>
					</div>
	    			
	    		</div>
		    	<!-- /.box-header -->
			</div>
		</div>
	</div>
</section>
<script src="<?php echo RootREL; ?>media/admin/js/userstimegroups.js"></script>	
<script src="<?php echo RootREL; ?>media/select2/select2.full.min.js"></script>
<script src="<?php echo RootREL; ?>media/chartjs/Chart.min.js"></script>
<script src="<?php echo RootREL; ?>media/admin/js/fundSalaries.js"></script>	
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>

