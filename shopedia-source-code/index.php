<?php
include('./dev/debug.php');
include('./auth/session.php');
include("./auth/config.php");

$product_sql = "SELECT * FROM products WHERE 1 = 1";
$pop_product_result = mysqli_query($db, $product_sql);
$new_product_result = mysqli_query($db, $product_sql);

$all_products = [];

while ($product_row = $pop_product_result->fetch_assoc()) {
  array_push($all_products, $product_row);
}
// $all_products = $pop_product_result->fetch_assoc()

// while ($product_row = $product_result->fetch_assoc()) {
//   debug_to_console($product_row);
// }

// $result = mysqli_query($db, $sql);
// $product_row = mysqli_fetch_array($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properties -->
  <title>Shopedia</title>
  <?php include('ui/includes.php'); ?>
  <script src="/assets/js/search.js"></script>
  <link rel="stylesheet" href="/assets/css/main.css">
  
  <style type="text/css">
    .carousel-item {
      width: 100%; 
      height: 400px; 
      object-fit:cover; 
      object-position: center;
    }
  </style>

  
  <script>
  $(document)
    .ready(function() {

      // fix menu when passed
      $('.masthead')
        .visibility({
          once: false,
          onBottomPassed: function() {
            $('.fixed.menu').transition('fade in');
          },
          onBottomPassedReverse: function() {
            $('.fixed.menu').transition('fade out');
          }
        })
      ;

      $('#lightSlider').lightSlider({
        // gallery: true,
        item: 1,
        loop:true,
        slideMargin: 0,
        thumbItem: 9,
        adaptiveHeight:false,
        auto: true,
        pause: 7000,
        // autoWidth: true
      });


    });
    
      // setTimeout(() => {
      //   $("#carousel").transition("fade");
      // }, 2000)
      
  </script>
</head>
<body>

<?php include("./ui/fixed-header.php"); ?>

