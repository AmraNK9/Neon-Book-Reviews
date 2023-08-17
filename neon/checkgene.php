<?php
include_once "../neon/controller/editorController.php";

$getSelectCategory=new EditorController();
$genere=$getSelectCategory->genreSingleFilter();
echo json_encode($genere)

?>