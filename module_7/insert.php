<?php
    require_once('connection.php');
    if(isset($_POST['submit'])){
        // Get the values from the form
        //if( !isset($_FILES['image']['error']))
        $tmp_image = $_FILES['image']['name'];
        
        $idnum = $_POST['idnum'];
        $lname = $_POST['lname'];
        $fname = $_POST['fname'];
        
        // Check if the middle name is empty
        if(empty($_POST['mname'])){
            $mname = NULL;
        }else{
            $mname = $_POST['mname'];
        }
        $sex = $_POST['sex'];
        // Generate filename by concatenating the idnum and the image extension
        $image = $idnum . "." . pathinfo($tmp_image, PATHINFO_EXTENSION);

        // Create the SQL statement
        $query = "INSERT INTO tblstudent (img, idnum, lname, fname, mname, sex) VALUES ('$image', '$idnum', '$lname', '$fname', '$mname', '$sex')";

        // Execute the query
        $result = $conn->query($query);
        move_uploaded_file($_FILES['image']['tmp_name'], "images/" . $image);

        // Check if the query was successful
        if(!$result){
            die("Query failed: " . $conn->error);
        }else{
            // Redirect to index.php
            header("Location: index.php");
        }
    }
?>