<?php
    require_once('connection.php');

    // Create query
    $query = "SELECT * FROM tblstudent";

    // Execute query
    $result = $conn->query($query);
    echo "<pre>";
    var_dump($result);
    echo "</pre>";
    die();

    // Check if query is successful
    if(!$result) {
        die("Query failed: " . $conn->error);
    }else{
        // Convert query result to array
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    }

    $records = $result->num_rows;
    // echo "<pre>";
    // var_dump($rows);
    // echo "</pre>";
    // die();
?>