<?php
class dashboard_controller extends vendor_backend_controller {
	public function index() {
 		$startDate  = date("Y-m-d")." 00:00:00"; 
    	$endDate    = date("Y-m-d")." 23:59:59";

    	$staYesterdayDate  = date('Y-m-d',strtotime("-1 days"))." 00:00:00"; 
    	$endYesterdayDate  = date('Y-m-d',strtotime("-1 days"))." 23:59:59"; 
		$yesterdayDate =  date('Y-m-d',strtotime("-1 days"));
    	$week = date("Y")."-W".date("W");
 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week

    	$rpm = new report_model();
		$this->noTodayReports = $rpm->getCountRecords(['conditions'=>'time_start >= "'.$startDate.'" AND time_start <= "'.$endDate.'"']);
		$this->noUsersTodayReports = $rpm->getCountRecords([
				'conditions'=>	'time_start >= "'.$startDate.'" AND time_start <= "'.$endDate.'"',
				'group'		=>	'user_id'
			]);

		$this->noYesterdayReports = $rpm->getCountRecords(['conditions'=>'time_start >= "'.$staYesterdayDate.'" AND time_start <= "'.$endYesterdayDate.'"']);
		// $this->noUsersYesterdayReports = $rpm->getCountRecords([
		// 		'conditions'=>	'time_start >= "'.$staYesterdayDate.'" AND time_start <= "'.$endYesterdayDate.'"',
		// 		'group'		=>	'user_id'
		// 	]);

		$this->thisWeekReports = $rpm->getCountRecords(['conditions'=>'time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'"']);
		$this->noUsersThisWeekReports = $rpm->getCountRecords([
				'conditions'=>	'time_start >= "'.$endWeek.'" AND time_start <= "'.$endWeek.'"',
				'group'		=>	'user_id'
			]);

		$rqm = new request_model();
		$conditions  = '(datetime_start <= "'.$startDate.'" AND datetime_end >= "'.$endDate.'")';
		$conditions .= ' OR (datetime_start >= "'.$startDate.'" AND datetime_start <= "'.$endDate.'")';
		$conditions .= ' OR (datetime_end   >= "'.$startDate.'" AND datetime_end   <= "'.$endDate.'")';
		$this->noTodayRequests 		= $rqm->getCountRecords(['conditions'=>$conditions]);

		$upconditions = '(created >= "'.$startDate.'" AND created <= "'.$endDate.'") AND status = 0';
		$this->noUnprocessRequestsToday 	= $rqm->getCountRecords(['conditions'=>$upconditions]);

		$yconditions  = '(requests.datetime_end <= "'.$endDate.'" ) AND requests.status = 0 ';
		$this->noUnprocessRequestsBefore 	= $rqm->getCountRecords(['conditions'=>$yconditions]);

		$wconditions  = 'status=0';
		$wconditions .= ' AND ((datetime_start <= "'.$startWeek.'" AND datetime_end >= "'.$endWeek.'")';
		$wconditions .= ' OR (datetime_start >= "'.$startWeek.'" AND datetime_start <= "'.$endWeek.'")';
		$wconditions .= ' OR (datetime_end   >= "'.$startWeek.'" AND datetime_end   <= "'.$endWeek.'"))';
		$this->noUnprocessRequestsWeek 	= $rqm->getCountRecords(['conditions'=>$wconditions]);


		$um = new user_model();
		$this->noUsers = $um->getCountRecords();
		$this->noNonAdminUsers = $um->getCountRecords(['conditions'=>'role!=1']);
		$this->noNonAdminActiveUsers = $um->getCountRecords(['conditions'=>'role!=1 AND status=1']);

		$this->noUsersYesterdayReports = $um->getCountRecords([
			'conditions'=>	'users.id IN (SELECT users.id FROM users INNER JOIN reports ON reports.user_id = users.id WHERE "'.$yesterdayDate.'" = date(reports.time_start) ) AND users.role!=1 '
		]);

		$this->UsersYesterdayRequestOff = $um->getCountRecords([
			'conditions'=>	'users.id IN (SELECT users.id FROM users INNER JOIN requests ON requests.user_id = users.id WHERE (requests.datetime_start <= "'.$staYesterdayDate.'" AND requests.datetime_end >= "'.$endYesterdayDate.'")) AND users.role!=1 '
		]);

		/*
		$this->noUsersYesterdayNotReports = $um->getCountRecords([
			'conditions'=>	'users.id NOT IN (SELECT users.id FROM users INNER JOIN reports ON reports.user_id = users.id WHERE "'.$yesterdayDate.'" = reports.date_report ) AND users.role!=1 ',
		]);
		*/
		$this->noUsersYesterdayNotReports = ($this->noNonAdminActiveUsers - $this->noUsersYesterdayReports) - $this->UsersYesterdayRequestOff;

		$pm = new group_model();
		$this->noGroups 			= $pm->getCountRecords();
		$this->noSuggestionGroups = $pm->getCountRecords(['conditions'=>'status=0']);

		$ms = new user_month_salary_model();
        $st = new user_month_setting_model();

		$this->year = date('Y');
		$this->preMonth = date('n') -1;
		//get data month setting
		$msData = $st->getRecordWhere([
			"user_month_settings.month"=>$this->preMonth,
			"user_month_settings.year"=>$this->year,
			"status"=>1
		]);
		$this->noUserSalaries = $this->noNonAdminUsers;
		if($msData){
			$this->noUserPaidSalaries = $ms->getCountRecords([
				'conditions'=>'user_month_setting_id ='.$msData['id'].' AND status=1'
			]);
		}else{
			$this->noUserPaidSalaries = 0;
		}
		

		$this->display();
	}


	public function backup(){
		$dashboardUrl = RootURL."admin/dashboard";
		$dashboardm = new dashboard_model();
		$this->bk = $dashboardm->backup_tables(["logs","reports","requests"]);
		if ($this->bk) {
			echo"<script language='javascript'>
				 var conf = confirm('You have successfully backed up!');
				 if(conf==true){
					 window.location.replace('$dashboardUrl');
				 }
				</script>";
		}
	}

	public function backup_zip_file(){
		$dashboardUrl = RootURL."admin/dashboard";
		$dashboardm = new dashboard_model();
		$this->bk = $dashboardm->backup_zip(["logs","reports","requests"]);
		if ($this->bk) {
			echo"<script language='javascript'>
				 var conf = confirm('You have successfully backed up and zip file!');
				 if(conf==true){
					 window.location.replace('$dashboardUrl');
				 }
				</script>";
		}
	}




}
?>