<?php
include_once "../models/reviews.php";
$Review_model = new Reviews();
$user_id = $_POST['user_id'];
$review_id = $_POST['review_id'];
if (isset($_POST['method'])) {
    if ($_POST['method'] == "create") {
        if ($reviews_model->create_review_react($review_id, $user_id)) {
            echo "create Ok";
        }
    } else if ($_POST['method'] == "delete") {
        if ($reviews_model->delete_review_react($review_id, $user_id)) {
            echo "delete Ok";
        }
    }
}
?>