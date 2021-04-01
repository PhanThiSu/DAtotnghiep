<?php
class reports_controller extends vendor_backend_controller
{
	protected 	$errors = false;

	public function all() {
		$rm = new report_model();
		$this->records = $rm->allp('*',['joins'=>['user','group']]);
		$this->display();
	}

	public function index() {
		$rm = new report_model();
		$this->records = $rm->allp('*',['joins'=>['user','group']]);
		$this->display();
	}

	/* Users're time in Menu */
	public function usersreport() {
		global $app;
		$rm = new report_model();
		$conditions = '';

		// Add daily report for users here
		if (isset($app['prs']['dayofweek'])) {
			$dayofweek = $app['prs']['dayofweek'];
			$daily = date("Y-m-d",strtotime(".$dayofweek.")) ;

	    	$conditions .= 'date(time_start)="'.$daily.'"';
			$this->time = $daily;
			$this->timetype = 'date';

		}else if (isset($_POST['all'])) {
			$this->timetype = 'all';

		} else if(isset($_POST['date'])) {
			$daily = $_POST['date'];
	    	$conditions .= 'date(time_start)="'.$daily.'"';
			$this->time = $daily;
			$this->timetype = 'date';

		} else if(isset($_POST['week'])) {
			$week = $_POST['week'];
	 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
	    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week

			$conditions .= 'time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'"';
			$this->time = $week;
			$this->timetype = 'week';
			
		} else {
			if (isset($app['prs']['year'])) {
				$yearUrl = $app['prs']['year'];
				$monthUrl = $app['prs']['month'];
				$month = $monthUrl >=10 ? $yearUrl.'-'.$monthUrl : $yearUrl.'-0'.$monthUrl;

			} else {
				$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
			}
			$monthdays = date('m',strtotime($month));
			$year = date('Y', strtotime($month));
			$conditions .= 'month(time_start) = '.$monthdays.' AND year(time_start)='.$year;
			$this->time = $month ;
			$this->timetype = 'month';
		}
		$tableName = $rm->getTableName();
		$conditions .=	' AND users.role!=1 AND users.status != 0';
		$this->records = $rm->allp($tableName.'.user_id, SUM(work_time) as total',[
				'conditions'=>$conditions, 
				'group'=>$tableName.'.user_id',
				'order'=>$tableName.'.user_id',
				'joins'=>['user']
			]);
		$this->display();
	}

		/* Users're time in Menu */
		public function usersOTreport() {
			global $app;
			$rm = new report_model();
			$conditions = '';

			// exit((new DateTime())->setISODate(2017, 40)->format('m'));

			// start
			$yearStart = date('Y-m-d', strtotime('1/01')).' 00:00:00';
			$yearEnd = date('Y-m-d', strtotime('12/31'))." 23:59:59";

			$common_setting_model = common_setting_model::getInstance();
			$common_setting = $common_setting_model->getRecord('1');
			
			$startMonth = date('y-m').'-01 00:00:00';
			$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
			$daysOff = vendor_app_util::daysOff();
			$conditionsDaysOff = ' ';
			foreach($daysOff as $value){
				$conditionsDaysOff.= ' OR date(time_start)="'.$value.'"';
			}
			// end
	
			// Add daily report for users here
			if (isset($app['prs']['dayofweek'])) {
				$dayofweek = $app['prs']['dayofweek'];
				$daily = date("Y-m-d",strtotime(".$dayofweek.")) ;
	
				$conditions .= 'date(time_start)="'.$daily.'"';
				$this->time = $daily;
				$this->timetype = 'date';
	
			}else if (isset($_POST['all'])) {
				$this->timetype = 'all';
	
			} else if(isset($_POST['date'])) {
				$daily = $_POST['date'];
				if(in_array($daily,$saturdaysOfYear)){
				}
				$conditions .= 'date(time_start)="'.$daily.'"';
				$this->time = $daily;
				$this->timetype = 'date';
	
			} else if(isset($_POST['week'])) {
				$week = $_POST['week'];
				exit($week);
				$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
				$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week
	
				$conditions .= 'time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'"';
				$this->time = $week;
				$this->timetype = 'week';
				
			} else {
				if (isset($app['prs']['year'])) {
					$yearUrl = $app['prs']['year'];
					$monthUrl = $app['prs']['month'];
					$month = $monthUrl >=10 ? $yearUrl.'-'.$monthUrl : $yearUrl.'-0'.$monthUrl;
	
				} else {
					$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
				}
				$monthdays = date('m',strtotime($month));
				$year = date('Y', strtotime($month));
				$conditions .= 'month(time_start) = '.$monthdays.' AND year(time_start)='.$year;
				$this->time = $month ;
				$this->timetype = 'month';
			}



			$tableName = $rm->getTableName();
			$conditions .=	' AND users.role!=1 AND users.status != 0 AND ( DATE_FORMAT(time_start, "%H:%i:%s") > "17:30:00" OR weekday(time_start) IN(6)'.$conditionsDaysOff.' )';
			$this->records = $rm->allp($tableName.'.user_id, SUM(work_time) as total',[
					'conditions'=>$conditions, 
					'group'=>$tableName.'.user_id',
					'order'=>$tableName.'.user_id',
					'joins'=>['user']
				]);
			// echo "Start <br/>"; echo '<pre>'; print_r($this->records);echo '</pre>';exit("End Data");
			$this->display();
		}
	

