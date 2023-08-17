<?php
include_once __DIR__."/../models/rating.php";
class RatingController extends Rating{
    public function viewRating($book_id,$user_id){
        return $this->viewRatingInfo($book_id,$user_id);
    }
    public function addNewRating($user_id,$book_id,$rating_id){
        return $this->createNewRating($user_id,$book_id,$rating_id);
    }
    public function deleteRating($book_id,$user_id){
        return $this->deleteRatingInfo($book_id,$user_id);
    }
    public function averageRating($book_id){
        return $this->averageRatingInfo($book_id);
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