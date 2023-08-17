<?php
include_once __DIR__."/../models/bookmark.php";
class BookmarkController extends Bookmark{
    public function getAllBookmark($user_id){
        return $this->getAllBookmarkList($user_id);
    }
    public function getAllBookmarks($user_id,$book_id){
        return $this->getAllBookmarkLists($user_id,$book_id);
    }
    public function addNewBookmark($user_id,$book_id)
    {
        return $this->createNewBookmark($user_id,$book_id);
    }

    public function deleteBookmark($user_id,$book_id)
    {
        return $this->deleteBookmarkInfo($user_id,$book_id);
    }

    // public function getAllAuthorFromAuthorDetail()
    // {
    //     return $this->getAllAuthorFromDetail();
    // }
}


?>