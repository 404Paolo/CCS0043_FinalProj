<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px #ccc;
            background-color: #fff;
        }

        .form-group {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: left;
        }

        input{
            margin-bottom: 5px;
            text-align: center;
            border: 1px solid #cccc;
            border-radius: 5px;
        }
    </style>
</head>
<body style="width: 20%;">
<?php
    session_start();
    require_once('InsertValidUser.php');
    if(isset($_SESSION['user'])): ?>
        <div class="alert alert-primary">
            <b>Already logged in as <?php echo $_SESSION['user'];?></b>
        </div>
        <div>
            <a href="Logout.php" class="btn btn-secondary btr-hover btn-block">Log out</a>
            <a href="Userinfo_page.php" class="btn btn-primary btr-hover btn-block">See user info</a>
        </div><?php 
    elseif($invalid_input): ?>
        <div style="text-align: center;" class="alert alert-danger">
            <b>User not added to database</b><br>
            <?php echo $alert_message?>
        </div>
        <div>
            <form action="Register.php">
                <input type="submit" value="Input again" class="btn btn-secondary btn-hover" style="width:100%">
            </form>
        </div><?php 
    elseif($pass != $cpass):  ?>
        <div style="text-align: center;" class="alert alert-danger">
            <b>Password confirmation failed, user not registered</b><br>
        </div>
        <div>
            <form action="Register.php">
                <input type="submit" value="Input again" class="btn btn-secondary btn-hover" style="width:100%">
            </form>
        </div><?php
    else: ?>
    <form action="Userinfo_page.php" method="POST">
        <h3 style="text-align: center;">Log-in form</h1><br>
        <div class="form-group">
            <label for="uname" >User Name: </label>
            <input type="text" name="uname" id="uname" required>
        </div>
        <div class="form-group">
            <label for="pass" >Password: </label>
            <input type="password" name="pass" id="pass" required>
        </div>
        <div style="text-align:center;"><br>
            <input type="submit">
        </div>
    </form><?php 
    endif;
?>
</body>
</html>