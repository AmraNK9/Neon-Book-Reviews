<?php
include_once "../controllers/bookmarkController.php";
$user=$_POST['user_id'];
$book=$_POST['book_id'];
$bookmark_controller=new BookmarkController();
$result=$bookmark_controller->getAllBookmarks($user,$book);
if(!empty($result)){
    echo "have";
}else{
    echo "empty";
}
?>