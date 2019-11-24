<?php
include('./dev/debug.php');
include('./auth/session.php');
include("./auth/config.php");

$query = $_GET["q"];
$product_sql = "SELECT * FROM products WHERE productName LIKE '%$query%';";
$product_result = mysqli_query($db, $product_sql);

$count = mysqli_num_rows($product_result);

$all_products = [];

while ($product_row = $product_result->fetch_assoc()) {
  array_push($all_products, $product_row);
}
// $search_product_sql = "SELECT * FROM products WHERE productName LIKE '%$q%';";
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
        // autoWidth: true
      });


    });
    
      // setTimeout(() => {
      //   $("#carousel").transition("fade");
      // }, 2000)
      
  </script>
</head>
<body>

<?php include("./ui/static-header.php"); ?>

<!-- Page Contents -->
<div class="pusher">
  
    <?php include("./ui/fixed-header.php"); ?>

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

    <!-- <div class="ui text container">
      <h1 class="ui inverted header">
        Shopedia
      </h1>
      <h2>Buy anything, anytime, anywhere</h2>
    </div> -->


  <div class="ui vertical stripe segment">
    <div class="ui middle aligned stackable grid container">
      <div class="row">
        <div class="sixteen wide column">
          <h2 class="ui header">Search Results</h2>
          <p><?php echo "$count results found for '$query'"?></p>
          <div class="ui grid">
            <?php
            foreach ($all_products as $product_row){
            // while ($product_row = $pop_product_result->fetch_assoc()) {
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
                      <span class="right floated">
                        <i class="heart outline like icon"></i>
                        17 wishlisted
                      </span>
                      ' . '$' . money_format("%i", $product_row["cost"]) . '
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
          <!-- <a class="ui huge button">Check Them Out</a> -->
        </div>
      </div>
    </div>
  </div>


  


  <?php include('./ui/footer.php'); ?>
</div>

</body>

</html>