<?php 
    require_once('classes.php');
    session_start();

    if(!$_POST['user']){
        $is_signedIn = false;
        header('location: webstore.php');
    }

    else{
        $user = $_POST['user'];

        switch ($called_func){
            case 'addtoCart()':
                $user->addtoCart();
            break;
            case 'removefromCart()':
                $user->removefromCart();
            break;
            case 'completeTransaction()':
                $user->completeTransaction();
            break;
            default:
                return 'function not found';
            break;
        }
    }
?>