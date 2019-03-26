<?php
    $mysqli = new mysqli("localhost", "demo", "password", "sqldemo");
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo '<p>This is an authentication bypass exercise!</p>';
        echo '<p>Your objective is to login without password using SQL injection!';
        echo '<p>Refer to the list of usernames below:</p>';

        $sql = "select username from user";
        $result = $mysqli->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            echo '<table border="1"><tr><th>Username</th></tr>';
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["username"]. "</td></tr>";
            }
            echo '</table>';
        }

        echo '<h4>Login</h4>';
        echo '<form action="/demo/sqli-2.php" method="POST">
        <p><input name="username" type="username" placeholder="Username"></p>
        <p><input name="password" type="password" placeholder="Password"></p>
        <p><input type="submit" value="Login"></p>
        </form>';
    } else {
        if(isset($_POST['username']) && isset($_POST['password'])) {
            $sql = "select username from user where username='". $_POST['username'] . "' and password='" . $_POST['password'] ."'";
            echo '<p>SQL statement: ' . $sql . ' </p>';
            $result = $mysqli->query($sql);
            if ($result->num_rows > 0) {
                echo '<p><b>Congratulations!</b> You logged in as: ' . $_POST['username'] . ' </p>';
            } else {
                echo '<p>Authentication failed</p>';
                
            }
        } else {
            echo 'The HTTP POST do not contain the correct parameters';
        }
        echo '<p>Click <a href="/demo/sqli-2.php">here</a> to try again.';
    }
    $mysqli -> close();
?>