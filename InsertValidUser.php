<?php
    //VALIDATION
    $invalid_input = 0;
    $pass = '';
    $cpass = '';

    if(isset($_POST['pass'])){
        $user = $_POST;
        $regex = array(
            "name" => "/^[a-zA-Z\s'-]+$/",
            "user_name" => "/^[a-zA-Z0-9#!\?\*_\s'-\.]+$/",
            "ign" => "/^[a-zA-Z0-9#!\?\*_\s'-\.]+$/",
            "pass" => "/^.{8,}$/",    
            "cpass" => "/^.{8,}$/",
            "email" => "/^[a-zZ-a0-9._]+@[a-zA-Z0-9.-]+[\.][a-zA-Z]{2,}$/",
        );

        $alert_message = "Invalid inputs for";
        foreach ($user as $key=>$value){
            if(!preg_match($regex[$key], $value)){
                $alert_message .= " -$key";
                $invalid_input += 1;
            }
        }

        //DATA INSERTION
        require_once('connection.php');
        $name = $_POST['name'];
        $user_name = $_POST['user_name'];
        $ign = $_POST['ign'];
        $pass = $_POST['pass'];
        $cpass = $_POST['cpass'];
        $email = $_POST['email'];

        if(!$invalid_input && $pass == $cpass){
            $query = "INSERT INTO users (name, user_name, ign, email, pass) VALUES ('$name', '$user_name', '$ign', '$email', '$pass')";

            $result = $conn->query($query);
        }
    }
?>