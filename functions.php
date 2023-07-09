<?php
require_once("classes.php");

session_start();

if (!isset($_SESSION['user'])) {
  $_SESSION['user'] = new User();
}

$user = $_SESSION['user'];

if (isset($_POST['action'])) {
  $action = $_POST['action'];
  $params = $_POST;

  unset($params['action']);

  if (method_exists($user, $action)) {
    call_user_func_array([$user, $action], $params);
    echo "Action executed successfully.";
  } else {
    echo "Unknown action.";
  }
}
?>
