<?php 
class user_month_setting_model extends vendor_frap_model
{
	public $nopp = 20;
    protected $relationships = [
		'belongTo'	=>	[
			['user','key'=>'user_id', 'on_del'=>false]		
		]
	];

}