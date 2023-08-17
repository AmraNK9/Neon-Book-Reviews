<?php
include_once 'controller/autherController.php';

$id=$_POST['id'];
$auther_controller=new AutherController();
echo $auther_controller->deleteAuther($id);
?>