<?php
include_once "../neon/controller/bookController.php";
include_once "../models/reviews.php";

$review_model = new Reviews();
$getbooks=new BookController();

$offset=$_POST['offset'];
$limit=$_POST['limit'];

$getBalanceBook=$getbooks->getBalanceBook($offset,$limit);
// var_dump($getBalanceBook);
$result = [];
foreach($getBalanceBook as $book){
    // var_dump($book);
    $auther_name = $review_model->get_author_by_id($book['auther_id']);
    if($auther_name){
        // var_dump($auther_name['name']);
        $auther_name_arr = array("auther_name"=>$auther_name['name']);
        $book+= $auther_name_arr;
    }else{
        $auther_name_arr = array("auther_name"=>"Anonymous");
        $book+= $auther_name_arr;
    }
 
    $result[] = $book;
}
echo json_encode($result);

?>