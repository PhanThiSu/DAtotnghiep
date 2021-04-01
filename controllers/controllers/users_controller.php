<?php
class users_controller extends vendor_auth_controller {

	protected 	$errors = false;

	public function changepass() {
		if(isset($_POST['btn_submit'])) {
			//check fields
			$oldpassword = vendor_app_util::generatePassword($_POST['password']);
			$um = new user_model();
			if( $um->checkOldPassword($oldpassword)) {
				$newpassword = vendor_app_util::generatePassword($_POST['newpassword']);
				if($um->updatePassword($newpassword)) {
					log_model::setLog(log_model::$type['update_password']);
					header("Location: ".vendor_app_util::url(array('ctl'=>'login')));
					die();
				} else {
					log_model::setLog(log_model::$type['update_password'],0);
					$this->errors = ['message'=>'Can not edit data!'];
				}
			} else {
				$this->errors = ['message'=>'Old password not match!'];
			}
		}
		$this->display();
	}

	public function profile() {
		$profile = new user_model();
		$this->user = $profile->profile();
		$this->display();
	}


	public function editProfile() {
		global $app;

		$id = $_SESSION['user']['id'];
		$um = new user_model();
		$this->record = $um->getRecord($id);
		if(isset($_POST['btn_submit'])) {
			$userData = $_POST['data'][$this->controller];
			if(isset($userData['role']))	unset($userData['role']);
			if(isset($userData['status']))	unset($userData['status']);

			if($_FILES['image']['tmp_name']) {
				if($this->record['avata'] && file_exists(RootURI."/media/upload/" .$this->controller.'/'.$this->record['avata']))
					unlink(RootURI."/media/upload/" .$this->controller.'/'.$this->record['avata']);
				$userData['avata'] = $this->uploadImg($_FILES);
			}
			if($userData['password'])
				$userData['password'] = vendor_app_util::generatePassword($userData['password']);
			else
				unset($userData['password']);

			if($um->editRecord($id,$userData)) {
				log_model::setLog(log_model::$type['edit_profile']);
				header( "Location: ".vendor_app_util::url(array('ctl'=>'users', "act"=>"profile")));
			} else {
				log_model::setLog(log_model::$type['edit_profile']);
				$this->errors = ['message'=>'Can not save data!'];
			}
		}
		$this->display();
	}

	public function logout() {
		$um = new user_model();
		$um->editRecord(
			$_SESSION['user']['id'],
			[
				'remember_me_identify' 	=> '',
				'remember_me_token'		=> ''
			]
		);

		log_model::setLog(log_model::$type['logout']);
		// remove all session variables
		session_unset();

		// destroy the session
		session_destroy();

		$time = 3600;
    	unset($_COOKIE['remember_me']);
		setcookie('remember_me', '', time() - $time, '/');

		header( "Location: ".vendor_app_util::url(array('ctl'=>'login')));
	}
}
?>