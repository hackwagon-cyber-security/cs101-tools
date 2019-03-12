<?php
	header('X-XSS-Protection:0');
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $mysqli = new mysqli("localhost", "xss-demo", "password", "xssdemo");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        } 
        $sql = "select value from data_store where id = " . $_GET['id'];
        if ($mysqli->query($sql) === TRUE) {
        
        }

        $result = $mysqli->query($sql);

        if($result->num_rows> 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo $row['value'];
            }
        }
        // Close connection
        mysqli_close($mysqli);
    }
?>