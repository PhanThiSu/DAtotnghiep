<?php
class users_controller extends vendor_auth_token_controller {

	public function user_infor()
	{
		global $app;
		http_response_code(200);
		echo json_encode($app['user_auth']);
		exit();
	}

	

}
?>