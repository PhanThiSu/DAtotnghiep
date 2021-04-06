<?php
class reports_controller extends vendor_auth_controller
{
	protected 	$errors = false;
	public function index() {
		$rm = new report_model();
		$user_id = ucfirst($_SESSION['user']['id']);
		$this->records = $rm->allp('*',['conditions'=>'reports.user_id = '.$user_id, 'joins'=>['user','group']]);
		// exit(json_encode(		$this->records));
		$this->display();
	}

	public function month() {
		$rm = new report_model();
		$user_id = ucfirst($_SESSION['user']['id']);
		$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
		$startMonth = $month.'-01 00:00:00';
		$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
		$conditions = $rm->getTableName().'.user_id='.$user_id;
		$this->time = $month; 
		$this->user_id = $user_id;
		$this->fullname = user_model::getFullname($user_id);
		$conditions .= ' AND (time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'" AND  reports.user_id = "'.$user_id.'")';
		if($rm->getTotal('work_time', $conditions) != 0) { 
			$this->timetotal = $rm->getTotal('work_time', $conditions);
		} else {
			$this->timetotal = 0;
		}

		$this->records = $rm->allp('*',['conditions'=> $conditions, 'joins'=>['user','group']]);
		$this->display();
	}

	public function usermonths() {
		$user_id =  ucfirst($_SESSION['user']['id']);
		$rm = new report_model();
		$year = (isset($_POST['year']))? $_POST['year'] : date('Y');

		$this->time 	= $year;
		$this->user_id 	= $user_id;
		$this->fullname = user_model::getFullname($user_id);
		$this->record 	= $rm->getUserReportsMonths($user_id, $year);
		$this->display();
	}

	public function week() {
		global $app;
		$rm = new report_model();
		$week = (isset($_POST['week']))? $_POST['week'] : date("Y")."-W".date("W");
		$user_id = ucfirst($_SESSION['user']['id']);
		$this->time = $week; 
		$this->fullname = user_model::getFullname($user_id);
		//$startWeek  = date('Y-m-d',strtotime($week));
		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
		$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week

		for($i=1; $i<=7; $i++){
			$this->weekDays['dayNumber'][$i] = date('d',strtotime("$week-"."$i"));
			$this->weekDays['dayText'][$i] = date('D',strtotime("$week-"."$i"));
			$this->weekDays['month'][$i] = date('M',strtotime("$week-"."$i"));
		}
		// exit(json_encode($this->weekDays));

		$tableName = $rm->getTableName();
		$fields = $tableName.".user_id, ".$tableName.".job ";
		for ($i=0; $i < 7; $i++) { 
			$fields .= ", SUM(CASE WHEN date(time_start)='".(date('Y-m-d', strtotime('+'.$i.' day', strtotime($startWeek))))."' THEN work_time ELSE 0 END) AS ".$app['weekdays'][$i];
		}
		$fields .= ", SUM(CASE WHEN date(time_start)>='".(date('Y-m-d', strtotime($startWeek)))."' and date(time_end) <='".(date('Y-m-d', strtotime($endWeek)))."' THEN work_time ELSE 0 END) AS Total ";
		
		$this->records = $rm->allp($fields,[
				'joins'=>['model'=>'group', 'type'=>'JOIN', 'joinFields'=>"name"],
				'group'=>$tableName.'.group_id , '.$tableName.'.job',
				'order'=>$tableName.'.user_id',
				// 'conditions'=>	'users.role!=1 AND users.status != 0'
				'conditions'=>	'reports.user_id='.$_SESSION['user']['id'].' and date(time_start)>="'.(date('Y-m-d', strtotime($startWeek))).'" and date(time_end) <="'.(date('Y-m-d', strtotime($endWeek))).'"'
			]);

		// exit(json_encode($this->records));
		
		$fields = $tableName.".user_id";
		for ($i=0; $i < 7; $i++) { 
			$fields .= ", SUM(CASE WHEN date(time_start)='".(date('Y-m-d', strtotime('+'.$i.' day', strtotime($startWeek))))."' THEN work_time ELSE 0 END) AS ".$app['weekdays'][$i];
		}
		$fields .= ", SUM(CASE WHEN date(time_start)>='".(date('Y-m-d', strtotime($startWeek)))."' and date(time_end) <='".(date('Y-m-d', strtotime($endWeek)))."' THEN work_time ELSE 0 END) AS Total ";
		
		$this->recordTotal = $rm->getAllRecordsLimit($fields,[
				'group'=>$tableName.'.user_id ',
				'order'=>$tableName.'.user_id',
				'conditions'=>	'reports.user_id='.$_SESSION['user']['id']
			]);
		$this->recordTotal = $this->recordTotal->fetch_assoc();


	
		$this->display();
	}

