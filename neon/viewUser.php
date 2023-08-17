<?php

include_once "layouts/sidebar.php";
include_once "controller/userController.php";
$cid=$_GET['id'];
$user_controller=new UserController();
$user=$user_controller->getUser($cid);

?>



<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
                <div class="card" style="width: 18rem;">
                <img src="img/photos/<?php echo $user['image'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                        <h3 class="card-tit"><strong><?php echo $user['name'] ?></strong></h1>
                        <h4 class="card-title"><strong><?php echo $user['email'] ?></h3>
                        <h4 class="card-title"><strong><?php echo $user['password'] ?></h3>
                        <h4 class="card-title"><strong><?php echo $user['bio'] ?></h3>
                        
                </div>
        </div>
        <div>
            <a href="user.php" class="btn btn-success">Back to Users</a>
        </div>
	</div>
</main>

<?php

include_once "layouts/footer.php"

?>