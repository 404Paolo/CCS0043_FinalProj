<?php
  require_once('classes.php');
  session_start();
  $user = array("user_name"=>"404_Paolo", "pass"=>"00000000");
  signInUser($user);

  $_SESSION['user']->coin_cart->items;
  $_SESSION['user']->addCoin(3);
  $_SESSION['user']->addCoin(3);
  $_SESSION['user']->addCoin(3);
  echo "<pre>";
  print_r(count($_SESSION['user']->coin_cart->items));
  echo "</pre>";
?>