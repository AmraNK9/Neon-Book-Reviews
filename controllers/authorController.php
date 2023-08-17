<?php
include_once __DIR__."/../models/author.php";
class authorController extends author{
    public function getAllAuthorInfo(){
        return $this->getAllAuthor();
    }

    public function searchAuthorInfo($usersearch)
    {
        return $this->searchAuthor($usersearch);
    }

    public function getMoreAuthors($offset, $limit)
    {
        return $this->getMoreAuthor($offset, $limit);
    }

    public function getAllAuthorFromAuthorDetail()
    {
        return $this->getAllAuthorFromDetail();
    }
}


?>