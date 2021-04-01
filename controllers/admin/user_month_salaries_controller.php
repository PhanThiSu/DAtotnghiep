<?php
class user_month_salaries_controller extends vendor_backend_controller
{
    public function index()
    {
        global $app;
        $month_setting_model = user_month_setting_model::getInstance();

        $year = (isset($_POST['year'])) ? $_POST['year'] : date('Y');
        $this->year = $year;
        $list_month_in_year = $month_setting_model->getAllRecords("DISTINCT month", ['conditions' => "year=" . $year, 'order' => 'month']);
        $this->list_month_payed = [];
        foreach ($list_month_in_year as $key => $value) {
            array_push($this->list_month_payed, intval($value['month']));
        }
        $this->display();
    }
    public function view()
    {
        $month_salary_model = new user_month_salary_model();
        $this->month = isset($_GET['month']) ? $_GET['month'] : date('n');
        $this->year = isset($_GET['year']) ? $_GET['year'] : date('Y');
        $conditions1 = "user_month_settings.year=" . $this->year . " AND user_month_settings.month=" . $this->month. " AND user_month_settings.status=1 ";
        $conditions2 = "user_month_settings.year=" . $this->year . " AND user_month_settings.month=" . $this->month. " AND user_month_settings.status=1 AND user_month_salaries.status=1";
        $countNotStatus = $month_salary_model->getCountRecords(['conditions' => $conditions1,'joins'=>['user_month_setting']]);
        $countHaveStatus = $month_salary_model->getCountRecords(['conditions' => $conditions2,'joins'=>['user_month_setting']]);
        $this->isPaidAll = false;
        
        // exit();
        if($countNotStatus != 0 && $countNotStatus == $countHaveStatus){
            $this->isPaidAll = true;
        }
        
        $users = $this->getDataUserMonthSalary($this->month,$this->year);


        $this->records = $users;
        $this->display();
    }

