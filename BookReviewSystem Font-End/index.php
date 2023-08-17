<?php
session_start();
include_once "../controllers/registercontroller.php";
include_once "../neon/controller/bookController.php";
include_once "../neon/controller/categoryController.php";
include_once "../neon/models/editorchoice.php";
include_once('../neon/controller/bookController.php');
$book_controller = new bookController();
$book_list = $book_controller->getAllBooks();
$book_list = array_reverse($book_list);

$editorChoice = new Editor();
$editorChoiceCategory = $editorChoice->getAllCateGory();
$getUserData = new RegisterController();
$getUserinfo = $getUserData->getUserList();

$getAllCategory = new CategoryController();
$getCategory = $getAllCategory->getAllCategory();

$getAllBook = new BookController();

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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
    $(document).ready(function() {
      // Array with the values
      var bookList = <?php echo json_encode($book_list); ?>;
      // Display array values normally
      function displayArrayNormally() {
        var arrayValuesElement = $(".bk");
        arrayValuesElement.empty(); // Clear previous values
		$('.latest-update').addClass('active');
    $('.content').removeClass('active');
        $.each(bookList, function(index, book) {
			var bookCardHTML = `
            <div class="book-card">
              <div class="book-card-image">
                <img src="../image/photos/${book.image}" alt="${book.name}" />
                <div class="book-card-overlay">
                  <a href="BookDetail.php?id=${book.id}" class="book-card-button">Read More</a>
                </div>
              </div>
              <div class="book-card-info">
                <h3 class="book-card-title">${book.name}</h3>
                <p class="book-card-author">${book.auther_name}</p>
              </div>
            </div>
          `;
          arrayValuesElement.append(bookCardHTML);
        });
		
      }

      // Display array values randomly
      function displayArrayRandomly() {
        var bookListElement = $(".bk");
        bookListElement.empty(); // Clear previous values
		$('.latest-update').removeClass('active');
    	$('.content').addClass('active');
        var shuffledBookList = bookList.slice(); // Create a copy of the original array
        for (var i = shuffledBookList.length - 1; i > 0; i--) {
          var j = Math.floor(Math.random() * (i + 1));
          var temp = shuffledBookList[i];
          shuffledBookList[i] = shuffledBookList[j];
          shuffledBookList[j] = temp;
        }

        $.each(shuffledBookList, function(index, book) {
			var bookCardHTML = `
            <div class="book-card">
              <div class="book-card-image">
                <img src="../image/photos/${book.image}" alt="${book.name}" />
                <div class="book-card-overlay">
                  <a href="BookDetail.php?id=${book.id}" class="book-card-button">Read More</a>
                </div>
              </div>
              <div class="book-card-info">
                <h3 class="book-card-title">${book.name}</h3>
                <p class="book-card-author">${book.auther_name}</p>
              </div>
            </div>
          `;
          bookListElement.append(bookCardHTML);
        });
      }

      // Button A click event handler
      $(".latest-update").click(displayArrayNormally);

      // Button B click event handler
      $(".content").click(displayArrayRandomly);

      // Display the array normally on document ready
      displayArrayNormally();
    });
  </script>
</head>

<body>
	<!-- Navigation bar -->
	<?php
	include_once "nav.php";
	?>

	<div class="container-fluid mt-4" id="concon">
		<div class="container  back">

			<h1>Editor Choice</h1>

			<?php
			foreach ($editorChoiceCategory as $Category) {
				$EditoChoice_Book = $editorChoice->genere($Category['category_id']);
				?>

				<div class="container mb-2 swiper">
					<h2>
						<?php echo $Category['category_name'] ?>
					</h2>
					<div class=" swiper-wrapper">
						<?php foreach ($EditoChoice_Book as $book) { ?>
							<div class=" swiper-slide">
								<div class="book-card">
									<div class="book-card-image">
										<img src="../image/photos/<?php echo $book['book_image'] ?>"
											alt="<?php echo $book['book_image'] ?>" />
										<div class="book-card-overlay">
											<a href="BookDetail.php?id=<?php echo $book['id'] ?>" class="book-card-button">Read
												More</a>
										</div>
									</div>
									<div class="book-card-info">
										<h3 class="book-card-title">
											<?php echo $book['book_name'] ?>
										</h3>
										<p class="book-card-author">
											<?php echo $book['author_name'] ?>
										</p>
									</div>
								</div>
							</div>
						<?php } ?>

					</div>
					<!-- <div class="mt-4" style="display: flex;justify-content: center; width: 100%;">
			<a href="collection.php" class="btn btn-primary m-auto">See All</a>

		</div> -->
				</div>
				<?php
			}
			?>

		</div>



<!-- Books -->
<div class="container mt-4 navy" id="">
	<div class="book-card-list">
		<!-- <h2 class="ms-2 float-left">Books</h2> -->
			<div class="view-options  ">
				<button class="view-option-btn latest-update active" data-update="list">
					Lastest Update
				</button>
				<button class="view-option-btn content" data-radom="grid">
					Content at redom
				</button>
			</div>
			<div class="book-card-grid bk">
				

				</div>
				<div class="mt-4" style="display: flex;justify-content: center; width: 100%;">
					<a href="" class="btn btn-primary m-auto">Load More</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer">
		<div class="footer-container container">
			<div class="footer-content">
				<div class="footer-section">
					<h4 class="text-center">About Us</h4>
					<p style="text-indent: 50px;">
						Welcome to our Book Review System website! We're passionate about literature and creating a
						community where book enthusiasts can discover, discuss, and share their favorite reads. Join us
						on this literary journey as we celebrate the joy of reading and the power of words.
					</p>
				</div>
				<div class="footer-section">
					<h4 class="text-center">Quick Links</h4>
					<div class="Quick-Link">
						<ul>
							<li>
								<a href="#">FAQ</a>
							</li>
							<li>
								<a href="#">Support</a>
							</li>
							<li>
								<a href="#">Contact Us</a>
							</li>
						</ul>
						<ul>
							<li>
								<a href="#">About Us</a>
							</li>
							<li>
								<a href="#">Bookmarks</a>
							</li>
							<li>
								<a href="#">Profile</a>
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
				&copy; 2023 Book Review System. All rights reserved.
			</p>
		</div>
	</footer>



	<!-- JavaScript -->

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
	<script type="module">
		import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.esm.browser.min.js'

		const swiper = new Swiper('.swiper', {
			slidesPerView: '3',
			spaceBetween: 20,
			parallax: true,
			loop: true,
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
	<script src="app.js"></script>

</body>

</html>