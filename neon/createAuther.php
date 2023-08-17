<?php

include_once "layouts/sidebar.php";
include_once "controller/autherController.php";
$auther_controller=new AutherController();

if(isset($_POST['submit'])){
    $error=false;
    if(!empty($_POST['name'])){
        $name=$_POST['name'];
    }else{
        $name_error="You need to Fill Auther Name";
        $error=true;
    }
    if(!empty($_POST['profile'])){
        $profile=$_POST['profile'];
    }else{
        $profile_error="You need to Fill Profile";
        $error=true;
    }
    $targetDir = "img/author/"; // Directory where you want to store the uploaded file
        $targetFile = $targetDir . basename($_FILES["img"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
        // Allow certain image file types
        $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    
        // Check if the file is a valid image
        if (!in_array($imageFileType, $allowedExtensions)) {
            
            $uploadOk = 0;
            $error=true;
        }
    
        // Check if the file was uploaded successfully
        if ($uploadOk == 0) {
            $img_error= "Sorry, you need to upload JPG, JPEG, PNG, and GIF files";
            $error=true;
        } else {
            if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
                $image= basename($_FILES["img"]["name"]);
            } else {
                $img_error="Sorry, you need to upload JPG, JPEG, PNG, and GIF files";
                $error=true;
            }
        }
    if($error==false){
        $status=$auther_controller->addNewAuther($name,$profile,$image);
        if($status){
            echo "<script> location.href='auther.php?status=".$status."';</script>";
        }
    }
    
    
}
?>



<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
		<div class="row">
            <div class="col-md-12">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="form-label">Auther Name</label>
                            <input type="text" name="name" id="" class="form-control" >
                            <span class='text-danger'>
                                <?php
                                    if(isset($customer_name_error)){
                                        echo $customer_name_error;
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-3">
                            <label for="" class="form-label">Profile</label>
                            <input type="text" name="profile" id="" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                        <label for="" class="form-label">Upload image:</label>
                            <input type="file" name="img" id="" class="form-control">
                            <span class='text-danger'>
                                <?php
                                
                                    if(isset($img_error)){
                                        echo $img_error;
                                    }
                                    
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="row my-5">
                        <div class="col-md-2">
                            <button name="submit" class="btn btn-success">Add</button>
                        </div>
                        <div class="col-md-2">
                            <a href="auther.php" class="btn btn-warning">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</main>

<?php

include_once "layouts/footer.php"

?>