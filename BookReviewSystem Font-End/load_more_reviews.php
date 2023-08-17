<?php
include_once "../controllers/reviewsController.php";
include_once "../models/reviews.php";
$review_controller = new Reviews_Controller();
if (isset($_POST['offset']) && isset($_POST['limit'])) {
    $offset = $_POST['offset'];
    $limit = $_POST['limit'];
    $result = $review_controller->Get_Post($limit,$offset);
    echo json_encode($result);
}