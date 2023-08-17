<?php
include_once __DIR__."/../models/user.php";
class UserController extends User{
    public function getAllUsers(){
        return $this->getUserList();
    }
    // public function addNewCustomer($name,$firstname,$lastname,$phone,$address1,$address2,$city,$state,$country,$postal,$report,$credit){
    //     return $this->createNewCustomer($name,$firstname,$lastname,$phone,$address1,$address2,$city,$state,$country,$postal,$report,$credit);
    // }
    public function getUser($id){
        return $this->getUserInfo($id);
    }
    // public function updateCustomer($cid,$name,$firstname,$lastname,$phone,$address1,$address2,$city,$state,$country,$postal,$report,$credit){
    //     return $this->updateCustomerInfo($cid,$name,$firstname,$lastname,$phone,$address1,$address2,$city,$state,$country,$postal,$report,$credit);
    // }
    public function deleteUser($id){
        return $this->deleteUserInfo($id);
    }
}

?>