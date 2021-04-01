<?php include_once 'views/layout/'.$this->layout.'headerTop.php'; ?>

<?php vendor_html_helper::contentheader('Groups <small>management</small>', [
    [
      'title' =>  'Groups',
      'urlp'=>['ctl'=>$app['ctl']]],
    [
      'title' =>  'Detail of '.$this->record['name'],
      'urlp'  =>  ['ctl'=>$app['ctl'], 'act'=>$app['act']]
    ]
]); ?>

<section class="content">
	<?php 
		include_once 'views/leader_groups/_form.php';
	?>
  <?php 
    include_once 'views/leader_groups/_view.php';
  ?>
</section>


  <!-- /.box -->
<?php include_once 'views/layout/'.$this->layout.'footer.php'; ?>