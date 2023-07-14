<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,400;1,400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="Style.css">
  <title>Sign In</title>
</head>
<body class="sign-in-page">
    <h1 style="text-align: center;">Sign in</h1>
    <div class="form-container">
        <div class="sign-in-header">
            <button style="border-right: 1px solid rgba(0,0,0,0.1);"
                onclick="displayLogIn();">
                Log-in
            </button>
            <button style="color: rgba(0,0,0,0.2);" onclick="displayRegister();">
                Register
            </button>
        </div>
        <form class="input-grid" action="webstore.php" method="POST" style="grid-template-rows: repeat(2, 50px);">
            <input type="text" name="user_name" id="user_name" placeholder="User name" required>
            <input type="password" name="pass" id="pass" placeholder="Password" required>
            <input type="submit" class="button green" name="signIn">
        </form>
    </div><?php
    if(isset($_SESSION['valid_user']) && $_SESSION['valid_user'] == false){
        unset($_SESSION['valid_user']);?>
        <p class="alert">Sorry invalid credentials</p><?php
    }?>
</body>
<script src="functions.js"></script>
</html>