<?php
class about_controller extends vendor_main_controller
{
	public function index() {
		$this->display();
	}

	public function sendmail() {
		$sapi_type = php_sapi_name();
		if(substr($sapi_type, 0, 3) == 'cli' || substr($sapi_type, 0, 3) == 'cgi' || empty($_SERVER['REMOTE_ADDR'])) {
			$um = new user_model();
			$today = date('Y-m-d');
			$todayStart = $today.' 08:00:00';
			$todayEnd = $today.' 17:00:00';
			$records_user = $um->getAllRecords(
				'*',
				[ 'conditions' => "users.id NOT IN (SELECT reports.user_id FROM reports WHERE date(reports.time_start) = '".$today."') AND users.id NOT IN ( SELECT requests.user_id FROM requests WHERE requests.datetime_start <= '".$todayStart."' AND requests.datetime_end >= '".$todayEnd."') AND users.role != 1 AND users.status !=0"]
			);
			if(count($records_user)) {
				while($row = $records_user->fetch_assoc()) {
	    			$nTo = 'TPM Admin';
	    			$mTo = $row['email'];
					$title = "You haven't reported yet";
					$href = RootURL."reports/add";
					$content = "
						<h3> Hi ".$row['firstname']." ".$row['lastname']."</h3>
					  	<p>Today you have not reported yet. <br>
					  	Click <a href = ".$href.">".$href."</a> to report.</p>";
					vendor_app_util::sendMail($title, $content, $nTo, $mTo);
		    	}
			} else { 
				echo "error";
			}
		} else {
			echo "webserver";
		}
	}

	
	public function backup(){
		$sapi_type = php_sapi_name();
		if(substr($sapi_type, 0, 3) == 'cli' || substr($sapi_type, 0, 3) == 'cgi' || empty($_SERVER['REMOTE_ADDR'])) {
			$dashboardm = new dashboard_model();
			$dashboardm->backup_zip(["logs","reports","requests"]);
		} else {
			echo "webserver";
		}
	}


	// $sapi_type = php_sapi_name();
	// if(substr($sapi_type, 0, 3) == 'cli' || empty($_SERVER['REMOTE_ADDR'])) {
	// 	$rpm = new report_model();

	// 	$tableName = $rpm->getTableName();
	// 	$fields = $tableName.".user_id";
	// 	$fields .= ", SUM(CASE WHEN date(time_start)='".date("Y-m-d")."' THEN work_time ELSE 0 END) AS d";

	// 	$records = $rpm->getAllRecords($fields,[
	// 			'group'=>$tableName.'.user_id',
	// 			'order'=>$tableName.'.user_id',
	// 			'joins'=>['user'],
	// 			'conditions' => 'users.status != 0'
	// 		]);

	// 	if(count($records)) {
	// 		while($row = $records->fetch_assoc()) {
	// 			if($row['d']==0) {
	// 				$nTo = 'TPM';
	// 				$mTo = $row['users_email'];
	// 				$title = 'New notification';
	// 				$href = RootURL."reports/add";
	// 				$content = "
	// 					<h3> Hi ".$row['users_firstname']." ".$row['users_lastname']."</h3>
	// 					<p>Today you have not report yet. <br>
	// 					Click <a href = ".$href.">".$href."</a> to report.</p>";
	// 				vendor_app_util::sendMail($title, $content, $nTo, $mTo);
	// 			}
	// 		}
	// 	} else { 
	// 		echo "error";
	// 	}
	// } else {
	// 	echo "webserver";
	// }
}
?>
