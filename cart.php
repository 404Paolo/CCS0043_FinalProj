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
      <div class="coin-balance" ><img src="assets/PokeCoin.png" class="small-icon">100000 Coins</div>
      <button class="button gray" onclick="profilePopup();">404Gohan</button>
      <div class="profile-popup" style="visibility:hidden;">
        <form  action="" method="POST">
          <input class="gray" type="submit" value="Profile" style="border-radius: 0;">
        </form>
        <form action="webstore.php" method="POST">
          <input class="gray" type="submit" action="signIn.php" value="Sign out" name="signout">
        </form>
      </div>
    </div>
  </div>
  <div class="main cart-grid">
    <h1 class="item-title">Order Review</h1>
    <div class="cart-card">
      <img class="cartItem-img" src="assets/Beginner_Box.png">
      <p>Beginner Box</p>
      <p>&#8369 290.00</p>
    </div>
    <div class="cart-card">
      <img class="cartItem-img" src="assets/Beginner_Box.png">
      <p>Beginner Box</p>
      <p>&#8369 290.00</p>
    </div>
    <div class="cart-card">
      <img class="cartItem-img" src="assets/Beginner_Box.png">
      <p>Beginner Box</p>
      <p>&#8369 290.00</p>
    </div>
  </div>
</body>
<script src="functions.js"></script>
</html>