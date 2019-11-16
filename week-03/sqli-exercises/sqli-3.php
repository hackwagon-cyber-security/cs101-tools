<?php
    $mysqli = new mysqli("localhost", "root", "password", "sqldemo");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if(isset($_GET['username'])) {
	    $sql = "select id, password from simple_users where username = '" . $_GET['username'] .  "'";
	    $result = $mysqli->query($sql);
	    if ($result->num_rows > 0) {
	        echo 'Success - Username is correct';
	    } else {
	        echo 'Fail - Username is not correct';
	    }
	} else {
	    echo 'Enter a value to the "username" URL parameter to check if the username is valid!';
	}
    }
    $mysqli -> close();
?>
