<?php
if (isset($_GET['vote']) && !empty($_GET['vote'])) {
	$value = $_GET['vote'];
	$token = $_GET['token'];
	$name = $_GET['name'];
	$url = "http://$_SERVER[REMOTE_ADDR]:82/master.write.php?name=$name&vote=$value&token=$token";
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url
	));
	$resp = curl_exec($curl);
	curl_close($curl);
	echo($resp);	
}

?>