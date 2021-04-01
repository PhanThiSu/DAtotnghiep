<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>

<?php vendor_html_helper::contentheader('Quản lý <small>người dùng</small>', [
    [
      'title' =>  'Người dùng',
      'urlp'=>['ctl'=>$app['ctl']]],
    [
      'title' =>  'Chi tiết '.$this->record['firstname']." ".$this->record['lastname'],
      'urlp'  =>  ['ctl'=>$app['ctl'], 'act'=>$app['act']]
    ]
]); ?>

<section class="content">
	<?php 
		include_once 'views/admin/users/_form.php';
	?>
</section>

<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>