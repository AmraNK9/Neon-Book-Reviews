<?php
session_start();
include_once "../controllers/registercontroller.php";
include_once "../neon/controller/bookController.php";
include_once "../neon/controller/categoryController.php";
include_once('latestBook.php');
include_once "../models/reviews.php";

$review_model = new Reviews();


$getUserData = new RegisterController();
$getUserinfo = $getUserData->getUserList();

$getAllCategory = new CategoryController();
$getCategory = $getAllCategory->getAllCategory();

$getAllBook = new BookController();
$getmainAllBook=$getAllBook->getMainBooks();
//var_dump($getmainAllBook);

foreach ($getCategory as $category) {
    //var_dump($category);
}

foreach ($getUserinfo as $getUser) {
    //var_dump($getUser) ;
    if ($_SESSION["user_email"] == $getUser['email']) {
        $userimg = $getUser['image'];
        $username = $getUser['name'];
        $userbio = $getUser['bio'];
        $useremail = $getUser['email'];
    }
}
if (!isset($_SESSION['user_email'])) {
    header("location:../login.php");
}




$getAllBookList = [];

if(isset($_POST['categoryName'])){
    $categoryName = $_POST['categoryName'];

}
$error_status=false;
if (isset($_POST['searchbyuser'])) {
    $bookname = $_POST['bookname'];
    //echo "Hello";
    
    if ($categoryName == "All") {
        $getAllBookList = $getAllBook->getSearchBooks($bookname);
       
        if(empty($getAllBookList)){
            $error_status=true;
          
        }else{
            $error_status=false;
            
        }
    }
}
?>
<!-- Navigation bar -->
<?php
    include_once "nav.php";
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Review System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <link rel="stylesheet" href="style.css" />
    <!-- <link rel="" type="" href="../css/books.css"> -->
</head>

