<?php
session_start();
include_once "../controllers/registercontroller.php";
include_once "../models/reviews.php";
$getUserData = new RegisterController();
$getUserinfo = $getUserData->getUserList();
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
} else {
	//echo $_SESSION['user_email'];
}

$userId = $getUserData->getUserId($_SESSION['user_email']);
//Connect With Reviews Models;
$reviews_model = new Reviews();
$reviews = $reviews_model->get_review_with_limit_offset(5, 0);
foreach ($reviews as $review) {
	//var_dump($review);
}
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
	<link rel="stylesheet" href="Review.css" />
	<link rel="stylesheet" href="../fontawesome/css/all.css">

</head>

<body>
	<!-- Navigation bar -->
	<?php
	include_once "nav.php";
	?>
	<div style="width:100%;height:40px;display:flex;justify-content:center">
		<a href="Post.php" class="btn" style="width:100px;background-color:#265077;color:white;">Post</a>
	</div>

	<!-- Review  Post -->
	<div class="container-fluid">

		<main data-user-id="<?php echo $userId[0]['id'] ?>" data-user-image="<?php echo $userimg ?>"
			data-user-name="<?php echo $username ?>">
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
								<img src="../image/<?php echo $userinfo["image"] ?>"
									alt="<?php echo $userinfo["image"] ?>" />
								<div class="user-details">
									<h3>
										<?php echo $userinfo["name"] ?>
									</h3>
									<p class="review-date" style="color: #888;"></p>
								</div>
							</div>
						</div>
						<hr class="color" style="size:10px;">
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
											<img src="../image/photos/<?php echo $book["image"] ?>"
												alt="<?php echo $book["image"] ?>" />
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
						<hr class="color">
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
									<li class="comment" data-comment-id="<?php echo $comment['id']; ?>">
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
											<p class="ago" style="color: #888;"></p>
										</div>
									</li>

								<?php
								}
								?>
							</ul>

							<div class="comment-form" id="comment-form-<?php echo $review['id'] ?>">
								<textarea class="form-control" placeholder="Add a comment" name="comment"></textarea>
								<button class="btn btn-primary" name="createComment"
									data-review-id="<?php echo $review['id'] ?>" onclick="LeeError(this)">Submit</button>

							</div>

						</div>
					</div>
				</div>

				<?php
			}
			?>


		</main>
		<div class="mt-4" style="display: flex;justify-content: center; width: 100%;">
			No More Result
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
	<script src="../fontawesome/js/all.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="Review.js"></script>
	<script>
		$(document).ready(function () {
			<?php foreach ($reviews as $review): ?>
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
					diff = "now";
				} else if (timeDiff < hour) {
					diff = Math.floor(timeDiff / minute) + " minutes ago";
				} else if (timeDiff < day) {
					diff = Math.floor(timeDiff / hour) + " hours ago";
				} else {
					diff = writingDate.toDateString(); // Writing time as a formatted date if it's more than a day ago
				}

				// Output the time difference
				$('.review[data-review-id="<?php echo $review['id']; ?>"] .review-date').text(diff);





				// comment
				<?php $comment = $reviews_model->get_review_comments($review['id']); ?>
				<?php foreach ($comment as $com): ?>
					// Get the writing time from PHP (assuming it's stored in a variable called writingTime)
					var writingTime = "<?php echo $com['date']; ?>";

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
						diff = "now";
					} else if (timeDiff < hour) {
						diff = Math.floor(timeDiff / minute) + " minutes ago";
					} else if (timeDiff < day) {
						diff = Math.floor(timeDiff / hour) + " hours ago";
					} else {
						diff = writingDate.toDateString(); // Writing time as a formatted date if it's more than a day ago
					}

					// Output the time difference
					$('.comment[data-comment-id="<?php echo $com['id']; ?>"] .ago').text(diff);
				<?php endforeach; ?>

			<?php endforeach; ?>

		})
	</script>
</body>

</html>