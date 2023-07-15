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
<body class="home-page" style="position: relative; padding-bottom: 400px; padding-top: 170px">
  <div class="nav">
  <form class="nav-left" action="index.php">
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
        <form action="index.php" method="POST">
          <input class="gray" type="submit" value="Sign out" name="signedOut" onclick="alert('This will reset your cart');">
        </form>
      </div>
    </div>
  </div>
  <div class="main" style="row-gap: 30px;">
    <h1 class="ttl">
      Coin shop
    </h1>
    <div class="coinshop-container">  
      <div class="coin-group">
        <?php
        foreach ($coin_inventory as $coin) { ?>
          <div class="coin-card">
            <div class="card-head">
              <div class="price">&#8369
                <?php echo $coin['price']; ?>
              </div>
              <img class="coin-img" src="<?php echo $coin['image']; ?>">
            </div>
            <div class="card-body">
              <div class="item-name" style="color: rgba(15, 79, 90, 0.7); font-size: 14px;">
                <?php echo $coin['name']; ?>:
                <p style="margin-left:10px;">
                  <?php echo $coin['value']; ?>
                </p>
                <img src="assets/PokeCoin.png" class="small-icon" style="margin-left: 5px">
              </div>
              <button class="button" onclick="callPhp('addCoin',<?php echo $coin['id']?>)">
                Buy
              </button>
            </div>
          </div><?php
        } ?>
      </div>
      <div class="payment-grid">
        <h1 style="text-align: center; border-bottom: 1px solid rgba(0,0,0,0.2); padding-bottom: 20px;">
          Payment
        </h1>
        <div class="payment-body">
          <h1>
            <?php echo $_SESSION['user']->getName(); ?>
          </h1>
          <h4>User name: <span style="font-weight: 400;">
              <?php echo $_SESSION['user']->getUName(); ?>
          </span></h2>
          <h4>Player id: <span style="font-weight: 400;">
              <?php echo $_SESSION['user']->getIGN(); ?>
            </span>
          </h4>
          <h4>Email: <span style="font-weight: 400;">
              <?php echo $_SESSION['user']->getEmail(); ?>
            </span>
          </h4><?php 
          $coins = $_SESSION['user']->coin_cart->items;
          $totalPesos = $_SESSION['user']->coin_cart->total;
          if(!count($coins)){?>
            <h3 style="text-align: center; margin-top: 20px;">
              No coins added yet.
            </h3>
            <form action="index.php" style="justify-content: center;">
              <input type="submit" class="button gray" value="Go back" style="border: solid 1px; width: 49%;">
            </form>
            <?php
          }

          else{?>          
            <div class="payment-computation"><?php
              $totalPokecoins = 0;
              foreach($coins as $coin){?>
                <div class="payment-entry">
                  <h5><?php echo $coin['name'];?></h5>
                  <h5 style="font-weight: 400;"><?php echo $coin['value']." Pokecoins";?></h5> 
                  <h5 style="font-weight: 400;"><?php echo "&#8369 ".$coin['price'];?></h5> 
                </div><?php
                $totalPokecoins += $coin['value'];
              }?>
              <div class="payment-entry">
                <h4>Total</h4>
                <h4><?php echo $totalPokecoins." Pokecoins";?></h4> 
                <h4><?php echo "&#8369 ".$totalPesos; ?></h4> 
              </div>
            </div>
            <div class="input-grid" style="align-content: center; justify-content: center;">
              <input class="gcash-number" type="text" placeholder="Gcash number ex. 09#########" style="margin: 0;" >
              <div class="payment-buttons">
                <button type="text" class="button gray" style="border: solid 1px; width: 49%;" >
                  Go back
                </button>
                <button type="text" class="button green pay-button" style="width: 49%; pointer-events: none; opacity: 0.5;" disabled="true";
                  onclick="if(confirm('Proceed with checkout?')){callPhp('completePayment');}">
                  <img src="assets/GCash-Logo.png" class="small icon" style="margin-right: 5px;">
                  &#8369 <?php echo $totalPesos;?>
                </button>
              </div>
            </div><?php
          }?>
        </div>
        <div class="coin-balance">
          <h1 style="margin: 5px;">
            <?php echo $_SESSION['user']->getBalance(); ?> Pokecoins<h1>
            <img src="assets/PokeCoin.png" class="small-icon">
          </h1>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="footer">
  <h4 style="margin-top: 40px;">This webstore is a project built for educational purposes only and is not affiliated with or endorsed by Pokémon GO or its creators Niantic.</h4>
  <h4>All Pokémon GO assets, including images and trademarks, are the property of their respective owners.</h4>
  <h4>This webstore does not claim ownership of any Pokémon GO assets used. </h4>
</div>
</body>
<script src="functions.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  let gcashInput = document.querySelector(".gcash-number");
  let payButton = document.querySelector(".pay-button");

  gcashInput.addEventListener("input", function() {
      let gcashNumber = gcashInput.value.trim();
      let isValid = /^09\d{9}$/.test(gcashNumber);
      
      if (isValid){
          payButton.disabled = false;
          payButton.style.opacity = "1";
          payButton.style.pointerEvents = "auto";
      }
      
      else{
          payButton.disabled = true;
          payButton.style.opacity = "0.5";
          payButton.style.pointerEvents = "none"; 
      }
  });
</script>
</html>