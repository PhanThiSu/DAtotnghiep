<?php
class login_controller extends vendor_api_controller
{
	public function checkUser($user=null, $remember=null) {
		$result = null;
		$um = new user_model();
		if($user){
			$email = $user['email'];
			$password = vendor_app_util::generatePassword($user['password']);
			$result = $um->getRecordWhere([
				'email' => $email,
				'password' => $password
			]);
		}
		if($remember){
			$remember_token = $remember;
			$result = $um->getRecordWhere([
				'remember_token' => $remember_token,
			]);
		}
		if ($result) {

			return $result;
		}
		return 0;
		
	}

	public function index()
	{
		// $data = json_decode(file_get_contents('php://input'), true);
		// if (!isset($data)) die();
		// $dataUser = $data['user'];
		$dataUser = [
			'email' => $_POST['email'],
			'password' => $_POST['password']
        ];
		$um = new user_model();
		$user = $this->checkUser($dataUser);

		if($user != false) {
			$email = $dataUser['email'];
			$password = vendor_app_util::generatePassword($dataUser['password']);
            $user['tocken'] = vendor_app_util::hashStr();
            // echo(json_encode($user));exit();
			if($um->editRecordToken($user['id'], $user['tocken'])){
            }
			if (isset($user)) {
				unset($user['password']);
				$data = [
					'success' => 1,
					'data' => $user,
					'tocken' => $user['tocken'],
					'message' => 'You have succesfully logined in'
				];
				echo json_encode($data);
				http_response_code(200);
			}
		} else {
			$valid = [
				'success' => 0,
				'message' => "Wrong username or password!"
			];
			http_response_code(200);
			echo json_encode($valid);
		}
		
	}

}
