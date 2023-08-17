<?php
include_once __DIR__."/../models/category.php";
class CategoryController extends Category{
    public function getAllCategory(){
        return $this->getCategoryList();
    }

    public function getUserSelectCategory($value){
        return $this->getBookCateGory($value);
    }
    public function addNewCategory($book_id,$category_id){
        return $this->createNewCategory($book_id,$category_id);
    }
    public function getCategory($id){
        return $this->getCategoryInfo($id);
    }
    // public function updateAuther($cid,$name,$profile){
    //     return $this->updateAutherInfo($cid,$name,$profile);
    // }
    public function deleteCategory($id){
        return $this->deleteCategoryInfo($id);
    }
}

?>