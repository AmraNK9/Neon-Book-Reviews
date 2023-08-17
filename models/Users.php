<?php
include_once __DIR__."/../vendor/db.php";
Class Users {
    private $connection="";
    function __construct(){
        $this->connection= Database::connect();
    }
    function  get_user_profile ($id){
        $sql = "SELECT * FROM `user` WHERE `id` = :id";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":id",$id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
     }
     function  get_user ($useremail){
        $sql = "SELECT * FROM `user` WHERE `email` = :useremail";
        $statement = $this->connection->prepare($sql);
        $statement->bindParam(":useremail",$useremail);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
     }
    public function updateUser($editusername,$useremail,$edituserbio,$filename)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="UPDATE user SET name=:user_name,
        image=:image,bio=:bio WHERE email=:user_email";
         $statement=$this->connection->prepare($sql);


        $statement->bindParam(":user_name",$editusername);
        $statement->bindParam(":user_email",$useremail);
        $statement->bindParam(":bio",$edituserbio,);
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
    public function change_image($user_image,$user_email)
    {
        //1.DataBase Connect
        $this->connection=Database::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //2.sql Statement
        $sql="UPDATE user SET 
        image=:user_image WHERE email=:user_email";
         $statement=$this->connection->prepare($sql);
        $statement->bindParam(":user_email",$user_email);
        $statement->bindParam(":user_image",$user_image);

        //3.execute
        if($statement->execute())
        {
            return true;
        }else
        {
            return false;
        }
    }
}
?>