    public function getDataUserMonthSalary($month,$year){
        $this->month = $month;
        $this->year = $year;
        global $app;
        $month_salary_model = user_month_salary_model::getInstance();
        $user_model = new user_model();
        $level_salary_model = new user_level_salary_model();
        $report_model = new report_model();
        $check_logtime_model = new check_logtime_model();
        $coefficientOT_model = new coefficientOT_model();
        $user_month_setting_model = new user_month_setting_model();

        if($this->month<10) $yearMonth = $this->year."-0".$this->month;
        else $yearMonth = $this->year."-".$this->month;
        $count = vendor_app_util::countDaysOffOfMonth($yearMonth);
        $time_required = (date('t') - $count)*8;
        $conditions="";
        $conditions .= 'month = '.$month.' AND year='.$year;
        if($user_month_setting = $user_month_setting_model->getRecord1($conditions," * ")){
            $time_required = $user_month_setting['time_required'];
        }
        $this->time_required = $time_required;
        $this_month = date("Y-m", mktime(0,0,0,intval($this->month),1,intval($this->year)));
		$startMonth = $this_month.'-01 00:00:00';
        $endMonth 	= date("Y-m-t", strtotime($startMonth))." 23:59:59";
        
        $conditions = "";
        $rolesFlip = array_flip($app['roles']);
        $conditions .= "user_month_settings.year=" . $this->year . " AND user_month_settings.month=" . $this->month. " AND user_month_settings.status=1";
        $salaries = $month_salary_model->getAllRecords(" user_month_salaries.id as id, user_month_salaries.basic_salary as basic_salary ,user_month_salaries.status as status_payment,bonus,salary,user_id,bonus_description", ['conditions' => $conditions,'joins'=>['user_month_setting']]);
        $level_salaries = $level_salary_model->getAllRecords("*",['conditions'=>'status=1']);
        $users = $user_model->allp("*", ['conditions' => 'users.role!=' . $rolesFlip["admin"], "order" => "id ASC"]);
        
        // exit(json_encode($level_salaries));
        // $daysOff = vendor_app_util::daysOff();
        // exit(json_encode($daysOff));
        // $conditionsDaysOff = ' ';
        // foreach($daysOff as $value){
        //     $conditionsDaysOff.= ' AND date(time_start)!="'.$value.'"';
        // }
        $conditions ="";
        $conditions .= 'month(time_start) = '.$month.' AND year(time_start)='.$year;
        $conditions .=	' AND users.role!=1 AND users.status != 0 AND reports.checkOT is null';
        $reportVP = $report_model->getAllRecords('reports.user_id, SUM(work_time) as total',[
                'conditions'=>$conditions, 
                'group'=>'reports.user_id',
                'order'=>'reports.user_id',
                'joins'=>['user']
        ]);
       
        $conditions ="";
        $conditions .= 'month(time_start) = '.$month.' AND year(time_start)='.$year;
        // $conditions .=	' AND users.role!=1 AND users.status != 0 AND ( DATE_FORMAT(time_start, "%H:%i:%s") > "17:30:00"  '.$conditionsDaysOff.' )';
        $conditions .=	' AND users.role!=1 AND users.status != 0 AND reports.checkOT="1"';
        $reportOT = $report_model->getAllRecords('reports.user_id, SUM(work_time) as total',[
                'conditions'=>$conditions, 
                'group'=>'reports.user_id',
                'order'=>'reports.user_id',
                'joins'=>['user']
        ]);


        
        // $conditionsDaysOff = ' ';
        // foreach($daysOff as $value){
        //     $conditionsDaysOff.= ' OR date(time_start)="'.$value.'"';
        // }
        $conditions ="";
        $conditions .= 'month(time_start) = '.$month.' AND year(time_start)='.$year;
        // $conditions .=	' AND users.role!=1 AND users.status != 0 AND ( weekday(time_start) IN(6)'.$conditionsDaysOff.' )';
        $conditions .=	' AND users.role!=1 AND users.status != 0 AND reports.checkOT="2"';
        $reportOTNN = $report_model->getAllRecords('reports.user_id, SUM(work_time) as total',[
                'conditions'=>$conditions, 
                'group'=>'reports.user_id',
                'order'=>'reports.user_id',
                'joins'=>['user']
            ]);

        $conditions =" status = 1";
        $fields = "user_id ,count(CASE WHEN lever_time =0 THEN 1 END) as lvTime1, count(CASE WHEN lever_time =1 THEN 1 END) AS lvTime2, count(CASE WHEN lever_time=2 THEN 1 END) AS lvTime3, count(CASE WHEN lever_time=3 THEN 1 END) AS lvTime4";
        $check_logtime =$check_logtime_model->getAllRecords($fields,[
            'conditions'=>$conditions, 
            'group'=>'check_logtime.user_id',
            'order'=>'check_logtime.user_id',
        ]);

        $conditions = "";
        $conditions = " month(date) = ".$month." AND year(date) = ".$year;;
        $coefficientOT = $coefficientOT_model->getAllRecords(" * ",[
            'conditions'=>$conditions
        ]);

        foreach ($users['data'] as $key => $user) {
            $reportConditions = ""; 
            $reportConditions .= '(time_start >= "'.$startMonth.'" AND time_start <= "'.$endMonth.'" AND  reports.user_id = "'.$user['id'].'")';
            if($total = $report_model->getTotal('work_time', $reportConditions)) { 
                $users['data'][$key]['work_time'] = number_format($total,1);
            } else {
                $users['data'][$key]['work_time'] = 0;
            }


             if ($user_salaries = $this->addMonthSalaryToUser($salaries, $user)) {
                $users['data'][$key]['salary'] = $user_salaries['salary'];
                $users['data'][$key]['bonus'] = $user_salaries['bonus'];
                $users['data'][$key]['bonus_description'] = $user_salaries['bonus_description'];
                $users['data'][$key]['status_payment'] = $user_salaries['status_payment'];
                $users['data'][$key]['user_month_salary_id'] = $user_salaries['id'];
                $users['data'][$key]['user_month_settings_id'] = isset($user_salaries['user_month_settings_id']);
                $users['data'][$key]['basic_salary'] = $user_salaries['basic_salary'];
            } else {
                $users['data'][$key]['salary'] = "0";
                $users['data'][$key]['bonus'] = "0";
                $users['data'][$key]['bonus_description'] = "";
                $users['data'][$key]['status_payment'] = 0;
                $users['data'][$key]['user_month_salary_id'] = null;

                $user_basic_salaries = $this->addBasicSalaryToUser($level_salaries,$user);
                $users['data'][$key]['basic_salary'] = $user_basic_salaries['basic_salary'] ? $user_basic_salaries['basic_salary'] : 0;
            }
           
            // if($user_basic_salaries = $this->addBasicSalaryToUser($level_salaries,$user)){
            //     $users['data'][$key]['basic_salary'] = $user_basic_salaries['basic_salary'];
            // }else {
            //     $users['data'][$key]['basic_salary'] = 0;
            // }

            if($user_basic_salaries = $this->addWorkTimeOtToUser($reportOT,$user)){
                $users['data'][$key]['timeOT'] = number_format($user_basic_salaries['total'],1);
            }else {
                $users['data'][$key]['timeOT'] = "0";
            }

            if($user_basic_salaries = $this->addWorkTimeOtNnToUser($reportOTNN,$user)){
                $users['data'][$key]['timeOTNN'] = number_format($user_basic_salaries['total'],1);
            }else {
                $users['data'][$key]['timeOTNN'] = "0";
            }

            if($user_check_logtime= $this->addLeverCheckTimeToUser($check_logtime,$user)){
                $users['data'][$key]['lvTime1'] = $user_check_logtime['lvTime1'];
                $users['data'][$key]['lvTime2'] = $user_check_logtime['lvTime2'];
                $users['data'][$key]['lvTime3'] = $user_check_logtime['lvTime3'];
                $users['data'][$key]['lvTime4'] = $user_check_logtime['lvTime4'];
            }else {
                $users['data'][$key]['lvTime1'] = 0;
                $users['data'][$key]['lvTime2'] = 0;
                $users['data'][$key]['lvTime3'] = 0;
                $users['data'][$key]['lvTime4'] = 0;
            }
            
            if($user_basic_salaries = $this->addWorkTimeOtNnToUser($coefficientOT,$user)){
                $users['data'][$key]['coefficientOT'] = $user_basic_salaries['coefficient'];
            }else {
                $users['data'][$key]['coefficientOT'] = "1";
            }

            $users['data'][$key]['work_time_Basic']=number_format($users['data'][$key]['work_time']-$users['data'][$key]['timeOT']-$users['data'][$key]['timeOTNN'],1);
            $users['data'][$key]['salaryOT']=round($users['data'][$key]['coefficientOT']*75000*($users['data'][$key]['timeOT']+$users['data'][$key]['timeOTNN']*2),-3);
            $users['data'][$key]['checkTime']= round($users['data'][$key]['lvTime2']*50000 + $users['data'][$key]['lvTime3']*100000 +
                     $users['data'][$key]['lvTime4'] * ($users['data'][$key]['basic_salary']/$time_required*4),-3);
            
            $users['data'][$key]['lunch']=round($users['data'][$key]['work_time_Basic']*500000/$time_required,-3);
            $users['data'][$key]['salary_VP']= round($users['data'][$key]['work_time_Basic']*$users['data'][$key]['basic_salary'] /$time_required +$users['data'][$key]['lunch'],-3);
            $users['data'][$key]['salaryTotal'] = $users['data'][$key]['salary_VP']+$users['data'][$key]['salaryOT']-$users['data'][$key]['checkTime'];
        }
        return $users;
    }