	/* Users're not report yesterday*/
	public function usersnotreportyd() {
		$rm = new user_model();
		$yesterdayDate  = date('Y-m-d',strtotime("-1 days"));

		$conditions = 'users.id NOT IN (SELECT users.id FROM users INNER JOIN reports ON reports.user_id = users.id WHERE "'.$yesterdayDate.'" = reports.date_report ) AND users.role!=1 AND users.status != 0';
		$this->records = $rm->allp('*',[
				'conditions'=>$conditions, 
			]);
		$this->display();
	}

	/* Users're reported yesterday*/
	public function usersreportyd() {
		$rm = new report_model();
		$conditions = '';

		if (isset($_POST['all'])) {
			$this->timetype = 'all';
		}
		else if(isset($_POST['week'])) {
			$week = $_POST['week'];
	 		$startWeek  = date("Y-m-d", strtotime("$week-1")); //Returns the date of monday in week
	    	$endWeek    = date("Y-m-d", strtotime("$week-7"));   //Returns the date of sunday in week

			$conditions .= 'date_report >= "'.$startWeek.'" AND date_report <= "'.$endWeek.'"';
			$this->time = $week;
			$this->timetype = 'week';
		} else if (isset($_POST['month'])) {
			$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
			$startMonth = $month.'-01 ';
			$endMonth 	= date("Y-m-t", strtotime($startMonth));

			$conditions .= 'date_report >= "'.$startMonth.'" AND date_report <= "'.$endMonth.'"';
			$this->time = $month;
			$this->timetype = 'month';
		}
		else {
			if (isset($_POST['date'])){
				$daily = $_POST['date'];
			}
			else $daily =  date('Y-m-d',strtotime("-1 days"));

			$conditions .= 'date_report = "'.$daily.'" ';
			$this->time = $daily;
			$this->timetype = 'date';
		} 
		$tableName = $rm->getTableName();
		$conditions .=	' AND users.role!=1 AND users.status != 0';
		$this->records = $rm->allp($tableName.'.user_id, SUM(work_time) as total',[
				'conditions'=>$conditions, 
				'group'=>$tableName.'.user_id',
				'order'=>$tableName.'.user_id',
				'joins'=>['user']
			]);
		$this->display();
	}

	/* End Users're time in Menu */

