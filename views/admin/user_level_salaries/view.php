<?php include_once 'views/admin/layout/'.$this->layout.'top.php'; ?>

<?php vendor_html_helper::contentheader('User_level_salaries <small>management</small>', [
    [
      'title' =>  'User_level_salaries',
      'urlp'=>['ctl'=>$app['ctl']]],
    [
      'title' =>  'Detail of '.$this->record['firstname']." ".$this->record['lastname'],
      'urlp'  =>  ['ctl'=>$app['ctl'], 'act'=>$app['act']]
    ]
]); ?>

<section class="content">
	<?php 
		include_once 'views/admin/user_level_salaries/_form.php';
	?>
</section>

<?php include_once 'views/admin/layout/'.$this->layout.'footer.php'; ?>