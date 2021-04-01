<?php global $app; ?>
<div class="col-sm-5"></div>
<!-- <div class="col-sm-5"><div class="dataTables_info" id="table_info" role="status" aria-live="polite">
	<?= "Showing page $curp, from $from to $to of $norecords entries"; ?>
</div></div> -->
<div class="col-sm-7">
	<div class="dataTables_paginate paging_simple_numbers" id="table_paginate">
		<ul class="pagination pull-right">
			<li class="paginate_button previous <?php echo ($curp==1)? 'disabled':'';?>" id="table_previous">
				<a href="<?php global $app;
					echo ($curp==1)? 'javascript:void(0);' : vendor_app_util::purl(['ctl'=>$app['ctl'], 'act'=>$app['act']], ($curp-1)); ?>" aria-controls="example1" data-dt-idx="<?=($curp-1); ?>" tabindex="0">Trước</a>
			</li>
			
			<!-- First -->
			<?php $start=1; if($curp>2 && $nopages>3){ ?>
			<li class="paginate_button">
				<a href="<?php global $app;
					echo ($curp==$start)? 'javascript:void(0);' : vendor_app_util::purl(['ctl'=>$app['ctl'], 'act'=>$app['act']], $start); ?>" tabindex="0">Đầu tiên</a>
			</li>
			<li class="paginate_button disabled">
				<a href="javascript:void(0);">...</a>
			</li>
			<?php } ?>

			<!-- center -->
			<?php $start=($curp-1)<1?1:($curp-1);$end=($curp+1)>$nopages?$nopages:($curp+1);for($i=$start; $i <= $end; $i++){ ?>
			<li class="paginate_button <?php if($i==$curp) echo('active') ?>">
				<a href="<?php global $app;
					echo ($curp==$i)? 'javascript:void(0);' : vendor_app_util::purl(['ctl'=>$app['ctl'], 'act'=>$app['act']], $i); ?>" data-dt-idx="<?php echo($i); ?>" tabindex="0"><?php echo($i); ?></a>
			</li>
			<?php } ?>

			<!-- Last -->
			<?php $end=$nopages; if($end-$curp>1 && $nopages>3){ ?>
			<li class="paginate_button disabled">
				<a href="javascript:void(0);">...</a>
			</li>
			<li class="paginate_button">
				<a href="<?php global $app;
					echo ($curp==$end)? 'javascript:void(0);' : vendor_app_util::purl(['ctl'=>$app['ctl'], 'act'=>$app['act']], $end); ?>" tabindex="0">Last (<?=$nopages.')';?></a>
			</li>
			<?php } ?>

			<li class="paginate_button next <?php echo ($curp==$nopages)? 'disabled':'';?>" id="table_next">
				<a href="<?php global $app;
					echo ($curp==$nopages)? 'javascript:void(0);' : vendor_app_util::purl(['ctl'=>$app['ctl'], 'act'=>$app['act']], ($curp+1));?>" aria-controls="example1" data-dt-idx="<?=($curp+1); ?>" tabindex="0">Kế tiếp
				</a>
			</li>
		</ul>
	</div>
</div>