<?php
  require_once("classes.php");
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,400;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="Style.css">
  <title>Document</title>
</head>
<body class="home-page">
  <div class="nav">
  <form class="nav-left" action="webstore.php">
      <input type="submit" class="hidden-button" value="">
      <img src="assets/pgo-logo.webp" class="nav-logo">
      <span class="ttl">Web Store</span>
    </form>
    <div class="nav-mid">
    </div>
    <div class="nav-right">
      <button class ="coin-balance addcoin-button" style="position: relative;" onclick="toggleVisibility('.modal');">
        <p style="margin: 5px;">&#43</p>
        <p style="margin: 5px;"><?php echo $_SESSION['user']->getBalance();?></p>
        <img src="assets/PokeCoin.png" class="small-icon">
      </button>
      <button class="button gray" onclick="toggleVisibility('.profile-popup');"><?php echo $_SESSION['user']->getUname();?></button>
      <div class="profile-popup" style="visibility:hidden;">
        <form  action="profile.php" method="POST">
          <input class="gray" type="submit" value="Profile" style="border-radius: 0;">
        </form>
        <form action="webstore.php" method="POST">
          <input class="gray" type="submit" value="Sign out" name="signedOut" onclick="alert('This will reset your cart');">
        </form>
      </div>
    </div>
  </div>
  <div class="main" style="row-gap: 30px;">
    <h1 class="item-title">Order Review</h1>
    <div>
      <h3 style="color:rgb(15, 79, 90);"><?php echo $_SESSION['user']->getUname();?>'s Balance:</h3>
      <button class ="coin-balance addcoin-button" style="position: relative;" onclick="toggleVisibility('.modal');">
          <p style="margin: 5px;">&#43</p>
          <p style="margin: 5px;"><?php echo $_SESSION['user']->getBalance();?></p>
          <img src="assets/PokeCoin.png" class="small-icon">
      </button>
    </div>
    <div class="cart-grid"><?php
      if($_SESSION['user']->getCartCount() > 0){?>
        <div class="card-group"><?php
        foreach($_SESSION['user']->cart->items as $id){?>
          <div class="cart-card">
            <button class="remove" onclick="if(confirm('Remove item from cart?')){callPhp('removeFromCart',<?php echo $id?>)};">x</button>
            <img class="cartItem-img" src="<?php echo $raw_inventory[$id]['image'];?>">
            <div>
              <p><?php echo $raw_inventory[$id]['name'];?></p>
              <p>&#8369 <?php echo $raw_inventory[$id]['price'];?></p>
            </div>
          </div><?php
        }?>
        </div>
        <div style="display: flex; column-gap: 25px;">
          <button class="button gray" style="border: 1px solid rgba(3, 46, 85, 0.8);"
            onclick="if(confirm('Remove all items from cart?')){callPhp('removeAllFromCart')};">
            Remove all
          </button>
          <button class="button green" onclick="if(confirm('Checkout?')){callPhp('completeTransaction')};">
            Checkout
          </button>
        </div><?php
      }
      else{?>
        <h2 style="color:rgb(15, 79, 90);">
          Seems like your cart is empty
        </h2>
        <form action="webstore.php">
          <input type="submit" class="button green" value="Shop Items">
        </form><?php
      }?>
    </div>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="functions.js"></script>
</html>