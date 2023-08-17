<?php
include_once "controller/bookController.php";
$id=$_POST['id'];
$book_controller=new bookController();
$book=$book_controller->getBook($id);
echo $book['pdf_file'];


?>
