<?php
class check_logtime_controller extends vendor_auth_controller
{
	
	public function add() {
        global $app;
		$cl = new check_logtime_model();
		$rm = new report_model();
		$time = strtotime(date('H:i:s'));
		$daysOff = vendor_app_util::daysOff();

		$this->none = true;


        if( in_array(date("Y-m-d"),$daysOff) ||($time > strtotime(date('17:30:00')) || $time < strtotime(date('06:30:00'))) ){
			$this->none = true;
        }else{
			// <3
			if(isset($_POST['btn_submit'])) {
				$check_logtime = $_POST['check_logtime'];
				$check_logtime["lever_time"]=0;
				$check_logtime["user_id"]= $_SESSION['user']['id'];
				
				if( ($time > strtotime(date('08:06:00')) && $time <= strtotime(date('08:15:59'))) ||   ($time > strtotime(date('13:36:00')) && $time <= strtotime(date('13:45:59')))){
					$check_logtime["lever_time"]=1;
				}else if( ($time > strtotime(date('08:16:00')) && $time <= strtotime(date('08:30:59'))) ||  ($time > strtotime(date('13:46:00')) && $time <= strtotime(date('14:00:59'))) ){
					$check_logtime["lever_time"]=2;
				}else if( ($time > strtotime(date('08:31:00')) && $time <= strtotime(date('12:00:00'))) ||  ($time > strtotime(date('14:01:00')) && $time <= strtotime(date('17:30:00'))) ){
					$check_logtime["lever_time"]=3;
				}

				if($time < strtotime(date('12:00:00')) ){
					$report['work_time'] = round(( strtotime('12:00:00') - strtotime(date('H:i:00')) ) / 3600,2);
					$report['time_end'] = date('Y-m-d 12:00:00');
				}else if($time > strtotime(date('12:00:00')) ){
					$report['work_time'] = round(( strtotime('17:30:00') - strtotime(date('H:i:00')) ) / 3600,2);
					$report['time_end'] = date('Y-m-d 17:30:00');
				}
					
				$report['user_id'] = $_SESSION['user']['id'];
				$report['time_start'] = date('Y-m-d H:i:s');
				$report['date_report'] = date('Y-m-d');
				$report['group_id'] = 1;
				$report['status'] = 'ip';
				$report['notes'] = '';
				$report['job'] = $_POST['check_logtime']['note'];

				$rm->addRecord($report);
				$cl->addRecord($check_logtime);


				header( "Location: ".vendor_app_util::url(array('ctl'=>'check_logtime', 'act'=>'add')));
			}
			$this->none = false;
			$conditions="";
			if($time < strtotime(date('12:01:00')) ){
				$conditions = 'user_id = '.$_SESSION['user']['id'].' AND date(created) = "'.date('Y-m-d').
					'" AND DATE_FORMAT(created, "%H:%i:%s") > "07:00:00 "  AND DATE_FORMAT(created, "%H:%i:%s") < "12:00:00 "  '  ;
			}else{
				$conditions = 'user_id =  '.$_SESSION['user']['id'].' AND date(created) = "'.date('Y-m-d').
					'" AND DATE_FORMAT(created, "%H:%i:%s") > "12:00:00 "  AND DATE_FORMAT(created, "%H:%i:%s") < "17:30:00 "  '  ;
	
			}
			$this->time ="";
			if( $this->record = $cl->getRecord1($conditions) ){
				$this->time = new DateTime($this->record['created']);
				$this->time = $this->time->format('H:i');
			}
	
		}
		
		$this->display();
	}

	public function post_add()
	{

	}

	
}