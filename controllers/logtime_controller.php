<?php
class logtime_controller extends vendor_auth_controller
{
	
	public function add() {
		global $app;
		$rm = new report_model();
		$startDate  = date("Y-m-d")." 00:00:00"; 
		$endDate    = date("Y-m-d")." 23:59:59";
		
		$user_id = ucfirst($_SESSION['user']['id']);
		$this->jobs = $rm->allp('*',['conditions'=>' time_start >= "'.$startDate.'" and time_start <= "'.$endDate.'" and reports.user_id = '.$user_id]);

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

		if(isset($_SESSION['report_id'])){
			$time = date ("Y-m-d H:i:s");
			global $app;
			$rm = report_model::getInstance();
			$report_id = $_SESSION['report_id'];
			$this->job = $rm->getRecord($report_id);
			$datetime1 = new DateTime($time); 
			$datetime2 = new DateTime($this->job['time_end']); 
			$difference = $datetime1->diff($datetime2); 
			$day = (int) $difference->format('%a');
			$hours = (int) $difference->format('%h');
			$minutes = (int) $difference->format('%i');

			$worked_time = (float) $this->job['work_time'];
			$reportData['work_time'] = (float) $day*24+$hours+$minutes/60 + $worked_time;
			if($reportData['work_time'] >1){
				$reportData['work_time'] = number_format((float)$reportData['work_time'] , 1, '.', '');
			}else{
				$reportData['work_time'] = floor((float)$reportData['work_time']*10)/10;
			}

			$reportData['time_end'] = $time;
			$rm->editRecord($report_id,$reportData);
		}
		
		$this->display();
		
	}


	public function addAjax() {
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
		{   
			// if($_SESSION['report_id']) $this->add();
			if(!empty($_SESSION['textLogtime'])) unset($_SESSION['textLogtime']);
			$today = date("Y-m-d");
			$timeStart = date("Y-m-d H:i:s");
			$rm = report_model::getInstance();
			$reportData = $_POST['report'];
			if(isset($_POST['group_suggestion'])){
				$groupData = $_POST['group'];
				$groupData['status'] = 0;
				$groupData['user_created_id'] = $_SESSION['user']['id'];
				$pm = new group_model();
				$gvalid = $pm->validator($groupData);
				if($gvalid['status']) {
					if($resultGr = $pm->addRecord($groupData)){
						$reportData['group_id'] = $resultGr;
					}
				}
			}
			$reportData['work_time'] = 0;
			$reportData['time_start'] = $timeStart;
			$reportData['time_end'] = $timeStart;
			$reportData['user_id'] = $_SESSION['user']['id'];
			$reportData['date_report'] = $today;
			$pvalid = $rm->validator($reportData);
			if($result = $rm->addRecord($reportData)){
				$_SESSION['report_id'] = $result;
				exit("report_id: ".$result);
			}
		}
	}