	/* Users're times in Menu */
	public function usersmonths() {
		global $app;
		$rm = new report_model();
		$year = (isset($_POST['year']))? $_POST['year'] : date('Y');

		$tableName = $rm->getTableName();
		$this->time 	= $year;
		// $this->records 	= $rm->getUsersReportsMonths($year);

		$fields = $tableName.".user_id";
		for ($i=0; $i < 12; $i++) { 
			$fields .= ", SUM(CASE WHEN month(time_start)=".($i+1)." THEN work_time ELSE 0 END) AS ".$app['months'][$i];
		}
		$conditions = "year(".$tableName.".time_start)=".$year;
		$conditions .=	' AND users.role!=1 AND users.status != 0';
		$this->records = $rm->allp($fields,[
				'conditions'=>$conditions, 
				'group'=>$tableName.'.user_id',
				'order'=>$tableName.'.user_id',
				'joins'=>['user']
			]);
		$this->display();
	}

	public function usermonths() {
		global $app;
		$user_id = $app['prs'][1];
		$rm = new report_model();
		$year = (isset($_POST['year']))? $_POST['year'] : date('Y');

		$this->time 	= $year;
		$this->user_id 	= $user_id;
		$this->fullname = user_model::getFullname($user_id);
		$this->record 	= $rm->getUserReportsMonths($user_id, $year);
		$this->display();
	}

	public function usersdays() { 
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
		$fields = $tableName.".user_id ";
		for ($i=0; $i < 7; $i++) { 
			$fields .= ", SUM(CASE WHEN date(time_start)='".(date('Y-m-d', strtotime('+'.$i.' day', strtotime($startWeek))))."' THEN work_time ELSE 0 END) AS ".$app['weekdays'][$i];
		}
		$fields .= ", SUM(CASE WHEN date(time_start)>='".(date('Y-m-d', strtotime($startWeek)))."' and date(time_end) <='".(date('Y-m-d', strtotime($endWeek)))."' THEN work_time ELSE 0 END) AS Total ";
		
		$this->records = $rm->allp($fields,[
				'joins'=>['model'=>'user', 'type'=>'JOIN', 'joinFields'=>"firstname, lastname"],
				'group'=>$tableName.'.user_id ',
				'order'=>$tableName.'.user_id',
				'conditions'=>	'users.role!=1 AND users.status != 0 and date(time_start)>="'.(date('Y-m-d', strtotime($startWeek))).'" and date(time_end) <="'.(date('Y-m-d', strtotime($endWeek))).'"'
			]);


		$fields = "select SUM(CASE WHEN date(time_start)>='".(date('Y-m-d', strtotime($startWeek)))."' and date(time_end) <='".(date('Y-m-d', strtotime($endWeek)))."' THEN work_time ELSE 0 END) AS Total ";
		for ($i=0; $i < 7; $i++) { 
			$fields .= ", SUM(CASE WHEN date(time_start)='".(date('Y-m-d', strtotime('+'.$i.' day', strtotime($startWeek))))."' THEN work_time ELSE 0 END) AS ".$app['weekdays'][$i];
		}

		$sql = $fields." FROM reports LEFT JOIN users ON reports.user_id=users.id where users.role!=1 AND users.status != 0 and date(time_start)>='".(date('Y-m-d', strtotime($startWeek)))."' and date(time_end) <='".(date('Y-m-d', strtotime($endWeek)))."'";
		$this->recordTotal = $rm->getUsersDaysTotal($sql);

		$this->display();
	}

	public function userdays() {
		global $app;
		$user_id = $app['prs'][1];
		$rm = new report_model();
		$week = (isset($_POST['week']))? $_POST['week'] : date("Y")."-W".date("W");

		$this->time 	= $week;
		$this->monday 	= date('Y-m-d',strtotime($week));
		$this->user_id 	= $user_id;
		$this->fullname = user_model::getFullname($user_id);
		$this->record 	= $rm->getUserReportsDays($user_id, $week);
		$this->display();
	}