	public function week1() {
		$rm = new report_model();
		$week = (isset($_POST['week']))? $_POST['week'] : date("Y")."-W".date("W");
		//$startWeek  = date('Y-m-d',strtotime($week));
 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
		// exit(date('d',strtotime($startWeek)));
    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week
		
		$user_id = ucfirst($_SESSION['user']['id']);
		$conditions = $rm->getTableName().'.user_id='.$user_id;
		$this->time = $week; 
		$this->user_id = $user_id;
		$this->fullname = user_model::getFullname($user_id);
		$conditions .= ' AND (time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'" AND  reports.user_id = "'.$user_id.'")';
		$this->timetotal = $rm->getTotal('work_time', $conditions);
		$this->records = $rm->allp('*',['conditions'=>$conditions, 'joins'=>['user','group']]);
		// exit(json_encode($this->records));
		$this->display();
	}
	
	public function userdays() {
		$user_id =  ucfirst($_SESSION['user']['id']);
		$rm = new report_model();
		$week = (isset($_POST['week']))? $_POST['week'] : date("Y")."-W".date("W");

		$this->time 	= $week;
		$this->monday 	= date('Y-m-d',strtotime($week));
		$this->user_id 	= $user_id;
		$this->fullname = user_model::getFullname($user_id);
		$this->record 	= $rm->getUserReportsDays($user_id, $week);
		$this->display();
	}

	public function daily() {
		$user_id =  ucfirst($_SESSION['user']['id']);
		$rm = new report_model();
		$daily = (isset($_POST['date']))? $_POST['date'] : date("Y-m-d");
 		$startDate  = $daily." 00:00:00"; 
    	$endDate    = $daily." 23:59:59";

		$options = ['conditions'=>'time_start >= "'.$startDate.'" AND time_start <= "'.$endDate.'" AND user_id="'.$user_id.'"', 
					'joins'=>['user','group']
			];
		$this->records = $rm->allp('*', $options);
		$this->time = $daily;
		$this->display();
	}
	
	public function view($id) {
		global $app;
		$id = $app['prs'][1];
		$rm = new report_model();
		$this->record = $rm->one($id);
		$this->display();
	}

