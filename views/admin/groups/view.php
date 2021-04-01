<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>

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
		include_once 'views/admin/groups/_form.php';
	?>
  <?php 
    include_once 'views/admin/groups/_view.php';
  ?>
</section>


  <!-- /.box -->
<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>