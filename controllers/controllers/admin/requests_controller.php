<?php
class requests_controller extends vendor_backend_controller
{
	protected 	$errors = false;
	public function index() {
		$rm = new request_model();
		$this->records = $rm->allp('*', ['joins'=>['user']]);
		$this->display();
	}

	public function view($id) {
		global $app;
		$id = $app['prs'][1];
		$rm = new request_model();
		$this->record = $rm->one($id);
		$this->display();
	}

	public function user() {
		global $app;
		$id = $app['prs'][1];
		$rm = new request_model();
		$conditions = $rm->getTableName().'.user_id='.$id;

		//$week = (isset($_POST['week']))? $_POST['week'] : date("Y")."-W".date("W");
		if(isset($_POST['week'])) {
			$week = $_POST['week'];
	 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; 	//Returns the date of monday in week
	    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";	//Returns the date of sunday in week

			$conditions .= ' AND ((datetime_start <= "'.$startWeek.'" AND datetime_end >= "'.$endWeek.'")';
			$conditions .= ' OR (datetime_start >= "'.$startWeek.'" AND datetime_start <= "'.$endWeek.'")';
			$conditions .= ' OR (datetime_end   >= "'.$startWeek.'" AND datetime_end   <= "'.$endWeek.'"))';
			$this->time = $week;
			$this->timetype = 'week';
		} else {
			if (isset($app['prs']['time'])) {
				$month = $app['prs']['time'];
			} else {
				$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
			}
			$startMonth = $month.'-01';
			$endMonth 	= date("Y-m-t", strtotime($startMonth));
			$conditions .= ' AND ((datetime_start <= "'.$startMonth.'" AND datetime_end >= "'.$endMonth.'")';
			$conditions .= ' OR (datetime_start >= "'.$startMonth.'" AND datetime_start <= "'.$endMonth.'")';
			$conditions .= ' OR (datetime_end   >= "'.$startMonth.'" AND datetime_end   <= "'.$endMonth.'"))';
			$this->time = $month;
			$this->timetype = 'month';
		}
		$this->user_id = $id;

		$this->records = $rm->allp('*',['conditions' => $conditions, 'joins'=>['user']]);
		$this->display();
	}

	public function userall() {
		global $app;
		$id = $app['prs'][1];
		$rm = new request_model();
		$this->records = $rm->allp('*',['conditions' => $rm->getTableName().'.user_id='.$id, 'joins'=>['user']]);
		$this->display();
	}

	public function month() {
		$rm = new request_model();
		$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
		$startMonth = $month.'-01 00:00:00';
		$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
		$conditions = '(datetime_start <= "'.$startMonth.'" AND datetime_end >= "'.$endMonth.'")';
		$conditions .= ' OR (datetime_start >= "'.$startMonth.'" AND datetime_start <= "'.$endMonth.'")';
		$conditions .= ' OR (datetime_end   >= "'.$startMonth.'" AND datetime_end   <= "'.$endMonth.'")';
		$this->records = $rm->allp('*',['conditions'=>$conditions, 'joins'=>['user']]);
		$this->time = $month;
		$this->display();
	}

	public function week() {
		$rm = new request_model();
		$week = (isset($_POST['week']))? $_POST['week'] : date("Y")."-W".date("W");
		//$startWeek  = date('Y-m-d',strtotime($week));
 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00";		//Returns the date of monday in week
    	$endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";  //Returns the date of sunday in week

		$conditions = '(datetime_start <= "'.$startWeek.'" AND datetime_end >= "'.$endWeek.'")';
		$conditions .= ' OR (datetime_start >= "'.$startWeek.'" AND datetime_start <= "'.$endWeek.'")';
		$conditions .= ' OR (datetime_end   >= "'.$startWeek.'" AND datetime_end   <= "'.$endWeek.'")';

		$this->records = $rm->allp('*',['conditions'=> $conditions, 'joins'=>['user']]);
		$this->time = $week;
		$this->display();
	}

	public function daily() {
		$rm = new request_model();
		$daily = (isset($_POST['date']))? $_POST['date'] : date("Y-m-d");
 		$startDate  = $daily." 00:00:00"; 
    	$endDate    = $daily." 23:59:59";

		$conditions = '(datetime_start <= "'.$startDate.'" AND datetime_end >= "'.$endDate.'")';
		$conditions .= ' OR (datetime_start >= "'.$startDate.'" AND datetime_start <= "'.$endDate.'")';
		$conditions .= ' OR (datetime_end   >= "'.$startDate.'" AND datetime_end   <= "'.$endDate.'") ';

		$this->records = $rm->allp('*',['conditions'=> $conditions, 'joins'=>['user']]);
		$this->time = $daily;
		$this->display();
	}

	public function todayunprocess() {
		$rm = new request_model();
		$daily = (isset($_POST['date']))? $_POST['date'] : date("Y-m-d");
 		$startDate  = $daily." 00:00:00"; 
    	$endDate    = $daily." 23:59:59";

    	$conditions = '(requests.created >= "'.$startDate.'" AND requests.created <= "'.$endDate.'") AND requests.status = 0 ';
		$this->records = $rm->allp('*',['conditions'=> $conditions, 'joins'=>['user']]);
		$this->time = $daily;
		$this->display();
	}

