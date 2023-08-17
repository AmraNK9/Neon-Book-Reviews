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

	<!-- Books -->
	<div class="container mt-4">
		<div class="book-card-list">
			<h2><a href="index.php">Back</a></h2>
			<h1>Collection of May</h1>
			<div class="book-card-grid">
				<div class="book-card">
					<div class="book-card-image">
						<img src="book-image.jpg" alt="Book 1" />
						<div class="book-card-overlay">
							<a href="#" class="book-card-button">Read More</a>
						</div>
					</div>
					<div class="book-card-info">
						<h3 class="book-card-title">Book 1</h3>
						<p class="book-card-author">Author: John Doe</p>
						<p class="book-card-genre">Genre: Fiction</p>
					</div>
				</div>
				<div class="book-card">
					<div class="book-card-image">
						<img src="book-image.jpg" alt="Book 1" />
						<div class="book-card-overlay">
							<a href="#" class="book-card-button">Read More</a>
						</div>
					</div>
					<div class="book-card-info">
						<h3 class="book-card-title">Book 1</h3>
						<p class="book-card-author">Author: John Doe</p>
						<p class="book-card-genre">Genre: Fiction</p>
					</div>
				</div>
				<div class="book-card">
					<div class="book-card-image">
						<img src="book-image.jpg" alt="Book 1" />
						<div class="book-card-overlay">
							<a href="#" class="book-card-button">Read More</a>
						</div>
					</div>
					<div class="book-card-info">
						<h3 class="book-card-title">Book 1</h3>
						<p class="book-card-author">Author: John Doe</p>
						<p class="book-card-genre">Genre: Fiction</p>
					</div>
				</div>
				<div class="book-card">
					<div class="book-card-image">
						<img src="book-image.jpg" alt="Book 1" />
						<div class="book-card-overlay">
							<a href="#" class="book-card-button">Read More</a>
						</div>
					</div>
					<div class="book-card-info">
						<h3 class="book-card-title">Book 1</h3>
						<p class="book-card-author">Author: John Doe</p>
						<p class="book-card-genre">Genre: Fiction</p>
					</div>
				</div>
				<div class="book-card">
					<div class="book-card-image">
						<img src="book-image.jpg" alt="Book 1" />
						<div class="book-card-overlay">
							<a href="#" class="book-card-button">Read More</a>
						</div>
					</div>
					<div class="book-card-info">
						<h3 class="book-card-title">Book 1</h3>
						<p class="book-card-author">Author: John Doe</p>
						<p class="book-card-genre">Genre: Fiction</p>
					</div>
				</div>
				<div class="book-card">
					<div class="book-card-image">
						<img src="book-image.jpg" alt="Book 2" />
						<div class="book-card-overlay">
							<a href="#" class="book-card-button">Read More</a>
						</div>
					</div>
					<div class="book-card-info">
						<h3 class="book-card-title">Book 2</h3>
						<p class="book-card-author">Author: Jane Smith</p>
						<p class="book-card-genre">Genre: Mystery</p>
					</div>
				</div>
				<div class="book-card">
					<div class="book-card-image">
						<img src="book-image.jpg" alt="Book 3" />
						<div class="book-card-overlay">
							<a href="#" class="book-card-button">Read More</a>
						</div>
					</div>
					<div class="book-card-info">
						<h3 class="book-card-title">Book 3</h3>
						<p class="book-card-author">Author: Michael Johnson</p>
						<p class="book-card-genre">Genre: Fantasy</p>
					</div>
				</div>
				<div class="book-card">
					<div class="book-card-image">
						<img src="book-image.jpg" alt="Book 3" />
						<div class="book-card-overlay">
							<a href="#" class="book-card-button">Read More</a>
						</div>
					</div>
					<div class="book-card-info">
						<h3 class="book-card-title">Book 3</h3>
						<p class="book-card-author">Author: Michael Johnson</p>
						<p class="book-card-genre">Genre: Fantasy</p>
					</div>
				</div>

			</div>

		</div>
	</div>
	<!-- Footer -->
	<footer class="footer mt-4">
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
	<script src="app.js"></script>
</body>

</html>