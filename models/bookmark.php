<?php
include_once __DIR__."/../vendor/db.php";
class Bookmark{
    private $connection="";
    public function getAllBookmarkList($user_id){
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="SELECT book.* ,auther.name as auther_name FROM `book_mark` inner join book on book_mark.book_id=book.id inner join auther on book.auther_id=auther.id where book_mark.user_id=:id";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":id",$user_id);
        //3.execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllBookmarkLists($user_id,$book_id){
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="SELECT book.* ,auther.name as auther_name FROM `book_mark` inner join book on book_mark.book_id=book.id inner join auther on book.auther_id=auther.id where book_mark.user_id=:user_id and book_mark.book_id=:book_id";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":user_id",$user_id);
        $statement->bindParam(":book_id",$book_id);
        //3.execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function createNewBookmark($user_id,$book_id){
        //1.DB connection
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2.sql statement
        $sql="INSERT INTO book_mark( user_id, book_id) VALUES
        ( :user_id, :book_id) ";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":user_id",$user_id);
        $statement->bindParam(":book_id",$book_id);
        if($statement->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function deleteBookmarkInfo($user_id,$book_id){
        
        $this->connection = Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "delete from book_mark where user_id=:user_id and book_id=:book_id";

        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":user_id", $user_id);
        $statement->bindParam(":book_id", $book_id);
        if($statement->execute())
    return "success";
    else
    return "fail";
    
}
}

?>