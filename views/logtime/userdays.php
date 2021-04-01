<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">

<?php vendor_html_helper::contentheader('reports <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]); ?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border row" id="reports-header">
					<div class="col-sm-6">
						<h3 class="box-title">
							Report each month in <?=$this->time?> of <?=vendor_html_helper::link($this->fullname, ["ctl"=>"users", "act"=>"profile"])?>
						</h3>
					</div>
					<div class="col-sm-6">
						<h3 class="box-title text-info pull-right text-right">In <a class="dayweek" alt="<?=$this->time;?>" href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'profile')); ?>"><?=$this->time;?></a>, <?=vendor_html_helper::link($this->fullname, ["ctl"=>"users", "act"=>"profile"])?> have worked <strong class="text-danger"><?=$this->record['total'];?></strong> hour(s)</h3>
					</div>
			    </div>
			    <div class="box-body row">
	    			<div class="col-sm-9 col-xs-9">
		      			<form id="form-report" action="<?php echo vendor_app_util::url(["ctl"=>"reports", "act"=>'userdays/'.$this->user_id]); ?>" method="post" enctype="multipart/form-data" class="form-inline">
							<div class="form-group">
							    <label class="sr-only" for="exampleInputAmount">Select week: </label>
							    <div class="input-group">
							      	<div class="input-group-addon mobileHide">Select week: </div>
		      						<input type="week" name="week" class="form-control selectInput" id="week" placeholder="Month..." value="<?=$this->time;?>">
		      					</div>
		      				</div>
							<button type="submit" class="btn btn-info">Submit</button>
		      			</form>
	    			</div>

	    			<div class="col-sm-3 col-xs-3">
	    				<button id="delete-reports" class="btn btn-danger pull-right">
	    					<i class="fa fa-remove"></i>
	    				</button>
	    				<a href="<?php echo vendor_app_util::url(['ctl'=>'reports','act'=>'add']); ?>" id="add-report" type = "button" class="btn btn-primary pull-right" >
	    					<i class="fa fa-plus"></i>
	    				</a>	
	    			</div>
	    		</div>
		    	<!-- /.box-header -->
		    
			    <div class="box-body">
					<div id="table_wrapper" class="dataTables_wrapper form-inline dt-boostrap">
						<div class="row">
							<div class="col-sm-12">
								<table id="table_reports" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby="example1_info" controller="reports" >
									<thead>
										<tr role="row">
											<th>Field</th>
											<th>Value</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody id="tbody-reports">
									<?php if(count($this->record['data'])) { ?>
										<?php $i=0;?>
						                <?php foreach($this->record['data'] as $k=>$v) { ?>
						                	<tr>
												<td><?=$k; ?> - <?=date('Y-m-d', strtotime('+'.$i.' day', strtotime($this->monday)))?></td>
												<td><?=$v; ?></td>
												<td>
													<a type="button" class="btn btn-success view-record userdayweek" alt="<?=date('Y-m-d', strtotime('+'.$i.' day', strtotime($this->monday)))?>" href="<?=vendor_app_util::url(array('ctl'=>'reports', 'act'=>'daily/'.$i)); ?>"><i class="fa fa-eye" aria-hidden="true"></i>
													</a>
												</td>
						                	</tr>
											<?php $i++;?>
						                <?php } ?>
									<?php } else { ?>
										<tr role="row"><td colspan="3"><h3 class="text-danger text-center"> No data </h3></td></tr>
						            <?php } ?>
									</tbody>
									<tfoot>
					                	<tr>
											<th>Field</th>
											<th>Value</th>
											<th>Action</th>
					                	</tr>
					                </tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function () {
      $('.box').on('click','.userdayweek', function (e) {
        e.preventDefault();
        var url     = $(this).attr('href');
        if($(this).attr('type')=='button')
            var field   = {'date': $(this).attr('alt')};
        else
            var field   = {'week': $(this).attr('alt')};
        util.post(url, field);
      });
    });
</script>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>
