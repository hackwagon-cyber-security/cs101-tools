<?php
include("../dev/debug.php");
include("./config.php");

session_start();

$errorMessage = NULL;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // username and password sent from form 
  
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $accountType = $_POST['accountType'];

  $sql = "SELECT id FROM users WHERE email = '$email'";
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

  
  $count = mysqli_num_rows($result);

  // $active = $row['active'];

  if ($count == 0) {
    $insert_stmt = "INSERT INTO users (email, password, accountType) VALUES ('$email', '$password', '$accountType')";
    $insert_success = mysqli_query($db, $insert_stmt);

    if (!$insert_success) {
      $errorMessage = "Email has been used before";
      return;
    }

    echo 
        '<script type="text/javascript">
          window.location = "/auth/login.php"
        </script>';
    
  } else {
    $errorMessage = "User email already exists";
  }
  
}
?>

<html>
  <head>
    <title>Signup Page</title>
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
              email: {
                identifier  : 'email',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please enter your e-mail'
                  },
                  {
                    type   : 'email',
                    prompt : 'Please enter a valid e-mail'
                  }
                ]
              },
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
              },
              confirmPassword: {
                identifier  : 'confirmPassword',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please confirm your password'
                  },
                  {
                    type   : 'length[6]',
                    prompt : 'Your password must be at least 6 characters'
                  },
                  {
                    type   : 'match[password]',
                    prompt : 'Passwords in both fields must be the same'
                  },
                ]
              },
              accountType: {
                identifier  : 'accountType',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please select an account type'
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
            Register an account
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
            <div class="field">
              <div class="ui left icon input">
                <i class="lock icon"></i>
                <input type="password" name="confirmPassword" placeholder="Confirm password">
              </div>
            </div>
            <div class="field">
              <div class="ui left icon input">
                <i class="lock icon"></i>
                <select class="ui dropdown" name="accountType">
                  <option value="">Account Type</option>
                  <option value="shopper">Shopper</option>
                  <option value="merchant">Merchant</option>
                </select>
              </div>
            </div>
            <div class="ui fluid large teal submit button">Register</div>
            <br/>
            <b style="color: red;">NOTE: Do not use your actual password, this website is very vulnerable</b>
          </div>

        </form>

        <?php 
          if ($errorMessage != NULL) {
            echo '<div class="ui message"><div class="header">Authentication Failed</div><p>' . $errorMessage . '</p></div>';
          }
        ?>

        <div class="ui message" style="box-shadow: 0px 0px 100px rgba(0,0,0,0.08);">
          Already have an account? <a href="/auth/login.php">Login</a>
        </div>
    </div>
  </div>
  </body>
</html>