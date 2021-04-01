<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>
<link rel="stylesheet" href="<?php echo RootREL; ?>media/bootstrap/css/dataTables.bootstrap.min.css">
<script> var data = [], labels=[];  </script>
<?php vendor_html_helper::contentheader('Lists Salaries <small>management</small>', [['urlp'=>['ctl'=>$app['ctl'], 'act'=>$app['act']]]]);?>

<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
			    <div class="box-header with-border row id='reports-header' ">
					<div class="col-sm-6">
						<h3 class="box-title">
                            Salaries in <?= date('Y-m')?>
						</h3>
					</div>
					<div class="col-sm-6">
						<h3 class="box-title text-info pull-right text-right"> Total salaries month current is <strong class="text-danger"><?= number_format($this->salary);?></strong> (vnd)</h3>
					</div>
			    </div>
			    <div class="box-body row">
					<!-- <div class="col-sm-12 col-xs-12"> -->
                    

					<div class="col-sm-12">
                        <?php if(!empty($this->salary)){?>
                            <table id="table_reports" class="table table-bordered table-striped dataTable" role = "grid" aria-describedby="example1_info" controller="reports" >
                                <thead>
                                    <tr role="row">
                                        <th>Field</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-reports">
                                <tr>
                                    <td><?= date('Y-m')." (".date('M'.")") ?></td>
                                    <td><?= number_format($this->salary) ?></td>
                                    <td><a type="button" class="btn btn-success view-record usermonth" alt="<?=$this->time.'-'.(($i<10)? '0':'').$i;?>" href="<?=vendor_app_util::url(array('ctl'=>'reports','act'=>'month')); ?>"><i class="fa fa-eye" aria-hidden="true"></i>
                                                </a></td>
                                </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Field</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        <?php } else{?>
                            <tr role="row"><td colspan="3"><h3 class="text-danger text-center"> No data</h3></td></tr>
                        <?php }?>
					</div>
	    		</div>
		    	<!-- /.box-header -->
			</div>
		</div>
	</div>
</section>
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>

