<?php

include_once "layouts/sidebar.php";
include_once "controller/userController.php";
$user_controller=new UserController();
$user_list=$user_controller->getAllUsers();


?>



<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
        <div class="row">
        </div>
		<div class="row">
            <div class="col-md-12">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($r=0;$r<sizeof($user_list);$r++)
                        {
                            echo "<tr id='". $user_list[$r]['id'] ."'>";
                            echo "<td>" . ($r+1)."</td>";
                            echo "<td>" . $user_list[$r]['name']."</td>";
                            echo "<td>" . $user_list[$r]['email']."</td>";
                            echo "<td>" . $user_list[$r]['password']."</td>";
                            echo "<td><a class='btn btn-success mx-2' href='viewUser.php?id=".$user_list[$r]['id']."'>View</a><a class='btn btn-danger delete_user mx-2'>Delete</a></td>";
                            echo "</tr>";
                        
                        
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
	</div>
</main>

<?php

include_once "layouts/footer.php"

?>