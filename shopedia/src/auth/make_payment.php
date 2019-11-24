<?php
include('./debug.php');
include('./session.php');
include("./config.php");

$userId = $_POST["userId"];
$creditCardNumber = $_POST["creditCardNumber"];
$cvvNumber = $_POST["cvvNumber"];
$expiryDate = $_POST["expiryDate"];
$fullName = $_POST["fullName"];
$amountPaid = $_POST["amountPaid"];

$cart = $_SESSION["cart"];
$cartItems = json_encode($cart);

if (!$userId || !$creditCardNumber || !$cvvNumber || !$expiryDate || !$fullName || !$amountPaid || !$cartItems) {
  echo json_encode(array("status" => "failed", "message" => "You failed to fill up one of the fields for your credit card"));
  return;
}

$user = 'root';
$password = 'root';
$db = 'shopedia';
$host = getenv('ENV_VAR') == 'docker' ? 'db' : 'localhost';
$port = 3306;

$db = mysqli_connect($host,$user,$password,$db,$port);


$insert_stmt = "INSERT INTO orders (userId, creditCardNumber, cvvNumber, expiryDate, fullName, cartItems, amountPaid) VALUES ($userId, '$creditCardNumber', '$cvvNumber', '$expiryDate', '$fullName', '$cartItems', $amountPaid);";
$insert_success = mysqli_query($db, $insert_stmt);

if ($insert_success) {
  $_SESSION["cart"] = null;
  echo json_encode(array("status" => "success"));
} else {
  echo json_encode(array("status" => "failed"));
}
?>

