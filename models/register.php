<?php
include_once __DIR__."/../vendor/db.php";

class CreateUser{
    private $connection="";
    public function createUserAccount($user_name,$user_email,$confirmPassword,$filename)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="INSERT INTO user(name,email,password,image) VALUES(:user_name,:user_email,:user_password,:image)";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":user_name",$user_name);
        $statement->bindParam(":user_email",$user_email);
        $statement->bindParam(":user_password",$confirmPassword,);
        $statement->bindParam(":image",$filename,);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }

    public function getAllUser()
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="select * from user";
        $statement=$this->connection->prepare($sql);

        //3.execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getUserId($email)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="select id from user where email=:email";
        $statement=$this->connection->prepare($sql);

        $statement->bindParam(":email",$email);

        //3.execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>