	public function beforeunprocess() {
		$rm = new request_model();
		$daily = (isset($_POST['date']))? $_POST['date'] : date("Y-m-d");
 		$startDate  = $daily." 00:00:00"; 
    	$endDate    = $daily." 23:59:59";

		$conditions = '(requests.datetime_end <= "'.$endDate.'" ) AND requests.status = 0 ';

		$this->records = $rm->allp('*',['conditions'=> $conditions, 'joins'=>['user']]);
		$this->time = $daily;
		$this->display();
	}

	public function add() {
		if(isset($_POST['btn_submit'])) {
			$requestData = $_POST['request'];
			if(!$requestData['user_id'])	$requestData['user_id'] = $_SESSION['user']['id'];
			$rm = new request_model();
			//check time
			if((strtotime($requestData['datetime_start']) - strtotime($requestData['datetime_end']))>=0){
				$this->errors = ['database'=>'Date Start after Date End'];
			}else{
							if($rm->addRecord($requestData)) {
								$nTo = 'TPM';
								$mTo = "";
								$umm = new user_model();
								$userMail = $umm->getAllRecords('email,firstname,lastname',['conditions'=>"id = ".$requestData['user_id'].""]);
				
								foreach ($userMail as $record) {
									$mTo = $record['email'];
									$fullname = $record['firstname']." ".$record['lastname'];
								}
								$timeStart = $requestData['datetime_start'];
								$timeEnd = $requestData['datetime_end'];
								$title = " Hi ".$fullname." ";
								$content = "
									<h3>Mr ".$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']." added request for you.</h3>
									<br><p>Reason: ".$requestData['reason']."</p><br>
										<p>Time start off : ".$timeStart." <br>Time end off: ".$timeEnd."</p><br>
									  <br><p>Click {link to http://pscd.pacificsoftdev.com/requests } to see more.<br><br>Thanks,<br>Admin TPM.</p>
								";
								vendor_app_util::sendMail($title, $content, $nTo, $mTo);
								header( "Location: ".vendor_app_util::url(array('ctl'=>'requests')));
							} else {
								$this->errors = ['message'=>'Can not save data!'];
							}

			}
		}
		$um = new user_model();
		$this->users = $um->getAllRecords('id, firstname, lastname', ['conditions'=>'role!=1']);
		$this->display();
	}

	public function edit($id) {
		$rm = new request_model();
		$this->record = $rm->one($id);
		if(isset($_POST['btn_submit'])) {
			$requestData = $_POST['request'];
			if(!$requestData['user_id'])	$requestData['user_id'] = $_SESSION['user']['id'];
			
			$valid = $rm->validator($requestData, $id);
			if($valid['status']){
				if($requestData['password'])
					$requestData['password'] = vendor_app_util::generatePassword($requestData['password']);
				
				if($rm->editRecord($id, $requestData)) {
					if (isset($requestData['status']) && $requestData['status'] != $this->record['status']) {
					$nTo = 'TPM';
					$mTo = "";
					$umm = new user_model();
					$userMail = $umm->getAllRecords('email,firstname,lastname',['conditions'=>"id = ".$requestData['user_id'].""]);

					foreach ($userMail as $record) {
						$mTo = $record['email'];
						$fullname = $record['firstname']." ".$record['lastname'];
					}
					$title = " Hi ".$fullname." ";
					$content = "
						<h3>Mr ".$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']." has changed for your request off that you requested to system.</h3>
					  	<br><p>Click {link to http://pscd.pacificsoftdev.com/requests } to see more.<br><br>Thanks,<br>Admin TPM.</p>
					";
					vendor_app_util::sendMail($title, $content, $nTo, $mTo);
					}

					header("Location: ".vendor_app_util::url(["ctl"=>"requests"]));
				} else {
					$this->errors = ['database'=>'An error occurred when editing data!'];
				}
			} else {
				$this->errors = $um::convertErrorMessage($valid['message']);
			}
			$this->record = $requestData;
			$this->record['id'] = $id;
			// $this->record = array_merge($this->record, $requestData);
		}
		$um = new user_model();
		$this->users = $um->getAllRecords('id, firstname, lastname');
		$this->display();
	}

	public function del($id) {
		$rm = new request_model();
		if($rm->delRelativeRecord($id)) echo "Delete Successful";
		else echo "error";
	}

	public function delmany() {
		global $app;
		$ids = $app['prs']['ids'];
		$rm = new request_model();
		if($rm->delRelativeRecords($ids)) echo "Delete many successful";
		else echo "error";
	}

	public function updateStatus($id) {
		$rm = new request_model();
		$status = $_POST['status'];
		$id = $_POST['idrq'];
		$updateData = ['status'=>$status];
		if($rm->editRecord($id, $updateData)){

			$userid = $rm->getRecord($id);
			
			$nTo = 'TPM';
			$umm = new user_model();
			$userMail = $umm->getAllRecords('email,firstname,lastname',['conditions'=>"id = ".$userid['user_id'].""]);
			$mTo = "";
			foreach ($userMail as $record) {
				$mTo = $record['email'];
				$fullname = $record['firstname'] .$record['lastname'];
			}
			$title = " Hi ".$fullname." ";
			$content = "
				<h3>Mr ".$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']." has changed for your request off that you requested to system.</h3>
			  	<br><p>Click {link to http://pscd.pacificsoftdev.com/requests } to see more.<br><br>Thanks,<br>Admin TPM.</p>
			";
		 	vendor_app_util::sendMail($title, $content, $nTo, $mTo);
			header( "Location: ".vendor_app_util::url(array('ctl'=>'requests')));

			echo "Update Successful";
		} else { 
			echo "error";
		}
	}
}
?>