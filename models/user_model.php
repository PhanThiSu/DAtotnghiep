<?php
class user_model extends vendor_frap_model
{
	public $nopp = 20;
	public static $avatUrl = UploadREL."users/";
	public static $status = [
						0 => 'Disable',
						1 => 'Enable'
					];

	protected $relationships = [
		'hasMany'	=>	[
			['report',	'key'=>'user_id',	'on_del'=>true],
			['request',	'key'=>'user_id',	'on_del'=>true],
			['group', 'key'=>'user_id',	'on_del'=>false],		
		],
		'belongTo'	=>	[
			['user','key'=>'user_created_id']		
		]
	];

	public function rules() {
		global $app;
	    return [
        	'firstname' => ['string', ['max', 'value'=>50]],
        	'lastname' 	=> ['string', ['max', 'value'=>50]],
        	'email' 	=> [['required', 'errmsg'=>'Email can not bank!'], 'unique', ['email','errmsg'=>'Value is invalid email format!'], ['max', 'value'=>60]],
        	'phone' 	=> ['number', ['min', 'value'=> 9], ['max', 'value'=>14]],
	        'password' 	=> ($app['act']=='edit')? []: [['min', 'value'=> 4], ['max', 'value'=>60]],
	        				// Problem when edit user -> can't validate password
	        'address' 	=> ['string'],
	        'role'		=> [['inlist', 'value'=>array_keys($app['roles'])]],
	        'status'	=> [['inlist', 'value'=>array_keys(self::$status)]]
	    ];
	}

	public static function getAvataUrl() {
		return RootURL.self::$avatUrl.$_SESSION['user']['avata'];
	}

	public static function getFullnameLogined() {
		return ucfirst($_SESSION['user']['firstname'])." ".ucfirst($_SESSION['user']['lastname']);
	}

	public static function getFullname($id) {
		$user = (new self)->getRecord($id);
		return ucfirst($user['firstname'])." ".ucfirst($user['lastname']);
	}

	public function getTopUser()
	{
		$rsAll = $this->getAllData();
		$topUser = array();
		for($id = 0; $id < NUM_TOP_USERS; $id++){
			if(isset($rsAll[$id]))
				$topUser[$id] = $rsAll[$id];
			else break;
		}
		return $topUser;
	}

	public function getAllChangepass()
	{
		$email = ucfirst($_SESSION['user']['email']);
		$sql = "SELECT `password` FROM `users` WHERE `email` = '".$email."'";
		$result = $this->con->query($sql);
		
		return $result;
	}

	public function checkOldPassword($password)
	{
		$email = ucfirst($_SESSION['user']['email']);
		$sql = "SELECT COUNT(id) as total  FROM `users` WHERE `email` = '".$email."' AND `password` = '".$password."'";
		$result = $this->con->query($sql);
		return $result->fetch_assoc()['total'];
	}

	public function updatePassword($newpassword)
	{
		$email = ucfirst($_SESSION['user']['email']);
		$sql = "UPDATE users SET password='$newpassword' WHERE `email` = '".$email."'";
		$result = $this->con->query($sql);
		
		return $result;
	}
	
	public function profile(){
		$email = ucfirst($_SESSION['user']['email']);
		$sql = "SELECT * FROM `users`  WHERE `email` = '".$email."'";
		$result = $this->con->query($sql);
		if($result) {
			$record = $result->fetch_assoc();
		} else $record=false;
		return $record;
	}

	public function getLongestUser() {
		$join = "";
		$fields = $this->table.".id, ".$this->table.".lastname";
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
						$joinFields .= ", SUM(".$joinTable.".work_time) as user_time";
						$join .= " RIGHT JOIN ".$joinTable." ON ".$this->table.".id=".$joinTable.".".$v['key']." ";
						break;
					}
				}
			}
			if($joinFields)	$fields .= $joinFields;
		}
		$group = " GROUP BY ".$this->table.".id";

		$order = " ORDER BY user_time DESC";
		$limit = " LIMIT 1";
		
		$sql = "SELECT ".$fields." FROM ".$this->table.$join.$group.$order.$limit;
		$result = $this->con->query($sql);
		if($result) {
			$record = $result->fetch_assoc();
		} else $record=false;
		return $record;
	}
}
?>