<?php
    require_once('connection.php');
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $query = "DELETE FROM tblstudent WHERE id=$id";
        $result = $conn->query($query);
        if(!$result){
            die("Query failed: " . $conn->error);
        }else{
            header("Location: index.php");
        }
    }
?>