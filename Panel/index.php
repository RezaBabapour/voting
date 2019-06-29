<?php
require_once 'common.inc.php';
if (loggedin($_SESSION['token'])) {
	header('Location: dashboard.php');
 } elseif (isset($_GET['submit'])) {

 	$addr = $_SERVER['HTTP_HOST'];
	$username = $_GET['userName'];
	$password = $_GET['password'];
	unset($_GET['submit']);
	$url = "http://$addr/login.php?username=$username&password=$password";
	//print($url);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_PORT, 8080);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$resp = curl_exec($ch);
	if(curl_errno($ch)){
	    throw new Exception(curl_error($ch));
	}
	curl_close($ch);
	$r = (json_decode($resp, true));
	if ($r['status'] == '404') {
		echo "<script>document.getElementById('ATN').innerHTML = 'no user exists with entered username';</script>";
	}
	elseif ($r['status'] == '401') {
		echo "<script>document.getElementById('ATN').innerHTML = 'Password entered is not correct';</script>";
	} 
	elseif ($r['status'] == '200') {
		$_SESSION['token'] = $r['token'];
		$_SESSION['name'] = $username;
		header('Location: dashboard.php');
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
	    <title>Voting</title>
	    <link rel="stylesheet" type="text/css" href="../css/common.css">
	</head>
	<body>
		<div class="center" id="intro">
			<p>ورود به سامانه رای گیری</p>
		</div>
		<div class="center" id="loginform">
			<div class="center" id="ATN"></div>
			<form action="" method="GET">
			      <input type="text" name="userName" placeholder="Enter Username" required/><br><br>
			      <input type="password" name="password" placeholder="Enter password" required/><br><br>
			    <button type="submit" name="submit">Submit</button>
			</form>
		</div>
	</body>
</html>