<body>
    
    <!-- search bar -->
    <div class="container book-search " style = "">
    <div class="container ">
        <form action="" method="post">
            <div class="row my-2">
                <div class="col-md-4">
                    <select class="form-control filter-select" name="categoryName" id="filter_category">
                        <option value="All" id="something">All</option>
                        <?php foreach ($getCategory as $category) {
                            ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                        <?php } ?>
                    </select>
                    
                </div>
                <div class="col-md-8">
                    <div class="input-group">
                        <input type="text" class="form-control" name="bookname" id="booksearch" value="<?php echo isset($_POST['bookname']) ? $_POST['bookname'] : '';  ?>"
                            placeholder="Search..." />
                        <div class="input-group-append">
                            <button class="btn btn-primary" name="searchbyuser" style="background-color:#265077; color:white;" id="search"><i class="fa-solid fa-magnifying-glass"></i>
                                Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Books -->
        <div class=" mt-4">
      
                <?php if (empty($getAllBookList)){ ?>
                <div class="book-card-grid select_all <?php echo ($error_status ? 'd-none' : ''); ?>"
                <?php if ((isset($_POST['categoryName']) && $_POST['categoryName'] == "All") || $error_status) { echo "style='display: none;'"; } ?>> 
                
                    <?php foreach ($getmainAllBook as $BookAllList) {
                        $auther_name = $review_model->get_author_by_id($BookAllList['auther_id']);

                         ?>
                        <div class="book-card usersearch_book">
                            <div class="book-card-image">
                                <img src="../image/photos/<?php echo $BookAllList['image'] ?>" alt="<?php echo $BookAllList['image'] ?>" />
                                <div class="book-card-overlay">
                                    <a href="BookDetail.php?id=<?php echo $BookAllList['id'] ?>"  style="background-color:#ffdf00; color:white;" class="book-card-button"><i class="fa-solid fa-arrow-right mx-2"></i>Read More</a>
                                </div>
                            </div>
                            <div class="book-card-info">
                                <h3 class="book-card-title"><?php echo $BookAllList['name'] ?></h3>
                                <p class="book-card-author">Author: <?php  if($auther_name){
                                echo $auther_name['name'];
                                }
                                else{
                                    echo "Anonymous";
                                }
                                ?></p>
                                <p class="book-card-genre">Genre: Fantasy</p>
                            </div>
                        </div>
                        <?php } ?>
                <?php } ?>
                </div>

                <?php //if($categoryName !== "All"){  ?>
                
                <div class="book-card-grid " id="filterbook">

                </div>
                <?php // }  ?>
            <div class="row">
                <div class="col-md-12 d-flex flex-wrap book-card-grid <?php echo ($error_status ? 'd-none' : ''); ?>"
                    <?php if ((isset($_POST['categoryName']) && $_POST['categoryName'] == "All") || $error_status) { echo "style='display: none;'"; } ?>>

                    <?php
                    if ($error_status==false) {
                    //     echo "No books found.";
                    // } else {
                        if (!empty($getAllBookList)) {
                            foreach ($getAllBookList as $book) {
                                $auther_name = $review_model->get_author_by_id($book['auther_id']);
                                //var_dump($book);
                            ?>
                        <div class="book-card col-md-3 usersearch_book">
                            <div class="book-card-image">
                                <img src="../image/photos/<?php echo $book['image'] ?>" alt="<?php echo $book['image'] ?>" />
                                <div class="book-card-overlay">
                                    <a href="BookDetail.php?id=<?php echo $book['id'] ?>"  style="background-color:#ffdf00; color:white;" class="book-card-button"><i class="fa-solid fa-arrow-right mx-2"></i>Read More</a>
                                </div>
                            </div>
                            <div class="book-card-info">
                                <h3 class="book-card-title"><?php echo $book['name'] ?></h3>
                                <p class="book-card-author">Author: <?php  if($auther_name){
                                echo $auther_name['name'];
                                }
                                else{
                                    echo "Anonymous";
                                }
                                ?></p>
                                <p class="book-card-genre">Genre: Fantasy</p>
                            </div>
                        </div>
                                
                            <?php }
                        }
                    } ?>
                    
                <!-- </div> -->
                
                
            </div>
        </div>
        <?php if(empty($bookname)) {?>
                        <div class="row ">
                                <div class="col-md-12 load_more d-flex justify-content-center">
                                    <button type="" class="btn  load" id="loadmorebtn" style="background-color:#265077; color:white;"><i class="fa-regular fa-eye mx-2"></i>See More</button>

                                </div>
                        </div>
                    
                    
                        <?php   } ?>
    </div>

    </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-container container ">
                <div class="footer-content">
                    <div class="footer-section">
                        <h4 class="text-center">About Us</h4>
                        <p style="text-indent: 50px;">
                    Welcome to our Book Review System website! We're passionate about literature and creating a community where book enthusiasts can discover, discuss, and share their favorite reads. Join us on this literary journey as we celebrate the joy of reading and the power of words.
                </p>
                    </div>
                    <div class="footer-section">
                        <h4 class="text-center">Quit Link</h4>
                        <div class="Quick-Link">
                            <ul>
                                <li class="">
                                    <a href="#" class="">FAQ</a>
                                </li>
                                <li class="">
                                    <a href="#" class="">Support</a>
                                </li>

                                <li class="">
                                    <a href="#" class="">Contact Us</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="">
                                    <a href="#" class="">About us</a>
                                </li>
                                <li class="">
                                    <a href="#" class="">BookMark</a>
                                </li>

                                <li class="">
                                    <a href="#" class="">Profile</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer-section">
                        <h4 class="text-center">Follow Us</h4>
                        <ul class="social-links">
                            <li>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="text-center mt-4">
                    © 2023 Book Review System. All rights reserved.
                </p>
            </div>
        </footer>

        <!-- JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
        <script type="module">
            import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.esm.browser.min.js'

            const swiper = new Swiper('.swiper', {
                slidesPerView: '3',
                spaceBetween: 20,
                autoplay: {
                    delay: 5000,
                },
                breakpoints: {
                    // when window width is >= 320px
                    480: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    // when window width is >= 480px
                    740: {
                        slidesPerView: 3,
                        spaceBetween: 30
                    },
                    // when window width is >= 640px
                    1040: {
                        slidesPerView: 4,
                        spaceBetween: 40
                    }
                }

            });		</script>
        <script src="../js/index.js"></script>
            
        <script src="app.js"></script>
</body>

</html>