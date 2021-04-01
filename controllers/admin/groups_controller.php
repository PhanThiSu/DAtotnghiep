<?php
//class groups_controller extends vendor_crud_controller {
class groups_controller extends vendor_backend_controller {
	public function index() {
		$pm = new group_model();
		$tableNameP = $pm->getTableName();
		$this->noGroups 			= $pm->getCountRecords();
		$this->noUseGroups 		= $pm->getCountRecords(['conditions'=>'status != 2']);
		$this->noSuggestionGroups = $pm->getCountRecords(['conditions'=>'status=0']);
		$this->records = $pm->allp('*',['conditions'=>''.$tableNameP.'.status != 2', 'joins'=>['user']]);
		$this->display();
	}

	public function suggested() {
		$pm = new group_model();
		$this->noGroups 			= $pm->getCountRecords();
		$this->noUseGroups 		= $pm->getCountRecords(['conditions'=>'status != 2']);
		$this->noSuggestionGroups = $pm->getCountRecords(['conditions'=>'status=0']);
		$this->records = $pm->allp('*',['conditions'=>'status=0']);
		$this->display(['act'=>'index']);
	}

	public function view($id) {

		global $app;
		$um = new user_model();
		$this->users = $um->getAllRecords('id, firstname, lastname');
		$id = $app['prs'][1];
		
		$rm = new report_model();
		$tableName = $rm->getTableName();
		$pm = new group_model();

		$recordPr = $pm->getRecord($id);
		$leader_id = $recordPr['leader_id'] != null ? $recordPr['leader_id'] : null;
		if ($leader_id) {
			$this->leader =$um->getRecord($leader_id);
		}
		
		$prum = new groups_user_model();
		$this->usersJoined = $prum->getAllRecords('id, user_id',  ['conditions'=>'group_id ='.$id]);

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
		$conditions = $tableName.'.group_id='.$this->group_id;
		$fields = $tableName.'.user_id, '.$tableName.'.group_id, SUM(work_time) as total';
		$this->records = $rm->getAllRecords($fields,[
				'conditions'=>$conditions, 
				'group'=>$tableName.'.user_id',
				'order'=>$tableName.'.user_id',
				'joins'=>['user']
			]);
			
		$this->record = $pm->getRecord($id, "*", ['joins'=>['user']]);
		$this->display();
	}

	public function add() {
		$um = new user_model();
		$conditions = '';
		$this->users = $um->getAllRecords('id, firstname, lastname');
		$year = date('Y');
		$startYear  = $year."-01-01 00:00:00";
		$endYear    = $year."-12-31 23:59:59";
		$conditions .= 'time_start >= "'.$startYear.'" AND time_start <= "'.$endYear.'"';
		$this->time = $year;
		$this->timetype = 'year';
		$this->user = $um->getLongestUser($conditions);

	   	if(isset($_POST['name'] )) {
			$dataPr = [
				"name" => $_POST['name'],
				"start_day" => $_POST['start_day'],
				"end_day" => $_POST['end_day'],
				"user_created_id" => $_SESSION['user']['id'],
				"description" => $_POST['description'],
				"status" => $_POST['status'],
			];
			if ($_POST['leader_id']) {
				$dataPr['leader_id'] = $_POST['leader_id'];
			}
			
			$pm = new group_model();
			if( $pm->addRecord($dataPr)){
				if ($_POST['members']) {
					$usersJoined = explode('-', $_POST['members']);
					$lastId = $pm->getLastId();
					foreach ($usersJoined as $value) {
						$UserJonedData = [
							"group_id" => $lastId[0]['lastId'],
							"user_id" => $value,
						];
						$prum = new groups_user_model();
						if( $prum->addRecord($UserJonedData)){
							http_response_code(200);
						} else {
							$data = [
								'status' => 0,
								'message' => 'An error occurred when inserting data! '
							];
							http_response_code(200);
							echo json_encode($data); exit();
						}
					}
				}

				$data = [
					'status' => 1,
					'data' => $dataPr
				];
				http_response_code(200);
				echo json_encode($data); exit();
			} else {
				$data = [
					'status' => 0,
					'message' => 'An error occurred when inserting data! '
				];
				http_response_code(200);
				echo json_encode($data); exit();
			}
		
		}

		$this->display();
	}

