<?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['category'])) {

            $mysqli = new mysqli("localhost", "demo", "password", "sqldemo");
            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            $sql = "select * from product where category = '" . $_GET['category'] . "'";
            echo '<p>SQL: ' . $sql . '</p>';
            $result = $mysqli->query($sql);

            echo '<p>Look at the URL.</p>';
            echo '<p>This is a simple SQL injection exercise. Try to select a inject into the category parameter in the URL and display all the products!</p>';
            echo "<p>The SQL statement is: select * from product where category = '[USER-SUPPLIED-INPUT]' </p>";
            echo '<p>Take note of the quotes!</p>';

            if ($result->num_rows > 0) {
                // output data of each row
                echo '<table border="1"><tr><th>ID</th><th>Product Name</th><th>Category</th>';
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["product_name"]. "</td><td>" . $row["category"]. "</td></tr>";
                }
                echo '</table>';
            } else {
                echo "<p>No results found!</p>";
            }
            $mysqli -> close();
            echo '</br>Click <a href="/demo/sqli-1.php">here</a> to try again!';
        } else {
            echo '<p>Please select a category</p>';
            echo '<form action="" method="GET">
            <select name="category">
              <option value="fruits">Fruits</option>
              <option value="vegetables">Vegetables</option>
              <option value="drinks">Drinks</option>
            </select>
            <input type="submit" value="Submit">
          </form>';
        }

        
    }
?>