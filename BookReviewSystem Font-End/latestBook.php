<?php
include_once('../neon/controller/bookController.php');
$book_controller = new bookController();
$book_list = $book_controller->getAllBooks();
$book_list = array_reverse($book_list);

?>