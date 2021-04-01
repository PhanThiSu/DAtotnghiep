<?php
date_default_timezone_set('Asia/Ho_Chi_Minh'); // lấy thời gian VNam

// Config global constant variable

$domain = $_SERVER["SERVER_NAME"];
if($_SERVER["SERVER_PORT"] != 80)
	$domain .= ":".$_SERVER["SERVER_PORT"];
	
$relRoot = dirname($_SERVER['SCRIPT_NAME']);
//$relRoot = "/";
if(substr($relRoot, -1) != "/") $relRoot .= "/"; 
define('RootURL', 'http://'.$domain.$relRoot);
define('RootABS', 'http://'.$domain.$relRoot);
define('RootREL', $relRoot);
define('UploadREL', 'media/upload/');
define('UploadURI', $relRoot.UploadREL);
define('RootURI', dirname($_SERVER['SCRIPT_FILENAME'])."/");
//define('RootURI', '/home1/softdev/public_html/pacificsoftdev.com/pscd/');

define('ControllerREL', 'controllers/');
define('AdminPath', 'admin');
define('ControllerAdminREL', ControllerREL."/".AdminPath);

define('AdminEmail', 'phanthisu99@gmail.com'); 
define('UserEmail', 'phanthisu99@gmail.com');
define('PassEmail', 'fybrsuuwurtwuwsv'); 

// Global variables
$app = [];
$app['area'] = 'users';
$app['areaPath'] = '';

$app['roles'] = [
	'1'=>'admin',
	'2'=>'leader',
	'3'=>'user'
];

$app['recordTime'] = [
	'created'	=>	'created',
	'updated'	=>	'updated'
];

$app['reportStatus'] = [
    'ip' => "Trong giai đoạn",
    't'  => "Kiểm tra",
    'd' => "Đã hoàn thành",
    'f'  => "Thất bại"
];

$app['months'] = [
	'January',
	'February',
	'March',
	'April',
	'May',
	'June',
	'July',
	'August',
	'September',
	'October',
	'November',
	'December',
];

$app['weekdays'] = [
	'Monday',
	'Tuesday',
	'Wednesday',
	'Thursday',
	'Friday',
	'Saturday',
	'Sunday'
];

$app['enableUserAssignGroup'] = false;
$app['first_saturday'] = 'on';
// $app['first_saturday'] = 'off';

include_once(__DIR__.'/database.php');
//require_once __DIR__.'/config/main.php';
?>