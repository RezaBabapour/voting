<?php
require_once 'common.inc.php';
$token = $_SESSION['token'];
if (!loggedin($token)) {
	header('Location: index.php');
}
$name = $_SESSION['name'];
$url = "http://$_SERVER[HTTP_HOST]:83/portal.read.php?token=$token";
$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_RETURNTRANSFER => 1,
	CURLOPT_URL => $url
));
$resp = curl_exec($curl);
curl_close($curl);
$r = (json_decode($resp, true));
if (isset($_GET) && !empty($_GET)) {
	$value = $_GET['radio'];
	$url = "http://$_SERVER[HTTP_HOST]:83/portal.write.php?name=$name&vote=$value&token=$token";
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $url
	));
	$resp = curl_exec($curl);
	curl_close($curl);
	$d = (json_decode($resp, true));
	echo "status : ".$d['status']."<br>";
	echo "message : ".$d['msg'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Voting</title>
	<link rel="stylesheet" type="text/css" href="../css/common.css">
</head>
<body>
	<?php
		echo '<form method="GET">';
		for ($i=0; $i < count($r); $i++) {
				echo "<fieldset>";
					echo "<legend align=center>".$r[$i]['name']."</legend>";
					echo '<input type="radio" name="radio" value="1">'.'First Candidate : '.$r[$i]['a']."<br>";
					echo '<input type="radio" name="radio" value="2">'.'Second Candidate : '.$r[$i]['b']."<br>";
					echo '<input type="radio" name="radio" value="3">'.'Third Candidate : '.$r[$i]['c']."<br>";
					echo '<input type="radio" name="radio" value="4">'.'Fourth Candidate : '.$r[$i]['d']."<br>";
				echo "</fieldset>";
			
		}
		echo '<br><input type="submit" value="Submit Vote">';
		echo "</form>";
	?>
</body>
</html>