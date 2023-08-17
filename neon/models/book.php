<?php
include_once __DIR__."/../vendor/db.php";
class Book{
    private $connection="";
    public function getBookList(){
        //1.DB connection
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql="SELECT book.id, book.name, book.image, book.pdf_file, book.date,  auther.name AS auther_name
        FROM book
        
        LEFT JOIN auther ON book.auther_id = auther.id;";
        $statement=$this->connection->prepare($sql);
        //3. execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function createNewBook($name,$auther,$image,$pdf,$date){
        //1.DB connection
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2.sql statement
        $sql="INSERT INTO book( name, auther_id, date, image, pdf_file) VALUES
        (:name,:auther_id,:date,:image,:pdf_file)";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":name",$name);
        $statement->bindParam(":auther_id",$auther);
        $statement->bindParam(":date",$date);
        $statement->bindParam(":image",$image);
        $statement->bindParam(":pdf_file",$pdf);
        if($statement->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    public function getBookInfo($id){
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="SELECT book.id, book.name, book.image, book.pdf_file, book.date, category.name AS category_name, auther.name AS auther_name ,auther.id as auther_id
        FROM book
        LEFT JOIN book_category ON book.id = book_category.book_id
        LEFT JOIN category ON book_category.category_id = category.id
        LEFT JOIN auther ON book.auther_id = auther.id where book.id=:id";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":id",$id);

        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateBookInfo($cid,$name,$auther,$image,$pdf,$date){
        //1.DB connection
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2.sql statement
        $sql="UPDATE book SET  name = :name,  auther_id=:auther_id,
        date = :date, image = :image, pdf_file = :pdf_file WHERE id=:id;
        ";
        $statement=$this->connection->prepare($sql);
        $statement->bindParam(":name",$name);
        $statement->bindParam(":auther_id",$auther);
        $statement->bindParam(":date",$date);
        $statement->bindParam(":image",$image);
        $statement->bindParam(":pdf_file",$pdf);
        $statement->bindParam(":id",$cid);
        if($statement->execute()){
            return true;
        }
        else{
            return false;
        }
    }
    public function deleteBookInfo($id){
        
            $this->connection = Database1::connect();
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "delete from book where id=:id";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(":id", $id);

            if($statement->execute())
        return "success";
        else
        return "fail";
        
    }

    public function getSearchBook($bookname){
        $this->connection = Database1::connect();
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT * FROM book WHERE name LIKE '%" . $bookname . "%'";

            $statement = $this->connection->prepare($sql);
            //$statement->bindParam(":name", $bookname);

            $statement->execute();
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    }

    public function searchBook($bookname,$categoryName){
        $this->connection = Database1::connect();
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "SELECT book.*
            FROM book
            JOIN book_category ON book.id = book_category.book_id
            JOIN category ON book_category.category_id = category.id
            WHERE category.id = $categoryName and book.name LIKE '%" . $bookname . "%'" ;
            
            $statement = $this->connection->prepare($sql);
            //$statement->bindParam(":name", $bookname);

            $statement->execute();
            $result=$statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
    }

    public function getBooks(){
        //1.DB connection
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql="Select * from book limit 4";
        $statement=$this->connection->prepare($sql);
        //3. execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getBalanceBook($offset,$limit){
        //1.DB connection
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql="Select * from book LIMIT $limit OFFSET $offset";
        $statement=$this->connection->prepare($sql);
        //3. execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>