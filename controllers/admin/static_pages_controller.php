<?php
class static_pages_controller extends vendor_backend_controller
{
	public function index() 
	{
        $im = new static_page_model();
		$this->records = $im->allp('*',['order'=>'id ASC']);
		$this->display();
    } 
    
	public function add() {
		$stm = static_page_model::getInstance();
		if(isset($_POST['static_page'])) {
			$static_pageData = $_POST['static_page'];
			$valid = $stm->validator($static_pageData);
			if($valid['status']){
				if($stm->addRecord($static_pageData)) {
					header("Location: ".vendor_app_util::url(["ctl"=>"static_pages"]));
				} else {
					$this->errors = ['database'=>'An error occurred when inserting data!'];
					$this->record = $static_pageData;
				}
			} else {
				$this->errors = $stm::convertErrorMessage($valid['message']);
				$this->record = $static_pageData;
			}
		}
		$this->display();
	} 

	public function edit($id) {
		$stm = new static_page_model();
		$this->record = $stm->getRecord($id);
		$this->id = $id;
		if(isset($_POST['static_page'])) {
			$static_pageData = $_POST['static_page'];
			$valid = $stm->validator($static_pageData, $id);
			if($valid['status']){
				if($stm->editRecord($id, $static_pageData)) {
					header("Location: ".vendor_app_util::url(["ctl"=>"static_pages"]));
				} else {
					$this->errors = ['database'=>'An error occurred when inserting data!'];
					$this->record = $static_pageData;
				}
			} else {
				$this->errors = $stm::convertErrorMessage($valid['message']);
				$this->record = $static_pageData;
			}
		}
		$this->display();
	} 

	public function static_pages_add_ajax() 
	{
		$im = new static_page_model();
		$static_pageData = [
			'title' => $_POST['title'],
			'title_slug' => $_POST['title_slug'],
			'content' => $_POST['content']
		];

		$valid = $im->validator($static_pageData);
		if($valid['status']){
			if($im->addRecord($static_pageData)){
				$data = [
					'status' => true,
					'data' => 'successfully'
				];
				http_response_code(200);
				echo json_encode($data);
			}
			else {
				$data = [
					'status' => false,
					'data' => 'error'
				];
				http_response_code(500);
				echo json_encode($data);
			}
		} else {
			$this->errors = $im::convertErrorMessage($valid['message']);
			$data = [
				'status' => false,
				'data' => $this->errors
			];
			http_response_code(500);
			echo json_encode($data);
		}
	} 

	public function del($id) {
		$im = new static_page_model();
		if($im->delRecord($id)) {
			header( "Location: ".vendor_app_util::url(array('ctl'=>'static_pages')));
		} else {
			$this->errors = ['message'=>'Can not delete data!'];
		}
	}
}
?>
