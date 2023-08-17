<?php
session_start();
include_once "../controllers/registercontroller.php";
include_once "../controllers/authorController.php";
include_once "../models/author.php";

$author_model = new author();
$getUserData=new RegisterController();
$getUserinfo=$getUserData->getUserList();
$getAllAuthorInfo=new authorController();
$getAllAuthor=$getAllAuthorInfo->getAllAuthorFromAuthorDetail();

foreach ($getUserinfo as $getUser) {
	//var_dump($getUser);
}

if(!isset($_SESSION['user_email']))
	{
		header("location:../login.php");
	}

	if($_SESSION["user_email"]==$getUser['email'])
	{
		$userimg=$getUser['image'];
		$username=$getUser['name'];
		$userbio=$getUser['bio'];
		$useremail=$getUser['email'];
	}


if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$author_info = $author_model->getAuthorInfo($id);
	// var_dump($author_info);
}

// foreach($getAllAuthor as $getAuthor)
// {
// 	if($id==$getAuthor['id'])
// 	{
// 		$authorname=$getAuthor['name'];
// 		$authorimg=$getAuthor['image'];
// 	}
// }

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Book Review System</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<!-- Navigation bar -->
	<?php
	include_once "nav.php";
	?>

				</li>
			</ul>
		</div>
	</nav>
	<div class="container mt-4 mb-3">
		<div class="row ">
 			<div class="col-md-4 " >
				<img class="author-image" src="../image/<?php echo $author_info['image'];  ?>"  width="100%" alt="<?php echo $author_info['image'];  ?>" />
			</div>
			<div class="col-md-6">
				<h2 class="author-name"><?php echo $author_info['name'];  ?></h2>
				<p class="author-bio">Author Bio</p>
				<p>
				<?php echo $author_info['profile'];  ?>
				</p>
			</div>
		</div>
		<!-- <div class="author-card-grid-view">
			Author cards here 
			<div class="author-card">
				<a class="author-website" href="https://www.author-website.com" target="_blank">Visit Website</a>
			</div>
		</div> -->
	</div>

	<!-- Books -->
	<div class="container">
		<div class="book-card-list">
			<!-- Search Bar -->
			<!-- <div class="search-bar">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search..." />
					<div class="input-group-append">
						<button class="btn btn-primary" type="button">
							Search
						</button>
					</div>
				</div>
			</div> -->

			<div class="book-card-grid">
				<?php
				$author_books = $author_model->getAuthorBookS($id);
				// var_dump($author_books);
				foreach($author_books as $book){
				?>
				<div class="book-card">
					<div class="book-card-image">
						<img src="<?php echo $book['image'] ?>" alt="<?php echo $book['image'] ?>" />
						<div class="book-card-overlay">
							<a href="BookDetail.php?id=<?php echo $book['id'] ?>" class="book-card-button">Read More</a>
						</div>
					</div>
					<div class="book-card-info">
						<h3 class="book-card-title"><?php echo $book['image'] ?></h3>
						<p class="book-card-author">Author: <?php echo $book['name'] ?></p>
						<!-- <p class="book-card-genre">Genre: <?php echo $book['image'] ?></p> -->
					</div>
				</div>
				<?php
				}
				?>
			</div>
			<!-- <div class="mt-4" style="display: flex;justify-content: center; width: 100%;">
				<a href="" class="btn btn-primary m-auto">Load More</a>
			</div> -->
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer mt-4">
		<div class="footer-container">
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
	<script src="app.js"></script>
</body>

</html>