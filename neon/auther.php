<?php

include_once "layouts/sidebar.php";
include_once "controller/autherController.php";

$auther_controller=new AutherController();
$auther_list=$auther_controller->getAllAuthers();


?>



<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
        <?php
                if(isset($_GET['status']) && $_GET['status']==1){
                    echo "<div class='alert alert-success'>New Office is successfully created</div>";
                }
            ?>
            <div class="col-md-2">
                <a href="createAuther.php" class="btn btn-dark">Add New Auther</a>
            </div>
        </div>
		<div class="row">
            <div class="col-md-12">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Profile </th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($r=0;$r<sizeof($auther_list);$r++)
                        {
                            echo "<tr id='". $auther_list[$r]['id'] ."'>";
                            echo "<td>" . ($r+1)."</td>";
                            echo "<td>" . $auther_list[$r]['name']."</td>";
                            echo "<td>" . $auther_list[$r]['profile']."</td>";
                            echo "<td><a class='btn btn-success mx-2' href='viewAuther.php?id=".$auther_list[$r]['id']."'>View</a><a class='btn btn-warning mx-2' href='editAuther.php?id=".$auther_list[$r]['id']."'>Edit</a><a class='mx-2 btn btn-danger delete_auther'>Delete</a></td>";
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