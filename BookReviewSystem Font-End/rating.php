<?php
session_start();
$user_id = $_SESSION['userid'] ;
$book_id = $_POST['book_id'] ;
include_once('../controllers/ratingController.php');

$rating_controller=new RatingController();
$rating=$rating_controller->viewRating($book_id,$user_id);
if (in_array($rating[0]['rating'], array(1, 2, 3, 4, 5))) {
    echo $rating[0]['rating'];
  } else {
    echo null;
  }
  
?>