	public function usersdate() {
		global $app;
		$rm = new report_model();
		$day = (isset($_POST['date']))? $_POST['date'] : date("Y-m-d");

		$this->time 	= $day;

		$tableName = $rm->getTableName();
		$fields = $tableName.".user_id";
		$fields .= ", SUM(CASE WHEN date(time_start)='".$day."' THEN work_time ELSE 0 END) AS d";

		$this->records = $rm->allp($fields,[
				'group'=>$tableName.'.user_id',
				'order'=>$tableName.'.user_id',
				'joins'=>['user'],
				'conditions'=>	'users.role!=1 AND users.status != 0'
			]);
		$this->display();
	}
	/* End Users're times in Menu */

	/*  Reports in ... Menu */
	public function month() {
		if(!empty($_GET['month'] && $_GET['year'])) $_POST['month'] = $_GET['year']."-".$_GET['month'];
		$rm = new report_model();
		$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
		$startMonth = $month.'-01 00:00:00';
		$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
		$options = [
				'conditions'=>'time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'" AND users.role!=1', 
				'joins'=>['user','group']
			];
		$this->records = $rm->allp('*',$options);
		$this->time = $month;
		$this->display();
	}

	public function week() {
		$rm = new report_model();
		$week = (isset($_POST['week']))? $_POST['week'] : date("Y")."-W".date("W");
		//$startWeek  = date('Y-m-d',strtotime($week));
 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week

    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week

		$options = [
				'conditions'=>'time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'" AND users.role!=1', 
				'joins'=>['user','group']
			];
		$this->records = $rm->allp('*',$options);
		$this->time = $week;
		$this->display();
	}

	public function daily() {
		$rm = new report_model();
		$daily = (isset($_POST['date']))? $_POST['date'] : date("Y-m-d");
 		$startDate  = $daily." 00:00:00"; 
    	$endDate    = $daily." 23:59:59";

		$options = [
				'conditions'=>'time_start >= "'.$startDate.'" AND time_start <= "'.$endDate.'" AND users.role!=1', 
				'joins'=>['user','group']
			];
		$this->records = $rm->allp('*', $options);
		$this->time = $daily;
		$this->display();
	}
	/*  Edn Reports in ... Menu */

	public function user() {
		global $app;
		$id = $app['prs'][1];
		$rm = new report_model();
		$conditions = $rm->getTableName().'.user_id='.$id;
		if (isset($app['prs'][2]) && $app['prs'][2] == "OT_time") {
			$conditions .= ' AND ( DATE_FORMAT(time_start, "%H:%i:%s") > "17:00:00" OR weekday(time_start) IN(5,6))';
			$this->OT_time = $app['prs'][2];
		} 

		if(isset($_POST['date'])) {
			$daily = $_POST['date'];
	 		$startDate  = $daily." 00:00:00";
	    	$endDate    = $daily." 23:59:59";

			$conditions .= ' AND time_start >= "'.$startDate.'" AND time_start <= "'.$endDate.'"';
			$this->time = $daily;
			$this->timetype = 'date';
		} else if(isset($_POST['week'])) {
			$week = $_POST['week'];
	 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
	    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week

			$conditions .= ' AND (time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'")';
			$this->time = $week;
			$this->timetype = 'week';
		} else if(isset($_POST['month'])){
			$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
			$startMonth = $month.'-01 00:00:00';
			$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";

			$conditions .= ' AND (time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'")';
			$this->time = $month;
			$this->timetype = 'month';	

		} else if(isset($app['prs']['time'])){
			$month = $app['prs']['time'];
			$startMonth = $month.'-01 00:00:00';
			$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";

			$conditions .= ' AND (time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'")';
			$this->time = $month;
			$this->timetype = 'month';	

		} else {
			$this->time='All';
			$this->timetype = 'all';//		exit('hehehe');

		}
		$this->records = $rm->allp('*',['conditions' => $conditions, 'joins'=>['user','group']]);

		$this->user_id = $id;
		$this->fullname = user_model::getFullname($id);
		$this->timetotal = $rm->getTotal('work_time', $conditions);

		$this->display();
	}

