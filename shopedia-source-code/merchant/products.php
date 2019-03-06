<?php
include "../tools/debug.php";
include "../auth/config.php";
include '../auth/session.php';

$imgPath = null;
$email = $_SESSION['login_user'];
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$userId = $row["id"];

$product_sql = "SELECT * FROM products WHERE 1 = 1";
$product_result = mysqli_query($db, $product_sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $target_dir = "../uploads/";
  $imageFileType = strtolower(pathinfo($_FILES["productImage"]["name"], PATHINFO_EXTENSION));
  $target_file = $target_dir . randomId(17) . "." . $imageFileType;
  $uploadOk = 1;

  // Check if image file is a actual image or fake image
  if (isset($_POST["productImage"])) {
    $check = getimagesize($_FILES["productImage"]["tmp_name"]);
    if ($check !== false) {
      debug_to_console("File is an image - " . $check["mime"] . ".");
      $uploadOk = 1;
    } else {
      debug_to_console("File is not an image.");
      $uploadOk = 0;
    }
  }
  // Check file size
  if ($_FILES["productImage"]["size"] > 5000000) {
    debug_to_console("Sorry, your file is too large.");
    $uploadOk = 0;
  }
  // Allow certain file formats
  if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    debug_to_console("Sorry, your file was not uploaded.");
    // if everything is ok, try to upload file
  } else {
    if (!file_exists('../uploads/')) {
        mkdir('../uploads/', 0777, true);
    }
    if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $target_file)) {
        $productName = $_POST["productName"];
        $productCategory = $_POST["productCategory"];
        $productDesc = $_POST["productDesc"];
        $cost = floatval($_POST["cost"]);
        $status = "draft";
        $belongsTo = $userId;
        $imgPath = str_replace("..", "", $target_file);
       // debug_to_console($imgPath);

        $insert_stmt = "INSERT INTO products (productName,productDesc,productCategory,cost,status,belongsTo,imgPath) VALUES ('$productName', '$productDesc', '$productCategory', '$cost', '$status', '$belongsTo', '$imgPath')";
        $insert_success = mysqli_query($db, $insert_stmt);

        if (!$insert_success) {
          $error = "Could not insert product";
          return;
        } else {
          $success_message = "Successfully created product";
          echo '<script>window.location=""</script>';
        }
        $_POST = array();
    } else {
        $error = "Sorry, there was an error uploading your image.";
    }
  }
}
?>

<html>
  <head>
    <title>Merchant Dashboard</title>
    <?php include '../ui/includes.php';?>

    <script>
    $(document)
      .ready(function() {
        $('#create-product-form')
          .form({
            fields: {
              productName: {
                identifier  : 'productName',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please enter a product name'
                  }
                ]
              },
              productDesc: {
                identifier  : 'productDesc',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please enter product description'
                  }
                ]
              },
              productCategory: {
                identifier  : 'productCategory',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please enter product category'
                  }
                ]
              },
              cost: {
                identifier  : 'cost',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please enter a product cost'
                  }
                ]
              },
              productImage: {
                identifier  : 'productImage',
                rules: [
                  {
                    type   : 'empty',
                    prompt : 'Please upload a product image'
                  }
                ]
              }
            }
          });
      });
    </script>
  </head>
  <body>
    <div class="ui container">
      <br>
      <div class="ui secondary menu">
        <div class="header item">Shopedia</div>
        <a class="item" href="dashboard.php">
          Home
        </a>
        <a class="active item" href="products.php">
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
              Username
            <a>
            </div>
          </div>
          <a class="ui item">
            Logout
          </a>
        </div>
      </div>
      <div class="ui divider"></div>
      <br>

      <div class="ui grid">
        <div class="sixteen wide column">

          <table class="ui sortable compact celled definition table">
            <thead>
              <tr>
                <th></th>
                <th class="">Product</th>
                <th>Created On</th>
                <th>Price</th>
                <th>Published?</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while ($product_row = $product_result->fetch_assoc()) {
                  echo '
                  <tr>
                    <td class="collapsing">
                      <div class="ui fitted slider checkbox">
                        <input type="checkbox"><label></label>
                      </div>
                    </td>
                    <td>' . $product_row["productName"] . '</td>
                    <td>' . date('jS M Y, h:i a', strtotime($product_row["createdAt"])) . '</td>
                    <td>$' . $product_row["cost"] . '</td>
                    <td>' . $product_row["status"] . '</td>
                    <td><a href="/merchant/view_product.php?id='. $product_row["id"] .'">View</a></td>
                  </tr>';
                }
              ?>
            </tbody>
            <tfoot class="full-width">
              <tr>
                <th></th>
                <th colspan="5">
                  <div onclick="showProductModal()" class="ui right floated small primary labeled icon button">
                    <i class="shopping bag icon"></i> Add Product
                  </div>
                  <div class="ui small button">
                    Publish
                  </div>
                  <div class="ui small  disabled button">
                    Publish All
                  </div>
                </th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>




    <!-- Add product modal -->
    <div class="ui modal">
      <i class="close icon"></i>
      <div class="header">
        Create A Product
      </div>
      <div class="content">
        <!-- <div class="ui medium image">
          <img src="/images/avatar/large/chris.jpg">
        </div> -->
        <form action="" id="create-product-form" class="ui form" method="post" enctype="multipart/form-data">


          <div class="field">
            <label>Product Image</label>
            <input id="productImage" type="file" name="productImage">
          </div>

          <div class="two fields">
            <div class="field">
              <label>Product Name</label>
              <input type="text" name="productName" placeholder="Product Name">
            </div>
            <div class="field">
              <label>Product Cost</label>
              <input type="number" name="cost" placeholder="Product Cost" step="0.01">
            </div>
          </div>

          <div class="field">
            <label>Product Cateogry</label>
            <input type="text" name="productCategory" placeholder="Product Category">
          </div>

          <div class="field">
            <label>Product Description</label>
            <textarea rows="4" name="productDesc" placeholder="Product Description"></textarea>
          </div>

          <div class="actions">
            <div class="ui black deny button">
              Cancel
            </div>
            <button class="ui right labeled icon button" type="submit" onclick="submitForm()">
              Create
              <i class="checkmark icon"></i>
            </button>
          </div>
        </form>

        <!-- <div class="description">
        </div> -->
      </div>

    </div>

  </body>

  <footer>
    <script>
      $(document).ready(function() {
        $('table').DataTable();
      });
      

      function showProductModal(){
        $('.ui.modal').modal('show');
      }

      function submitForm(){
        console.log("clicked");

        if(!$('#create-product-form').form('is valid', 'productImage')) {
          $("#productImage").css("border-color", "#E0B4B4");
          $("#productImage").css("background", "#FFF6F6");
        }

        // if( $('#create-product-form').form('is valid')) {
        //   // form is valid (both email and name)
        //   document.getElementById("create-product-form").submit();
        // }


      }
    </script>
  </footer>
</html>
