<?php
    // This is actually vulnerable to SQL injection!
    header('X-XSS-Protection:0');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Create connection
        $conn = new mysqli("localhost", "xss-demo", "password", "xssdemo");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO data_store (value) values ('" . $_POST['value'] . "')";

        if ($conn->query($sql) === TRUE) {
            $last_id = $conn->insert_id;
            echo "New record created successfully <br>";
            echo 'You can visit your xss-attack <a href="/demo/xss-1b.php?id=' . $last_id . '"> here</a>.';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo '<form action="" method="POST" >Value to inject: <input type="text" name="value"><br><input type="submit" value="Submit"></form>';
    }
?>
