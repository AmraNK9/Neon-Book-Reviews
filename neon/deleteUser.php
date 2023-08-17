<?php
include_once 'controller/userController.php';

$id=$_POST['id'];
$user_controller=new UserController();
echo $user_controller->deleteUser($id);
?>