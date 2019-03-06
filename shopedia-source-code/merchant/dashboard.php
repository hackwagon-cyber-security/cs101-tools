<?php
include("../dev/debug.php");
include("../auth/config.php");
include("../auth/session.php");

$email = $_SESSION['login_user'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$count = mysqli_num_rows($result);
?>

<html>
  <head>
    <title>Merchant Dashboard</title>
    <?php include '../ui/includes.php';?>
  </head>
  <body>
    <div class="ui container">
      <br>
      <div class="ui secondary menu">
        <div class="header item"><a href="/index.php">Shopedia</a></div>
        <a class="active item" href="dashboard.php">
          Home
        </a>
        <a class="item" href="products.php">
          Products
        </a>
        <a class="item" href="orders.php">
          Orders
        </a>
        <a class="item" href="analytics.php">
          Analytics
        </a>
        <div class="right menu">
          <div class="item">
            <div class="ui icon user">
            <a class="ui item">
              <i class="user link icon"></i>
              <?php echo $email ?>
            <a>
            </div>
          </div>
          <a class="ui item" href="../auth/logout.php">
            Logout
          </a>
        </div>
      </div>
      <div class="ui divider"></div>
      <br>

      <div class="ui grid">
        <div class="sixteen wide column">

          <div class="ui cards">
            <div class="card">
              <div class="content">
                <div class="header">Pending Orders</div>
                <div class="description">
                  <h2>2</h2>
                </div>
              </div>
              <div class="ui bottom attached button">
                <i class="eye icon"></i>
                View
              </div>
            </div>
            <div class="card">
              <div class="content">
                <div class="header">Your Rating</div>
                <div class="description">
                  <h2>3.4</h2>
                </div>
              </div>
              <div class="ui bottom attached button">
                <i class="eye icon"></i>
                View
              </div>
            </div>
            <div class="card">
              <div class="content">
                <div class="header">Performance</div>
                <div class="description">
                  <h2>3.4</h2>
                </div>
              </div>
              <div class="ui bottom attached button">
                <i class="eye icon"></i>
                View
              </div>
            </div>
          </div>

          <!-- <div class="ui form">
            <div class="field">
              <input type="text" name="first-name" placeholder="First name">
            </div>
            <div class="field">
              <textarea placeholder="Some example text..."></textarea>
            </div>
          </div> -->

        </div>
      </div>


    </div>
  </body>
</html>
