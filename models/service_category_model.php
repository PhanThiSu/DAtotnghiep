<?php
class service_category_model extends vendor_frap_model
{
	public $nopp = 20;
	public static $status = [
						0 => 'Disable',
						1 => 'Enable'
					];
					
	protected $relationships = [
			'hasMany'	=>	[
					'service',
					'key'=>'category_id'						
			]
		];
	
	public function rules()
	{
		global $app;
	    return [
        	'name' 		=> [['required', 'errmsg'=>'Name can not bank!'], 'string', ['max', 'value'=>250]],
        	'slug' 		=> [['required', 'errmsg'=>'Slug can not bank!'], 
        					['unique',   'errmsg'=>'This value already existing! Slug should be unique!'], 
        					 'string', ['max', 'value'=>250]],
        	//'alias' 	=> [['required', 'errmsg'=>'Slug can not bank!'], 'unique', 'string', ['max', 'value'=>250]],	
	        'status'	=> [['inlist', 'value'=>array_keys(self::$status)]]
	    ];
	}
}
