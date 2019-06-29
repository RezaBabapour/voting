<?php
	$link = new mysqli("db_service", "auth_service_user", "Auth_service@1397", "cc_project_database");
	if (!$link) {
	    echo "Error: Unable to connect to MySQL." . PHP_EOL;
	    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
	    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
	    exit;
		}
?>
