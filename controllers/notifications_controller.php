<?php
class notifications_controller extends vendor_auth_controller{
	public function index() {
		global $app;
		$conditions = "";
		if(isset($app['prs']['role'])) {
			$conditions .= (($conditions)? " AND ":"")."role=".$app['prs']['role'];
		}

		$notification = new notification_model();
		$this->records = $notification->allp('*',['conditions'=>$conditions, 
			'joins'=>['model'=>'user', 'type'=>'JOIN', 'joinFields'=>"firstname, lastname"]]);
		$this->display();
	}


	public function month() {
		global $app;
		$notification = new notification_model();
		$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
		$startMonth = $month.'-01 00:00:00';
		$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";

		$user_id = ucfirst($_SESSION['user']['id']);
		$this->time = $month; 
		$this->user_id = $user_id;
		$this->fullname = user_model::getFullname($user_id);
		$conditions = $notification->getTableName().'.created >= "'.$startMonth.'" AND '.$notification->getTableName().'.created <= "'.$endMonth.'"';
		$this->notificationsTotal = $notification->getCountRecords(['conditions'=>$conditions]);

		$this->records = $notification->allp('*',['conditions'=>$conditions,
			'joins'=>['model'=>'user', 'type'=>'JOIN', 'joinFields'=>"firstname, lastname"]]);

		$this->display();
	}


	public function week() {
		global $app;
		$notification = new notification_model();
		$week = (isset($_POST['week']))? $_POST['week'] : date("Y")."-W".date("W");
		//$startWeek  = date('Y-m-d',strtotime($week));
 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; //Returns the date of monday in week

    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";   //Returns the date of sunday in week

		$user_id = ucfirst($_SESSION['user']['id']);
		$this->time = $week; 
		$this->user_id = $user_id;
		$this->fullname = user_model::getFullname($user_id);
		$conditions = $notification->getTableName().'.created >= "'.$startWeek.'" AND '.$notification->getTableName().'.created <= "'.$endWeek.'"';
		$this->notificationsTotal = $notification->getCountRecords(['conditions'=>$conditions]);

		$this->records = $notification->allp('*',['conditions'=>$conditions,
			'joins'=>['model'=>'user', 'type'=>'JOIN', 'joinFields'=>"firstname, lastname"]]);

		$this->display();
	}
}
?>