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
      <form class ="coin-balance" style="position: relative;">
        <input type="submit" class="addcoin-button" value="">
        <img src="assets/coinplus_icon.png" class="small-icon" style="margin: 0;">
        <span></span>
        <img src="assets/PokeCoin.png" class="small-icon">
      </form>
      <button class="button gray" onclick="profilePopup();">404Gohan</button>
      <div class="profile-popup" style="visibility:hidden;">
        <form  action="profile.php" method="POST">
          <input class="gray" type="submit" value="Profile" style="border-radius: 0;">
        </form>
        <form action="webstore.php" method="POST">
          <input class="gray" type="submit" value="Sign out" name="signedOut" onclick="confirm('Sign out?');">
        </form>
      </div>
    </div>
  </div>
  <div class="main" style="row-gap: 30px;">
    <h1 class="item-title">Order Review</h1>
    <div>
      <h3 style="color:rgb(15, 79, 90);">404Gohan's Balance:</h3>
      <form class ="coin-balance" style="position: relative; width: 100%;">
        <input type="submit" class="addcoin-button" value="">
        <img src="assets/coinplus_icon.png" class="small-icon" style="margin: 0;">
        <span>200.00</span>
        <img src="assets/PokeCoin.png" class="small-icon" style="margin-left: 10px">
      </form>
    </div>
    <div class="cart-grid">
      <div class="card-group">
        <div class="cart-card">
          <button class="remove" onclick="confirm('Remove item from cart?');">x</button>
          <img class="cartItem-img" src="assets/Beginner_Box.png">
          <div>
            <p>Beginner Box</p>
            <p>&#8369 290.00</p>
          </div>
        </div>
        <div class="cart-card">
          <button class="remove" onclick="confirm('Remove item from cart?');">x</button>
          <img class="cartItem-img" src="assets/Beginner_Box.png">
          <div>
            <p>Beginner Box</p>
            <p>&#8369 290.00</p>
          </div>
        </div>
        <div class="cart-card">
          <button class="remove" onclick="confirm('Remove item from cart?');">x</button>
          <img class="cartItem-img" src="assets/Beginner_Box.png">
          <div>
            <p>Beginner Box</p>
            <p>&#8369 290.00</p>
          </div>
        </div>
        <div class="cart-card">
          <button class="remove" onclick="confirm('Remove item from cart?');">x</button>
          <img class="cartItem-img" src="assets/Beginner_Box.png">
          <div>
            <p>Beginner Box</p>
            <p>&#8369 290.00</p>
          </div>
        </div>
        <div class="cart-card">
          <button class="remove" onclick="confirm('Remove item from cart?');">x</button>
          <img class="cartItem-img" src="assets/Beginner_Box.png">
          <div>
            <p>Beginner Box</p>
            <p>&#8369 290.00</p>
          </div>
        </div>
      </div>
      <div style="display: flex; column-gap: 25px;">
        <button class="button gray" style="border: 1px solid rgba(3, 46, 85, 0.8);">
          Go back
        </button>
        <button class="button green">
          Checkout
        </button>
      </div>
    </div>
  </div>
</body>
<script src="functions.js"></script>
</html>