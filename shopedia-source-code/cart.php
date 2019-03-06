<?php
include('./dev/debug.php');
include('./auth/session.php');
include("./auth/config.php");
?>

<?php
$id = $_REQUEST["id"];
$qty = $_REQUEST["qty"];

$cartItems = array();

$query = $_GET["id"];
$product_sql = "SELECT * FROM products WHERE id = $query;";
$product_result = mysqli_query($db, $product_sql);
$all_products = [];

while ($product_row = $product_result->fetch_assoc()) {
  array_push($all_products, $product_row);
}

$product_row = $all_products[0];

if (!$product_row) {
  echo json_encode(
    array(
      "status" => "failed",
      "message" => "No such product was found"
    )
  );
  return;
}

if ($_SESSION["cart"]) {
  $cartItems = $_SESSION["cart"];
  if ($cartItems[$id]) {
    $new_qty = (int)$qty + (int)$cartItems[$id]["qty"];
    $cartItems[$id] = array(
      "cost" => $new_qty * (float)$product_row["cost"],
      "qty" => $new_qty
    );
  } else {
    $cartItems[$id] = array(
      "cost" => (int)$qty * (float)$product_row["cost"],
      "qty" => (int)$qty
    );
  }
} else {
  $cartItems = array(
    $id => array(
      "cost" => (int)$qty * (float)$product_row["cost"],
      "qty" => (int)$qty
    )
  );
}

$_SESSION["cart"] = $cartItems;

echo json_encode(array(
  "status" => "success",
  "data" => $_SESSION["cart"]
));
?>

