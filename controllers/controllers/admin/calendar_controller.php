<?php
class calendar_controller extends vendor_backend_controller {
	public function index() {
		global $app;
		$conditions = '';
		$conditionsP = '';
		$um = new user_model();
		$rpm = new report_model();
		$rqm = new request_model();

		// start notWorkDaySatudays
		
		
		$startMonth = date('y-m').'-01 00:00:00';
		$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
		$saturdaysOfYear = vendor_app_util::daysOff();
		$conditionsSaturday = ' ';
		foreach($saturdaysOfYear as $value){
			$conditionsSaturday.= ' OR date(time_start)="'.$value.'"';
		}
		// end

		$time = (isset($_POST['month']))? $_POST['month'] : $app['prs']['time'];
		if (!isset($_POST['month']) && !$app['prs']['time']) {
			$time = date("Y-m");
		}
		// echo "Start <br/>"; echo '<pre>'; print_r($app['prs']);echo '</pre>';exit("End Data");
		
		$month = date('m',strtotime($time));
		$year = date('Y',strtotime($time));

		$id = $app['prs']['user_id'];
		$this->user = $um->getRecord($id);

		$conditions .= 'month(datetime_start) = '.$month.' AND year(datetime_start)='.$year;
		$conditions .= ' AND users.id = '.$id;
		$this->monthRequests = $rqm->getCountRecords(['conditions'=>$conditions,'joins'=>['user']]);
		// exit($this->monthRequests);
		
		$this->records = vendor_app_util::sqlrToArray($rqm->getAllRecords('*, requests.id',['conditions'=>$conditions,'joins'=>['user']]));

		$conditionsP .= 'month(time_start) = '.$month.' AND year(time_start)='.$year;
		$conditionsP .= ' AND users.id = '.$id;
		if ($app['prs'][2] && $app['prs'][2] == "OT_time" || $app['prs'][1] && $app['prs'][1] == "OT_time") {
			$conditionsP .= ' AND ( DATE_FORMAT(time_start, "%H:%i:%s") > "17:00:00" OR weekday(time_start) IN(6)'.$conditionsSaturday.')';
			$this->OTTime = "OT_time";
		}
		$this->monthReports = $rpm->getCountRecords(['conditions'=>$conditionsP,'joins'=>['user']]);
		$this->recordsP = vendor_app_util::sqlrToArray($rpm->getAllRecords('*, reports.id',['conditions'=>$conditionsP,'joins'=>['user']]));
		$this->user_id = $id;
		$this->time = $time;
		$this->timetype = 'month';

		// $this->records = $rqm->getAllRecordsArray('*',['conditions'=>$conditions,'joins'=>['user']]);
		$this->display();
	}
	

}
?>