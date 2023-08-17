<?php
include_once __DIR__."/../vendor/db.php";
class Rating{
    public function viewRatingInfo($book_id,$user_id){
        //1.DB connection
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql="SELECT * FROM `book_rating` WHERE user_id=:user_id and book_id=:book_id";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":user_id",$user_id);
        $statement->bindParam(":book_id",$book_id);
        //3. execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deleteRatingInfo($book_id,$user_id){
        //1.DB connection
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql="DELETE FROM `book_rating` WHERE user_id=:user_id and book_id=:book_id";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":user_id",$user_id);
        $statement->bindParam(":book_id",$book_id);
        //3. execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function averageRatingInfo($book_id){
        //1.DB connection
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql="SELECT rating FROM `book_rating` WHERE book_id=:book_id";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":book_id",$book_id);
        //3. execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function createNewRating($user_id,$book_id,$rating_id){
        //1.DB connection
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2.sql statement
        $sql="INSERT INTO book_rating( rating, user_id, book_id) VALUES
        (:rating,:user_id,:book_id)";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":rating",$rating_id);
        $statement->bindParam(":user_id",$user_id);
        $statement->bindParam(":book_id",$book_id);
        if($statement->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    // public function getBookInfo($id){
    //     $this->connection=Database::connect();
    //     $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //     $sql="SELECT book.*, category.name as category_name, auther.name as auther_name,book.image,book.pdf_file
    //     FROM book 
    //     INNER JOIN category ON book.category_id = category.id
    //     INNER JOIN auther ON book.auther_id = auther.id where book.id=:id";
    //     $statement = $this->connection->prepare($sql);

    //     $statement->bindParam(":id",$id);

    //     $statement->execute();
    //     return $statement->fetch(PDO::FETCH_ASSOC);
    // }
    // public function updateBookInfo($cid,$name,$category,$auther,$image,$pdf,$date){
    //     //1.DB connection
    //     $this->connection=Database::connect();
    //     $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //     //2.sql statement
    //     $sql="UPDATE book SET  name = :name, category_id = :category_id, auther_id=:auther_id,
    //     date = :date, image = :image, pdf_file = :pdf_file WHERE id=:id;
    //     ";
    //     $statement=$this->connection->prepare($sql);
    //     $statement->bindParam(":name",$name);
    //     $statement->bindParam(":category_id",$category);
    //     $statement->bindParam(":auther_id",$auther);
    //     $statement->bindParam(":date",$date);
    //     $statement->bindParam(":image",$image);
    //     $statement->bindParam(":pdf_file",$pdf);
    //     $statement->bindParam(":id",$cid);
    //     if($statement->execute()){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }
    // public function deleteBookInfo($id){
        
    //         $this->connection = Database::connect();
    //         $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //         $sql = "delete from book where id=:id";

    //         $statement = $this->connection->prepare($sql);
    //         $statement->bindParam(":id", $id);

    //         if($statement->execute())
    //     return "success";
    //     else
    //     return "fail";
        
    // }

}
?>