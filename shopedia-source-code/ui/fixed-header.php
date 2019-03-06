<?php
  $cart_count = 0;
  $cart = NULL;

  // if (!isset($_SESSION['login_user'])) {
  //   header("Location: http://localhost/auth/login.php");
  //   var_dump($_SESSION);
  //   exit();
  // }

  if(isset($_SESSION["cart"]) and $_SESSION["cart"] != NULL) {
    $cart = $_SESSION["cart"];
    foreach ($cart as $key => $value) {
      $cart_count += $value["qty"];
    }
  }
?>

<div class="ui top fixed hidden menu" style="height: 140px;">
  <script>

  </script>
  <div class="ui container">
    <div class="item">
      <a href="/"><img src="/assets/images/shopedia-logo.png" style="width: 120px;"></a>
    </div>

    <div class="ui item category search search-bar" style="width: 50%; flex-direction: column; flex-flow: wrap;">
      <div class="ui icon input">
        <input id="search-bar-input-1" class="prompt" type="text" placeholder="Search in Shopedia">
        <i class="search icon"></i>
      </div>
      <div class="results"></div>
      <div style="overflow: hidden;">
        <div class="ui tag labels" style="display: flex;">
          <a class="ui label">
            Bags
          </a>
          <a class="ui label">
            Shoes
          </a>
          <a class="ui label">
            Phone Case
          </a>
          <a class="ui label">
            Crop Top
          </a>
          <a class="ui label">
            Hair Dye
          </a>
        </div>
      </div>
    </div>
    
    <div class="right menu">
      <div class="item">
        <?php
        if (!$_SESSION['login_user']) {
          echo '<a class="ui inverted button">Log in</a>
          <a class="ui inverted button">Sign Up</a>';
        }
        ?>

        <div class="ui dropdown link go-cart">
          <span class="text" style="display: inline-flex;">
            <?php echo '
            <div class="ui icon" style="margin: 0;">
            <a href="/view_cart.php" style="color: #fff;">
            <i style="font-size: 1.8em; cursor: pointer;" class="shopping cart icon"></i>
            </a>
            </div><i class="ui teal circular label cart-count" style="margin-left: 0px;">' . $cart_count . '</i>
            ' ?>
          </span>
          
          <div class="menu">
            <div class="header">MY CART (<?php echo $cart_count ?> ITEMS)</div>
            <div class="item">
              <i class="dropdown icon"></i>
              <span class="text">Clothing</span>
              <div class="menu">
                <div class="header">Mens</div>
                <div class="item">Shirts</div>
                <div class="item">Pants</div>
                <div class="item">Jeans</div>
                <div class="item">Shoes</div>
                <div class="divider"></div>
                <div class="header">Womens</div>
                <div class="item">Dresses</div>
                <div class="item">Shoes</div>
                <div class="item">Bags</div>
              </div>
            </div>
            <div class="item">
              <?php 
                if ($cart != NULL) {
                  foreach ($cart as $key => $value) {
                    echo '
                    <p>'. $value["qty"] . '</p>
                    ';
                    $cart_count += $value["qty"];
                  }
                }
              ?>
            </div>
            <div class="item">Bedroom</div>
            <div class="divider"></div>
            <div class="header">Order</div>
            <div class="item">Status</div>
            <div class="item">Cancellations</div>
          </div>
        </div>
      </div>
        
      </div>

      
      <!-- <div class="item">
        <a class="ui primary button">Sign Up</a>
      </div> -->
    </div>
  </div>
</div>