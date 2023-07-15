<?php
  require_once("classes.php");
  session_start();
  $transactions = $_SESSION['user']->getTransactions();

  if(isset($_POST['changedPass'])){
    unset($_POST['changedPass']);
    $message = $_SESSION['user']->changePass($_POST['pass'], $_POST['new_pass'], $_POST['cpass']);

    $change_success = (strpos($message, 'success') !== false)? true: false;
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
    </div>
    <div class="nav-right">
      <button class="coin-balance addcoin-button" style="position: relative;" onclick="toggleVisibility('.modal');">
        <p style="margin: 5px;">&#43</p>
        <p style="margin: 5px;"><?php echo $_SESSION['user']->getBalance();?></p>
        <img src="assets/PokeCoin.png" class="small-icon">
      </button>
      <button class="button gray" onclick='toggleVisibility(".profile-popup")'><?php echo $_SESSION['user']->getUname();?></button>
      <div class="profile-popup" style="visibility:hidden;">
        <form action="" method="POST">
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
        <h2><?php echo $_SESSION['user']->getUname();?></h2>
        <h3 style="display: flex; align-items: center;">
          Balance:
          <img src="assets/PokeCoin.png" class="small-icon">
          <span style="font-size: 16px; margin: 10px 0px 8px 0px; color: gold;"><?php echo $_SESSION['user']->getBalance();?> PokeCoins</span>
        </h3>
        <h3>Full name: <span style="font-weight: 400;"><?php echo $_SESSION['user']->getName();?></span></h3>
        <h3>Player id: <span style="font-weight: 400;"><?php echo $_SESSION['user']->getIGN();?></span></h3>
        <h3>Email: <span style="font-weight: 400;"><?php echo $_SESSION['user']->getEmail();?></span></h3>
        <div style="display: grid; grid-template-columns: min-content min-content min-content; align-items: center;">
          <form action="webstore.php" method="POST" style="justify-content: flex-start;">
            <input type="submit" class="button gray" value="Sign out" name="signedOut" style="border: solid 1px;"  onclick="confirm('Sign out?');">
          </form>
          <form action="changePass.php" method="POST" style="justify-content: flex-start;">
            <input type="submit" class="button gray" value="Change password" style="border: solid 1px;">
          </form><?php
          if(isset($change_success)){?>
            <p class="<?php echo ($change_success)?'notif':'alert';?>">
              <?php echo $message;?>
            </p><?php
          }?>
        </div>
      </div>
      <div class="transaction-container">
        <h1 style="margin: 30px 0px 50px 0px">Order History</h1><?php
        if(!$transactions){?>
          <h3>No transactions yet</h3><?php
        }
        else{?>
          <div class="transaction-entry">
            <h4>Items</h4>
            <h4>Bill</h4>
            <h4>Date</h4>
          </div>
          <div class="transaction-rows"><?php
            krsort($transactions);
            foreach($transactions as $transaction){?>
              <div class="transaction-entry" style="align-items: center;">
                <div><?php
                  $items = decryptCartId($transaction["cart_id"]);
                  foreach($items as $id){
                    print($raw_inventory[$id]['name']."<br>");
                  }?>
                </div>
                <div><?php echo $transaction["bill"]?></div>
                <div><?php echo $transaction["transaction_date"]?></div>
              </div><?php
            }?>
          </div><?php
        }?>
      </div>
    </div>
  </div>
  <div class="footer">
  </div>
</body>
<script src="functions.js"></script>

</html>