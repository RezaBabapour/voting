<?php
session_start();
//$_SESSION['token'] = "";
function loggedin($token)
{
	$url = "http://$_SERVER[HTTP_HOST]".":8080/authenticate.php?";
	$url = $url.'&token='.$token;
	$curl = curl_init();
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => $url
			));
	$resp = curl_exec($curl);
	curl_close($curl);
	$r = (json_decode($resp, true));
	//print_r($r);
	if ($r['status'] == 200) {
		$_SESSION['token'] = $r['token'];
		return 1;
	}
	elseif ($r['status'] == 401) {
		session_unset();
		session_destroy();
		return 0;
	}
}
?>