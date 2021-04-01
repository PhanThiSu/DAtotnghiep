<?php
//class notifications extends vendor_crud_controller {
class notifications_controller extends vendor_backend_controller {
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

	public function view($id) {
		$um = notification_model::getInstance();
		$this->record = $um->getRecord($id);
		$this->display();
	}

	public function add() {
		$stm = notification_model::getInstance();
		if(isset($_POST['btn_submit'])) {
			$notificationData = $_POST['notification'];
			$notificationData['user_id'] = $_SESSION['user']['id'];
			$valid = $stm->validator($notificationData);
			if($valid['status']){
				if($stm->addRecord($notificationData)) {
					$this->sendmail($notificationData);
					header("Location: ".vendor_app_util::url(["ctl"=>"notifications"]));
				} else {
					$this->errors = ['database'=>'An error occurred when inserting data!'];
					$this->record = $notificationData;
				}
			} else {
				$this->errors = $stm::convertErrorMessage($valid['message']);
				$this->record = $notificationData;
			}		
		}
		$this->display();
	}

	public function sendmail($notificationData) {
		$sapi_type = php_sapi_name();
		$um = new user_model();
		$today = date('Y-m-d');
		$records_user = $um->getAllRecords(
			'*',
			[ 'conditions' => "users.role != 1"]
		);

		if(count($records_user)) {
			while($row = $records_user->fetch_assoc()) {
				$nTo = 'TPM Admin';
				$mTo = $row['email'];
				$title = $notificationData['title'];
				$content = "<h3> Hi ".$row['firstname']." ".$row['lastname']."</h3></br>".$notificationData['content'];

				vendor_app_util::sendMail($title, $content, $nTo, $row['email']);
			}
		} else { 
			echo "error";
		}

	}
}
?>