	public function userreports() {
		global $app;
		$id = $app['prs'][1];
		if (isset($app['prs'][3]) && $app['prs'][3] == "OT_time") $this->OT_time = $app['prs'][3];
		$rm = new report_model();
		if (isset($app['prs']['date'])) {
			$date = $app['prs']['date'];
			$conditions = $rm->getTableName().'.user_id='.$id.' AND date(time_start) = "'.$date.'"';
		} else {
			$conditions = $rm->getTableName().'.user_id='.$id;
		}
		$this->records = $rm->allp('*',['conditions' => $conditions, 'joins'=>['user','group']]);

		$this->user_id = $id;
		$this->fullname = user_model::getFullname($id);
		$this->timetotal = $rm->getTotal('work_time', $conditions);
		$this->display();
	}

	public function view($id)
	{
		global $app;
		$id = $app['prs'][1];
		$rm = new report_model();
		$this->record = $rm->one($id);
		$this->display();
	}

	public function add() {
		$rm = new report_model();
		if(isset($_POST['btn_submit'])) {
			$reportData = $_POST['report'];
			$checkReport = $rm->getRecordWhere([
                "reports.user_id"=>$reportData['user_id'],
                "reports.time_start"=>$reportData['time_start'],
			]);
			if(!$checkReport){
				if((strtotime($reportData['time_start']) - strtotime($reportData['time_end']))>=0){
					$this->errors = ['database'=>'Date Start after Date End'];
				}else{
					if(!$reportData['user_id'])	$reportData['user_id'] = $_SESSION['user']['id'];
					$reportData['date_report'] = date("Y-m-d");
					
					$valid = $rm->validator($reportData);
					if($valid['status']) {
						if($rm->addRecord($reportData)) {
							header( "Location: ".vendor_app_util::url(array('ctl'=>'reports')));
						} else {
							$this->errors = ['message'=>'Can not save data!'];
						}
					} else {
						$this->errors = $rm::convertErrorMessage($valid['message']);
						$this->record = $reportData;
					}
	
				}
			}else{
				$this->errors = ['database'=>'Date start existed'];
			}



		}
		$um = new user_model();
		$this->users = $um->getAllRecords('id, firstname, lastname', ['conditions'=>'role!=1']);

		$pm = new group_model();
		$this->groups = $pm->getAllRecords('id, name, status', ['conditions'=>'status!=2', 'order'=>'status desc']);
		$this->display();
	}
	  

	public function edit($id) {
		global $app;
		$rm = new report_model();
		$this->record = $rm->one($id);
		if(isset($_POST['btn_submit'])) {
			$reportData = $_POST['report'];
			if(!$reportData['user_id'])	$requestData['user_id'] = $_SESSION['user']['id'];

			$valid = $rm->validator($reportData);
			if($valid['status']) {
				if($rm->editRecord($id,$reportData)) {
					header( "Location: ".vendor_app_util::url(array('ctl'=>'reports')));
				} else {
					$this->errors = ['message'=>'Can not edit data!'];
				}
			} else {
				$this->errors = $rm::convertErrorMessage($valid['message']);
			}
			$this->record = $reportData;
			$this->record['id'] = $id;
			// $this->record = array_merge($this->record, $reportData);
		}
		$um = new user_model();
		$this->users = $um->getAllRecords('id, firstname, lastname', ['conditions'=>'role!=1']);

		$pm = new group_model();
		$this->groups = $pm->getAllRecords('id, name, status', ['conditions'=>'status!=2', 'order'=>'status desc']);
		$this->display();
	}

	public function del($id) {
		$rm = new report_model();
		if($rm->delRecord($id)) {
			header( "Location: ".vendor_app_util::url(array('ctl'=>'reports')));
		} else {
			$this->errors = ['message'=>'Can not delete data!'];
		}
	}

	public function delmany() {
		global $app;
		$ids = $app['prs']['ids'];
		$rm = new report_model();
		if($rm->delRelativeRecords($ids)) echo "Delete many successful";
		else echo "error";
	}

