<?php
require_once 'connect.inc.php';
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;

if (isset($_GET['username']) && !empty($_GET['username'])) {
	$username = $_GET['username'];
 	$password = $_GET['password'];
 	$_GET['username'] = '';
 	$_GET['password'] = '';
 	$status=404;
 	$query="SELECT PASSWORD FROM `user` WHERE name = '$username'";
	$result = mysqli_query($link,$query);
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
	}
	mysqli_free_result($result);
	mysqli_close($link);
	if($rows[0]['PASSWORD'] == $password) {
		$status = 200;
	}elseif ($rows[0]['PASSWORD'] == NULL) {
		$status = 404;
		$token = $status;
	}elseif ($rows[0]['PASSWORD'] != $password) {
		$status = 401;
		$token = $status;
	}

	if ($status == 200) {
		$key = "example_key";
		$iat = time();	//Issued at
		$exp = $iat + 200;	//Expiration Time
		$token = array(
    		"iat" => $iat,
    		"exp" => $exp
		);
		$token = JWT::encode($token, $key);
	}
	$result = array(
		"status" => $status,
		"token" => $token
		);
	$json_response = json_encode($result);
	echo $json_response;
}

?>