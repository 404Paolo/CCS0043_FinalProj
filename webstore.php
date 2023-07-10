<?php
  require_once('classes.php');
  session_start();

  if(isset($_POST['signIn'])){
    unset($_POST['signIn']);
    $_SESSION['valid_user'] = signInUser($conn, $_POST);//Would return true if credentials are correct

    if(!$_SESSION['valid_user']){
      header('location: signIn.php');
    }
  }

  if(isset($_POST['signedOut'])){
    unset($_SESSION['user']);
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
      else{?>
        <form class ="coin-balance" style="position: relative;">
          <input type="submit" class="addcoin-button" value="">
          <img src="assets/coinplus_icon.png" class="small-icon" style="margin: 0;">
          <span><?php echo $_SESSION['user']['balance']?></span>
          <img src="assets/PokeCoin.png" class="small-icon">
        </form>
        <form action="cart.php">
          <input type="submit" class="button green" value="Go to cart" >
        </form>
        <form action="webstore.php" method="POST" onclick="confirm('Sign out?');">
          <input type="submit" class="button green" value="Sign out" name="signedOut">
        </form><?php
      }?>
    </div>
  </div>
  <div class="main store-grid"><?php
    foreach($inventory as $category=>$item)
    {?>
      <div class="item-section">
        <h1 class="item-title"><?php echo $category ?></h1>
        <div class="card-group"><?php
          foreach($item as $id)
          {?>
            <div class="card">
              <div class="card-head pink">
                <img class="item-img" src="<?php echo $raw_inventory[$id]["image"];?>">
              </div>
              <div class="card-body">
                <div class="item-info">
                  <div class="item-name"><?php echo $raw_inventory[$id]["name"];?></div>
                  <div class="item-desc"><?php echo $raw_inventory[$id]["description"];?></div>
                  <div class="item-price"><img src="assets/PokeCoin.png" class="small-icon"><?php echo $raw_inventory[$id]["price"] ?></div>
                  <div><?php
                    if(isset($_SESSION['user'])){?>
                      <button class="button green">Add to cart</button><?php
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
</div>
</body>
</html>