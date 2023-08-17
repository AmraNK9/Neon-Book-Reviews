<?php
session_start();
$user_id = $_SESSION['userid'] ;
$book_id = $_POST['book_id'] ;
$rating = $_POST['rating'] ;
include_once('../controllers/ratingController.php');

$rating_controller=new RatingController();
$rating_controller->deleteRating($book_id,$user_id);
$rating_controller->addNewRating($user_id,$book_id,$rating);
$rating=$rating_controller->viewRating($book_id,$user_id);
echo $rating[0]['rating'];
?>