	public function edit($id) {
		$um = new user_model();
		$this->users = $um->getAllRecords('id, firstname, lastname');

		$pm = new group_model();
		$this->record = $pm->one($id);

		$prum = new groups_user_model();
		$this->usersJoined = $prum->getAllRecords('id, user_id',  ['conditions'=>'group_id ='.$id]);

		if(isset($_POST['name'] )) {

			$dataPr = [
				"name" => $_POST['name'],
				"start_day" => $_POST['start_day'],
				"end_day" => $_POST['end_day'],
				//"user_created_id" => $_SESSION['user']['id'],
				"description" => $_POST['description'],
				"status" => $_POST['status'],
			];
			if ($_POST['leader_id']) {
				$dataPr['leader_id'] = $_POST['leader_id'];
			}
			$pm = new group_model();
			if( $pm->editRecord($id, $dataPr)){

				if ($_POST['members']) {
					$usersJoined = explode('-', $_POST['members']);

					if ($this->usersJoined->num_rows != 0) {
						$listUsers_id = [];
						foreach ($this->usersJoined as $value) {
							array_push($listUsers_id, $value['user_id']);
						}

						$eleDel = array_diff($listUsers_id, $usersJoined );
						$eleAdd = array_diff($usersJoined, $listUsers_id );

						if (!empty($eleDel) ) {
							foreach ($eleDel as $value) {
								if( $prum->delRecord(null, 'user_id='.$value)){
									http_response_code(200);
								} else {
									$data = [
										'status' => 0,
										'message' => 'An error occurred when editing data! '
									];
									http_response_code(200);
									echo json_encode($data); exit();
								}
							}
						}
						if (!empty($eleAdd)) {
							foreach ($eleAdd as $value) {
								$UserJonedData = [
									"group_id" => $id,
									"user_id" => $value,
								];
								if( $prum->addRecord($UserJonedData)){
									http_response_code(200);
								} else {
									$data = [
										'status' => 0,
										'message' => 'An error occurred when editing data! '
									];
									http_response_code(200);
									echo json_encode($data); exit();
								}
							}
						}
						
					} else {
						foreach ($usersJoined as $value) {
							$UserJonedData = [
								"group_id" => $id,
								"user_id" => $value,
							];
							if( $prum->addRecord($UserJonedData)){
								http_response_code(200);
							} else {
								$data = [
									'status' => 0,
									'message' => 'An error occurred when inserting data! '
								];
								http_response_code(200);
								echo json_encode($data); exit();
							}
						}
					}
				}

				$data = [
					'status' => 1,
					'data' => $dataPr
				];
				http_response_code(200);
				echo json_encode($data); exit();
			} else {
				$data = [
					'status' => 0,
					'message' => 'An error occurred when inserting data! '
				];
				http_response_code(200);
				echo json_encode($data); exit();
			}

		}
		$this->display();
	}

	public function trash() {
		global $app;
		$id = $app['prs'][1];
		$group = new group_model();
		$groupData['status'] = 2;
		if($group->editRecord($id, $groupData)) echo "Delete Successful";
		else echo "error";
	}

	public function del($id) {
		$group = new group_model();
		if($group->delRecord($id)) echo "Delete Successful";
		else echo "error";
	}

	public function trashmany() {
		global $app;
		$ids = $app['prs']['ids'];
		$groups = new group_model();
		$groupData['status'] = 2;
		if($groups->editRecords($ids, $groupData)) echo "Delete Successful";
		else echo "error";
	}

	public function delmany() {
		global $app;
		$ids = $app['prs']['ids'];
		$groups = new group_model();
		if($groups->delRecords($ids)) echo "Delete Successful";
		else echo "error";
	}
}
