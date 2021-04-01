<?php
class log_time_model extends  vendor_frap_model
{		
	public $nopp = 20;
	protected $table = 'logtime';
	protected $relationships = [
		'belongTo'	=>	[
			['user','key'=>'user_id'],
			['group', 'key'=>'group_id']			
		]
	];

	public function rules() {
		global $app;
	    return [
        	'user_id' 	=> ['required'],
        	'job' 		=> ['required'],
        	'time_start'=> ['required', 'datetime'],
        	'time_end' 	=> ['required', 'datetime'],
        	'work_time' => ['required', 'number'],
        	'group_id'=> ['required']
	    ];
	}

	public function getUserReportsMonths($user_id, $year) {
		global $app;
		$fields = "";
		for ($i=1; $i <= 12; $i++) { 
			$fields .= (($fields)?",":"")." SUM(CASE WHEN month(time_start)=".$i." THEN work_time ELSE 0 END) AS ".$app['months'][$i-1];
		}
		$conditions = " WHERE year(".$this->table.".time_start)=".$year." AND ".$this->table.".user_id=".$user_id;

		$group = " GROUP BY ". $this->table.".user_id";

		$sql = "SELECT ".$fields." FROM ".$this->table.$conditions.$group;
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

	public function getUserReportsDays($user_id, $week) {
		global $app;
		$startWeek  = date('Y-m-d',strtotime($week));
		$fields = "";
		for ($i=0; $i < 7; $i++) { 
			$fields .= (($fields)?",":"")." SUM(CASE WHEN date(time_start)='".(date('Y-m-d', strtotime('+'.$i.' day', strtotime($startWeek))))."' THEN work_time ELSE 0 END) AS ".$app['weekdays'][$i];
		}
		$conditions = " WHERE ".$this->table.".user_id=".$user_id;

		$group = " GROUP BY ". $this->table.".user_id";

		$sql = "SELECT ".$fields." FROM ".$this->table.$conditions.$group;
		$result = $this->con->query($sql);

		$record = ['data'=>[], 'total'=>0];
		if($result) {
			$row = $result->fetch_assoc();
			$record['data'] = $row;
			if($row)
				foreach($row as $v) $record['total'] += $v;
		}
		return $record;
	}

	public function getUsersDaysTotal($sql) {
		return $this->con->query($sql)->fetch_assoc();
	}
}
?>