	public function usersgroups() {
		global $app;
		$rm = new report_model();
		$tableName = $rm->getTableName();

		$pm = new group_model();
		$this->groups = $pm->getAllRecords('id, name', ['conditions'=>'status!=2']);
		if(isset($_POST['btn_submit'])) {
			$this->group_id = $_POST['group_id'];
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
		} else {
			$this->group = $pm->getLongestGroup();
			$this->group_id = $this->group['id'];
		}

		$conditions = $tableName.'.group_id='.$this->group_id;
		$fields = $tableName.'.user_id, '.$tableName.'.group_id, SUM(work_time) as total';
		$this->records = $rm->getAllRecords($fields,[
				'conditions'=>$conditions, 
				'group'=>$tableName.'.user_id',
				'order'=>$tableName.'.user_id',
				'joins'=>['user']
			]);

		$this->display();
	}

	public function userstimegroups() {
		global $app;
		$pm = new group_model();
		$this->groups = $pm->getAllRecords('id, name', ['conditions'=>'status!=2']);
		$rm = new report_model();
		$tableName = $rm->getTableName();

		$conditions = "";

		if(isset($_POST['btn_submit'])) {
			$group_id = $_POST['group_id'];
			$tableNameP = $pm->getTableName();
			$fields = $tableNameP.".id, ".$tableNameP.".name, SUM(".$tableName.".work_time) as group_time";


			if($_POST['timetype']=="week") {
				$week = $_POST['week'];
		 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
		    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week

				$conditions .='(time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'")';
				$this->time = $week;
				$this->timetype = 'week';
			} else if($_POST['timetype']=="month") {
				$month = $_POST['month'];
				$startMonth = $month.'-01 00:00:00';
				$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
				$conditions .= '(time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'")';
				$this->time = $month;
				$this->timetype = 'month';

			} else if($_POST['timetype']=="year") {
				$year = $_POST['year'];
				$conditions = "year(".$tableName.".time_start)=".$year;
				$this->time = $year;
				$this->timetype = 'year';
			}

			$group = $tableNameP.".id";
			$order = "group_time DESC";
			$limit = "1";

			$this->group = $pm->getRecord($group_id, $fields, [
					'group'=> $group,
					'order'=> $order,
					'limit'=> $limit,
					'joins'=>['report']
				]);
		} else {
			$year = date('Y');
	 		$startYear  = $year."-01-01 00:00:00";
	    	$endYear    = $year."-12-31 23:59:59";
			$conditions .= 'time_start >= "'.$startYear.'" AND time_start <= "'.$endYear.'"';
			$this->time = $year;
			$this->timetype = 'year';
			$this->group = $pm->getLongestGroup($conditions);
			$group_id = $this->group['id'];
		}

		$conditions .= " AND ".$tableName.'.group_id='.$group_id;
		$fields = $tableName.'.user_id, '.$tableName.'.group_id, SUM(work_time) as total';
		$this->records = $rm->getAllRecords($fields,[
				'conditions'=>$conditions, 
				'group'=>$tableName.'.user_id',
				'order'=>$tableName.'.user_id',
				'joins'=>['user']
			]);
		$this->display();
	}

