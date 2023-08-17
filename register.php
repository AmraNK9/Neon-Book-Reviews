<?php
session_start();
include_once "controllers/registercontroller.php";

$register_controller=new RegisterController();
$getUserList=$register_controller->getUserList();

if(isset($_POST['register']))
{
    $error_status=false;

    // create user_name
    if(!empty($_POST['user_name']))
    {
        $user_name=$_POST['user_name'];
    }else{
        $error_status=true;
        $error_name="Please Enter Your Name";
    }

    // create user_email
    if(!empty($_POST['user_email']))
    {
        $user_email=$_POST['user_email'];
    }else{
        $error_status=true;
        $error_email="Please Enter Your Email Address";
    }

    // create user_password
    
    if(!empty($_POST['create_password']))
    {
        $create_password=$_POST['create_password'];
    }else{
        $error_status=true;
        echo $error_status;
        $create_password="Please Enter Your Password";
    }
    
    if(!empty($_POST['re_enter_password']))
    {
        $re_enter_password=$_POST['re_enter_password'];
    }else{
        $error_status=true;


    //     $error_password2="Please Enter Your Password";
     }

    if($create_password==$re_enter_password)
    {
        $user_password=$create_password;
    }else
    {
        $error_status=true;
    }

    //create img

    $filename=$_FILES['image']['name'];
    $filesize=$_FILES['image']['size'];
    $allowed_files=['jpg','png','jpeg','svg'];
    $temp_path=$_FILES['image']['tmp_name'];
    
    $fileinfo=explode('.',$filename);
    $filetype=end($fileinfo);
    $maxsize=2000000000;
    if(in_array($filetype,$allowed_files)){
        if($filesize<$maxsize)
        {
            move_uploaded_file($temp_path,'image/'.$filename);
        }else{
            echo "file size exceeds maximum allowed";
        }
    }else{
        echo "file type is not allowed";
    }
    
    $_SESSION['user_name']=$user_name;
    $_SESSION['user_email']=$user_email;
    $_SESSION['user_password']=$user_password;
    $accountExists = false;

    foreach ($getUserList as $user) {
        if ($user['email'] == $user_email) {
            $accountExists = true;
            $error_status=true;
            break;
        }
    }

    if ($accountExists) {
        $exit_acc="Your Account is Already Exists Plz Sign In";
    }
    
    if($error_status==false)
    {
        // checkAlreadyExit Or Not
        $register_controller->registerUser($user_name, $user_email, $user_password,$filename);
        
        if(isset($_SESSION['user_name']) && isset($_SESSION['user_email']) && $_SESSION['user_password']=$user_password)
        {
            $userid = $register_controller->getUserInfo($_SESSION['user_email']);
            $_SESSION["userid"] = $userid[0]["id"];
            header("location:BookReviewSystem Font-End/index.php");
        }

         
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <link rel="stylesheet" href="css/register.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="row">
                <div class="col-lg-10 col-xl-9 mx-auto">
                    <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-img-left d-none d-md-flex">
                        <!-- Background image for card set in CSS! -->
                        <img src="../NEON/image/6888609.jpg" width="100%" height="700px" alt="">
                    </div>
                    <div class="card-body p-4 p-sm-5">
                        <h5 class="card-title text-center mb-5 fw-light fs-5">Register</h5>

                        <div class="upload-circle ">
                            <div class="image-preview d-flex justify-content-center">
                                <div class="image-circle">
                                <img id="preview" src="image/user.jpg" alt="" title="">
                                </div>
                                <div class="cancel-button">
                                    <i class="fa-solid fa-xmark cross d-none"></i>
                                </div>

                                <!-- <div class="round">
                                    <i class="fa fa-camera camera" style="color: #fff;"></i>
                                </div> -->
                            </div>
                        </div>
                        <div class="d-flex justify-content-center my-2">
                            <div class="round">
                                <!-- <i class="fa-regular fa-camera-retro fa-lg" style="color: #00ffe1;"></i> -->
                                <i class="fa fa-camera camera"  style="color: #00000;"></i>
                                <input type="file" src="" name="image"  alt="" id="input"  class="world">
                            </div>
                        </div>
                        
                        <hr>

                        <div class="form-floating mb-3">
                            <input type="text" name="user_name" class="form-control" required value="<?php if(isset($user_name)) echo $user_name ?>" id="floatingInputUsername" placeholder="myusername">
                            <label for="floatingInputUsername"><i class="fa-solid fa-user mx-2"></i>Name</label>
                            <span class="text-danger"><?php if(isset($error_name)) echo $error_name; ?></span>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="email" name="user_email"  class="form-control" required value="<?php if(isset($user_email)) echo $user_email ?>" id="floatingInputEmail" placeholder="name@example.com">
                            <label for="floatingInputEmail"><i class="fa-solid fa-envelope mx-2"></i>Email address</label>
                            <span class="text-danger"><?php if(isset($error_email)) echo $error_email;  ?></span>
                        </div>

                        <hr>

                        <div class="form-floating mb-3">
                            <input type="password" name="create_password" required value="" class="form-control password1" id="floatingPassWord" placeholder="Password">
                            <label for="floatingPassword"><i class="fa-solid fa-lock mx-2"></i>Create Password</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="re_enter_password" required value=""  class="form-control password2"  id="floatingPassword" placeholder="Password">
                            <label for="floatingPassword"><i class="fa-solid fa-lock mx-2"></i>Comfirm Password</label>
                        </div>
                        <div class="text-center">
                            <p class="note text-danger"><?php if(isset($exit_acc)) echo $exit_acc ?></p>
                        </div>
                        <div class=" mb-2">
                            <button class="btn btn-primary   register" type="submit" style="background-color:#265077; color:white;" name="register">Register</button>
                        </div>

                        <p class="d-block text-center mt-2 small" >Already have an account? <a  href="login.php">Login</a></p>

                        <hr class="my-4">
                    </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/jquery-3.7.0.min.js"></script>
<script src="js/checkpassword.js"></script>
<script src="js/image.js"></script>
</html>