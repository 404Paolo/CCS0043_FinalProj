<?php
    require_once('connection.php');
    
    // Get the ID number from the URL
    $id = $_GET['id'];

    // Create the SQL statement
    $query = "SELECT * FROM tblstudent WHERE id = $id";

    // Execute the query
    $result = $conn->query($query);

    // Check if the query was successful
    if(!$result){
        die("Query failed: " . $conn->error);
    }else{
        // Fetch the result as an associative array
        $row = $result->fetch_assoc();
        // Extract the values from the associative array
        $idnum = $row['idnum'];
        $lname = $row['lname'];
        $fname = $row['fname'];
        if(empty($row['mname'])){
            $mname = NULL;
        }else{
            $mname = $row['mname'];
        }
        $sex = $row['sex'];
    }
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
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div>
            <label for="idnum">ID NUmber:</label>
            <input type="text" name="idnum" id="idnum" value="<?php echo $idnum;?>">
        </div>
        <div>
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname" value="<?php echo $lname;?>">
        </div>
        <div>
            <label for="fname">First Name:</label>
            <input type="text" name="fname" id="fname" value="<?php echo $fname;?>">
        </div>
        <div>
            <label for="mname">Middle Name:</label>
            <input type="text" name="mname" id="mname" value="<?php echo $mname;?>">
        </div>
        <div>
            <?php
                $male = '';
                $female = '';
                if($row['sex'] == 'Male'){
                    $male = 'checked';
                }else{
                    $female = 'checked';
                }
            ?>
            Sex:<br>
            <input type="radio" name="sex" id="sex_male" value="Male" <?php echo $male;?>>
            <labelfor="sex_male">Male</label>
            <input type="radio" name="sex" id="sex_female"  value="Female"  <?php echo $female;?>>
            <labelfor="sex_female">Female</label>
        </div>
        <div>
            <button type="submit" name="submit" id="submit">Submit</button>
            <a href="index.php">Cancel</a>
        </div>
    </form>
</body>
</html>