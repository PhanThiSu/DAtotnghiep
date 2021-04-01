<?php
class reports_controller extends vendor_auth_token_controller{
	
	public function add() {
		if ($_SERVER['REQUEST_METHOD']=='POST') {
		
			global $app;
			$today = date("Y-m-d");
			$timeStart = date("Y-m-d H:i:s");
			$rm = report_model::getInstance();

			$reportData = $_POST['report'];
			if(!$reportData)
				$reportData = json_decode(file_get_contents('php://input'),1);
			if(isset($_POST['group']['name'])){
				$pm = new group_model();
				$groupData = $_POST['group'];
				$groupData['status'] = 0;
				$groupData['user_created_id'] =$app['user_auth']['id']; 
				
				if($resultGr = $pm->addRecord($groupData)){
					$reportData['group_id'] = $resultGr;
				}
			}
			$reportData['work_time'] = 0;
			$reportData['time_start'] = $timeStart;
			$reportData['time_end'] = $timeStart;
			$reportData['user_id'] =$app['user_auth']['id'];
			$reportData['date_report'] = $today;
			$pvalid = $rm->validator($reportData);
			if($app['report_id'] = $rm->addRecord($reportData)){
				$reportData['id']=$app['report_id'] ;
				// $_SESSION['report_id'] = $result;
				
				http_response_code(200);
				echo json_encode($reportData);
			}
			else {
				$data = [
					'status' => 0,
					'message' => 'Error when adding data!'
				]; 
				http_response_code(400);
				echo json_encode($data);
			}
		
		}
			else {
			http_response_code(404);
			echo "Error Method!";
		}
	
		
	}


	public function update() {
		if ($_SERVER['REQUEST_METHOD']=='POST') {
				global $app;
			// update report (Stop)
					$reportData = $_POST['report'];
			if(!$reportData)
				$reportData = json_decode(file_get_contents('php://input'),1);
			if(isset($_POST['report']['id'])){
				$time = date ("Y-m-d H:i:s");
				$rm = report_model::getInstance();
				$report_id = $_POST['report']['id'] ;
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
				$reportData['work_time'] = number_format((float)$reportData['work_time'] , 1, '.', '');

				$reportData['time_end'] = $time;
				if($rm->editRecord($report_id,$reportData)) {
					unset($_POST['report']['id']);
				http_response_code(200);
				echo json_encode($reportData);
				}
			}

			// start existing
		
			else {
				$data = [
					'status' => 0,
					'message' => 'Error when update data!'
				]; 
				http_response_code(400);
				echo json_encode($data);
			}
		

		}
		else {
			http_response_code(404);
			echo "Error Method!";
		}
		
	}
	public function edit() {
		if ($_SERVER['REQUEST_METHOD']=='POST') {
		
			global $app;
			$today = date("Y-m-d");
			$timeStart = date("Y-m-d H:i:s");
			$rm = report_model::getInstance();
			$reportData = $_POST['report'];
	if(isset($_POST['report']['id'])){
			if(!$reportData)
				$reportData = json_decode(file_get_contents('php://input'),1);
			$reportData['time_end'] = $timeStart;
			$reportData['date_report'] = $today;
			$pvalid = $rm->validator($reportData);
			if($app['report_id'] = $rm->editRecord($_POST['report']['id'],$reportData)){
				$reportData['id']=$app['report_id'] ;
				// $_SESSION['report_id'] = $result;
				
				http_response_code(200);
				echo json_encode($reportData);
			}
			else {
				$data = [
					'status' => 0,
					'message' => 'Error when edit data!'
				]; 
				http_response_code(400);
				echo json_encode($data);
			}
		}
		}
			else {
			http_response_code(404);
			echo "Error Method!";
		}
	
		
	}
		public function del($id) {
		if ($_SERVER['REQUEST_METHOD']=='DELETE') {
			$report = report_model::getInstance();
			if($report->delRecord($id)) {
				$data = ['id' => $id[1]];
		 		http_response_code(200);
				echo json_encode($data);
			} else {
				$message = 'Can not delete this data!';
				http_response_code(404);
				echo json_encode($message);
			}
		}
	}


}
?>