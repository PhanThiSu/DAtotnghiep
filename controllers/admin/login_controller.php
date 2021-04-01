<?php
class login_controller extends vendor_main_controller {
	protected 	$errors = false;

	public function index() {
		global $app;
		$rolesFlip = array_flip($app['roles']);
		if (isset($_COOKIE['remember_me'])) {
			$auth = new vendor_auth_model();
			$arr = explode(":", $_COOKIE["remember_me"]);

			$remember = ['remember_me_identify'	=> $arr[0],
					 'remember_me_token'	=> $arr[1]];
			if ($auth->login(null, true, $remember)) {
				log_model::setLog(log_model::$type['login']);
				header( "Location: ".vendor_app_util::url(['ctl'=>'dashboard']));
			} else {
				log_model::setLog(log_model::$type['login'],0);
			}
		}
		if (isset($_SESSION['user']['role']) && $_SESSION['user']['role']==$rolesFlip["admin"]) {
			log_model::setLog(log_model::$type['login']);
			header( "Location: ".vendor_app_util::url(array('ctl'=>'dashboard')));	die();
		}

		if(isset($_POST['btn_submit'])) {
			$user = $_POST['user'];
			$auth = new vendor_auth_model();

			if (!vendor_app_util::validationEmail($user['email'])){
				$this->errors['input'] = "Bạn cần điền email và mật khẩu!";
			}

			else if($auth->login($user, true)) {
				log_model::setLog(log_model::$type['login']);
				if ($_SESSION['link'] == "") header( "Location: ".vendor_app_util::url(array('ctl'=>'dashboard')));
				else
					header( "Location: ".vendor_app_util::url(array('ctl'=>substr($_SESSION['link'],6))));
			} else {
				log_model::setLog(log_model::$type['login'],0,$_POST['user']['email']);
				$this->errors['input'] = "Email hoặc mật khẩu sai!";
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