	public function err()
	{
		if (isset($_POST['group_name'])){
			$this->err = ($_POST['group_name']);
			// echo $_POST['group_name'];
			$groupData['name'] = $_POST['group_name'];
			$pm = new group_model();
			$pvalid = $pm->validator($groupData);
			if(!$pvalid['status']) {
			$this->errors['inputSuggest']	= 	$pm::convertErrorMessage($pvalid['message']);
			echo $this->errors['inputSuggest']['name'];
		}}
	}
	public function add() {
		global $app;
		$rm = new report_model();

		if(isset($_POST['btn_submit'])) {
			$today = date("Y-m-d");
			$reportData = $_POST['report'];
			$daysOff = vendor_app_util::daysOff();
			$reportData['checkOT'] 	= 1;
			if(in_array(date("Y-m-d"),$daysOff))
				$reportData['checkOT'] 	= 2;
			if(!isset($reportData['user_id']))		
				$reportData['user_id'] 		= $_SESSION['user']['id'];

			if(isset($reportData['time_start']))	
				$reportData['time_start'] 	= vendor_app_util::timeToDateTime($reportData['time_start']);

			$this->checkReport = $rm->getRecordWhere([
                "reports.user_id"=>$_SESSION['user']['id'],
                "reports.time_start"=>$reportData['time_start'],
			]);


			if(isset($reportData['time_end']))
				$reportData['time_end'] 	= vendor_app_util::timeToDateTime($reportData['time_end']);
			$reportData['date_report'] = $today;
			$pvalid = ['status'=>true];
			if(isset($_POST['group_suggestion']) && isset($_POST['group'])) {
				$groupData = $_POST['group'];
				$groupData['status'] = 0;
				$groupData['user_created_id'] = $_SESSION['user']['id'];
				$pm = new group_model();
				$pvalid = $pm->validator($groupData);
			}
			$valid = $rm->validator($reportData);


			if(!$valid['status'] || !$pvalid['status'] || $this->checkReport) {
				$this->errors['type']		=	'inputform';
				$this->errors['message']	=	'Error with input data';
				if($this->checkReport){
					$this->errors['message']	=	'time_start existed';
				}
				if(!$valid['status']) {
					$this->errors['inputForm']		= 	$rm::convertErrorMessage($valid['message']);
				}
				if(!$pvalid['status']) {
					$this->errors['inputSuggest']	= 	$pm::convertErrorMessage($pvalid['message']);
					$this->group_suggestion 		= 	$_POST['group_suggestion'];
					$this->group = $groupData;
				}
			} else {
				$doAddReport = true;
				if(isset($groupData['status'])) {
					if(!($rerult = $pm->addRecord($groupData))) {
						$this->group = $groupData;
						$this->group_suggestion = $_POST['group_suggestion'];
						$doAddReport = false;
					} else {
						$reportData['group_id'] = $rerult;

						$email = $_SESSION['user']['email'];
						$um = new user_model();
						$adminMails = $um->getAllRecords('email',['conditions'=>'role = 1']);
						$mTo = "";
						foreach ($adminMails as $record) {
							$mTo .= ($mTo? ", ": "").$record['email'];
						}
						$title = 'One group suggested';
						$href = RootURL."admin/groups/edit/".$reportData['group_id'];
						$content = "Has group suggested for you.Email sended from system.Please <a href=".$href."> click here </a> to go to group suggested";
						$nTo = 'TPM';
						
						vendor_app_util::sendMail($title, $content, $nTo, $mTo);
					}
				}
				
				if($doAddReport) {
					if($id = $rm->addRecord($reportData)) {
						log_model::setLog(log_model::$type['add_report'],1,$id);
						header( "Location: ".vendor_app_util::url(array('ctl'=>'reports')));
					} else {
						log_model::setLog(log_model::$type['add_report'],0);
					}
				}
			}
			$this->record = $reportData;
		}

		if (!$app['enableUserAssignGroup']) {
			$pm = new group_model();
			$this->groups = $pm->getAllRecords('id, name, status, leader_id', ['conditions'=>'status!=2', 'order'=>'status desc']);
		} else {
			$prum = new groups_user_model();
			$this->groups = $prum -> getAllRecords('*', ['conditions'=>'user_id='.$_SESSION['user']['id'],'joins'=>['group']]);
		}

		$this->records['data'] = [];
		if($this->groups) {
			while($row = $this->groups->fetch_assoc()) {
				$this->records['data'][] = $row;
			}
		}

		// echo "Start <br/>"; echo '<pre>'; print_r($this->records);echo '</pre>';exit("End Data");
		$this->display();
	}


