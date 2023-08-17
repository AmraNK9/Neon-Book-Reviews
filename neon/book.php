<?php

include_once "layouts/sidebar.php";
include_once "controller/bookController.php";
$book_controller=new BookController();
$book_list=$book_controller->getAllBooks();
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
                <a href="createBook.php" class="btn btn-dark">Add New Book</a>
            </div>
        </div>
		<div class="row">
            <div class="col-md-12">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Auther</th>
                            <th>image</th>
                            <th>pdf file</th>
                            <th>action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for($r=0;$r<sizeof($book_list);$r++)
                        {
                            echo "<tr id='". $book_list[$r]['id'] ."'>";
                            echo "<td>" . ($r+1)."</td>";
                            echo "<td>" . $book_list[$r]['name']."</td>";
                            echo "<td>" . $book_list[$r]['auther_name']."</td>";
                            echo "<td><img src=img/photos/". $book_list[$r]['image']." alt='' width='50px' height='50px'></td>";
                            echo "<td>" . $book_list[$r]['pdf_file']."</td>";
                            echo "<td><a class='btn btn-success mx-2' href='viewBook.php?id=".$book_list[$r]['id']."'>View</a><a class='btn btn-warning mx-2' href='editBook.php?id=".$book_list[$r]['id']."'>Edit</a><a class='btn btn-danger delete_book mx-2'>Delete</a></td>";
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