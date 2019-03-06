<?php
include('./dev/debug.php');
include('./auth/session.php');
include("./auth/config.php");

$cart_count = 0;
$all_string = array();
$total_cost = 0;
$all_products = [];

if(isset($_SESSION["cart"])) {
  $cart = $_SESSION["cart"];
  foreach ($cart as $key => $value) {
    $cart_count += $value["qty"];
    array_push($all_string, 'id = ' . $key);
    $total_cost += (float)$cart[$key]["cost"];
  }
  $product_sql = "SELECT * FROM products WHERE " . join(' OR ', $all_string) . ";";
  $product_result = mysqli_query($db, $product_sql);
  
  $count = mysqli_num_rows($product_result);
  
  while ($product_row = $product_result->fetch_assoc()) {
    array_push($all_products, $product_row);
  }
}



// $product_row = $all_products[0];
// debug_to_console($all_products[0]);
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
  
    
    $(function() {
      var card = new Card({
        // a selector or DOM element for the form where users will
        // be entering their information
        form: 'form', // *required*
        // a selector or DOM element for the container
        // where you want the card to appear
        container: '.card-wrapper', // *required*

        formSelectors: {
            numberInput: '#number', // optional — default input[name="number"]
            expiryInput: '#expiry', // optional — default input[name="expiry"]
            cvcInput: '#cvc', // optional — default input[name="cvc"]
            nameInput: '#name' // optional - defaults input[name="name"]
        },

        width: 350, // optional — default 350px
        formatting: true, // optional - default true

        // Strings for translation - optional
        messages: {
            validDate: 'valid\ndate', // optional - default 'valid\nthru'
            monthYear: 'mm/yyyy', // optional - default 'month/year'
        },

        // Default placeholders for rendered fields - optional
        placeholders: {
            number: '•••• •••• •••• ••••',
            name: 'Full Name',
            expiry: '••/••',
            cvc: '•••'
        },

        masks: {
            cardNumber: '•' // optional - mask card number
        },

        // if true, will log helpful messages for setting up Card
        debug: false // optional - default false
      });


      $("#checkout-btn").click(function(){
        $('.ui.modal').modal('show');
      });

      $("#confirm-payment").click(function(){
        var data = {
          userId: <?php echo $_SESSION["user_id"] ?>,
          creditCardNumber: $("#number").val(),
          cvvNumber: $("#cvc").val(),
          expiryDate: $("#expiry").val(),
          fullName: $("#name").val(),
          amountPaid: <?php echo $total_cost ?>
        };
        console.log(data);
        
        $.ajax({
          method: "POST",
          url: "/auth/make_payment.php",
          data: data
        }).done(function(response){
          console.log(response);
          response = JSON.parse(response);
          if (response.status == "failed") {
            $(".stackable.grid.container").prepend(`
            <div class="ui small negative message hidden" style="width: 100%;">
              <div class="header">
                Failed Payment
              </div>
              <p>${response.message}</p>
            </div>
            `);
            $(".ui.small.negative.message").transition("fade");
          } else {
            $(".ui.small.negative.message").remove();
            $(".stackable.grid.container").prepend(`
              <div class="ui small success message hidden" style="width: 100%;">
                <div class="header">
                  Success
                </div>
                <p>We've successfully processed your order. You can view your orders <a href="/user/orders.php">here</a>.</p>
              </div>
              `);
              $(".ui.small.success.message").transition("fade");
          }
        })
      });

    })

    
    
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
    <div class="ui stackable grid container">
      <div class="row">
        <div class="eleven wide column">
          <div class="ui grid">
            <div class="sixteen wide column">
              <div class="ui card" style="width: 100%">
                <div class="content" style="background: #fafafa">
                  <div class="right floated meta" style="font-size: 11px;"></div>
                  <h3 style="margin-top: 0px;">MY CART (<?php echo $cart_count; ?> ITEMS)</h3>
                </div>
                <div class="ui grid" style="margin: 0">

                  <div class="sixteen wide column">

                    <div class="ui relaxed divided list">
                      <?php
                      foreach ($all_products as $product_row) {
                        echo '
                        <div class="item">
                          <img class="ui image" style="width: 100px; height: 100px; object-fit: cover;" src="' . $product_row["imgPath"] . '"/>
                          
                          <div class="content">
                            <a class="header">' . $product_row["productName"] . '</a>
                            <div class="description">Quantity: ' . $_SESSION["cart"][$product_row["id"]]["qty"] . '</div>
                            <div class="description"><b>Cost: $' . $_SESSION["cart"][$product_row["id"]]["cost"] . '</b></div>
                          </div>
                        </div>
                        ';
                      }
                      ?>
                    </div>
                  </div>
                </div>
                
              </div>
            </div>
          </div>

          <div class="ui grid">
            <div class="sixteen wide column">
              <div class="ui card" style="width: 100%">
                <div class="content">
                  <div class="right floated meta" style="font-size: 11px;"></div>
                  <h2 style="margin-top: 0px;">Frequently Asked Questions</h2>
                </div>
                <div class="ui grid" style="margin: 0">

                  <div class="sixteen wide column">
                    <h3 style="margin-bottom: 5px"><i class="shipping truck icon"></i>Free Shipping Eligibility</h3>
                    <span style="color: #818181; font-size: 12px;">Enjoy FREE normal shipping regardless of how much you spend.</span>

                    <h3 style="margin-bottom: 5px"><i class="redo icon"></i>Returns Policy</h3>
                    <span style="color: #818181; font-size: 12px;">Shopedia offers free and easy returns within 30 days of delivery – no questions asked!</span>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="five wide column">
          <div class="ui card" style="width: 100%">
            <div class="content" style="background: #fafafa">
              <div class="right floated meta" style="font-size: 11px;"></div>
              <h3 style="margin-top: 0px;">CHECKOUT</h3>
            </div>
            <div class="ui grid" style="margin: 0">
              <div class="sixteen wide column">
                <div class="ui very relaxed divided list">
                  <div class="item">
                    <div class="content">
                      <div class="description">SUBTOTAL: <span style="float: right">$<?php echo $total_cost; ?></span></div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="content">
                      <div class="description">SHIPPING: <span style="float: right">FREE</span></div>
                    </div>
                  </div>
                  <div class="item">
                    <div class="content">
                      <div class="header">GRAND TOTAL: <span style="float: right">$<?php echo $total_cost; ?></span></div>
                    </div>
                  </div>
                </div>

                <?php
                if (isset($_SESSION["cart"])){
                  echo '<button id="checkout-btn" class="ui teal button" style="width: 100%; margin-top: 20px;">
                    GO TO CHECKOUT
                  </button>';
                }
                
                ?>

              </div>

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




  <div class="ui basic modal">
    <i class="close icon"></i>
    <div class="header">
      Make Payment
    </div>
    <div class="image content">
      <div class="description">
        <div style="color: #fff;" class="ui header">Checkout securely here with your credit card.</div>
        <p class="ui header red color">NOTE: This checkout is actually not very secure</p>
        
        <div style="margin-top 20px; margin-bottom: 20px;" class="card-wrapper"></div>
        <form class="ui form">
          <div class="fields">
            <div class="sixteen wide field">
              <div class="two fields">
                <div id="number-field" class="field">
                  <input type="text" id="number" placeholder="#### #### #### ####">
                </div>
                <div id="name-field" class="field">
                  <input type="text" id="name" placeholder="Full Name"/>
                </div>
              </div>
              <!-- <input type="text" name="card[number]" > -->
            </div>
            <div class="sixteen wide field">
              <div class="two fields">
                <div id="expiry-field" class="field">
                  <input type="text" id="expiry" placeholder="MM/YY"/>
                </div>
                <div id="cvc-field" class="field">
                  <input type="text" id="cvc" maxlength="3" placeholder="CVC">
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="actions">
      <div class="ui black deny button">
        Nope
      </div>
      <div id="confirm-payment" class="ui positive right labeled icon button">
        Confirm
        <i class="checkmark icon"></i>
      </div>
    </div>
  </div>

  <?php include('./ui/footer.php'); ?>
</div>

</body>

</html>