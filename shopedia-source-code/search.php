<?php
  include('./dev/debug.php');
  include('./auth/session.php');
  include("./auth/config.php");
?>

<?php
  $collection = $_REQUEST["collection"];
  $q = $_REQUEST["q"];

  $search_product_sql = "SELECT * FROM $collection WHERE productName LIKE '%$q%' OR productCategory LIKE '%$q%';";
  $product_result = mysqli_query($db, $search_product_sql);
  $count = mysqli_num_rows($row);


  $rows = array();

  while ($r = mysqli_fetch_assoc($product_result)) {
    $rows[] = $r;
  }

  echo json_encode($rows);
?>