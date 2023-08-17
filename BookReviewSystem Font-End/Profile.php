<?php
session_start();
include_once "../controllers/registercontroller.php";
include_once "../models/reviews.php";
$getUserData = new RegisterController();
$getUserinfo = $getUserData->getUserList();
foreach ($getUserinfo as $getUser) {
	//var_dump($getUser) ;
}
if (!isset($_SESSION['user_email'])) {
	header("location:../login.php");
} else {
}
if ($_SESSION["user_email"] == $getUser['email']) {
	$userimg = $getUser['image'];
	$username = $getUser['name'];
	$userbio = $getUser['bio'];
	$useremail = $getUser['email'];
}
//$userId = $getUserData->getUserId($useremail);
//Connect With Reviews Models;
$reviews_model = new Reviews();
$reviews = $reviews_model->get_review_with_limit_offset(5, 0);
?>
<?php
include_once "../controllers/registercontroller.php";
include_once "../controllers/bookmarkController.php";
include_once "../controllers/usercontroller.php";
include_once "../models/register.php";
include_once "../models/reviews.php";
$user_id = $_SESSION['userid'];
$getUserData = new RegisterController();
$getUserinfo = $getUserData->getUserList();
$updateUserInfo = new UserController();
$getPersonalInfo = $updateUserInfo->getSingleUser($_SESSION['user_email']);
$bookmark_controller = new BookmarkController();
$bookmark_list = $bookmark_controller->getAllBookmark($user_id);
//var_dump($getPersonalInfo[0]["image"]);

//Add User img
if (!isset($_SESSION['user_email'])) {
	header("location:../login.php");
} else {
	$userEmail = $_SESSION["user_email"];
	//echo $userEmail;
}
//var_dump($_SESSION["user_email"]);
foreach ($getUserinfo as $getUser) {
	//var_dump($getUser);
	if ($_SESSION["user_email"] == $getUser['email']) {
		$userimg = $getUser['image'];
		$username = $getUser['name'];
		$userbio = $getUser['bio'];
		$useremail = $getUser['email'];
	}
}

if (isset($_POST['edituserprofile'])) {
	$getPersonalInfo = $updateUserInfo->getUser($_SESSION['user_email']);
	//var_dump($getPersonalInfo);
}


//click save btn
if (isset($_POST['save'])) {

	$filename = $_FILES['img']['name'];
	$filesize = $_FILES['img']['size'];
	$allowed_files = ['jpg', 'png', 'jpeg', 'svg'];
	$temp_path = $_FILES['img']['tmp_name'];

	// echo $filename;
	if ($_FILES['img']['error'] != 0) {
		$filename = $getPersonalInfo[0]["image"];
	} else {
		$fileinfo = explode('.', $filename);
		$filetype = end($fileinfo);
		$maxsize = 2000000000;
		if (in_array($filetype, $allowed_files)) {
			if ($filesize < $maxsize) {
				move_uploaded_file($temp_path, '../image/' . $filename);
			} else {
				echo "file size exceeds maximum allowed";
			}
		} else {
			echo "file type is not allowed";
		}
	}

	$error_status = false;

	if (!empty($_POST['usereditname'])) {
		$editusername = $_POST['usereditname'];
	} else {
		$error_status = true;
		$error_username = "Please Enter Your Name";
	}
	$edituserbio = $_POST['usereditbio'];
	//echo $filename;
	if ($error_status == false) {
		$updateUser = $updateUserInfo->updateUserInfo($editusername, $useremail, $edituserbio, $filename);
		header("Location: " . $_SERVER['PHP_SELF']);

	}

}


//user log out
if (isset($_POST['logout'])) {
	unset($_SESSION['user_email']);
	header("location:../login.php");
}

//connect With Register Models 
$register_model = new CreateUser();
//Connect With Reviews Models;
$reviews_model = new Reviews();
$userid = $register_model->getUserId($userEmail);
$reviews = $reviews_model->get_review_by_userId($user_id);
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
	<link rel="stylesheet" href="../fontawesome/css/all.css">
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="Profile.css" />
	<link rel="stylesheet" href="Review.css">
</head>
<style>
	.Profile-container{
		margin-top: 100px;
	}
	@media(max-width: 992px){
		.Profile-container{
			margin-top: 10px;	}

	}
</style>

