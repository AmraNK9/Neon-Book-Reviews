
<?php
session_start();
include_once "../controllers/registercontroller.php";
include('../neon/controller/bookController.php');
include_once('../controllers/commentController.php');
include_once('../controllers/ratingController.php');
$rating_controller=new RatingController();

$user_id=$_SESSION['userid'];
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
}


$cid=$_GET['id'];
$rating=$rating_controller->averageRating($cid);
$totalRating=0;
foreach ($rating as $rate) {
	$totalRating += $rate['rating'];
}
if($totalRating!=0){
	$total_user=count($rating);
	$average=$totalRating/$total_user;
	$average = round($average, 1);
}else{
	$average=0;
}

$book_controller=new BookController();
$book=$book_controller->getBook($cid);
$comment_controller=new CommentController();
$comment=$comment_controller->getAllComments($cid);
$comment = array_reverse($comment);
if(isset($_POST['submit'])){
	$comment=trim($_POST['comment']);
	if (strlen($comment) > 0 && $comment !== str_repeat(' ', strlen($comment)) && $comment !== ""){
		$update_comment=$comment_controller->addNewComment($comment,$user_id,$book[0]['id']);
		$comment=$comment_controller->getAllComments($cid);
		$comment = array_reverse($comment);
	}else {
		$comment=$comment_controller->getAllComments($cid);
		$comment = array_reverse($comment);
	}

}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		/>
		<title>Book Review System</title>
		<link
			rel="stylesheet"
			href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
		/>
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
		/>
		<link
			rel="stylesheet"
			href="BookDetail.css"
		/>
		<link rel="stylesheet" href="style.css">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<!-- <link
			rel="stylesheet"
			href="style.css"
		/> -->
		<style>
			/* Custom CSS styles */
			body {
				font-family: Arial, sans-serif;
			}

			/* .container {
				background-color: #fff;
				padding: 20px;
				border-radius: 5px;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			} */
		</style>
	</head>
	<body>
		<!-- Navigation bar -->
		<?php 
	include_once "nav.php";
	?>
	<div class="container-fluid">
	<div class="container">
			<div class="book-card">
				<div class="bookmark-icon">
					<i class="fa-regular fa-bookmark"></i>
				</div>

				<div class="book-info">
				<h3 class="book-title"><?php echo $book[0]['name'] ?></h3>
					<div class="book-image">
						<img
							src="../image/photos/<?php echo $book[0]['image'] ?>"
							alt="<?php echo $book[0]['name'] ?>"
						/>
					</div>
					<p class="book-author"><?php echo $book[0]['auther_name'] ?></p>
					<span><strong>
						<?php
							foreach ($book as $value) {
								echo $value['category_name']. '  /';
							}  
						?>  
						</strong>
					</span>
					<p></p>
					<p>Rating : <strong><?php echo $average ?></strong></p>
					<p class="book-description">
						Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium
						temporibus et voluptate id. Nobis, dicta! Doloribus, illum dolore
						facere, numquam molestiae perferendis officiis sit ipsa possimus ea
						consequatur nihil a. Lorem ipsum dolor sit amet, consectetur
						adipisicing elit. Laudantium temporibus et voluptate id. Nobis,
						dicta! Doloribus, illum dolore facere, numquam molestiae perferendis
						officiis sit ipsa possimus ea consequatur nihil a. Lorem ipsum dolor
						sit amet, consectetur adipisicing elit. Laudantium temporibus et
						voluptate id. Nobis, dicta! Doloribus, illum dolore facere, numquam
						molestiae perferendis officiis sit ipsa possimus ea consequatur
						nihil a. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
						Laudantium temporibus et voluptate id. Nobis, dicta! Doloribus,
						illum dolore facere, numquam molestiae perferendis officiis sit ipsa
						possimus ea consequatur nihil a.
					</p>
					<a class="read-more-btn">...See More</a>

					<div class="actions">
						<div class="bottom-icons">
							<div class="rating" id=<?php echo $book[0]['id'] ?>>
								<span class="star"></span>
								<span class="star"></span>
								<span class="star"></span>
								<span class="star"></span>
								<span class="star"></span>
							</div>
								<button class="download-icon btn btn-primary" id="read">Read</button>
								
						</div>
					</div>

					<div class="who-viewed">
						<img
							src="avatar1.jpg"
							alt="Avatar 1"
							class="avatar"
						/>
						<img
							src="avatar2.jpg"
							alt="Avatar 2"
							class="avatar"
						/>
						<span class="view-count">+3</span>
					</div>
				</div>
			</div>

			<!-- Comment Session -->
			<div class="comments">
				<h4>Comments</h4>
				<ul class="comment-list">
					<?php
					foreach ($comment as $com) {
					?>
					<li class="comment" data-comment-id="<?php echo $com['id']; ?>">
						<div class="comment-avatar">
							<img
								src="../image/photos/<?php echo $com['image'] ?>"
								alt="<?php echo $com['name'] ?>"
							/>
						</div>
						<div class="comment-content">
							<div  class="commentbox">
							<p class="comment-text"><?php echo $com['comment'] ?></p>
							<span class="comment-meta">- <?php echo $com['name'] ?></span>
							</div>
							<p class="ago" style="color: #888;"></p>
						
						</div>
					</li>
	
					<?php
					}
					?>
					
					<!-- Add more comment list items as needed -->
				</ul>
				<button class="load-more-btn btn">Load More</button>

				<form class="comment-form" method='post'>
					<textarea
						class="form-control"
						placeholder="Add a comment" name="comment"
					></textarea>
					<button class="btn btn-primary" name="submit">Submit</button>
				</form>
			</div>
		</div>
	</div>
		

		<!-- footer -->
		<footer class="footer">
			<div class="footer-container container">
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
									<a
										href="#"
										class=""
										>Went List</a
									>
								</li>
								<li class="">
									<a
										href="#"
										class=""
										>Support</a
									>
								</li>

								<li class="">
									<a
										href="#"
										class=""
										>Contact Us</a
									>
								</li>
							</ul>
							<ul>
								<li class="">
									<a
										href="#"
										class=""
										>Went List</a
									>
								</li>
								<li class="">
									<a
										href="#"
										class=""
										>Support</a
									>
								</li>

								<li class="">
									<a
										href="#"
										class=""
										>Contact Us</a
									>
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
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
		<script src="BookDetail.js"></script>
		<script>
		$(document).ready(function() {
			$("#read").click(function() {
        openPDF("../neon/pdf/<?php echo $book[0]['pdf_file'] ?>");
      });

//       $(".comment").click(function() {
//         // openPDF("pdf/sample.pdf");
//         console.log('comment');
//       });

    function openPDF(filePath) {
        event.preventDefault();
		var newWindow = window.open();
  newWindow.document.write('<html><head><title>PDF Document</title></head><body><embed width="100%" height="100%" src="' + filePath + '" type="application/pdf"></embed></body></html>');
	
    }               
			const user_id = "<?php echo $user_id; ?>";
			const book_id = "<?php echo $book[0]['id']; ?>";
			let mark=""
			$.ajax({
				url: 'mark.php',
				type: 'POST',
				data: { user_id: user_id, book_id: book_id },
				success: function(response) {
					mark=response
					if (mark==="empty") {
				// Book is bookmarked, change the icon to indicate bookmarked state
				document.querySelector('.fa-bookmark').classList.add('fa-regular');
				document.querySelector('.fa-bookmark').classList.remove('fa-solid');
				} else if(mark==="have") {
				// Book is unbookmarked, change the icon to indicate unbookmarked state
				document.querySelector('.fa-bookmark').classList.add('fa-solid');
				document.querySelector('.fa-bookmark').classList.remove('fa-regular');
				}
				}
				})
			//Book marked function

			// Get the bookmark icon element
			const bookmarkIcon = document.querySelector('.bookmark-icon');

			// Add click event listener to toggle bookmark status
			bookmarkIcon.addEventListener('click', function() {
			// Toggle the 'active' class on the bookmark icon
			this.classList.toggle('active');

			// Get the bookmark status
			const isBookmarked = this.classList.contains('active');
			
			// Update the bookmark status based on the current state
			if (mark==="empty") {
				// Book is bookmarked, change the icon to indicate bookmarked state
				this.querySelector('i').classList.remove('fa-regular');
				this.querySelector('i').classList.add('fa-solid');
				$.ajax({
				url: 'bookmark.php',
				type: 'POST',
				data: { user_id: user_id, book_id: book_id },
				success: function(response) {
					mark=response
				}
				})
			} else if(mark==="have") {
				// Book is unbookmarked, change the icon to indicate unbookmarked state
				this.querySelector('i').classList.remove('fa-solid');
				this.querySelector('i').classList.add('fa-regular');
				$.ajax({
				url: 'unbookmark.php',
				type: 'POST',
				data: { user_id: user_id, book_id: book_id },
				success: function(response) {
					mark=response
				}
				})
			}
			});
			<?php foreach ($comment as $com) : ?>
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
					diff =  "now";
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
		});
	</script>
	</body>
</html>
