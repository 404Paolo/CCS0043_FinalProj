<?php
    require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Student Profile</title>
    <style>
        a{
            display: block;
            border: 1px solid black;
            border-radius: 5px;
            padding: 5px;
            padding-top: 15px;
            height: 30px;
            width: 200px;
            text-align: center;
            text-decoration: none;
            margin: 5px;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <form action="insert.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="idnum">ID NUmber:</label>
            <input type="text" name="idnum" id="idnum">
        </div>
        <div>
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname">
        </div>
        <div>
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname">
        </div>
        <div>
            <label for="mname">Middle Name:</label>
            <input type="text" name="mname" id="mname">
        </div>
        <div>
            Sex:<br>
            <input type="radio" name="sex" id="sex_male" value="Male">
            <labelfor="sex_male">Male</label>
            <input type="radio" name="sex" id="sex_female"  value="Female">
            <labelfor="sex_female">Female</label>
        </div>
        <div>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image">
        </div>
        <div>
            <button type="submit" name="submit" id="submit">Submit</button>
            <a href="index.php">Cancel</a>
        </div>
    </form>
</body>
</html>