<?php
session_start();
$app['ctl'] = "home";
$prs = [];

if(isset($_GET["pr"])) {
	$prs = explode("/",$_GET["pr"]);
}

$noPrs = count($prs);
if($noPrs) {
	// Check if admin area
	//if(isset($prs[0]) && $prs[0]=="admin") {
	if($prs[0]=="admin") {
		$app['area'] = 'admin';
		$app['areaPath'] = 'admin/';
		array_shift($prs);
		$noPrs--;
	} else if($prs[0]=="api"){
		$app['area'] = $prs[0];
		$app['areaPath'] = $prs[0].'/';
		array_shift($prs);
		$noPrs--;
	}
	$app['ctl'] = $prs[0];	
	$app['prs'] = [];
	//if(isset($prs[0])) $app['ctl'] = $prs[0];
	if(isset($prs[1])) {
		if(strpos($prs[1],"=") === false) {
			$app['act'] = $prs[1];
		} else {
			$kv = explode("=",$prs[1]);
			$app['prs'][$kv[0]] = $kv[1];
		}
	}
	if($noPrs>2) {
		for($i=2; $i<$noPrs; $i++) {
			if(strpos($prs[$i],"=") !== false) {
				$kv = explode("=",$prs[$i]);
				$app['prs'][$kv[0]] = $kv[1];
			} else {
				$app['prs'][$i-1] = $prs[$i];
			}
		}
	}
}

$c = $app['ctl']."_controller";

if(!is_file(ControllerREL.$app['areaPath'].$c.".php")) {
	$c = "staticpages_controller";
	$app['ctl'] = "staticpages";	
	$app['act'] = "error";
}

$controller = new $c();
?>