<?php
  require_once('classes.php');
  $user = new User(1,'Goku1','test@gmail.com','404Gohan','404Gohan',10000,'00000000');

  echo "<pre>";
  $user->addtoCart(1);
  $user->addtoCart(2);
  $user->addtoCart(3);
  $user->addtoCart(4);
  $user->addtoCart(5);
  $user->completeTransaction();
  $user->displayTransactions();
  $user->addtoCart(6);
  $user->addtoCart(7);
  $user->addtoCart(8);
  $user->addtoCart(9);
  $user->addtoCart(15);
  $user->completeTransaction();
  $user->displayTransactions();
  $transactions = $user->getTransactions();

  foreach($transactions as $transaction){?>
    <div class="transaction-entry" style="text-align: left; display: grid; grid-template-columns: repeat(4, auto);">
        <div><?php echo $transaction->cart_id;  ?></div>
        <div><?php echo $transaction->bill;  ?></div>
        <div><?php echo $transaction->date; ?></div>
    </div><?php
  }

?>

<?php
  'foreach($transactions as $transaction){?>
    <div class="transaction-entry" style="text-align: left;">
      <div><?php echo $transaction->cart_id;  ?></div>
      <div><?php echo $transaction->bill;  ?></div>
      <div><?php echo $transaction->date; ?></div>
    </div><?php
  }'
?>