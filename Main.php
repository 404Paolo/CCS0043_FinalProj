<?php
    require_once("classes.php");
    $user = new User();

    $user->addtoCart(1);
    $user->addtoCart(3);
    $user->addtoCart(5);
    $user->addtoCart(31);
    $user->displayCart();
    $user->displayInventory();

    $user->removefromCart(1);
    $user->removefromCart(3);
    $user->removefromCart(5);
    $user->removefromCart(31);
    $user->displayCart();
    $user->displayInventory();
?>
