<?php
include_once __DIR__."/../models/comment.php";
class CommentController extends Comment{
    public function getAllComments($id){
        return $this->getCommentList($id);
    }
    public function addNewComment($comment,$user_id,$cid){
        return $this->createNewComment($comment,$user_id,$cid);
    }
    // public function getBook($id){
    //     return $this->getBookInfo($id);
    // }
    // public function updateBook($cid,$name,$category,$auther,$image,$pdf,$date){
    //     return $this->updateBookInfo($cid,$name,$category,$auther,$image,$pdf,$date);
    // }
    // public function deleteBook($id){
    //     return $this->deleteBookInfo($id);
    // }
}

?>