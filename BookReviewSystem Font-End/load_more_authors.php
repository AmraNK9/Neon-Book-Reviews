<?php
include_once "../controllers/registercontroller.php";
include_once "../controllers/authorController.php";

$getUserData=new RegisterController();
$getUserinfo=$getUserData->getUserList();

$getAllAuthorInfo=new authorController();
$getAllAuthor=$getAllAuthorInfo->getAllAuthorInfo();
// load_more_authors.php

// Assuming you have access to the necessary controllers and functions

// Get the offset and limit values from the AJAX request
$offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
$limit = isset($_POST['limit']) ? intval($_POST['limit']) : 4;

// Fetch more authors using the offset and limit values
$moreAuthors = $getAllAuthorInfo->getMoreAuthors($offset, $limit);

// Return the authors as JSON
echo json_encode($moreAuthors);
?>