<!-- Page Contents -->
<div class="pusher">
  <div id="carousel" class="ui inverted masthead center aligned segment" style="background: white; padding: 0px;">
    <?php include("./ui/static-header.php"); ?>

    <ul id="lightSlider">
      <li data-thumb="//laz-img-cdn.alicdn.com/images/ims-web/TB1dUMgr3ZC2uNjSZFnXXaxZpXa.jpg_2200x2200Q100.jpg_.webp">
        <img src="//laz-img-cdn.alicdn.com/images/ims-web/TB1dUMgr3ZC2uNjSZFnXXaxZpXa.jpg_2200x2200Q100.jpg_.webp" class="carousel-item"/>
      </li>
      <li data-thumb="//laz-img-cdn.alicdn.com/images/ims-web/TB1VWu9XxYaK1RjSZFnXXa80pXa.jpg_2200x2200Q100.jpg_.webp">
        <img src="//laz-img-cdn.alicdn.com/images/ims-web/TB1VWu9XxYaK1RjSZFnXXa80pXa.jpg_2200x2200Q100.jpg_.webp" class="carousel-item"/>
      </li>
      <li data-thumb="//laz-img-cdn.alicdn.com/images/ims-web/TB1xhm8XxYaK1RjSZFnXXa80pXa.jpg_2200x2200Q100.jpg_.webp">
        <img src="//laz-img-cdn.alicdn.com/images/ims-web/TB1xhm8XxYaK1RjSZFnXXa80pXa.jpg_2200x2200Q100.jpg_.webp" class="carousel-item"/>
      </li>
      <li data-thumb="//laz-img-cdn.alicdn.com/images/ims-web/TB1R2L2XxYaK1RjSZFnXXa80pXa.jpg_2200x2200Q100.jpg_.webp">
        <img src="//laz-img-cdn.alicdn.com/images/ims-web/TB1R2L2XxYaK1RjSZFnXXa80pXa.jpg_2200x2200Q100.jpg_.webp" class="carousel-item"/>
      </li>
    </ul>
  </div>

  <div class="ui vertical stripe segment">
    <div class="ui middle aligned stackable grid container">
      <div class="row">
        <div class="sixteen wide column">
          <h2 class="ui header">Popular Items</h2>
          
          <div class="ui grid">
            <?php
            foreach ($all_products as $product_row){
              echo '
                <div class="four wide column">
                  <div class="ui card" style="width: 100%" onclick="window.location =\'/view_product.php?id=' . $product_row["id"] . '\'">
                    <div class="content">
                      <div class="right floated meta" style="font-size: 11px;">' . timeAgo($product_row["createdAt"]) . '</div>
                      <div>' . $product_row["productName"] . '</div>
                    </div>
                    <div class="image">
                      <img style="height: 220px; object-fit: cover;" src="' . $product_row["imgPath"] . '">
                    </div>
                    <div class="content">
                    ' . '$' . sprintf('%01.2f', $product_row["cost"]) . '
                    </div>
                  </div>
                </div>';
            }
            ?>
          </div>

        </div>
      </div>
      <div class="row">
        <div class="center aligned column">
          <a class="ui huge button">See More</a>
        </div>
      </div>
    </div>
  </div>


  <div class="ui vertical stripe quote segment">
    <div class="ui equal width stackable internally celled grid">
      <div class="center aligned row">
        <div class="column">
          <h2>Flash Sale <span style="font-size: 12px; color: #d2d2d2">On sale today</span></h2>
          
          <?php
            $product_row = $all_products[(date('z') + 1) % count($all_products)];
            echo '
              <div class="ui card" style="width: 100%; max-width: 260px; margin: 0 auto;">
                <div class="content">
                  <div class="right floated meta" style="font-size: 11px;">' . timeAgo($product_row["createdAt"]) . '</div>
                  <div>' . $product_row["productName"] . '</div>
                </div>
                <div class="image">
                  <img style="height: 220px; object-fit: cover;" src="' . $product_row["imgPath"] . '">
                </div>
                <div class="content">
                  ' . '$' . sprintf('%01.2f', $product_row["cost"]) . '
                </div>
              </div>';
          ?>
        </div>
        <div class="column">
          <h2>Categories <span style="font-size: 12px; color: #d2d2d2">Hot categories today</span></h2>
          <div>
            <div class="ui card" style="width: 130px; display: inline-block;">
              <div class="image">
                <img style="width: 130px; height: 130px; object-fit: cover;" src="/assets/images/cat1.png">
              </div>
            </div>

            <div class="ui card" style="width: 130px; display: inline-block;">
              <div class="image">
                <img style="width: 130px; height: 130px; object-fit: cover;" src="/assets/images/cat2.png">
              </div>
            </div>
          </div>
          <div>
            <div class="ui card" style="width: 130px; display: inline-block;">
              <div class="image">
                <img style="width: 130px; height: 130px; object-fit: cover;" src="/assets/images/cat3.png">
              </div>
            </div>

            <div class="ui card" style="width: 130px; display: inline-block;">
              <div class="image">
                <img style="width: 130px; height: 130px; object-fit: cover;" src="/assets/images/cat4.png">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="ui vertical stripe segment">
    <div class="ui middle aligned stackable grid container">
      <div class="row">
        <div class="sixteen wide column">
          <h2 class="ui header">New Items</h2>
          
          <div class="ui grid">
            <?php
              foreach ($all_products as $product_row){
                echo '
                  <div class="four wide column">
                    <div class="ui card" style="width: 100%">
                      <div class="content">
                        <div class="right floated meta" style="font-size: 11px;">' . timeAgo($product_row["createdAt"]) . '</div>
                        <div>' . $product_row["productName"] . '</div>
                      </div>
                      <div class="image">
                        <img style="height: 220px; object-fit: cover;" src="' . $product_row["imgPath"] . '">
                      </div>
                      <div class="content">
                        ' . '$' . sprintf('%01.2f', $product_row["cost"]) . '
                      </div>
                    </div>
                  </div>';
              }
              ?>
          </div>
          
        </div>
      </div>
      <div class="row">
        <div class="center aligned column">
          <a class="ui huge button">See More</a>
        </div>
      </div>
    </div>
  </div>


  <?php include('./ui/footer.php'); ?>
</div>

</body>

</html>