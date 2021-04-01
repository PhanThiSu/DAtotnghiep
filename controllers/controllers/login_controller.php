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
				header( "Location: ".vendor_app_util::url(['ctl'=>'dashboard']));
			} else {
			}
		}

		if (isset($_SESSION['user']['role'])) {
			header( "Location: ".vendor_app_util::url(['ctl'=>'dashboard']));
		}
		if(isset($_POST['btn_submit'])) {
			$user = $_POST['user'];
			$auth = new vendor_auth_model();

			if (!vendor_app_util::validationEmail($user['email'])){
				$this->errors['message'] = "Wrong email!";
			}
			else if($auth->login($user)) {
				log_model::setLog(log_model::$type['login']);
				if ($_SESSION['link'] == "") header("Location: ".vendor_app_util::url(['ctl'=>'dashboard']));
				else header("Location: ".vendor_app_util::url(['ctl'=>$_SESSION['link']]));
				
			} else {
				log_model::setLog(log_model::$type['login'],0,$_POST['user']['email']);
				$this->errors = ['message'=>'Không thể đăng nhập bằng tài khoản này!'];
			}
		}
		$this->display();
	}
	
	public function logout() {
		session_unset(); 
		session_destroy(); 
		$time = 3600;
    	unset($_COOKIE['remember_me']);
		setcookie('remember_me', '', time() - $time, '/');
		log_model::setLog(log_model::$type['logout']);
		header( "Location: ".vendor_app_util::url(array('ctl'=>'login')));
	}

	public function forgotPassWord() {
		global $app;
		if(isset($_POST['btn_submit']))
		{
			$email = $_POST['email'];
			$checkemail = new forgotpass_model();
			if( $checkemail->checkOldEmail($email)) {	
				$tocken = time().rand(10000,99999);
				$checkemail -> addtocken($tocken,$email);

				$mTo = $email;
				$title = 'HTML email';
				$href = RootABS.
				  		vendor_app_util::url([
				  				'ctl'=>'login',
				  				'act'=> 'resetPassWord', 
				  				'params'=> ['tocken' => $tocken]
				  		]);
				$content = "
					<h3>What's Next?</h3>
				  	<p>Please <a target='_blank' href='".$href."'>click here </a> to create your new password.</p>
				";
				$nTo = 'TPM';
				
				vendor_app_util::sendMail($title, $content, $nTo, $mTo);
				$this->errors = ['message'=>'<a href="#">thank! </a>'];
				
			} else {
				$this->errors = ['message'=>'Error! Please enter a valid email address.'];
			}
		}
		$this->display();
	}

	public function resetPassWord() {
		global $app;
		$this->tocken = $app['prs']['tocken'];
		$checktocken = new forgotpass_model();
		if( $checktocken->resetPassWord($this->tocken)) {
			if(isset($_POST['btn_submit']))
			{
				if ($_POST['password'] == $_POST['confirmpassword']) {
					$tocken = $this->tocken;
					$password = vendor_app_util::generatePassword($_POST['password']);
					if ($checktocken->updatePassword($tocken,$password)){
						log_model::setLog(log_model::$type['reset_password']);
						header( "Location: ".vendor_app_util::url(array('ctl'=>'login')));
					} else {
						$this->display();
					}
				}else{
					$this->errors = ['message'=>'Lỗi xác nhận mật khẩu!'];
					$this->display();
				}
			}
			$this->display();
		} else {
			//header( "Location: ".vendor_app_util::url(array('ctl'=>'login', 'act'=> 'erorsResetPass')));
			$this->errors = ['message'=>'Error! tocken does not exist, Please check the tocken '];
			$this->display(['act'=>'erorsResetPass']);
		}
	}
}
?>
