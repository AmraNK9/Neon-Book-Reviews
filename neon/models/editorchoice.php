<?php
include_once __DIR__ . "/../vendor/db.php";
class Editor
{
    public $connection = "";
    // function __construct()
    // {
    //     $this->connection = Database1::connect();
    // }
    public function gnereFliter()
    {
        //1.DB connection
        $this->connection = Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT book.name AS book_name, auther.name AS author_name, book.date,book.id
        FROM editor_choice 
        JOIN book ON editor_choice.book_id = book.id
        JOIN book_category ON book.id = book_category.book_id
        LEFT JOIN auther ON book.auther_id = auther.id";
        $statement = $this->connection->prepare($sql);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function genere($id)
    {
        //1.DB connection
        $this->connection = Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT book.image AS book_image, book.name AS book_name, auther.name AS author_name, book.date,book.id
        FROM editor_choice 
        JOIN book ON editor_choice.book_id = book.id
        JOIN book_category ON book.id = book_category.book_id
        LEFT JOIN auther ON book.auther_id = auther.id
        WHERE book_category.category_id = $id";
        $statement = $this->connection->prepare($sql);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function getEditorChoice()
    {
        //1.DB connection
        $this->connection = Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * from editor_choice";
        $statement = $this->connection->prepare($sql);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    public function delete_category($bookid)
    {
        //1.DB connection
        $this->connection = Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM editor_choice WHERE book_id=:book_id";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":book_id", $bookid);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getBookCateGory($value)
    {
        //1.DB connection
        $this->connection = Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql = "SELECT book.name AS book_name, auther.name AS author_name, book.date,book.id
        FROM book
        
        JOIN book_category ON book.id = book_category.book_id
        LEFT JOIN auther ON book.auther_id = auther.id
        WHERE book_category.category_id = :category_id";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":category_id", $value);

        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function getAllCateGory()
    {
        //1.DB connection
        $this->connection = Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql = "SELECT DISTINCT category.name as category_name, category.id as category_id FROM book join editor_choice on editor_choice.book_id=book.id join book_category on book.id=book_category.book_id join category on category.id=book_category.category_id;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function insetBook($book_id)
    {
        //1.DB connection
        $this->connection = Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql = "INSERT INTO editor_choice(book_id) VALUES (:book_id)";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":book_id", $book_id);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>