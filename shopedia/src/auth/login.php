<?php
include("../dev/debug.php");
include("config.php");

$errorMessage = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE email = '$email' and password = '$password'";
  
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  
  // If the account exits, continue creating the session
  if ($count == 1) {
    session_start();
    $_SESSION['login_user'] = $row["email"];
    $_SESSION['user_id'] = $row["id"];
    $accountType = $row["accountType"];

    if ($accountType == "shopper") {
      echo 
        '<script type="text/javascript">
          window.location = "/index.php"
        </script>';
    } else if ($accountType == "merchant") {
      echo 
        '<script type="text/javascript">
          window.location = "/merchant/dashboard.php"
        </script>';
    } else if ($accountType == "{i_am_admin}") {
      echo 
        '<script type="text/javascript">
          window.location = "/admin/dashboard.php"
        </script>';
    }
  } else {
    $errorMessage = "Your Login Name or Password is invalid";
  }
}
?>

<html>
  <head>
    <title>Login Page</title>
    <?php include('../ui/includes.php'); ?>
      
    <style type="text/css">
    body {
      background-color: #eff0f5;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>

    <script>
    $(document)
      .ready(function() {
        $('.ui.form')
          .form({
            fields: {
              password: {
                identifier  : 'password',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please enter your password'
                  },
                  {
                    type   : 'length[6]',
                    prompt : 'Your password must be at least 6 characters'
                  }
                ]
              }
            }
          });
      });
    </script>
  </head>
   
  <body>
    <div class="ui middle aligned center aligned grid">
      <div class="column">
        <h2 class="ui teal image header">
          <img src="/assets/images/shopedia-logo.png" style="width: 120px;" class="image">
          <div class="content">
            Log-in to your account
          </div>
        </h2>
        <form action="" method="post" class="ui large form">
          <div class="ui stacked segment" style="box-shadow: 0px 0px 100px rgba(0,0,0,0.08); border: none;">
            <div class="field">
              <div class="ui left icon input">
                <i class="user icon"></i>
                <input type="text" name="email" placeholder="E-mail address">
              </div>
            </div>
            <div class="field">
              <div class="ui left icon input">
                <i class="lock icon"></i>
                <input type="password" name="password" placeholder="Password">
              </div>
            </div>
            <div class="ui fluid large teal submit button">Login</div>
          </div>
        </form>
        <?php 
          if ($errorMessage != NULL) {
            echo '<div class="ui message"><div class="header">Authentication Failed</div><p>' . $errorMessage . '</p></div>';
          }
        ?>
        <div class="ui message" style="box-shadow: 0px 0px 100px rgba(0,0,0,0.08);">
          New to us? <a href="/auth/signup.php">Sign Up</a>
        </div>
      </div>
    </div>
  </body>
</html>