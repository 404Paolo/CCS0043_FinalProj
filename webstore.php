<?php
  require_once('classes.php');
  session_start();

  if(isset($_POST['signIn'])){
    unset($_POST['signIn']);
    $_SESSION['valid_user'] = signInUser($_POST);

    if(!$_SESSION['valid_user']){
      header('location: signIn.php');
    }
  }

  if(isset($_POST['signedOut'])){
    unset($_SESSION['user']);
    unset($_SESSION['valid_user']);
    unset($_POST['signedOut']);
  }
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
  <title>Webstore</title>
</head>
<body class="home-page">
  <div class="nav">
    <form class="nav-left" action="webstore.php">
      <input type="submit" class="hidden-button" value="">
      <img src="assets/pgo-logo.webp" class="nav-logo">
      <span class="ttl">Web Store</span>
    </form>
    <div class="nav-mid">
      <form action="searchResults.php" method="GET">
        <input type="search" class="searchbar" placeholder="Search" name="search_string" id="search_string"></input>
      </form>
    </div>
    <div class="nav-right">
      <?php
      if(!isset($_SESSION['user'])){
        ?>
        <form action="signIn.php">
          <input type="submit" class="button green" value="Sign-In" name="signIn">
        </form><?php
      }
      else{
        ?>
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
            <input class="gray" type="submit" value="Sign out" name="signedOut" onclick="alert('This will remove all items in your cart');">
          </form>
        </div>
        <form action="cart.php">
          <input type="submit" class="button green" value="Go to cart" >
          <span id="cartCount" class="cart-count"><?php echo $_SESSION['user']->getCartCount(); ?></span>
        </form><?php
      }?>
    </div>
  </div>
  <div class="main store-grid"><?php
    foreach($inventory as $category=>$item){?>
      <div class="item-section">
        <h1 class="item-title"><?php echo $category ?></h1>
        <div class="card-group"><?php
        foreach($item as $id){?>
          <div class="card">
            <div class="card-head pink">
              <img class="item-img" src="<?php echo $raw_inventory[$id]["image"];?>">
            </div>
            <div class="card-body">
              <div class="item-info">
                <div class="item-name"><?php echo $raw_inventory[$id]["name"];?></div>
                <div class="item-desc"><?php echo $raw_inventory[$id]["description"];?></div>
                <div class="item-price">
                  <img src="assets/PokeCoin.png" class="small-icon"><?php
                  echo $raw_inventory[$id]["price"]?>
                </div>
                <div><?php
                  if(isset($_SESSION['user'])){?>
                    <button class="button green" onclick="callPhp('addToCart',<?php echo $id?>);">
                      Add to cart
                    </button><?php
                  }
                  else{?>
                    <form action="signIn.php">
                      <input type="submit" class="button green" value="Sign-In To Purchase" name="signIn">
                    </form><?php
                  }?>
                </div>
              </div>
            </div>
          </div><?php
        }?>
        </div>
      </div><?php
    }?>
  </div>
  <div class="modal" style="visibility: ;">
    <div class="coinshop-container">
      <button class="remove" onclick="toggleVisibility('.modal'); ">X</button>
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
              <div class="item-name" style="color: rgba(15, 79, 90, 0.7);">
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
          </div>
          <?php
        } ?>
      </div>
      <div class="payment-grid">
        <h1 style="text-align: center; border-bottom: 1px solid rgba(0,0,0,0.2);
          padding-bottom: 20px;">Payment</h1>
        <div class="payment-body">
          <h1>
            <?php echo $_SESSION['user']->getName(); ?>
          </h1>
          <h4>User name: <span style="font-weight: 400;">
              <?php echo $_SESSION['user']->getUName(); ?>
            </span></h2>
            <h4>Player id: <span style="font-weight: 400;">
                <?php echo $_SESSION['user']->getIGN(); ?>
              </span></h4>
            <h4>Email: <span style="font-weight: 400;">
                <?php echo $_SESSION['user']->getEmail(); ?>
              </span></h4>
            <div class="payment-computation">
            </div>
            <div class="input-grid" style="align-content: center; justify-content: center;">
              <input class="gcash-number" type="text" placeholder="Gcash number ex. 09#########" style="margin: 0;" >
              <div class="payment-buttons">
                <button type="text" class="button gray" style="border: solid 1px; width: 49%;"
                  onclick="toggleVisibility('.modal');">
                  Cancel
                </button>
                <button type="text" class="button green pay-button" style="width: 49%; pointer-events: none; opacity: 0.5;" disabled="true";
                  onclick="if(confirm('Proceed with checkout?')){}">
                  <img src="assets/GCash-Logo.png" class="small icon" style="margin-right: 5px;">
                  &#8369 300
                </button>
              </div>
            </div>
        </div>
        <div class="coin-balance">
          <h1 style="margin: 5px;">
            <?php echo $_SESSION['user']->getBalance(); ?> Pokecoins<h1>
              <img src="assets/PokeCoin.png" class="small-icon">
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
  </div>
</body>
<script src="functions.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  let cartCount = <?php echo (isset($_SESSION['user']))? $_SESSION['user']->getCartCount(): 0; ?>
</script>
</html>