<body>
	<div class="container-fluid Profile-container" style="">
	<div class="profile-page ">
		<div class="container profile-container">
		<form action="" method="post" enctype="multipart/form-data">
			<div class="profile-header">
				<div class="profile-edit d-flex justify-content-center ">
					<img src="../image/<?php if (!empty($userimg)) {

						echo $userimg;
					} else {
						echo "user.jpg";
					} ?>" class="img" id="profileimg" alt="" />

				</div>
				<div class="cancel-button d-none" id="cancelButton">
					<i class="fa-solid fa-xmark fa-xl cross "></i>
				</div>
				<div class="round d-none">
					<i class="fa fa-camera camera" style="color: #00000;"></i>
					<input type="file" name="img" src="" alt="" id="input" class="world">
				</div>
				<h1 class="profile-name username mt-3">
					<?php echo $username; ?>
				</h1>

				<div class="d-flex justify-content-center">
					<input type="text" name="usereditname" placeholder="Please Enter Your Name" class="form-control usereditname d-none my-3 text-center <?php if (isset($error_username))
						echo "border border-danger" ?>" id="" value="<?php echo $username ?>" required>
				</div>
				<p class="profile-bio">
					<?php if (!empty($userbio)) {
						echo $userbio;
					} else {
						echo "Edit Your Bio";
					} ?>
				</p>
				<div class="d-flex justify-content-center">

					<input type="text" name="usereditbio" placeholder="Bio"
						class="form-control usereditbio d-none my-3 text-center" id="" value="<?php echo $userbio ?>">

				</div>

			</div>
			<div class="allbtn">
				<button class="btn  mx-3 editProfile" style="background-color:#265077; color:white;" name="edituserprofile" id="edit_profile"><i
						class="fa-regular fa-pen-to-square mr-2"></i>Edit Profile</button>
				<button class="btn btn-danger logout" name="logout"><i
						class="fa-solid fa-arrow-right-from-bracket mr-2"></i>Log Out</button>
				<!-- <a href="../login.php" class="btn btn-danger logout">Log Out</a> -->

				<button class="btn btn-info d-none save mx-3" name="save"><i
						class="fa-regular fa-floppy-disk mr-2"></i>Save</button>
				<button class="btn btn-warning d-none cancel" name="cancel"><i
						class="fa-solid fa-xmark mr-2"></i>Cancel</button>
			</div>
		</form>
		</div>
		
		<div class="profile-content mt-4	">
			<div class="favorite-books mb-4">
			
				<!-- Favorite book cards here -->
				<!-- Books -->
				<div class="container">
				<h2 class="section-title">Favorite Books</h2>

					<div class="book-card-list">

						<div class="book-card-grid">
							<div class="row">
							<?php
							foreach ($bookmark_list as $bookmark) {
							?>
							<div class=" col-lg-4">
							<div class="book-card">
								<div class="book-card-image">
									<img src="../image/photos/<?php echo $bookmark['image'] ?>" alt="<?php echo $bookmark['name'] ?>" />
									<div class="book-card-overlay">
										<a href="BookDetail.php?id=<?php echo $bookmark['id'] ?>" class="book-card-button">Read More</a>
									</div>
								</div>
								<div class="book-card-info">
									<h3 class="book-card-title"><?php echo $bookmark['name'] ?></h3>
									<p class="book-card-author"><?php echo $bookmark['auther_name'] ?></p>
								</div>
							</div>
							</div>
							<?php
							}
							?>
							</div>
						</div>
					</div>
				</div>
			</div>

		
			<h2 class="section-title" class="mt-5">Reviews</h2>

				<main data-user-id="<?php echo $userId[0]['id'] ?>" data-user-image="<?php echo $userimg?>" data-user-name="<?php echo $username?>">
					<?php
					foreach ($reviews as $review) {
						$id_of_review = $review['id'];
						$userinfo = $reviews_model->get_userinfo_by_id($review['user_id']);

						$review_books = $reviews_model->get_review_book($review['id']);

						?>
						<div class="container mt-4">
						<div class="review" data-review-id="<?php echo $review['id']; ?>">
							<div class="review-header">
								<div class="user-profile">
									<img src="../image/<?php echo $userinfo["image"] ?>" alt="<?php echo $userinfo["image"] ?>" />
									<div class="user-details">
										<h3>
											<?php echo $userinfo["name"] ?>
										</h3>
										<p class="review-date" style="color: #888;">
											
										</p>
									</div>
								</div>
							</div>
							<hr>
							<div class="review-content">
								<p>
									<?php
									echo $review["content"];
									?>
								</p>
								<div class="d-flex flex-wrap">

									<?php
									foreach ($review_books as $review_book_id) {
										$book = $reviews_model->get_bookinfo_by_id($review_book_id["book_id"]);
										?>
										<a href="BookDetail.php?id=<?php echo $review_book_id['book_id'] ?>">
											<div class="book-details">
												<img src="../image/photos/<?php echo $book["image"] ?>" alt="<?php echo $book["image"] ?>" />
												<div class="book-info">
													<h2>
														<?php echo $book["name"] ?>
													</h2>
													<?php
													$author = $reviews_model->get_author_by_id($book["auther_id"]);
													?>
													<p>by
														<?php echo $author["name"] ?>
													</p>
												</div>
											</div>
										</a>
										<?php
									}
									?>

								</div>


							</div>
							<hr>
							<div class="review-actions position-relative">
								<button class="like-btn <?php if ($reviews_model->is_react($id_of_review, $userId[0]['id'])) {
									echo "liked";
								} ?>" data-review-id="<?php echo $review['id'] ?>" onclick="toggleLike(this)">
									<i class="fas fa-thumbs-up"></i>
									<span class="like-text">Like</span>
									<span class="like-count">
										<?php
										$total_react = $reviews_model->get_review_reacts($id_of_review);
										echo $total_react['user_react'];
										?>
									</span>
								</button>
								<button class="comment-btn" data-review-id="<?php echo $review['id'] ?> "
									onclick="toggleComment(this)">
									<i class="fas fa-comment"></i> Comment
								</button>
								<!-- <div class="who-viewed">
							<img src="user-avatar.jpg" alt="Avatar 1" class="Profile-avatar" />
							<img src="user-avatar.jpg" alt="Avatar 2" class="Profile-avatar" />
							<span class="view-count">+3</span>
						</div> -->
							</div>
							<div class="comments hide" id="comment-<?php echo $review['id'] ?>">
								<h4>Comments</h4>
								<ul class="comment-list" id="comment-list-<?php echo $review['id'] ?>">
									<?php
									$comments = $reviews_model->get_review_comments($review['id']);
									foreach ($comments as $key => $comment) {
										$userInfo = $reviews_model->get_userinfo_by_id($comment['user_id']);
										?>
										<li class="comment">
											<div class="comment-avatar">
												<img src="../image/<?php echo $userInfo["image"] ?>"
													alt="<?php echo $userInfo["image"] ?>" />
											</div>
											<div class="comment-content">
												<div class="commentbox">
													<span class="">
														<?php echo $userInfo['name'] ?>
													</span>
													<p class="comment-text">
														<?php echo $comment['comment'] ?>
													</p>
												</div>
												<p class="ago"></p>
												
												
											</div>
										</li>

									<?php
									}
									?>
								</ul>

								<div class="comment-form" id="comment-form-<?php echo $review['id'] ?>">
									<textarea class="form-control" placeholder="Add a comment" name="comment"></textarea>
									<button class="btn btn-primary" name="createComment"
										data-review-id="<?php echo $review['id'] ?>"
										onclick="LeeError(this)">Submit</button>

								</div>

							</div>
						</div>
						</div>
						
						<?php
					}
					?>


				</main>
			
		</div>
	</div>
	</div>

	

	<!-- Footer -->
	<footer class="footer">
		<div class="footer-container">
			<div class="footer-content">
				<div class="footer-section">
					<h4 class="text-center">About Us</h4>
					<p>
						Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec
						aliquet semper sapien, ut sodales lectus tincidunt et.
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
	<script src="../fontawesome/js/all.js"></script>
	<!-- <script src="app.js"></script> -->
	<script src="../js/profile.js"></script>
	<script src="Profile.js"></script>
	<<script>
		$(document).ready(function(){
			<?php foreach ($reviews as $review) : ?>
				// Get the writing time from PHP (assuming it's stored in a variable called writingTime)
				var writingTime = "<?php echo $review['date']; ?>";

				// Convert the writing time to JavaScript Date object
				var writingDate = new Date(writingTime);

				// Calculate the time difference in milliseconds
				var timeDiff = Date.now() - writingDate.getTime();

				// Define time intervals in milliseconds
				var minute = 60 * 1000;
				var hour = 60 * minute;
				var day = 24 * hour;

				// Calculate the time difference in different units
				var diff;
				if (timeDiff < minute) {
					diff =  "now";
				} else if (timeDiff < hour) {
					diff = Math.floor(timeDiff / minute) + " minutes ago";
				} else if (timeDiff < day) {
					diff = Math.floor(timeDiff / hour) + " hours ago";
				} else {
					diff = writingDate.toDateString(); // Writing time as a formatted date if it's more than a day ago
				}

				// Output the time difference
				$('.review[data-review-id="<?php echo $review['id']; ?>"] .review-date').text(diff);
			<?php endforeach; ?>
		})
	</script>
</body>

</html>