	public function edit($id) {
		global $app;
		$rm = new report_model();
		$this->record = $rm->one($id);

		$d = new DateTime($this->record['time_start']);
      	if($d->format('Y-m-d') != date('Y-m-d')) {
			header( "Location: ".vendor_app_util::url(array('ctl'=>'reports')));
      	}

		if(isset($_POST['btn_submit'])) {
			$today = date("Y-m-d");
			$reportData = $_POST['report'];
			if(!isset($reportData['user_id']))	
				$requestData['user_id'] = $_SESSION['user']['id'];

			if(isset($reportData['time_start']))	
				$reportData['time_start'] 	= vendor_app_util::timeToDateTime($reportData['time_start']);
			if(isset($reportData['time_end']))		
				$reportData['time_end'] 	= vendor_app_util::timeToDateTime($reportData['time_end']);

			if(isset($_POST['group_suggestion']) && isset($_POST['group'])) {
				$groupData = $_POST['group'];
				$groupData['status'] = 0;
				$groupData['user_created_id'] = $_SESSION['user']['id'];
				$pm = new group_model();
				$pvalid = $pm->validator($groupData);
			}
			$valid = $rm->validator($reportData);
			if($valid['status']) {
				if(isset($groupData['status'])) {
					if(!($rerult = $pm->addRecord($groupData))) {
						$this->group = $groupData;
						$this->group_suggestion = $_POST['group_suggestion'];
					} else {
						$reportData['group_id'] = $rerult;

						$email = $_SESSION['user']['email'];
						$um = new user_model();
						$adminMails = $um->getAllRecords('email',['conditions'=>'role = 1']);
						$mTo = "";
						foreach ($adminMails as $record) {
							$mTo .= ($mTo? ", ": "").$record['email'];
						}
						$title = 'One group suggested';
						$href = RootURL."admin/groups/edit/".$reportData['group_id'];
						$content = "Has group suggested for you.Email sended from system.Please <a href=".$href."> click here </a> to go to group suggested";
						$nTo = 'TPM';
						
						vendor_app_util::sendMail($title, $content, $nTo, $mTo);
					}
				}
				if($rm->editRecord($id,$reportData, 'date(time_start)="'.date('Y-m-d').'"')) {
					log_model::setLog(log_model::$type['edit_report'],1,$id);
					header( "Location: ".vendor_app_util::url(array('ctl'=>'reports')));
				} else {
					log_model::setLog(log_model::$type['edit_report'],0);
				}
			} else {
				$this->errors['type']		=	'inputform';
				$this->errors['message']	=	'Error with input data';
				$this->errors['inputForm']	= $rm::convertErrorMessage($valid['message']);
			}
			$this->record = $reportData;
			$this->record['id'] = $id;
		}
		$um = new user_model();
		$this->users = $um->getAllRecords('id, firstname, lastname', ['conditions'=>'role!=1']);

		if (!$app['enableUserAssignGroup']) {
			$pm = new group_model();
			$this->groups = $pm->getAllRecords('id, name, status, leader_id', ['conditions'=>'status!=2', 'order'=>'status desc']);
		} else {
			$prum = new groups_user_model();
			$this->groups = $prum -> getAllRecords('*', ['conditions'=>'user_id='.$_SESSION['user']['id'],'joins'=>['group']]);
		}

		$this->records['data'] = [];
		if($this->groups) {
			while($row = $this->groups->fetch_assoc()) {
				$this->records['data'][] = $row;
			}
		}
		
		$this->display();
	}

	public function del($id) {
		$rm = new report_model();
		if($rm->delRecord($id, 'date(time_start)="'.date('Y-m-d').'"')) {
			log_model::setLog(log_model::$type['delete_report'],1,$id);
			header( "Location: ".vendor_app_util::url(array('ctl'=>'reports')));
		} else {
			log_model::setLog(log_model::$type['delete_report'],0,$id);
			$this->errors = ['message'=>'Can not delete data!'];
		}
	}

	public function usergroup(){
		global $app;
		$id_group = $app['prs']['id_group'];
		$id_user = $app['prs']['id_user'];
		$rm = new report_model();
		$conditions = $rm->getTableName().'.user_id='.$id_user.' AND '.$rm->getTableName().'.group_id='.$id_group;

		
		$this->time='All';
		$this->timetype = 'all';
		$this->records = $rm->allp('*',['conditions' => $conditions, 'joins'=>['user','group']]);
		// echo "Start <br/>"; echo '<pre>'; print_r($this->records);echo '</pre>';exit("End Data");

		$this->user_id = $id_user;
		$this->group_id = $id_group;
		$this->fullname = user_model::getFullname($id_user);
		$this->timetotal = $rm->getTotal('work_time', $conditions);
		$this->groupName = group_model::getName($id_group);
		$this->display();
	}
}
