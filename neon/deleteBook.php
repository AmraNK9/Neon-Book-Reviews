<?php
include_once 'controller/bookController.php';
include_once 'controller/categoryController.php';
$id=$_POST['id'];
$book_controller=new BookController();
$category_controller=new CategoryController();
echo $book_controller->deleteBook($id);
echo $category_controller->deleteCategory($id);
?>