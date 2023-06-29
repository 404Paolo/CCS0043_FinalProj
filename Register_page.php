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
<body style="width: 25%;">
<form action="Login_page.php" method="POST">
    <h3 style="text-align: center;">My Personal Information</h1><br>
    <div class="form-group">
        <label for="name" >Full Name: </label>
        <input type="text" name="name" id="name" required></div>
    <div class="form-group">
        <label for="user_name" >User Name: </label>
        <input type="text" name="user_name" id="user_name" required></div>
    <div class="form-group">
        <label for="ign" >In-Game Name: </label>
        <input type="text" name="ign" id="ign" required></div>
    <div class="form-group">
        <label for="pass" >Password: </label>
        <input type="password" name="pass" id="pass" placeholder="atleast 8 chars long"></div>
    <div class="form-group">
        <label for="cpass" >Confirm password: </label>
        <input type="password" name="cpass" id="cpass" required></div>
    <div class="form-group">
        <label for="email" >Email:</label>
        <input type="text" name="email" id="email"  required></div>
    <div style="text-align:center;"><br>
        <input type="submit">
    </div>
</form>
</body>
</html>