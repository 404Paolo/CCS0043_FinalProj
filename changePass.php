<?php
  require_once("classes.php");
  session_start();
  if(isset($_POST['changedPass'])){
    unset($_POST['changedPass']);
    $message = $_SESSION['user']->changePass($_POST['pass'], $_POST['new_pass'], $_POST['cpass']);

    (strpos($message, 'success') !== false)? header('location: profile.php'): false;
  }
?>
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
  <h1 style="text-align: center;">
    Change password
  </h1>
  <div class="form-container">
    <h2 style="text-align: center; font-weight: bold; color: rgba(0, 0, 0, 0.6);"><?php echo $_SESSION['user']->getUName(); ?></h2>
    <form class="input-grid" action="profile.php" method="POST" style="grid-template-rows: repeat(2, 50px);">
      <input type="password" name="pass" id="pass" placeholder="Old Password" required>
      <input type="password" class="pass-input" name="new_pass" id="new_pass" placeholder="New password" required>
      <input type="password" class="pass-input" name="cpass" id="cpass" placeholder="Confirm New Password" required>
      <input type="submit" class="button green submit-pass" name="changedPass">
    </form>
  </div>
  <p class="alert pass-alert" style="visibility: hidden;">Password should be atleast 8 characters</p>
</body>
<script src="functions.js"></script>
<script>
  let passwordInput = document.querySelector(".pass-input");
  let submitPassword = document.querySelector(".submit-pass");
  let passwordAlert = document.querySelector(".pass-alert");

  passwordInput.addEventListener("input", function() {
      let password = passwordInput.value.trim();
      let isValid = /^.{8,}$/.test(password);
      
      if (isValid){
          submitPassword.disabled = false;
          submitPassword.style.opacity = "1";
          submitPassword.style.pointerEvents = "auto";
          passwordAlert.style.visibility = "hidden";
      }
      
      else{
          console.log('invalid');
          submitPassword.disabled = true;
          submitPassword.style.opacity = "0.5";
          submitPassword.style.pointerEvents = "none"; 
          passwordAlert.style.visibility = "";
      }
    });
</script>
</html>