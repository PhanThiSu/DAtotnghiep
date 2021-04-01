<?php
class groups_user_model extends  vendor_frap_model
{
	public $nopp = 20;

	protected $relationships = [
		'belongTo'	=>	[
			['user','key'=>'user_id'],
			['group', 'key'=>'group_id']
		]
	];

	public function rules() {
		global $app;
	    return [
        	'group_id'=> ['required'],
        	'user_id' 	=> ['required'],
	    ];
	}

}
?>