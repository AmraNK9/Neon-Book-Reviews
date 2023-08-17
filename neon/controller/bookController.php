<?php
include_once __DIR__."/../models/book.php";
class BookController extends Book{
    public function getAllBooks(){
        return $this->getBookList();
    }

    public function getMainBooks(){
        return $this->getBooks();
    }
    public function addNewBook($name,$auther,$image,$pdf,$date){
        return $this->createNewBook($name,$auther,$image,$pdf,$date);
    }
    public function getBook($id){
        return $this->getBookInfo($id);
    }
    public function updateBook($cid,$name,$auther,$image,$pdf,$date){
        return $this->updateBookInfo($cid,$name,$auther,$image,$pdf,$date);
    }
    public function deleteBook($id){
        return $this->deleteBookInfo($id);
    }

    public function getSearchBooks($bookname){
        return $this->getSearchBook($bookname);
    }

    public function searchBooks($bookname,$categoryName){
        return $this->searchBook($bookname,$categoryName);
    }
}

?>