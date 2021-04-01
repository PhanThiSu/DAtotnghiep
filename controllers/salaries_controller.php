<?php
class salaries_controller extends vendor_auth_controller
{
	protected 	$errors = false;

	public function index() {
        global $app;
		$user_level_salary = user_level_salary_model::getInstance();
		
		//basic_salary
		$user_id = $_SESSION['user']['id'];
		$recordSalary = $user_level_salary->getRecordUserId($user_id);

		// worked time
		$rpm = new report_model();
		$startMonth = date('y-m').'-01 00:00:00';
		$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
		$conditions = $rpm->getTableName().'.user_id='.$user_id;
		$conditions .= ' AND (time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'" AND  reports.user_id = "'.$user_id.'")';
		$timeTotalMonth = $rpm->getTotal('work_time', $conditions);
		//time re
		$this->year = date('Y');
		$this->month = date('n');
		$january = date("Y-m", mktime(0,0,0,1,1,$this->year));
        $this_month = date("Y-m", mktime(0,0,0,$this->month,1,$this->year));
        $endMonth 	= date("Y-m-t", strtotime($this_month))." 23:59:59";

        //count satudays from January to the end of month
        $sumSaturdays = vendor_app_util::countSatudays($january,$endMonth);
        //count satudays of month
        $sumSaturdaysOfMonth = vendor_app_util::countSatudays($this_month,$endMonth);
        //number of saturday working
        $workingSaturdays = $this->calWorkingSaturdays($sumSaturdays, $sumSaturdaysOfMonth); 
        //WorkingDays when Saturday and Sunday off
        $workingDays = vendor_app_util::countWorkingDays($this->year, $this->month, array(0,6)); //0 is sunday, 6 is satudays
        //TimeRequired of this Month
		$this->vur_timeRequired = ($workingDays + $workingSaturdays)*8;
		
		$this->salary = (float) $timeTotalMonth * $recordSalary['basic_salary'] / $this->vur_timeRequired;
		
		$this->display();
	}

	public function currentMonth() {
		global $app;
		$user_level_salary = user_level_salary_model::getInstance();
		
		//basic_salary
		$user_id = $_SESSION['user']['id'];
		$recordSalary = $user_level_salary->getRecordUserId($user_id);

		// worked time
		$rpm = new report_model();
		$startMonth = date('y-m').'-01 00:00:00';
		$endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
		$conditions = $rpm->getTableName().'.user_id='.$user_id;
		$conditions .= ' AND (time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'" AND  reports.user_id = "'.$user_id.'")';
		$timeTotalMonth = $rpm->getTotal('work_time', $conditions);
		//time re
		$this->year = date('Y');
		$this->month = date('n');
		$january = date("Y-m", mktime(0,0,0,1,1,$this->year));
        $this_month = date("Y-m", mktime(0,0,0,$this->month,1,$this->year));
        $endMonth 	= date("Y-m-t", strtotime($this_month))." 23:59:59";
        //count satudays from January to the end of month
		$sumSaturdays = vendor_app_util::countSatudays($january,$endMonth);
        //count satudays of month
        $sumSaturdaysOfMonth = vendor_app_util::countSatudays($this_month,$endMonth);
		//number of saturday working
        $workingSaturdays = $this->calWorkingSaturdays($sumSaturdays, $sumSaturdaysOfMonth); 
        //WorkingDays when Saturday and Sunday off
        $workingDays = vendor_app_util::countWorkingDays($this->year, $this->month, array(0,6)); //0 is sunday, 6 is satudays
		//TimeRequired of this Month
		$this->vur_timeRequired = ($workingDays + $workingSaturdays)*8;
		$this->salary = (float) $timeTotalMonth * $recordSalary['basic_salary'] / $this->vur_timeRequired;
		
		$this->display();
	}

	//time Required
	public function calWorkingSaturdays($sumSaturdays, $sumSaturdaysOfMonth){
        global $app;
        //number of working saturday
        $workingSaturdays = 2; 
        if($app['first_saturday']=='on' && $sumSaturdays%2!=0 && $sumSaturdaysOfMonth==5){
            $workingSaturdays = 3;
        }
        if($app['first_saturday']=='off' && $sumSaturdays%2==0 && $sumSaturdaysOfMonth==5){
            $workingSaturdays = 3;
        }
        return $workingSaturdays;
    }

	public function months() {
        global $app;
        $month_salary_model = user_month_salary_model::getInstance();
		$this->year = isset($_POST['year']) ? $_POST['year'] : date('Y');
		
		$this->quarter = isset($_POST['quarter']) ? $_POST['quarter'] : '0';
		$a = 0;
		$b =12;
		if(isset($_POST['quarter']) && $this->year != 0){
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
		$conditions = "year=".$this->year." AND ".$tableName.".user_id =".$_SESSION['user']['id'];
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

		$this->display();
	}


	public function years() {
        global $app;
        $month_salary_model = user_month_salary_model::getInstance();

		$tableName = $month_salary_model->getTableName();
		$fields = "Select SUM(salary) as total";
		for ($i=date('Y'); $i > 2018; $i--) { 
			// $fields .= ", SUM(CASE WHEN month(time_start)=".($i+1)." THEN work_time ELSE 0 END) AS ".$app['months'][$i];
			$fields .= ", SUM(CASE WHEN user_month_settings.year=".($i)." THEN salary ELSE 0 END) AS ".$i."year";
		}
		
		$sql = $fields."  FROM user_month_salaries LEFT JOIN user_month_settings ON user_month_salaries.user_month_setting_id=user_month_settings.id Where user_month_salaries.user_id =".$_SESSION['user']['id'];
		$this->record = $month_salary_model->getSalariesInYear($sql);
		$this->display();
	}


}
?>