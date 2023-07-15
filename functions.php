<?php
  require_once("classes.php");
  session_start();
  $user = $_SESSION['user'];
  $func = $_POST['functionName'];
  $param = $_POST['param'];

  if ($func == 'addToCart') {
    $success = $user->addToCart($param);

    if($success){print((int)$raw_inventory[$param]['stock']);}
    else{print('not added');}
  }
  
  elseif ($func == 'removeFromCart') {
    $user->removeFromCart($param);
    print('removed');
  }

  elseif ($func == 'removeAllFromCart') {
    $user->removeAllFromCart($param);
    print('removedAll');
  }

  elseif ($func == 'completeTransaction') {
    $success = $user->completeTransaction();

    if($success){print('transacted');}
    else{print('not transacted');}
  }

  elseif($func == 'addCoin') {
    $success = $user->addCoin($param);

    if($success){print('coin added');}
    else{print('coin not added');}
  }

  elseif($func == 'completePayment') {
    $user->completePayment();
    print('paid');
  }

  else{
    print('Function not found');
  }
?>