	public function usertimegroups() {
		global $app;
		$pm = new group_model();
		$tableNameP = $pm->getTableName();
		$this->groups = $pm->getAllRecords('id, name', ['conditions'=>'status!=2']);

		$um = new user_model();
		$this->users = $um->getAllRecords('id, firstname, lastname');

		$rm = new report_model();
		$tableName = $rm->getTableName();
		
		$conditions = "";

		if(isset($_POST['btn_submit'])) {
			$user_id = $_POST['user_id'];
			$tableNameU = $um->getTableName();
			$fields = $tableNameU.".id, ".$tableNameU.".firstname,".$tableNameU.".lastname, SUM(".$tableName.".work_time) as user_time";

			if($_POST['timetype']=="date") {
				$date = (isset($_POST['date']))? $_POST['date'] : date("Y-m-d");
		 		$startDate  = $date." 00:00:00"; 
		    	$endDate    = $date." 23:59:59";
				$conditions .='date(time_start)="'.$date.'"';
				$this->time = $date;
				$this->timetype = 'date';

			} else if($_POST['timetype']=="week") {
				$week = $_POST['week'];
		 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
		    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week
				$conditions .='(time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'")';
				$this->time = $week;
				$this->timetype = 'week';

			} else if($_POST['timetype']=="month") {
				$month = $_POST['month'];
				$startMonth = $month.'-01 00:00:00';
				$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
				$conditions .= '(time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'")';
				$this->time = $month;
				$this->timetype = 'month';

			} else if($_POST['timetype']=="year") {
				$year = $_POST['year'];
				$conditions = "year(".$tableName.".time_start)=".$year;
				$this->time = $year;
				$this->timetype = 'year';

			} else if($_POST['timetype']=="all") {
				$all = $_POST['user_id'];
				$conditions = $tableName.'.user_id='.$user_id;
				$this->time = $all;
				$this->timetype = 'all';
			}

			$group = $tableNameU.".id";
			$order = "user_time DESC";
			$limit = "1";

			$this->user = $um->getRecord($user_id, $fields, [
					'group'=> $group,
					'order'=> $order,
					'limit'=> $limit,
					'joins'=>['report']
				]);

		} else {
			$year = date('Y');
	 		$startYear  = $year."-01-01 00:00:00";
	    	$endYear    = $year."-12-31 23:59:59";
			$conditions .= 'time_start >= "'.$startYear.'" AND time_start <= "'.$endYear.'"';
			$this->time = $year;
			$this->timetype = 'year';
			$this->user = $um->getLongestUser($conditions);

			$user_id = $this->user['id'];
		}

		$conditions .= " AND ".$tableName.'.user_id='.$user_id;
		$fields = $tableName.'.user_id, name ,'.$tableName.'.group_id, SUM(work_time) as total';
		$this->records = $rm->getAllRecords($fields,[
				'conditions'=>$conditions, 
				'group'=>$tableName.'.group_id',
				'order'=>$tableName.'.group_id',
				'joins'=>['group']
			]);	
		$this->display();
	}

	public function usergroup(){
		global $app;
		$id_group = $app['prs']['id_group'];
		$id_user = $app['prs']['id_user'];
		$rm = new report_model();
		$conditions = $rm->getTableName().'.user_id='.$id_user.' AND '.$rm->getTableName().'.group_id='.$id_group;

		if(isset($_POST['date'])) {
			$daily = $_POST['date'];
	 		$startDate  = $daily." 00:00:00";
	    	$endDate    = $daily." 23:59:59";

			$conditions .= ' AND time_start >= "'.$startDate.'" AND time_start <= "'.$endDate.'"';
			$this->time = $daily;
			$this->timetype = 'date';
		} else if(isset($_POST['week'])) {
			$week = $_POST['week'];
	 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
	    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week

			$conditions .= ' AND (time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'")';
			$this->time = $week;
			$this->timetype = 'week';
		} else if(isset($_POST['month'])){
			$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
			$startMonth = $month.'-01 00:00:00';
			$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";

			$conditions .= ' AND (time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'")';
			$this->time = $month;
			$this->timetype = 'month';	

		} else if(isset($_POST['year'])){
			$year = (isset($_POST['year']))? $_POST['year'] : date('Y');
			$conditions .= ' AND (YEAR(time_start) = '.$year.')';
			$this->time = $year;
			$this->timetype = 'year';	

		} else {
			$this->time='All';
			$this->timetype = 'all';
		}
		$this->records = $rm->allp('*',['conditions' => $conditions, 'joins'=>['user','group']]);

		$this->user_id = $id_user;
		$this->group_id = $id_group;
		$this->fullname = user_model::getFullname($id_user);
		$this->timetotal = $rm->getTotal('work_time', $conditions);
		$this->groupName = group_model::getName($id_group);
		$this->display();
	}
}
?>