<?php
require_once 'connect.inc.php';

if (isset($_GET['vote']) && !empty($_GET['vote'])) {
	$vote = $_GET['vote'];
	$name = $_GET['name'];
	$status = '200';
	$query="SELECT id FROM `user` WHERE name='$name'";
	$result = mysqli_query($link,$query);
	$rows = array();
	while($r = mysqli_fetch_assoc($result)) {
    $rows[] = $r;
	}
	$id = $rows[0]['id'];
	$query="INSERT INTO `vote` (`userID`, `electionID`, `vote`) VALUES ('$id', '1', '$vote')";
	try {
		$result = mysqli_query($link,$query);
	} catch (Exception $e) {
		$status = '401';
	}
	if ($status == '200') {
		switch ($vote) {
		case '1':
			$query="UPDATE `election` SET `ac` = 'ac' + '1' WHERE `election`.`id` = 1";
			break;
		case '2':
			$query="UPDATE `election` SET `bc` = 'bc' + '1' WHERE `election`.`id` = 1";
			break;
		
		case '3':
			$query="UPDATE `election` SET `cc` = 'cc' + '1' WHERE `election`.`id` = 1";
			break;

		case '4':
			$query="UPDATE `election` SET `dc` = 'dc' + '1' WHERE `election`.`id` = 1";
			break;

		default:
			$query="UPDATE `election` SET `uc` = 'uc' + '1' WHERE `election`.`id` = 1";
			break;
		}
		$result = mysqli_query($link,$query);
	}
	mysqli_close($link);

	if ($status == '200') {
		$result = array(
		"status" => $status,
		"msg" => 'vote saved'
		);
	}elseif ($status == '401') {
		$result = array(
		"status" => $status,
		"msg" => 'problem in saving vote'
		);
	}
	$json_response = json_encode($result);
	echo $json_response;

}
?>