<?php
class requests_controller extends vendor_auth_controller {
	protected 	$errors = false;
	public function index() {
		$rm = new request_model();
		$userId = ucfirst($_SESSION['user']['id']);
		$this->records = $rm->allp('*',['conditions'=> 'requests.user_id = "'.$userId.'" ','joins'=>['user']]);
		$this->display();
	}

	public function view($id) {
		global $app;
		$id = $app['prs'][1];
		$rm = new request_model();
		$this->record = $rm->one($id);
		$this->display();
	}

	public function month() {
		$rm = new request_model();
		$userId = ucfirst($_SESSION['user']['id']);
		$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
		$startMonth = $month.'-01 00:00:00';
		$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
		$conditions = '(datetime_start <= "'.$startMonth.'" AND datetime_end >= "'.$endMonth.'" AND  requests.user_id = "'.$userId.'")';
		$conditions .= ' OR (datetime_start >= "'.$startMonth.'" AND datetime_start <= "'.$endMonth.'" AND  requests.user_id = "'.$userId.'")';
		$conditions .= ' OR (datetime_end   >= "'.$startMonth.'" AND datetime_end   <= "'.$endMonth.'" AND  requests.user_id = "'.$userId.'")';
		$this->records = $rm->allp('*',['conditions'=>$conditions, 'joins'=>['user']]);
		$this->display();
	}

	public function week() {
		$rm = new request_model();
		$userId = ucfirst($_SESSION['user']['id']);
		$week = (isset($_POST['week']))? $_POST['week'] : date("Y")."-W".date("W");
		//$startWeek  = date('Y-m-d',strtotime($week));
 		$startWeek  = date("Y-m-d", strtotime("$week-1"))." 00:00:00"; 	//Returns the date of monday in week
	    $endWeek    = date("Y-m-d", strtotime("$week-7"))." 23:59:59";	//Returns the date of sunday in week

		$conditions = '(datetime_start <= "'.$startWeek.'" AND datetime_end >= "'.$endWeek.'" AND  requests.user_id = "'.$userId.'")';
		$conditions .= ' OR (datetime_start >= "'.$startWeek.'" AND datetime_start <= "'.$endWeek.'" AND  requests.user_id = "'.$userId.'")';
		$conditions .= ' OR (datetime_end   >= "'.$startWeek.'" AND datetime_end   <= "'.$endWeek.'" AND  requests.user_id = "'.$userId.'")';

		$this->records = $rm->allp('*',['conditions'=> $conditions, 'joins'=>['user']]);
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
	 		$startWeek  = date("Y-m-d", strtotime("$week-1")); //Returns the date of monday in week
	    	$endWeek    = date("Y-m-d", strtotime("$week-7"));   //Returns the date of sunday in week

			$conditions .= ' AND ((datetime_start <= "'.$startWeek.'" AND datetime_end >= "'.$endWeek.'")';
			$conditions .= ' OR (datetime_start >= "'.$startWeek.'" AND datetime_start <= "'.$endWeek.'")';
			$conditions .= ' OR (datetime_end   >= "'.$startWeek.'" AND datetime_end   <= "'.$endWeek.'"))';
		} else {
			$month = (isset($_POST['month']))? $_POST['month'] : date('Y-m');
			$startMonth = $month.'-01';
			$endMonth 	= date("Y-m-t", strtotime($startMonth));
			$conditions .= ' AND ((datetime_start <= "'.$startMonth.'" AND datetime_end >= "'.$endMonth.'")';
			$conditions .= ' OR (datetime_start >= "'.$startMonth.'" AND datetime_start <= "'.$endMonth.'")';
			$conditions .= ' OR (datetime_end   >= "'.$startMonth.'" AND datetime_end   <= "'.$endMonth.'"))';
		}
		$this->user_id = $id;
		$this->records = $rm->allp('*',['conditions' => $conditions, 'joins'=>['user']]);
		$this->display();
	}

	public function add() {
		if(isset($_POST['btn_submit'])) {
			$requestData = $_POST['request'];
			$requestData['user_id'] = $_SESSION['user']['id'];
			if(isset($userData['status']))	unset($userData['status']);

			if((strtotime($requestData['datetime_start']) - strtotime($requestData['datetime_end']))>0){
				$this->errors['type']		=	'inputform';
				$this->errors['message']	=	'Date time end must after date time start';
			}else{
				$rm = new request_model();
				$valid = $rm->validator($requestData);
	
				if($valid['status']) {
					if($id = $rm->addRecord($requestData)) {
						log_model::setLog(log_model::$type['add_request'],1,$id);
						$email = $_SESSION['user']['email'];
						$um = new user_model();
						$adminMails = $um->getAllRecords('email',['conditions'=>'role = 1']);
	
						$timeStart = $requestData['datetime_start'];
						$timeEnd = $requestData['datetime_end'];
						$href = RootURL."admin/requests/edit/".$id;
						$nTo = 'TPM';
						$mTo = "";
						foreach ($adminMails as $record) {
							$mTo .= ($mTo? ", ": "") .$record['email'];
						}
						$title = "Has requested";
						$content = "
							<h3>Request leave of ".$_SESSION['user']['firstname']." ".$_SESSION['user']['lastname']."</h3>
							  <br><p>Reason: ".$requestData['reason']."</p><br>
							<p>Time start off : ".$timeStart." <br>Time end off: ".$timeEnd."</p><br>
							  <p>click link to go to update the record this user request : <a href=".$href.">".$href."</a></p>
						";
						if(vendor_app_util::sendMail($title, $content, $nTo, $mTo))
							header( "Location: ".vendor_app_util::url(array('ctl'=>'requests')));
						else {
							$this->errors['type']		=	'mail-function';
							$this->errors['message']	=	'Error mail function';
						}
					} else {
						log_model::setLog(log_model::$type['add_request'],0);
					}
				} else {
					$this->errors['type']		=	'inputform';
					$this->errors['message']	=	'Error with input data';
					$this->errors['inputForm']	= 	$rm::convertErrorMessage($valid['message']);
				}		
			}
			$this->record = $requestData;	
		}
		$this->display();
	}
}
?>