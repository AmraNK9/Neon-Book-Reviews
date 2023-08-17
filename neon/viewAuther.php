<?php

include_once "layouts/sidebar.php";
include_once "controller/AutherController.php";
$cid=$_GET['id'];
$auther_controller=new AutherController();
$auther=$auther_controller->getAuther($cid);

?>



<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
        <div class="card col-md" style="width: 18rem;">
        <img src="img/author/<?php echo $auther['image'] ?>" class="card-img-top" alt="..." >
            <div class="card-body">
            <div class="row">
                    
                    <label for="" class="form-label">id:<strong><?php echo $auther['id'] ?></strong></label>
                
            </div>
                <div class="row">
                    
                        <label for="" class="form-label">Auther Name:<strong><?php echo $auther['name'] ?></strong></label>
                    
                </div>
                <div class="row">
                    
                        <label for="" class="form-label">Profile:<strong><?php echo $auther['profile'] ?></strong></label>
                    
                </div>
                
            </div>
        </div>
        <div>
            <a href="auther.php" class="btn btn-success">Back to Users</a>
        </div>
	</div>
</main>

<?php

include_once "layouts/footer.php"

?>