<?php
session_start();
include_once "../controllers/usercontroller.php";
$updateUserInfo = new UserController();
$user_email = $_SESSION['user_email'];
$user_image = $_POST['user_image'];

$result = $updateUserInfo->changeImage($user_image,$user_email);
echo $result;

if($result){
    echo "success";
}
else{
    echo "fail";
}
?>