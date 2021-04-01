<?php
class fund_salaries_controller extends vendor_backend_controller
{
	protected 	$errors = false;

	public function index() {
		global $app;
        $month_salary_model = user_month_salary_model::getInstance();
		$this->year = isset($_POST['year']) ? $_POST['year'] : date('Y');
		$this->quarter = isset($_POST['quarter']) ? $_POST['quarter'] : '0';
		$a = 0;
		$b =12;
		if(isset($_POST['quarter'])){
			if($_POST['quarter']==1){
				$a=0; $b=3;
			}else if($_POST['quarter']==2){
				$a=3; $b=6;
			}else if($_POST['quarter']==3){
				$a=6; $b=9;
			}else if($_POST['quarter']==4){
				$a=9; $b=12;
			}

		}

		$tableName = $month_salary_model->getTableName();
        $fields = "SUM(CASE WHEN user_month_settings.month >".($a)." and user_month_settings.month <=".$b." THEN salary ELSE 0 END)  as total";
		for ($i=$a; $i < $b; $i++) { 
			// $fields .= ", SUM(CASE WHEN month(time_start)=".($i+1)." THEN work_time ELSE 0 END) AS ".$app['months'][$i];
			$fields .= ", SUM(CASE WHEN user_month_settings.month=".($i+1)." THEN salary ELSE 0 END) AS ".$app['months'][$i];
        }
        $conditions = "year=".$this->year;
		$this->records = $month_salary_model->allp($fields,[
				'conditions'=>$conditions, 
				'joins'=>['model'=>'user_month_setting', 'type'=>'JOIN', 'joinFields'=>"year"]]);
		$this->record = $this->records['data'][0];
		$this->pointsLabel = [];
		$this->pointsData = [];
		for ($i=$a; $i < $b; $i++) { 
			array_push($this->pointsLabel, $app['months'][$i]);
			array_push($this->pointsData, $this->record[$app['months'][$i]]);
		}

		// return $foo;

		$this->display();
	}

	public function chartsQuarter() {
        global $app;
        $month_salary_model = user_month_salary_model::getInstance();
		$this->year = isset($_POST['year']) ? $_POST['year'] : date('Y');
		$a = 0;
		$b =4;
	
		$tableName = $month_salary_model->getTableName();
        $fields = "SUM(CASE WHEN user_month_settings.month >".($a)." and user_month_settings.month <=12 THEN salary ELSE 0 END)  as total";
		for ($i=$a; $i < $b; $i++) { 
			// $fields .= ", SUM(CASE WHEN month(time_start)=".($i+1)." THEN work_time ELSE 0 END) AS ".$app['months'][$i];
			$fields .= ", SUM(CASE WHEN user_month_settings.month >".($i*3)." and user_month_settings.month <=".($i*3+3)." THEN salary ELSE 0 END) AS "."Quarter_".($i+1);
        }
        $conditions = "year=".$this->year;
		$this->records = $month_salary_model->allp($fields,[
				'conditions'=>$conditions, 
				'joins'=>['model'=>'user_month_setting', 'type'=>'JOIN', 'joinFields'=>"year"]]);
		$this->record = $this->records['data'][0];
		$this->pointsLabel = [];
		$this->pointsData = [];
		for ($i=$a; $i < $b; $i++) { 
			array_push($this->pointsLabel, "Quarter ".($i+1));
			array_push($this->pointsData, $this->record["Quarter_".($i+1)]);
		}

		// return $foo;

		$this->display();
	}

	public function chartsYear() {
        global $app;
        $month_salary_model = user_month_salary_model::getInstance();
		$this->optionYear = isset($_POST['optionYear']) ? $_POST['optionYear'] : 0;
		$this->option = date('Y')/10-$this->optionYear;
		
		$this->record = $month_salary_model->getSalariesYear($this->option);
		$this->pointsLabel = [];
		$this->pointsData = [];
		for ($i=0; $i < 10; $i++) { 
			array_push($this->pointsLabel, $this->option.$i);
			array_push($this->pointsData, $this->record[$this->option.$i."year"]);
		}

		// return $foo;

		$this->display();
	}



