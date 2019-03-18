<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        echo '<p>This is an OS injection exercise!</p>';
        echo '<p>Your objective is to try to execute other OS commands such as "id"!';

        echo '<h4>Ping Domain</h4>';
        echo '<form action="/demo/osi-1.php" method="POST">
        <p><input name="domain" type="text" placeholder="Domain"></p>
        <p><input type="submit" value="Ping"></p>
        </form>';
    } else {
        if(isset($_POST['domain'])) {
            $cmd = 'ping -c 1 ' . $_POST['domain'];
            echo "Command to be executed: " . $cmd;
            $output = shell_exec($cmd);
            echo "<pre>$output</pre>";
        } else {
            echo 'The HTTP POST do not contain the correct parameters';
        }
        echo '<p>Click <a href="/demo/osi-1.php">here</a> to try again.';
    }
?>