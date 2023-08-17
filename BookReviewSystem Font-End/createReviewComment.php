<?php 
include_once "../controllers/reviewsController.php";
include_once "../models/reviews.php";
include_once __DIR__."/../models/register.php";

$register_model = new CreateUser();
$userId = $register_model->getUserId($_SESSION['user_email']);
if(isset($_POST['review']) && $_POST['comment']){
    $result = $reviews_model->create_comment($_POST['review'],$userId[0]['id'],$_POST['comment']);
    echo $result;
}
?>