<?php
$timeout_duration = 10;
if (isset($_GET['act']) && !empty($_GET['act']) && $_GET['act'] == 'set') {
	$username = $_GET['username'];
	$key = $_GET['key'];
	session_start();
	$_SESSION['username'] = $username;
	$_SESSION['key'] = $key;
	$_SESSION['LAST_ACTIVITY'] = time();
}else {
	if (time() - $_SESSION['LAST_ACTIVITY'] > $timeout_duration) {
		session_destroy();
		$status = 401;
	}
	else{
		$_SESSION['LAST_ACTIVITY'] = time();
		$status = 200;
	}
	$result = array(
		"status" => $status,
		);
	$json_response = json_encode($result);
	echo $json_response;
}
?>
