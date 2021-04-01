<?php
class check_logtime_controller extends vendor_auth_controller
{

	public function index() {
		global $app;
		$conditions = "";
		if(isset($app['prs']['status'])) {
			$conditions .= "status=".$app['prs']['status'];
		}
		if(isset($app['prs']['role'])) {
			$conditions .= (($conditions)? " AND ":"")."role=".$app['prs']['role'];
		}

		$cl = new check_logtime_model();
		$this->records = $cl->allp('*',['conditions'=>$conditions, 'joins'=>['model'=>'user', 'type'=>'JOIN']]);
		$this->display();
	}

	public function edit($id) {
		$cl = new check_logtime_model();
		$this->record = $cl->getRecord($id," * ", ['joins'=>['user']]);
		exit(json_encode($this->record));
		if(isset($_POST['btn_submit'])) {
			$clData = $_POST['holidays'];
			$valid = $cl->validator($clData, $id);
			if($valid['status']) {
				if($cl->editRecord($id, $clData)) {
					header("Location: ".vendor_app_util::url(["ctl"=>"check_logtime "]));
				} else {
					$this->errors = ['database'=>'An error occurred when editing data!'. $cl->errors['message']];
					$this->record = $clData;
				}
			} else {
				$this->errors = $cl::convertErrorMessage($valid['message']);
				$this->record = $clData;
				$this->record['id'] = $id;
			}
		}
		$this->display();
	}


	public function changestatus() {
		global $app;
		$id = $app['prs'][1];
		$cl = new check_logtime_model();
		$clData['status'] = $_POST['status']?0:1;
		if($cl->editRecord($id, $clData)) echo "Change status successful";
		else echo "error";
	}

	
	// public function add() {
	// 	exit('ahihi');
    //     global $app;
	// 	$cl = new check_logtime_model();
	// 	$time = strtotime(date('H:i:s'));
	// 	$daysOff = vendor_app_util::daysOff();
	// 	$this->none = true;

    //     if( in_array(date("Y-m-d"),$daysOff) ||($time > strtotime(date('17:30:00')) || $time < strtotime(date('06:30:00'))) ){
	// 		$this->none = true;
    //     }else{
	// 		// <3

	// 		if(isset($_POST['btn_submit'])) {
	// 			$check_logtime = $_POST['check_logtime'];
	// 			$check_logtime["lever_time"]=0;
	// 			$check_logtime["user_id"]= $_SESSION['user']['id'];
				
	// 			if( ($time > strtotime(date('08:05:00')) && $time <= strtotime(date('08:15:59'))) ||   ($time > strtotime(date('13:35:00')) && $time <= strtotime(date('13:46:00')))){
	// 				$check_logtime["lever_time"]=1;
	// 			}else if( ($time > strtotime(date('08:16:00')) && $time <= strtotime(date('08:30:00'))) ||  ($time > strtotime(date('13:46:00')) && $time <= strtotime(date('14:00:00'))) ){
	// 				$check_logtime["lever_time"]=2;
	// 			}else if( ($time > strtotime(date('08:30:00')) && $time <= strtotime(date('12:00:00'))) ||  ($time > strtotime(date('13:30:00')) && $time <= strtotime(date('17:30:00'))) ){
	// 				$check_logtime["lever_time"]=3;
	// 			}
				
	// 			$cl->addRecord($check_logtime);
	
	// 		}

	// 		$this->none = false;
			
	// 		$conditions="";
	// 		if($time < strtotime(date('12:01:00')) ){
	// 			$conditions = 'user_id = '.$_SESSION['user']['id'].' AND date(created) = "'.date('Y-m-d').
	// 				'" AND DATE_FORMAT(created, "%H:%i:%s") > "07:00:00 "  AND DATE_FORMAT(created, "%H:%i:%s") < "12:00:00 "  '  ;
	// 		}else{
	// 			$conditions = ' '.$_SESSION['user']['id'].' AND date(created) = "'.date('Y-m-d').
	// 				'" AND DATE_FORMAT(created, "%H:%i:%s") > "12:00:00 "  AND DATE_FORMAT(created, "%H:%i:%s") < "17:30:00 "  '  ;
	
	// 		}
	// 		$this->time ="";
	// 		if( $this->record = $cl->getRecord1($conditions) ){
	// 			$this->time = new DateTime($this->record['created']);
	// 			$this->time = $this->time->format('H:i:');
	// 		}
	// 		// exit(json_encode($this->record));
	// 	}

	// 	$this->display();
		
	// }


	
}