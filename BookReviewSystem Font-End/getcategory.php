<?php
include_once "../neon/controller/categoryController.php";
include_once "../models/reviews.php";

$review_model = new Reviews();
$getSelectCategory=new CategoryController();
$value=$_POST['value'];
$getCategory=$getSelectCategory->getUserSelectCategory($value);

$result = [];
foreach($getCategory as $book){
     //var_dump($book);
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
//var_dump($getCategory);
//echo $getCategory;

echo json_encode($result);

?>