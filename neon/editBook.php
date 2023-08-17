<?php

include_once "layouts/sidebar.php";
include_once "controller/autherController.php";
include_once "controller/categoryController.php";
include_once "controller/bookController.php";
$cid=$_GET['id'];
$auther_controller=new AutherController();
$auther_list=$auther_controller->getAllAuthers();
$category_controller=new CategoryController();
$category_list=$category_controller->getAllCategory();
$cate=$category_controller->getCategory($cid);
$book_controller=new BookController();
$book=$book_controller->getBook($cid);

if(isset($_POST['submit'])){
    $error=false;
    if(!empty($_POST['name'])){
        $name=$_POST['name'];
    }else{
        $book_name_error="You need to Fill Book Name";
        $error=true;
    }

    $auther=$_POST['auther'];
    
    
        $targetDir = "img/"; // Directory where you want to store the uploaded file
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
    
        $targetDirPdf = "pdf/"; // Directory where you want to store the uploaded file
    $targetFilePdf = $targetDirPdf . basename($_FILES["pdf"]["name"]);
    $uploadOkPdf = 1;
    $fileTypePdf = strtolower(pathinfo($targetFilePdf, PATHINFO_EXTENSION));

    // Allow only PDF files
    if ($fileTypePdf != "pdf") {
        $pdf_error="Sorry,You need to upload pdf file";
        $error=true;
        $uploadOkPdf = 0;
    }

    // Check if the file was uploaded successfully
    if ($uploadOkPdf == 0) {
        
        $error=true;
    } else {
        if (move_uploaded_file($_FILES["pdf"]["tmp_name"], $targetFilePdf)) {
            $pdf= basename($_FILES["pdf"]["name"]);
        } else {
            $pdf_error="Sorry,You need to upload pdf file";
            $error=true;
        }
    }
    $date = date('Y-m-d', strtotime($_POST['date']));
    $checkedCategory=array();
    foreach ($category_list as $category) {
        if (isset($_POST[$category['id']])) {
            $checkedCategory[] = $category['id'];
        }
    }
    if(empty($checkedCategory)){
        $error=true;
        $category_error="You need to select category";
    }
    
    $book_controller=new BookController();
    if($error==false){
        $status=$book_controller->updateBook($cid,$name,$auther,$image,$pdf,$date);
        if($status){
            $category_controller->deleteCategory($cid);
            foreach ($checkedCategory as $category_id) {
                $second=$category_controller->addNewCategory($cid,$category_id);
            }
            
            echo "<script> location.href='book.php?status=".$status."';</script>";
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
                            <label for="" class="form-label">Book Name</label>
                            <input type="text" name="name" id="" class="form-control" value="<?php  echo $book[0]['name'] ?>">
                            <span class='text-danger'>
                                <?php
                                    if(isset($book_name_error)){
                                        echo $book_name_error;
                                    }
                                ?>
                            </span>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="" class="form-label">Auther</label>
                            <select name="auther" id="" class="form-select">
                            <?php
                                foreach ($auther_list as $auther) {
                                    if($auther['id']==$book[0]['auther_id'])
                                    echo "<option value='".$auther['id']."' selected>".$auther['name']."</option>";
                                    else
                                    echo "<option value='".$auther['id']."'>".$auther['name']."</option>";                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="form-label">Date</label>
                            <input type="date" name="date" id="" class="form-control">
                        </div>
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
                        <div class="col-md-3">
                            <label for="" class="form-label">Upload pdf File:</label>
                            <input type="file" name="pdf" id="" class="form-control">
                            <span class='text-danger'>
                                <?php
                                    if(isset($pdf_error)){
                                        echo $pdf_error;
                                    }
                                ?>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                    <?php
                        foreach ($category_list as $category) {
                            echo '<div class="form-check col-md-3">';
                            echo '<label class="form-check-label" for="' . $category['id'] . '">' . $category['name'] . ':</label>';

                            $checked = '';
                            foreach ($cate as $value) {
                                if ($value['category_id'] == $category['id']) {
                                    $checked = 'checked';
                                    break;
                                }
                            }

                            echo '<input class="form-check-input" type="checkbox" id="' . $category['id'] . '" name="' . $category['id'] . '" value="1" ' . $checked . '><br>';
                            
                            echo '</div>';
                        }
                    ?>
                        <span class='text-danger'><?php 
                            if(isset($category_error)){
                                    echo $category_error;
                            } ?></span>
                    </div>
                    <div class="row my-5">
                        <div class="col-md-2">
                            <button name="submit" class="btn btn-success">Add</button>
                        </div>
                        <div class="col-md-2">
                            <a href="book.php" class="btn btn-warning">Back</a>
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