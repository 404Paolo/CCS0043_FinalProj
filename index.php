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
  <title>Russel Westbrook</title>
</head>
<body class="home-page">
  <div class="nav">
    <form class="nav-left webstore" action="index.php">
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
        <form action="coinshop.php" class ="coin-balance" style="position: relative;padding-left: 10px;">
          <p style="margin: 5px;">&#43</p>
          <p style="margin: 5px;"><?php echo $_SESSION['user']->getBalance();?></p> 
          <img src="assets/PokeCoin.png" class="small-icon">
          <input type="submit" class="addcoin-button" value="">
        </form>
        <button class="button gray" onclick="toggleVisibility('.profile-popup');"><?php echo $_SESSION['user']->getUname();?></button>
        <div class="profile-popup" style="visibility:hidden;">
          <form  action="profile.php" method="POST">
            <input class="gray" type="submit" value="Profile" style="border-radius: 0;">
          </form>
          <form action="index.php" method="POST">
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
  <div class="footer">
    <h4 style="margin-top: 40px;">This webstore is a project built for educational purposes only and is not affiliated with or endorsed by Pokémon GO or its creators Niantic.</h4>
    <h4>All Pokémon GO assets, including images and trademarks, are the property of their respective owners.</h4>
    <h4>This webstore does not claim ownership of any Pokémon GO assets used. </h4>
    <h4>A submission by: Christian Paolo M. Reyes [Group: Russel Westbrook] </h4>
  </div>
</body>
<script src="functions.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  let cartCount = <?php echo (isset($_SESSION['user']))? $_SESSION['user']->getCartCount(): 0; ?>
</script>
</html>