<?php

  $user = 'root';
  $password = 'password';
  $db = 'shopedia';
  $host = 'localhost';
  $port = 3306;

  $db = mysqli_connect($host,$user,$password,$db,$port);

  setlocale(LC_MONETARY,"en_SG");

  if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
  }

  if(!function_exists("customErrorHandler")) {
    function customErrorHandler($errno, $errstr, $errfile, $errline) {
      
      $range = array(
        $errline - 5,
        $errline + 5,
      );

      $errorMessage = "";
      $errorMessage .= "<b>Error:</b> [$errline] $errstr<br>";
      $errorMessage .= $errfile;
      $errorMessage .= "<br><br>";
      $errorMessage .= "<b>Source Code as shown below:</b>";
      $errorMessage .= "<br>";
      $errorFileContent = file($errfile);
      for ($i = $range[0]; $i <= $range[1]; ++$i) {
        if ($i === count($errorFileContent)) break;
        if ($i === $errline - 1) {
          $errorMessage .= $i . " | " . $errorFileContent[$i] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span><font color='red'><<<<<&nbsp;&nbsp;This is the error</font></span><br>";
            
        } else {
            $errorMessage .= $i . " | " . $errorFileContent[$i] . " <br>";
        }
        
        // setcookie("error-message", $errorMessage);
      }
      // echo $errorMessage;
      header("Location: ../dev/error.php?msg=" . urlencode(base64_encode($errorMessage)));
      exit($errno);
    }
  
    set_error_handler('customErrorHandler');
  
    // error_reporting(-1);
    // ini_set('display_errors', 1);
 }

  
?>
