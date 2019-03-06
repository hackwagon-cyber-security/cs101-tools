<?php
include('./dev/debug.php');
include('./auth/session.php');
include("./auth/config.php");

$query = $_GET["id"];
$product_sql = "SELECT * FROM products WHERE id = $query;";
$product_result = mysqli_query($db, $product_sql);



$count = mysqli_num_rows($product_result);

$all_products = [];

while ($product_row = $product_result->fetch_assoc()) {
  array_push($all_products, $product_row);
}

$product_row = $all_products[0];
debug_to_console($all_products[0]);

$category = $product_row["productCategory"];
$related_product_sql = "SELECT * FROM products WHERE productCategory LIKE '%$category%';";
$related_result = mysqli_query($db, $related_product_sql);
$related_products = array();

while ($related = $related_result->fetch_assoc()) {
  array_push($related_products, $related);
}

shuffle($related_products);
$related_products = array_slice($related_products, 0, 5, true);



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
      $('.rating').rating('disable');
      $("#add-btn").on("click", function(){
        $("#qty").val(Number.parseInt($("#qty").val()) + 1);
      })

      $("#minus-btn").on("click", function(){
        $("#qty").val(Number.parseInt($("#qty").val()) - 1);
      })

      $("#add-to-cart").on("click", function(){
        let params = new URLSearchParams(location.search);
        
        $.ajax({
          url: `/cart.php?id=${params.get('id')}&qty=${$("#qty").val()}`
        }).done(function(data){
          console.log(data);
          if (data) {
            let response = JSON.parse(data);
            if (response.status == "success") {
              $(".ui.small.success.message").remove();
              $(".stackable.grid.container").prepend(`
              <div class="ui small success message hidden" style="width: 100%;">
                <div class="header">
                  Success
                </div>
                <p>Successfully added item to cart</p>
              </div>
              `);
              $(".ui.small.success.message").transition("fade");
              var count = $($(".cart-count")[0]).text();
              console.log(Number.parseInt(count));
              console.log(Number.parseInt($("#qty").val()));
              $(".cart-count").text(Number.parseInt(count) + Number.parseInt($("#qty").val()));
            } else {
              $(".ui.small.negative.message").remove();
              $(".stackable.grid.container").prepend(`
              <div class="ui small negative message hidden" style="width: 100%;">
                <div class="header">
                  Failed
                </div>
                <p>Failed to add item to cart</p>
              </div>
              `);
              $(".ui.small.negative.message").transition("fade");
            }
          }
        });
      })

    });

    
    
      // setTimeout(() => {
      //   $("#carousel").transition("fade");
      // }, 2000)
      
  </script>
</head>
<body>

<!-- Following Menu -->
<?php include("./ui/static-header.php"); ?>

<!-- Page Contents -->
<div class="pusher">
  <?php include("./ui/fixed-header.php"); ?>

  <div class="ui vertical stripe segment">
    <div class="ui middle aligned stackable grid container">
      <div class="row">
        <div class="sixteen wide column">
          <!-- <h2 class="ui header">Search Results</h2> -->
          <!-- <p><?php echo "$count results found for '$query'"?></p> -->
          <div class="ui grid">
            <div class="sixteen wide column">
              <div class="ui card" style="width: 100%">
                <div class="ui grid" style="margin: 0">
                  <div class="five wide column">
                    <img style="width: 100%; object-fit: cover;" src="<?php echo $product_row["imgPath"]; ?>">
                  </div>

                  <div class="six wide column">
                    <h2><?php echo $product_row["productName"]; ?></h2>
                    <div class="ui divider"></div>
                    <h3 class="ui red header">$SGD <?php echo sprintf('%01.2f', $product_row["cost"]) ?></h3>
                    <div class="ui input">
                      <button id="minus-btn" class="ui icon button" style="margin: 0;">
                        <i class="minus icon"></i>
                      </button>
                      <input id="qty" type="text" type="number" value="1" style="width: 80px">
                      <button id="add-btn" class="ui icon button" style="margin: 0;">
                        <i class="plus icon"></i>
                      </button>
                    </div>
                    <br/>
                    <br/>
                    <button id="add-to-cart" class="ui right labeled icon button">
                      <i class="shop icon"></i>
                      Add To Cart
                    </button>
                  </div>

                  <div class="five wide column" style="background: #fafafa">
                    <h6 style="margin: 0px;">DELIVERY OPTIONS</h6>
                    <span style="color: #818181; font-size: 12px;"><i class="globe icon"></i>Ships from Overseas</span>
                    <br/>
                    <span style="color: #818181; font-size: 12px;"><i class="shipping fast icon"></i>Fastest delivery option available for $4.99 with Shopedia Express</span>
                    <br/>
                    <span style="color: #818181; font-size: 12px;"><i class="shipping truck icon"></i>Normal delivery option available for FREE with Shopedia Normal</span>
                    <br/>
                    <br/>
                    <h6 style="margin: 0px;">RETURN &amp; WARRANTY</h6>

                    <span style="color: #818181; font-size: 12px;"><i class="redo icon"></i>7 days return</span>
                    <br/>
                    <span style="color: #818181; font-size: 12px;"><i class="shield icon"></i>15 days warranty</span>
                  </div>

                </div>
              </div>
            </div>
          </div>

          <div class="ui grid">
            <div class="twelve wide column">
              <div class="ui card" style="width: 100%">
                <div class="content">
                  <div class="right floated meta" style="font-size: 11px;"></div>
                  <div><b>Product details for <?php echo $product_row["productName"]; ?></b></div>
                </div>
                <div class="ui grid" style="margin: 0">
                  <!-- <div class="five wide column">
                    <img style="width: 100%; object-fit: cover;" src="<?php echo $product_row["imgPath"]; ?>">
                  </div> -->

                  <div class="sixteen wide column">
                    <?php echo $product_row["productName"]; ?>
                  </div>

                </div>
              </div>


              <div class="ui card" style="width: 100%">
                <div class="content">
                  <div class="right floated meta" style="font-size: 11px;"></div>
                  <div><b>Ratings &amp; reviews of <?php echo $product_row["productName"]; ?></b></div>

                  <div>
                    <br/>
                    <h1>0.0<span style="color: #818181; font-size: 18px;">/5</span></h1>
                    <div class="ui massive star rating" data-rating="1" data-max-rating="5"></div>
                    <br/>
                    <br/>
                    <span>No ratings and review so far.</span>
                  </div>
                </div>
                
              </div>
            </div>
            <div class="four wide column">
              <h3>Related products</h3>
              <?php 
                foreach ($related_products as $product_row){
                  echo '
                    <div class="four wide column">
                      <div class="ui card" style="width: 100%; margin-bottom: 15px; cursor: pointer;" onclick="window.location =\'/view_product.php?id=' . $product_row["id"] . '\'">
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
              <!-- <div class="ui wide skyscraper test ad" data-text="Ad Unit"></div> -->
            </div>
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