    public function month_setting()
    {
        global $app;
        $month_setting_model = new user_month_setting_model();
        $month_salary_model = new user_month_salary_model();
        $coefficientOT_model = new coefficientOT_model();

        $this->month = isset($_GET['month']) ? $_GET['month'] : date('n');
        $this->year = isset($_GET['year']) ? $_GET['year'] : date('Y');
        //check month can calculate is current month -1
        $this->is_calculate = false;
        if($this->month == (date('n')-1) && $this->year == date('Y')){
            $this->is_calculate = true;
        }else if($this->month ==12 && $this->year == date('Y') -1 && date('n')=="1"){
            $this->is_calculate = true;
        } 
       
        if(isset($_POST['btn_submit'])){
            $formData = $_POST['data'];
            $month = $formData['month'];
            $year = $formData['year'];
            // if( intval($month) != (date('n')-1) || $year != date('Y')){
            //     header( "Location: ".vendor_app_util::url(['ctl'=>'user_month_salaries','act'=>'month_setting?month='.$month.'&year='.$year]));
            //     exit();
            // }
            $day_off = $formData['day_off'];
            $time_required = $formData['time_required'];
            //update settings
            $set_conditons = "month=".$month." and year=".$year;
            //get data month setting
            $msData = $month_setting_model->getRecordWhere([
                "user_month_settings.month"=>$month,
                "user_month_settings.year"=>$year,
                "status"=>1
            ]);
            
            //del data month settings and salary
            if($msData){
                $month_setting_model->delRecord($msData['id']);
                $month_salary_model->deleteRecordsWhere("user_month_setting_id=".$msData['id']);
            }
            $formData['status'] =1;
            //add month settings
            $id_setting = $month_setting_model->addRecord($formData);
            
            if($id_setting){
                $users = $this->getDataUserMonthSalary($month,$year);
                foreach($users['data'] as $key=>$user){
                    $work_time = floatval($user['work_time']);
                    $basic_salary = floatval($user['basic_salary']);
                    $bonus = floatval($user['bonus']);
                    $time_required = floatval($time_required);

                    $salary =ceil(($work_time*$basic_salary)/$time_required+$bonus);
                    $salaryData['user_id'] = $user['id'];
                    $salaryData['user_month_setting_id'] = $id_setting;
                    $salaryData['bonus'] = $bonus;
                    $salaryData['salary'] = $salary;
                    $salaryData['basic_salary'] = $basic_salary;
                    // $salaryData['status'] = 0;
                    //calculate salary of month
                    $month_salary_model->addRecord($salaryData);

                    $coefficientData['user_id']=$user['id'];
                    $coefficientData['date']=$year."-".$month."-".date('d');
                    $coefficientOT_model->addRecord($coefficientData);
                }
                header( "Location: ".vendor_app_util::url(['ctl'=>'user_month_salaries','act'=>'view?month='.$month.'&year='.$year]));
            }
            
        }
        
        if($this->month<10) $yearMonth = $this->year."-0".$this->month;
        else $yearMonth = $this->year."-".$this->month;
        $count = vendor_app_util::countDaysOffOfMonth($yearMonth);
        $this->record['day_off'] = $count;
        $this->record['time_required'] = (date('t',strtotime($yearMonth)) - $this->record['day_off'])*8;
        $this->display();
    }

    
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

