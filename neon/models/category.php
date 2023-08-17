<?php
include_once __DIR__."/../vendor/db.php";
class Category{
    private $connection="";
    public function getCategoryList(){
        //1.DB connection
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql="SELECT * from category";
        $statement=$this->connection->prepare($sql);
        //3. execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getBookCateGory($value){
        //1.DB connection
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql="SELECT book.*
        FROM book
        JOIN book_category ON book.id = book_category.book_id
        JOIN category ON book_category.category_id = category.id
        WHERE category.id = :category_id";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":category_id",$value);

        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function createNewCategory($book_id,$category_id){
        //1.DB connection
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2.sql statement
        $sql="INSERT INTO book_category( book_id, category_id) VALUES
        (:book_id,:category_id)";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":book_id",$book_id);
        $statement->bindParam(":category_id",$category_id);
        if($statement->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    public function getCategoryInfo($id){
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT * from book_category where book_id=:id";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":id",$id);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    // public function updateAutherInfo($cid,$name,$profile){
    //     $this->connection=Database::connect();
    //     $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //     $sql="UPDATE auther SET  name = :name, profile = :profile WHERE id=:id;
    //     ";
    //     $statement=$this->connection->prepare($sql);
    //     $statement->bindParam(":name",$name);
    //     $statement->bindParam(":profile",$profile);
    //     $statement->bindParam(":id",$cid);
    //     if($statement->execute()){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }
    public function deleteCategoryInfo($id){
        
            $this->connection = Database1::connect();
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "delete from book_category where book_id=:id";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(":id", $id);

            if($statement->execute())
        return "success";
        else
        return "fail";
        
    }

}
?>