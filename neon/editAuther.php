<?php

include_once "layouts/sidebar.php";
include_once "controller/autherController.php";
$cid=$_GET['id'];
$auther_controller=new AutherController();
$auther=$auther_controller->getAuther($cid);

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
    if($error==false){
        $status=$auther_controller->updateAuther($cid,$name,$profile);
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
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="form-label">Auther Name</label>
                            <input type="text" name="name" id="" class="form-control" value="<?php echo $auther['name'] ?>">
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
                            <input type="text" name="profile" id="" class="form-control" value="<?php echo $auther['profile'] ?>">
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