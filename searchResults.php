<?php
require_once('classes.php');
session_start();
$search_string = $_GET['search_string'];
$items_found = searchItem($search_string);
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Style.css">
  <title>Document</title>
</head>

<body class="home-page">
  <div class="nav">
    <div class="nav-left">
      <img src="assets/pgo-logo.webp" class="nav-logo">
      <span class="ttl">Web Store</span>
    </div>
    <div class="nav-mid">
      <form action="searchResults.php" method="GET">
        <input type="search" class="searchbar" placeholder="Search" name="search_string" id="search_string"></input>
      </form>
    </div>
    <div class="nav-right">
      <button class="button green round"><img src="assets/Cart_icon.png" class="icon white"></button>
      <button class="button green">Log-in</button>
    </div>
  </div>
  <div class="main">
    <h1 class="item-title">
      <?php
        if(!$items_found){echo 'Sorry no items found with "'.$search_string.'"';}
        else{
          echo 'Results for "'.$search_string.'"';
      ?>
    </h1><?php
    foreach ($items_found as $category => $item) { ?>
      <div class="item-section">
        <h1 class="item-title">
          <?php echo $category ?>
        </h1>
        <div class="card-group">
          <?php
          foreach ($item as $id) { ?>
            <div class="card">
              <div class="card-head pink">
                <img class="item-img" src="<?php echo $raw_inventory[$id]["image"]; ?>">
              </div>
              <div class="card-body">
                <div class="item-info">
                  <div class="item-name">
                    <?php echo $raw_inventory[$id]["name"]; ?>
                  </div>
                  <div class="item-desc">
                    <?php echo $raw_inventory[$id]["description"]; ?>
                  </div>
                  <div class="item-price"><img src="assets/PokeCoin.png" class="coin">
                    <?php echo $raw_inventory[$id]["price"] ?>
                  </div>
                  <div><button class="button green">Add to cart</button></div>
                </div>
              </div>
            </div><?php
          } ?>
        </div>
      </div><?php
    }
  }?>
  </div>
</body>
</html>