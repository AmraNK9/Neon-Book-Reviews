<?php
include_once __DIR__."/../models/auther.php";
class AutherController extends Auther{
    public function getAllAuthers(){
        return $this->getAutherList();
    }
    public function addNewAuther($name,$profile,$image){
        return $this->createNewAuther($name,$profile,$image);
    }
    public function getAuther($id){
        return $this->getAutherInfo($id);
    }
    public function updateAuther($cid,$name,$profile){
        return $this->updateAutherInfo($cid,$name,$profile);
    }
    public function deleteAuther($id){
        return $this->deleteAutherInfo($id);
    }
}

?>