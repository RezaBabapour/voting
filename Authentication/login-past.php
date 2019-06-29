<?php
require_once 'connect.inc.php';
function setSession($username, $key)
{
	$addr = $_SERVER['HTTP_HOST'];
	$url = "http://$addr/authenticate.php?username=$username&key=$key&act=set";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_exec($ch);
	if(curl_errno($ch)){
	    throw new Exception(curl_error($ch));
	}
	curl_close($ch);
}

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
		$key = $status;
	}elseif ($rows[0]['PASSWORD'] != $password) {
		$status = 401;
		$key = $status;
	}

	if ($status == 200) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    	$charactersLength = strlen($characters);
    	$key = '';
    	for ($i = 0; $i < 30; $i++) {
       		$key .= $characters[rand(0, $charactersLength - 1)];
    	}
    	setSession($username, $key);
	}

	$result = array(
		"status" => $status,
		"key" => $key
		);
	$json_response = json_encode($result);
	echo $json_response;

 }
?>
