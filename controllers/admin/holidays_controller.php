<?php
//class users_controller extends vendor_crud_controller {
class holidays_controller extends vendor_backend_controller {
	public function index() {
		global $app;
		$conditions = " year(day) = ".date("Y")." ";
		$holidays = new holidays_model();
		$this->records = $holidays->allp('*',['conditions'=>$conditions, 'joins'=>false,'order'=>'day']);
		// exit(json_encode($this->records));
		$this->display();
	}

	public function view($id) {
		$um = new user_model();
		$this->record = $um->getRecord($id);
		$this->display();
	}

	public function add() {
		if(isset($_POST['btn_submit'])) {
			$hld = new holidays_model();
			$holidayData = $_POST['holidays'];
			$valid = $hld->validator($holidayData);
			if($valid['status']) {
				if($hld->addRecord($holidayData))
					header("Location: ".vendor_app_util::url(["ctl"=>"holidays"]));
				else {
					$this->errors = ['database'=>'An error occurred when inserting data! '. $hld->errors['message']];
					$this->record = $holidayData;
				}
			} else {
				$this->errors = $hld::convertErrorMessage($valid['message']);
				$this->record = $holidayData;
			}
		}
		$this->display();
	}

	public function edit($id) {
		$hld = new holidays_model();
		$this->record = $hld->getRecord($id);
		if(isset($_POST['btn_submit'])) {
			$userData = $_POST['holidays'];
			$valid = $hld->validator($userData, $id);
			if($valid['status']) {
				if($hld->editRecord($id, $userData)) {
					header("Location: ".vendor_app_util::url(["ctl"=>"holidays"]));
				} else {
					$this->errors = ['database'=>'An error occurred when editing data!'. $hld->errors['message']];
					$this->record = $userData;
				}
			} else {
				$this->errors = $hld::convertErrorMessage($valid['message']);
				$this->record = $userData;
				$this->record['id'] = $id;
			}
		}
		$this->display();
	}


	public function del($id) {
		$hld = new holidays_model();
		if($hld->delRelativeRecord($id)) echo "Delete Successful";
		else echo "error";
	}

	public function trashmany() {
		global $app;
		$ids = $app['prs']['ids'];
		$hld = new holidays_model();
		$userData['status'] = 0;
		if($hld->editRecords($ids, $userData, "role != 1")) echo "Move many to trash successful";
		else echo "error";
	}

	public function delmany() {
		global $app;
		$ids = $app['prs']['ids'];
		$hld = new holidays_model();
		if($hld->delRelativeRecords($ids)) echo "Delete many successful";
		else echo "error";
	}


}
?>