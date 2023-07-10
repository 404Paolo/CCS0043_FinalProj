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
        <form  action="" method="POST">
          <input class="gray" type="submit" value="Profile" style="border-radius: 0;">
        </form>
        <form action="webstore.php" method="POST">
          <input class="gray" type="submit" value="Sign out" name="signedOut" onclick="confirm('Sign out?');">
        </form>
      </div>
    </div>
  </div>
  <div class="main">
    <div class="profile-grid" style="color:rgb(15, 79, 90)">
        <div class="user-info">
            <h2>404Gohan</h2>
            <h3 style="display: flex; align-items: center;">
                Balance:
                <img src="assets/PokeCoin.png" class="small-icon">
                <span style="font-size: 16px; margin: 10px 0px 8px 0px;">200 PokeCoins</span>
            </h3>
            <form action="webstore.php" method="POST" style="justify-content: flex-start;"
                onclick="confirm('Sign out?');">
                <input type="submit" class="button gray" value="Sign out" name="signedOut" 
                    style="border: solid 1px;">
            </form>
        </div>
        <div class="transaction-container">
            <h1 style="margin: 30px 0px 50px 0px">Order History</h1>
            <div class="transaction-entry">
                <h4>Date</h4>
                <h4>Items</h4>
                <h4>Transaction ID</h4>
                <h4>Total</h4>
            </div>
            <div class="transaction-rows" >
                <div class="transaction-entry" style="text-align: left;">
                    <div>test</div>
                    <div>test</div>
                    <div>test</div>
                    <div>test</div>
                </div>
            </div>
        </div>
    </div>
  </div>
  <div class="footer">
  </div>
</body>
<script src="functions.js"></script>
</html>