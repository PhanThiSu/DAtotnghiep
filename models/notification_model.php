<?php
class notification_model extends vendor_frap_model
{
	public $nopp = 20;
	public static $status = [
					0 => 'Disable',
					1 => 'Enable'
				];

	protected $relationships = [
		'belongTo'	=>	[
			['user','key'=>'user_id', 'on_del'=>false]		
		]
	];

    public function rules() {
		global $app;
		return [
        	'title' 	=> ['required', 'string', ['min', 'value'=>2]],
        	'content' 	=> ['required', 'string'],
	    ];
	}

	public function getUserReportsMonths($year) {
		global $app;
		$fields = "";
		for ($i=1; $i <= 12; $i++) { 
			$fields .= (($fields)?",":"")." SUM(CASE WHEN month(created)=".$i." THEN created ELSE 0 END) AS ".$app['months'][$i-1];
		}
		$conditions = " WHERE year(".$this->table.".created)=".$year." AND ";

		$group = " GROUP BY ". $this->table.".user_id";

		$sql = "SELECT ".$fields." FROM ".$this->table.$conditions.$group;
		exit($sql);
		$result = $this->con->query($sql);

		$record = ['data'=>[], 'total'=>0];
		if($result) {
			$row = $result->fetch_assoc();
			$record['data'] = $row;
			if ($row) {
				foreach($row as $v) {
					$record['total'] += $v;
				}
			}
		}
		return $record;
	}
}
?>