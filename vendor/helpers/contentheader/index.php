<section class="content-header">
  <h1> <?php echo $title; ?></h1>
  <!-- <ol class="breadcrumb">
    	<li><a href="<?php echo vendor_app_util::url(['ctl'=>'dashboard']); ?>"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
	<?php 
	$c = count($breadcrumb);	$j = 0;
	foreach ($breadcrumb as $v) { 
	$j++;
	?>
    	<li <?=($c==$j)? 'class="active"':'';?>>
    		<?php if($c!=$j) { ?> <a href="<?php echo vendor_app_util::url($v['urlp']); ?>"> <?php } ?>
    			<?=(isset($v['title']))? $v['title']: ucwords($v['urlp']['act'] .' '. $v['urlp']['ctl']);?>
    		<?php if($c!=$j) { ?> </a> <?php } ?>
    	</li>
    <?php } ?>
  </ol> -->
</section>