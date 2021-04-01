<?php 
class user_level_salary_model extends vendor_frap_model
{
	public $nopp = 20;
	protected $relationships = [
		'belongTo'	=>	[
			['user','key'=>'user_id']		
		]
	];
	public function rules() {
		global $app;
	    return [
        	'basic_salary' => ['required','number'],
	    ];
	}

	public function getRecordUserId($id) {
		global $app;
		$sql = "Select * From ".$this->getTableName()." where ".$this->getTableName().".user_id =".$id;
		$result = $this->con->query($sql);

		return $record=$result->fetch_assoc();
	}
}