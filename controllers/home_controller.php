<?php
class home_controller extends vendor_main_controller {
	protected 	$errors = false;
	public function index() 
	{

		if (isset($_SESSION['user']['role'])) {
			header( "Location: ".vendor_app_util::url(['ctl'=>'dashboard']));
		}else
			$this->display(['ctl'=>'login']);
	} 
}
?>