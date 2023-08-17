<?php
include_once __DIR__."/../models/editorchoice.php";

class EditorController extends Editor{
    public function genreSingleFilter(){
        return $this->gnereFliter();
    }

    public function genreSingle($id){
        return $this->genere($id);
    }
    public function deleteCategory($bookid){
        return $this->delete_category($bookid);
    }

    public function getUserSelectCategory($value){
        return $this->getBookCateGory($value);
    }

    public function insetBooks($book_id){
        return $this->insetBook($book_id);
    }

    public function getAllEditorChoice(){
        return $this->getEditorChoice();
    }
}






?>