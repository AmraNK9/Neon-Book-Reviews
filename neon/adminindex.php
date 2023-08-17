<?php 
include_once "layouts/sidebar.php";
include_once "../neon/controller/editorController.php";
include_once "../neon/controller/categoryController.php";

include_once "../neon/controller/editorController.php";
$getAllCategory = new CategoryController();
$getCategory = $getAllCategory->getAllCategory();

 $genereAll=new editorController();
 $geteditorchoice=$genereAll->genreSingleFilter();

// $genereBook=$genereAll->genreSingle($id);
// foreach ($genereBook as $key => $genere) {
//     //var_dump($genere);
//     # code...
// }
foreach($getCategory as $Category){
    //var_dump($Category);
    // if($Category['id']){
    //     $categoryname=$Category["name"];

    // }
}


if(isset($_POST["book_id"])){
$bookid=$_POST["book_id"];
$deleteCategory=$genereAll->deleteCategory($bookid);

}

?>

<div class="container">
    <div class="row mb-4 mt-3 ">
    <h1 class="h3 mb-3"><strong>Editor Choice</strong> Dashboard</h1>
        
        <div class="col-md-12 ">
            <div class="col-md-3 ">
                <a href="addeditorchoice.php" class="btn btn-success mx-2"><i class="fa-sharp fa-regular fa-plus"></i> Add Editor Choice</a>
            </div>
        </div>
        
    </div>
    <div class="row">
    <div class="col-md-12">
            <form action="" method="post">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Book Name</th>
                            <th>Auther Name</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="genere_table">
                            <?php foreach($geteditorchoice as $index =>$Category){ ?> 
                                <tr class="something" id="show">
                                    <td><?php echo $index+1 ?></td>
                                    <td><?php echo $Category["book_name"] ?></td>
                                    <td><?php echo $Category["author_name"] ?></td>
                                    <td><?php echo $Category["date"] ?></td>
                                    <td> <button class="btn btn-warning unselect-btn" name="unSelete" data-book-id="<?php echo $Category['id']; ?>"><i class="fa-solid fa-x"></i></button></td>
                                </tr>
                            <?php } ?> 
                    </tbody> 
                </table>
                <input type="hidden" id="selected_book_id" name="book_id" value="">
            </form>
        </div>
    </div>
</div>
<?php 

include_once "layouts/footer.php";

?>

<script src="../neon/js/addeditorchoice.js"></script>