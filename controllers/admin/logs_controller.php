<?php
//class logs_controller extends vendor_crud_controller {
class logs_controller extends vendor_backend_controller {
	public function index() {
		$lm = new log_model();
		$this->noLogs 			= $lm->getCountRecords();
		$this->noUnsuccessLogs 	= $lm->getCountRecords(['conditions'=>'status != 1']);
		$this->noSuccessLogs 	= $lm->getCountRecords(['conditions'=>'status=1']);
		$this->records 			= $lm->allp('*',['joins'=>['user'],'order'=>'id DESC']);

		$this->display();
	}

	public function view($id) {
		$lm = new log_model();
		$this->record = $lm->one($id,'*',['joins'=>['user']]);
		$this->display();
	}

	public function del($id) {
		$log = new log_model();
		if($log->delRelativeRecord($id)) echo "Delete Successful";
		else echo "error";
	}

	public function delmany() {
		global $app;
		$ids = $app['prs']['ids'];
		$logs = new log_model();
		if($logs->delRecords($ids)) echo "Delete many successful";
		else echo "error";
	}

}
?>