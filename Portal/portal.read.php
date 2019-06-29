<?php
// require_once 'common.inc.php';
// $token = $_GET['token'];
// if (!loggedin($token)) {
// 	header('Location: index.php');
// }

$url = "http://$_SERVER[REMOTE_ADDR]:82/master.read.php?";
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $url
));
$resp = curl_exec($curl);
curl_close($curl);
echo($resp);
?>