<?php
    require_once('classes.php');
    $user1 = new User(0,'Goku1','test@gmail.com','404Gohan','404Gohan',10000,'00000000');

    $user1->addtoCart(32);
    $user1->addtoCart(32);
    $user1->addtoCart(32);
    $user1->displayCart();
    $user1->completeTransaction();
    $user1->displayTransactions();
    $user1->displayCart();
    $user1->displayInventory();
?>