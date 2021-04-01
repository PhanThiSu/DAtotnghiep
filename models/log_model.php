<?php 
class log_model extends vendor_frap_model
{
    protected $relationships = [
		'belongTo'	=>	['user','key'=>'user_id']
    ];
    
    public static $status = [
        0 => 'Unsuccess',
        1 => 'Success',
    ];

    public static $type = [
        'login'             => ['name'=> 'Login'],
        'logout'            => ['name'=> 'Logout'],
        'add_report'        => ['name'=> 'Add report'],
        'edit_report'       => ['name'=> 'Edit report'],
        'delete_report'     => ['name'=> 'Delete report'],
        'add_request'       => ['name'=> 'Add request'],
        'edit_request'      => ['name'=> 'Edit request'],
        'delete_request'    => ['name'=> 'Delete request'],
        'reset_password'    => ['name'=> 'Reset password'],
        'update_password'   => ['name'=> 'Update password'],
        'edit_profile'      => ['name'=> 'Edit profile'],
    ];

    protected static function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    protected static function getOS() { 
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $os_platform  = "Unknown OS Platform";
        $os_array     = array(
                              '/windows nt 10/i'      =>  'Windows 10',
                              '/windows nt 6.3/i'     =>  'Windows 8.1',
                              '/windows nt 6.2/i'     =>  'Windows 8',
                              '/windows nt 6.1/i'     =>  'Windows 7',
                              '/windows nt 6.0/i'     =>  'Windows Vista',
                              '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                              '/windows nt 5.1/i'     =>  'Windows XP',
                              '/windows xp/i'         =>  'Windows XP',
                              '/windows nt 5.0/i'     =>  'Windows 2000',
                              '/windows me/i'         =>  'Windows ME',
                              '/win98/i'              =>  'Windows 98',
                              '/win95/i'              =>  'Windows 95',
                              '/win16/i'              =>  'Windows 3.11',
                              '/macintosh|mac os x/i' =>  'Mac OS X',
                              '/mac_powerpc/i'        =>  'Mac OS 9',
                              '/linux/i'              =>  'Linux',
                              '/ubuntu/i'             =>  'Ubuntu',
                              '/iphone/i'             =>  'iPhone',
                              '/ipod/i'               =>  'iPod',
                              '/ipad/i'               =>  'iPad',
                              '/android/i'            =>  'Android',
                              '/blackberry/i'         =>  'BlackBerry',
                              '/webos/i'              =>  'Mobile'
                        );
        foreach ($os_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $os_platform = $value;
        return $os_platform;
    }
    protected static function getBrowser() {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser        = "Unknown Browser";
        $browser_array = array(
                                '/msie/i'      => 'Internet Explorer',
                                '/firefox/i'   => 'Firefox',
                                '/safari/i'    => 'Safari',
                                '/chrome/i'    => 'Chrome',
                                '/edge/i'      => 'Edge',
                                '/opera/i'     => 'Opera',
                                '/netscape/i'  => 'Netscape',
                                '/maxthon/i'   => 'Maxthon',
                                '/konqueror/i' => 'Konqueror',
                                '/mobile/i'    => 'Handheld Browser'
                         );
        foreach ($browser_array as $regex => $value)
            if (preg_match($regex, $user_agent))
                $browser = $value;
        return $browser;
    }
    protected static function initLog($event, $status=1, $note="") {
        $user_ip = getenv('REMOTE_ADDR');
        $response = @file_get_contents("http://www.geoplugin.net/php.gp?ip=$user_ip");
        if( isset($response) && $response){
            $geo                    = unserialize($response);
            $country                = $geo["geoplugin_countryName"];
            $city                   = $geo["geoplugin_city"];
            $geoplugin_longitude    = $geo["geoplugin_longitude"];
            $geoplugin_latitude     = $geo["geoplugin_latitude"];
        }else{
            $geo                = "No data";
            $country            = "No data";
            $city               = "No data";
            $geoplugin_longitude= "No data";
            $geoplugin_latitude = "No data";
        }
        $datetime = date('Y-m-d H:i:s', time());

        $log_data = [
            'time'          => $datetime,
            'user_id'  		=> isset($_SESSION['user'])?$_SESSION['user']['id']:0,
            'event'         => $event['name'],
            'status'        => $status,
            'ip' 			=> self::get_client_ip(),
            'location'		=> $city.' '.$country,
            'browser' 	    => self::getBrowser(),
            'os' 	        => self::getOS(),
            'agent'         => json_encode($_SERVER['HTTP_USER_AGENT']),
            'latitude' 		=> $geoplugin_latitude,
            'longitude' 	=> $geoplugin_longitude,
            'note'          => $note,
            // 'note'          => $event['value']."-".$note,
        ];
        return $log_data;
    }

    public static function setLog($event, $status=1, $note=""){
        $log = self::initLog($event, $status, $note);
        (new self)->addRecord($log);
    }

}