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
  <div class="modal" style="visibility:hidden">
    <div class="coinshop-container">
      <button class="remove" onclick="toggleVisibility('.modal'); ">X</button>
      <div class="coin-group"><?php
        foreach($coin_inventory as $coin){?>
        <div class="coin-card">
          <div class="card-head">
            <div class="price">&#8369 <?php echo $coin['price'];?></div>
            <img class="coin-img" src="<?php echo $coin['image'];?>">
          </div>
          <div class="card-body">
            <div class="item-name">
              <?php echo $coin['name'];?>:
              <p style="margin-left:10px;"><?php echo $coin['value'];?></p>
              <img src="assets/PokeCoin.png" class="small-icon" style="margin-left: 5px">
            </div>
            <button class="button">
              Buy
            </button>
          </div>
        </div><?php
        }?>
      </div>
      <div class="payment-grid">
        <h1 style="text-align: center; border-bottom: 1px solid rgba(0,0,0,0.2);
        padding-bottom: 20px;">Payment</h1>
      </div>
    </div>
  </div>
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
        <button class ="coin-balance addcoin-button" style="position: relative;" onclick="toggleVisibility('.modal');">
          <p style="margin: 5px;">&#43</p>
          <p style="margin: 5px;">200.00</p>
          <img src="assets/PokeCoin.png" class="small-icon">
        </button>
        <button class="button gray" onclick="toggleVisibility('.profile-popup');">404Gohan</button>
        <div class="profile-popup" style="visibility:hidden;">
          <form  action="profile.php" method="POST">
            <input class="gray" type="submit" value="Profile" style="border-radius: 0;">
          </form>
          <form action="webstore.php" method="POST">
            <input class="gray" type="submit" value="Sign out" name="signedOut" onclick="confirm('Sign out?');">
          </form>
        </div>
        <form action="cart.php">
          <input type="submit" class="button green" value="Go to cart" >
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
                <div class="item-price"><?php
                  if($category != "Boxes"){?>
                    <img src="assets/PokeCoin.png" class="small-icon"><?php
                  }
                  else{?>
                    <p style="margin: 5px; padding-top: 2px;">&#8369 </p><?php
                  } 
                  echo $raw_inventory[$id]["price"]?>
                </div>
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
<script src="functions.js"></script>
</html>