	public function updateAjax() {
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			
			// update report (Stop)
			if(isset($_SESSION['report_id'])){
				$time = date ("Y-m-d H:i:s");
				global $app;
				$rm = report_model::getInstance();
				$report_id = $_SESSION['report_id'];
				$this->report = $rm->getRecord($report_id);
				$datetime1 = new DateTime($time); 
				$datetime2 = new DateTime($this->report['time_end']); 
				$difference = $datetime1->diff($datetime2); 
				$day = (int) $difference->format('%a');
				$hours = (int) $difference->format('%h');
				$minutes = (int) $difference->format('%i');

				$worked_time = (float) $this->report['work_time'];
				$reportData['work_time'] = (float) $day*24+$hours+$minutes/60+ $worked_time;
				if($reportData['work_time'] >1){
					$reportData['work_time'] = number_format((float)$reportData['work_time'] , 1, '.', '');
				}else{
					$reportData['work_time'] = floor((float)$reportData['work_time']*10)/10;
				}

				$reportData['time_end'] = $time;
				if($rm->editRecord($report_id,$reportData)) {
					unset($_SESSION['report_id']);
					// $reportData['work_time'] = (float) $reportData['work_time'];
					$hours = (int) $reportData['work_time'];
					$minutes = (float) ($reportData['work_time'] - $hours)*60;
					$_SESSION['textLogtime'] = ("Time tracking (".$this->report['job'].") you did : ".$hours." Hours ".$minutes." Minutes.");
					exit("Stop Successfully.");
				}
			}

			// start existing
			if(isset($_POST['id_report']) && !isset($_SESSION['report_id'])){
				if(!empty($_SESSION['textLogtime'])) unset($_SESSION['textLogtime']);
				$time = date ("Y-m-d H:i:s");
				$report_id = $_POST['id_report'];
				$rm = report_model::getInstance();
				$this->job = $rm->getRecord($report_id);
				$reportData['time_end'] = $time;

				if($rm->editRecord($report_id,$reportData)) {
					$_SESSION['report_id'] = $report_id;
					exit($this->job['work_time']);
				}
			}

		}
		
	}
	
	public function requestLoad(){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			// auto update
			if(isset($_POST['id_report']) && isset($_SESSION['report_id'])){
				$rm = report_model::getInstance();
				$report_id = $_POST['id_report'];
				$conditions = "id=".$report_id;
				$this->records = $rm->allp('*',['conditions'=>'reports.id = '.$report_id]);
				exit(json_encode($this->records['data']));
			}
		}
		
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			// auto update
			if(isset($_POST['id_report']) && isset($_SESSION['report_id'])){
				$time = date ("Y-m-d H:i:s");
				global $app;
				$rm = report_model::getInstance();
				$report_id = $_SESSION['report_id'];
				$this->job = $rm->getRecord($report_id);
				$datetime1 = new DateTime($time); 
				$datetime2 = new DateTime($this->job['time_end']); 
				$difference = $datetime1->diff($datetime2); 
				$day = (int) $difference->format('%a');
				$hours = (int) $difference->format('%h');
				$minutes = (int) $difference->format('%i');
				$second = (int) $difference->format('%s');

				$worked_time = (float) $this->job['work_time'];
				$reportData['work_time'] = (float) $day*24+$hours+$minutes/60+$second/3600 + $worked_time;
				if($reportData['work_time'] >1){
					$reportData['work_time'] = number_format((float)$reportData['work_time'] , 1, '.', '');
				}else{
					$reportData['work_time'] = floor((float)$reportData['work_time']*10)/10;
				}

				$reportData['time_end'] = $time;
				if($rm->editRecord($report_id,$reportData)) {
					exit($reportData['work_time']);
				}
			}
		}
		
	}

	public function autoUpdateAjax() {
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			
			// update report (Stop)
			if(isset($_SESSION['report_id'])){
				$time = date ("Y-m-d H:i:s");
				global $app;
				$rm = report_model::getInstance();
				$report_id = $_SESSION['report_id'];
				$this->report = $rm->getRecord($report_id);
				$datetime1 = new DateTime($time); 
				$datetime2 = new DateTime($this->report['time_end']); 
				$difference = $datetime1->diff($datetime2); 
				$day = (int) $difference->format('%a');
				$hours = (int) $difference->format('%h');
				$minutes = (int) $difference->format('%i');
				$worked_time = (float) $this->report['work_time'];
				$reportData['work_time'] = (float) $day*24+$hours+$minutes/60+ $worked_time;
				if($reportData['work_time'] > 1){
					$reportData['work_time'] = number_format((float)$reportData['work_time'] , 1, '.', '');
				}else{
					$reportData['work_time'] = floor((float)$reportData['work_time']*10)/10;
				}
				$reportData['time_end'] = $time;
				if($rm->editRecord($report_id,$reportData)) {
					exit(" Successfully.".$reportData['work_time']);
				}
			}
		}
	}


	public function listJob(){
		$rm = new report_model();
		$startDate  = date("Y-m-d")." 00:00:00"; 
		$endDate    = date("Y-m-d")." 23:59:59";
		
		$user_id = ucfirst($_SESSION['user']['id']);

		$jobs = $rm->getAllRecords('*',[
			'conditions'=>' time_start >= "'.$startDate.'" and time_start <= "'.$endDate.'" and reports.user_id = '.$user_id.' and group_id = '.$_POST['group_id']
		]);
		if($jobs) {
			while($row = $jobs->fetch_assoc()) {
				$records['data'][] = $row;
			}
		}
		if(isset($records['data'])){
			exit(json_encode($records['data']));
		}else{
			exit('null');
		}
	}
	
}