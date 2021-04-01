<?php
class common_setting_model extends  vendor_frap_model
{
	protected $table = 'common_settings';
	public static $status = [
						0 => 'Suggestion',
						1 => 'Enable',
						2 => 'Disable'
					];

	protected $relationships = [
		'hasMany'	=>	[
			['report',	'key'=>'group_id',	'on_del'=>true]
		],
		'belongTo'	=>	[
			['user','key'=>'user_created_id']		
		]
	];

	public function rules() {
		global $app;
	    return [
        	'name'		=> ['required', 'unique', 'string', ['max', 'value'=>250]],
	        'status'	=> [['inlist', 'value'=>array_keys(self::$status)]]
	    ];
	}

}

