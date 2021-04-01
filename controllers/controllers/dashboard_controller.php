<?php
class dashboard_controller extends vendor_auth_controller
{
	public function index() 
	{
		$userId = ucfirst($_SESSION['user']['id']);
		$this->emailUser = $_SESSION['user']['email'];
		$this->lastnameUser = $_SESSION['user']['lastname'];
		$this->firstnameUser = $_SESSION['user']['firstname'];
		$startDate  = date("Y-m-d")." 00:00:00"; 
    	$endDate    = date("Y-m-d")." 23:59:59";

    	$staYesterdayDate  = date('Y-m-d',strtotime("-1 days"))." 00:00:00"; 
    	$endYesterdayDate  = date('Y-m-d',strtotime("-1 days"))." 23:59:59"; 

    	$week = date("Y")."-W".date("W");
 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week
		$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week

		$startMonth = date('y-m').'-01 00:00:00';
		$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
		
    	$rpm = new report_model();
		$this->noTodayReports = $rpm->getCountRecords(['conditions'=>'time_start >= "'.$startDate.'" AND time_start <= "'.$endDate.'" AND  reports.user_id = "'.$userId.'"']);
		$this->noUsersTodayReports = $rpm->getCountRecords([
				'conditions'=>	'time_start >= "'.$startDate.'" AND time_start <= "'.$endDate.'"AND  reports.user_id = "'.$userId.'"',
				'group'		=>	'user_id'
			]);

		$this->noYesterdayReports = $rpm->getCountRecords(['conditions'=>'time_start >= "'.$staYesterdayDate.'" AND time_start <= "'.$endYesterdayDate.'"AND  reports.user_id = "'.$userId.'"']);
		$this->noUsersYesterdayReports = $rpm->getCountRecords([
				'conditions'=>	'time_start >= "'.$staYesterdayDate.'" AND time_start <= "'.$endYesterdayDate.'" AND  reports.user_id = "'.$userId.'"',
				'group'		=>	'user_id'
			]);

		$this->thisWeekReports = $rpm->getCountRecords(['conditions'=>'time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'" AND  reports.user_id = "'.$userId.'"']);
		$this->noUsersThisWeekReports = $rpm->getCountRecords([
				'conditions'=>	'time_start >= "'.$endWeek.'" AND time_start <= "'.$endWeek.'" AND  reports.user_id = "'.$userId.'"',
				'group'		=>	'user_id'
			]);

		$conditions = $rpm->getTableName().'.user_id='.$userId;
		$conditions .= ' AND (time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'" AND  reports.user_id = "'.$userId.'")';
		$this->timeTotalWeek = $rpm->getTotal('work_time', $conditions);

		$conditions = $rpm->getTableName().'.user_id='.$userId;
		$conditions .= ' AND (time_start >= "'.$startWeek.'" AND time_start <= "'.$endWeek.'" AND  reports.user_id = "'.$userId.'")';
		$this->timeTotalWeek = $rpm->getTotal('work_time', $conditions);

		$conditions = $rpm->getTableName().'.user_id='.$userId;
		$conditions .= ' AND (time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'" AND  reports.user_id = "'.$userId.'")';
		$this->timeTotalMonth = $rpm->getTotal('work_time', $conditions);
			
		$rqm = new request_model();
		$conditions = '(datetime_start <= "'.$startDate.'" AND datetime_end >= "'.$endDate.'"AND  requests.user_id = "'.$userId.'")';
		$conditions .= ' OR (datetime_start >= "'.$startDate.'" AND datetime_start <= "'.$endDate.'"AND  requests.user_id = "'.$userId.'")';
		$conditions .= ' OR (datetime_end   >= "'.$startDate.'" AND datetime_end   <= "'.$endDate.'"AND  requests.user_id = "'.$userId.'")';
		$this->noTodayRequests 		= $rqm->getCountRecords(['conditions'=>$conditions]);

		$upconditions = '('.$conditions.') AND status=0';
		$this->noUnprocessRequests 	= $rqm->getCountRecords(['conditions'=>$upconditions]);

		$yconditions  = 'status=0';
		$yconditions .= ' AND ((datetime_start <= "'.$staYesterdayDate.'" AND datetime_end >= "'.$endYesterdayDate.'" AND  requests.user_id = "'.$userId.'")';
		$yconditions .= ' OR (datetime_start >= "'.$staYesterdayDate.'" AND datetime_start <= "'.$endYesterdayDate.'" AND  requests.user_id = "'.$userId.'")';
		$yconditions .= ' OR (datetime_end   >= "'.$staYesterdayDate.'" AND datetime_end   <= "'.$endYesterdayDate.'" AND  requests.user_id = "'.$userId.'"))';
		$this->noUnprocessRequestsYesterday 	= $rqm->getCountRecords(['conditions'=>$yconditions]);


		$wconditions  = 'status=0';
		$wconditions .= ' AND ((datetime_start <= "'.$startWeek.'" AND datetime_end >= "'.$endWeek.'" AND  requests.user_id = "'.$userId.'")';
		$wconditions .= ' OR (datetime_start >= "'.$startWeek.'" AND datetime_start <= "'.$endWeek.'" AND  requests.user_id = "'.$userId.'")';
		$wconditions .= ' OR (datetime_end   >= "'.$startWeek.'" AND datetime_end   <= "'.$endWeek.'" AND  requests.user_id = "'.$userId.'"))';
		$this->noUnprocessRequestsWeek 	= $rqm->getCountRecords(['conditions'=>$wconditions]);

		$nm = new notification_model();
		$this->noTodayNotifications = $nm->getCountRecords(['conditions'=>'created >= "'.$startDate.'" AND created <= "'.$endDate.'"']);
		$this->thisWeekNotifications = $nm->getCountRecords(['conditions'=>'created >= "'.$startWeek.'" AND created <= "'.$endWeek.'"']);


		$this->display();
	}
}
?>