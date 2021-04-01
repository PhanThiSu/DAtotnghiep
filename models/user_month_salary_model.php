<?php 
class user_month_salary_model extends vendor_frap_model
{
	public $nopp = 20;
    protected $relationships = [
		'belongTo'	=>	[
			['user','key'=>'user_id'],
			['user_month_setting','key'=>'user_month_setting_id']	
		]
	];

	//salaries_controller
	public function getSalariesInYear($sql) {
		global $app;
		$result = $this->con->query($sql);

		return $record=$result->fetch_assoc();
	}

		//fund_salaries_controller
		public function getSalariesYear($option) {
			global $app;
			$startYear = $option.'0';
			$endYear = $option.'9';
			$tableName = $this->getTableName();
			$fields = " Select SUM(CASE WHEN user_month_settings.year >=".($startYear)." and user_month_settings.year <=".$endYear." THEN salary ELSE 0 END)  as total";
			for ($i=0; $i < 10; $i++) { 
				// $fields .= ", SUM(CASE WHEN month(time_start)=".($i+1)." THEN work_time ELSE 0 END) AS ".$app['months'][$i];
				$fields .= ", SUM(CASE WHEN user_month_settings.year =".($option.$i)." THEN salary ELSE 0 END) AS ".($option.$i)."year";
			}

			$sql = $fields." from ".$tableName." LEFT JOIN user_month_settings ON ".$tableName.".user_month_setting_id=user_month_settings.id ";
			$result = $this->con->query($sql);

			return $record=$result->fetch_assoc();

		}

}