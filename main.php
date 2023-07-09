<?php
    require_once('classes.php');
    $user1 = new User(0,'Goku1','test@gmail.com','404Gohan','404Gohan',
    '00000000');
    $transaction = new Transaction($user1->getId());
    $transaction->cart_id = $user1->generateCartId();
    $transaction->date = date("Y-m-d H:i:s");
    
?>