	public function listMonth() {
        global $app;
        $month_salary_model = user_month_salary_model::getInstance();
		$this->year = isset($_POST['year']) ? $_POST['year'] : date('Y');
		$this->quarter = isset($_POST['quarter']) ? $_POST['quarter'] : '0';
		$a = 0;
		$b =12;
		if(isset($_POST['quarter'])){
			if($_POST['quarter']==1){
				$a=0; $b=3;
			}else if($_POST['quarter']==2){
				$a=3; $b=6;
			}else if($_POST['quarter']==3){
				$a=6; $b=9;
			}else if($_POST['quarter']==4){
				$a=9; $b=12;
			}

		}

		$tableName = $month_salary_model->getTableName();
        $fields = "SUM(CASE WHEN user_month_settings.month >".($a)." and user_month_settings.month <=".$b." THEN salary ELSE 0 END)  as total";
		for ($i=$a; $i < $b; $i++) { 
			// $fields .= ", SUM(CASE WHEN month(time_start)=".($i+1)." THEN work_time ELSE 0 END) AS ".$app['months'][$i];
			$fields .= ", SUM(CASE WHEN user_month_settings.month=".($i+1)." THEN salary ELSE 0 END) AS ".$app['months'][$i];
        }
        $conditions = "year=".$this->year;
		$this->records = $month_salary_model->allp($fields,[
				'conditions'=>$conditions, 
				'joins'=>['model'=>'user_month_setting', 'type'=>'JOIN', 'joinFields'=>"year"]]);
		$this->record = $this->records['data'][0];

		$this->display();
	}


	public function listQuarter() {
        global $app;
        $month_salary_model = user_month_salary_model::getInstance();
		$this->year = isset($_POST['year']) ? $_POST['year'] : date('Y');
		$a = 0;
		$b =4;
	
		$tableName = $month_salary_model->getTableName();
        $fields = "SUM(CASE WHEN user_month_settings.month >".($a)." and user_month_settings.month <=12 THEN salary ELSE 0 END)  as total";
		for ($i=$a; $i < $b; $i++) { 
			// $fields .= ", SUM(CASE WHEN month(time_start)=".($i+1)." THEN work_time ELSE 0 END) AS ".$app['months'][$i];
			$fields .= ", SUM(CASE WHEN user_month_settings.month >".($i*3)." and user_month_settings.month <=".($i*3+3)." THEN salary ELSE 0 END) AS "."Quarter_".($i+1);
        }
        $conditions = "year=".$this->year;
		$this->records = $month_salary_model->allp($fields,[
				'conditions'=>$conditions, 
				'joins'=>['model'=>'user_month_setting', 'type'=>'JOIN', 'joinFields'=>"year"]]);
		$this->record = $this->records['data'][0];
		$this->pointsLabel = [];
		$this->pointsData = [];
		for ($i=$a; $i < $b; $i++) { 
			array_push($this->pointsLabel, "Quarter ".($i+1));
			array_push($this->pointsData, $this->record["Quarter_".($i+1)]);
		}

		// return $foo;

		$this->display();
	}


	public function listYear() {
        global $app;
        $month_salary_model = user_month_salary_model::getInstance();
		$this->optionYear = isset($_POST['optionYear']) ? $_POST['optionYear'] : 0;
		$this->option = date('Y')/10-$this->optionYear;
		
		$this->record = $month_salary_model->getSalariesYear($this->option);
		$this->pointsLabel = [];
		$this->pointsData = [];
		for ($i=0; $i < 10; $i++) { 
			array_push($this->pointsLabel, $this->option.$i);
			array_push($this->pointsData, $this->record[$this->option.$i."year"]);
		}

		// return $foo;

		$this->display();
	}


}
?>