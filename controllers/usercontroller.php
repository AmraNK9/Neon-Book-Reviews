<?php 
include_once __DIR__."/../models/Users.php";
class UserController extends Users{

    //update or edit userINfo
    public function updateUserInfo($editusername,$useremail,$edituserbio,$filename)
    {
        return $this->updateUser($editusername,$useremail,$edituserbio,$filename);
    }
    public function getSingleUser($useremail)
    {
        return $this->get_user($useremail);
    }

    public function changeImage($user_image,$user_email)
    {
        return $this->change_image($user_image,$user_email);
    }
}

?>