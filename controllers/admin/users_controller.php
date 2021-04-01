<?php
//class users_controller extends vendor_crud_controller {
class users_controller extends vendor_backend_controller {
	public function index() {
		global $app;
		$conditions = "";
		if(isset($app['prs']['status'])) {
			$conditions .= "status=".$app['prs']['status'];
		}
		if(isset($app['prs']['role'])) {
			$conditions .= (($conditions)? " AND ":"")."role=".$app['prs']['role'];
		}

		$user = new user_model();
		$this->records = $user->allp('*',['conditions'=>$conditions, 'joins'=>false]);
		$this->display();
	}

	public function view($id) {
		$um = new user_model();
		$this->record = $um->getRecord($id);
		$this->display();
	}

	public function add() {
		if(isset($_POST['btn_submit'])) {
			$um = new user_model();
			$userData = $_POST['user'];
			if($_FILES['image']['tmp_name'])
				$userData['avata'] = $this->uploadImg($_FILES);
			$valid = $um->validator($userData);
			if($valid['status']) {
				$userData['password'] = vendor_app_util::generatePassword($userData['password']);
				if($um->addRecord($userData))
					header("Location: ".vendor_app_util::url(["ctl"=>"users"]));
				else {
					$this->errors = ['database'=>'An error occurred when inserting data! '. $um->errors['message']];
					$this->record = $userData;
				}
			} else {
				$this->errors = $um::convertErrorMessage($valid['message']);
				$this->record = $userData;
			}
		}
		$this->display();
	}

	public function edit($id) {
		$um = new user_model();
		$this->record = $um->getRecord($id);
		if(isset($_POST['btn_submit'])) {
			$userData = $_POST['user'];
			if($_FILES['image']['tmp_name']) {
				if($this->record['avata'] && file_exists(RootURI."/media/upload/" .$this->controller.'/'.$this->record['avata']))
					unlink(RootURI."/media/upload/" .$this->controller.'/'.$this->record['avata']);
				$userData['avata'] = $this->uploadImg($_FILES);
			}

			$valid = $um->validator($userData, $id);
			if($valid['status']) {
				if($userData['password'])
					$userData['password'] = vendor_app_util::generatePassword($userData['password']);
				else
					unset($userData['password']);


				if($um->editRecord($id, $userData)) {
					header("Location: ".vendor_app_util::url(["ctl"=>"users"]));
				} else {
					$this->errors = ['database'=>'An error occurred when editing data!'. $um->errors['message']];
					$this->record = $userData;
				}
			} else {
				$this->errors = $um::convertErrorMessage($valid['message']);
				$this->record = $userData;
				$this->record['id'] = $id;
			}
		}
		$this->display();
	}

	public function changestatus() {
		global $app;
		$id = $app['prs'][1];
		$user = new user_model();
		$userData['status'] = $_POST['status']?0:1;
		if($user->editRecord($id, $userData, "role != 1")) echo "Change status successful";
		else echo "error";
	}

	public function del($id) {
		$user = new user_model();
		if($user->delRelativeRecord($id, "role != 1")) echo "Delete Successful";
		else echo "error";
	}

	public function trashmany() {
		global $app;
		$ids = $app['prs']['ids'];
		$users = new user_model();
		$userData['status'] = 0;
		if($users->editRecords($ids, $userData, "role != 1")) echo "Move many to trash successful";
		else echo "error";
	}

	public function delmany() {
		global $app;
		$ids = $app['prs']['ids'];
		$users = new user_model();
		if($users->delRelativeRecords($ids, "role != 1")) echo "Delete many successful";
		else echo "error";
	}

	public function profile() {
		$um = new user_model();
		$this->record = $um->getRecord($_SESSION['user']['id']);
		$this->display();
	}

	public function changepassword() {
		global $app;
		$curpassword = vendor_app_util::generatePassword($_POST['curpassword']);
		$um = new user_model();
		if( $um->checkOldPassword($curpassword)) {
			$newpassword 	= $_POST['newpassword'];
			$userData['password'] = vendor_app_util::generatePassword($newpassword);

			$id 		= $_SESSION['user']['id'];
			$password 	= $um->getAllRecordsLimit($id);
			if($um->editRecord($id, $userData))
				echo json_encode(['status'=>1, 'message'=>'Update successful!']);
			else echo json_encode(['status'=>0, 'message'=>'Have error when update password!']);
		} else {
			echo json_encode(['status'=>0, 'message'=>'Current password not match!']);
		}
		exit;
	}
}
?>