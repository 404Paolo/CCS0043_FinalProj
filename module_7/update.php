<?php
    require_once('connection.php');
    if(isset($_POST['submit'])){
        // Get the values from the form
        $id = $_POST['id'];
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

        // Create the SQL statement
        $query = "UPDATE tblstudent SET idnum='$idnum', lname='$lname', fname='$fname', mname='$mname', sex='$sex' WHERE id=$id";

        // echo "<pre>";
        // var_dump($query);
        // echo "</pre>";
        // die();

        // Execute the query
        $result = $conn->query($query);

        // Check if the query was successful
        if(!$result){
            die("Query failed: " . $conn->error);
        }else{
            // Redirect to index.php
            header("Location: index.php");
        }
    }
?>