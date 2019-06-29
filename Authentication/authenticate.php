<?php
require __DIR__ . '/vendor/autoload.php';
use \Firebase\JWT\JWT;
$key = "example_key";
$token = '';
$status = 401;
if (isset($_GET['token']) && !empty($_GET['token'])) {
	$jwt = $_GET['token'];
	try {
		$decoded = JWT::decode($jwt, $key, array('HS256'));
	} catch (Exception $e) {

	}
	$decoded_array = (array) $decoded;
	$exp = $decoded_array['exp'];
	$time = $_SERVER['REQUEST_TIME'];
	if ($exp - $time > 0) {
		$status = 200;
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