    public function addMonthSalaryToUser($salaries = [], $user)
    {
        foreach ($salaries as $key2 => $value2) {
            if (intval($user['id']) === intval($value2['user_id'])) {
                return $value2;
            }
        }
        return false;
    }

    public function addBasicSalaryToUser($level_salaries = [], $user)
    {
        foreach ($level_salaries as $key2 => $value2) {
            if (intval($user['id']) === intval($value2['user_id'])) {
                return $value2;
            }
        }
        return false;
    }

    public function addWorkTimeOtToUser($level_salaries = [], $user)
    {
        foreach ($level_salaries as $key2 => $value2) {
            if (intval($user['id']) === intval($value2['user_id'])) {
                return $value2;
            }
        }
        return false;
    }
    public function addLeverCheckTimeToUser($level_salaries = [], $user)
    {
        foreach ($level_salaries as $key2 => $value2) {
            if (intval($user['id']) === intval($value2['user_id'])) {
                return $value2;
            }
        }
        return false;
    }

    public function addWorkTimeOtNNToUser($level_salaries = [], $user)
    {
        foreach ($level_salaries as $key2 => $value2) {
            if (intval($user['id']) === intval($value2['user_id'])) {
                return $value2;
            }
        }
        return false;
    }

    public function edit($id){
        $month_setting_model = new user_month_setting_model();
        $month_salary_model = new user_month_salary_model();
        $user_model = new user_model();
        $coefficientOT_model = new coefficientOT_model();
        $msData = $month_salary_model->getRecord($id);
        $stData = $month_setting_model->getRecord($msData['user_month_setting_id']);
    
        
        $this->month = $stData['month'];
        $this->year = $stData['year'];
        $this->fullname = user_model::getFullname($msData['user_id']);
        
        $this->record = $msData;

        if(isset($_POST['btn_submit'])){
            $newBonus = $_POST['data']['bonus'];
            $coefficientOT = $_POST['data']['coefficientOT'];
            $bonus_description = $_POST['data']['bonus_description'];
            $oldBonus = $msData['bonus'];
            $newSalary = $msData['salary']-$oldBonus+$newBonus;

            $editData['bonus'] = $newBonus; 
            $editData['salary'] = $newSalary; 
            $editData['bonus_description'] = $bonus_description; 
            
            // if($month_salary_model->editRecord($id,$editData)){
            //     // header( "Location: ".vendor_app_util::url(['ctl'=>'user_month_salaries','act'=>'view?month='.$this->month.'&year='.$this->year]));
            // }

            $month = $this->month;
            $year = $this->year;
            $user_id = $msData['user_id'];

            $cOT['coefficient']=$coefficientOT;
            
            $conditions=" user_id=".$user_id." AND month(date)=".$month." AND year(date)=".$year ;

            if($coefficientOT_model->editRecordsWhere($conditions,$cOT)){
                header( "Location: ".vendor_app_util::url(['ctl'=>'user_month_salaries','act'=>'view?month='.$this->month.'&year='.$this->year]));
            }

        
        }
        $this->display();
    }
    public function updateAllStatus(){
        $status = $_POST['status'];
        $settings_id = $_POST['settings_id'];
        
        $month_salary_model = new user_month_salary_model();
        // if($check = $month_salary_model->edit)
        $conditions = "user_month_setting_id=".$settings_id;
        if($check = $month_salary_model->editRecordsWhere($conditions,['status'=>$status])){
            $data = [
                'status' => 1,
                'message' => 'Successfully! '
            ];
            http_response_code(200);
            echo json_encode($data); exit();
        }else {
            $data = [
                'status' => 0,
                'message' => 'An error occurred! '
            ];
            http_response_code(200);
            echo json_encode($data); exit();
        }
    }

    public function changestatus(){
        global $app;
        $id = $app['prs'][1];
        $month_salary_model = new user_month_salary_model();
        $status = $_POST['status'];
        $status = ($status==1)?"0":1;
        if($month_salary_model->editRecord($id,['status'=>$status])){
            $data = [
                'status' => 1,
                'message' => 'Successfully! '
            ];
            http_response_code(200);
            echo json_encode($data); exit();
        }
    }
}
