<?php
  require_once('classes.php');
  session_start();
  // $_SESSION['user'] = new User(1,'Goku1','test@gmail.com','404Gohan','404Gohan',10000,'00000000');
  $user = array("user_id"=>1, "user_name"=>"404_Paolo","pass"=>"00000000");
  signInUser($user);
  $transactions = $_SESSION['user']->getTransactions();
  print_r(gettype($transactions));

  $_SESSION['user']->addtoCart(29);
  $_SESSION['user']->addtoCart(30);
  $_SESSION['user']->addtoCart(31);
  $_SESSION['user']->addtoCart(32);
  print("\nCart array");
  // $_SESSION['user']->displayCart();
  // $_SESSION['user']->completeTransaction();


  foreach($transactions as $transaction){?>
    <div class="transaction-entry" style="text-align: left; display: grid; grid-template-columns: repeat(4, auto);">
        <div><?php
          $items = decryptCartId($transaction["cart_id"]);
          foreach($items as $id){
            print($raw_inventory[$id]['name']."<br>");
          }?>
        </div>
        <div><?php echo   $transaction["bill"]  ?></div>
        <div><?php echo $transaction["transaction_date"] ?></div>
    </div><?php
  }
?>