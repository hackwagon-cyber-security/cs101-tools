<?php
    header('X-XSS-Protection:0');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mysqli = new mysqli("localhost", "xss-demo", "password", "xssdemo");
        if ($mysqli->connect_error) {
            die("Connection failed: " . $mysqli->connect_error);
        } 
        $stmt = $mysqli->prepare("INSERT INTO data_store (value) VALUES (?)");
        $stmt->bind_param("s",$_POST['value']);
        $stmt->execute();

        if ($stmt->execute()) {
		echo "New record created successfully <br>";
	        echo 'You can visit your xss-attack <a href="/demo/xss-1b.php?id="' . mysqli_stmt_insert_id($stmt) . "> here</a>.";
         } else {
            echo "Error: " . $sql . "<br>" . $stmt->error;
         }
        // Close connection
        mysqli_close($mysqli);
    } else {
        echo '<form action="" method="POST" >Value to inject: <input type="text" name="value"><br><input type="submit" value="Submit"></form>';
    }
?>
