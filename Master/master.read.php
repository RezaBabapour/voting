<?php
require_once 'connect.inc.php';
	$query="SELECT name, a, b, c, d FROM `election` WHERE active=1";
	$result = mysqli_query($link,$query);
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
		$rows[] = $r;
	}
	mysqli_free_result($result);
	mysqli_close($link);
	$json_response = json_encode($rows);
	echo $json_response;
	
	
?>