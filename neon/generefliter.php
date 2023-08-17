<?php
include_once "../neon/controller/editorController.php";
// $id=$_POST['value'];
// $genereAll=new editorController();
// $genere=$genereAll->genreSingleFilter($id);
$getSelectCategory=new EditorController();
$value=$_POST['value'];
$getCategory=$getSelectCategory->getUserSelectCategory($value);
//echo $getCategory;

echo json_encode($getCategory);

//echo json_encode($genere)

?>
