<?php
include_once __DIR__."/../vendor/db.php";
class User{
    public function getUserList(){
        //1.DB connection
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        //2. sql statementfa
        $sql="Select * from user";
        $statement=$this->connection->prepare($sql);
        //3. execute
        $statement->execute();
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    // public function createNewCustomer($name,$firstname,$lastname,$phone,$address1,$address2,$city,$state,$country,$postal,$report,$credit){
    //     //1.DB connection
    //     $this->connection=Database::connect();
    //     $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //     //2.sql statement
    //     $sql="INSERT INTO customers( customerName, contactLastName, contactFirstName, phone, addressLine1, addressLine2, city, state, postalCode, country, salesRepEmployeeNumber, creditLimit) VALUES
    //     (:name,:firstname,:lastname,:phone,:address1,:address2,:city,:state,:postalCode,:country,:report,:credit)";
    //     $statement=$this->connection->prepare($sql);
    //     $statement->bindParam(":name",$name);
    //     $statement->bindParam(":firstname",$firstname);
    //     $statement->bindParam(":lastname",$lastname);
    //     $statement->bindParam(":phone",$phone);
    //     $statement->bindParam(":address1",$address1);
    //     $statement->bindParam(":address2",$address2);
    //     $statement->bindParam(":city",$city);
    //     $statement->bindParam(":state",$state);
    //     $statement->bindParam(":postalCode",$postal);
    //     $statement->bindParam(":country",$country);
    //     $statement->bindParam(":report",$report);
    //     $statement->bindParam(":credit",$credit);
    //     if($statement->execute()){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }
    public function getUserInfo($id){
        $this->connection=Database1::connect();
        $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        $sql="select * from user where id=:id";
        $statement = $this->connection->prepare($sql);

        $statement->bindParam(":id",$id);

        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    // public function updateCustomerInfo($cid,$name,$firstname,$lastname,$phone,$address1,$address2,$city,$state,$country,$postal,$report,$credit){
    //     $this->connection=Database::connect();
    //     $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    //     $sql="UPDATE customers SET  customerName = :name, contactFirstName = :firstname, contactLastName=:lastname,
    //     phone = :phone, addressLine1 = :address1, addressLine2 = :address2, city = :city, state = :state,
    //     postalCode = :postalCode, country = :country, salesRepEmployeeNumber = :report, creditLimit =:credit  WHERE customerNumber=:id;
    //     ";
    //     $statement=$this->connection->prepare($sql);
    //     $statement->bindParam(":name",$name);
    //     $statement->bindParam(":firstname",$firstname);
    //     $statement->bindParam(":lastname",$lastname);
    //     $statement->bindParam(":phone",$phone);
    //     $statement->bindParam(":address1",$address1);
    //     $statement->bindParam(":address2",$address2);
    //     $statement->bindParam(":city",$city);
    //     $statement->bindParam(":state",$state);
    //     $statement->bindParam(":postalCode",$postal);
    //     $statement->bindParam(":country",$country);
    //     $statement->bindParam(":report",$report);
    //     $statement->bindParam(":credit",$credit);
    //     $statement->bindParam(":id",$cid);
    //     if($statement->execute()){
    //         return true;
    //     }
    //     else{
    //         return false;
    //     }
    // }
    public function deleteUserInfo($id){
        
            $this->connection = Database1::connect();
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "delete from user where id=:id";

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(":id", $id);

            if($statement->execute())
        return "success";
        else
        return "fail";
        
    }

}
?>