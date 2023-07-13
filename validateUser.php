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
<body class="sign-in-page" style="padding: 0; justify-content: center;">
    <div class="form-container">
        <h1 style="text-align: center;">Welcome!</h1>
        <form class="input-grid" action="webstore.php" method="POST">
            <input type="submit" class="button green" name="signIn" value="Start shopping">
        </form>
    </div>
</body>
<script src="functions.js"></script>
</html>