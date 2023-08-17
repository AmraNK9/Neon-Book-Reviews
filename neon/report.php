<?php

include_once "layouts/sidebar.php";
include_once "controller/bookController.php";
include_once "controller/categoryController.php";
$book_controller=new BookController();
$book_list=$book_controller->getAllBooks();
$category_controller=new CategoryController();
$category_list=$category_controller->getAllCategory();
$book_count=count($book_list);

?>



<main class="content">
	<div class="container-fluid p-0">
		<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
        <table class="table table-success table-striped-columns" >
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Items</th>
                    <th>Count</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>Book</td>
                    <td><?php echo $book_count ?></td>
                </tr>
                <?php
                foreach ($category_list as $key => $category) {
                ?>
                <tr>
                    <td><?php echo ($key+2) ?></td>
                    <td><?php echo $category['name'] ?></td>
                    <td>
                        <?php 
                            $cate=$category_controller->getCategory($category['id']);
                            $count_cate=count($cate);
                            echo $count_cate;
                        ?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
	</div>
</main>

<?php

include_once "layouts/footer.php"

?>