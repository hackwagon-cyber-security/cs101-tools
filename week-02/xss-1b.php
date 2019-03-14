<?php
	header('X-XSS-Protection:0');
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $mysqli = new mysqli("localhost", "xss-demo", "password", "xssdemo");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        } 
        $sql = "select value from data_store where id = " . $_GET['id'];

        $stmt = $mysqli->prepare("select value from data_store where id = (?)");
        $stmt->bind_param("i",$_GET['id']);
        $stmt->execute();

        if ($stmt->execute()) {
            $result = $mysqli->query($sql);

            /* bind result variables */
            $stmt->bind_result($value);

            while ($stmt->fetch()) {
                echo $value;
            }
        }
        // Close connection
        mysqli_close($mysqli);
    }
?>