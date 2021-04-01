<?php
class leader_groups_controller extends vendor_main_controller {
	// public function __construct() {
	// 	$this->checkRole();
	// 	parent::__construct();
	// }

	// public function checkRole() {
	// 	global $app;
	// 	$this->checkAuth();
	// 	$rolesFlip = array_flip($app['roles']);
	// 	if (isset($_SESSION['user']['role']) && $_SESSION['user']['role']==$rolesFlip["admin"] || $_SESSION['user']['role']==$rolesFlip["leader"]) 
	// 	{
	// 		header( "Location: ".vendor_app_util::url(array('ctl'=>'groups')));

	// 	} else {
	// 		header( "Location: ".vendor_app_util::url(array('ctl'=>'login')));
	// 	}
	// }

	public function index()
	{
		$conditions = '';
		$user_id = $_SESSION['user'] && $_SESSION['user']['id'] ? $_SESSION['user']['id'] : null;
		$pm = new group_model();
		
		$conditions .= 'status != 2 AND leader_id = '.$user_id.'';
		// echo "Start <br/>"; echo '<pre>'; print_r($conditions);echo '</pre>';exit("End Data");

		$this->noGroups 			= $pm->getCountRecords(['conditions'=> $conditions ]);
		$this->records = $pm->allp('*',['conditions'=> $conditions ]);
		$this->display();
	}

	public function view($id) {

		global $app;
		$rm = new report_model();
		$tableName = $rm->getTableName();
       	$pm = new group_model();
		$this->groups = $pm->getAllRecords('id, name', ['conditions'=>'status!=2']);


		
		$this->group_id = $id;
		$tableNameP = $pm->getTableName();
		$fields = $tableNameP.".id, ".$tableNameP.".name, SUM(".$tableName.".work_time) as group_time";

		$pm = new group_model();
			$group_id = $id;
			$tableNameP = $pm->getTableName();
			$fields = $tableNameP.".id, ".$tableNameP.".name, SUM(".$tableName.".work_time) as group_time";
			
			$group = $tableNameP.".id";
			$order = "group_time DESC";
			$limit = "1";


		$this->group = $pm->getRecord($this->group_id, $fields, [
				'group'=> $group,
				'order'=> $order,
				'limit'=> $limit,
				'joins'=>['report']
			]);

			$conditions = $tableName.'.group_id='.$this->group_id[1];
			$fields = $tableName.'.user_id, '.$tableName.'.group_id, SUM(work_time) as total';
			$this->records = $rm->getAllRecords($fields,[
				'conditions'=>$conditions, 
				'group'=>$tableName.'.user_id',
				'order'=>$tableName.'.user_id',
				'joins'=>['user']
				]);
				
			
		$this->record = $pm->getRecord($id);
		// exit(json_encode($this->group));
		$this->display();
	}
}
?>