<?php
class group_model extends  vendor_frap_model
{
	// protected $table = 'group';

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

	public function getLongestGroup() {
		$join = "";
		$fields = $this->table.".id, ".$this->table.".name";
		if(isset($this->relationships)) {
			$joinFields = $join = "";
			foreach($this->relationships as $k=>$rv) {
				if(!vendor_app_util::is_multi_array($rv)) {
					$vtmp = $rv;
					$rv = [];
					$rv[] = $vtmp;
				}
				foreach($rv as $v) {
					if(isset($options['joins']) && ($v[0]!='report'))
						continue;
					$joinTable = $this->getTableNameFromModelName($v[0]);
					$joinTableFields = $this->getAllFieldsOfTable($joinTable);
					if($k=="hasMany") {
						$joinFields .= ", SUM(".$joinTable.".work_time) as group_time";
						$join .= " RIGHT JOIN ".$joinTable." ON ".$this->table.".id=".$joinTable.".".$v['key']." ";
					}
				}
			}
			if($joinFields)	$fields .= $joinFields;
		}
		$group = " GROUP BY ".$this->table.".id";

		$order = " ORDER BY group_time DESC";
		$limit = " LIMIT 1";
		$sql = "SELECT ".$fields." FROM ".$this->table.$join.$group.$order.$limit;
		$result = $this->con->query($sql);
		if($result) {
			$record = $result->fetch_assoc();
		} else $record=false;
		return $record;
	}

	public function getTotalTimeGroup($id) {

	}

	public function getLastId(){
		$query = " SELECT MAX(id) as lastId  FROM ".$this->table." ";
		$result = $this->con->query($query);
		while($row = mysqli_fetch_assoc($result)) {
			$rows[] = $row;
		}
		return $rows;
	}

	public static function getName($id) {
		$group = (new self)->getRecord($id);
		return ucfirst($group['name']);
	}
}

