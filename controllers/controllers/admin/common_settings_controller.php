<?php
class common_settings_controller extends vendor_backend_controller
{
	protected 	$errors = false;

	public function index() {
		global $app;
        $common_setting_model = common_setting_model::getInstance();
		
		$this->record = $common_setting_model->getRecord('1');
		// exit(json_encode($this->record['fisrt_saturday_of_year']));

		// return $foo;
		$this->display();
	}


	public function edit($id) {
		$common_setting_model = common_setting_model::getInstance();

		$commonSettingsData = $_POST['common_settings'];
		$common_setting_model->editRecord('1', $commonSettingsData);
		$this->display();
	}


}
?>