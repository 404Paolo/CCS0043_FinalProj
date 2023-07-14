<?php
  require_once("classes.php");
  session_start();
  $user = $_SESSION['user'];
  $func = $_POST['functionName'];
  $param = $_POST['param'];

  if ($func == 'addToCart') {
    $user->addToCart($param);
    print('added');
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
    $user->completeTransaction();
    print('transacted');
  }

  elseif($func == 'completePayment') {
    $user->completePayment();
    print('paid');
  }

  else{
    print('Function not found');
  }
?>
