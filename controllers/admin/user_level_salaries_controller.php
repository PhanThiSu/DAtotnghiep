<?php
class user_level_salaries_controller extends vendor_backend_controller {
    public function index() {
        global $app;
		$level_model = new user_level_salary_model();
		$conditions = "";
        $rolesFlip = array_flip($app['roles']);
		$conditions .= "user_level_salaries.status=1 AND users.role!=".$rolesFlip["admin"];
        
        $this->records = $level_model->allp('*',['conditions'=>$conditions, 'joins'=>['user']]);
		$this->display();
    }
    public function view($id){
        global $app;
        $level_model = new user_level_salary_model();
		$this->record = $level_model->getRecord($id, "*,user_level_salaries.id as id", ['joins'=>['user']]);
        $this->display();
    }

    public function add (){
        if(isset($_POST['btn_submit'])) {
            $level_model = user_level_salary_model::getInstance();
            $formData = $_POST['user_level_salary'];
            // exit(json_encode($formData));
            if((strtotime($formData['start']) - strtotime($formData['end']))>=0){
				$this->errors = ['database'=>'Date Start after Date End'];
			}else{
                if($formData['start']==""){
                    unset($formData['start']);
                }
                if($formData['end']==""){
                    unset($formData['end']);
                }
                $formData['status'] = 1;
                $valid = $level_model->validator($formData);
                
                if($valid['status']) {
                    $conditions = "user_id=".$formData['user_id'];
                    $level_model->editRecordsWhere($conditions,['status'=>0]);
                    if($level_model->addRecord($formData))
                        header("Location: ".vendor_app_util::url(["ctl"=>"user_level_salaries"]));
                    else {
                        $this->errors = ['database'=>'An error occurred when inserting data! '. $level_model->errors['message']];
                        $this->record = $formData;
                    }
                } else {
                    $this->errors = $level_model::convertErrorMessage($valid['message']);
                    $this->record = $formData;
                }
            }
        }
        $um = new user_model();
		$this->users = $um->getAllRecords('id, firstname, lastname', ['conditions'=>'role!=1']);
		$this->display();
    }
    public function edit($id){
        $level_model = user_level_salary_model::getInstance();
        $oldData = $level_model->getRecord($id);
        if(isset($_POST['btn_submit'])) {
            $formData = $_POST['user_level_salary'];
            if($formData['start']==""){
                unset($formData['start']);
            }
            if($formData['end']==""){
                unset($formData['end']);
            }
            $formData['status'] = 1;
            $formData['user_id'] = $oldData['user_id'];
            $valid = $level_model->validator($formData);

			if($valid['status']) {
                $data = $level_model->editRecordsWhere("id=".$id,['status'=>0]);
				if($level_model->addRecord($formData))
					header("Location: ".vendor_app_util::url(["ctl"=>"user_level_salaries"]));
				else {
					$this->errors = ['database'=>'An error occurred when editting data! '. $level_model->errors['message']];
					$this->record = $formData;
				}
			} else {
				$this->errors = $level_model::convertErrorMessage($valid['message']);
				$this->record = $formData;
			}
        }

		$this->record = $level_model->getRecord($id, "*,user_level_salaries.id as id", ['joins'=>['user']]);
        $this->display();
    }

    public function del($id){
        $level_model = user_level_salary_model::getInstance();
		if($level_model->delRelativeRecord($id)) echo "Delete Successful";
		else echo "error";
    }

    public function delmany() {
        global $app;
		$ids = $app['prs']['ids'];
        $level_model = user_level_salary_model::getInstance();
		if($level_model->delRelativeRecords($ids)) echo "Delete many successful";
		else echo "error";
	}
}