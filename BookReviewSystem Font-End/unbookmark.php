<?php
include_once "../controllers/bookmarkController.php";
$user=$_POST['user_id'];
$book=$_POST['book_id'];
$bookmark_controller=new BookmarkController();
$bookmark_controller->deleteBookmark($user,$book);
echo "empty";
?>